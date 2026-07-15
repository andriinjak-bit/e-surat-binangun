<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>E-Surat Desa Binangun</title>
    
    <!-- Tailwind CSS (CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome (CDN) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
</head>
<body class="font-sans antialiased bg-gray-50">
    <div id="app">
        @include('layouts.navigation')
        <main>
            @yield('content')
        </main>
        @include('layouts.footer')
    </div>

    <script>
    // You can add your Vue app here or in a separate file
    console.log('Vue loaded from CDN');
</script>
</body>
</html>