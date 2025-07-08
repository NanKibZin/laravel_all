@extends('admin.layout')
@section('customCss')
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
<style>
    .img-thumbnail {
        max-width: 50px;
        max-height: 50px;
    }
</style>
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
                        <li class="breadcrumb-item"><a class="btn btn-primary" href="{{ route('te.create') }}">Add New Teacher</a></li>
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
                            <h3 class="card-title">Search Parent</h3>
                            <div class="card-tools">
                                <form action="{{ route('te.read') }}" method="GET">
                                    <div class="form-row">
                                        <div class="form-group col-md-2">
                                            <label>Name</label>
                                            <input type="text" name="name" value="{{ request('name') }}" class="form-control" placeholder="Name">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Email</label>
                                            <input type="email" name="email" value="{{ request('email') }}" class="form-control" placeholder="Email">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Mobile Number</label>
                                            <input type="text" name="mobile_number" value="{{ request('mobile_number') }}" class="form-control" placeholder="Mobile Number">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Status</label>
                                            <select name="status" class="form-control">
                                                <option value="">All Status</option>
                                                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2 d-flex align-items-end">
                                            <button type="submit" class="btn btn-primary mr-2">Search</button>
                                            <a href="{{ route('te.read') }}" class="btn btn-success">Reset</a>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                       
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="card-body">
                            <table id="parentTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
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
                                    @foreach ($parents as $parent)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if($parent->image)
                                                <img src="{{ asset($parent->image) }}" alt="Profile" class="img-thumbnail">
                                            @else
                                                <img src="{{ asset('images/default-profile.png') }}" alt="Default Profile" class="img-thumbnail">
                                            @endif
                                        </td>
                                        <td>{{ $parent->name }}</td>
                                        <td>{{ ucfirst($parent->gender) }}</td>
                                        <td>{{ $parent->mobile_number }}</td>
                                        <td>{{ $parent->email }}</td>
                                        <td>
                                            @if($parent->status == 1)
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('te.edit', $parent->id) }}" class="btn btn-sm btn-success" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{ route('te.delete', $parent->id) }}" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this parent?')">
                                                <i class="fas fa-trash"></i>
                                            </a>
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
    </section>
</div>
@endsection

@section('customJs')
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script>
    $(function () {
        $("#parentTable").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print"],
            "paging": true,
            "searching": false, // Disable built-in search as we have our own
            "ordering": true,
            "info": true,
        }).buttons().container().appendTo('#parentTable_wrapper .col-md-6:eq(0)');
    });
</script>
@endsection