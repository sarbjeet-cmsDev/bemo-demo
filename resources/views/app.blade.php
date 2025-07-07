<!DOCTYPE html>
<html lang="en" :class="isDark ? 'dark' : ''">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ticket Management System</title>

    <style>
        html, body {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
            transition: background-color 0.3s, color 0.3s;
        }

        body {
            background-color: #ffffff;
            color: #000000;
        }

        html.dark body {
            background-color: #121212;
            color: #f1f1f1;
        }

        .toggle-button {
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            border: none;
            cursor: pointer;
            margin-top: 20px;
        }

        html.dark .toggle-button {
            background-color: #eee;
            color: #111;
        }
    </style>
</head>
<body>
    <div id="app"></div>
    @vite(['resources/js/app.js'])
</body>
</html>
