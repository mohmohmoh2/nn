<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">

        <title>Reset Password | </title>
        <!-- Bootstrap core CSS -->
        <link href="{{ asset('assist/assists/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="{{ asset('assist/assists/css/signin.css') }}" rel="stylesheet">
    </head>
    <body class="text-center">
        <main class="form-signin">
            @if (isset($_COOKIE['em']))
            <div class="alert alert-success" role="alert"> An Email is Send to You [ {{ $id }} ] Check Your Mail !</div>
            @endif
            <form action="{{ route('admin.ecode') }}" method="get" class="form">
                <img class="mb-4" src="{{ asset('assist/assists/img/logo.jpg') }}" alt="" width="72" height="72">
                <div class="form-floating">
                <input type="hidden" name="email" value="{{ $id }}">
                <input type="text" name="code" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                <label for="floatingInput">Enter The Code Here</label>
                </div>
                <button class="w-100 btn btn-lg btn-primary my-3" type="submit">Check</button>
                <h6><a href="{{ route('admin.reset') }}" id="reset">Change Email</a></h6>
            </form>
        </main>
    </body>
</html>

