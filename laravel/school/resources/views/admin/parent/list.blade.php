@extends('admin.layout')
@section('customCss')
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ $header_title }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a class=" btn btn-primary" href="{{ route('pa.create') }}">Add New Parent</a></li>
                        
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            @include('message')
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Search Class</h3>
                            <div class="card-tools">
                                <form action="{{ route('pa.read') }}" method="GET">
                                    <div class="form-row">
                                        <!-- First Row -->
                                        <div class="form-group col-md-2">
                                            <label>Name</label>
                                            <input type="text" name="name" value="{{ request('name') }}" class="form-control" placeholder="Name">
                                        </div>
                                        
                                        
                                        
                                        <div class="form-group col-md-2">
                                            <label>Email</label>
                                            <input type="email" name="email" value="{{ request('email') }}" class="form-control" placeholder="Email">
                                        </div>
                                        
                                       
                                        
                                      
                                    <!-- Third Row - Admission Date -->
                                    <div class="form-row mt-2">
                                        
                                        <div class="form-group col-md-4 d-flex align-items-end">
                                            <button type="submit" class="btn btn-primary mr-2">Search</button>
                                            <a href="{{ route('pa.read') }}" class="btn btn-success mr-2">Reset</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Profile</th>
                                            <th>Name</th>
                                            <th>Gender</th>
                                            <th>Mobile</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $student)
                                            <tr>
                                                <td>{{ $student->id }}</td>
                                                <td>
                                                    @if($student->image)
                                                        <img src="{{ asset($student->image) }}" alt="Profile" class="img-thumbnail" width="50">
                                                    @else
                                                        <img src="{{ asset('images/default-profile.png') }}" alt="Default Profile" class="img-thumbnail" width="50">
                                                    @endif
                                                </td>
                                                <td>{{ $student->name }}</td>
                                               
                                                <td>{{ ucfirst($student->gender) }}</td>
                                                <td>{{ $student->mobile_number }}</td>
                                                <td>{{ $student->email }}</td>
                                                <td>
                                                    @if($student->status == 1)
                                                        <span class="badge badge-success">Active</span>
                                                    @else
                                                        <span class="badge badge-danger">Block</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('pa.edit', $student->id) }}" class="btn btn-success btn-sm">Edit</a>
                                                    <a href="{{ route('pa.delete', $student->id) }}" onclick="return confirm('Are you sure you want to delete this student?')" class="btn btn-danger btn-sm">Delete</a>
                                                    <a href="{{ route('pa.mySon', $student->id) }}" class="btn btn-primary btn-sm">My son</a>
                                                    {{-- <a href="{{ route('stu.show', $student->id) }}" class="btn btn-info btn-sm">View</a> --}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                   
                            </table>
                        </div>

                        {{-- @if($class->hasPages())
                        <div class="card-footer clearfix">
                            {{ $class->withQueryString()->links() }}
                        </div>
                        @endif --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
