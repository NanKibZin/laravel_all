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
                    <h1>Student List</h1>
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
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $student)
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
