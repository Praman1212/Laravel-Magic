<!-- resources/views/index.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>URL Shortener</title>
</head>
<body>
    <h1>URL Shortener</h1>

    <!-- Form to submit a long URL -->
    <form action="{{ url('/shorten') }}" method="POST">
        @csrf
        <label for="original_url">Enter Long URL:</label>
        <input type="text" id="original_url" name="original_url" required>
        <button type="submit">Shorten</button>
    </form>

    @if (session('short_url'))
        <h2>Shortened URL:</h2>
        <p><a href="{{ session('short_url') }}" target="_blank">{{ session('short_url') }}</a></p>
    @endif

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</body>
</html>
