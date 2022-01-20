@extends('admin.admin_master')

@section('admin')

    <div class="py-12">

        <div class="container">
            <div class="row">
                <h4>Contat Page</h4>
                <a href="{{ route('add.contact') }}"><button class="btn btn-info">Add Contact</button></a>
                <br> <br>
                <div class="col-md-12">
                    <div class="card">
                     
                        <div class="card-header">
                            All Contact Data
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" width="5%">No.</th>
                                    <th scope="col" width="15%">Contact Address</th>
                                    <th scope="col" width="25%">Contact Email</th>
                                    <th scope="col" width="15%">Contact Phone</th>
                                    <th scope="col" width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i = 1)
                                @foreach ($contacts as $contact)
                                    <tr>

                                        <th scope="row">{{ $i++ }}</th>

                                        <td>{{ $contact->address }}</td>
                                        <td>{{ $contact->email }}</td>
                                        <td>
                                            {{ $contact->phone }}
                                        </td>
                                        <td>
                                            <a href="{{ url('contact/edit/' . $contact->id) }}"
                                                class="btn btn-info">Edit</a>
                                            <a href="{{ url('contact/delete/' . $contact->id) }}" class="btn btn-danger"
                                                onclick="return confirm('Are you sure to delete.?')">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <br>
                    <hr>
                    <br>
                    <div class="card-header">
                        Trashed Data
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" width="5%">No.</th>
                                <th scope="col" width="15%">Contact Address</th>
                                <th scope="col" width="25%">Contact Email</th>
                                <th scope="col" width="15%">Contact Phone</th>
                                <th scope="col" width="15%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i = 1)
                            @foreach ($softD as $delete)
                                <tr>
    
                                    <th scope="row">{{ $i++ }}</th>
    
                                    <td>{{ $delete->address }}</td>
                                    <td>{{ $delete->email }}</td>
                                    <td>
                                        {{ $delete->phone }}
                                    </td>
                                    <td>
                                        <a href="{{ url('/contact/restore/' . $delete->id) }}"
                                            class="btn btn-warning">Restore</a>
                                        <a href="{{ url('/contact/delete/prm/' . $delete->id) }}" class="btn btn-danger"
                                            onclick="return confirm('Are you sure to delete.?')">Delete</a>
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
@endsection
