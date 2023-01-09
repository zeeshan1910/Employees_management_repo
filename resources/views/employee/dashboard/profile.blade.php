@extends('layouts.master')
@section('title', 'Profile - Employee Portal')

@section('css')
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-3 mt-4">
                    <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                        <img src="/{{ $employee->image }}" alt="user image" style="max-height: 200px"
                            class="d-block h-auto ms-0 ms-sm-4 rounded-3 user-profile-img">
                    </div>
                    <div class="flex-grow-1 mt-3 mt-sm-5">
                        <div
                            class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                            <div class="user-profile-info">
                                <h4>{{ $employee->first_name }} {{ $employee->last_name }}</h4>
                                <ul
                                    class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                    <li class="list-inline-item fw-semibold"><i class="bx bx-pen"></i>
                                        {{ ucfirst(Auth::user()->role) }}</li>
                                    <li class="list-inline-item fw-semibold"><i class="bx bx-map"></i>
                                        {{ $employee->address }}</li>
                                    <li class="list-inline-item fw-semibold">
                                        <i class="bx bx-calendar-alt"></i> Joined
                                        {{ Auth::user()->created_at->diffForHumans() }}
                                    </li>
                                </ul>
                            </div>
                            <a href="{{ route('employee.edit-profile', $employee->id) }}"
                                class="btn btn-primary text-nowrap">
                                <i class="bx bx-user-check"></i> Edit Profile
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-4 col-lg-5 col-md-5">
            <!-- About User -->
            <div class="card mb-4">
                <div class="card-body">
                    <small class="text-muted text-uppercase">About</small>
                    <ul class="list-unstyled mb-4 mt-3">
                        <li class="d-flex align-items-center mb-3">
                            <i class="bx bx-user"></i><span class="fw-semibold mx-2">Full Name:</span>
                            <span>{{ $employee->first_name }} {{ $employee->last_name }}</span>
                        </li>
                        <li class="d-flex align-items-center mb-3">
                            <i class="bx bx-check"></i><span class="fw-semibold mx-2">Status:</span>
                            <span>{{ $employee->status ? 'Active' : 'Inactive' }}</span>
                        </li>
                        <li class="d-flex align-items-center mb-3">
                            <i class="bx bx-star"></i><span class="fw-semibold mx-2">Role:</span>
                            <span>{{ ucfirst(Auth::user()->role) }}</span>
                        </li>
                        <li class="d-flex align-items-center mb-3">
                            <i class="bx bx-flag"></i><span class="fw-semibold mx-2">Address:</span>
                            <span>{{ $employee->address }}</span>
                        </li>
                        {{-- <li class="d-flex align-items-center mb-3">
                            <i class="bx bx-detail"></i><span class="fw-semibold mx-2">Languages:</span>
                            <span>English</span>
                        </li> --}}
                    </ul>
                    <small class="text-muted text-uppercase">Contacts</small>
                    <ul class="list-unstyled mb-4 mt-3">
                        <li class="d-flex align-items-center mb-3">
                            <i class="bx bx-phone"></i><span class="fw-semibold mx-2">Contact:</span>
                            <span>{{ $employee->phone }}</span>
                        </li>
                        {{-- <li class="d-flex align-items-center mb-3">
                            <i class="bx bx-chat"></i><span class="fw-semibold mx-2">Skype:</span> <span>john.doe</span>
                        </li> --}}
                        <li class="d-flex align-items-center mb-3">
                            <i class="bx bx-envelope"></i><span class="fw-semibold mx-2">Email:</span>
                            <span>{{ $employee->email }}</span>
                        </li>
                    </ul>
                    <small class="text-muted text-uppercase">Teams</small>
                    <ul class="list-unstyled mt-3 mb-0">
                        <li class="d-flex align-items-center mb-3">
                            <i class="bx bxl-github text-primary me-2"></i>
                            <div class="d-flex flex-wrap">
                                <span class="fw-semibold me-2">Department:</span><span>
                                    {{ $employee->getDepartment->name }}</span>
                            </div>
                        </li>
                        <li class="d-flex align-items-center">
                            <i class="bx bxl-react text-info me-2"></i>
                            <div class="d-flex flex-wrap">
                                <span class="fw-semibold me-2">Designation</span><span>
                                    {{ $employee->getDesignation->name }}</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <!--/ About User -->
            <!-- Profile Overview -->
            {{-- <div class="card mb-4">
                <div class="card-body">
                    <small class="text-muted text-uppercase">Overview</small>
                    <ul class="list-unstyled mt-3 mb-0">
                        <li class="d-flex align-items-center mb-3">
                            <i class="bx bx-check"></i><span class="fw-semibold mx-2">Task Compiled:</span>
                            <span>13.5k</span>
                        </li>
                        <li class="d-flex align-items-center mb-3">
                            <i class="bx bx-customize"></i><span class="fw-semibold mx-2">Projects Compiled:</span>
                            <span>146</span>
                        </li>
                        <li class="d-flex align-items-center">
                            <i class="bx bx-user"></i><span class="fw-semibold mx-2">Connections:</span> <span>897</span>
                        </li>
                    </ul>
                </div>
            </div> --}}
            <!--/ Profile Overview -->
        </div>
        {{-- <div class="col-xl-8 col-lg-7 col-md-7">
            <!-- Activity Timeline -->
            <div class="card card-action mb-4">
                <div class="card-header align-items-center">
                    <h5 class="card-action-title mb-0"><i class="bx bx-list-ul bx-sm me-2"></i>Activity Timeline</h5>
                    <div class="card-action-element btn-pinned">
                        <div class="dropdown">
                            <button type="button" class="btn dropdown-toggle hide-arrow p-0" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="javascript:void(0);">Share timeline</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);">Suggest edits</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="javascript:void(0);">Report bug</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="timeline ms-2">
                        <li class="timeline-item timeline-item-transparent">
                            <span class="timeline-point timeline-point-warning"></span>
                            <div class="timeline-event">
                                <div class="timeline-header mb-1">
                                    <h6 class="mb-0">Client Meeting</h6>
                                    <small class="text-muted">Today</small>
                                </div>
                                <p class="mb-2">Project meeting with john @10:15am</p>
                                <div class="d-flex flex-wrap">
                                    <div class="avatar me-3">
                                        <img src="../../assets/img/avatars/3.png" alt="Avatar" class="rounded-circle">
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Lester McCarthy (Client)</h6>
                                        <span>CEO of Infibeam</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-item timeline-item-transparent">
                            <span class="timeline-point timeline-point-info"></span>
                            <div class="timeline-event">
                                <div class="timeline-header mb-1">
                                    <h6 class="mb-0">Create a new project for client</h6>
                                    <small class="text-muted">2 Day Ago</small>
                                </div>
                                <p class="mb-0">Add files to new design folder</p>
                            </div>
                        </li>
                        <li class="timeline-item timeline-item-transparent">
                            <span class="timeline-point timeline-point-primary"></span>
                            <div class="timeline-event">
                                <div class="timeline-header mb-1">
                                    <h6 class="mb-0">Shared 2 New Project Files</h6>
                                    <small class="text-muted">6 Day Ago</small>
                                </div>
                                <p class="mb-2">
                                    Sent by Mollie Dixon
                                    <img src="../../assets/img/avatars/4.png" class="rounded-circle ms-3" alt="avatar"
                                        height="20" width="20">
                                </p>
                                <div class="d-flex flex-wrap gap-2">
                                    <a href="javascript:void(0)" class="me-3">
                                        <img src="../../assets/img/icons/misc/pdf.png" alt="Document image"
                                            width="20" class="me-2">
                                        <span class="h6">App Guidelines</span>
                                    </a>
                                    <a href="javascript:void(0)">
                                        <img src="../../assets/img/icons/misc/doc.png" alt="Excel image" width="20"
                                            class="me-2">
                                        <span class="h6">Testing Results</span>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-item timeline-item-transparent">
                            <span class="timeline-point timeline-point-success"></span>
                            <div class="timeline-event pb-0">
                                <div class="timeline-header mb-1">
                                    <h6 class="mb-0">Project status updated</h6>
                                    <small class="text-muted">10 Day Ago</small>
                                </div>
                                <p class="mb-0">Woocommerce iOS App Completed</p>
                            </div>
                        </li>
                        <li class="timeline-end-indicator">
                            <i class="bx bx-check-circle"></i>
                        </li>
                    </ul>
                </div>
            </div>
        </div> --}}
    </div>
@endsection

@section('scripts')
@endsection
