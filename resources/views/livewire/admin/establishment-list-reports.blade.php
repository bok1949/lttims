<div>
    @if ($data->count() < 1)
        <div class="alert alert-warning text-center">
            No record available
        </div>
    @else
        @if ($establishmentList)
            <button type="button" wire:click="generateEstablishmentPDF()" class="btn btn-secondary float-right mb-2"><i class="fa fa-download" aria-hidden="true"></i> Download List of Establishment</button>
        @endif
        
        {{-- <i class="fa fa-book" aria-hidden="true"></i> --}}
        <ul class="nav nav-pills">
            <li class="nav-item" wire:click.prevent="navListVisitor('establist')">
                <a class="nav-link {{$establishmentList?'active':''}}" href="">List</a>
            </li>
            <li class="nav-item" wire:click.prevent="navListVisitor('visitorNumber')">
                <a class="nav-link {{$establishmentVisitors?'active':''}}" href="">With Number of Visitors</a>
            </li>
        </ul>
        @php
            $ctr = 1;
        @endphp
        @if ($establishmentVisitors)
            <h5 class="font-weight-bold border-top border-secondary pt-2 m-2">Sort By:</h5>
            @error('novalue')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{$message}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @enderror
            <div class="mb-2 row">
                                
                <div class="col-sm-3">
                    <div class="input-group">
                        <select name="" class="custom-select" wire:model="sortYear">
                            <option value="0" >--Select Year--</option>
                            @for ($i = 2022; $i < 2050; $i++)
                                <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" wire:click.prevent="sortEstablishmentVisitor({{json_encode($sortYear)}})" type="button">Go</button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 ">
                    <div class="input-group">
                        <label for="" class="mt-2">Month:</label>
                        <input type="month" wire:model="sortMonth" class="form-control">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" wire:click.prevent="sortEstablishmentVisitor({{json_encode($sortMonth)}})" type="button">Go</button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <button type="button" wire:click="printEstablishmentVisitor()" class="btn btn-secondary float-right mb-2"><i class="fa fa-download" aria-hidden="true"></i> Download All</button> 
                </div>
               
                {{-- {{$sortYear}}{{$sortMonth}} --}}
            </div>
            
        @endif
        <h3 class="text-center">List of Establishements {{ $monthTextual }}</h3>
        @error('nodata')
            
        @enderror
        @if ($errors->has('nodata'))
            <div class="alert alert-danger ">
                {{$errors->first('nodata')}}
                
            </div>
        @else
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    @if ($establishmentVisitors)
                        <th scope="col">Type of Establishment</th>
                    @endif
                    <th scope="col">Name</th>
                    
                    @if ($establishmentVisitors)
                        <th scope="col">Total Male</th>
                        <th scope="col">Total Female</th>
                        <th scope="col">Total LGBTQ</th>
                        <th scope="col">Sum Visitors</th>
                    @endif
                    @if ($establishmentList)
                        <th scope="col">Mobile Number</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Email</th>
                        <th scope="col">FB Account</th>
                        <th scope="col">Action</th>
                    @endif
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr scope="row">
                    <td>{{$ctr}}</td>
                    @if ($establishmentVisitors)
                        <td>{{$item->type_of_establishment}}</td>
                    @endif

                    <td>{{$item->establishment_name}}</td>
                    
                    @if ($establishmentVisitors)
                        <td class="text-center">{{$item->pwym}}</td>
                        <td class="text-center">{{$item->pwyf}}</td>
                        <td class="text-center">{{$item->pwylgbtq}}</td>
                        <td class="text-center">{{$item->pwym + $item->pwyf + $item->pwylgbtq}}</td>
                    @endif
                    @if ($establishmentList)
                        <td>{{$item->establishment_mobilenum}}</td>
                        <td>{{$item->establishment_phonenum}}</td>
                        <td>{{$item->establishment_email}}</td>
                        <td>{{$item->establishment_fb_account}}</td>
                        <td>
                            {{-- <button data-toggle="modal" data-target="#showModal" wire:click="viewEstab({{$item->id}})" class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button> --}}
                            <button wire:click="viewEstabReport({{$item->id}})" class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button>
                        </td>
                    @endif
                    
                </tr>
                    @php
                        $ctr++;
                    @endphp
                @endforeach
            </tbody>
        </table>
        <div class="col">
            {{$data->links()}}
        </div>
        @endif
    @endif
</div>
