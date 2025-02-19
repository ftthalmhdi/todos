@extends('layouts.app')

@section('title', 'Dashboard')

@section('header', 'Dashboard')

@section('content')
    <!-- Rainbow Background Animation -->
    <div id="rainbow-bg" class="fixed top-0 left-0 w-full h-full -z-10"></div>

    <!-- Tambahkan div untuk cursor glow -->
    <div id="cursor-glow"></div>

    <div class="space-y-8">
        <!-- Header Section with Live Time -->
        <div class="bg-[#FFE066] border-4 border-black p-4 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
            <h3 class="text-2xl font-bold">
                To-Do List Hari ini: <span id="live-time" class="text-[#FF3366]">{{ $hariIni }} WIB</span>
            </h3>
        </div>

        <!-- Add Task Form -->
        <form action="{{ route('todolist.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <input type="text" name="nama_tugas"
                    class="neu-input"
                    placeholder="Tambahkan tugas baru" required>
            </div>
            <div class="flex gap-4">
                <button type="submit" class="neu-button neu-button-primary">
                    Tambah
                </button>
                <a href="{{ route('todolist.history') }}" class="neu-button neu-button-secondary">
                    Lihat Riwayat
                </a>
            </div>
        </form>

        <!-- Tasks Table -->
        <div class="overflow-x-auto">
            <table class="w-full neu-table bg-white">
                <thead>
                    <tr>
                        <th class="text-left">No</th>
                        <th class="text-left">Nama Tugas</th>
                        <th class="text-left">Status</th>
                        <th class="text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($todolists as $index => $todolist)
                        <tr class="hover:bg-[#F0F0F0]">
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $todolist->nama_tugas }}</td>
                            <td>
                                <form action="{{ route('todolist.update', $todolist->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status_tugas"
                                        class="neu-select"
                                        onchange="this.form.submit()">
                                        <option value="pending" {{ $todolist->status_tugas == 'pending' ? 'selected' : '' }}>
                                            Pending
                                        </option>
                                        <option value="completed" {{ $todolist->status_tugas == 'completed' ? 'selected' : '' }}>
                                            Completed
                                        </option>
                                    </select>
                                </form>
                            </td>
                            <td>
                                <div class="flex gap-2">
                                    <a href="{{ route('todolist.edit', $todolist->id) }}"
                                        class="neu-button bg-[#FFB84D] text-black">
                                        Edit
                                    </a>
                                    <form action="{{ route('todolist.destroy', $todolist->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="neu-button neu-button-danger">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Logout Button -->
        <form action="{{ route('logout') }}" method="POST" class="mt-8">
            @csrf
            <button type="submit" class="neu-button neu-button-danger">
                Logout
            </button>
        </form>
    </div>

    <!-- Add this before closing body tag -->
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

        // Live Time Update
        function updateTime() {
            const now = new Date();
            const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

            const dayName = days[now.getDay()];
            const day = now.getDate();
            const month = months[now.getMonth()];
            const year = now.getFullYear();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');

            const timeString = `${dayName}, ${day} ${month} ${year} ${hours}:${minutes}:${seconds} WIB`;
            document.getElementById('live-time').textContent = timeString;
        }

        // Update time every second
        setInterval(updateTime, 1000);
        updateTime(); // Initial call

        // Multiple types of sparkles with reduced frequency
        function createSparkles() {
            // Randomly choose type of sparkle
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

        // Reduced frequency to 200ms
        setInterval(createSparkles, 200);

        // Update style for more subtle effects
        const enhancedStyle = document.createElement('style');
        enhancedStyle.textContent = `
            /* Regular sparkle */
            .sparkle-regular {
                width: 2px;
                height: 2px;
                background: white;
                border-radius: 50%;
                animation: sparkleRegular 1.5s ease-in-out;
                box-shadow: 0 0 2px white;
                opacity: 0.6;
            }

            /* Star sparkle */
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

            /* Big sparkle */
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
        `;
        document.head.appendChild(enhancedStyle);

        // Tambahkan fungsi untuk meteor effect
        function createMeteor(x, y, angle) {
            const meteor = document.createElement('div');
            meteor.className = 'meteor';
            meteor.style.left = `${x}px`;
            meteor.style.top = `${y}px`;
            meteor.style.transform = `rotate(${angle}deg)`;
            document.body.appendChild(meteor);
            setTimeout(() => meteor.remove(), 500);
        }

        // Cursor tracking dan meteor creation
        let prevX = 0;
        let prevY = 0;
        let meteorsEnabled = true;

        document.addEventListener('mousemove', (e) => {
            if (!meteorsEnabled) return;

            const currentX = e.clientX;
            const currentY = e.clientY;
            const deltaX = currentX - prevX;
            const deltaY = currentY - prevY;
            const distance = Math.sqrt(deltaX * deltaX + deltaY * deltaY);
            const angle = Math.atan2(deltaY, deltaX) * 180 / Math.PI;

            if (distance > 5) {
                for (let i = 0; i < 3; i++) {
                    const offsetX = Math.random() * 20 - 10;
                    const offsetY = Math.random() * 20 - 10;
                    createMeteor(currentX + offsetX, currentY + offsetY, angle);
                }
                meteorsEnabled = false;
                setTimeout(() => meteorsEnabled = true, 50);
            }

            prevX = currentX;
            prevY = currentY;
        });

        // Cursor glow effect
        const cursorGlow = document.getElementById('cursor-glow');
        let mouseX = 0;
        let mouseY = 0;
        let cursorX = 0;
        let cursorY = 0;

        document.addEventListener('mousemove', (e) => {
            mouseX = e.clientX;
            mouseY = e.clientY;
        });

        function animateCursor() {
            const dx = mouseX - cursorX;
            const dy = mouseY - cursorY;

            cursorX += dx * 0.1;
            cursorY += dy * 0.1;

            cursorGlow.style.left = `${cursorX}px`;
            cursorGlow.style.top = `${cursorY}px`;

            const randomScale = 1 + Math.random() * 0.2;
            cursorGlow.style.transform = `translate(-50%, -50%) scale(${randomScale})`;

            requestAnimationFrame(animateCursor);
        }

        animateCursor();

        // Trail effect
        function createTrailParticle(x, y) {
            const particle = document.createElement('div');
            particle.className = 'cursor-trail';
            particle.style.left = `${x}px`;
            particle.style.top = `${y}px`;
            document.body.appendChild(particle);
            setTimeout(() => particle.remove(), 500);
        }

        let lastX = 0;
        let lastY = 0;

        document.addEventListener('mousemove', (e) => {
            const dx = e.clientX - lastX;
            const dy = e.clientY - lastY;
            const distance = Math.sqrt(dx * dx + dy * dy);

            if (distance > 20) {
                createTrailParticle(e.clientX, e.clientY);
                lastX = e.clientX;
                lastY = e.clientY;
            }
        });
    </script>

    <style>
        #rainbow-bg {
            opacity: 0.3;
            filter: blur(100px);
            transition: background 0.5s ease;
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

        /* Cursor glow */
        #cursor-glow {
            position: fixed;
            width: 50px;
            height: 50px;
            background: radial-gradient(
                circle,
                rgba(255, 51, 102, 0.8),
                rgba(255, 51, 102, 0.6),
                rgba(255, 51, 102, 0.4),
                transparent 70%
            );
            border-radius: 50%;
            pointer-events: none;
            z-index: 9999;
            mix-blend-mode: screen;
            filter: blur(2px);
            box-shadow:
                0 0 10px rgba(255, 51, 102, 0.8),
                0 0 20px rgba(255, 51, 102, 0.6),
                0 0 30px rgba(255, 51, 102, 0.4);
            animation: glowPulse 2s infinite;
        }

        /* Cursor trail */
        .cursor-trail {
            position: fixed;
            width: 15px;
            height: 15px;
            background: radial-gradient(
                circle,
                rgba(255, 51, 102, 1),
                rgba(255, 51, 102, 0.8),
                transparent 70%
            );
            border-radius: 50%;
            pointer-events: none;
            z-index: 9998;
            mix-blend-mode: screen;
            box-shadow:
                0 0 5px rgba(255, 51, 102, 1),
                0 0 10px rgba(255, 51, 102, 0.8);
            animation: enhancedTrailFade 0.8s ease-out forwards;
        }

        /* Tambah inner dot untuk cursor */
        #cursor-glow::after {
            content: '';
            position: absolute;
            width: 8px;
            height: 8px;
            background: #FF3366;
            border-radius: 50%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            box-shadow:
                0 0 5px #FF3366,
                0 0 10px #FF3366,
                0 0 15px #FF3366,
                0 0 20px #FF3366;
        }

        @keyframes glowPulse {
            0%, 100% {
                transform: translate(-50%, -50%) scale(1);
                filter: brightness(1);
            }
            50% {
                transform: translate(-50%, -50%) scale(1.2);
                filter: brightness(1.2);
            }
        }

        @keyframes enhancedTrailFade {
            0% {
                opacity: 1;
                transform: scale(1) rotate(0deg);
                filter: brightness(1.2);
            }
            100% {
                opacity: 0;
                transform: scale(0.3) rotate(180deg);
                filter: brightness(0.8);
            }
        }

        /* Cursor styles */
        * {
            cursor: none;
        }

        input,
        textarea,
        select {
            cursor: text;
        }

        a,
        button {
            cursor: none;
        }

        /* Hover effects */
        a:hover ~ #cursor-glow,
        button:hover ~ #cursor-glow {
            transform: scale(1.5);
            background: radial-gradient(
                circle,
                rgba(0, 204, 153, 0.9),
                rgba(0, 204, 153, 0.7),
                rgba(0, 204, 153, 0.5),
                transparent 70%
            );
            box-shadow:
                0 0 15px rgba(0, 204, 153, 0.8),
                0 0 30px rgba(0, 204, 153, 0.6);
        }
    </style>
@endsection
