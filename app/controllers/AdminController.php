<?php
use Carbon\Carbon;

class AdminController extends BaseController
{

    /*
    |--------------------------------------------------------------------------
    | Default Home Controller
    |--------------------------------------------------------------------------
    |
    | You may wish to use controllers instead of, or in addition to, Closure
    | based routes. That's great! Here is an example controller method to
    | get you started. To route to this controller, just add the route:
    |
    |	Route::get('/', 'HomeController@showWelcome');
    |
    */
    public function __construct()
    {
        $this->beforeFilter('@filterRequests');
    }

    public function filterRequests()
    {
        if (!Auth::check()) {
            return Redirect::to('/dang-nhap?url=' . URL::current());
        } else {
            if (Auth::user()->role != 1) {
                return Redirect::to('/');
            }
        }
    }

    public function home()
    {
        return View::make('backend.home.index');
    }

    public function category_index()
    {
        $categories = $this->getCategories();
        return View::make('backend.category.category_index')->with('categories', $categories);
    }

    public function getCategories()
    {

        $categories = Category::where('parentid', 0)->get();//united

        $categories = $this->addRelation($categories);

        return $categories;

    }

    protected function selectChild($id)
    {
        $categories = Category::where('parentid', $id)->get();
        $categories = $this->addRelation($categories);
        return $categories;
    }

    protected function addRelation($categories)
    {
        $categories->map(function ($item, $key) {
            $sub = $this->selectChild($item->id);
            return $item = array_add($item, 'subCategory', $sub);
        });
        return $categories;
    }


    public function category_update($id = 0)
    {
        $data = Category::find($id);
        $getcategories = Category::where('parentid', 0)->get();
        if ($data) {
            return View::make('backend.category.category_update')->with('category', $data)->with('listcategory', $getcategories);
        } else {
            $data = new Category();
            return View::make('backend.category.category_update')->with('category', $data)->with('listcategory', $getcategories);
        }
    }

    public function category_update_post($id = 0)
    {
        try {
            $input = Input::All();
            $values = array(
                'title' => 'required',
                'orderby' => 'required',
                'parentid' => 'required',
            );
            $validator = Validator::make($input, $values);
            if ($validator->fails()) {
                return Redirect::to('/admin/category/update/' . $id)->withErrors($validator);
            } else {
                $data = new Category();
                $action = 'Tạo mới danh mục';
                if ($id > 0) {
                    $data = Category::find($id);
                    $action = 'Cập nhật danh mục';
                }
                $data->title = mb_strtolower($input['title'], 'UTF-8');;
                $data->orderby = $input['orderby'];
                $data->parentid = empty($input['parentid']) ? 0 : $input['parentid'];
                $data->display = isset($input['display']) ? 1 : 0;
                $data->save();
                Session::flash('success', $action . ' thành công');
                return Redirect::to('/admin/category/update/' . $data->id);
            }

        } catch (Exception $e) {
            Session::flash('warning', $e->getMessage());
            return Redirect::to('/admin/category/update/' . $id);
        }
    }

    public function product_index()
    {
        $products = Product::Join('category', 'category.id', '=', 'product.categoryid')
            ->orderby('product.id', 'desc')
            ->select('product.*', 'category.title')->get();
        return View::make('backend.product.product_index')->with('products', $products);
    }

    public function product_update($id = 0)
    {
        $data = Product::find($id);
        $categories = $this->getCategories();
        if ($data) {
            return View::make('backend.product.product_update')->with('data', $data)->with('categories', $categories);
        } else {
            $data = new Product();
            return View::make('backend.product.product_update')->with('data', $data)->with('categories', $categories);
        }
    }

