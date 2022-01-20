<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class CategoryController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function AllCat(){
// $categories = DB::table('categories')
// ->join('users','categories.user_id','users.id')
// ->select('categories.*','users.name')
// ->latest()->paginate(3);

        $categories = Category::latest()->paginate(5);
        $softDeleteCat = Category::onlyTrashed()->latest()->paginate(3);
        return view('admin.category.index',compact('categories','softDeleteCat'));
    }
    public function AddCat(Request $request){
        $validatedData = $request->validate([
           'category_name'=>'required|unique:categories'
        ],
        [
        'category_name.required'=>'Please write category name.'
    ]);

    // Category::insert([
    //     'category_name'=> $request->category_name,
    //     'user_id'=> Auth::user()->id,
    //     'created_at'=>Carbon::now()
    // ]);

        $category = new Category;
        $category->category_name = $request->category_name;
        $category->user_id = Auth::user()->id;
        $category->save();

        $notifications = array(
            'message'=>'Category Added Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notifications);
    }
    public function Edit($id){
        $categories = Category::find($id);
        // $categories = DB::table('categories')->where('id',$id)->first();
        return view('admin.category.edit',compact('categories'));
    }
    public function Update(Request $request, $id){
    $update = Category::find($id)->update([
    'category_name'=>$request->category_name,
    'user_id'=>Auth::user()->id
    ]);
    // $update = array();
    // $data ['category_name'] = $request->category_name;
    // $data['user_id'] = Auth::user()->id;
    // DB::table('categories')->where('id',$id)->update($data);

    $notifications = array(
        'message'=>'Category Name Updated Successfully',
        'alert-type'=>'success'
    );
    return Redirect()->route('all.category')->with($notifications);
    }

    public function SoftDelete($id){
        $delete = Category::find($id)->delete();

        $notifications = array(
            'message'=>'Category Soft Deleted Successfully',
            'alert-type'=>'warning'
        );
        return Redirect()->back()->with($notifications);
    }

    public function Restore($id){
        $delete = Category::withTrashed()->find($id)->restore();

        $notifications = array(
            'message'=>'Category Restored Successfully',
            'alert-type'=>'info'
        );
        return Redirect()->back()->with($notifications);
    
    }
    public function PrmDelete($id){
        $delete = Category::onlyTrashed()->find($id)->forceDelete();

        $notifications = array(
            'message'=>'Category Deleted Permanently Successfully',
            'alert-type'=>'error'
        );
        return Redirect()->back()->with($notifications);
    }
}