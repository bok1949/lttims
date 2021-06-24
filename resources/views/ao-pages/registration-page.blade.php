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
                
                <form action="{{route('ao.estabSaveRegister')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-10 offset-1">
                        <h3 class="h2 text-center mt-4" data-aos="fade-up">Registration</h3>
                        <p class="text-muted small text-center mb-0" data-aos="fade-up" data-aos-delay="300">(for Establishments and Tourist Spots only)</p>
                        <p class="small text-center text-danger my-0" data-aos="fade-up" data-aos-delay="400">NOTE: Input fields with asterisk are required</p>
                        {{-- <hr class="border border-primary"> --}}
                    </div>
                </div>
                @if (session()->has('message'))
                    <div class="row">
                        <div class="col-sm-8 offset-2 mt-2">
                            <div class="alert alert-success text-center">
                                {{session()->get('message')}}
                            </div>
                        </div>
                    </div>
                @endif
                {{-- Establishment Information --}}
                <div class="row" id="establishment_info_row">
                    <div class="col-md-8 offset-2 py-4 shadow rounded pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center" >
                        <br>
                        <h3 class="border-bottom border-primary" data-aos="fade-down">Establishment Information</h3>
                       
                        <div class="form-group row" data-aos="fade-right" data-aos-delay="600">
                            <label class="col-sm-4 col-form-label text-right">Name of Establishment <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" name="estab_name" class="form-control">
                                <span class="text-danger estab_name_empty"></span>
                            </div>
                        </div>

                        <div class="form-group row" data-aos="fade-right" data-aos-delay="600">
                            <label class="col-sm-4 col-form-label text-right">Email Address <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" name="estab_email" class="form-control" >
                                <span class="text-danger estab_email_empty"></span>
                            </div>
                        </div>

                        <div class="form-group row" data-aos="fade-right" data-aos-delay="600">
                            <label class="col-sm-4 col-form-label text-right">Mobile Number <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <div class="input-group-prepend dropdown ">
                                        <select name="tel_network" id="tel_network" class="btn btn-outline-secondary form-control">
                                            <option value="">--Network--</option>
                                            <option value="globe">Globe/TM</option>
                                            <option value="smart">Smart/TNT</option>
                                            <option value="sun">Sun</option>
                                            <option value="dito">Dito</option>
                                        </select>
                                    </div>
                                    <div class="input-group-prepend dropdown">
                                        <select name="tel_prefix" id="tel_prefix" class="btn btn-outline-secondary form-control">
                                            <option value="">-- # --</option>
                                        </select>
                                    </div>
                                    <input type="text" class="form-control col-sm-2 text-center" id="prefix" disabled> <span class="mx-1 mt-2"> &ndash; </span> 
                                    <input type="tel" class="form-control" id="seven_digits" name="estab_sevendigit_mobile" maxlength="7">
                                    <input type="hidden" class="form-control" name="estab_mobile_number">
                                </div>
                                <span class="text-danger estab_mobile_error"></span>
                            </div>
                        </div>

                        <div class="form-group row" data-aos="fade-right" data-aos-delay="600">
                            <label class="col-sm-4 col-form-label text-right">Phone Number </label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <input type="text" class="form-control  text-center btn btn-outline-secondary" id="prefix" value="(074)" disabled> 
                                    </div>
                                    <input type="text" name="estab_phone_num" class="form-control" >
                                </div>
                                <span class="text-danger estab_phone_num_empty"></span>
                            </div>
                        </div>

                        <div class="form-group row" data-aos="fade-right" data-aos-delay="600">
                            <label class="col-sm-4 col-form-label text-right">Website</label>
                            <div class="col-sm-8">
                                <input type="text" name="estab_website" class="form-control" >
                                <span class="text-danger"></span>
                            </div>
                        </div>

                        <div class="form-group row" data-aos="fade-right" data-aos-delay="600">
                            <label class="col-sm-4 col-form-label text-right">Facebook Account</label>
                            <div class="col-sm-8">
                                <input type="text" name="estab_fb" class="form-control">
                                <span class="text-danger"></span>
                            </div>
                        </div>

                        <div class="form-group row" data-aos="fade-right" data-aos-delay="400">
                            <div class="col-sm-6 offset-3">
                                <button class="form-control btn btn-info" id="next_estab_info">Next</button>
                            </div>
                        </div>
                    </div>
                </div>{{-- End of Establishment Information --}}

                {{-- Establishment Address Information --}}
                <div class="row hid" id="establishment_address_row">
                    <div class="col-md-8 offset-2 py-4 shadow rounded pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center" >
                        <br>
                        <h3 data-aos="fade-down">Establishment Address</h3>
                        <hr class="border-bottom border-primary w-100 my-0 mb-2" data-aos="fade-right" data-aos-delay="200">

                        <div class="form-group row" data-aos="fade-right" data-aos-delay="600">
                            <div class="col-sm-8 offset-2">
                                <p class="text-center h5">La Trninidad, Benguet. 2601</p>
                            </div>
                        </div>

                        <div class="form-group row" data-aos="fade-right" data-aos-delay="600">
                            <label class="col-sm-4 col-form-label text-right">RM#/Floor#/Bldg#/Street <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" name="frbs" class="form-control" placeholder="Enter Room# / Floor# / Bldg# / Street..." >
                                <span class="text-danger frbs_error"></span>
                            </div>
                        </div>

                        <div class="form-group row" data-aos="fade-right" data-aos-delay="600">
                            <label class="col-sm-4 col-form-label text-right"> Barangay <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" name="estab_barangay" class="form-control" placeholder="Enter Establishment Barangay..." >
                                <span class="text-danger estab_barangay_error"></span>
                            </div>
                        </div>

                        <div class="form-group row" data-aos="fade-right" data-aos-delay="600">
                            <div class="col-sm-6 offset-3">
                                <button class="form-control btn btn-info" id="next_address_info">Next</button>
                            </div>
                        </div>
                    </div>
                </div>{{-- End of Establishment Address Information --}}

                {{-- Personal Information --}}
                <div class="row hid" id="personal_info_row">
                    <div class="col-md-8 offset-2 py-4 shadow rounded pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center" >
                        <br>
                        <h4 data-aos="fade-down">Person Incharge Personal Information</h4>
                        <hr class="border-bottom border-primary w-100 my-0 mb-2" data-aos="fade-right" data-aos-delay="200">

                        <div class="form-group row" data-aos="fade-right" data-aos-delay="400">
                            <label class="col-sm-2 offset-1 col-form-label text-right">First Name <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" name="first_name" class="form-control" placeholder="Enter First name..." >
                                <span class="text-danger first_name_error"></span>
                            </div>
                        </div>
                        
                        <div class="form-group row" data-aos="fade-right" data-aos-delay="500">
                            <label class="col-sm-2 offset-1 col-form-label text-right">Last Name <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" name="last_name" class="form-control" placeholder="Enter Last name..." >
                                <span class="text-danger last_name_error"></span>
                            </div>
                        </div>

                        <div class="form-group row" data-aos="fade-right" data-aos-delay="600">
                            <label class="col-sm-2 offset-1 col-form-label text-right">Middle Name </label>
                            <div class="col-sm-8">
                                <input type="text" name="middle_name" class="form-control" placeholder="Enter Middle name..." >
                                <span class="text-danger middle_name_error"></span>
                            </div>
                        </div>

                        <div class="form-group row" data-aos="fade-right" data-aos-delay="600">
                            <label class="col-sm-3 col-form-label text-right">Mobile Number <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend dropdown ">
                                        <select name="tel_network" id="pi_tel_network" class="btn btn-outline-secondary form-control">
                                            <option value="">--Network--</option>
                                            <option value="globe">Globe/TM</option>
                                            <option value="smart">Smart/TNT</option>
                                            <option value="sun">Sun</option>
                                            <option value="dito">Dito</option>
                                        </select>
                                    </div>
                                    <div class="input-group-prepend dropdown">
                                        <select name="tel_prefix" id="pi_tel_prefix" class="btn btn-outline-secondary form-control">
                                            <option value="">-- # --</option>
                                        </select>
                                    </div>
                                    <input type="text" class="form-control col-sm-2 text-center" id="pi_prefix" disabled> <span class="mx-1 mt-2"> &ndash; </span> 
                                    <input type="tel" class="form-control" id="pi_seven_digits" name="pi_sevendigit_mobile" maxlength="7">
                                    <input type="hidden" class="form-control" name="pi_mobile_number">
                                </div>
                                <span class="text-danger pi_mobile_error"></span>
                            </div>
                        </div>


                        <div class="form-group row" data-aos="fade-right" data-aos-delay="600">
                            <div class="col-sm-6 offset-3">
                                <button class="form-control btn btn-info" id="next_personal_info">Next</button>
                            </div>
                        </div>
                    </div>
                </div>{{-- End of Personal Information --}}

                {{-- Upload Required Documents --}}
                <div class="row hid" id="required_docs_row">
                    <div class="col-md-8 offset-2 py-4 shadow rounded pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center" >
                        <br>
                        <h3 data-aos="fade-down">Upload Required Documents</h3>
                        <hr class="border-bottom border-primary w-100 my-0 mb-2" data-aos="fade-right" data-aos-delay="200">


                        <div class="form-group row" data-aos="fade-right" data-aos-delay="600">
                            <label class="col-sm-3  col-form-label text-right">Business Permit <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="business_permit" id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                                <span class="text-danger business_permit_error"></span>
                            </div>
                        </div>

                        <div class="form-group row" data-aos="fade-right" data-aos-delay="600">
                            <label class="col-sm-3  col-form-label text-right">Valid Identification <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="valid_id" id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                                <span class="text-danger valid_id_error"></span>
                            </div>
                        </div>

                        <div class="form-group row" data-aos="fade-right" data-aos-delay="600">
                            <label class="col-sm-3  col-form-label text-right">Tax Identification <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="tax_id" id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                                <span class="text-danger tax_id_error"></span>
                            </div>
                        </div>

                        <div class="form-group row login-cred-row" data-aos="fade-right" data-aos-delay="600">
                            <div class="col-sm-6 offset-3">
                                <button class="form-control btn btn-info" id="next_required_docs">Next</button>
                            </div>
                        </div>

                    </div>
                </div>{{-- End of Person Incharge Login Credentials --}}
                
                <div class="row hid show_finish_button">
                    <div class="col-md-8 offset-2 py-4 shadow rounded pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center" >
                        <div class="form-group row mt-4" data-aos="fade-right" data-aos-delay="600">
                            <div class="col-sm-6 offset-3">
                                <button type="submit" class="form-control btn btn-info" id="finish_establishment">Finish</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                </form>
            </div>
        </section>
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

            /* Establishment Mobile Number */
            $('#tel_network').on('change', function(){
                /* console.log($(this).val()); */
                if($(this).val()==''){
                    $('#prefix').val('');
                }
                moileNumberSelect($(this).val(), $('#tel_prefix'));
            });

            $('#tel_prefix').on('change', function(){
                $('#prefix').val($(this).val());
            });

            /* Person-in-charge Mobile Number */
            $('#pi_tel_network').on('change', function(){
                if($(this).val()==''){
                    $('#pi_prefix').val('');
                }
                moileNumberSelect($(this).val(), $('#pi_tel_prefix'));
            });

            $('#pi_tel_prefix').on('change', function(){
                $('#pi_prefix').val($(this).val());
            });

            
            $('.hid').hide();

            /* Click next buttons */
            $("#next_estab_info").on('click', function(e){
                e.preventDefault();

                if(isEmpty($('input[name="estab_name"]').val())){
                    $('.estab_name_empty').text("This is required!");
                }else{
                    $('.estab_name_empty').empty();
                } 
                
                if(isEmpty($('input[name="estab_sevendigit_mobile"]').val())){
                    $('.estab_mobile_error').text("This is required!");
                }else if(($('input[name="estab_sevendigit_mobile"]').val()).length != 7){
                    $('.estab_mobile_error').text("You must put the seven digit of your mobile number!");
                }else{
                    $('.estab_mobile_error').empty();
                    $('input[name="estab_mobile_number"]').val($('#prefix').val()+$('#seven_digits').val());
                } 
                
                if (isEmpty($('input[name="estab_email"]').val())){
                    $('.estab_email_empty').text("This is required!");
                }else if (validateEmail($('input[name="estab_email"]').val())){
                    $('.estab_email_empty').text("Invalid Email Address!");
                }else{
                    $('.estab_email_empty').empty();
                }

                if (!isEmpty($('input[name="estab_name"]').val()) && !isEmpty($('input[name="estab_contact_num"]').val()) && 
                !isEmpty($('input[name="estab_email"]').val()) && !validateEmail($('input[name="estab_email"]').val()) &&
                !isEmpty($('input[name="estab_sevendigit_mobile"]').val())){
                    console.log("passed validation");
                    $('#establishment_info_row').hide();
                    $('#establishment_address_row').show();
                }
            });

            $('#next_address_info').on('click', function(e){
                e.preventDefault();

                if (isEmpty($('input[name="frbs"]').val())){
                    $('.frbs_error').text('This is required');
                }else{
                    $('.frbs_error').empty();
                }

                if(isEmpty($('input[name="estab_barangay"]').val())){
                    $('.estab_barangay_error').text('This is required');
                }else{
                    $('.estab_barangay_error').empty();
                }

                if(!isEmpty($('input[name="frbs"]').val()) && !isEmpty($('input[name="estab_barangay"]').val())){
                    /* console.log("Address infoe valid"); */
                    $('#establishment_address_row').hide();
                    $('#personal_info_row').show();
                }
            });

            $('#next_personal_info').on('click', function(e){
                e.preventDefault();
                if (isEmpty($('input[name="first_name"]').val())) {
                    $('.first_name_error').text('This is required');
                }else{
                    $('.first_name_error').empty();
                }

                if (isEmpty($('input[name="last_name"]').val())) {
                    $('.last_name_error').text('This is required');
                }else{
                    $('.last_name_error').empty();
                }

                if (isEmpty($('input[name="pi_sevendigit_mobile"]').val())) {
                    $('.pi_mobile_error').text('This is required');
                }else if (($('input[name="pi_sevendigit_mobile"]').val()).length != 7){
                    $('.pi_mobile_error').text('You must put the seven digit of your mobile number!');
                }else{
                    $('.pi_mobile_error').empty();
                    $('input[name="pi_mobile_number"]').val($('#pi_prefix').val()+$('#pi_seven_digits').val());
                }

                
                if (!isEmpty($('input[name="first_name"]').val()) && !isEmpty($('input[name="last_name"]').val()) && 
                !isEmpty($('input[name="pi_sevendigit_mobile"]').val()) &&
                ($('input[name="pi_sevendigit_mobile"]').val()).length == 7){
                    $('#personal_info_row').hide();
                    $('#required_docs_row').show();
                }

            });

            $('#next_required_docs').on('click', function(e){
                e.preventDefault();
                if(isEmpty($("input[name='business_permit']").val())){
                    $('.business_permit_error').text('This is required!');
                }
                if(isEmpty($("input[name='valid_id']").val())){
                    $('.valid_id_error').text('This is required!');
                }
                if(isEmpty($("input[name='tax_id']").val())){
                    $('.tax_id_error').text('This is required!');
                }
                /* console.log($("input[name='business_permit']").val());
                console.log($("input[name='valid_id']").val());
                console.log($("input[name='tax_id']").val()); */
                if(!isEmpty($("input[name='business_permit']").val()) && !isEmpty($("input[name='valid_id']").val()) && 
                !isEmpty($("input[name='tax_id']").val())){
                    /* console.log('all have passed validation'); */
                    $('#required_docs_row').hide();
                    /* $('#show_finish_button').parent().removeClass('hid'); */
                    $('.show_finish_button').show();
                    /* console.log('Show finsihed button'); */
                }
            });/* End of Click NEXT button */

            $(".custom-file-input").on("change", function() {
                let fileName = $(this).val().split("\\").pop();                
                let extFileName = $(this).val().split('.').pop().toLowerCase();
                /* console.log(extFileName); */
                /* console.log($(this)[0].files[0].size); */
                if(!checkExtensionFileName(extFileName)){
                   $(this).parent().siblings('.text-danger').text('The valid file type must be in jpeg, jpg, or png type only.');
                }else if($(this)[0].files[0].size > 26214400){
                    $(this).parent().siblings('.text-danger').text('File size must not exceed to 25MB. Your File has '+$(this)[0].files[0].size);
                }else{
                    /* 26214400 byte = 25mb */
                    /* console.log('files ar ok'); */
                    $(this).parent().siblings('.text-danger').empty();
                    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                }
            });
        });

        function moileNumberSelect(networkVal, selectOption){
            if(networkVal == 'globe'){
                selectOption.empty();
                $.each(globeTMPrefix(), function(index, value){
                    selectOption.append(
                        "<option value='"+value+"'>"+
                        value +
                        "</option>"
                    );
                });
            }else if(networkVal == 'smart'){
                selectOption.empty();
                $.each(smartTNTPrefix(), function(index, value){
                    selectOption.append(
                        "<option value='"+value+"'>"+
                        value +
                        "</option>"
                    );
                });
            }else if(networkVal == 'sun'){
                selectOption.empty();
                $.each(sunPrefix(), function(index, value){
                    selectOption.append(
                        "<option value='"+value+"'>"+
                        value +
                        "</option>"
                    );
                });
            }else if(networkVal == 'dito'){
                selectOption.empty();
                $.each(ditoPrefix(), function(index, value){
                    selectOption.append(
                        "<option value='"+value+"'>"+
                        value +
                        "</option>"
                    );
                });
            }else{
                selectOption.empty();
                selectOption.append(
                        "<option value=''>-- # --</option>"
                    );
            }
        }

        function checkExtensionFileName(value){
            switch (value) {
                case 'jpg':
                    return true;
                    break;
                case 'jpeg':
                    return true;
                    break;
                case 'png':
                    return true;
                    break;
                default:
                    return false;
                    break;
            }
        }

        function isEmpty(input){
            if(input == ''){
                return true;
            }else{
                return false;
            }
        }

        function validateEmail(email) {
            const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if(!re.test(String(email).toLowerCase())){
                return true;
            }else{
                return false;
            }
        }

        function checkCPNumber(cp_number){
            /* let prefix = cp_number.substring(0, 4); */
            
            let networkPrefixes = [
                '0813', '0918',	'0940', '0970', '0907', '0919', '0946', '0981',
                '0908', '0920',	'0947', '0989', '0909', '0921',	'0948', '0992',
                '0910', '0928',	'0949', '0998', '0911', '0929',	'0950', '0999',
                '0912', '0930',	'0951', '0963', '0913', '0938',	'0961', '0914', 
                '0939', '0968', '0817', '0927',	'0955', '0977', '0905', '0935',	
                '0956', '0978', '0906', '0936',	'0965', '0979', '0915', '0937',	
                '0966', '0994', '0916', '0945',	'0967', '0995', '0917', '0953',	
                '0973', '0996', '0926', '0954',	'0975', '0997', '0922', '0933',	
                '0944', '0923', '0934', '0973', '0924', '0940',	'0974', '0925', 
                '0941', '0931', '0942', '0932', '0943'
                ];
            /* console.log(prefix);
            console.log(networkPrefixes.includes(prefix)); */
            if(networkPrefixes.includes(prefix)){
                return true;
            }else{
                return false;
            }
        }

        function smartTNTPrefix(){
            
            let pre = [
                '0813', '0907', '0908', '0909', '0910', '0911', '0912', '0913', '0914', '0918', 
                '0919', '0920', '0921', '0928', '0929', '0930', '0938', '0939', '0946', '0947', 
                '0948', '0949', '0950', '0951', '0961', '0963', '0968', '0970', '0981', '0989',  
                '0992', '0998', '0999'
            ];
            return pre;
        }

        function globeTMPrefix(){
           
           let pre = [
                '0817', '0905', '0906', '0915', '0916', '0917', '0926', '0927', '0935', '0936', 
                '0937', '0945', '0953', '0954', '0955', '0956', '0965', '0966', '0967', '0975', 
                '0976', '0977', '0978', '0979', '0994', '0995', '0996', '0997' 
           ];
           return pre;
        }

        function ditoPrefix(){
            let pre = [
                '0991', '0992', '0993', '0994', '0895', '0896', '0897', '0898'
            ];
            return pre;
        }

        function sunPrefix(){
            let pre = [
                '0922', '0923', '0924', '0925', '0931', '0932', '0933', '0934', 
                '0940', '0941', '0942', '0943', '0944', '0973', '0974' 
            ];
            return pre;
        }

        function phoneNumPrefix(){
            let pre = [
                '074'
            ];
        }

    </script>
@endpush

