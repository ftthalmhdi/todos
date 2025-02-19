<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body class="min-h-screen font-['Space_Grotesk'] bg-[#F4D03F]">
    <!-- Rainbow Background Animation -->
    <div id="rainbow-bg" class="fixed top-0 left-0 w-full h-full -z-10"></div>

    <!-- Main Content -->
    <div class="min-h-screen flex items-center justify-center p-6">
        <div class="max-w-2xl w-full bg-white border-4 border-black p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
            <!-- Header -->
            <div class="bg-[#FF3366] border-4 border-black p-6 -mt-12 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                <h1 class="text-4xl md:text-5xl font-bold text-white text-center">
                    To-Do List App
                </h1>
            </div>

            <!-- Description -->
            <div class="mt-8 bg-[#00CC99] border-4 border-black p-4 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                <p class="text-xl font-bold text-black text-center">
                    Kelola tugas harian Anda dengan mudah dan efisien.
                </p>
            </div>

            <!-- Buttons -->
            <div class="mt-8 flex flex-col md:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}"
                    class="neu-button bg-[#FF3366] text-white text-center text-lg">
                    Daftar Sekarang
                </a>

                <a href="{{ route('login') }}"
                    class="neu-button bg-[#3366FF] text-white text-center text-lg">
                    Login
                </a>
            </div>

            <!-- Features -->
            <div class="mt-12 grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-[#FFE066] border-4 border-black p-4 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                    <h3 class="font-bold text-lg mb-2">✨ Mudah Digunakan</h3>
                    <p>Interface yang simpel dan intuitif</p>
                </div>
                <div class="bg-[#E6E6FA] border-4 border-black p-4 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                    <h3 class="font-bold text-lg mb-2">🚀 Efisien</h3>
                    <p>Kelola tugas dengan cepat dan efektif</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Background and Sparkle Effects -->
    <script>
        // Rainbow Background Animation
        const rainbowBg = document.getElementById('rainbow-bg');
        let hue = 0;

        function updateBackground() {
            hue = (hue + 1) % 360;
            rainbowBg.style.background = `linear-gradient(${hue}deg,
                hsl(${hue}, 100%, 50%),
                hsl(${(hue + 60) % 360}, 100%, 50%),
                hsl(${(hue + 120) % 360}, 100%, 50%),
                hsl(${(hue + 180) % 360}, 100%, 50%),
                hsl(${(hue + 240) % 360}, 100%, 50%),
                hsl(${(hue + 300) % 360}, 100%, 50%))`;
            requestAnimationFrame(updateBackground);
        }

        updateBackground();

        // Sparkle Effects
        function createSparkles() {
            const types = ['regular', 'star', 'big'];
            const randomType = types[Math.floor(Math.random() * types.length)];
            createSparkle(randomType);
        }

        function createSparkle(type) {
            const sparkle = document.createElement('div');
            sparkle.style.position = 'fixed';
            sparkle.style.left = Math.random() * 100 + 'vw';
            sparkle.style.top = Math.random() * 100 + 'vh';
            sparkle.style.pointerEvents = 'none';

            switch(type) {
                case 'regular':
                    sparkle.className = 'sparkle-regular';
                    break;
                case 'star':
                    sparkle.className = 'sparkle-star';
                    break;
                case 'big':
                    sparkle.className = 'sparkle-big';
                    break;
            }

            document.body.appendChild(sparkle);
            setTimeout(() => sparkle.remove(), 1500);
        }

        setInterval(createSparkles, 200);

        // Tambahkan fungsi untuk meteor effect
        function createMeteor(x, y, angle) {
            const meteor = document.createElement('div');
            meteor.className = 'meteor';

            // Posisi awal meteor
            meteor.style.left = `${x}px`;
            meteor.style.top = `${y}px`;

            // Rotasi sesuai arah gerakan
            meteor.style.transform = `rotate(${angle}deg)`;

            document.body.appendChild(meteor);

            // Hapus meteor setelah animasi selesai
            setTimeout(() => meteor.remove(), 500);
        }

        // Variabel untuk tracking posisi mouse
        let prevX = 0;
        let prevY = 0;
        let meteorsEnabled = true;

        // Event listener untuk mouse movement
        document.addEventListener('mousemove', (e) => {
            if (!meteorsEnabled) return;

            const currentX = e.clientX;
            const currentY = e.clientY;

            // Hitung kecepatan dan arah gerakan
            const deltaX = currentX - prevX;
            const deltaY = currentY - prevY;
            const distance = Math.sqrt(deltaX * deltaX + deltaY * deltaY);
            const angle = Math.atan2(deltaY, deltaX) * 180 / Math.PI;

            // Buat meteor jika gerakan cukup cepat
            if (distance > 5) {
                // Buat beberapa meteor dengan posisi random di sekitar cursor
                for (let i = 0; i < 3; i++) {
                    const offsetX = Math.random() * 20 - 10;
                    const offsetY = Math.random() * 20 - 10;
                    createMeteor(currentX + offsetX, currentY + offsetY, angle);
                }

                // Throttle meteor creation
                meteorsEnabled = false;
                setTimeout(() => meteorsEnabled = true, 50);
            }

            prevX = currentX;
            prevY = currentY;
        });
    </script>

    <!-- Tambahkan div untuk efek neon -->
    <div class="neon-container">
        <div class="neon-line neon-line-1"></div>
        <div class="neon-line neon-line-2"></div>
        <div class="neon-line neon-line-3"></div>
        <div class="neon-circle"></div>
    </div>

    <style>
        #rainbow-bg {
            opacity: 0.3;
            filter: blur(100px);
            transition: background 0.5s ease;
        }

        /* Sparkle Styles */
        .sparkle-regular {
            width: 2px;
            height: 2px;
            background: white;
            border-radius: 50%;
            animation: sparkleRegular 1.5s ease-in-out;
            box-shadow: 0 0 2px white;
            opacity: 0.6;
        }

        .sparkle-star {
            width: 0;
            height: 0;
            border-left: 4px solid transparent;
            border-right: 4px solid transparent;
            border-bottom: 8px solid gold;
            transform: rotate(45deg);
            animation: sparkleStar 1.5s ease-in-out;
            filter: drop-shadow(0 0 2px gold);
            opacity: 0.6;
        }

        .sparkle-big {
            width: 4px;
            height: 4px;
            background: #FF3366;
            border-radius: 50%;
            animation: sparkleBig 1.5s ease-in-out;
            box-shadow: 0 0 4px #FF3366;
            opacity: 0.6;
        }

        @keyframes sparkleRegular {
            0%, 100% {
                opacity: 0;
                transform: scale(0);
            }
            50% {
                opacity: 0.6;
                transform: scale(1);
            }
        }

        @keyframes sparkleStar {
            0%, 100% {
                opacity: 0;
                transform: scale(0) rotate(45deg);
            }
            50% {
                opacity: 0.6;
                transform: scale(1) rotate(225deg);
            }
        }

        @keyframes sparkleBig {
            0%, 100% {
                opacity: 0;
                transform: scale(0);
            }
            50% {
                opacity: 0.6;
                transform: scale(1);
            }
        }

        /* Button Styles */
        .neu-button {
            padding: 0.75rem 1.5rem;
            font-weight: 700;
            border: 4px solid #000000;
            transition: all 0.2s;
            box-shadow: 4px 4px 0px 0px #000000;
        }

        .neu-button:hover {
            transform: translate(2px, 2px);
            box-shadow: 2px 2px 0px 0px #000000;
        }

        .neu-button:active {
            transform: translate(4px, 4px);
            box-shadow: none;
        }

        /* Neon Styles */
        .neon-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }

        .neon-line {
            position: absolute;
            background: linear-gradient(90deg,
                transparent,
                rgba(255, 51, 102, 0.5),
                rgba(255, 51, 102, 0.8),
                rgba(255, 51, 102, 0.5),
                transparent
            );
            height: 2px;
            width: 100%;
            animation: neonLineMove 8s infinite;
            filter: blur(3px);
            opacity: 0.7;
        }

        .neon-line-1 {
            top: 20%;
            animation-delay: 0s;
        }

        .neon-line-2 {
            top: 50%;
            animation-delay: -2s;
            background: linear-gradient(90deg,
                transparent,
                rgba(0, 204, 153, 0.5),
                rgba(0, 204, 153, 0.8),
                rgba(0, 204, 153, 0.5),
                transparent
            );
        }

        .neon-line-3 {
            top: 80%;
            animation-delay: -4s;
            background: linear-gradient(90deg,
                transparent,
                rgba(51, 102, 255, 0.5),
                rgba(51, 102, 255, 0.8),
                rgba(51, 102, 255, 0.5),
                transparent
            );
        }

        .neon-circle {
            position: absolute;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: radial-gradient(
                circle,
                rgba(255, 51, 102, 0.3),
                transparent 70%
            );
            filter: blur(8px);
            animation: neonCircleMove 10s infinite;
        }

        @keyframes neonLineMove {
            0% {
                transform: translateX(-100%) scaleX(0.5);
            }
            50% {
                transform: translateX(100%) scaleX(1.5);
            }
            100% {
                transform: translateX(-100%) scaleX(0.5);
            }
        }

        @keyframes neonCircleMove {
            0% {
                top: 0;
                left: 0;
                transform: scale(1);
            }
            25% {
                top: 80%;
                left: 80%;
                transform: scale(1.5);
            }
            50% {
                top: 80%;
                left: 0;
                transform: scale(1);
            }
            75% {
                top: 0;
                left: 80%;
                transform: scale(1.5);
            }
            100% {
                top: 0;
                left: 0;
                transform: scale(1);
            }
        }

        /* Tambahkan efek neon untuk card utama */
        .max-w-2xl {
            position: relative;
        }

        .max-w-2xl::after {
            content: '';
            position: absolute;
            top: -5px;
            left: -5px;
            right: -5px;
            bottom: -5px;
            background: linear-gradient(45deg,
                #FF3366,
                #00CC99,
                #3366FF,
                #FF3366
            );
            z-index: -1;
            filter: blur(15px);
            opacity: 0.5;
            animation: borderGlow 5s linear infinite;
        }

        @keyframes borderGlow {
            0% {
                filter: blur(15px) hue-rotate(0deg);
            }
            100% {
                filter: blur(15px) hue-rotate(360deg);
            }
        }

        /* Tambahkan efek hover untuk buttons */
        .neu-button {
            position: relative;
            overflow: hidden;
        }

        .neu-button::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                45deg,
                transparent,
                rgba(255, 255, 255, 0.1),
                transparent
            );
            transform: rotate(45deg);
            animation: buttonShine 3s infinite;
        }

        @keyframes buttonShine {
            0% {
                transform: translateX(-100%) rotate(45deg);
            }
            100% {
                transform: translateX(100%) rotate(45deg);
            }
        }

        /* Style untuk meteor effect */
        .meteor {
            position: fixed;
            pointer-events: none;
            z-index: 9997;
            width: 20px;
            height: 2px;
            background: linear-gradient(
                to right,
                rgba(255, 255, 255, 0.8),
                rgba(255, 51, 102, 0.6),
                transparent
            );
            border-radius: 1px;
            animation: meteorFade 0.5s ease-out forwards;
            filter: blur(1px);
        }

        .meteor::before {
            content: '';
            position: absolute;
            width: 4px;
            height: 4px;
            border-radius: 50%;
            background: white;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            box-shadow:
                0 0 10px #fff,
                0 0 20px #fff,
                0 0 30px #FF3366,
                0 0 40px #FF3366;
        }

        @keyframes meteorFade {
            0% {
                opacity: 1;
                transform: scale(1) translateX(0);
            }
            100% {
                opacity: 0;
                transform: scale(0.5) translateX(30px);
            }
        }

        /* Update cursor trail untuk lebih dramatis */
        .cursor-trail {
            position: fixed;
            width: 15px;
            height: 15px;
            background: radial-gradient(
                circle,
                rgba(255, 51, 102, 0.8),
                rgba(255, 51, 102, 0.4),
                transparent 70%
            );
            border-radius: 50%;
            pointer-events: none;
            z-index: 9998;
            mix-blend-mode: screen;
            animation: enhancedTrailFade 0.8s ease-out forwards;
        }

        @keyframes enhancedTrailFade {
            0% {
                opacity: 0.8;
                transform: scale(1) rotate(0deg);
            }
            100% {
                opacity: 0;
                transform: scale(0.3) rotate(180deg);
            }
        }

        /* Update cursor glow untuk lebih dramatis */
        #cursor-glow {
            width: 50px;
            height: 50px;
            background: radial-gradient(
                circle,
                rgba(255, 51, 102, 0.4),
                rgba(255, 51, 102, 0.2),
                transparent 70%
            );
            animation: glowPulse 2s infinite;
        }

        @keyframes glowPulse {
            0%, 100% {
                transform: translate(-50%, -50%) scale(1);
            }
            50% {
                transform: translate(-50%, -50%) scale(1.2);
            }
        }
    </style>
</body>
</html>
