<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Carbon;
use DB;
use Auth;
class ServiceController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function HomeService(){
        $home_service = Service::latest()->get();
        return view('admin.service.index',compact('home_service'));
    }
    public function addService(){
        return view('admin.service.create');
    }
    public function storeService(Request $request){
        Service::insert([
            'icon' => $request->icon,
            'title' => $request->title,
            'short_description' => $request->short_description,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message'=>'The Home Service Data Added.',
            'alert-type' => 'success'
        );
        return Redirect()->route('home.service')->with($notification);
    }
    public function Edit($id){
        $home_service = Service::find($id);
        return view('admin.service.edit',compact('home_service'));
    }
    public function Update(Request $request, $id){
       Service::find($id)->update([
             'icon' => $request->icon,
            'title' => $request->title,
            'short_description' => $request->short_description,
            'created_at' => Carbon::now()
        ]);
        $notification = array(
            'message'=>'The Home Service Data Updated.',
            'alert-type' => 'success'
        );
        return Redirect()->route('home.service')->with($notification);
       
    }
    public function Delete($id){
        Service::find($id)->delete();

        $notification = array(
            'message'=>'The Home Service Data Deleted.',
            'alert-type' => 'warning'
        );
        return Redirect()->route('home.service')->with($notification);

    }
}
