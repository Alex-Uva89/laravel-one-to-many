@extends('layouts.admin')

@section('pageTitle', 'Crea un nuovo post')

@section('pageContent')

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mt-3">
                <h1 class="text-white">Crea un nuovo post</h1>
                <a href="{{ route('admin.posts.index') }}" class="btn btn-success float-right">Torna alla lista</a>
        </div>
        <form action="{{ route('admin.posts.store') }}" method="POST">
            @csrf
            <div class="form-group text-white">

                <label for="title">Inserisci il titolo: </label>
                <input type="text" name="title" id="title" class="form-control mb-3" value="{{ old('title') }}" >
                @error('title')
                    <div class="alert alert-danger mt-3" role="alert">
                        {{ $message }}
                    </div>
                @enderror

                <label for="slug">Inserisci lo slug: </label>
                <input type="text" name="slug" id="slug" class="form-control mb-3" value="{{ old('slug') }}" >
                <input type="button" class=" btn btn-primary mb-3" value="Genera slug" id="btn-slugger">
                @error('slug')
                    <div class="alert alert-danger mt-3" role="alert">
                        {{ $message }}
                    </div>
                @enderror
                <br>

                <label for="image">Inserisci il link dell'immagine: </label>
                <input type="url" name="image" id="image" class="form-control mb-3" value="{{ old('image') }}" >
                @error('image')
                    <div class="alert alert-danger mt-3" role="alert">
                        {{ $message }}
                    </div>
                @enderror

                <label for="category_id">Seleziona la categoria: </label>
                <select name="category_id" id="category_id" class="form-control mb-3">
                    <option value="">Seleziona la categoria</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
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
                        <div class="form-check form-check-inline">
                            <input type="checkbox" name="tags[]" id="tag-{{ $tag->id }}" value="{{ $tag->id }}" class="form-check-input"
                            @if (in_array($tag->id, old('tags', []))) checked @endif>

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
                <textarea name="content" id="content" cols="30" rows="10" class="form-control">{{ old('content') }}</textarea>
                @error('content')
                    <div class="alert alert-danger mt-3" role="alert">
                        {{ $message }}
                    </div>
                @enderror

            </div>
            <button type="submit" class="btn btn-success mt-3">Crea</button>
        </form>
    </div>

@endsection
