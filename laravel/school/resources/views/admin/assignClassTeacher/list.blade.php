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
                        <li class="breadcrumb-item"><a class=" btn btn-primary" href="{{ route('ct.index') }}">Assinge Class to Teacher</a></li>
                        
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
                        <form action="{{ route('ct.list') }}" method="GET">
                            <div class="form-row align-items-end">
                                <div class="form-group col-md-3">
                                    <label>Name</label>
                                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Enter name">
                                </div>
                        
                                {{-- <div class="form-group col-md-3">
                                    <label>Subject Type</label>
                                    <select name="type" class="form-control">
                                        <option value="">  Subject Type </option>
                                        <option value="1" {{ request('type') == '1' ? 'selected' : '' }}>Theory</option>
                                        <option value="0" {{ request('type') == '0' ? 'selected' : '' }}>Practical</option>
                                    </select>
                                </div> --}}
                        
                              
                        
                                <div class="form-group col-md-3 d-flex">
                                    <button type="submit" class="btn btn-primary mr-2">Search</button>
                                    <a href="{{ route('ct.list') }}" class="btn btn-success">Reset</a>
                                </div>
                            </div>
                        </form>
                        

                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Class</th>
                                        <th>Teacher</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($class as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->Class->name }}</td>
                                        <td>
                                             {{ $item->teacher->name }}
                                        </td>
                                        <td>
                                                  @if($item->status == 1)
            <span class="bg-success text-light p-1 rounded-1">Active</span>
        @else
            <span class="bg-danger text-light p-1 rounded-1">Block</span>
           @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('ct.edit',$item->id) }}" class="btn btn-sm btn-success">Edit</a>
                                            <a href="{{ route('ct.delete',$item->id) }}" onclick="return confirm('Are you sure you want to delete this?')" class="btn btn-sm btn-danger">Delete</a>
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

@section('customJs')
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            "paging": true,
            "searching": false, // Disable DataTables search as we have our own
            "ordering": true,
            "info": true,
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
@endsection