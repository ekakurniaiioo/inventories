<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inven — Inventaris</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&family=DM+Mono:wght@400;500&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sora: ['Sora', 'sans-serif'],
                        mono: ['DM Mono', 'monospace'],
                    },
                    colors: {
                        sage: {
                            50: '#EEF2F0',
                            100: '#D4E4DE',
                            200: '#C2DDD5',
                            300: '#8AA89E',
                            400: '#5BB591',
                            500: '#3D8C6E',
                            600: '#2E5C4A',
                            700: '#1E3A2E',
                            800: '#1E2A26',
                            900: '#111C18',
                        },
                    },
                    animation: {
                        'fade-up': 'fadeUp 0.6s ease both',
                        'fade-up-delay-1': 'fadeUp 0.6s ease 0.1s both',
                        'fade-up-delay-2': 'fadeUp 0.6s ease 0.2s both',
                        'fade-up-delay-3': 'fadeUp 0.6s ease 0.3s both',
                        'fade-up-delay-4': 'fadeUp 0.6s ease 0.4s both',
                        'fade-up-delay-5': 'fadeUp 0.6s ease 0.5s both',
                    },
                    keyframes: {
                        fadeUp: {
                            '0%': { opacity: '0', transform: 'translateY(24px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                    },
                },
            },
        }
    </script>
    <style>
        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Sora', sans-serif;
        }

        .mono {
            font-family: 'DM Mono', monospace;
        }

        .grid-bg {
            background-image: linear-gradient(rgba(212, 228, 222, 0.5) 1px, transparent 1px),
                linear-gradient(90deg, rgba(212, 228, 222, 0.5) 1px, transparent 1px);
            background-size: 60px 60px;
        }
    </style>
</head>

