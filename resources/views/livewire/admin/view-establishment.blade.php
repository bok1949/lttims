<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal hide fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">{{$estabName}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row border-bottom">
                            <div class="col-sm-4 text-right"><span class="font-weight-bold">Address:</span> 
                            </div><div class="col-sm-8">{{$address}}</div>
                        </div>
                        <div class="row border-bottom">
                            <div class="col-sm-4 text-right"><span class="font-weight-bold">Mobile Number:</span> 
                            </div><div class="col-sm-8">{{$estabmobile}}</div>
                        </div>
                        <div class="row border-bottom">
                            <div class="col-sm-4 text-right"><span class="font-weight-bold">Phone Number:</span> 
                            </div><div class="col-sm-8">{{$estabphone}}</div>
                        </div>
                        <div class="row border-bottom">
                            <div class="col-sm-4 text-right"><span class="font-weight-bold">Email Address:</span> 
                            </div><div class="col-sm-8">{{$estabemail}}</div>
                        </div>
                        <div class="row border-bottom">
                            <div class="col-sm-4 text-right"><span class="font-weight-bold">Website:</span> 
                            </div><div class="col-sm-8">{{$estabwebsite}}</div>
                        </div>
                        <div class="row border-bottom">
                            <div class="col-sm-4 text-right"><span class="font-weight-bold">Facebook Account:</span> 
                            </div><div class="col-sm-8">{{$estabfb}}</div>
                        </div>
                        <div class="row border-bottom">
                            <div class="col-sm-4 text-right"><span class="font-weight-bold">Person-in-charge Name:</span> 
                            </div><div class="col-sm-8">{{$piFirstName.' '.Str::substr($piMiddleName, 0, 1) .'. '. $piLastName}}</div>
                        </div>
                        <div class="row border-bottom">
                            <div class="col-sm-4 text-right"><span class="font-weight-bold">Person-in-charge Contact Num:</span> 
                            </div><div class="col-sm-8">{{$piMobileNum}}</div>
                        </div>

                        <div class="row">
                            <div class="col-sm-8 offset-2 mt-1">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Account Credentials </h5>
                                    </div>
                                    <div class="card-body">
                                        
                                        <div class="row border-bottom">
                                            <div class="col-sm-6 text-right"><span class="font-weight-bold">Person-in-charge Username:</span> 
                                            </div><div class="col-sm-6">{{$piUsername}}</div>
                                        </div>
                                        <div class="row border-bottom mb-2">
                                            <div class="col-sm-6 text-right"><span class="font-weight-bold">Account Status:</span> 
                                            </div><div class="col-sm-6">
                                                 @if ($accountStatus == 1)
                                                    <span class="text-success align-middle">Active</span>
                                                @else
                                                    <span class="text-danger" >Not Active</span>  
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row mb-2 mt-2">
                                            <div class="col-sm-4 offset-2">
                                                @if ($accountStatus == 1)
                                                    <button type="button" class="btn btn-danger" wire:click="deactiveAccount({{$userId}})">Deactivate</button>    
                                                @else
                                                    <button type="button" class="btn btn-info" wire:click="activateAccount({{$userId}})">Activate </button>                                                
                                                @endif
                                            </div>
                                            <div class="col-sm-5">
                                                <button class="btn btn-primary" wire:click="resetPassword({{$userId}})">Reset-Password</button>
                                            </div>
                                            @if (session()->has('resetpass'))
                                            <div class="row mt-2">
                                                <div class="alert-success text-center">
                                                    {{session('resetpass')}}
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($viewModal)
                        <div class="row border-bottom">
                            <div class="col-sm-4 text-right"><span class="font-weight-bold">Business Permit:</span> </div>
                            <div class="col-sm-4">
                                <img src="{{ asset('storage/'.$bp_path) }}" class="img-thumbnail img-fluid my-1" alt="Business Permit">
                            </div>
                        </div>
                        <div class="row border-bottom">
                            <div class="col-sm-4 text-right"><span class="font-weight-bold">Valid Identification:</span> </div>
                            <div class="col-sm-4">
                                <img src="{{asset('storage/'.$vid_path)}}" class="img-thumbnail img-fluid my-1" alt="Business Permit">
                            </div>
                        </div>
                        <div class="row border-bottom">
                            <div class="col-sm-4 text-right"><span class="font-weight-bold">Tax Identification:</span> </div>
                            <div class="col-sm-4">
                                <img src="{{asset('storage/'.$tid_path)}}" class="img-thumbnail img-fluid my-1" alt="Business Permit">
                            </div>
                        </div>
                        @endif
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    {{-- <button type="button" wire:click.prevent="update()" class="btn btn-primary" data-dismiss="modal">Save changes</button> --}}
                </div>
        </div>
        </div>
    </div>
</div>