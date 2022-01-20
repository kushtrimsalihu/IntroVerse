<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\ContactForm;
use Illuminate\Support\Carbon;

use DB;
use Auth;


class ContactController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function AdminContact(){
        $contacts = Contact::all();
        $softD = Contact::onlyTrashed()->latest()->paginate(3);
        return view('admin.contact.index',compact('contacts','softD'));
    }
    public function AddContact(){
        return view('admin.contact.create');
    }
    public function StoreContact(Request $request){
        DB::table('contacts')->insert([
            'address' => $request->address,
            'email'=>$request->email,
            'phone' => $request->phone,
            'created_at' => Carbon::now()
        ]);
  
        $notification = array(
            'message'=>'Contact Data added successfully.',
            'alert-type' => 'success'
        );
        return Redirect()->route('admin.contact')->with($notification);
       

    }

    public function EditContact($id){
        $contacts = Contact::find($id);
        return view('admin.contact.edit',compact('contacts'));
    }

    public function UpdateContact(Request $request,$id){
        Contact::find($id)->update([
            'address' => $request->address,
            'email'=>$request->email,
            'phone' => $request->phone,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message'=>'Contact Data Updated successfully.',
            'alert-type' => 'success'
        );

        return Redirect()->route('admin.contact')->with($notification);
    }

    public function DeleteContact($id){
        $softD=Contact::find($id)->delete();

        $notification = array(
            'message'=>'Contact Soft Deleted successfully',
            'alert-type' => 'warning'
        );
        return Redirect()->back()->with($notification);
    }

    public function RestoreDeleteContact($id){
        Contact::withTrashed()->find($id)->restore();

        $notification = array(
            'message'=>'Contact Data Restored Successfully.',
            'alert-type' => 'warning'
        );
        return Redirect()->back()->with($notification);
    
    }
    public function prmDeleteContact($id){
        Contact::onlyTrashed()->find($id)->forceDelete();

        $notification = array(
            'message'=>'Contact Data Deletes Permanently.',
            'alert-type' => 'error'
        );
        return Redirect()->back()->with($notification);
    
    }
    public function Contact(){
        $contacts = DB::table('contacts')->first();
        return view('pages.contact',compact('contacts'));
    }
    public function ContactForm(Request $request){

        ContactForm::insert([
            'name' => $request->name,
            'email'=>$request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now()
        ]);


        $notification = array(
            'message'=>'Your Message Send Successfully.',
            'alert-type' => 'success'
        );
        return Redirect()->route('contact')->with($notification);
    }
    public function AdminMessage(){
        $message = ContactForm::orderBy('id','desc')->paginate(5);
        return view('admin.contact.message',compact('message'));
    }
    public function MessageDelete($id){
        ContactForm::find($id)->delete();

        $notification = array(
            'message'=>'Message Deleted Successfully.',
            'alert-type' => 'error'
        ); 
        return Redirect()->route('admin.message')->with($notification);
  
    }
}
