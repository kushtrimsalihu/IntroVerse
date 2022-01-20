@extends('admin.admin_master')

@section('admin')

    <div class="col-lg-12">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom">
                <h2>Create About</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('store.homeabout') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Home About Title</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" name="title" placeholder="Home About Title">

                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Short About Description</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="short_description" placeholder="Short About Description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Long About Description</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="long_description" placeholder="Long About Description"></textarea>
                    </div>
                    <div class="form-footer pt-4 pt-5 mt-4 border-top">
                        <button type="submit" class="btn btn-primary btn-default">Submit</button>
                    </div>
                </form>
            </div>
        </div>

       @endsection
