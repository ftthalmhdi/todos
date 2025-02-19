@extends('layouts.app')

@section('title', 'Edit To-Do List')

@section('header', 'Edit To-Do List')

@section('content')
    <!-- Rainbow Background Animation -->
    <div id="rainbow-bg" class="fixed top-0 left-0 w-full h-full -z-10"></div>

    <div class="space-y-8">
        <!-- Header Section -->
        <div class="bg-[#FFE066] border-4 border-black p-4 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
            <h3 class="text-2xl font-bold">
                Edit Tugas
            </h3>
        </div>

        <!-- Edit Form -->
        <form action="{{ route('todolist.updateNama', $todolist->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PATCH')

            <div class="space-y-3">
                <label for="nama_tugas" class="block text-lg font-bold">
                    Nama Tugas
                </label>
                <input type="text"
                    name="nama_tugas"
                    class="neu-input"
                    value="{{ $todolist->nama_tugas }}"
                    required>
            </div>

            <div class="flex gap-4">
                <button type="submit"
                    class="neu-button bg-[#00CC99] text-black">
                    Simpan Perubahan
                </button>
                <a href="{{ route('dashboard') }}"
                    class="neu-button bg-[#999999] text-white">
                    Batal
                </a>
            </div>
        </form>
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
