@extends('admin.admin_master')

@section('admin')

    <div class="col-lg-12">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom">
                <h2>Edit Slider</h2>
            </div>
            <div class="card-body">
                <form action="{{ url('/slider/update/'.$sliders->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="old_image" value="{{ $sliders->image }}">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Update Slider Title</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" name="title" value="{{$sliders->title}}" placeholder="Slider Title">
                        @error('title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Update Slider Description</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" value="description" name="description" placeholder="Slider Description">{{ $sliders->description }}</textarea>
                        @error('description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Update Slider Images</label>
                        <input type="file" name="image" value="{{ $sliders->image }}" class="form-control-file" id="exampleFormControlFile1">
                        <img src="{{ asset($sliders->image) }}" width="200px" height="100px" alt="">
                        @error('image')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    </div>
                    <div class="form-footer pt-4 pt-5 mt-4 border-top">
                        <button type="submit" class="btn btn-primary btn-default">Update Slider</button>
                    </div>
                </form>
            </div>
        </div>

       @endsection
