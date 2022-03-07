@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @if (session('status'))
            <div class="alert alert-danger">
                {{ session('stauts') }}
            </div>
        @endif
    </div>
    <div class="row">
        <div class="col">
            <h1>
                Create new post with profile: {{ Auth::user()->name }}
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <form action="{{ route('admin.posts.store') }}" method="post">
            @csrf 
            @method('POST')
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
                @error('title')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" id="content" rows="3" name="content"> {{ old('content') }} </textarea>
            </div>
            <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
            @error('content')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror

               {{-- giro sull'array che mi sono passato tramite il post controller  --}}
            <fieldset>
                <legend>Tags</legend>
                @foreach ($tags as $tag) 
                <div class="form-check">
                    {{-- scrivo nel name tags[] perché passo piu elementi alla store che cosi me li raggruppa  --}}
                    <input class="form-check-input" type="checkbox" value="{{ $tag->id }}" name="tags[]"
                    {{-- ternario per lasciare la checkbox ceccata durante l'errore --}}
                    {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}
                    >
                    <label class="form-check-label" for="flexCheckDefault">
                        {{ $tag->name }}
                    </label>
                </div>
                @endforeach
            </fieldset>
            @error('tags.*')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
            
            <input type="submit" value="Salva">
            </form>
        </div>
    </div>
</div>
@endsection