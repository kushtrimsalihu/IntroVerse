@extends('admin.admin_master')

@section('admin')

    <div class="col-lg-12">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom">
                <h2>Create Home Service</h2>
            </div>
            <div class="card-body">

                <form action="{{ route('store.homeservice') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Icon</label>
                        <input type="text" class="form-control" name="icon" aria-describedby="emailHelp" placeholder="Please use just classes of icons..">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Title Offers</label>
                        <input type="text" class="form-control" name="title" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Short Description</label>
                        <input type="text" class="form-control" name="short_description" aria-describedby="emailHelp">
                    </div>

                    <button type="submit" class="btn btn-primary">Add Service</button>
            </div>
            </form>



        </div>
    </div>
    </div>

@endsection