<body class="bg-sage-50 text-sage-800 overflow-x-hidden">

    <nav
        class="fixed top-0 left-0 right-0 z-50 flex items-center justify-between px-6 md:px-12 py-4 bg-sage-50/85 backdrop-blur-md border-b border-sage-100">
        <a href="#" class="flex items-center gap-2.5 no-underline">
            <div class="w-8 h-8 bg-sage-500 rounded-lg flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <rect x="3" y="3" width="7" height="7" rx="1" />
                    <rect x="14" y="3" width="7" height="7" rx="1" />
                    <rect x="3" y="14" width="7" height="7" rx="1" />
                    <rect x="14" y="14" width="7" height="7" rx="1" />
                </svg>
            </div>
            <span class="text-base font-bold tracking-tight text-sage-800">Inven</span>
        </a>

        <a href="/login"
            class="bg-sage-800 text-white text-sm font-semibold px-5 py-2 rounded-lg hover:bg-sage-500 transition-colors no-underline">
            Mulai Gratis
        </a>
    </nav>

    <section class="min-h-screen flex items-center pt-28 pb-20 px-6 md:px-12 relative overflow-hidden">
        <div class="absolute inset-0 grid-bg opacity-50 pointer-events-none"></div>
        <div class="absolute inset-0 pointer-events-none"
            style="background: radial-gradient(ellipse 55% 50% at 75% 50%, rgba(93,181,145,0.12) 0%, transparent 70%)">
        </div>

        <div class="max-w-6xl mx-auto w-full flex flex-col lg:flex-row gap-16 items-center relative z-10">

            <div class="flex-1 max-w-xl">
                <div
                    class="animate-fade-up-delay-1 inline-flex items-center gap-2 bg-sage-200 text-sage-500 px-4 py-1.5 rounded-full text-xs font-bold tracking-widest uppercase mb-7">
                    <span class="w-1.5 h-1.5 rounded-full bg-sage-400 inline-block"></span>
                    Sistem Inventaris
                </div>

                <h1
                    class="animate-fade-up-delay-2 text-5xl md:text-6xl font-bold tracking-tight leading-[1.1] text-sage-800 mb-6">
                    Kelola Stok<br>dengan <span class="text-sage-500">Lebih Cerdas</span>
                </h1>

                <p class="animate-fade-up-delay-3 text-lg text-sage-600 leading-relaxed mb-10 max-w-md">
                    Pantau stok, kelola gudang, dan otomatiskan laporan inventaris bisnis Anda — semua dalam satu
                    platform terintegrasi.
                </p>
            </div>

            <div class="flex-1 relative w-full max-w-lg">
                <div class="bg-sage-800 rounded-2xl p-6 shadow-2xl shadow-sage-800/30 relative overflow-hidden">
                    <div class="flex items-center justify-between mb-5">
                        <span class="text-xs font-semibold text-white/70">Dashboard Inventaris — Apr 2026</span>
                        <span class="mono bg-sage-400/20 text-sage-400 text-[11px] font-bold px-2.5 py-1 rounded-full">●
                            LIVE</span>
                    </div>

                    <div class="grid grid-cols-3 gap-3 mb-5">
                        <div class="bg-white/[0.06] rounded-xl p-3.5">
                            <div class="text-xl font-bold text-white tracking-tight">1.284</div>
                            <div class="text-[11px] text-white/40 mt-0.5 font-medium">Total</div>
                        </div>
                        <div class="bg-white/[0.06] rounded-xl p-3.5">
                            <div class="text-xl font-bold text-white tracking-tight">840 jt</div>
                            <div class="text-[11px] text-white/40 mt-0.5 font-medium">Nilai</div>
                        </div>
                        <div class="bg-white/[0.06] rounded-xl p-3.5">
                            <div class="text-xl font-bold text-white tracking-tight">14</div>
                            <div class="text-[11px] text-white/40 mt-0.5 font-medium">Stok</div>
                        </div>
                    </div>

                    <div class="w-full">
                        <div class="grid grid-cols-4 gap-2 px-2 pb-2 border-b border-white/10">
                            <span
                                class="text-[10px] font-bold text-white/30 uppercase tracking-widest col-span-2">Produk</span>
                            <span class="text-[10px] font-bold text-white/30 uppercase tracking-widest">Stok</span>
                            <span class="text-[10px] font-bold text-white/30 uppercase tracking-widest">Status</span>
                        </div>
                        <div class="grid grid-cols-4 gap-2 px-2 py-2.5 border-b border-white/[0.05] items-center">
                            <span class="text-xs font-medium text-white/90 col-span-2">Laptop Dell XPS 15</span>
                            <span class="mono text-xs text-white/60">128</span>
                            <span
                                class="inline-block bg-sage-400/20 text-sage-400 text-[10px] font-bold px-2 py-0.5 rounded-full w-fit">Aman</span>
                        </div>
                        <div class="grid grid-cols-4 gap-2 px-2 py-2.5 border-b border-white/[0.05] items-center">
                            <span class="text-xs font-medium text-white/90 col-span-2">Mouse Logitech MX3</span>
                            <span class="mono text-xs text-white/60">12</span>
                            <span
                                class="inline-block bg-yellow-400/20 text-yellow-400 text-[10px] font-bold px-2 py-0.5 rounded-full w-fit">Sedikit</span>
                        </div>
                        <div class="grid grid-cols-4 gap-2 px-2 py-2.5 border-b border-white/[0.05] items-center">
                            <span class="text-xs font-medium text-white/90 col-span-2">Keyboard Mekanikal</span>
                            <span class="mono text-xs text-white/60">0</span>
                            <span
                                class="inline-block bg-red-400/20 text-red-400 text-[10px] font-bold px-2 py-0.5 rounded-full w-fit">Habis</span>
                        </div>
                        <div class="grid grid-cols-4 gap-2 px-2 py-2.5 items-center">
                            <span class="text-xs font-medium text-white/90 col-span-2">Monitor 27" 4K</span>
                            <span class="mono text-xs text-white/60">43</span>
                            <span
                                class="inline-block bg-sage-400/20 text-sage-400 text-[10px] font-bold px-2 py-0.5 rounded-full w-fit">Aman</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <footer class="bg-sage-900 px-6 md:px-12 py-8 border-t border-white/10">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center justify-between gap-4">
            <span class="text-xs text-white/30">© 2026 Inven</span>
        </div>
    </footer>

</body>

</html>