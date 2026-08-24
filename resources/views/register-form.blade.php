<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>
    @if(session('error'))
        <div style="color: red;">{{ session('error') }}</div>
    @endif
    <form action="/register" method="post">
        @csrf
        <div>
            <label>Username</label><br>
            <input type="text" name="username" placeholder="Username" value="{{ old('username') }}">
            @if($errors->has('username'))
                <span style="color:red">{{ $errors->first('username') }}</span>
            @endif
        </div>
        <br>
        <div>
            <label>Email</label><br>
            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}">
            @if($errors->has('email'))
                <span style="color:red">{{ $errors->first('email') }}</span>
            @endif
        </div>
        <br>
        <div>
            <label>Phone No</label><br>
            <input type="text" name="phone" placeholder="Phone Number (10 digits)" value="{{ old('phone') }}">
            @if($errors->has('phone'))
                <span style="color:red">{{ $errors->first('phone') }}</span>
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
    <a href="/login">Already have an account? Login here</a>
</body>
</html>
