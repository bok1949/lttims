
<div id="showPersonalProfile">
    <div class="row position-relative ">
        <div class="col-sm-6 ">
            <div class="card" >
                <div class="card-body">
                    <h5 class="card-title d-inline-block">Personal Information</h5>
                    <span class="d-inline-block float-right mr-3 text-secodary">Edit</span>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <i class="fa fa-user-circle mr-2" aria-hidden="true"></i> Last Name: 
                            <span class="font-weight-bold"> {{$userInfo->last_name}}</span>
                            <a href="#" class="card-link float-right" wire:click="show('lnamehs')">
                                <i class="fa fa-pencil-square-o " data-toggle="tooltip" data-placement="top" title="Edit Last Name" aria-hidden="true"></i>
                            </a>
                            @if (session()->has('lastname'))
                            <div class="row justify-content-md-center">
                                <div class="col-md-12 alert alert-success">
                                    {{ session('lastname') }}
                                </div>
                            </div>
                            @endif
                            <form wire:submit.prevent="saveLastName('d-flex')" class="{{$lnamehs}}">
                                <div class="container-fluid" id="estab_website">
                                    
                                    <div class="row justify-content-md-center">
                                        <div class="col">
                                            <input type="text" class="form-control @error('last_name_input') is-invalid @enderror" wire:model.defer="last_name_input">
                                        </div>
                                        @error('last_name_input')
                                            <span class="invalid-feedback d-block text-center" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="row justify-content-md-center mt-2">
                                        <div class="col-md-auto">
                                            <button type="button" wire:click="cancel('lnamehs')" class="btn btn-warning">Cancel</button>
                                        </div>
                                        <div class="col-md-auto">
                                            <input type="submit" wire:click="saveLastName('d-flex')" wire:loading.class="d-none" class="btn btn-primary"  value="Save">
                                            <div wire:click="saveLastName" wire:loading.class="spinner-border text-primary input-group-prepend" role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </li>
                        <li class="list-group-item">
                            <i class="fa fa-user-circle mr-2" aria-hidden="true"></i> First Name: 
                            <span class="font-weight-bold">{{$userInfo->first_name}}</span>
                            <a href="#" class="card-link float-right" wire:click="show('fnamehs')">
                                <i class="fa fa-pencil-square-o" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Edit First Name"></i>
                            </a>
                            @if (session()->has('firstname'))
                            <div class="row justify-content-md-center">
                                <div class="col-md-12 alert alert-success">
                                    {{ session('firstname') }}
                                </div>
                            </div>
                            @endif
                            <form wire:submit.prevent="saveFirstName('d-flex')" class="{{$fnamehs}}">
                                <div class="container-fluid" id="estab_website">
                                    
                                    <div class="row justify-content-md-center">
                                        <div class="col">
                                            <input type="text" class="form-control @error('first_name_input') is-invalid @enderror" wire:model.defer="first_name_input">
                                        </div>
                                        @error('first_name_input')
                                            <span class="invalid-feedback d-block text-center" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="row justify-content-md-center mt-2">
                                        <div class="col-md-auto">
                                            <button type="button" wire:click="cancel('fnamehs')" class="btn btn-warning">Cancel</button>
                                        </div>
                                        <div class="col-md-auto">
                                            <input type="submit" wire:click="saveFirstName('d-flex')" wire:loading.class="d-none" class="btn btn-primary"  value="Save">
                                            <div wire:click="saveFirstName" wire:loading.class="spinner-border text-primary input-group-prepend" role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </li>
                        <li class="list-group-item">
                            <i class="fa fa-user-circle mr-2" aria-hidden="true"></i> Middle Name: 
                            <span class="font-weight-bold">{{$userInfo->middle_name}}</span>
                            <a href="#" class="card-link float-right" wire:click="show('mnamehs')">
                                <i class="fa fa-pencil-square-o" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Edit Middle Name"></i>
                            </a>
                            @if (session()->has('middlename'))
                            <div class="row justify-content-md-center">
                                <div class="col-md-12 alert alert-success">
                                    {{ session('middlename') }}
                                </div>
                            </div>
                            @endif
                            <form wire:submit.prevent="saveMiddleName('d-flex')" class="{{$mnamehs}}">
                                <div class="container-fluid" id="estab_website">
                                    
                                    <div class="row justify-content-md-center">
                                        <div class="col">
                                            <input type="text" class="form-control " wire:model.defer="middle_name_input">
                                        </div>
                                    </div>
                                    <div class="row justify-content-md-center mt-2">
                                        <div class="col-md-auto">
                                            <button type="button" wire:click="cancel('mnamehs')" class="btn btn-warning">Cancel</button>
                                        </div>
                                        <div class="col-md-auto">
                                            <input type="submit" wire:click="saveMiddleName('d-flex')" wire:loading.class="d-none" class="btn btn-primary"  value="Save">
                                            <div wire:click="saveMiddleName" wire:loading.class="spinner-border text-primary input-group-prepend" role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </li>
                        <li class="list-group-item">
                            <i class="fa fa-phone mr-2" aria-hidden="true"></i> Contact Number: 
                            <span class="font-weight-bold">{{$userInfo->person_contactnum}}</span>
                            <a href="#" class="card-link float-right" wire:click="show('contactnumhs')">
                                <i class="fa fa-pencil-square-o" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Edit Middle Name"></i>
                            </a>
                            @if (session()->has('contactnumber'))
                            <div class="row justify-content-md-center">
                                <div class="col-md-12 alert alert-success">
                                    {{ session('contactnumber') }}
                                </div>
                            </div>
                            @endif
                            <form wire:submit.prevent="saveContactNumber('d-flex')" class="{{$contactnumhs}}">
                                <div class="container-fluid" id="estab_website">
                                    
                                    <div class="row justify-content-md-center">
                                        <div class="col">
                                            <input type="text" class="form-control @error('contact_number_input') is-invalid @enderror" wire:model.defer="contact_number_input" maxlength="11">
                                        </div>
                                        @error('contact_number_input')
                                            <span class="invalid-feedback d-block text-center" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="row justify-content-md-center mt-2">
                                        <div class="col-md-auto">
                                            <button type="button" wire:click="cancel('contactnumhs')" class="btn btn-warning">Cancel</button>
                                        </div>
                                        <div class="col-md-auto">
                                            <input type="submit" wire:click="saveContactNumber('d-flex')" wire:loading.class="d-none" class="btn btn-primary"  value="Save">
                                            <div wire:click="saveContactNumber" wire:loading.class="spinner-border text-primary input-group-prepend" role="status">
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
        {{-- User Account --}}
        <div class="col-sm-6">
            <div class="card" >
                <div class="card-body">
                    <h5 class="card-title d-inline-block">Account Credentials</h5>
                    <span class="d-inline-block float-right mr-3 text-secodary">Edit</span>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <i class="fa fa-user mr-2" aria-hidden="true"></i> Username: 
                            <span class="font-weight-bold">{{$userInfo->username}}</span>
                            <a href="#" class="card-link float-right" wire:click="show('usernamehs')">
                                <i class="fa fa-pencil-square-o" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Edit Middle Name"></i>
                            </a>
                            
                            <form wire:submit.prevent="saveUsername('d-flex')" class="{{$usernamehs}}">
                                <div class="container-fluid" id="estab_website">
                                    <div class="row justify-content-md-center">
                                        <div class="col-md-12 alert alert-info">
                                            This action will logged you out.
                                        </div>
                                    </div>
                                    <div class="row justify-content-md-center">
                                        <div class="col">
                                            <input type="text" class="form-control @error('username_input') is-invalid @enderror @if(session()->has('error_uname')) is-invalid @endif" wire:model.defer="username_input" >
                                        </div>
                                        @error('username_input')
                                            <span class="invalid-feedback d-block text-center" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        @if (session()->has('error_uname'))
                                            <span class="invalid-feedback d-block text-center" role="alert">
                                                <strong>{{ session('error_uname') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="row justify-content-md-center mt-2">
                                        <div class="col-md-auto">
                                            <button type="button" wire:click="cancel('usernamehs')" class="btn btn-warning">Cancel</button>
                                        </div>
                                        <div class="col-md-auto">
                                            <input type="submit" wire:click="saveUsername('d-flex')" wire:loading.class="d-none" class="btn btn-primary"  value="Save">
                                            <div wire:click="saveUsername" wire:loading.class="spinner-border text-primary input-group-prepend" role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </li>
                        <li class="list-group-item">
                            <i class="fa fa-key mr-2" aria-hidden="true"></i> Password
                            <a href="#" class="card-link float-right" wire:click="show('pwhs')">
                                <i class="fa fa-pencil-square-o" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Edit Middle Name"></i>
                            </a>
                            <form wire:submit.prevent="savePassword('d-flex')" class="{{$pwhs}}">
                                <div class="container-fluid" id="estab_website">
                                    <div class="row justify-content-md-center">
                                        <div class="col-md-12 alert alert-info">
                                            This action will logged you out.
                                        </div>
                                    </div>
                                    <div class="row justify-content-md-center">
                                        <div class="col">
                                            <input type="password" class="form-control @error('password_input') is-invalid @enderror" wire:model.defer="password_input" placeholder="Enter Password...">
                                        </div>
                                        @error('password_input')
                                            <span class="invalid-feedback d-block text-center" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="row justify-content-md-center">
                                        <div class="col">
                                            <input type="password" class="form-control @error('retype_password') is-invalid @enderror" wire:model.defer="retype_password" placeholder="Re-type Password...">
                                        </div>
                                        @error('retype_password')
                                            <span class="invalid-feedback d-block text-center" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="row justify-content-md-center mt-2">
                                        <div class="col-md-auto">
                                            <button type="button" wire:click="cancel('pwhs')" class="btn btn-warning">Cancel</button>
                                        </div>
                                        <div class="col-md-auto">
                                            <input type="submit" wire:click="savePassword('d-flex')" wire:loading.class="d-none" class="btn btn-primary"  value="Save">
                                            <div wire:click="savePassword" wire:loading.class="spinner-border text-primary input-group-prepend" role="status">
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

    </div>
    
</div>

@push('scripts')

<script type="text/javascript">
    $(function() {
        /* $('#showProfile a').on('click', function(e){
            e.preventDefault();
        }); */
    });

</script>
    
@endpush

