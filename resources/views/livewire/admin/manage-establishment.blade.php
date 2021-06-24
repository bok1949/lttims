<div>
    @include('livewire.admin.view-establishment')
    <h2 class="text-center">Manage Establishement</h2>
    <input type="text"  class="form-control col-md-8 offset-2 my-2" placeholder="Search [Establishment Name or Email]... " wire:model="searchTerm" />
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
                <th scope="col">Phone Number</th>
                <th scope="col">Email</th>
                {{-- <th scope="col">Website</th> --}}
                <th scope="col">FB Account</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr scope="row">
                <td>{{$ctr}}</td>
                <td>{{$item->establishment_name}}</td>
                <td>{{$item->establishment_mobilenum}}</td>
                <td>{{$item->establishment_phonenum}}</td>
                <td>{{$item->establishment_email}}</td>
                {{-- <td>{{$item->establishment_website}}</td> --}}
                <td>{{$item->establishment_fb_account}}</td>
                <td>
                    <button data-toggle="modal" data-target="#viewModal" wire:click="viewEstab({{$item->id}})" class="btn btn-primary btn-sm">View</button>
                </td>
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
