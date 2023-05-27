@extends('template.main')
@section('content')
    <div class="card shadow">

        <div class="card-header bg-primary">
            <div class="d-flex justify-content-between">
                <h2 class="text-light p-2">Add New News</h2>
            </div>
        </div>

        <div class="card-body">
            <div class="mx-3 rounded bg-light my-3 px-3">
                <div class="p-3">
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <label for="title" class="form-label">Title</label>
                                <input type="text" name="title" value="{{ old('title') }}" id="title"
                                    class="form-control form-control-lg mb-4 @error('title') is-invalid @enderror"
                                    placeholder="Title" autofocus>
                                @error('title')
                                    <div class="invalid-feedback mb-3">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="formFile" class="form-label">Image</label>
                                        <input name="image" class="form-control" type="file" id="formFile"
                                            accept="image/*">
                                        @error('title')
                                            <div class="invalid-feedback mb-3">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="category_id" class="form-label">Category</label>
                                        <select id="category_id" class="form-select" name="category_id">
                                            @foreach ($categories as $category)
                                                @if (old('category_id') == $category->id)
                                                    <option value="{{ $category->id }}" selected>{{ $category->name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                </div>


                                <label for="editor" class="form-label mb-1">Body</label>
                                <textarea type="text" name="body" id="editor" class="form-control @error('body') is-invalid @enderror"
                                    placeholder="Write new post" style="height: 600px">{{ old('body') }}</textarea>
                                @error('body')
                                    <div class="invalid-feedback mb-3">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <label for="hastag" class="form-label mb-1 mt-4">#Hastag</label>
                                <textarea type="text" name="hastag" id="hastag" class="form-control @error('hastag') is-invalid @enderror"
                                    placeholder="#news #popular #organization" aria-describedby="hastagSugesstion">{{ old('hastag') }}</textarea>
                                <div id="hastagSugesstion" class="form-text">Optimize search results with hashtags
                                </div>
                                @error('hastag')
                                    <div class="invalid-feedback mb-3">
                                        {{ $message }}
                                    </div>
                                @enderror

                                {{-- button --}}
                                <div class="mt-5 d-flex justify-content-between">
                                    <div class="">
                                        <button class="btn btn-outline-primary profile-button" type="button">
                                            Reset
                                        </button>
                                    </div>
                                    <div class="">
                                        <button class="btn btn-outline-primary profile-button me-3" type="button">
                                            <b>Cancel</b>
                                        </button>
                                        <button class="btn btn-primary profile-button" type="submit">
                                            Upload News
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
