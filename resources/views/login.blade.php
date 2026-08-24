<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div style="color: red;">{{ session('error') }}</div>
    @endif

    <form action="/validate" method="post">
        @csrf
        <div>
            <label>Email</label><br>
            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}">
            @if($errors->has('email'))
                <span style="color:red">{{ $errors->first('email') }}</span>
            @endif
        </div>
        <br>
        <div>
            <label>Password</label><br>
            <input type="password" name="password" placeholder="Password">
            @if($errors->has('password'))
                <span style="color:red">{{ $errors->first('password') }}</span>
            @endif
        </div>
        <br>
        <button type="submit">Submit</button>
    </form>
    <br>
    <a href="/register-form">Don't have an account? Register here</a>
</body>
</html>
