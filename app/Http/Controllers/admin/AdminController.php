<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Notifications\SendEmailNotification;
use Notification;
use Illuminate\Http\Request;
use Session;
use PDF;
use Auth;

class AdminController extends Controller
{
    // category related function is here
    public function viewCategory(){
        $data = Category::all();
        return view('admin.category.category',compact('data'));
    }
    public function addCategory(Request $request){
        $data = new Category();
        $data->category_name = $request->category_name;
        $data->save();
        return redirect()->back()->with('success',"Category Created Successfully");
    }
    public function deleteCategory($id){
        $data = Category::find($id);
        $data->delete();
        return redirect()->back()->with('success','Category Deleted Successfully');
    }

    // product related function is here
    public function viewProduct(){
        $category = Category::all();
        return view('admin.product.product',compact('category'));
    }
    public function addProduct(Request $request)
    {
        $product = new Product;
        $product->title = $request->title;
        $product->description =$request->description;
        $product->category = $request->category;
        $image=$request->image;
        $imagename=time().'.'.$image->getClientOriginalExtension();
        $request->image->move('images/product', $imagename);
        $product->image= $imagename;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->save();
        return redirect()->back()->with('success','Product Added Successfully');
    }

    public function showProduct(){
        $product = Product::all();
        return view('admin.product.show_product',compact('product'));
    }

    public function updateProduct($id){
        $product = Product::find($id);
        $category = Category::all();
        return view('admin.product.update_product',compact('product','category'));
    }
    public function updateProductStore(Request $request,$id){
        $product = Product::find($id);
        $product->title = $request->title;
        $product->description = $request->description;
        $product->category = $request->category;
        $image = $request->image;
        $imagename = time() . '.' . $image->getClientOriginalExtension();
        $request->image->move('images/product', $imagename);
        $product->image = $imagename;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->save();
        return redirect()->back()->with('success', 'Product Updated Successfully');
    }

    public function deleteProduct($id){
        $deleteData = Product::find($id);
        if (file_exists('images/product/'.$deleteData->image) and !empty($deleteData->image)) {
            unlink('images/product/'.$deleteData->image);
        }
        $deleteData->delete();
        return redirect()->back()->with('success', 'Product Deleted Successfully');
    }

    // order related function
    public function order(){
        $orders = Order::all();
        return view('admin.order.order',compact('orders'));
    }
    public function delivered($id){
        $order = Order::find($id);
        $order->delivery_status="delivered";
        $order->payment_status="PAID";
        $order->save();
        return redirect()->back();
    }

    public function printPdf($id){
        $order = Order::find($id);
        $pdf = PDF::loadView('admin.pdf.pdf',compact('order'));
        return $pdf->download('order_details.pdf');

    }

    //send email to user
    public function sendEmail($id){
        $order = Order::find($id);
        return view('admin.email.email_info',compact('order'));
    }
    public function sendUserEmail(Request $request,$id){
        $order = Order::find($id);
        $details = [
            'greeting'=> $request->greeting,
            'firstline'=> $request->firstline,
            'body'=> $request->body,
            'button'=> $request->button,
            'url'=> $request->url,
            'lastline'=> $request->lastline,
        ];
        Notification::send($order, new SendEmailNotification($details));
        return redirect()->back()->with('success', 'Notification Send To User Successfully');
    } 
    
    //search function
    public function searchData(Request $request){
        $searchText = $request->search;
        //search by name
        //$orders = Order::where('name','LIKE',"%$searchText%")->get();
        //search by name,phone and product_title
        $orders = Order::where('name','LIKE',"%$searchText%")->orWhere('phone','LIKE', "%$searchText%")->orWhere('product_title','LIKE',"%$searchText%")->get();
        return view('admin.order.order',compact('orders'));
    }
    
    //user orders related function
    public function showOrder(){
        if(Auth::id()){
            $user = Auth::user();
            $userId = $user->id;
            $order = Order::where('user_id','=',$userId)->get();
            return view("home.order",compact('order'));
        }else{
            return redirect('login');
        }
    }
    public function cancelOrder($id){
        $order = Order::find($id);
        $order->delivery_status='You cancel the order';
        $order->save();
        return redirect()->back();
    }
}

