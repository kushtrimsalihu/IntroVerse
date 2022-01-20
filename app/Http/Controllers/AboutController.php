<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeAbout;
use App\Models\Multipic;
use Illuminate\Support\Carbon;
use Auth;


class AboutController extends Controller
{
    public function __construc(){
       $this->middleware('auth');
    }
    public function HomeAbout(){
        $homeabout = HomeAbout::latest()->get();
        return view('admin.home.index',compact('homeabout'));
    }
    public function Create(){
        return view('admin.home.create');
    }
    public function Store(Request $request){
        $homeabout = new HomeAbout;
        $homeabout->title = $request->title;
        $homeabout->short_description = $request->short_description;
        $homeabout->long_description = $request->long_description;
        $homeabout->created_at = Carbon::now();
        $homeabout->save();

        // HomeAbout::insert([
        // 'title'=>$request->title,
        // 'short_description' => $request->short_description,
        // 'long_description' => $request->long_description,
        // 'created_at' => Carbon::now()
        // ]);

        $notification = array(
            'message'=> 'Home About Data Added Successfully.',
            'alert-type'=>'success'
            );

        return Redirect()->route('home.about')->with($notification);
    }


    public function Edit($id){
        $homeabout=HomeAbout::find($id);
        return view('admin.home.edit',compact('homeabout'));
    }
public function Update(Request $request ,$id){
    HomeAbout::find($id)->update([
        'title'=>$request->title,
        'short_description' => $request->short_description,
        'long_description' => $request->long_description,
        'created_at' => Carbon::now()
    ]);

    $notification = array(
        'message'=> 'Home About Data Updated Successfully.',
        'alert-type'=>'success'
        );
    return Redirect()->route('home.about')->with($notification);
}
public function Delete($id){
    HomeAbout::find($id)->delete();

    $notification = array(
        'message'=> 'Home About Data Deleted Successfully.',
        'alert-type'=>'error'
        );
    return Redirect()->route('home.about')->with($notification);
}

public function Portfolio(){
    $images = Multipic::all();
    return view('pages.portfolio',compact('images'));
}
}
