<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Order;
use Session;
use Stripe;
use App\Models\Comment;
use App\Models\Reply;
use RealRashid\SweetAlert\Facades\Alert;



class HomeController extends Controller
{
    public function index()
    {   if (Auth::id()) 
        {
        $id = Auth::user()->id;
        $cart_count = cart::where('user_id','=',$id)->count();
         }else{
            $cart_count = 0;
         }
        $active = 'home'; 
        $products = Product::paginate(9);
        $comments = Comment::orderby('id','desc')->get();
        $reply = Reply::all();

        return view('home.userpage',compact('products','comments','reply','active','cart_count'));
    }

   public function redirect() 
   {
    $usertype = Auth::user()->usertype;

    if ($usertype == 1) 
    {
        $total_product = Product::all()->count();
        $total_orders = Order::all()->count();
        $total_customers = User::all()->count();

        $orders=Order::all();
        $total_revenue = 0;

        foreach($orders as $order) 
        {
            $total_revenue = $total_revenue + $order->price; 
        }

        $total_delivered = Order::where('delivery_status','=','delivered')->get()->count();
        $total_processing = Order::where('delivery_status','=','processing')->get()->count();

        return view('admin.home',compact('total_product','total_orders','total_customers','total_revenue','total_delivered','total_processing'));
    }else {
        $id = Auth::user()->id;
        $cart_count = cart::where('user_id','=',$id)->count();
        $active = 'home'; 
        $products = Product::paginate(9);
        $comments = Comment::orderby('id','desc')->get();
        $reply = Reply::all();
        
        return view('home.userpage',compact('products','comments','reply','active','cart_count'));
    }    
   }


   public function product_details(Request $request,$id) 
   {
    
    $active = 'products';
    $product = Product::find($id);

    if (Auth::id()) 
        {
        $id = Auth::user()->id;
        $cart_count = cart::where('user_id','=',$id)->count();
         }else{
            $cart_count = 0;
         }    

    return view('home.product_details',compact('product','active','cart_count'));
   }


   public function add_cart(Request $request,$id) 
   {
        if(Auth::id())
        {
           $user = Auth::user();
           $product = Product::find($id); 

           $userId = $user->id;


           $product_exist_id = Cart::where('product_id','=',$id)->where('user_id','=',$userId)->get('id')->first();

           if ($product_exist_id) {
                $cart = cart::find($product_exist_id)->first();
                $quantity = $cart->quantity;
                $cart->quantity = $quantity + $request->quantity;
                
                if ($product->discount_price != null) {
                    $cart->price = $product->discount_price * $cart->quantity;
                }else{
               $cart->price = $product->price * $cart->quantity;
                }

                $cart->save();


                return redirect()->back()->with('message','Product added in to cart.');

           }else{

                $cart = new Cart();

                $cart->name = $user->name;
                $cart->email = $user->email;
                $cart->phone = $user->phone;
                $cart->address = $user->address;
                $cart->product_title = $product->title;

                if ($product->discount_price != null) {
                    $cart->price = $product->discount_price * $request->quantity;
                }else{
               $cart->price = $product->price * $request->quantity;
                }
           
                $cart->quantity = $request->quantity;
                $cart->image = $product->image;
                $cart->product_id = $product->id;
                $cart->user_id = $user->id;

                $cart->save();


                Alert::success('Product Added Successfully','We have added product to the cart');
                return redirect()->back();

                }


        }else{

            return redirect('login');
        }
        
   }

   public function show_cart()
   {
    if (Auth::id()) {
        $active = 'cart';
        $id = Auth::user()->id;
        $cart_count = cart::where('user_id','=',$id)->count();
        $cart = cart::where('user_id','=',$id)->get();
        

        return view('home.show_cart',compact('cart','active','cart_count'));
    }else{

    return redirect('login');
    }
   }

   public function remove_cart($id)
   {
    $product = Cart::find($id);

    $product->delete();

    return redirect()->back()->with('message','Product remove from cart.');
   }

   public function cash_order()
   {
        $user = Auth::user();

        $user_id = $user->id;
        $data = Cart::where('user_id','=',$user_id)->get();

        foreach($data as $data) 
        {
            $order = new Order();

            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->user_id;
            $order->product_title = $data->product_title;
            $order->quantity = $data->quantity;
            $order->price = $data->price;
            $order->image = $data->image;
            $order->product_id = $data->product_id;
            $order->payment_status = 'cash on delivery';
            $order->delivery_status = 'processing';

            $order->save();

            $cart_id = $data->id;
            $cart = Cart::find($cart_id);
            $cart->delete();


        }

        return redirect()->back()->with('message','We have Recived your Order. We Will connect with you soon...');

   }

   public function stripe($totalPrice)
   {
        return view('home.stripe',compact('totalPrice'));
   }

