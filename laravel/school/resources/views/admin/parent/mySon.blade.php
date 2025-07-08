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
                            <h3 class="card-title">Search Student</h3>
                            <div class="card-tools">
                                <form action="{{ route('pa.mySon',$parent_id) }}" method="GET">
                                    <div class="form-row">
                                        <!-- First Row -->
                                        <div class="form-group col-md-2">
                                            <label>Student ID</label>
                                            <input type="text" name="id" value="{{ request('id') }}" class="form-control" placeholder="Student ID">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Student Name</label>
                                            <input type="text" name="name" value="{{ request('name') }}" class="form-control" placeholder="Student Name">
                                        </div>
                                        
                                        
                                        
                                        <div class="form-group col-md-2">
                                            <label>Student Email</label>
                                            <input type="email" name="email" value="{{ request('email') }}" class="form-control" placeholder="Email">
                                        </div>                                     
                                      
                                    <!-- Third Row - Admission Date -->
                                    <div class="form-row mt-2">
                                        
                                        <div class="form-group col-md-4 d-flex align-items-end">
                                            <button type="submit" class="btn btn-primary mr-2">Search</button>
                                            <a href="{{ route('pa.mySon',$parent_id) }}" class="btn btn-success mr-2">Reset</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="card-body">
                            <label for="">Student List</label>
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Profile</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Create_by</th>
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
                                            <td>{{ $student->name }} </td>
                                           
                                            <td>{{ $student->email }}</td>
                                            <td>{{ $student->create_by }}</td>
                                           
                                            <td>
                                                <form action="{{ route('pa.mySonPa', ['student_id' => $student->id, 'parent_id' => $parent_id]) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm">Add to Parent</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                   
                            </table>
                        </div>
                        <div class="card-body">
                            <label for="">Parent Student List</label>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Profile</th>
                                        <th>Name</th>
                                        <th>Gender</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>Parent Name</th>
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
                                            <td>{{ $student->name }} {{ $student->last_name }}</td>
                                            <td>{{ ucfirst($student->gender) }}</td>
                                            <td>{{ $student->mobile_number }}</td>
                                            <td>{{ $student->email }}</td>
                                            <td>
                                                @if($student->parent)
                                                    {{ $student->parent->name }}
                                                @else
                                                    No parent assigned
                                                @endif
                                            </td>
                                            <td>
                                                @if($student->status == 1)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-danger">Block</span>
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{ route('pa.mySonPa', ['student_id' => $student->id, 'parent_id' => $parent_id]) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm">Add to Parent</button>
                                                </form>
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
    </section>
</div>
@endsection
