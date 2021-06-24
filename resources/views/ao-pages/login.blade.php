@extends('layouts/admin-owner/ao-app')

@section('title')
    LTB-Tourism Login Page
@endsection

@section('header-nav')
    <div class="container d-flex align-items-center">

        <div class="logo mr-auto">
        <h1 class="text-light"><a href="index.html"><span>LTTIMS(LOGO)</span></a></h1>
        </div>

        <nav class="nav-menu d-none d-lg-block">
        <ul>
            <li><a href="{{route('ao.home')}}">Home</a></li>
            <li class="active"><a href="{{route('ao.login')}}">Login</a></li>
            <li><a href="{{route('ao.register')}}">Register</a></li>
        </ul>
        </nav><!-- .nav-menu -->
    </div>
@endsection

@section('content')
<section id="hero" class="d-flex align-items-center">

    <div class="container">
        <div class="row">
            <div class="col-lg-6 pt-5 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
                <h1 data-aos="fade-up">La Trinidad Tourism</h1>
                <h2 data-aos="fade-up" data-aos-delay="400">La Trinidad Tourism Slogan</h2>
            </div>
            <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="fade-left" data-aos-delay="200">
                
                <div class="container-fluid" >
                    <div class="row">
                        <div class="col-md-10 offset-1">
                            <h3 class="text-center">
                                User Login
                            </h3>
                            <hr class="border border-primary">
                            <div class="results">
                                @if (Session::has('message'))
                                    <div class="alert alert-success">
                                        {!! Session::pull('message') !!}
                                    </div>
                                @endif
                            </div>
                            <form action="{{route('check-credentials')}}" method="POST">
                                @csrf
                                <div class="results">
                                    @if (Session::get('fail'))
                                        <div class="alert alert-danger">
                                            {!! Session::get('fail') !!}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" id="username" class="form-control" placeholder="Enter Username..." value="{{old('username')}}">
                                    <span class="text-danger">@error('username')
                                        {{$message}}
                                    @enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Enter password...">
                                    <span class="text-danger">@error('password')
                                        {{$message}}
                                    @enderror</span>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary px-4">Login</button>
                                    <a href="{{route('ao.register')}}" class="float-right mt-2">Create a new Account</a>
                                </div>
                                <br>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section><!-- End Hero -->
    
@endsection