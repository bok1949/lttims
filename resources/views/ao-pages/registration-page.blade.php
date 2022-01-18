@extends('layouts/admin-owner/ao-app')

@section('title')
    LTB-Tourism Registration Page
@endsection

@section('header-nav')
    <div class="container d-flex align-items-center">

        <div class="logo mr-auto">
        <h1 class="text-light"><a href="index.html"><span>LTTIMS(LOGO)</span></a></h1>
        </div>

        <nav class="nav-menu d-none d-lg-block">
        <ul>
            <li><a href="{{route('ao.home')}}">Home</a></li>
            <li><a href="{{route('ao.login')}}">Login</a></li>
            <li class="active"><a href="{{route('ao.register')}}">Register</a></li>
        </ul>
        </nav><!-- .nav-menu -->
    </div>
@endsection

@section('content')

    <main id="main">
        <section class="d-flex align-items-center">
             
            <div class="container">
                
                @livewire('establishment-registration')
            </div>
        </section>
    </main>
@endsection

@push('scripts')

    <script type="text/javascript">
        
        $(document).ready(function(){
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
           
            /* $('#next_estab_info').on('click', function(e){
                e.preventDefault();
            }) */
            /* Establishment Mobile Number */
        });
    </script>
@endpush

