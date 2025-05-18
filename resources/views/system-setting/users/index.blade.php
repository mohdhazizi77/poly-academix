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
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
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


@endsection

@section('script')
    <script type="text/javascript">
        var session_layout = '{{ session()->get('layout') }}';
        var ajaxUrl = "{{ route('users.ajax') }}";

    </script>

    {{--DATATABLE--}}
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/datatables/users.js') }}"></script>


@endsection
