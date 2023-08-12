<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\category;
use Illuminate\Http\Request;
use Session;

class AdminController extends Controller
{
    public function viewCategory(){
        return view('admin.category.category');
    }
    public function addCategory(Request $request){
        $data = new category();
        $data->category_name = $request->category_name;
        $data->save();
        return redirect()->back()->with('success',"Category Created Successfully");
    }
}
