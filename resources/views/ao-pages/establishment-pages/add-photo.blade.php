<div class="card mt-2">
    <div class="card-header">
        <h5 class="card-title">Upload Photos</h5>
    </div>
    <div class="card-body">
        @if (session()->has('image_created'))
            <div class="row ustify-content-md-center ">
                <div class="col-md-12">
                    <span class="alert alert-success d-block text-center" role="alert">
                        {{ session('image_created') }} 
                    </span>
                </div>
            </div>  
        @endif
        <form id="fileUploadForm" action="{{ route('estab.addPhotos') }}" method="post" enctype="multipart/form-data" >
        @csrf
        <div class="container-fluid">
            <div class="row form-group">
                <label class="col-sm-2 col-form-label text-right">Caption </label>
                <div class="col-sm-8">
                    <input type="text" name="caption" class="form-control" placeholder="Enter Caption..." >
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-8 offset-2">
                    <div class="form-group ">
                        <div class="custom-file ">
                            <label class="custom-file-label " for="customFile">Choose Photo</label>
                            <input type="file"  name="photo" class="custom-file-input file " id="file" >
                        </div>
                        @error('photo')
                            <span class="invalid-feedback d-block text-center" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            

            <div class="row">
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn text-white btn-success" id="submit_all" >Save</button>
                   
                </div>
                
            </div>
        </div>
        </form>
    </div>
</div>

@push('scripts')
<script type="text/javascript">
    const file = document.querySelector('#file');
    file.addEventListener('change', (e) => {
        // Get the selected file
        let [file] = e.target.files;
        // Get the file name and size
        let { name: fileName, size } = file;
        // Convert size in bytes to kilo bytes
        /* let fileSize = (size / 1000).toFixed(2); */
        const fileSize =  (size/1024).toFixed(2);
        console.log(fileSize);
        // Set the text content
        let fileNameAndSize = `${fileName} - ${fileSize}MB`;
        document.querySelector('.custom-file-label').textContent = fileNameAndSize;
    });
     
     
    

</script>
@endpush