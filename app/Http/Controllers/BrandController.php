<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Multipic;
use Illuminate\Support\Carbon;
use Auth;
use Image;

class BrandController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function AllBrand(){
        $brands = Brand::latest()->paginate(5);
        return view('admin.brand.index',compact('brands'));
    }

public function StoreBrand(Request $request){
    $validatedData = $request->validate([
        'brand_name'=>'required|min:4',
        'brand_image'=> 'required|mimes:jpg,jpeg,png'
    ],[
        'brand_name.required'=>'Please write Brand Name.',
        'brand_image.min'=>'Brand Longer then 4 Character.'
    ]);

    $brand_image = $request->file('brand_image');

    // $name_generate = hexdec(uniqid());
    // $img_ext = strtolower($brand_image->getClientOriginalExtension());
    // $img_name = $name_generate.'.'.$img_ext;
    // $upload_location = 'image/brand/';
    // $last_image = $upload_location.$img_name;
    // $brand_image->move($upload_location,$img_name);

    $name_generate = hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
    Image::make($brand_image)->resize(300,200)->save('image/brand/'.$name_generate);

    $last_image= 'image/brand/'.$name_generate;


    Brand::insert([
    'brand_name'=>$request->brand_name,
    'brand_image'=>$last_image,
    'created_at'=>Carbon::now()
    ]);
   $notification = array(
    'message' => 'Brand Image Added Successfully.',
    'alert-type'=>'success'
   );
    return Redirect()->back()->with($notification);
}
public function Edit($id){
   $brands = Brand::find($id);
   return view('admin.brand.edit',compact('brands'));
}

public function Update(Request $request, $id){
    $validatedData = $request->validate([
        'brand_name'=>'required|min:4',
    ],[
        'brand_name.required'=>'Please write Brand Name.',
        'brand_image.min'=>'Brand Longer then 4 Character.'
    ]);

    $old_image = $request->old_image; 
    $brand_image = $request->file('brand_image');

    if($brand_image){
        $name_generate = hexdec(uniqid());
        $img_ext = strtolower($brand_image->getClientOriginalExtension());
        $img_name = $name_generate.'.'.$img_ext;
        $upload_location = 'image/brand/';
        $last_image = $upload_location.$img_name;
        $brand_image->move($upload_location,$img_name);
    
        unlink($old_image);
        Brand::find($id)->update([
        'brand_name'=>$request->brand_name,
        'brand_image'=>$last_image,
        'created_at'=>Carbon::now()
        ]);
        $notification = array(
            'message' => 'Brand Updated Successfully.',
            'alert-type'=>'info'
           );
       return Redirect()->back()->with($notification);
    }else{
        Brand::find($id)->update([
            'brand_name'=>$request->brand_name,
            'created_at'=>Carbon::now()
            ]);
            $notification = array(
            'message'=> 'Brand Updated Successfully.',
            'alert-type'=>'info'
            );

           return Redirect()->back()->with($notification);
    }
}
public function Delete($id){
    $image_delete = Brand::find($id);
    $old_image = $image_delete->brand_image;
    unlink($old_image);

    Brand::find($id)->delete();
    $notification = array(
        'message'=> 'Brand Deleted Successfully.',
        'alert-type'=>'error'
        );
    return Redirect()->back()->with($notification);
    
}
//Multi Images
public function Multipic(){
    $images = Multipic::all();
    return view('admin.multipic.index',compact('images'));
}

public function StoreImages(Request $request){

    $image = $request->file('image');
    $validatedData = $request->validate([
    'image'=>'required'
    ]);

    foreach($image as $multi_img){

    $name_generate = hexdec(uniqid()).'.'.$multi_img->getClientOriginalExtension();
    Image::make($multi_img)->resize(300,300)->save('image/multi/'.$name_generate);

    $last_image= 'image/multi/'.$name_generate;


    Multipic::insert([
    'image'=>$last_image,
    'created_at'=>Carbon::now()
    ]);
}//end of foreach for multi images
$notification = array(
    'message'=> 'Brand Updated Successfully.',
    'alert-type'=>'success'
    );
   return Redirect()->back()->with($notification);

}
//End of Multi images

public function Logout(){
    Auth::logout();
    $notification = array(
        'message'=> 'Brand Updated Successfully.',
        'alert-type'=>'info'
        );
    return Redirect()->route('login')->with($notification);
}
}
