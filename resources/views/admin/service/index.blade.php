@extends('admin.admin_master')

@section('admin')

    <div class="py-12">

        <div class="container">
            <div class="row">
                <h4>Home Service</h4>
                <a href="{{ route('homeservice.add') }}"><button class="btn btn-info">Add Service</button></a>

                <div class="col-md-12">
                    <div class="card">
                      

                        <div class="card-header">
                            All Service Data
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" width="5%">No.</th>
                                    <th scope="col" width="5%">Icon</th>
                                    <th scope="col" width="25%">Service Offers</th>
                                    <th scope="col" width="15%">Short Description</th>
                                    <th scope="col" width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i = 1)
                                @foreach ($home_service as $service)

                                    <tr>
                                        <th scope="row">{{ $i++ }}</th>
                                        <td>{{ $service->icon }}</td>
                                        <td>{{ $service->title }}</td>
                                        <td>
                                            {{ $service->short_description }}
                                        </td>
                                        <td>
                                            <a href="{{ url('/edit/service/' . $service->id) }}"
                                                class="btn btn-info">Edit</a>
                                            <a href="{{ url('/delete/service/' . $service->id) }}"
                                                class="btn btn-danger"
                                                onclick="return confirm('Are you sure to delete ?')">Delete</a>
                                        </td>
                                    </tr>

                                @endforeach
                            </tbody>
                        </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


@endsection
