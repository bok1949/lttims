@extends('layouts/admin-owner/ao-app')

@section('title')
    LTB-Tourism Admin Page-Dashboard
@endsection

@section('header-nav')
    <div class="container d-flex align-items-center">
        <div class="logo mr-auto">
            <h1 class="text-light"><a href="{{route('ao.admin-dashboard')}}"><span>LTTIMS(LOGO)</span></a></h1>
        </div>

        <nav class="nav-menu d-none d-lg-block">
            <ul>
                <li class="nav-item"> <a href="{{route('estab.dashboard')}}">{{$loggedUserInfo->first_name.' '.$loggedUserInfo->last_name}}</a></li>
                <li class="nav-item"><a href="{{route('ao.logout')}}"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>
            </ul>
            {{-- <ul>
                <li class="drop-down"><span class="btn">{{$loggedUserInfo->first_name.' '.$loggedUserInfo->last_name}}</span>
                    <ul>
                        <li><a href="#">Profile</a></li>
                        <li><a href="{{route('ao.logout')}}">Logout</a></li>
                    </ul>
                </li>
            </ul> --}}
        </nav><!-- .nav-menu -->
    </div>
@endsection

@section('content')

<main id="main" class="container-fluid">
    <div class="container-fluid pt-5">
         <div class="row h-100 mt-5">
            <aside class="col-sm-3  border-right border-secondary" id="left">
                <div class="mt-3 mb-3 sticky-top-custom " id="side">
                    <ul class="nav flex-md-column flex-row justify-content-between" id="sidenav">
                        <li class="nav-item custom-active "><a href="{{route('ao.admin-dashboard')}}" class="nav-link pl-2"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a></li>
                        <span class="dropdown-item active my-2" >Information Management</span>
                        <li class="nav-item custom-hover "><a href="{{route('ao.manage-establishment')}}" class="nav-link pl-2"><i class="fa fa-university" aria-hidden="true"></i> Establishments {{-- <i class="fa fa-bell" aria-hidden="true"></i> --}}</a></li>
                        <li class="nav-item custom-hover "><a href="{{route('ao.manage-events')}}" class="nav-link pl-2"><i class="fa fa-calendar" aria-hidden="true"></i> Events</a></li>
                        <li class="nav-item custom-hover "><a href="{{route('ao.manage-reports')}}" class="nav-link pl-2"><i class="fa fa-suitcase" aria-hidden="true"></i> Reports</a></li>
                        <span class="dropdown-item active my-2" >Profile</span>
                        <li class="nav-item custom-hover "><a href="{{route('ao.manage-reports')}}" class="nav-link pl-2"><i class="fa fa-user" aria-hidden="true"></i></i> Profile</a></li>
                    </ul>
                </div>
            </aside>
            <main class="col py-3 ">
                <div class="row position-relative">
                    <div class="col ">
                        Admin Dashboard
                        
                    </div>
                </div>
            </main>
        </div>
    </div>
</main>
@endsection

@push('scripts')

    <script>
        
        $(document).ready(function(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
            

    </script>
@endpush

