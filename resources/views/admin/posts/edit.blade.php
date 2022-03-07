@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            @if (session('status'))
                <div class="alert alert-danger">
                    {{ session('status') }}
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col">
                <h1>
                    Edit {{ $post->title }}
                </h1>
            </div>
        </div>
        <div class="row">
            {{-- con questo comando mandiamo il file all update nel controller --}}
            <form action="{{ route('admin.posts.update', $post) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title"value=" {{ old('title', $post->title) }}">
                    @error('title')
                    <div class="alert alert-danger mt-3">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea class="form-control" id="content" rows="3"name="content"> {{ old('content', $post->content) }}</textarea>
                    @error('content')
                    <div class="alert alert-danger mt-3">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <fieldset class="mb-3">
                    <legend>Tags</legend>
                    {{-- se abbiamo gia compilato il form e siamo tornati indietro per validazione errata allora facciamo un foreach e controlliamo old('tags') --}}
                    @if ($errors->any())
                        @foreach ($tags as $tag)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{ $tag->id }}" name="tags[]"
                                    {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{ $tag->name }}
                                </label>
                            </div>
                        @endforeach
                    @else
                        {{-- Altrimenti prendiamo i dati dal db e checchiamo i nostri checkbox corrispondenti --}}
                        @foreach ($tags as $tag)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{ $tag->id }}" name="tags[]"
                                    {{ $post->tags()->get()->contains($tag->id)? 'checked': '' }}>
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{ $tag->name }}
                                </label>
                            </div>
                        @endforeach
                    @endif
                </fieldset>
                <input class="btn btn-primary" type="submit" value="Save">
            </form>
        </div>
    </div>
@endsection