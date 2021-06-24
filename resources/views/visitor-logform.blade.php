@extends('layouts/admin-owner/ao-app')

@section('title')
    LTB-Tourism Visitor Page
@endsection

@section('header-nav')
    <div class="container d-flex align-items-center">
        <div class="logo mr-auto">
            <h1 class="text-light"><a href="index.html"><span>LTTIMS(LOGO)</span></a></h1>
        </div>
    </div>
@endsection

@section('content')

<main id="main" class="">
    <!-- ======= Visitor Form ======= -->
    <section id="about" class="about mt-4 ">
        <div class="container p-2">

            <div class="section-title" data-aos="fade-up">
                <h2>{{$data->establishment_name}}</h2>
            </div>

            <div class="row">
                <div class="col">
                    <h4>ENTRY LOG</h4>
                    <p class="text-secondary">
                        Please fill in every details for future use in case of emergency. 
                        We ensure to keep your data private.
                    </p>
                    <p class="text-danger">*Required</p>
                </div>
            </div>
            @if (session()->has('success'))
            <div class="row ustify-content-md-center ">
                <div class="col">
                    <span class="alert alert-success d-block text-center" role="alert">
                        {{ session('success') }} 
                    </span>
                </div>
            </div>  
            @endif
            <div class="row content">
                <div class="col">
                <form action="{{route('visitor-logform.submit')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="full-name">Full Name <span class="text-danger">*</span></label>
                        <input type="text" name="full_name" class="form-control @error('full_name') is-invalid @enderror" id="full-name" value="{{old('full_name')}}" placeholder="Enter Full Name...">
                        @error('full_name')<span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="contact-num">Contact No. <span class="text-danger">*</span></label>
                        <input type="text" name="contact_number" class="form-control @error('contact_number') is-invalid @enderror" value="{{old('contact_number')}}" maxlength="11" placeholder="Enter Contact Number...">
                        <small class="form-text text-muted ml-2">Ex. (09091234567)</small>
                        @error('contact_number')<span class="text-danger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group p-3 shadow-sm bg-white rounded">
                        <label for="address">Address <span class="text-danger">*</span></label>
                    
                        <input type="text" name="municipality_or_city" class="form-control @error('municipality_or_city') is-invalid @enderror" id="address" value="{{old('municipality_or_city')}}" placeholder="Municipality or City...">
                        @error('municipality_or_city')<span class="text-danger">{{$message}}</span> @enderror
                   
                        <input type="text" name="province" class="form-control @error('province') is-invalid @enderror" id="address" value="{{old('province')}}" placeholder="Province...">
                        @error('province')<span class="text-danger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="temperature">Gender <span class="text-danger">*</span></label>
                        <select name="gender" class="form-control @error('temperature') is-invalid @enderror">
                            <option value="">--Select Gender--</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="lgbtq">LGBTQ</option>
                        </select>
                        @error('gender')<span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="temperature">Temperatrure <span class="text-danger">*</span></label>
                        <input type="text" name="temperature" class="form-control @error('temperature') is-invalid @enderror" value="{{old('temperature')}}" id="temperature" placeholder="Enter Temperature...">
                        @error('temperature')<span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group p-3 shadow-sm bg-white rounded">
                        <label for="pipNum">Number of People with you <span class="text-danger">*</span> <small class="text-muted">(NOTE: Inlcude yourself in the counting.)</small></label>
                        <div class="form-group form-inline d-flex justify-content-center">
                            <label for="">MALE:</label>
                            <input type="number" name="people_with_you_male" class="form-control mx-2 @error('fails') is-invalid @enderror" min="0" value="{{old('people_with_you_male')}}" placeholder="Enter a Number...">
                            <label for="">FEMALE:</label>
                            <input type="number" name="people_with_you_female" class="form-control mx-2 @error('fails') is-invalid @enderror" min="0" value="{{old('people_with_you_female')}}" placeholder="Enter a Number...">
                            <label for="">LGBTQ:</label>
                            <input type="number" name="people_with_you_lgbtq" class="form-control mx-2 @error('fails') is-invalid @enderror" min="0" value="{{old('people_with_you_lgbtq')}}" placeholder="Enter a Number..">
                        </div>
                        
                        @error('fails')
                            <span class="text-danger d-flex justify-content-center">{{$errors->first('fails')}}</span>
                        @enderror
                       
                    </div>
                    <input type="hidden" name="estab_id" value="{{$data->id}}">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                </div>
            </div>

        </div>
    </section><!-- End Visitor Form -->
</main>


@endsection