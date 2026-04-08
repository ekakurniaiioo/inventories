<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Multi-Role</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        
        /* Custom styling untuk Role Selector */
        .role-selector input:checked + label {
            background-color: #10b981; /* emerald-500 */
            color: white;
            border-color: #10b981;
        }
    </style>
</head>

<body class="bg-[#f0f4f1] flex items-center justify-center min-h-screen p-6">

    <div class="w-full max-w-md">
        <div class="bg-white rounded-[2rem] shadow-xl shadow-emerald-900/5 p-8 md:p-10 border border-emerald-100/50">
            
            <div class="flex justify-center mb-6">
                <div class="w-16 h-16 bg-emerald-50 rounded-2xl flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                </div>
            </div>

            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-slate-800">Selamat Datang</h1>
                <p class="text-slate-500 text-sm mt-1">Silakan masuk sesuai peran Anda</p>
            </div>

            <form action="/login" method="POST" class="space-y-5">
                @csrf

                <div class="space-y-3">
                    <label class="text-xs font-bold uppercase tracking-wider text-slate-400 ml-1">Pilih Peran</label>
                    <div class="grid grid-cols-3 gap-2 role-selector">
                        <div>
                            <input type="radio" name="role" id="admin" value="admin" class="hidden" checked>
                            <label for="admin" class="flex items-center justify-center py-2 text-sm font-semibold border-2 border-slate-100 rounded-xl text-slate-500 cursor-pointer transition-all hover:bg-slate-50">
                                Admin
                            </label>
                        </div>
                        <div>
                            <input type="radio" name="role" id="petugas" value="petugas" class="hidden">
                            <label for="petugas" class="flex items-center justify-center py-2 text-sm font-semibold border-2 border-slate-100 rounded-xl text-slate-500 cursor-pointer transition-all hover:bg-slate-50">
                                Petugas
                            </label>
                        </div>
                        <div>
                            <input type="radio" name="role" id="user" value="user" class="hidden">
                            <label for="user" class="flex items-center justify-center py-2 text-sm font-semibold border-2 border-slate-100 rounded-xl text-slate-500 cursor-pointer transition-all hover:bg-slate-50">
                                User
                            </label>
                        </div>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="bg-red-50 text-red-600 text-xs p-3 rounded-xl border border-red-100 animate-pulse">
                        {{ $errors->first() }}
                    </div>
                @endif

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5 ml-1">Email</label>
                        <input type="email" name="email" required
                            class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:outline-none focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all placeholder:text-slate-400"
                            placeholder="nama@email.com">
                    </div>

                    <div>
                        <div class="flex justify-between mb-1.5 ml-1">
                            <label class="block text-sm font-semibold text-slate-700">Password</label>
                            <a href="#" class="text-xs font-semibold text-emerald-600 hover:text-emerald-700">Lupa?</a>
                        </div>
                        <input type="password" name="password" required
                            class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:outline-none focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all placeholder:text-slate-400"
                            placeholder="••••••••">
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3.5 rounded-xl shadow-lg shadow-emerald-200 transition-all active:scale-[0.98] mt-2">
                    Masuk Sekarang
                </button>
            </form>

            <p class="text-center mt-8 text-sm text-slate-500">
                Ada kendala? <a href="#" class="text-emerald-600 font-bold hover:underline">Hubungi IT Support</a>
            </p>
        </div>
    </div>

</body>
</html>