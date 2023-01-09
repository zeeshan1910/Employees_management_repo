@extends('layouts.master')
@section('title', 'Employee List | Admin Panel')
@section('css')
    <link rel="stylesheet" href="/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css">
    <link rel="stylesheet" href="/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css">
    <link rel="stylesheet" href="/assets/vendor/libs/sweetalert2/sweetalert2.css" />
@endsection

@section('content')
    <div class="card">
        <div class="card-header border-bottom d-flex">
            <h5 class="card-title">Employees</h5>
            <div class="card-header-elements ms-auto">
                <a href="{{ route('export-employee') }}" class="btn btn-sm btn-info">
                    <span class="tf-icon bx bx-export bx-xs"></span>Export Employee
                </a>
                <button class="btn btn-sm btn-secondary" type="button" data-bs-toggle="modal"
                    data-bs-target="#exportModal">
                    <span class="tf-icon bx bx-import bx-xs"></span>Import Employee
                </button>
                <a href="{{ route('employees.create') }}" class="btn btn-sm btn-primary">
                    <span class="tf-icon bx bx-plus bx-xs"></span>Add New Employee
                </a>
            </div>
        </div>
        <div class="card-datatable table-responsive">
            {!! $html->table(['class' => 'datatables-users table border-top']) !!}
        </div>
    </div>
    </div>

    <!-- Import Modal -->
    <!-- Modal -->
    <div class="modal fade" id="exportModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('import-employee') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameBasic" class="form-label">Choose File</label>
                                <input type="file" class="form-control" name="file"
                                    accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <a href="/sample/export-employee-sample-file.xlsx" class="btn btn-sm btn-info">
                                    <span class="tf-icon bx bx-export bx-xs"></span>Download Sample File
                                </a>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" class="btn btn-primary">+ Import Data</button>
                        </div>
                </form>
            </div>
        </div>
    </div>



@endsection

@section('scripts')
    {!! $html->scripts() !!}
    <script src="/assets/vendor/libs/datatables/jquery.dataTables.js"></script>
    <script src="/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
    <script src="/assets/vendor/libs/datatables-responsive/datatables.responsive.js"></script>
    <script src="/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js"></script>
@endsection
