<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'To-Do List App')</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        /* Button Base */
        .neu-button {
            padding: 0.75rem 1.5rem;
            font-weight: 700;
            border: 4px solid #000000;
            transition: all 0.2s;
            box-shadow: 4px 4px 0px 0px #000000;
            cursor: pointer;
        }

        .neu-button:hover {
            transform: translate(2px, 2px);
            box-shadow: 2px 2px 0px 0px #000000;
        }

        .neu-button:active {
            transform: translate(4px, 4px);
            box-shadow: none;
        }

        /* Button Variants */
        .neu-button-primary {
            background-color: #FF3366;
            color: white;
        }

        .neu-button-secondary {
            background-color: #00CC99;
            color: black;
        }

        .neu-button-danger {
            background-color: #FF6666;
            color: white;
        }

        /* Input & Select Styling */
        .neu-input, .neu-select {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 4px solid #000000;
            background-color: white;
            transition: all 0.2s;
        }

        .neu-input:focus, .neu-select:focus {
            outline: none;
            box-shadow: 4px 4px 0px 0px rgba(255, 51, 102, 0.3);
        }

        /* Table Styling */
        .neu-table {
            width: 100%;
            border: 4px solid #000000;
            border-collapse: separate;
            border-spacing: 0;
        }

        .neu-table th {
            background-color: #3366FF;
            color: white;
            padding: 0.75rem 1rem;
            border-bottom: 4px solid #000000;
            text-align: left;
        }

        .neu-table td {
            padding: 0.75rem 1rem;
            border-bottom: 4px solid #000000;
        }

        .neu-table tr:last-child td {
            border-bottom: none;
        }
    </style>
</head>
<body class="min-h-screen font-['Space_Grotesk'] bg-[#F4D03F] text-gray-900">
    <!-- Navigation Bar -->
    <nav class="bg-[#FF3366] p-4 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
        <div class="max-w-6xl mx-auto">
            <h1 class="text-2xl font-bold text-white">
                To-Do List App
            </h1>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="mx-auto max-w-4xl mt-8 p-8">
        <!-- Header Section -->
        <div class="bg-[#00CC99] p-6 mb-8 border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
            <h2 class="text-4xl md:text-5xl text-center uppercase tracking-wide font-bold text-black">
                @yield('header')
            </h2>
        </div>

        <!-- Alert Messages -->
        @if(session('success'))
            <div class="bg-[#66FF99] border-4 border-black p-4 mb-6 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-[#FF6666] border-4 border-black p-4 mb-6 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                {{ session('error') }}
            </div>
        @endif

        <!-- Main Content Area -->
        <div class="bg-white border-4 border-black p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
            @yield('content')
        </div>

        <!-- Footer -->
        <footer class="mt-10 text-center">
            <div class="bg-[#3366FF] text-white p-4 border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                <p class="text-xl">&copy; {{ date('Y') }} To-Do List App - Dibuat dengan Laravel</p>
            </div>
        </footer>
    </div>
</body>
</html>
