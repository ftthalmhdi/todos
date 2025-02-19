<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body class="min-h-screen font-['Space_Grotesk'] bg-[#F4D03F]">
    <div class="min-h-screen flex items-center justify-center p-6">
        <div class="w-full max-w-md bg-white border-4 border-black p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] hover:skew-x-12 hover:scale-110 transition-all duration-500">
            <!-- Header -->
            <div class="bg-[#FF3366] border-4 border-black p-4 -mt-12 mb-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] hover:bg-black">
                <h2 class="text-3xl font-bold text-white text-center">
                    Form Registrasi
                </h2>
            </div>

            <!-- Alert Messages -->
            @if (session('success'))
                <div class="bg-[#00CC99] border-4 border-black p-4 mb-6 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Registration Form -->
            <form action="{{ route('register') }}" method="POST" class="space-y-6">
                @csrf

                <div class="space-y-2 input-group">
                    <label for="name" class="block text-lg font-bold">
                        Nama
                    </label>
                    <input type="text"
                        name="name"
                        id="name"
                        class="w-full px-4 py-3 border-4 border-black bg-white focus:outline-none focus:ring-4 focus:ring-[#FF3366]/50 transition-all duration-300"
                        required>
                    @error('name')
                        <div class="mt-1 bg-[#FF6666] border-4 border-black p-2 font-bold">{{ $message }}</div>
                    @enderror
                </div>

                <div class="space-y-2 input-group">
                    <label for="email" class="block text-lg font-bold">
                        Email
                    </label>
                    <input type="email"
                        name="email"
                        id="email"
                        class="w-full px-4 py-3 border-4 border-black bg-white focus:outline-none focus:ring-4 focus:ring-[#FF3366]/50 transition-all duration-300"
                        required>
                    @error('email')
                        <div class="mt-1 bg-[#FF6666] border-4 border-black p-2 font-bold">{{ $message }}</div>
                    @enderror
                </div>

                <div class="space-y-2 input-group">
                    <label for="password" class="block text-lg font-bold">
                        Password
                    </label>
                    <input type="password"
                        name="password"
                        id="password"
                        class="w-full px-4 py-3 border-4 border-black bg-white focus:outline-none focus:ring-4 focus:ring-[#FF3366]/50 transition-all duration-300"
                        required>
                    @error('password')
                        <div class="mt-1 bg-[#FF6666] border-4 border-black p-2 font-bold">{{ $message }}</div>
                    @enderror
                </div>

                <div class="space-y-2 input-group">
                    <label for="password_confirmation" class="block text-lg font-bold">
                        Konfirmasi Password
                    </label>
                    <input type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        class="w-full px-4 py-3 border-4 border-black bg-white focus:outline-none focus:ring-4 focus:ring-[#FF3366]/50 transition-all duration-300"
                        required>
                </div>

                <button type="submit" id="registerLink"
                    class="w-full px-6 py-3 bg-[#FF3366] text-white font-bold border-4 border-black transition-all duration-200 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                    Daftar
                </button>

                <div class="text-center space-y-2">
                    <p class="font-bold">Sudah punya akun?</p>
                    <a href="/login"
                        class="inline-block px-6 py-2 bg-[#00CC99] text-black font-bold border-4 border-black transition-all duration-200 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] active:translate-x-[4px] active:translate-y-[4px] active:shadow-none">
                        Login
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Optional: Background Pattern -->
    <div class="fixed top-0 left-0 w-full h-full pointer-events-none -z-10">
        <div class="absolute w-4 h-4 bg-black rounded-full animate-ping" style="top: 20%; left: 25%;"></div>
        <div class="absolute w-4 h-4 bg-black rounded-full animate-ping" style="top: 70%; left: 75%;"></div>
        <div class="absolute w-4 h-4 bg-black rounded-full animate-ping" style="top: 40%; left: 85%;"></div>
    </div>

    <!-- Script untuk efek blur dan tombol nakal -->
    <script>
        // Efek blur pada input
        const inputs = document.querySelectorAll('input');
        const inputGroups = document.querySelectorAll('.input-group');

        inputs.forEach(input => {
            input.addEventListener('focus', () => {
                // Blur semua input group kecuali yang aktif
                inputGroups.forEach(group => {
                    if (!group.contains(input)) {
                        group.style.filter = 'blur(5px)';
                        group.style.opacity = '0.5';
                        group.style.transform = 'scale(0.95)';
                    }
                });

                // Normal kan yang aktif
                input.parentElement.style.filter = 'none';
                input.parentElement.style.opacity = '1';
                input.parentElement.style.transform = 'scale(1)';
            });

            input.addEventListener('blur', () => {
                // Cek apakah ada input lain yang masih focus
                const isAnyFocused = Array.from(inputs).some(inp => inp === document.activeElement);

                if (!isAnyFocused) {
                    // Kembalikan semua ke normal jika tidak ada yang focus
                    inputGroups.forEach(group => {
                        group.style.filter = 'none';
                        group.style.opacity = '1';
                        group.style.transform = 'scale(1)';
                    });
                }
            });
        });

        // Efek hover pada input groups
        inputGroups.forEach(group => {
            group.addEventListener('mouseenter', () => {
                if (document.activeElement.tagName !== 'INPUT') {
                    group.style.transform = 'scale(1.02)';
                }
            });

            group.addEventListener('mouseleave', () => {
                if (document.activeElement.tagName !== 'INPUT') {
                    group.style.transform = 'scale(1)';
                }
            });
        });

        // Tombol Register yang nakal
        const registerLink = document.getElementById('registerLink');
        const form = document.querySelector('form');
        let isLinkLocked = false;
        let attempts = 0;

        registerLink.addEventListener('mouseover', (e) => {
            if (isLinkLocked) return;

            const x = Math.random() * (window.innerWidth - registerLink.offsetWidth);
            const y = Math.random() * (window.innerHeight - registerLink.offsetHeight);

            const safeX = Math.min(Math.max(x, 0), window.innerWidth - registerLink.offsetWidth);
            const safeY = Math.min(Math.max(y, 0), window.innerHeight - registerLink.offsetHeight);

            registerLink.style.position = 'fixed';
            registerLink.style.left = `${safeX}px`;
            registerLink.style.top = `${safeY}px`;
            registerLink.style.transition = 'all 0.3s ease';
            registerLink.style.zIndex = '1000';
        });

        registerLink.addEventListener('mouseenter', () => {
            attempts++;
            if (attempts >= 5) {
                isLinkLocked = true;
                registerLink.style.position = 'static';
                registerLink.style.transform = 'none';
                registerLink.classList.add('animate-bounce');
                registerLink.textContent = 'Oke, kamu menang! Klik saya!';

                registerLink.addEventListener('click', (e) => {
                    e.preventDefault();
                    form.submit();
                });
            }
        });

        document.addEventListener('mouseleave', () => {
            if (!isLinkLocked) {
                registerLink.style.position = 'static';
                registerLink.style.transform = 'none';
            }
        });
    </script>

    <style>
        .input-group {
            transition: all 0.3s ease;
        }

        input {
            transition: all 0.3s ease;
        }

        .input-group:hover label {
            color: #FF3366;
        }

        #registerLink {
            cursor: pointer;
            user-select: none;
        }

        #registerLink.animate-bounce {
            animation: bounce 1s infinite;
        }

        @keyframes bounce {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }
    </style>
</body>

</html>
