<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body class="min-h-screen font-['Space_Grotesk'] bg-[#F4D03F]">
    <div class="min-h-screen flex items-center justify-center p-6">
        <div class="w-full max-w-md bg-white border-4 border-black p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] hover:skew-x-12 hover:scale-110 transition-all duration-500">
            <!-- Header -->
            <div class="bg-[#FF3366] border-4 border-black p-4 -mt-12 mb-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                <h2 class="text-3xl font-bold text-white text-center">
                    Form Login
                </h2>
            </div>

            <!-- Alert Messages -->
            @if (session('success'))
                <div class="bg-[#00CC99] border-4 border-black p-4 mb-6 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-[#FF6666] border-4 border-black p-4 mb-6 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Login Form -->
            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf

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

                <a href="#" id="loginLink"
                    class="inline-block w-full px-6 py-3 bg-[#FF3366] text-white font-bold border-4 border-black transition-all duration-200 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                    Login
                </a>

                <div class="text-center space-y-2">
                    <p class="font-bold">Belum punya akun?</p>
                    <a href="/register"
                        class="inline-block px-6 py-2 bg-[#00CC99] text-black font-bold border-4 border-black transition-all duration-200 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] active:translate-x-[4px] active:translate-y-[4px] active:shadow-none">
                        Register
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Optional: Background Pattern -->
    <div class="fixed top-0 left-0 w-full h-full pointer-events-none -z-10">
        <div class="absolute w-4 h-4 bg-black rounded-full animate-ping" style="top: 10%; left: 15%;"></div>
        <div class="absolute w-4 h-4 bg-black rounded-full animate-ping" style="top: 60%; left: 85%;"></div>
        <div class="absolute w-4 h-4 bg-black rounded-full animate-ping" style="top: 80%; left: 35%;"></div>
    </div>

    <!-- Script untuk tombol nakal -->
    <script>
        const loginLink = document.getElementById('loginLink');
        const form = document.querySelector('form');
        let isLinkLocked = false;
        let attempts = 0;

        loginLink.addEventListener('mouseover', (e) => {
            if (isLinkLocked) return;

            const x = Math.random() * (window.innerWidth - loginLink.offsetWidth);
            const y = Math.random() * (window.innerHeight - loginLink.offsetHeight);

            // Pastikan link tidak keluar dari viewport
            const safeX = Math.min(Math.max(x, 0), window.innerWidth - loginLink.offsetWidth);
            const safeY = Math.min(Math.max(y, 0), window.innerHeight - loginLink.offsetHeight);

            loginLink.style.position = 'fixed';
            loginLink.style.left = `${safeX}px`;
            loginLink.style.top = `${safeY}px`;
            loginLink.style.transition = 'all 0.3s ease';
            loginLink.style.zIndex = '1000';
        });

        // Beri kesempatan untuk mengklik setelah 5x mencoba
        loginLink.addEventListener('mouseenter', () => {
            attempts++;
            if (attempts >= 10) {
                isLinkLocked = true;
                loginLink.style.position = 'static';
                loginLink.style.transform = 'none';
                loginLink.classList.add('animate-bounce');
                loginLink.textContent = 'Oke, kamu menang! Klik saya!';

                // Tambahkan event listener untuk submit form
                loginLink.addEventListener('click', (e) => {
                    e.preventDefault();
                    form.submit();
                });
            }
        });

        // Reset position when mouse leaves the viewport
        document.addEventListener('mouseleave', () => {
            if (!isLinkLocked) {
                loginLink.style.position = 'static';
                loginLink.style.transform = 'none';
            }
        });

        // Tambahkan script untuk animasi random
        const inputs = document.querySelectorAll('input');
        const inputGroups = document.querySelectorAll('.input-group');

        // Tambahkan fungsi untuk animasi random
        function createRandomParticle(input) {
            const particle = document.createElement('div');
            const size = Math.random() * 10 + 5;
            const inputRect = input.getBoundingClientRect();

            particle.className = 'input-particle';
            particle.style.width = `${size}px`;
            particle.style.height = `${size}px`;
            particle.style.left = `${inputRect.left + Math.random() * inputRect.width}px`;
            particle.style.top = `${inputRect.top + Math.random() * inputRect.height}px`;

            // Random warna
            const colors = ['#FF3366', '#00CC99', '#FFB84D', '#3366FF'];
            particle.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];

            document.body.appendChild(particle);

            setTimeout(() => particle.remove(), 1000);
        }

        // Update event listeners untuk input
        inputs.forEach(input => {
            let particleInterval;

            input.addEventListener('focus', () => {
                // Blur effect yang sudah ada
                inputGroups.forEach(group => {
                    if (!group.contains(input)) {
                        group.style.filter = 'blur(5px)';
                        group.style.opacity = '0.5';
                        group.style.transform = 'scale(0.95)';
                    }
                });

                // Tambahkan animasi particles
                particleInterval = setInterval(() => {
                    for (let i = 0; i < 3; i++) {
                        createRandomParticle(input);
                    }
                }, 100);

                // Tambahkan efek shake ringan
                input.style.animation = 'shake 0.5s infinite';
            });

            input.addEventListener('blur', () => {
                // Clear interval particles
                clearInterval(particleInterval);

                // Hapus animasi shake
                input.style.animation = 'none';

                // Cek focus yang sudah ada
                const isAnyFocused = Array.from(inputs).some(inp => inp === document.activeElement);

                if (!isAnyFocused) {
                    inputGroups.forEach(group => {
                        group.style.filter = 'none';
                        group.style.opacity = '1';
                        group.style.transform = 'scale(1)';
                    });
                }
            });
        });

        // Tambahkan efek hover
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
    </script>

    <style>
        #loginLink {
            cursor: pointer;
            user-select: none;
        }

        #loginLink.animate-bounce {
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

        .input-group {
            transition: all 0.3s ease;
        }

        input {
            transition: all 0.3s ease;
        }

        .input-group:hover label {
            color: #FF3366;
        }

        .input-particle {
            position: fixed;
            pointer-events: none;
            border-radius: 50%;
            animation: particleAnimation 1s ease-out forwards;
            z-index: 1000;
        }

        @keyframes particleAnimation {
            0% {
                transform: scale(0) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: scale(1.5) rotate(360deg);
                opacity: 0;
            }
        }

        @keyframes shake {
            0%, 100% {
                transform: translateX(0);
            }
            25% {
                transform: translateX(-2px);
            }
            75% {
                transform: translateX(2px);
            }
        }

        /* Tambahkan efek glow saat focus */
        input:focus {
            animation: glow 1.5s ease-in-out infinite alternate;
        }

        @keyframes glow {
            from {
                box-shadow: 0 0 5px #FF3366, 0 0 10px #FF3366, 0 0 15px #FF3366;
            }
            to {
                box-shadow: 0 0 10px #FF3366, 0 0 20px #FF3366, 0 0 30px #FF3366;
            }
        }
    </style>
</body>

</html>