    public function product_update_post($id = 0)
    {
        try {
            $input = Input::All();
            $values = array(
                'name' => 'required',
                'price' => 'required',
                'categoryid' => 'required',
                'quantity' => 'required',
            );
            $validator = Validator::make($input, $values);
            if ($validator->fails()) {
                return Redirect::to('/admin/product/update/' . $id)->withErrors($validator);
            } else {
                $data = new Product();
                $action = 'Tạo mới sản phẩm';
                if ($id > 0) {
                    $data = Product::find($id);
                    $action = 'Cập nhật sản phẩm';
                }
                $data->name = mb_strtolower($input['name'], 'UTF-8');
                $data->price = $input['price'];
                $data->price_old = $input['price_old'];
                $data->categoryid = $input['categoryid'];
                $data->featured = $input['featured'];
                $data->featured_show = isset($input['featured_show']) ? 1 : 0;
                $rootcategory = Category::find($input['categoryid']);
                if ($rootcategory->parentid == 0) {
                    $data->rootcategory = $rootcategory->id;
                } else {
                    $data->rootcategory = $rootcategory->parentid;
                }

                $data->productcode = $input['productcode'];
                $data->brand = $input['brand'];
                $data->madein = $input['madein'];
                $data->quantity = $input['quantity'];
                $data->tags = $input['tags'];
                $data->summary = $input['summary'];
                $data->description = $input['description'];
                $data->alias = FcHelper::aliasUrl(trim($data->name));
                if (Input::hasFile('image')) {
                    if (!file_exists('public/uploads/product')) {
                        File::makeDirectory('public/uploads/product');
                    }
                    if (!empty($data->image)) {
                        if (file_exists('public/uploads/product/' . $data->image)) {
                            File::delete(public_path() . '/uploads/product/' . $data->image);
                        }
                    }
                    $image = strtotime("now") + time() . rand() . "-" . str_replace(' ', '', Input::file('image')->getClientOriginalName());
                    $data->image = $image;
                    Input::file('image')->move('public/uploads/product', $image);
                }
                $data->save();
                Session::flash('success', $action . ' thành công');
                return Redirect::to('/admin/product/update/' . $data->id);
            }

        } catch (Exception $e) {
            Session::flash('warning', $e->getMessage());
            return Redirect::to('/admin/product/update/' . $id);
        }
    }


    public function banner_index()
    {
        $banner = Banner::orderby('id', 'desc')->get();
        return View::make('backend.banner.banner_index')->with('banners', $banner);
    }

    public function banner_update($id = 0)
    {
        $data = Banner::find($id);
        if ($data) {
            return View::make('backend.banner.banner_update')->with('data', $data);
        } else {
            $data = new Banner();
            return View::make('backend.banner.banner_update')->with('data', $data);
        }
    }

    public function banner_update_post($id = 0)
    {
        try {
            $input = Input::All();
            $values = array(
                'title' => 'required',
                'link' => 'required',
                'type' => 'required',
            );
            $validator = Validator::make($input, $values);
            if ($validator->fails()) {
                return Redirect::to('/admin/banner/update/' . $id)->withErrors($validator);
            } else {
                $data = new Banner();
                $action = 'Tạo mới banner';
                if ($id > 0) {
                    $data = Banner::find($id);
                    $action = 'Cập nhật banner';
                }
                $data->title = mb_strtolower($input['title'], 'UTF-8');;
                $data->link = $input['link'];
                $data->type = $input['type'];
                if (Input::hasFile('image')) {
                    if (!file_exists('public/uploads/banner')) {
                        File::makeDirectory('public/uploads/banner');
                    }
                    if (!empty($data->image)) {
                        if (file_exists('public/uploads/banner/' . $data->image)) {
                            File::delete(public_path() . '/uploads/banner/' . $data->image);
                        }
                    }
                    $image = strtotime("now") + time() . rand() . "-" . str_replace(' ', '', Input::file('image')->getClientOriginalName());
                    $data->image = $image;
                    Input::file('image')->move('public/uploads/banner', $image);
                }
                $data->save();
                Session::flash('success', $action . ' thành công');
                return Redirect::to('/admin/banner/update/' . $data->id);
            }

        } catch (Exception $e) {
            Session::flash('warning', $e->getMessage());
            return Redirect::to('/admin/banner/update/' . $id);
        }
    }

    public function discount_index()
    {
        $discount = Discount::orderby('id', 'desc')->get();
        return View::make('backend.discount.discount_index')->with('discount', $discount);
    }

    public function discount_update($id = 0)
    {
        $data = Discount::find($id);
        if ($data) {
            return View::make('backend.discount.discount_update')->with('data', $data);
        } else {
            $data = new Discount();
            return View::make('backend.discount.discount_update')->with('data', $data);
        }
    }

