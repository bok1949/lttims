@extends('layouts/admin-owner/ao-app')

@section('title')
    LTB-Tourism Personal Profile-Settings
@endsection

@section('header-nav')
    <div class="container d-flex align-items-center">
        <div class="logo mr-auto">
            <h1 class="text-light"><a href="{{route('estab.dashboard')}}"><span>LTTIMS(LOGO)</span></a></h1>
        </div>
        <nav class="nav-menu d-none d-lg-block">
            <ul>
                <li class="nav-item"> <a href="{{route('estab.dashboard')}}">{{$loggedUserInfo->first_name.' '.$loggedUserInfo->last_name}}</a></li>
                <li class="nav-item"><a href="{{route('ao.logout')}}"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>
            </ul>
        </nav><!-- .nav-menu -->
    </div>
    
@endsection

@section('content')

<main id="main" class="container-fluid">
    <div class="container-fluid pt-5">
         <div class="row h-100 mt-5">
            <aside class="col-sm-3  " id="left">
                <div class="mt-3 mb-3 sticky-top-custom " id="side">
                    <ul class="nav flex-md-column flex-row justify-content-between" id="sidenav">
                        <li class="nav-item custom-hover "><a href="{{route('estab.dashboard')}}" class="nav-link pl-2"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a></li>
                        <span class="dropdown-item active my-2 mx-0" > Profile Settings</span>
                        <li class="nav-item custom-hover"><a href="{{route('estab.showInfo')}}" class="nav-link pl-2"><i class="fa fa-university" aria-hidden="true"></i> Establishment </a></li>
                        <li class="nav-item custom-active "><a href="" class="nav-link pl-2"><i class="fa fa-user" aria-hidden="true"></i> Personal  </a></li>
                        <span class="dropdown-item active my-2 mx-0" > Report Settings</span>
                        <li class="nav-item custom-hover"><a href="{{route('viewreport')}}" class="nav-link pl-2"><i class="fa fa-suitcase" aria-hidden="true"></i> Report  </a></li>
                    </ul>
                </div>
            </aside>
            <main class="col p-3 bg-light rounded ">
                <h4 class="shadow-sm p-3 bg-white rounded">
                    {{$loggedUserInfo->establishment_name}}
                    <small class="d-block text-muted f-size-1">Created-at {{date('h:iA F dS, Y', strtotime($loggedUserInfo->created_at))}}</small>
                </h4>
                @livewire('establishment.show-personal-profile')
            </main>
        </div>
    </div>
</main>
@endsection



