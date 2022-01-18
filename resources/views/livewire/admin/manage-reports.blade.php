<div>
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item {{$loe?'active':''}}" wire:click="showPages('loe')">
                        @if ($loe)
                            List of Establishments
                        @else
                            <a href="#">List of Establishments</a>
                        @endif
                    </li>
                    <li class="breadcrumb-item {{$mva?'active':''}}" wire:click="showPages('mva')">
                        @if ($mva)
                            Most Visited Area
                        @else
                            <a href="#">Most Visited Area</a>
                        @endif
                        
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="col loe-page">
        @if ($loe)
            @livewire('admin.establishment-list-reports')
        @elseif($mva)
            @livewire('admin.most-visited-area')
        @endif
        
    </div>
</div>
