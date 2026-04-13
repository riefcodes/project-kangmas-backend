<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>KANGMAS</title>
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        
        <!-- Vite React Scripts -->
        @viteReactRefresh
        @vite(['resources/css/app.css', 'resources/js/main.jsx'])
    </head>
    <body class="antialiased bg-gray-50 text-gray-900 font-sans">
        <div id="root"></div>
    </body>
</html>