    public function discount_update_post($id = 0)
    {
        try {
            $input = Input::All();
            $values = array(
                'name' => 'required',
                'codeevent' => 'required',
                'quantity' => 'required',
                'startdate' => 'required',
                'enddate' => 'required',
                'type' => 'required',
                'price' => 'required',
            );
            $validator = Validator::make($input, $values);
            if ($validator->fails()) {
                return Redirect::to('/admin/discount/update/' . $id)->withErrors($validator);
            } else {
                $data = new Discount();
                $action = 'Tạo mới phiếu giảm giá';
                if ($id > 0) {
                    $data = Discount::find($id);
                    $action = 'Cập nhật phiếu giảm giá';
                }
                list($day, $month, $year) = explode('/', $input['startdate']);
                $startdate = Carbon::create($year, $month, $day, 0, 0, 0);
                list($day, $month, $year) = explode('/', $input['enddate']);
                $enddate = Carbon::create($year, $month, $day, 23, 59, 0);
                $data->name = mb_strtolower($input['name'], 'UTF-8');;
                $data->codeevent = strtoupper($input['codeevent']);
                $data->type = $input['type'];
                $data->quantity += $input['quantity'];
                $data->price = $input['price'];
                $data->startdate = $startdate;
                $data->enddate = $enddate;
                $data->save();

                for ($i = 1; $i <= $input['quantity']; $i++) {
                    $datacode = new Discountcode();
                    $datacode->discountid = $data->id;
                    $datacode->code = FcHelper::getAvailableCode($data->codeevent, $data->id);
                    $datacode->isused = 0;
                    $datacode->save();
                }
                Session::flash('success', $action . ' thành công');
                return Redirect::to('/admin/discount/update/' . $data->id);
            }
        } catch (Exception $e) {
            Session::flash('warning', $e->getMessage());
            return Redirect::to('/admin/discount/update/' . $id);
        }
    }

    public function discount_code($id)
    {
        $discount = Discount::join('discountcode', 'discountcode.discountid', '=', 'discount.id')
            ->select('discount.name', 'discountcode.code', 'discount.codeevent', 'discountcode.isused')
            ->where('discount.id', $id)->orderby('discount.id', 'desc')->get();
        return View::make('backend.discount.discount_code')->with('discount', $discount);
    }


    public function blog_index()
    {
        $blogs = Blog::orderby('id', 'desc')->get();
        return View::make('backend.blog.blog_index')->with('blogs', $blogs);
    }

    public function blog_update($id = 0)
    {
        $data = Blog::find($id);
        if ($data) {
            return View::make('backend.blog.blog_update')->with('data', $data);
        } else {
            $data = new Blog();
            return View::make('backend.blog.blog_update')->with('data', $data);
        }
    }

    public function blog_update_post($id = 0)
    {
        try {
            $input = Input::All();
            $values = array(
                'title' => 'required',
                'summary' => 'required',
            );
            $validator = Validator::make($input, $values);
            if ($validator->fails()) {
                return Redirect::to('/admin/blog/update/' . $id)->withErrors($validator);
            } else {
                $data = new Blog();
                $action = 'Tạo mới blog';
                if ($id > 0) {
                    $data = Blog::find($id);
                    $action = 'Cập nhật blog';
                }
                $data->title = mb_strtolower($input['title'], 'UTF-8');;
                $data->tags = $input['tags'];
                $data->summary = $input['summary'];
                $data->description = $input['description'];
                $data->alias = FcHelper::aliasUrl(trim($data->title));
                if (Input::hasFile('image')) {
                    if (!file_exists('public/uploads/blog')) {
                        File::makeDirectory('public/uploads/blog');
                    }
                    if (!empty($data->image)) {
                        if (file_exists('public/uploads/blog/' . $data->image)) {
                            File::delete(public_path() . '/uploads/blog/' . $data->image);
                        }
                    }
                    $image = strtotime("now") + time() . rand() . "-" . str_replace(' ', '', Input::file('image')->getClientOriginalName());
                    $data->image = $image;
                    Input::file('image')->move('public/uploads/blog', $image);
                }
                $data->save();
                Session::flash('success', $action . ' thành công');
                return Redirect::to('/admin/blog/update/' . $data->id);
            }

        } catch (Exception $e) {
            Session::flash('warning', $e->getMessage());
            return Redirect::to('/admin/blog/update/' . $id);
        }
    }

    public function sales()
    {
        $data = Configdat::where('type', 'event')->first();
        $data->data = json_decode($data->data);
        $product = Product::orderby('id', 'desc')->get();
        return View::make('backend.discount.sales')->with('data', $data)->with('product', $product);
    }

