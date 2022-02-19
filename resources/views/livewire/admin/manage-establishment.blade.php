<div>
    
    @include('livewire.admin.view-establishment')
    
    <h2 class="text-center">Manage Establishements</h2>
    
    <input type="text"  class="form-control col-md-8 offset-2 my-2" placeholder="Search [Establishment Name]... " wire:model="searchTerm" />
   
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item {{$approved?'active':''}}" wire:click.prevent="showApproval('approved')">
                @if ($approved)
                    Approved
                @else
                    <a href="">Approved  </a>
                @endif
            </li>
            <li class="breadcrumb-item {{$needsapproval?'active':''}}" wire:click.prevent="showApproval('needsapproval')">
                @if ($needsapproval)
                    Needs Approval
                    <span class="badge badge-pill badge-danger align-top" >
                        {{$ctrData}}
                    </span>
                @else
                    <a href=""> 
                        Needs Approval 
                        <span class="badge badge-pill badge-danger align-top" >
                            {{$ctrData}}
                        </span>
                    </a>
                @endif
                
            </li>
        </ol>
    </nav>
    
    @if (session()->has('account_approved'))
        
        <div class="alert alert-success text-center col-sm-8 offset-2">
            {{session('account_approved')}}
        </div>
    @endif
    @if (session()->has('remove_account'))
        
        <div class="alert alert-success text-center col-sm-8 offset-2">
            {{session('remove_account')}}
        </div>
    @endif
    
    @if ($data->count() == 0)
    <div class="alert alert-warning">
        <p>No record available.</p>
    </div>
    @else
    @php
        $ctr = 1;
    @endphp
    
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Mobile Number</th>
                @if ($needsapproval)
                    <th scope="col">Date Registered</th>
                @else
                    <th scope="col">Phone Number</th>
                    <th scope="col">Email</th>
                    <th scope="col">FB Account</th>
                @endif
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr scope="row">
                <td>{{$ctr}}</td>
                <td>{{$item->establishment_name}}</td>
                <td>{{$item->establishment_mobilenum}}</td>
                @if ($needsapproval)
                    <td>{{Carbon\Carbon::parse($item->created_at)->diffForHumans()}}</td>
                    <td>
                        <button data-toggle="modal" data-target="#showModal" wire:click="viewEstab({{$item->ua_id}})" class="btn btn-success btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View to Approve</button>
                    </td>
                @else
                    <td>{{$item->establishment_phonenum}}</td>
                    <td>{{$item->establishment_email}}</td>
                    <td>{{$item->establishment_fb_account}}</td>
                    <td>
                        <button data-toggle="modal" data-target="#showModal" wire:click="viewEstab({{$item->id}})" class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button>
                    </td>
                @endif
                
            </tr>
                @php
                    $ctr++;
                @endphp
            @endforeach
        </tbody>
    </table>
    {{-- {{$data->withQueryString()->links()}} --}}
    <div class="col">
        {{-- {!!$data->render()!!} --}}
        {{$data->links()}}
       
    </div>
    @endif
</div>
