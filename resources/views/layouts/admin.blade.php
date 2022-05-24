<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <title>{{ config('app.name', 'Laravel') }} | @yield('pageTitle')</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body class="bg-secondary">
        @include('partials.headeradmin')

        <main class="py-4">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-2 pt-5 ps-5">
                        <div class="py-2"><a href="{{ route('admin.posts.index') }}" class="btn btn-info float-right">Tutti i post</a></div>
                        <div class="py-2"><a href="{{ route('admin.posts.create') }}" class="btn btn-info float-right">Crea nuovo post</a></div>
                        <div class="py-2"><a href="{{ route('admin.categories.index') }}" class="btn btn-info float-right">Tutte le categorie</a></div>
                        <div class="py-2"><a href="{{ route('admin.categories.create') }}" class="btn btn-info float-right">Crea nuova categoria</a></div>
                    </div>
                    <div class="col-12 col-md-10">
                        @yield('pageContent')
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>
