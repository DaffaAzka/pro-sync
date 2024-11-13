<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
</head>
<body class="bg-gray-50">

    {{ $slot }}

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>
</html>
