<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Image;
use Auth;
class HomeController extends Controller
{
public function __construct(){
    $this->middleware('auth');
}

    public function HomeSlider(){
       $sliders = Slider::latest()->get();
        return view('admin.slider.index',compact('sliders'));
    }
    public function AddSlider(){

        return view('admin.slider.create');
    }
 public function StoreSlider(Request $request){
     $validatedData = $request->validate([
        'title'=>'required',
        'description'=>'required',
        'image'=> 'required'
     ]);
     $slider_image = $request->file('image');
     $name_generate = hexdec(uniqid()).'.'.$slider_image->getClientOriginalExtension();
     Image::make($slider_image)->resize(1920,1088)->save('image/slider/'.$name_generate);
     $last_image = 'image/slider/'.$name_generate;

    //  $slider = new Slider;
    //  $slider->title = $request->title;
    //  $slider->description= $request->description;
    //  $slider->image = $last_image;
    //  $slider->save();
    Slider::insert([
        'title'=>$request->title,
        'description'=>$request->description,
        'image'=>$last_image
    ]);

    $notification = array(
        'message'=> 'The Slide Is Added Successfully.',
        'alert-type'=>'success'
        );

     return Redirect()->route('home.slider')->with($notification);
 }   
 public function EditSlider($id){
     $sliders = Slider::find($id);
     return view('admin.slider.edit',compact('sliders'));
 }

 public function UpdateSlider(Request $request ,$id){
    $validatedData = $request->validate([
    'image.min'=>'Slider Longer then 4 Character.'
    ]);
    $old_image = $request->old_image; 
    $image = $request->file('image');

    if($image){
        $slider_image = $request->file('image');
        $name_generate = hexdec(uniqid()).'.'.$slider_image->getClientOriginalExtension();
        Image::make($slider_image)->resize(1920,1088)->save('image/slider/'.$name_generate);
        $last_image = 'image/slider/'.$name_generate;
   
        unlink($old_image);
        Slider::find($id)->update([
        'title'=>$request->title,
        'description'=>$request->description,
        'image'=>$last_image
        ]);

        $notification = array(
            'message'=> 'The Slide Is Updated Successfully.',
            'alert-type'=>'info'
            );
       return Redirect()->route('home.slider')->with($notification);
    }else{
        Slider::find($id)->update([
            'title'=>$request->title,
            'description'=>$request->description
            ]);

            $notification = array(
                'message'=> 'The Slide Is Updated Successfully.',
                'alert-type'=>'info'
                );
           return Redirect()->route('home.slider')->with($notification);
    }

 }
public function Delete($id){

    $image_delete = Slider::find($id);
    $old_img=$image_delete->image;
    unlink($old_img);

    Slider::find($id)->delete();

    $notification = array(
        'message'=> 'The Slide Is Deleted Successfully.',
        'alert-type'=>'error'
        );
   return Redirect()->route('home.slider')->with($notification);
    return Redirect()->back()->with($notification);
}


}
