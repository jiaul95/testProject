<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h2>Welcome to Dashboard</h2>
    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    <p>You are successfully logged in!</p>
    <p>User: {{ Auth::user()->name }}</p>

    <form action="/logout" method="post">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>
