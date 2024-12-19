<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container">
    

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="container">
        <div class="card">
        <h2>Login</h2>
        <form action="{{ route('login') }}" method="POST">
            @csrf
                <input type="email" name="email" id="email" placeholder="email" value="{{ old('email') }}" required>
                <input type="password" name="password" placeholder="Password"  id="password" required>
                <button type="submit">Login</button>
        </form>
        </div>
        </div>
   
    </div>
</body>
</html>
