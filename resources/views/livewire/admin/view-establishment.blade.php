<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal hide fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
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
                                            <div class="col-sm-6 text-right"><span class="font-weight-bold">Person-in-charge Password:</span> 
                                            </div><div class="col-sm-6">{{$piPw}}</div>
                                        </div>
                                        @if ($accountStatus == 1)
                                            <button type="button" class="btn btn-outline-success disabled">Active</button>                                                
                                            <button type="button" class="btn btn-outline-danger" wire:click="deactiveAccount({{$userId}})">Deactivate</button>    
                                        @else
                                            <button type="button" class="btn btn-outline-danger" disabled>Not Active</button>                                                
                                            <button type="button" class="btn btn-outline-info" wire:click="activateAccount({{$userId}})">Activate </button>                                                
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        <div class="row border-bottom">
                            <div class="col-sm-4 text-right"><span class="font-weight-bold">Business Permit:</span> </div>
                            <div class="col-sm-4">
                                <img src="{{asset($bp_path)}}" class="img-thumbnail img-fluid my-1" alt="Business Permit">
                            </div>
                        </div>
                        <div class="row border-bottom">
                            <div class="col-sm-4 text-right"><span class="font-weight-bold">Valid Identification:</span> </div>
                            <div class="col-sm-4">
                                <img src="{{asset($vid_path)}}" class="img-thumbnail img-fluid my-1" alt="Business Permit">
                            </div>
                        </div>
                        <div class="row border-bottom">
                            <div class="col-sm-4 text-right"><span class="font-weight-bold">Tax Identification:</span> </div>
                            <div class="col-sm-4">
                                <img src="{{asset($tid_path)}}" class="img-thumbnail img-fluid my-1" alt="Business Permit">
                            </div>
                        </div>
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