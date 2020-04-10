<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="author" content="Sanaval Tecnología">
        <meta name="description" content="Centro de fisioterapia en Madrid, Barrio del Pilar, especializados en deportiva y traumatología, vendajes">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Centro de fisioterapia {{ config('app.name') }} </title>

        <!-- Fonts -->

        <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Material+Icons" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">

        <!-- Styles -->
        {{-- <link href="https://unpkg.com/vuetify/dist/vuetify.min.css" rel="stylesheet"> --}}

        <script>
            window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
                'siteName'  => config('app.name'),
                'apiDomain' => '/api'
                //'apiDomain' => config('app.url').'/api'
            ]) !!}
        </script>
    </head>
    <body>
        <div id="app">
            <v-app id="inspire" >
                    <router-view></router-view>
            </v-app>
        </div>

        <script src="{{ mix('/js/app.js') }}"></script>

    </body>
</html>