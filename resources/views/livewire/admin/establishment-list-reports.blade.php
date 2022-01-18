<div>
    @if ($data->count() < 1)
    <div class="alert alert-warning">
        <p>No record available.</p>
    </div>
    @else
    <h2 class="text-center">List of Establishements </h2>
    <div class="row mb-2">
        <div class="col">
            <button type="button" wire:click="generateEstablishmentPDF()" class="btn btn-info">Download</button>
        </div>
    </div>
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
                <th scope="col">FB Account</th>
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
                <td>{{$item->establishment_fb_account}}</td>
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
</div>