    public function sales_post()
    {
        try {
            $input = Input::All();
            $values = array(
                'title' => 'required',
            );
            $validator = Validator::make($input, $values);
            if ($validator->fails()) {
                return Redirect::to('/admin/sales')->withErrors($validator);
            } else {
                $data = Configdat::where('type', 'event')->first();
                $data->title = mb_strtolower($input['title'], 'UTF-8');;
                $data->data = json_encode($input['productid']);
                $data->summary = $input['summary'];
                list($day, $month, $year) = explode('/', $input['startdate']);
                $startdate = Carbon::create($year, $month, $day, 0, 0, 0);
                list($day, $month, $year) = explode('/', $input['enddate']);
                $enddate = Carbon::create($year, $month, $day, 23, 59, 0);

                $data->startdate = $startdate;
                $data->enddate = $enddate;
                if (Input::hasFile('image')) {
                    if (!file_exists('public/uploads/config')) {
                        File::makeDirectory('public/uploads/config');
                    }
                    if (!empty($data->image)) {
                        if (file_exists('public/uploads/config/' . $data->image)) {
                            File::delete(public_path() . '/uploads/config/' . $data->image);
                        }
                    }
                    $image = strtotime("now") + time() . rand() . "-" . str_replace(' ', '', Input::file('image')->getClientOriginalName());
                    $data->image = $image;
                    Input::file('image')->move('public/uploads/config', $image);
                }
                $data->save();
                Session::flash('success', 'cập nhật thành công');
                return Redirect::to('/admin/sales');
            }

        } catch (Exception $e) {
            Session::flash('warning', $e->getMessage());
            return Redirect::to('admin/sales');
        }
    }

    public function order()
    {
        $order = Cartdb::join('addressship', 'addressship.cartid', '=', 'cart.id')
            ->select('cart.*', 'addressship.name', 'addressship.phone')->orderby('cart.created_at', 'desc')->get();
        return View::make('backend.order.order')->with('order', $order);
    }

    public function order_update_status()
    {
        $input = Input::All();
        $cart = Cartdb::find($input['id']);
        $cart->status = $input['status'];
        $cart->save();
        $strstatus = "";
        switch ($cart->status) {
            case "pending":
                $strstatus = "Chờ duyệt đơn hàng";
                break;
            case "confirm":
                $strstatus = "Đang giao hàng";
                break;
            case "complete":
                $strstatus = "Đã giao hàng";
                break;
            case "cancel":
                $strstatus = "Hủy đơn hàng";
                break;
            default:
                $strstatus = "Chờ duyệt đơn hàng";
                break;
        }
        return Response::json(array('status' => true, 'str' => $strstatus));
    }

    public function orderdetail($id)
    {

        $order = Cartdb::join('addressship', 'addressship.cartid', '=', 'cart.id')->where('cart.id', $id)
            ->select('cart.*', 'addressship.name', 'addressship.phone', 'addressship.email', 'addressship.city', 'addressship.district', 'addressship.address')->orderby('cart.created_at', 'desc')->first();
        $product = CartProduct::join('product', 'product.id', '=', 'cartproduct.productid')->where('cartproduct.cartid', $id)
            ->select('product.image', 'product.name', 'cartproduct.price', 'cartproduct.quantity')->get();
        return View::make('backend.order.orderdetail')->with('order', $order)->with('product', $product);
    }

    public function setup()
    {
        $data = Configdat::where('type', 'event')->first();
        return View::make('backend.home.setup')->with('data', $data);
    }

    public function setup_post()
    {
        $input = Input::All();
        $data = Configdat::where('type', 'event')->first();
        $data->facebook = $input['facebook'];
        $data->email = $input['email'];
        $data->phone = $input['phone'];
        $data->address = $input['address'];
        $data->aboutus = $input['aboutus'];
        $data->password = $input['password'];
        if (Input::hasFile('logo')) {

            if (!empty($data->logo)) {
                if (file_exists('public/uploads/logo/' . $data->logo)) {
                    File::delete(public_path() . '/uploads/logo/' . $data->logo);
                }
            }
            $image = 'logo.png';
            $data->logo = $image;
            Input::file('logo')->move('public/uploads/logo', $image);
        }
        if (Input::hasFile('favicon')) {
            if (!file_exists('public/uploads/logo')) {
                File::makeDirectory('public/uploads/logo');
            }
            if (!empty($data->favicon)) {
                if (file_exists('public/uploads/logo/' . $data->favicon)) {
                    File::delete(public_path() . '/uploads/logo/' . $data->favicon);
                }
            }
            $image = 'favicon.ico';
            $data->favicon = $image;
            Input::file('favicon')->move('public/uploads/logo', $image);
        }
        $data->titleweb = $input['titleweb'];
        $data->description = $input['description'];
        $data->keyword = $input['keyword'];
        $data->save();
        Session::flash('success', 'Cập nhật thành công');
        return View::make('backend.home.setup')->with('data', $data);
    }

