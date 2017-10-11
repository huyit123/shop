<?php
use Carbon\Carbon;

class HomeController extends BaseController
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

    public function home()
    {
        $category = Category::where('parentid', 0)->orderby('orderby', 'asc')->take(3)->get();
        $dataevent = Configdat::where('type', 'event')->first();
        $event = '';
        $datenow = Carbon::now();
        if ($datenow >= $dataevent->startdate && $datenow <= $dataevent->enddate) {
            $event = $dataevent;
        }
        $blog = Blog::orderby('id', 'desc')->take(3)->get();
        $banner = Banner::orderby('id', 'desc')->get();
        return View::make('frontend.home.index')->with('category', $category)->with('event', $event)->with('blog', $blog)->with('banner', $banner);
    }

    public function getproduct_ajax()
    {
        $input = Input::All();
        $cat_id = $input['categoryid'];
        $product = Product::where('rootcategory', $cat_id)->where('featured_show', 0)->orderby('id', 'desc')->take(8)->get();
        return View::make('frontend..home.product_ajax')->with('product', $product);
    }

    public function getproductFeatured_ajax()
    {
        $product = Product::where('featured_show', 1)->orderByRaw("RAND()")->take(4)->get();
        return View::make('frontend..home.product_ajax')->with('product', $product);
    }

    public function product_view()
    {
        $input = Input::All();
        $categoryid = isset($input['categoryid']) ? $input['categoryid'] : '';
        $getproduct = Product::orderby('id', 'desc');
        if ($categoryid) {
            $getproduct = $getproduct->where('categoryid', $categoryid);
        }
        $count = clone $getproduct;
        $count = $count->select(DB::raw('count(*) as count'))->first()->count;
        $product = $getproduct->orderby('id', 'desc')->paginate(12);
        $categories = $this->getCategories();
        return View::make('frontend.home.product_view')->with('product', $product)->with('categories', $categories)->with('categoryid', $categoryid)->with('count', $count);
    }

    public function productdetail($name, $id)
    {
        $product = Product::join('category', 'category.id', '=', 'product.categoryid')->select('product.*', 'category.title as categoryname')
            ->where('product.id', $id)->first();
        $product->view += 1;
        $product->save();
        return View::make('frontend.home.detail')->with('product', $product);
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

    public function blog_view()
    {
        $blog = Blog::orderby('id', 'desc')->paginate(12);
        return View::make('frontend.blog.blog')->with('blog', $blog);
    }

    public function blogdetail($name, $id)
    {
        $blog = Blog::find($id);
        $blog->view += 1;
        $blog->save();
        return View::make('frontend.blog.detail')->with('blog', $blog);
    }

    public function product_sale()
    {
        $config_event = Configdat::where('type', 'event')->first()->data;
        $config_event = json_decode($config_event);
        $getproduct = Product::orderby('id', 'desc')->whereIn('id', $config_event);
        $count = clone $getproduct;
        $count = $count->select(DB::raw('count(*) as count'))->first()->count;
        $product = $getproduct->orderby('id', 'desc')->paginate(12);
        return View::make('frontend.home.product_sale')->with('product', $product)->with('count', $count);;
    }

    public function contact()
    {
        return View::make('frontend.home.contact');
    }

    public function contact_post()
    {
        $email = Configdat::where('type','event')->first()->email;
        $input = Input::All();
        $subject = $input['title'];
        $body = "<p> Họ và tên:" . $input['name'] . "</p><p> Email:" . $input['email'] . "</p>"."<p>" . $input['message'] . "</p>";
        FcHelper::ConfigMail();
        Mail::send([], [], function ($message) use ($subject,$body, $email) {
            $message->to($email, "")->subject($subject)->setBody($body, 'text/html');
        });
        Session::flash('success', 'Thông tin liên hệ của bạn đã được gửi thành công.');
        return Redirect::to('/lien-he');
    }
    public function newsletter()
    {
        $input = Input::All();
        $email = Configdat::where('type','newsletter')->where('data', $input['email'])->get();
        $ms = "";
        if(count($email)>0){
            $ms = "Email này đã được đăng ký";
        }else{
            $cf = new Configdat();
            $cf->type = "newsletter";
            $cf->data = $input['email'];
            $cf->save();
            $ms = "Đăng ký nhận tin thành công";
        }
        return Response::json($ms);
    }
}
