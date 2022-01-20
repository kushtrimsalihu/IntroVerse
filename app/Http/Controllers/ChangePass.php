<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Image;
use Illuminate\Support\Facades\Hash;

class ChangePass extends Controller {
    public function ChangePassword() {
        return view( 'admin.body.change_password' );
    }

    public function UpdatePassword( Request $request ) {
        $validatedData = $request->validate( [
            'old_password'=>'required',
            'password'=>'required|confirmed'
        ] );

        $hashedPassword = Auth::user()->password;
        if ( Hash::check( $request->old_password, $hashedPassword ) ) {
            $user = User::find( Auth::id() );
            $user->password = Hash::make( $request->password );
            $user->save();
            Auth::logout();
            return Redirect()->route( 'login' )->with( 'success', 'Password is changed successfully.' );
        } else {
            return Redirect()->back()->with( 'error', 'Current password is invalid.' );
        }

    }

    public function ProfileUpdate() {
        if ( Auth::user() ) {
            $user = User::find( Auth::user()->id );
            if ( $user ) {
                return view( 'admin.body.update_profile', compact( 'user' ) );
            }
        }
    }

    public function ProfileUpdateData( Request $request ) {
        $user = User::find( Auth::user()->id );
        $validatedData = $request->validate( [
            'brand_image.min'=>'Brand Longer then 4 Character.'
        ] );

        $old_image = $request->old_image;

        $logo_image = $request->file( 'profile_photo_path' );

        if ( $user ) {
            if ( $logo_image ) {

                $name_gen = hexdec( uniqid() ).'.'.$logo_image->getClientOriginalExtension();
                Image::make( $logo_image )->save( 'storage/profile-photos/'.$name_gen );
                $lastimage = 'storage/profile-photos/'.$name_gen;
                // unlink( $old_image );

                $user->name = $request->name;
                $user->email = $request->email;
                $user->profile_photo_path = $lastimage;

                $user->update();

            } else {
                $user->name = $request->name;
                $user->email = $request->email;
                $user->update();
            }

            $notifications = array(
                'message'=>'User Profile is updated successfully.',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with( $notifications);
        } else {
            Redirect()->back();
        }
    }

}