@extends('layouts.app')

@section('title', 'Riwayat To-Do List')

@section('header', 'Riwayat To-Do List')

@section('content')
    <div id="rainbow-bg" class="fixed top-0 left-0 w-full h-full -z-10"></div>
    <div class="space-y-8">
        <!-- Header Section -->
        <div class="bg-[#FFE066] border-4 border-black p-4 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
            <h3 class="text-2xl font-bold">
                Riwayat To-Do List
            </h3>
        </div>

        <!-- Description -->
        <div class="bg-[#E6E6FA] border-4 border-black p-4 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
            <p class="text-lg font-bold">
                Berikut adalah semua tugas yang pernah Anda buat.
            </p>
        </div>

        <!-- History Table -->
        <div class="overflow-x-auto">
            <table class="w-full neu-table bg-white">
                <thead>
                    <tr>
                        <th class="text-left">No</th>
                        <th class="text-left">Nama Tugas</th>
                        <th class="text-left">Status</th>
                        <th class="text-left">Tanggal & Waktu Tugas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($todolists as $index => $todolist)
                        <tr class="hover:bg-[#F0F0F0]">
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $todolist->nama_tugas }}</td>
                            <td>
                                @if ($todolist->status_tugas == 'pending')
                                    <span class="inline-block px-4 py-1 bg-[#FFB84D] border-2 border-black text-black font-bold">
                                        Pending
                                    </span>
                                @else
                                    <span class="inline-block px-4 py-1 bg-[#00CC99] border-2 border-black text-black font-bold">
                                        Completed
                                    </span>
                                @endif
                            </td>
                            <td class="font-bold">
                                {{ \Carbon\Carbon::parse($todolist->created_at)->translatedFormat('l, d F Y H:i:s') }} WIB
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Back Button -->
        <div class="mt-8">
            <a href="{{ route('dashboard') }}"
                class="neu-button bg-[#3366FF] text-white">
                Kembali ke Dashboard
            </a>
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
    </script>

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
    </style>
@endsection
