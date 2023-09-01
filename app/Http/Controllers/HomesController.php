<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\cr;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Stripe;

class HomesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(){
        $data['products']=Product::orderBy('id','desc')->paginate(3);
        return view('home.userpage',$data);
    }
    public function redirect()
    {
       $usertype = Auth::user()->usertype;
       if($usertype == '1'){
        $data['totalProduct']= Product::all()->count();
        $data['totalOrder']= Order::all()->count();
        $data['totalUser'] = User::all()->count();
        $order = Order::all();
        $totalRevenue=0;
        foreach($order as $order){
                $totalRevenue = $totalRevenue + $order->price;
        }
        $data['totalDelivered'] = Order::where('delivery_status','=','delivered')->get()->count();
        $data['totalProcessing'] = Order::where('delivery_status','=', 'processing')->get()->count();
      
        return view('admin.partial.home',$data,compact('totalRevenue'));
       }
       else{
        $data['products']=Product::orderBy('id','desc')->paginate(3);
        return view('home.userpage', $data);
       }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function productDetails($id)
    {
        $product = Product::find($id);
        return view('home.product_details',compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function AddCart(Request $request,$id)
    {
        if(Auth::id()){
           $user = Auth::user();
           $product = Product::find($id);
           $cart = new Cart;
           $cart->name = $user->name;
           $cart->email = $user->email;
           $cart->phone = $user->phone;
           $cart->address = $user->address;
           $cart->user_id = $user->id;
           $cart->product_title = $product->title;
           if($product->discount_price != null)
           {
            $cart->price=$product->discount_price * $request->quantity;
           }
           else
           {
            $cart->price = $product->price * $request->quantity;
           }
           $cart->image = $product->image;
           $cart->product_id = $product->id;
           $cart->quantity = $request->quantity;
           $cart->save();
           return redirect()->back();
        }else{
            return redirect('login');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function showCart()
    {
       if(Auth::id()){
            $id = Auth::user()->id;
            $carts = Cart::where('user_id', '=', $id)->get();
            return view('home.show_cart', compact('carts'));
       }
       else
       {
        return redirect('login');
       }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    // cash order function
    public function cashOnDelivery()
    {
        $user = Auth::user();
        $userId = $user->id;
        $data = Cart::where('user_id','=',$userId)->get();
        foreach($data as $data){
            $order = new order;
            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->user_id;
            $order->product_title = $data->product_title;
            $order->price = $data->price;
            $order->quantity = $data->quantity;
            $order->image = $data->image;
            $order->product_id = $data->product_id;
            $order->payment_status = 'Cash On Delivery';
            $order->delivery_status = 'processing';
            $order->save();
            $cart_id =  $data->id;
            $cart = Cart::find($cart_id);
            $cart->delete();
        }
        return redirect()->back()->with('success','You Have Received Your Order.We Will Contact You as soon as possible');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function stripe($totalPrice)
    {
        return view('home.stripe',compact('totalPrice'));
    }

    public function stripePost(Request $request, $totalPrice)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create([
            "amount" => $totalPrice * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Test payment from user"
        ]);
        $user = Auth::user();
        $userId = $user->id;
        $data = Cart::where('user_id', '=', $userId)->get();
        foreach ($data as $data) {
            $order = new order;
            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->user_id;
            $order->product_title = $data->product_title;
            $order->price = $data->price;
            $order->quantity = $data->quantity;
            $order->image = $data->image;
            $order->product_id = $data->product_id;
            $order->payment_status = 'PAID';
            $order->delivery_status = 'processing';
            $order->save();
            $cart_id =  $data->id;
            $cart = Cart::find($cart_id);
            $cart->delete();
        }

        Session::flash('success', 'Payment successful!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function removeCart($id)
    {
        $cart = Cart::find($id);
        $cart->delete();
        return redirect()->back();
    }
}
