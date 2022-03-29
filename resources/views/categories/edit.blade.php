@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Update data category</div>
                    <div class="card-body">
                        <form action="{{ route('categoryEdit', $category->slug) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Nama kategori</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                            name="name" placeholder="Masukan nama kategori"
                                            value="{{ $category->name ?? old('name') }}">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="icon">Icon</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="file" class="form-control @error('icon') is-invalid @enderror"
                                                    name="icon" id="icon" onchange="previewImage()" value="{{ $category->icon ?? old('icon') }}">
                                                @error('icon')
                                                    <small class="text-danger">
                                                        {{ $message }}
                                                    </small>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                @if ($category->icon)
                                                    <img src="{{ url('storage/' . $category->icon) }}" alt="cover"
                                                        class="img-preview img-fluid img-thumbnail w-50">
                                                @else
                                                    <img alt="cover" class="img-preview img-fluid img-thumbnail w-50">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="color">Color</label>
                                <div class="d-flex">
                                    <div class="form-check">
                                        <input class="form-check-input bg-danger" type="radio" name="color" value="#d50000"
                                            {{ $category->color == '#d50000' ? 'checked' : '' }}>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input bg-primary" type="radio" name="color" value="#2962ff"
                                            {{ $category->color == '#2962ff' ? 'checked' : '' }}>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input bg-info" type="radio" name="color" value="#3d85c6"
                                            {{ $category->color == '#3d85c6' ? 'checked' : '' }}>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input bg-warning" type="radio" name="color" value="#f29a02"
                                            {{ $category->color == '#f29a02' ? 'checked' : '' }}>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input bg-success" type="radio" name="color" value="#7BF600"
                                            {{ $category->color == '#7BF600' ? 'checked' : '' }}>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input bg-dark" type="radio" name="color" value="#000000"
                                            {{ $category->color == '#000000' ? 'checked' : '' }}>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input bg-secondary" type="radio" name="color"
                                            value="#999999" {{ $category->color == '#999999' ? 'checked' : '' }}>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input bg-light" type="radio" name="color" value="#ffffff"
                                            {{ $category->color == '#ffffff' ? 'checked' : '' }}>
                                    </div>
                                </div>
                            </div>

                            <div class="text-end mt-5">
                                <button type="submit" class="btn btn-primary btn-sm"> <i data-feather="edit"></i>
                                    Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function previewImage() {
            const image = document.querySelector('#icon');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';
            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
