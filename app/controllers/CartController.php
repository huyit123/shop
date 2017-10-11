<?php
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{

    public function addtocart()
    {
        $input = Input::All();
        $product = Product::find($input['id']);
        $quantity = isset($input['quantity']) ? $input['quantity'] : 1;
        Cart::add(array('id' => $product->id, 'name' => $product->name, 'qty' => $quantity, 'price' => $product->price, 'options' => array('image' => $product->image, 'alias' => $product->alias)));
        return Response::json(Cart::count());
    }

    public function updateCart()
    {
        $input = Input::All();
        $id = (int)$input['id'];
        $status = $input['status'];
        $rowId = Cart::search(array('id' => $id));
        $item = Cart::get($rowId[0]);
        if ($status == 'plus') {
            Cart::update($rowId[0], $item->qty + 1);
        } else {
            Cart::update($rowId[0], $item->qty - 1);
        }
        $item = Cart::get($rowId[0]);
        return Response::json(array('item' => $item, 'total' => Cart::total(), 'count' => Cart::count()));
    }

    public function Cart()
    {
        $cart = Cart::content();
        return View::make('frontend.cart.cart')->with('cart', $cart);
    }

    public function removeallCart()
    {
        $cart = Cart::destroy();
        return Redirect::to('/');
    }

    public function removeItemCart()
    {
        try {
            $input = Input::All();
            Cart::remove($input['id']);
            return Redirect::to('/gio-hang');
        } catch (Exception $e) {
            return Redirect::to('/gio-hang');
        }

    }

    public function checkout()
    {
        $cart = Cart::content();
        if (count($cart) > 0) {
            $city = Province::whereNull('idparent')->orderby('name', 'asc')->get();
            return View::make('frontend.cart.checkout')->with('cart', $cart)->with('city', $city);
        } else return Redirect::to('/gio-hang');
    }

    public function getdistrict()
    {
        $input = Input::All();
        $district = Province::where('idparent', $input['id'])->orderby('name', 'asc')->get();
        return Response::json($district);
    }

    public function checkout_oder()
    {
        $input = Input::all();
        $values = array(
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required',
            'city' => 'required',
            'district' => 'required',
        );
        $validator = Validator::make($input, $values);
        if (!$validator->fails()) {
            $cart = Cart::content();
            if (count($cart) == 0) {
                return Redirect::to('/gio-hang');
            }
            DB::beginTransaction();
            try {
                $district = Province::find($input['district']);
                $priceshipping = 0;
                if(empty($district->price)){
                    $city = Province::find($district->idparent);
                    if(!empty($city->price)){
                        $priceshipping = $city->price;
                    }
                }
                else{
                    $priceshipping = $district->price;
                }
                $date = Carbon::now()->format('dmy') . rand();
                $cartdb = new Cartdb();
                $cartdb->codeorder = 'DH-' . $date;
                $cartdb->price = Cart::total();
                $cartdb->total = Cart::total() + $priceshipping;
                $cartdb->priceship = $priceshipping;
                $cartdb->pricecoupon = 0;
                $cartdb->status = 'pending';
                $cartdb->note = $input['note'];
                $cartdb->save();

                $address = new AddressShip();
                $address->cartid = $cartdb->id;
                $address->name = $input['name'];
                $address->phone = $input['phone'];
                $address->email = $input['email'];
                $address->address = $input['address'];
                $address->city = Province::find($input['city'])->name;
                $address->district = Province::find($input['district'])->name;
                $address->save();

                foreach ($cart as $item) {
                    $cartproduct = new CartProduct();
                    $cartproduct->cartid = $cartdb->id;
                    $cartproduct->productid = $item->id;
                    $cartproduct->quantity = $item->qty;
                    $cartproduct->price = $item->price;
                    $cartproduct->save();

                    $product = Product::find($item->id);
                    if($product){
                        $product->quantity -= $item->qty;
                        $product->save();
                    }
                }

                if (Session::has('codecoupon')) {
                    $code = Session::get('codecoupon')['codecoupon'];
                    $discount = Discountcode::join('discount', 'discount.id', '=', 'discountcode.discountid')
                        ->select('discount.startdate', 'discount.enddate', 'discount.price', 'discount.type', 'discountcode.*')
                        ->where('discountcode.code', $code)->first();
                    if (count($discount) > 0) {
                        $date = Carbon::now();
                        if ($date >= $discount->startdate && $date <= $discount->enddate && $discount->isused != 1) {
                            if ($discount->type == 'price') {
                                $pricecode = $discount->price;
                                if($cartdb->total > $pricecode){
                                    $totalcart = $cartdb->total - $pricecode;
                                }else $totalcart = 0;

                                $cartdb->pricecoupon = $pricecode;
                                $cartdb->total = $totalcart;
                            } else {
                                $pricecode = Cart::total() * ($discount->price / 100);
                                if($cartdb->total > $pricecode){
                                    $totalcart = $cartdb->total - $pricecode;
                                }else $totalcart = 0;

                                $cartdb->pricecoupon = $pricecode;
                                $cartdb->total = $totalcart;
                            }
                            $cartdb->discountid = $discount->id;
                            $cartdb->save();
                            $discode = Discountcode::where('code', $code)->first();
                            $discode->isused = 1;
                            $discode->save();
                        }
                    }
                }

                $subject = 'Đơn hàng từ shop';
                FcHelper::ConfigMail();
                Mail::send('emails.emailorder', array('cart' => $cart, 'info' => $address, 'cartdb' => $cartdb), function ($message) use ($address, $subject) {
                    $message->to($address->email, $address->name)->subject($subject);
                });
                Session::forget('codecoupon');
                Cart::destroy();
                return Redirect::to('/hoan-tat-dat-hang');
            } catch (Exception $e) {
                DB::rollback();
                echo $e->getMessage();
                exit();

            }
        } else {

        }

    }

    public function CartSuccess()
    {
        return View::make('frontend.cart.success');
    }

    public function checkcodecoupon()
    {
        $date = Carbon::now();
        $input = Input::All();
        $code = $input['codecoupon'];
        $discount = Discountcode::join('discount', 'discount.id', '=', 'discountcode.discountid')
            ->select('discount.startdate', 'discount.enddate', 'discount.price', 'discount.type', 'discountcode.*')
            ->where('discountcode.code', $code)->first();
        $ms = '';
        $success = false;
        $pricecode = 0;
        if (count($discount) > 0) {
            if ($discount->isused == 1) {
                $ms = "Mã giảm giá này đã được sử dụng. Vui lòng thử lại";
            } else if ($date >= $discount->startdate && $date <= $discount->enddate) {
                $ms = "OK";
                $success = true;
                if ($discount->type == 'price') {
                    $pricecode = $discount->price;
                } else {
                    $pricecode = Cart::total() * ($discount->price / 100);
                }
                Session::put('codecoupon', array('pricecode' => $pricecode, 'codecoupon' => $discount->code));
            } else {
                $ms = "Mã giảm giá không áp dụng trong thời gian này";
            }
        } else {
            $ms = "Mã giảm giá không chính xác";
        }
        return Response::json(array('msg' => $ms, 'success' => $success, 'pricecode' => $pricecode));
    }

    public function removecodecoupon()
    {
        Session::forget('codecoupon');
        return Response::json(array('pricecode' => 0, 'totalcart' => Cart::total()));
    }
    public function getdistrict_shipping(){
        $input = Input::All();
        $id = $input['id'];
        $district = Province::find($id);
        $priceshipping = 0;
        if(empty($district->price)){
            $city = Province::find($district->idparent);
            if(!empty($city->price)){
                $priceshipping = $city->price;
            }
        }
        else{
            $priceshipping = $district->price;
        }
        return Response::json($priceshipping);
    }
}
