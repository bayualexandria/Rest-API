@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('update-blog',$blog->slug) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                    id="title" placeholder="Masukan title" value="{{ $blog->title??old('title') }}">
                            </div>
                            <div class="row mb-3">
                                <label for="cover">Cover</label>
                                <div class="col-md-6">
                                    <div class="input-group mt-2">
                                        <input type="file" class="form-control @error('cover') is-invalid @enderror"
                                            name="image" onchange="previewImage()" id="image">
                                    </div>
                                    @error('cover')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    @if ($blog->image)
                                    <img src="{{ url('storage/'.$blog->image) }}" alt="cover"
                                        class="img-preview img-fluid img-thumbnail w-50">
                                    @else
                                    <img alt="cover" class="img-preview img-fluid img-thumbnail w-50">
                                    @endif
                                </div>
    
                            </div>
                            <div class="mb-3">
                                <label for="category" class="form-label">Cateory</label>
    
                                <select name="category_id" id="category" class="form-control">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ ($category->id==$blog->category_id)?'selected':'' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="body" class="form-label">Body</label>
                                <textarea class="form-control @error('body') is-invalid @enderror" name="body" id="body"
                                    rows="3">{{ $blog->body??old('body') }}</textarea>
                            </div>
                            <a href="{{ route('blogs') }}" class="btn btn-sm btn-info">Back</a>
                            <button type="submit" class="btn btn-sm btn-primary">Update</button>
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
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';
        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function (oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }
    </script>
@endsection
