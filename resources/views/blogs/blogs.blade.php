@extends('layouts.app')

@section('content')

    {{-- <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">
                        <div class="px-5 pt-2 row justify-content-between">

                            <div class="col-md">
                                <h5>Data Blogs</h5>
                            </div>
                            @if (request('category'))
                                <a href="{{ route('blogs') }}"
                                    class="text-decoration-none badge bg-secondary color-white">Semua</a>&nbsp;&nbsp;
                                <a href="#" class="text-decoration-none badge bg-primary">{{ $name }}</a>
                            @else
                                <a href="{{ route('blogs') }}" class="text-decoration-none badge bg-primary">Semua</a>
                            @endif
                            <div class="col-md-4">
                                <form action="{{ route('blogs') }}">
                                    <div class="mt-4 input-group">
                                        @if (request('category'))
                                            <input type="hidden" name="category" value="{{ request('category') }}">
                                        @endif
                                        <input type="text" class="form-control" name="search"
                                            value="{{ request('search') }}" placeholder="Type search...">
                                        <button class="btn btn-primary" type="submit" id="button-addon2">
                                            <i data-feather="search"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>

                        </div>
                        @if (session('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif
                        @if (session('messageError'))
                            <div class="alert alert-danger">
                                {{ session('message') }}
                            </div>
                        @endif
                    </div>

                    <div class="card-body">

                        <table class="table table-hover table-responsive-md">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Created</th>
                                    <th>Category</th>
                                    <th>Time</th>
                                    <th>
                                        <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#add">
                                            Add
                                        </button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 1; ?>
                                @foreach ($blogs as $blog)
                                    <tr>
                                        <td>{{ $blogs->perPage() * ($blogs->currentPage() - 1) + $count }}</td>
                                        <td>{{ $blog->title }}</td>
                                        <td>{{ $blog->user->name }}</td>
                                        <td>{{ $blog->category->name }}</td>
                                        <td>{{ $blog->updated_at->diffForHumans() }}</td>
                                        <td>
                                            <a href="{{ route('update-blog', $blog->slug) }}"
                                                class="btn btn-sm btn-primary">Edit</a>
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#delete{{ $blog->id }}">Delete</button>
                                        </td>

                                        <div class="modal fade" id="delete{{ $blog->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Delete data blog
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('delete-blog', $blog->slug) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="modal-body">
                                                            <p>Apakah anda yakin ingin menghapus data dengan title
                                                                {{ $blog->title }}</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary"
                                                                data-bs-dismiss="modal">No</button>
                                                            <button type="submit" class="btn btn-danger">Yes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    </tr>
                                    <?php $count++; ?>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-end">
                            {{ $blogs->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add data blog</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('insert-blog') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                id="title" placeholder="Masukan title" value="{{ old('title') }}">
                            @error('title')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="file" class="form-control @error('image') is-invalid @enderror"
                                        name="image" id="image" onchange="previewImage()">
                                    @error('image')
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
                        <div class="mb-3">
                            <label for="category" class="form-label">Cateory</label>

                            <select name="category_id" id="category" class="form-control">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="body" class="form-label">Body</label>
                            <textarea class="form-control @error('body') is-invalid @enderror" name="body" id="body"
                                rows="3">{{ old('body') }}</textarea>
                            @error('body')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}

    
<div id="blogs" endpoint={{ route('data-blogs') }} data={{ $blogs->toJson() }}></div>



@endsection

@section('script')
    {{-- <script>
        function previewImage() {
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';
            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script> --}}
@endsection
