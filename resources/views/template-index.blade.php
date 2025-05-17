@extends('layouts.master')

@section('title', 'Default')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/prism.css') }}">
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

    <div class="container-fluid">
        <div class="row starter-main">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Kick start your project development !</h5>
                    </div>
                    <div class="card-body">
                        <p>Getting start with your project custom requirements using a ready template which is quite difficult and time taking process, Cuba Admin provides useful features to kick
                            start your project development with no efforts !</p>
                        <ul>
                            <li>
                                <p>Cuba Admin provides you getting start pages with different layouts, use the layout as per your custom requirements and just change the branding, menu & content.</p>
                            </li>
                            <li>
                                <p>Every components in Cuba Admin are decoupled, it means use only components you actually need! Remove unnecessary and extra code easily just by excluding the path to
                                    specific SCSS, JS file.</p>
                            </li>
                            <li>
                                <p>It use PUG as template engine to generate pages and whole template quickly using node js. Save your time for doing the common changes for each page (i.e menu,
                                    branding and footer) by generating template with pug.</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        var session_layout = '{{ session()->get('layout') }}';
    </script>

@endsection

@section('script')
@endsection
