<div>
    {{-- <form action="{{route('ao.estabSaveRegister')}}" method="post" enctype="multipart/form-data"> --}}
    {{-- @csrf --}}

    
    
    <form wire:submit.prevent="register">
        
        <div class="row">
            <div class="col-md-10 offset-1">
                <h3 class="h2 text-center mt-4" data-aos="fade-up">Registration</h3>
                <p class="text-muted small text-center mb-0" data-aos="fade-up" data-aos-delay="300">(for Establishments and Tourist Spots only)</p>
                <p class="small text-center text-danger my-0" data-aos="fade-up" data-aos-delay="400">NOTE: Input fields with asterisk are required</p>
                
            </div>
        </div>
        @if(session()->has('message'))
        <div class="row">
            <div class="col-md-8 offset-2">
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            </div>
        </div>
        @endif
        @if ($currentStep == 1)
        
        {{-- Establishment Information --}}
        <div class="row" id="establishment_info_row" data-aos="fade-right" data-aos-delay="600">
            <div class="col-md-8 offset-2 py-4 shadow rounded pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center" >
                <br>
                <h3 class="border-bottom border-primary" data-aos="fade-down">Establishment Information</h3>
                
                <div class="form-group row" >
                    <label class="col-sm-4 col-form-label text-right">Name of Establishment <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" wire:model.defer="establishment_name" class="form-control">
                        @error('establishment_name')
                            <span class="text-danger estab_name_empty">{{$message}}</span>
                        @enderror
                        
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-4 col-form-label text-right">Email Address <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" wire:model.defer="establishment_email" class="form-control" >
                        @error('establishment_email')
                            <span class="text-danger estab_name_empty">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row" >
                    <label class="col-sm-4 col-form-label text-right">Mobile Number <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <div class="input-group"> 
                            <input type="text" class="form-control" wire:model.defer="establishment_mobile_number" maxlength="11" >
                        </div>
                        <small class="text-muted">Example: 09191234567</small>
                        @error('establishment_mobile_number')
                            <span class="text-danger d-flex estab_name_empty">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row" >
                    <label class="col-sm-4 col-form-label text-right">Phone Number </label>
                    <div class="col-sm-8">
                        <div class="input-group">
                            <input type="text" wire:model.defer="establishment_phone_number" class="form-control" maxlength="9">
                        </div>
                        <small class="text-muted">Example: 744423939</small>
                        @error('establishment_phone_number')
                            <span class="text-danger d-flex estab_name_empty">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row" >
                    <label class="col-sm-4 col-form-label text-right">Website</label>
                    <div class="col-sm-8">
                        <input type="text" wire:model.defer="establishment_website" class="form-control" >
                    </div>
                </div>

                <div class="form-group row"  >
                    <label class="col-sm-4 col-form-label text-right">Facebook Account</label>
                    <div class="col-sm-8">
                        <input type="text" wire:model.defer="establishment_fb_account" class="form-control">
                    </div>
                </div>
            </div>
        </div>{{-- End of Establishment Information --}}
        @endif

        @if ($currentStep == 2)
            
        
        {{-- Establishment Address Information --}}
        <div class="row hid" id="establishment_address_row" data-aos="fade-right" data-aos-delay="600">
            <div class="col-md-8 offset-2 py-4 shadow rounded pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center" >
                <br>
                <h3 data-aos="fade-down">Establishment Address</h3>
                <hr class="border-bottom border-primary w-100 my-0 mb-2" data-aos="fade-right" data-aos-delay="200">

                <div class="form-group row" data-aos="fade-right" data-aos-delay="600">
                    <div class="col-sm-8 offset-2">
                        <p class="text-center h5">La Trninidad, Benguet. 2601</p>
                    </div>
                </div>

                <div class="form-group row" >
                    <label class="col-sm-4 col-form-label text-right">RM#/Floor#/Bldg#/Street <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" wire:model.defer="room_number_street" class="form-control" placeholder="Enter Room# / Floor# / Bldg# / Street..." >
                        @error('room_number_street')
                            <span class="text-danger d-flex estab_name_empty">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-4 col-form-label text-right"> Barangay <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" wire:model.defer="barangay" class="form-control" placeholder="Enter Establishment Barangay..." >
                        @error('barangay')
                            <span class="text-danger d-flex estab_name_empty">{{$message}}</span>
                        @enderror
                    </div>
                </div>

            </div>
        </div>{{-- End of Establishment Address Information --}}
        @endif

        @if ($currentStep == 3)
            
        
        {{-- Personal Information --}}
        <div class="row hid" id="personal_info_row" data-aos="fade-right" data-aos-delay="600">
            <div class="col-md-8 offset-2 py-4 shadow rounded pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center" >
                <br>
                <h4 data-aos="fade-down">Person Incharge Personal Information</h4>
                <hr class="border-bottom border-primary w-100 my-0 mb-2" data-aos="fade-right" data-aos-delay="200">

                <div class="form-group row" >
                    <label class="col-sm-2 offset-1 col-form-label text-right">First Name <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" wire:model.defer="first_name" class="form-control" placeholder="Enter First name..." >
                        @error('first_name')
                            <span class="text-danger d-flex estab_name_empty">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-sm-2 offset-1 col-form-label text-right">Last Name <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" wire:model.defer="last_name" class="form-control" placeholder="Enter Last name..." >
                        @error('last_name')
                            <span class="text-danger d-flex estab_name_empty">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row" >
                    <label class="col-sm-2 offset-1 col-form-label text-right">Middle Name </label>
                    <div class="col-sm-8">
                        <input type="text" wire:model.defer="middle_name" class="form-control" placeholder="Enter Middle name..." >
                    </div>
                </div>

                <div class="form-group row" >
                    <label class="col-sm-3 col-form-label text-right">Mobile Number <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <div class="input-group"> 
                            <input type="text" class="form-control" wire:model.defer="person_mobile_number" maxlength="11" >
                        </div>
                        <small class="text-muted">Example: 09191234567</small>

                        @error('person_mobile_number')
                            <span class="text-danger d-flex estab_name_empty">{{$message}}</span>
                        @enderror
                    </div>
                </div>

            </div>
        </div>{{-- End of Personal Information --}}
        @endif

        @if ($currentStep == 4)
        
        {{-- Upload Required Documents --}}
        <div class="row hid" id="required_docs_row" >
            <div class="col-md-8 offset-2 py-4 shadow rounded pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center" >
                <br>
                <h3 data-aos="fade-down">Upload Required Documents</h3>
                <hr class="border-bottom border-primary w-100 my-0 mb-2" data-aos="fade-right" data-aos-delay="200">

                <div class="form-group row" >
                    <label class="col-sm-3  col-form-label text-right">Business Permit <span class="text-danger">*</span></label>
                    <div class="col-sm-8 form-group">
                        <div class="custom-file">
                            <label class="custom-file-label" for="">@if($business_permit) {{$business_permit->getClientOriginalName()}} @else Choose File @endif</label>
                            <input type="file" class="custom-file-input" wire:model.defer="business_permit">
                        </div>
                        
                        @error('business_permit')
                            <span class="text-danger d-flex estab_name_empty">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                @if ($business_permit)
                    @php
                        try{
                            $url = $business_permit->temporaryUrl();
                            $status=true;
                        }catch(RuntimeException $e){
                            $status = false;
                        }
                    @endphp
                    @if ($status)
                    <div class="row mb-2">
                        <div class="col-md-8 offset-2">
                            <div class="card">
                                <div class="card-body">
                                    <img src="{{$url}}" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                       
                    @endif
                @endif
                <div class="form-group row" >
                    <label class="col-sm-3  col-form-label text-right">Valid Identification <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <div class="custom-file">
                            <label class="custom-file-label" for="">@if($valid_id) {{$valid_id->getClientOriginalName()}} @else Choose File @endif</label>
                            <input type="file" class="custom-file-input" wire:model.defer="valid_id">
                        </div>
                        @error('valid_id')
                            <span class="text-danger d-flex estab_name_empty">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                @if ($valid_id)
                    @php
                        try{
                            $url = $valid_id->temporaryUrl();
                            $status=true;
                        }catch(RuntimeException $e){
                            $status = false;
                        }
                    @endphp
                    @if ($status)
                        <div class="row mb-2">
                            <div class="col-md-8 offset-2">
                                <div class="card">
                                    <div class="card-body">
                                        <img src="{{$url}}" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
                <div class="form-group row" >
                    <label class="col-sm-3  col-form-label text-right">Tax Identification <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <div class="custom-file">
                            <label class="custom-file-label" for="">@if($tax_id) {{$tax_id->getClientOriginalName()}} @else Choose File @endif</label>
                            <input type="file" class="custom-file-input" wire:model.defer="tax_id">
                        </div>
                        @error('tax_id')
                            <span class="text-danger d-flex estab_name_empty">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                @if ($tax_id)
                    @php
                        try{
                            $url = $tax_id->temporaryUrl();
                            $status=true;
                        }catch(RuntimeException $e){
                            $status = false;
                        }
                    @endphp
                    @if ($status)
                        <div class="row mb-2">
                            <div class="col-md-8 offset-2">
                                <div class="card">
                                    <div class="card-body">
                                        <img src="{{$url}}" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>{{-- End of Person Incharge Login Credentials --}}
        @endif

        <div class="row">
            <div class="col-md-8 offset-2 shadow pb-4 pt-4 mt-4 d-flex justify-content-between" >
                @if ($currentStep == 1)
                    <div></div>
                @endif

                @if ($currentStep == 2 || $currentStep == 3 || $currentStep == 4)
                    <button type="button" class="btn btn-md btn-secondary" wire:click="decreaseStep()">Back</button>
                @endif

                @if ($currentStep == 1 || $currentStep == 2 || $currentStep == 3)
                    <button type="button" class="btn btn-md btn-success" wire:click="increaseStep()">Next</button>
                @endif
                
                @if ($currentStep == 4)
                    <button type="submit" class="btn btn-md btn-primary">Submit</button>
                @endif
                
            </div>
        </div>
        
    </form>
</div>
