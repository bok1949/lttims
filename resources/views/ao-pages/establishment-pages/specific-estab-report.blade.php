@extends('layouts/admin-owner/ao-app')

@section('title')
    LTB-Tourism Establishment Report
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
            <aside class="col-sm-3 " id="left">
                <div class="mt-3 mb-3 sticky-top-custom " id="side">
                    <ul class="nav flex-md-column flex-row justify-content-between" id="sidenav">
                        <li class="nav-item custom-hover "><a href="{{route('estab.dashboard')}}" class="nav-link pl-2"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a></li>
                        <span class="dropdown-item active my-2 mx-0" > Profile Settings</span>
                        <li class="nav-item custom-hover"><a href="{{route('estab.showInfo')}}" class="nav-link pl-2"><i class="fa fa-university" aria-hidden="true"></i> Establishment </a></li>
                        <li class="nav-item custom-hover"><a href="{{route('personal.showInfo')}}" class="nav-link pl-2"><i class="fa fa-user" aria-hidden="true"></i> Personal  </a></li>
                        <span class="dropdown-item active my-2 mx-0" > Report Settings</span>
                        <li class="nav-item custom-active"><a href="{{route('viewreport')}}" class="nav-link pl-2"><i class="fa fa-suitcase" aria-hidden="true"></i> Report  </a></li>
                    </ul>
                </div>
            </aside>
            <main id="main" class="col py-4 bg-light rounded">
                <h4 class="shadow-sm p-3 bg-white">
                    {{$loggedUserInfo->establishment_name}}
                    <small class="d-block text-muted f-size-1">Created-at {{date('h:iA F dS, Y', strtotime($loggedUserInfo->created_at))}}</small>
                </h4>
                @if ($numVisitorMonth->count() < 0)
                    <div class="alert alert-warning text-center">
                        No record available
                    </div>
                @else
                    <h4 class="p-2 text-center text-secondary">
                        Visitors of {{\Carbon\Carbon::now()->format('F')}}
                    </h4>
                    @php
                        $ctr = 1;
                    @endphp
                    <table class="table table-hover bg-white" >
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Contact #</th>
                                <th scope="col">Temperature</th>
                                <th scope="col">Address</th>
                                <th scope="col">Male companion</th>
                                <th scope="col">Female companion</th>
                                <th scope="col">LGBTQ companion</th>
                                <th scope="col">Total companion</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($numVisitorMonth as $item)
                                <tr scope="row">
                                    <td>{{$ctr}}</td>
                                    <td>{{$item->full_name}}</td>
                                    <td>{{$item->contact_number}}</td>
                                    <td>{{$item->temperature}}</td>
                                    <td>{{$item->city_municipality.', '.$item->province}}</td>
                                    <td>{{$item->people_with_you_male}}</td>
                                    <td>{{$item->people_with_you_female}}</td>
                                    <td>{{$item->people_with_you_lgbtq}}</td>
                                    <td>{{$item->people_with_you_male+$item->people_with_you_female+$item->people_with_you_lgbtq}}</td>
                                </tr>
                                @php
                                    $ctr++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                    <div class="col">
                        {{$numVisitorMonth->links()}}
                    </div>
                @endif
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

