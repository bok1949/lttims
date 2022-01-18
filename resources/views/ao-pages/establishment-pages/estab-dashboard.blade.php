@extends('layouts/admin-owner/ao-app')

@section('title')
    LTB-Tourism Establishment Dashboard
@endsection

@section('header-nav')
 
        
    
    <div class="container d-flex align-items-center">
        <div class="logo mr-auto">
            <h1 class="text-light"><a href="{{route('estab.dashboard')}}"><span>LTTIMS(LOGO)</span></a></h1>
        </div>
        @if ($loggedUserInfo->updated_at == null)
        <nav class="nav-menu d-none d-lg-block">
            <ul>
                <li><a href="{{route('ao.logout')}}">Logout</a></li>
            </ul>
        </nav><!-- .nav-menu -->
        @else
        <nav class="nav-menu d-none d-lg-block">
            <ul>
                <li class="nav-item"> <a href="{{route('estab.dashboard')}}">{{$loggedUserInfo->first_name.' '.$loggedUserInfo->last_name}}</a></li>
                <li class="nav-item"><a href="{{route('ao.logout')}}"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>
            </ul>
        </nav><!-- .nav-menu -->
        @endif
    </div>
    
@endsection

@section('content')

<main id="main" class="container-fluid">
    <div class="container-fluid pt-5">
         <div class="row h-100 mt-5">
            @if ($loggedUserInfo->updated_at === null)
            <div class="col-sm-8 offset-2">
                <h2>Change User Account Credentials</h2>
                <span class="text-center border-bottom border-danger">
                    <strong>NOTE: </strong>
                    You are required to change your Account Credentials. Note that you cannot use the same username given to you.
                </span>
                <form action="{{route('estab.submitAccountChanges')}}" method="POST">
                    @csrf
                    <div class="form-group mt-2">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control" placeholder="Enter Username..." value="{{old('username')}}">
                        <span class="text-danger">
                            @error('username')
                                {{$message}}
                            @enderror
                            @if (session()->has('fail'))
                                {{session()->get('fail')}}
                            @endif
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter password...">
                        <span class="text-danger">
                            @error('password')
                                {{$message}}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="">Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control" placeholder="Enter password...">
                        <span class="text-danger">
                            @error('confirm_password')
                                {{$message}}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary px-4">Save</button>
                    </div>
                    
                </form>
            </div>
            @else
            <aside class="col-sm-3 " id="left">
                <div class="mt-3 mb-3 sticky-top-custom " id="side">
                    <ul class="nav flex-md-column flex-row justify-content-between" id="sidenav">
                        <li class="nav-item custom-active "><a href="{{route('estab.dashboard')}}" class="nav-link pl-2"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a></li>
                        <span class="dropdown-item active my-2 mx-0" > Profile Settings</span>
                        <li class="nav-item custom-hover"><a href="{{route('estab.showInfo')}}" class="nav-link pl-2"><i class="fa fa-university" aria-hidden="true"></i> Establishment </a></li>
                        <li class="nav-item custom-hover"><a href="{{route('personal.showInfo')}}" class="nav-link pl-2"><i class="fa fa-user" aria-hidden="true"></i> Personal  </a></li>
                    </ul>
                </div>
            </aside>
            <main id="main" class="col py-4 bg-light rounded">
                <div class="row position-relative">
                    <div class="col-sm-6 ">
                        <div class="card border-left-warning-4">
                            <div class="card-body">
                                <h5 class="card-title text-danger"><i class="fa fa-users" aria-hidden="true"></i> Visitors as of {{\Carbon\Carbon::now()->format('F, Y')}}</h5>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <span class="font-italic">Total No. of Logs: </span>
                                        <span class="font-weight-bold">{{$logsCount}}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <span class="font-italic">Total No. of head count: </span> 
                                        <span class="font-weight-bold">{{$headCount}}</span>
                                    </li>
                                </ul>
                                {{-- <a href="{{route('viewvisitorbymonth')}}" class="btn btn-primary">View</a> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 ">
                        <div class="card border-left-info-4">
                            <div class="card-body">
                                <h5 class="card-title text-info"><i class="fa fa-book" aria-hidden="true"></i> Total Number of Visitor</h5>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <span class="font-italic">Total No. of Logs: </span>
                                        <span class="font-weight-bold">{{$logsCountAll}}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <span class="font-italic">Total No. of head count: </span> 
                                        <span class="font-weight-bold">{{$headCountAll}}</span>
                                    </li>
                                </ul>
                                {{-- <a href="{{route('viewallvisitors')}}" class="btn btn-primary">View</a> --}}
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="row">
                    <div class="col-sm-8 offset-2 bg-primary">
                        past visitors
                    </div>
                </div> --}}
            </main>
            @endif
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

