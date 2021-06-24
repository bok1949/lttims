<div>
    @if (session()->has('success'))
    <div class="row ustify-content-md-center ">
        <div class="col">
            <span class="alert alert-success d-block text-center" role="alert">
                {{ session('success') }} 
            </span>
        </div>
    </div>  
    @endif
    <div class="row content">
        <div class="col-sm-8 offset-2">
        <form action="{{route('visitor-logform.submit')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="full-name">Full Name <span class="text-danger">*</span></label>
                <input type="text" name="full_name" class="form-control @error('full_name') is-invalid @enderror" id="full-name" value="{{old('full_name')}}" placeholder="Enter Full Name...">
                @error('full_name')<span class="text-danger">{{$message}}</span> @enderror
            </div>
            <div class="form-group">
                <label for="contact-num">Contact No. <span class="text-danger">*</span></label>
                <input type="text" name="contact_number" class="form-control @error('contact_number') is-invalid @enderror" value="{{old('contact_number')}}" maxlength="11" placeholder="Enter Contact Number...">
                <small id="emailHelp" class="form-text text-muted">Ex. (09091234567)</small>
                @error('contact_number')<span class="text-danger">{{$message}}</span> @enderror
            </div>

            <div class="form-group p-3 shadow-sm bg-white rounded">
                <label for="address">Address <span class="text-danger">*</span></label>
            
                <input type="text" name="municipality_or_city" class="form-control @error('municipality_or_city') is-invalid @enderror" id="address" value="{{old('municipality_or_city')}}" placeholder="Municipality or City...">
                @error('municipality_or_city')<span class="text-danger">{{$message}}</span> @enderror
            
                <input type="text" name="province" class="form-control @error('province') is-invalid @enderror" id="address" value="{{old('province')}}" placeholder="Province...">
                @error('province')<span class="text-danger">{{$message}}</span> @enderror
            </div>

            <div class="form-group">
                <label for="temperature">Gender <span class="text-danger">*</span></label>
                <select name="gender" class="form-control @error('temperature') is-invalid @enderror">
                    <option value="">--Select Gender--</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="lgbtq">LGBTQ</option>
                </select>
                @error('gender')<span class="text-danger">{{$message}}</span> @enderror
            </div>
            <div class="form-group">
                <label for="temperature">Temperatrure <span class="text-danger">*</span></label>
                <input type="text" name="temperature" class="form-control @error('temperature') is-invalid @enderror" value="{{old('temperature')}}" id="temperature" placeholder="Enter Temperature...">
                @error('temperature')<span class="text-danger">{{$message}}</span> @enderror
            </div>
            <div class="form-group p-3 shadow-sm bg-white rounded">
                <label for="pipNum">Number of People with you <span class="text-danger">*</span></label>
                <input type="number" name="people_with_you_male @error('pipwithyou') is-invalid @enderror" class="form-control" min="0" value="{{old('people_with_you_male')}}" placeholder="Number of male people with you...">
                <input type="number" name="people_with_you_female @error('pipwithyou') is-invalid @enderror" class="form-control " min="0" value="{{old('people_with_you_female')}}" placeholder="Number of female people with you...">
                <input type="number" name="people_with_you_lgbtq @error('pipwithyou') is-invalid @enderror" class="form-control " min="0" value="{{old('people_with_you_lgbtq')}}" placeholder="Number of lgbtq people with you...">
                {{-- @error('people_with_you_male')<span class="text-danger">{{$message}}</span> @enderror
                @error('people_with_you_female')<span class="text-danger">{{$message}}</span> @enderror
                @error('people_with_you_lgbtq')<span class="text-danger">{{$message}}</span> @enderror --}}
                @error('pipwithyou')<span class="text-danger">{{$message->pipwithyou}}</span> @enderror
                @php
                    print_r($errors->get('pipwithyou'))
                @endphp
            </div>
            {{-- <input type="hidden" name="estab_id" value="{{$data->id}}"> --}}
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        </div>
    </div>
</div>
