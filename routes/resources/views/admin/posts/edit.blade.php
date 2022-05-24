@extends('layouts.admin')

@section('pageTitle', 'Modifica il post')

@section('pageContent')

    <div class="container">
        <div class="row mt-3">
            <div class="col-9">
                <h1 class="text-white">Modifica il post</h1>
            </div>
            <div class="col-3">
                <a href="{{ route('admin.posts.index') }}" class="btn btn-success float-right">Torna alla lista</a>
            </div>
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif
        <form action="{{ route('admin.posts.update', $post->slug) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group text-white">

                <label for="title">Inserisci il titolo: </label>
                <input type="text" name="title" id="title" class="form-control mb-3" value="{{ old('title', $post->title) }}" >
                @error('title')
                    <div class="alert alert-danger mt-3" role="alert">
                        {{ $message }}
                    </div>
                @enderror

                <label for="slug">Inserisci lo slug: </label>
                <input type="text" name="slug" id="slug" class="form-control mb-3" value="{{ old('slug', $post->slug) }}" >
                <input type="button" class=" btn btn-primary mb-3" value="Genera slug" id="btn-slugger">

                @error('slug')
                    <div class="alert alert-danger mt-3" role="alert">
                        {{ $message }}
                    </div>
                @enderror
                <br>

                <label for="image">Inserisci il link dell'immagine: </label>
                <input type="url" name="image" id="image" class="form-control  mb-3" value="{{ old('image',$post->image) }}" >
                @error('image')
                    <div class="alert alert-danger mt-3" role="alert">
                        {{ $message }}
                    </div>
                @enderror

                <label for="category_id">Seleziona la categoria: </label>
                <select name="category_id" id="category_id" class="form-control mb-3">
                    <option value="">Seleziona la categoria</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="alert alert-danger mt-3" role="alert">
                        {{ $message }}
                    </div>
                @enderror

                <fieldset>
                    <legend>Seleziona i tag</legend>
                    @foreach ($tags as $tag)
                        <div class="form-check">
                            <input type="checkbox" name="tags[]" id="tag-{{ $tag->id }}" value="{{ $tag->id }}" class="form-check-input"
                            @if (in_array($tag->id, old('tags', $post->tags->pluck('id')->all()))) checked @endif>
                            <label for="tag-{{ $tag->id }}" class="form-check-label">{{ $tag->name }}</label>
                        </div>
                    @endforeach
                </fieldset>
                @error('tags')
                    <div class="alert alert-danger mt-3" role="alert">
                        {{ $message }}
                    </div>
                @enderror

                <label for="content">Inserisci il contenuto: </label>
                <textarea name="content" id="content" cols="30" rows="10" class="form-control">{{ old('content', $post->content) }}</textarea>
                @error('content')
                    <div class="alert alert-danger mt-3" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <input type="submit" value="Salva modifica" class="btn btn-success mt-3">
        </form>
    </div>

@endsection
