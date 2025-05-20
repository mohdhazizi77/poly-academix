@extends('layouts.master')

@section('title', 'Default')

@section('css')
    {{--DATATABLE--}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">

@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3 class="pt-4">Users</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item pt-4">System Setting</li>
    <li class="breadcrumb-item pt-4 active"><a href="{{ route('users.index') }}">Users</a></li>
@endsection

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="container-fluid">

        <div class="row starter-main">

            {{--SEARCH--}}
            <div class="col-sm-12">
                <div class="card card-absolute">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="mb-3">
                                    <label for="ddRole" class="col-lg-12 form-label text-lg-start h5 px-1">Role</label>
                                    <select class="form-control input-air-primary" id="ddRole" name="ddRole">
                                        <option value="">-ALL-</option>
                                        @foreach($listRole as $row)
                                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <x-button-search>
                                Search
                            </x-button-search>
                        </div>

                    </div>
                </div>
            </div>

            {{--ACTION--}}
            <div class="col-sm-12">
                <div class="card card-absolute">
                    <div class="card-body">
                        <div class="row">
                            <x-button-success
                                id="button-register"
                                data-bs-toggle="modal"
                                data-bs-target="#createUserModal"
                            >
                                Create User
                            </x-button-success>
                        </div>
                    </div>
                </div>
            </div>

            {{--DATATABLE--}}
            <div class="col-sm-12">
                <div class="card card-absolute">
                    <div class="card-body">
                        <div class="card-header bg-light-info">
                            <h5 class="text-black-50">User List</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="display" id="dt1">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Role</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--CREATE USER MODAL--}}
    <div class="modal fade bd-example-modal-lg" id="createUserModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Create User</h4>
                </div>
                <div class="modal-body">
                    <form class="theme-form mx-lg-5" method="POST" action="{{ route('users.store') }}">
                        @csrf
                        <div class="mb-3 row">
                            <label class="col-sm-3 mt-2 col-form-label" for="role">Role <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <select class="form-control input-air-info" id="role" name="role">
                                    <option disabled selected value=""></option>
                                    @foreach($listRole as $row)
                                        <option {{ old('role') == $row->id ? 'selected' : '' }} value="{{ $row->id }}">{{ $row->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-3 mt-2 col-form-label" for="name">Name <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input class="form-control form-control-lg input-air-info" id="name" name="name" value="{{ old('name') }}">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-3 mt-2 col-form-label" for="email">Email <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input class="form-control form-control-lg input-air-info" id="email" name="email" value="{{ old('email') }}">
                            </div>
                        </div>

                        <div class="mb-3 pt-2 row">
                            <div class="col-sm-11 text-end">
                                <button type="button" class="btn btn-pill btn-outline-dark btn-air-light me-3" data-bs-dismiss="modal">
                                    Close
                                </button>
                                <button type="submit" class="btn btn-pill btn-outline-success btn-air-success">
                                    Create
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">

        var session_layout = '{{ session()->get('layout') }}';
        var ajaxUrl = "{{ route('users.ajax') }}";

    </script>

    {{--DATATABLE--}}
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/datatables/users.js') }}"></script>

    @if ($errors->any())
        <script>
            $(document).ready(function () {
                @foreach ($errors->all() as $error)
                toastr.error(@json($error), 'Error', {
                    closeButton: true,
                    progressBar: true,
                    newestOnTop: true,
                    timeOut: 4000
                });
                @endforeach
            });
        </script>
    @endif

@endsection
