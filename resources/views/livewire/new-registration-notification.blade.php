{{-- <div  > --}}
<div wire:poll.2s >
        <a href="{{route('ao.manage-establishment')}}" wire:click="readNotifications()" class="nav-link pl-2">
            <i class="fa fa-university" aria-hidden="true"></i> Establishments 
            @if ($ctr > 0)
            <span class="badge badge-pill badge-danger float-right"  >
                {{$ctr}} New
            </span>   
            @endif             
        </a>
</div>

