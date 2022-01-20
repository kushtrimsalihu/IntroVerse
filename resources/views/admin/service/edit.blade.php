@extends('admin.admin_master')

@section('admin')

<div class="col-lg-12">
    <div class="card card-default">
        <div class="card-header card-header-border-bottom">
            <h2>Edit Home Service</h2>
        </div>
        <div class="card-body">

            <form action="{{ url('/update/service/'.$home_service->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Title Offers</label>
                    <input type="text" class="form-control" name="icon" value="{{$home_service->icon}}" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Title Offers</label>
                    <input type="text" class="form-control" name="title" value="{{$home_service->title}}" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Short Description</label>
                    <input type="text" class="form-control" name="short_description" value="{{ $home_service->short_description}}" aria-describedby="emailHelp">
                </div>

                <button type="submit" class="btn btn-primary">Update Service</button>
        </div>
        </form>



    </div>
</div>
</div>


@endsection