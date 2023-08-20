<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Session;

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

    public function deleteProduct($id){
        $deleteData = Product::find($id);
        if (file_exists('images/product/'.$deleteData->image) and !empty($deleteData->image)) {
            unlink('images/product/'.$deleteData->image);
        }
        $deleteData->delete();
        return redirect()->back()->with('success', 'Product Deleted Successfully');
    }
}
