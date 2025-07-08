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
                        <li class="breadcrumb-item"><a class=" btn btn-primary" href="{{ route('stu.create') }}">Add New Class</a></li>
                        
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
                                <form action="{{ route('stu.read') }}" method="GET">
                                    <div class="form-row">
                                        <!-- First Row -->
                                        <div class="form-group col-md-2">
                                            <label>Name</label>
                                            <input type="text" name="name" value="{{ request('name') }}" class="form-control" placeholder="Name">
                                        </div>
                                        
                                        <div class="form-group col-md-2">
                                            <label>Last Name</label>
                                            <input type="text" name="last_name" value="{{ request('last_name') }}" class="form-control" placeholder="Last Name">
                                        </div>
                                        
                                        <div class="form-group col-md-2">
                                            <label>Email</label>
                                            <input type="email" name="email" value="{{ request('email') }}" class="form-control" placeholder="Email">
                                        </div>
                                        
                                        <div class="form-group col-md-2">
                                            <label>Admission No</label>
                                            <input type="text" name="admission_number" value="{{ request('admission_number') }}" class="form-control" placeholder="Admission No">
                                        </div>
                                        
                                        <div class="form-group col-md-2">
                                            <label>Roll No</label>
                                            <input type="text" name="roll_number" value="{{ request('roll_number') }}" class="form-control" placeholder="Roll No">
                                        </div>
                                        
                                        <div class="form-group col-md-2">
                                            <label>Class</label>
                                            <input type="text" name="class" value="{{ request('class') }}" class="form-control" placeholder="Class">
                                        </div>
                                    </div>
                                
                                    <!-- Second Row -->
                                    <div class="form-row mt-2">
                                        <div class="form-group col-md-2">
                                            <label>Gender</label>
                                            <select name="gender" class="form-control">
                                                <option value="">Select Gender</option>
                                                <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                                <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                                <option value="other" {{ request('gender') == 'other' ? 'selected' : '' }}>Other</option>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group col-md-2">
                                            <label>Caste</label>
                                            <input type="text" name="caste" value="{{ request('caste') }}" class="form-control" placeholder="Caste">
                                        </div>
                                        
                                        
                                        <div class="form-group col-md-2">
                                            <label>Mobile No</label>
                                            <input type="text" name="mobile_number" value="{{ request('mobile_number') }}" class="form-control" placeholder="Mobile No">
                                        </div>
                                        
                                       
                                        <div class="form-group col-md-2">
                                            <label>Status</label>
                                            <select name="status" class="form-control">
                                                <option value="">Select Status</option>
                                                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Block</option>
                                            </select>
                                        </div>
                                    </div>
                                
                                    <!-- Third Row - Admission Date -->
                                    <div class="form-row mt-2">
                                        <div class="form-group col-md-4">
                                            <label>Admission Date</label>
                                            <div class="d-flex">
                                                <input type="date" name="admission_date_from" value="{{ request('admission_date_from') }}" class="form-control mr-2" placeholder="From">
                                                <input type="date" name="admission_date_to" value="{{ request('admission_date_to') }}" class="form-control" placeholder="To">
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="form-group col-md-2">
                                            <label>Date</label>
                                            <input type="date" name="date" value="{{ request('date') }}" class="form-control">
                                        </div>
                                        
                                        <div class="form-group col-md-4 d-flex align-items-end">
                                            <button type="submit" class="btn btn-primary mr-2">Search</button>
                                            <a href="{{ route('stu.read') }}" class="btn btn-success mr-2">Reset</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="card-body" >
                                <table id="example1" class="table table-bordered table-striped" style="overflow-x: auto;">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Profile</th>
                                            <th>Name</th>
                                            <th>Class</th>
                                            <th>Admission No</th>
                                            <th>Roll No</th>
                                            <th>Gender</th>
                                            <th>Parent Name</th>
                                            <th>DOB</th>
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
                                                <td>{{ $student->name }} {{ $student->last_name }}</td>
                                                <td>{{ $student->studentClass->name}}</td>
                                                <td>{{ $student->admission_number }}</td>
                                                <td>{{ $student->roll_number }}</td>
                                                <td>{{ ucfirst($student->gender) }}</td>
                                                <td>
                                                    @if($student->parent)
                                                        {{ $student->parent->name }}
                                                    @else
                                                        No parent assigned
                                                    @endif
                                                </td>
                                                <td>{{ $student->dob }}</td>
                                                <td>{{ $student->mobile_number }}</td>
                                                <td>{{ $student->email }}</td>
                                                <td>
                                                    @if($student->status == 1)
                                                        <span class="badge badge-success">Active</span>
                                                    @else
                                                        <span class="badge badge-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('stu.edit', $student->id) }}" class="btn btn-success btn-sm">Edit</a>
                                                    <a href="{{ route('stu.delete', $student->id) }}" onclick="return confirm('Are you sure you want to delete this student?')" class="btn btn-danger btn-sm">Delete</a>
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
