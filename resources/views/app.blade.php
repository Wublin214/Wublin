<!DOCTYPE html>
<html>
<head>
    <title>Wublin</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/js/app.js') <!-- Ensure this is correct -->
</head>
<body>
@inertia
</body>
</html>
