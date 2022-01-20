@extends('admin.admin_master')

@section('admin')

    <div class="py-12">

        <div class="container">
            <div class="row">
                <h4>Admin Message</h4>
                <br> <br>
                <div class="col-md-12">
                    <div class="card">
                      
                        <div class="card-header">
                            All Message Data
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" width="5%">No.</th>
                                    <th scope="col" width="15%">Name</th>
                                    <th scope="col" width="25%">Email</th>
                                    <th scope="col" width="15%">Subject</th>
                                    <th scope="col" width="15%">Message</th>
                                    <th scope="col" width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i = 1)
                                @foreach ($message as $sms)
                                    <tr>

                                        <th scope="row">{{ $i++ }}</th>
                                        <td>{{ $sms->name }}</td>

                                        <td>{{ $sms->email }}</td>
                                        <td>{{ $sms->subject }}</td>
                                        <td>
                                            {{ $sms->message }}
                                        </td>
                                        <td>

                                            <a href="{{ url('message/delete/' . $sms->id) }}" class="btn btn-danger"
                                                onclick="return confirm('Are you sure to delete.?')">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                           
                        </table>
                           {{ $message->links() }}
                       
                    </div>



                </div>
              
            
            </div>

                          
                        
        </div>
    </div>

@endsection
