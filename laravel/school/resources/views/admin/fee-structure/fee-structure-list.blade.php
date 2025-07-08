@extends('admin.layout')

@section('customCss')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Fee Structure List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Fee Structure</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Fee Structure Data</h3>
                        </div>

                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>

                                        <th>ID</th>
                                        <th>Academic Year</th>
                                        <th>Class</th>
                                        <th>Fee Head</th>
                                        <th>April</th>
                                        <th>May</th>
                                        <th>June</th>
                                        <th>August</th>
                                        <th>September</th>
                                        <th>October</th>
                                        <th>November</th>
                                        <th>December</th>
                                        <th>January</th>
                                        <th>February</th>
                                        <th>March</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->AcademicYear->name ?? '-' }}</td>
                                            <td>{{ $item->Class->name ?? '-' }}</td>
                                            <td>{{ $item->FeeHead->name ?? '-' }}</td>
                                            <td>{{ $item->april ?? '-' }}</td>
                                            <td>{{ $item->may ?? '-' }}</td>
                                            <td>{{ $item->june ?? '-' }}</td>
                                            <td>{{ $item->august ?? '-' }}</td>
                                            <td>{{ $item->september ?? '-' }}</td>
                                            <td>{{ $item->october ?? '-' }}</td>
                                            <td>{{ $item->november ?? '-' }}</td>
                                            <td>{{ $item->december ?? '-' }}</td>
                                            <td>{{ $item->january ?? '-' }}</td>
                                            <td>{{ $item->february ?? '-' }}</td>
                                            <td>{{ $item->march ?? '-' }}</td>
                                            <td>
                                                <a href="{{ route('fee-str.edit', $item->id) }}" class="btn btn-success btn-sm">Edit</a>
                                                <a href="{{ route('fee-str.delete', $item->id) }}" onclick="return confirm('Are you sure you want to delete this?')" class="btn btn-danger btn-sm">Delete</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Academic Year</th>
                                            <th>Class</th>
                                            <th>Fee Head</th>
                                            <th>April</th>
                                            <th>May</th>
                                            <th>June</th>
                                            <th>August</th>
                                            <th>September</th>
                                            <th>October</th>
                                            <th>November</th>
                                            <th>December</th>
                                            <th>January</th>
                                            <th>February</th>
                                            <th>March</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
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
        <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
        <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
        <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
        <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    
        <script>
            $(function () {
                $("#example1").DataTable({
                    "responsive": true,
                    "lengthChange": true,
                    "autoWidth": true,
                    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            });
        </script>
    @endsection