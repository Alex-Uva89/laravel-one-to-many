@extends('layouts.admin')

@section('pageTitle', 'Index')

@section('pageContent')
    <div class="container">
        @if (session('deleted'))
            <div class="alert alert-warning">{{ session('deleted') }}</div>
        @endif
        <div class="mt-3 d-flex justify-content-between align-items-center">
            <h1 class="text-white">Posts</h1>
            <a href="{{ route('admin.posts.create') }}" class="btn btn-success float-right">Crea un nuovo post</a>
        </div>
        <div class="row">
            <div class="col">

                <form action="" method="GET">
                    <div class="form-group">
                        <label class="text-white" for="title">Filtri:</label>
                        <input type="text" name="searchTitle" placeholder="Cerca per titolo" class="form-control" id="title"  value="{{ request()->searchTitle }}">

                        <select name="category" id="category" class="form-control">
                            <option value="" selected>Seleziona una categoria</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ request()->category == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>

                        @if (route('admin.posts.index'))
                            <select name="author" id="author" class="form-control">
                                <option value="" selected>Seleziona un autore</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ request()->author == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                        @endif


                    </div>

                    <button class="btn btn-primary my-3">Applica filtri</button>
                </form>


                <table class="table table-dark table-hover border border-white">
                    <thead>
                        <tr>
                        <th class="text-center" scope="col">#</th>
                        <th class="text-center" scope="col">Title</th>
                        <th class="text-center" scope="col">Slug</th>
                        <th class="text-center" scope="col">Category</th>
                        <th class="text-center" scope="col">Created At</th>
                        <th class="text-center" scope="col">Updated At</th>
                        <th class="text-center" scope="col" colspan="3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $item)
                            <tr  data-id="{{ $item->slug }}">
                                <th class="text-center" scope="row">{{ $item->id }}</th>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->slug }}</td>
                                <td>{{ $item->category->name }}</td>
                                <td>{{ date('d/m/Y', strtotime($item->created_at)) }}</td>
                                <td>{{ date('d/m/Y', strtotime($item->updated_at)) }}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{ route('admin.posts.show', $item->slug) }}">Apri</a>
                                </td>
                                <td>
                                    @if (Auth::user()->id === $item->user_id)
                                        <a class="btn btn-primary" href="{{ route('admin.posts.edit', $item->slug) }}">Modifica</a>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if (Auth::user()->id === $item->user_id)
                                        <button class="btn btn-danger btn-delete">Cancella</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{ $posts->links() }}

        <section id="confirmation-overlay" class="overlay d-none">
            <div class="popup">
                <h1>Sei sicuro di voler eliminare?</h1>
                <div class="d-flex justify-content-center">
                    <button id="btn-no" class="btn btn-primary me-3">NO</button>
                    <form method="POST" data-base="{{ route('admin.posts.destroy', '*****') }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">SI</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
