<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'アプリレイアウト' }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-100 text-gray-900">
    <header class="bg-white shadow p-4">
        {{ $header ?? '' }}
    </header>

    <main class="p-4">
        {{ $slot }}
    </main>
</body>
</html>