   public function stripePost(Request $request,$totalPrice)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
        Stripe\Charge::create ([
                "amount" => $totalPrice * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Thanks for payment." 
        ]);

        $user = Auth::user();

        $user_id = $user->id;
        $data = Cart::where('user_id','=',$user_id)->get();

        foreach($data as $data) 
        {
            $order = new Order();

            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->user_id;
            $order->product_title = $data->product_title;
            $order->quantity = $data->quantity;
            $order->price = $data->price;
            $order->image = $data->image;
            $order->product_id = $data->product_id;
            $order->payment_status = 'Paid';
            $order->delivery_status = 'processing';

            $order->save();

            $cart_id = $data->id;
            $cart = Cart::find($cart_id);
            $cart->delete();


        }
      
        // Session::flash('success', 'Payment successful!');
              
        // return back();
        return redirect('/show_cart')->with('message','Thank You For Paying. We have Recived your Order. We Will connect with you soon...');
    }

    public function show_order() 
    {
        if (Auth::id()) 
        {
            $id = Auth::user()->id;
            $cart_count = cart::where('user_id','=',$id)->count();
            $active = 'orders';
            $user = Auth::user();
            $user_id = $user->id;

            $orders = Order::where('user_id','=',$user_id)->get();
            
            return view('home.order',compact('orders','active','cart_count'));
        }else{
            return redirect('login');
        }
    }

    public function cancel_order($id)
    {
        $order = order::find($id);

        $order->delivery_status = 'You canceled the order';


        $order->save();



        return redirect()->back()->with('message','You canceled the order !!');
    }

    public function add_comment(Request $request)
    {   
        if (Auth::id()) {

            $user = Auth::user();
            $comment = new Comment;

            $comment->name = $user->name;
            $comment->comment = $request->comment;
            $comment->user_id = $user->id;

            $comment->save();

            return redirect()->back();

        }else{
            return redirect('login');
        }
        
    }

    public function add_reply(Request $request)
    {
        if (Auth::id()) {
            $reply = new Reply;

            $reply->name = Auth::user()->name;
            $reply->user_id = Auth::user()->id;
            $reply->comment_id = $request->commentId;
            $reply->reply = $request->reply;

            $reply->save();

            return redirect()->back();
            
        }else{
            return redirect('login');
        }
    }

    public function product_search(Request $request) 
    {   
        if (Auth::id()) 
        {
        $id = Auth::user()->id;
        $cart_count = cart::where('user_id','=',$id)->count();
         }else{
            $cart_count = 0;
         }
        $active = 'products';
        $comments = Comment::orderby('id','desc')->get();
        $reply = Reply::all();

        $search_text = $request['search'];

        $products = Product::where('title','LIKE',"%$search_text%")->orWhere('category','LIKE',"%$search_text")->paginate(9); 

        return view('home.userpage', compact('products','comments','reply','active','cart_count'));
    }

    public function products()
    {
        if (Auth::id()) 
        {
        $id = Auth::user()->id;
        $cart_count = cart::where('user_id','=',$id)->count();
         }else{
            $cart_count = 0;
         }
        $active = 'products';
        $comments = Comment::orderby('id','desc')->get();
        $reply = Reply::all();

        $products = Product::paginate(9);
        
        return view('home.all_product',compact('products','comments','reply','active','cart_count'));
    }

    public function search_product(Request $request) 
    {   

        if (Auth::id()) 
        {
        $id = Auth::user()->id;
        $cart_count = cart::where('user_id','=',$id)->count();
         }else{
            $cart_count = 0;
         }
        $active = 'products';
        $comments = Comment::orderby('id','desc')->get();
        $reply = Reply::all();

        $search_text = $request['search'];

        $products = Product::where('title','LIKE',"%$search_text%")->orWhere('category','LIKE',"%$search_text")->paginate(9); 
        

        return view('home.all_product', compact('products','comments','reply','active','cart_count'));
    }

    public function about()
    {   
        if (Auth::id()) 
        {
        $id = Auth::user()->id;
        $cart_count = cart::where('user_id','=',$id)->count();
         }else{
            $cart_count = 0;
         }
        $active = 'about';
        return view('home.about',compact('active','cart_count'));
    }

     public function blog()
    {   
         if (Auth::id()) 
        {
        $id = Auth::user()->id;
        $cart_count = cart::where('user_id','=',$id)->count();
         }else{
            $cart_count = 0;
         }
        $active = 'blog';
        return view('home.blog',compact('active','cart_count'));
    }

     public function contact()
    {   
         if (Auth::id()) 
        {
        $id = Auth::user()->id;
        $cart_count = cart::where('user_id','=',$id)->count();
         }else{
            $cart_count = 0;
         }
        $active = 'contact';
        return view('home.contact',compact('active','cart_count'));
    }

  
   

}
