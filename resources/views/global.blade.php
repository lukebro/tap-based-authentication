<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Tap Based Authentication</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body>
        <div class="section">
            <div class="container">
                <table class="table is-bordered">
                    <tr><th>Users</th><th>Keys</th><th>Attempts</th></tr>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->masterKeys()->count() }}</td>
                        <td>{{ $user->attempts()->count() }}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </body>
</html>
