<div id="showProfile">
    <h4 class="shadow-sm p-3 bg-white rounded">
        {{$estabInfo->establishment_name}}
        <small class="d-block text-muted f-size-1">Created-at {{date('h:iA F dS, Y', strtotime($estabInfo->created_at))}}</small>
    </h4>
    <div class="row position-relative ">
        <div class="col-sm-6 ">
            <div class="card" >
                <div class="card-body">
                    <h5 class="card-title d-inline-block">Contacts</h5>
                    <span class="d-inline-block float-right mr-3 text-secodary">Edit</span>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <i class="fa fa-phone mr-2" aria-hidden="true"></i> Phone Number: 
                            <span class="font-weight-bold"> {{$estabInfo->establishment_phonenum}}</span>
                            <a href="#" class="card-link float-right" data-valtype="estab_phone_num" wire:click="show('pn')">
                                <i class="fa fa-pencil-square-o " data-toggle="tooltip" data-placement="top" title="Edit Phone Number" aria-hidden="true"></i>
                            </a>
    
                            <div class="input-group d-none {{$pn}}" id="estab_phone_num">
                                <form wire:submit.prevent="ePhoneNumber('d-block')">
                                @if (session()->has('phone_num_mess'))
                                    <div class="row ustify-content-md-center ">
                                        <div class="col-md-12">
                                            <span class="alert alert-success d-block" role="alert">
                                                {{ session('phone_num_mess') }} 
                                            </span>
                                        </div>
                                    </div>  
                                @endif
                                <div class="row">
                                    <div class="col-sm-4 px-0">
                                        <div class="input-group-prepend">
                                            <input type="text" class="form-control text-center" value="(074)" disabled> 
                                        </div>
                                    </div>
                                    <div class="col-sm-8 px-0" >
                                        <input type="tel" wire:model.defer="phone_number" class="form-control @error('phone_number') is-invalid @enderror" maxlength="7">
                                        @error('phone_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="container-fluid">
                                    <div class="row justify-content-md-center mt-2">
                                        <div class="col-md-auto">
                                            <button type="button" wire:click="cancel('pn')"  class="btn btn-warning">Cancel</button>
                                        </div>
                                        <div class="col-md-auto">
                                            <input type="submit" wire:click="ePhoneNumber('d-flex')" wire:loading.class="d-none" class="btn btn-primary"  value="Save">
                                            <div wire:click="ePhoneNumber" wire:loading.class="spinner-border text-primary input-group-prepend" role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                </form>
                            </div>
                            
                        </li>
                        <li class="list-group-item">
                            <i class="fa fa-mobile mr-2" aria-hidden="true"></i> Mobile Number: 
                            <span class="font-weight-bold">{{$estabInfo->establishment_mobilenum}}</span>
                            <a href="" class="card-link float-right" data-valtype="estab_mobile_num" wire:click="show('mn')">
                                <i class="fa fa-pencil-square-o" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Edit Mobile Number"></i>
                            </a>
                            <form wire:submit.prevent="saveMobileNumber('d-flex')" class="d-none {{$mn}}" id="estab_mobile_num">
                                <div class="container-fluid">
                                    @if (session()->has('mobile_num_mess'))
                                    <div class="row ">
                                        <div class="col-md-12">
                                            <div class="alert alert-success ">
                                                {{ session('mobile_num_mess') }}
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="row">
                                        <div class="input-group " >
                                            <div class="input-group-prepend dropdown ">
                                                <select wire:change="netWorkPrefixes($event.target.value, 'd-flex')" id="tel_network" class="btn btn-outline-secondary form-control">
                                                    <option value="">--Network--</option>
                                                    <option value="globe">Globe/TM</option>
                                                    <option value="smart">Smart/TNT</option>
                                                    <option value="sun">Sun</option>
                                                    <option value="dito">Dito</option>
                                                </select>
                                            </div>
                                            <div class="input-group-prepend dropdown ">
                                                <select wire:change="getMobilePrefix($event.target.value)" id="tel_prefix" class="btn btn-outline-secondary form-control">
                                                    @foreach ($tel_prefix as $item)
                                                        <option value="{{$item}}">{{$item}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <input type="tel" class="form-control @error('seven_digit_mobile_number') is-invalid @enderror" wire:model.defer="seven_digit_mobile_number" maxlength="7">
                                            
                                            <div class="container-fluid">
                                                
                                                @error('seven_digit_mobile_number')
                                                <div class="row">
                                                    <div class="col">
                                                        <span class="invalid-feedback d-block" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    </div>
                                                </div>
                                                @enderror
                                                @error('mobile_number_prefix')
                                                <div class="row">
                                                    <div class="col">
                                                        <span class="invalid-feedback d-block" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    </div>
                                                </div>
                                                @enderror
                                                <div class="row justify-content-md-center mt-2">
                                                    <div class="col-md-auto">
                                                        <button type="button" wire:click="cancel('mn')" class="btn btn-warning">Cancel</button>
                                                    </div>
                                                    <div class="col-md-auto">
                                                        <input type="submit" wire:click="saveMobileNumber('d-flex')" wire:loading.class="d-none" class="btn btn-primary"  value="Save">
                                                        <div wire:click="saveMobileNumber" wire:loading.class="spinner-border text-primary input-group-prepend" role="status">
                                                            <span class="sr-only">Loading...</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </li>
                        <li class="list-group-item">
                            <i class="fa fa-envelope mr-2" aria-hidden="true"></i> Email Address:
                            <span class="font-weight-bold">{{$estabInfo->establishment_email}}</span>
                            <a href="" class="card-link float-right" data-valtype="estab_email" wire:click="show('eadd')">
                                <i class="fa fa-pencil-square-o " aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Edit Email"></i>
                            </a>
                            <form wire:submit.prevent="saveEmailAdd('d-flex')" class=" {{$eadd}}" id="estab_email">
                                
                                <div class="container-fluid " >
                                    @if (session()->has('email_add_mess'))
                                    <div class="row">
                                        <div class="col-md-12 alert alert-success">
                                            {{ session('email_add_mess') }}
                                        </div>
                                    </div>
                                    @endif
                                    <div class="row justify-content-md-center">
                                        <div class="col-md-12 ">
                                            <input type="text" class="form-control @error('establishment_email') is-invalid @enderror " wire:model.defer="establishment_email">
                                        </div>
                                        @error('establishment_email')
                                            <span class="invalid-feedback d-block text-center" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="row justify-content-md-center mt-2">
                                        <div class="col-md-auto">
                                            <button type="button" wire:click="cancel('eadd')" class="btn btn-warning">Cancel</button>
                                        </div>
                                        <div class="col-md-auto">
                                            <input type="submit" wire:click="saveEmailAdd('d-flex')" wire:loading.class="d-none" class="btn btn-primary"  value="Save">
                                            <div wire:click="saveEmailAdd" wire:loading.class="spinner-border text-primary input-group-prepend" role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </li>
                        <li class="list-group-item">
                            <i class="fa fa-facebook mr-2" aria-hidden="true"></i> Facebook Account:
                            <span class="font-weight-bold">{{$estabInfo->establishment_fb_account}}</span>
                            <a href="" class="card-link float-right" data-valtype="estab_fb" wire:click="show('estabfb')">
                                <i class="fa fa-pencil-square-o" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Edit FB"></i>
                            </a>
                            <form wire:submit.prevent="saveEstabFacebook('d-flex')" class="{{$estabfb}}" id="estab_fb">
                                <div class="container-fluid" >
                                    @if (session()->has('estab_fb_mess'))
                                    <div class="row justify-content-md-center">
                                        <div class="col-md-12 alert alert-success">
                                            {{ session('estab_fb_mess') }}
                                        </div>
                                    </div>
                                    @endif
                                    <div class="row justify-content-md-center">
                                        <div class="col">
                                            <input type="text" class="form-control @error('establishment_facebook') is-invalid @enderror" wire:model.defer="establishment_facebook">
                                        </div>
                                         @error('establishment_facebook')
                                            <span class="invalid-feedback d-block text-center" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                   
                                    <div class="row justify-content-md-center mt-2">
                                        <div class="col-md-auto">
                                            <button type="button" wire:click="cancel('estabfb')" class="btn btn-warning">Cancel</button>
                                        </div>
                                        <div class="col-md-auto">
                                            <input type="submit" wire:click="saveEstabFacebook('d-flex')" wire:loading.class="d-none" class="btn btn-primary"  value="Save">
                                            <div wire:click="saveEstabFacebook" wire:loading.class="spinner-border text-primary input-group-prepend" role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </li>
                        <li class="list-group-item">
                            <i class="fa fa-globe mr-2" aria-hidden="true"></i> Website:
                            <span class="font-weight-bold">{{$estabInfo->establishment_website}}</span>
                            <a href="" class="card-link float-right" data-valtype="estab_website" wire:click="show('estabwebsite')">
                                <i class="fa fa-pencil-square-o " aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Edit Website"></i>
                            </a>
                            <form wire:submit.prevent="saveEstabWebsite('d-flex')" class="{{$estabwebsite}}">
                                <div class="container-fluid" id="estab_website">
                                    @if (session()->has('estab_website_mess'))
                                    <div class="row justify-content-md-center">
                                        <div class="col-md-12 alert alert-success">
                                            {{ session('estab_website_mess') }}
                                        </div>
                                    </div>
                                    @endif
                                    <div class="row justify-content-md-center">
                                        <div class="col">
                                            <input type="text" class="form-control @error('establishment_website') is-invalid @enderror" wire:model.defer="establishment_website">
                                        </div>
                                        @error('establishment_website')
                                            <span class="invalid-feedback d-block text-center" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="row justify-content-md-center mt-2">
                                        <div class="col-md-auto">
                                            <button type="button" wire:click="cancel('estabwebsite')" class="btn btn-warning">Cancel</button>
                                        </div>
                                        <div class="col-md-auto">
                                            <input type="submit" wire:click="saveEstabWebsite('d-flex')" wire:loading.class="d-none" class="btn btn-primary"  value="Save">
                                            <div wire:click="saveEstabWebsite" wire:loading.class="spinner-border text-primary input-group-prepend" role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </li>
                    </ul>
                    
                </div>
            </div>
        </div>
        <div class="col-sm-6 ">
            <div class="card" >
                <div class="card-body">
                    <h5 class="card-title d-inline-block">Document Submitted</h5>
                    <span class="d-inline-block float-right mr-2">Status</span>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            Business Permit
                            @if ($estabInfo->business_permit_path != NULL)
                                <i class="fa fa-check-square-o float-right text-success" aria-hidden="true"></i>
                            @else
                                <i class="fa fa-times-circle-o float-right text-danger" aria-hidden="true"></i>
                            @endif
                        </li>
                        <li class="list-group-item">
                            Valid ID
                            @if ($estabInfo->valid_id_path != NULL)
                                <i class="fa fa-check-square-o float-right text-success" aria-hidden="true"></i>
                            @else
                                <i class="fa fa-times-circle-o float-right text-danger" aria-hidden="true"></i>
                            @endif
                        </li>
                        <li class="list-group-item">
                            Tax Identification
                            @if ($estabInfo->tax_id_path != NULL)
                                <i class="fa fa-check-square-o float-right text-success" aria-hidden="true"></i>
                            @else
                                <i class="fa fa-times-circle-o float-right text-danger" aria-hidden="true"></i>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row position-relative my-3">
        <div class="col ">
            <div class="card" >
                <div class="card-body">
                    <h5 class="card-title">Overview</h5>
                    <p class="card-text">
                        {{$estabInfo->historical_description}}
                    </p>
                    <a href="#" class="card-link" data-toggle="tooltip" data-placement="top" title="Edit History" wire:click="show('estaboverview')">
                        Edit
                        <i class="fa fa-pencil-square-o " aria-hidden="true" ></i>
                    </a>
                    <form wire:submit.prevent="saveOverview('d-flex')" class="{{$estaboverview}}">
                        <div class="container-fluid" id="estab_website">
                            @if (session()->has('estab_overview_mess'))
                            <div class="row justify-content-md-center">
                                <div class="col-md-12 alert alert-success">
                                    {{ session('estab_overview_mess') }}
                                </div>
                            </div>
                            @endif
                            <div class="row justify-content-md-center">
                                <div class="col">
                                    <textarea class="form-control @error('overview_value') is-invalid @enderror" wire:model.defer="overview_value"></textarea>
                                </div>
                                @error('overview_value')
                                    <span class="invalid-feedback d-block text-center" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row justify-content-md-center mt-2">
                                <div class="col-md-auto">
                                    <button type="button" wire:click="cancel('estaboverview')" class="btn btn-warning">Cancel</button>
                                </div>
                                <div class="col-md-auto">
                                    <input type="button" wire:click="saveOverview('d-flex')" wire:loading.class="d-none" class="btn btn-primary"  value="Save">
                                    <div wire:click="saveOverview" wire:loading.class="spinner-border text-primary input-group-prepend" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Establishment Photos --}}
    <div class="row position-relative py-3">
        <div class="col">
            <h4 class="shadow-sm p-3 bg-white rounded">
                Establishment Photos
            </h4>
            @livewire('establishment.establishment-uploaded-image')
            @if ($photoCount < 5)
                @include('ao-pages.establishment-pages.add-photo')
            @else
                <p class="alert alert-info mt-2">
                    You can no longer add Photos. Remove uploaded images and you can upload again.
                </p>
            @endif
            <div class="shadow-sm bg-white mt-2 rounded p-2">
                
                {{-- {{$folderName}} --}}
                @if (!file_exists(public_path('storage/uploads/'.$folderName.'/'.$folderName.'.png')))                        
                    <h4>Generate QR Code</h4>
                    <form action="{{route('create.qr')}}" method="post">
                            @csrf
                            <input type="submit" class="btn btn-primary" value="Generate">
                    </form>
                @else
                    <h4>Generated QR Code</h4>
                @endif
                @if (session()->has('qr_created'))
                    <div class="row justify-content-md-center">
                        <div class="col-md-12 alert alert-success">
                            {{ session('qr_created') }}
                        </div>
                    </div>
                @endif
            </div>
            @if (file_exists(public_path('storage/uploads/'.$folderName.'/'.$folderName.'.png')))
            <div class="card mt-2 ">
                <div class="card-body">
                    
                    <div class="visible-print text-center">
                        <img src="{{asset('storage/uploads/'.$folderName.'/'.$folderName.'.png')}}" alt="">                            
                    </div>
                    
                    <div class="d-flex justify-content-center mt-4">
                        <form action="{{route('dl.qr', $folderName)}}" method="get">
                            <button type="submit"  class="btn btn-info text-center">Download</button>
                        </form>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')

<script type="text/javascript">
    $(function() {
        $('#showProfile a').on('click', function(e){
            e.preventDefault();
        });
    });

</script>
    
@endpush

