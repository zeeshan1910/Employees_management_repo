@extends('layouts.master')
@section('title', 'Department List | Admin Panel')
@section('css')
    <link rel="stylesheet" href="/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css">
    <link rel="stylesheet" href="/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css">
    <link rel="stylesheet" href="/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css">
    <link rel="stylesheet" href="/assets/vendor/libs/sweetalert2/sweetalert2.css" />
@endsection
@section('content')
    <div class="card">
        <div class="card-header border-bottom d-flex">
            <h5 class="card-title">Departments</h5>
            <div class="card-header-elements ms-auto">
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                    data-bs-target="#addDepartment"><span class="tf-icon bx bx-plus bx-xs"></span>
                    Add New Department</button>
            </div>
        </div>
        <div class="card-datatable table-responsive">
            {!! $html->table(['class' => 'datatables-users table border-top']) !!}
        </div>

        <!-- Add Category Modal -->
        <div class="modal fade" id="addDepartment" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Department</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('departments.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="name" class="form-label">Department Name</label>
                                    <input type="text" class="form-control" name="name"
                                        placeholder="Enter Department Name" required>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--/ Add Category Modal -->

        <!-- Add Category Modal -->
        <div class="modal fade" id="editItem" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Department</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('departments.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <input type="hidden" class="id" name="id">
                                <div class="col-md-12 mb-3">
                                    <label for="name" class="form-label">Department Name</label>
                                    <input type="text" class="form-control edit-name" name="name"
                                        placeholder="Enter Department Name" required>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--/ Add Category Modal -->
    </div>
@endsection
@section('scripts')
    {!! $html->scripts() !!}
    <script src="/assets/vendor/libs/datatables/jquery.dataTables.js"></script>
    <script src="/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
    <script src="/assets/vendor/libs/datatables-responsive/datatables.responsive.js"></script>
    <script src="/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js"></script>
    <script src="/assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
    <script src="/assets/js/extended-ui-sweetalert2.js"></script>
    <script>
        function editItem(row) {
            console.log(row);
            $('.edit-name').val(row.name);
            $('.id').val(row.id);

        }
        // Delete Category
        function deleteDepartment(id) {
            // console.log(id);
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/categories/delete/' + id,
                        type: "GET",
                        data: {
                            id: id,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if (response.status == 200) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                )
                                location.reload();
                            }
                        }
                    });
                }
            })
        }
    </script>
@endsection
