<!DOCTYPE html>
<html>
<head>
    <title>OTP Verification</title>
</head>
<body>
    <h2>OTP Verification</h2>
    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div>{{ session('error') }}</div>
    @endif
    @if(session('note'))
        <div>
            <strong>{{ session('note') }}</strong>
        </div>
    @endif

    <form action="/verify-otp" method="post">
        @csrf
        <div>
            <label>Enter OTP</label><br>
            <input type="text" name="otp" placeholder="6-digit OTP">
            @if($errors->has('otp'))
                <span>{{ $errors->first('otp') }}</span>
            @endif
        </div>
        <br>
        <button type="submit">Verify</button>
    </form>
</body>
</html>
