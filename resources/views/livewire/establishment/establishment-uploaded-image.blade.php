<div>
    <div class="card">
        <div class="card-body">
            @if ($estabPhotos->count() > 0)
            <h3 class="card-title">You must select an Image to view in the Home page</h3>
            <section id="portfolio" class="portfolio">
                <div class="container">
                    <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="400">
                    @foreach ($estabPhotos as $item)
                        <div class="col-lg-4 col-md-6 portfolio-item filter-dist ">
                            <div class="portfolio-wrap @if($item->is_main == 1) border border-success border-3 @endif">
                                <img src="{{asset('storage/'.$item->image_path)}}" class="img-fluid" alt="">
                                <div class="portfolio-info">
                                    <h4>{{$item->img_caption}}</h4>
                                    <p>Pick me as main Photo to view in the Home page.</p>
                                    <div class="">
                                        @if($item->is_main == 1) 
                                            <p class="text-success"> Selected as Main Photo </p>
                                            <a href="" class="btn btn-outline-warning" wire:click="deselectMainPhoto({{$item->id}})" >De-select</a>
                                        @else
                                            <a href="" class="btn btn-outline-primary" wire:click="selectedMainPhoto({{$item->id}}, {{$item->eui_id}})" >Select</a>
                                         @endif
                                            <a href="" class="btn btn-outline-danger" wire:click="removePhoto({{$item->id}})" >Remove</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>
            </section>
            @else
            <div class="alert alert-warning">
                <h3>No Image Available. Upload Photos.</h3>
            </div>
            @endif
        </div>
    </div>
    
</div>
