@extends('admin.admin_master')

@section('admin')

    <div class="card card-default">
        <div class="card-header card-header-border-bottom">
            <h2>Profile Update</h2>
        </div>
        <div class="card-body">
            @if(session('success'))
            <p class="alert alert-success">{{ session('success') }}</p>
            @endif
            <form method="POST" action="{{ route('update.user.profile') }}" class="form-pill" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="old_image" value="{{$user->profile_photo_path }}">
                <div class="form-group">
                    <label for="exampleFormControlInput3">User Image</label>
                    <input type="file" name="profile_photo_path" class="form-control" value="{{ $user->profile_photo_path }}">
                    <img src="{{asset(Auth::user()->profile_photo_path) }}" style="width:400px; height:200px">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlInput3">User Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $user['name'] }}">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlInput3">User Email</label>
                    <input type="text" name="email" class="form-control" value="{{ $user['email'] }}">
                </div>
               
           
                <button type="submit" class="btn btn-primary btn-default">Update</button>
            </form>
        </div>
    </div>

@endsection
