<!DOCTYPE html>
<html>
<head>
    <title>OTP Verification</title>
</head>
<body>
    <h2>OTP Verification</h2>
    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div style="color: red;">{{ session('error') }}</div>
    @endif

    <form action="/verify-otp" method="post">
        @csrf
        <div>
            <label>Enter OTP</label><br>
            <input type="text" name="otp" placeholder="6-digit OTP">
            @if($errors->has('otp'))
                <span style="color:red">{{ $errors->first('otp') }}</span>
            @endif
        </div>
        <br>
        <button type="submit">Verify</button>
    </form>
</body>
</html>
