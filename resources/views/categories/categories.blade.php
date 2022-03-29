@extends('layouts.app')

@section('style')
    <style>
        .btn-circle {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: 2px solid silver;
            align-items: center;
            justify-content: center;
            display: flex;
            text-decoration: none;
        }

    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-md-4">
                <h5>Data Categories</h5>
            </div>

            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-2">
                        <button data-bs-toggle="modal" data-bs-target="#add" class="btn btn-sm btn-success">Add <i
                                class="fa fa-plus text-white"></i></button>
                    </div>
                    <div class="col-md">
                        <form action="" method="get">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Type search...." name="search">
                                <button class="input-group-text btn-primary">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

        <div class="row mt-3 justify-content-center">
            <div class="col-md-6">
                @if (session('message'))
                    <div class="alert alert-success" role="alert">
                        {{ session('message') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="row  mt-5">
            <div class="d-flex justify-content-center">
                @foreach ($categories as $category)
                    <div class="mx-2 items-center">
                        <a href="{{ route('category', $category->slug) }}" class="btn-circle"
                            style="background-color: {{ $category->color }}">
                            <img src="{{ asset('storage/' . $category->icon) }}" alt="" class="w-50">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        
    </div>

    <!-- Modal -->
    <div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add data category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('insert-category') }}" method="post" enctype="multipart/form-data">
                    <div class="modal-body">

                        @csrf
                        <div class="form-group">
                            <label for="name">Nama kategori</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" placeholder="Masukan nama kategori" value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="icon">Icon</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="file" class="form-control @error('icon') is-invalid @enderror" name="icon"
                                        id="icon" onchange="previewImage()">
                                    @error('icon')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <img class="img-fluid img-thumbnail img-preview" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="color">Color</label>
                            <div class="d-flex">
                                <div class="form-check">
                                    <input class="form-check-input bg-danger" type="radio" name="color" value="#d50000">
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input bg-primary" type="radio" name="color" value="#2962ff">
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input bg-info" type="radio" name="color" value="#3d85c6">
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input bg-warning" type="radio" name="color" value="#f29a02">
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input bg-success" type="radio" name="color" value="#7BF600">
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input bg-dark" type="radio" name="color" value="#000000">
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary" type="radio" name="color" value="#999999">
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input bg-light" type="radio" name="color" value="#ffffff">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary btn-sm" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Keluar</span>
                        </button>

                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Simpan</span>
                        </button>
                    </div>
                </form>
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