    public function newsletter()
    {
        $emails = Configdat::where('type', 'newsletter')->get();
        return View::make('backend.home.newsletter')->with('emails', $emails);
    }

    public function customer()
    {
        $data = User::where('role', '!=', 1)->get();
        return View::make('backend.home.customer')->with('data', $data);
    }

    public function profile()
    {
        $data = User::find(4);
        return View::make('backend.home.profile')->with('data', $data);
    }

    public function profile_post()
    {
        $input = Input::all();
        $values = array(
            'email' => 'required|email',
            'password' => 'required|min:6'
        );
        $messages = [
            'email.unique' => 'Email này đã có người đăng ký.',
            'email.required' => 'Vui lòng nhập email đăng ký.',
            'password.min' => 'Mật khẩu ít nhất 6 ký tự.',
        ];
        $validator = Validator::make($input, $values, $messages);
        if ($validator->fails()) {
            return Redirect::to('/admin/update/profile')->withErrors($validator);
        } else {
            $user = User::find(4);
            $user->email = $input['email'];
            $user->password = Hash::make($input['password']);
            $user->save();
            Session::flash('success', 'Cập nhật thành công');
            return Redirect::to('/admin/update/profile');
        }
    }

    public function shipping()
    {
        $province = $this->getshipping();
        return View::make('backend.home.shipping')->with('data', $province);
    }

    public function getshipping()
    {
        $province = Province::whereNull('idparent')->get();
        $province = $this->addRelationShipping($province);
        return $province;
    }

    protected function selectChildShipping($id)
    {
        $province = Province::where('idparent', $id)->get();
        $province = $this->addRelationShipping($province);
        return $province;
    }

    protected function addRelationShipping($province)
    {
        $province->map(function ($item, $key) {
            $sub = $this->selectChildShipping($item->id);
            return $item = array_add($item, 'subprovince', $sub);
        });
        return $province;
    }

    public function shipping_post()
    {
        $input = Input::All();
        $data = Province::Find($input['id']);
        $data->price = $input['price'];
        $data->timeshipping = $input['timeshipping'];
        $data->save();
        $parent = Province::where('idparent', $data->id)->get();
        if (count($parent) > 0) {
            foreach ($parent as $item) {
                $item->price = $input['price'];
                $item->timeshipping = $input['timeshipping'];
                $item->save();
            }
        }
        Session::flash('success', 'Cập nhật thành công');
        return Redirect::to('/admin/shipping');
    }

    public function product_delete_post($id)
    {
        $data = Product::find($id);
        if ($data) {
            if (!empty($data->image)) {
                if (file_exists('public/uploads/product/' . $data->image)) {
                    File::delete(public_path() . '/uploads/product/' . $data->image);
                }
            }
            $data->delete();
        }
        Session::flash('success', 'xóa sản phẩm thành công');
        return Redirect::to('/admin/product');
    }

    public function order_delete_post($id)
    {
        $data = Cartdb::find($id);
        if ($data) {
            CartProduct::where('cartid', $data->id)->delete();
            AddressShip::where('cartid', $data->id)->delete();
            $data->delete();
        }
        Session::flash('success', 'xóa đơn hàng thành công');
        return Redirect::to('/admin/order');
    }
    public function banner_delete_post($id){
        $data = Banner::find($id);
        if ($data) {
            if (!empty($data->image)) {
                if (file_exists('public/uploads/banner/' . $data->image)) {
                    File::delete(public_path() . '/uploads/banner/' . $data->image);
                }
            }
            $data->delete();
        }
        Session::flash('success', 'xóa banner thành công');
        return Redirect::to('/admin/banner');
    }
}
