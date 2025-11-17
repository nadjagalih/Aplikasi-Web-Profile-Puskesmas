@extends('admin.layouts.main')

@section('content')
<div class="row">
    <div class="col-lg-10 mx-auto">
      <div class="card w-100">
        <div class="card-header bg-primary">
            <div class="row align-items-center">
                <div class="col-6">
                    <h5 class="card-title fw-semibold text-white">Edit Gambar Slider</h5>
                </div>
                <div class="col-6 text-right">
                    <a href="/admin/slider" type="button" class="btn btn-danger float-end">Kembali</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="/admin/slider/{{ $slider->id }}" enctype="multipart/form-data">
                @method('put')
                @csrf

                <div class="mb-3">
                    <img src="{{ asset('storage/' .$slider->img_slider) }}" class="img-preview img-fluid mb-3 mt-2" id="preview" style="border-radius: 5px; width: 100%; overflow:hidden;"><br>
                    <label for="img_slider" class="form-label">Gambar Slider <span style="color: red">*</span></label>
                    <input class="form-control" type="file" id="img_slider" name="img_slider" onchange="previewImage()">
                    @error('img_slider')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary m-1 float-end">Update</button>
            </form>
        </div>
      </div>
    </div>
</div>

<script>
    function previewImage(){
        var preview     = document.getElementById('preview');
        var fileInput   = document.getElementById('img_slider');
        var file        = fileInput.files[0];
        var reader      = new FileReader();

        reader.onload = function(e){
            preview.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
</script>

@endsection