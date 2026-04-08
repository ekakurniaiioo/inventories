<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>InvenTrack — Dashboard Admin</title>
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<script>
tailwind.config = {
  theme: {
    extend: {
      fontFamily: { sora: ['Sora','sans-serif'], mono: ['DM Mono','monospace'] },
      colors: {
        sage: { 50:'#EEF2F0',100:'#D4E4DE',200:'#C2DDD5',300:'#8AA89E',400:'#5BB591',500:'#3D8C6E',600:'#2E5C4A',700:'#1E3A2E',800:'#1E2A26',900:'#111C18' }
      },
      keyframes: { fadeIn:{ from:{opacity:'0',transform:'translateY(12px)'},to:{opacity:'1',transform:'translateY(0)'} } },
      animation: { 'fade-in':'fadeIn 0.35s ease both' }
    }
  }
}
</script>
<style>
  *{font-family:'Sora',sans-serif;box-sizing:border-box;}
  .mono{font-family:'DM Mono',monospace;}
  ::-webkit-scrollbar{width:4px;height:4px;}
  ::-webkit-scrollbar-track{background:transparent;}
  ::-webkit-scrollbar-thumb{background:#C2DDD5;border-radius:99px;}
  .page{display:none;}.page.active{display:block;}
  .nav-item{display:flex;align-items:center;gap:10px;padding:9px 12px;border-radius:10px;font-size:13px;font-weight:500;color:rgba(255,255,255,0.45);text-decoration:none;transition:all .18s;cursor:pointer;border:none;background:none;width:100%;text-align:left;}
  .nav-item:hover{color:rgba(255,255,255,0.82);background:rgba(255,255,255,0.06);}
  .nav-item.active{color:#C2DDD5;background:rgba(93,181,145,0.18);}
  .nav-item svg{flex-shrink:0;width:15px;height:15px;}
  .nav-sub{padding-left:36px;font-size:12.5px;}
  .badge{display:inline-flex;align-items:center;justify-content:center;min-width:18px;height:18px;padding:0 5px;border-radius:99px;font-size:10px;font-weight:700;}
  .card{background:white;border:1px solid #D4E4DE;border-radius:16px;}
  .tag{display:inline-block;padding:2px 10px;border-radius:999px;font-size:11px;font-weight:700;}
  .btn{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;border-radius:10px;font-size:13px;font-weight:600;cursor:pointer;transition:all .18s;border:none;}
  .btn-primary{background:#1E2A26;color:white;}.btn-primary:hover{background:#3D8C6E;}
  .btn-secondary{background:#EEF2F0;color:#2E5C4A;border:1px solid #D4E4DE;}.btn-secondary:hover{border-color:#3D8C6E;color:#3D8C6E;}
  .btn-danger{background:#FEF2F2;color:#DC2626;border:1px solid #FECACA;}.btn-danger:hover{background:#DC2626;color:white;}
  .btn-sm{padding:5px 12px;font-size:12px;border-radius:8px;}
  input,select,textarea{font-family:'Sora',sans-serif;font-size:13px;}
  .input{width:100%;background:white;border:1px solid #D4E4DE;border-radius:10px;padding:9px 14px;font-size:13px;color:#1E2A26;outline:none;transition:all .18s;}
  .input:focus{border-color:#3D8C6E;box-shadow:0 0 0 3px rgba(61,140,110,0.12);}
  .input::placeholder{color:#8AA89E;}
  select.input{cursor:pointer;}
  .modal-bg{position:fixed;inset:0;background:rgba(0,0,0,.45);z-index:999;display:none;align-items:center;justify-content:center;}
  .modal-bg.open{display:flex;}
  table{width:100%;border-collapse:collapse;}
  th{text-align:left;padding:10px 16px;font-size:11px;font-weight:700;color:#8AA89E;text-transform:uppercase;letter-spacing:.06em;background:#EEF2F0;}
  td{padding:12px 16px;font-size:13px;color:#2E5C4A;border-bottom:1px solid #EEF2F0;}
  tr:last-child td{border-bottom:none;}
  tr:hover td{background:#F7FAF8;}
  .section-label{font-size:11px;font-weight:700;color:#8AA89E;letter-spacing:.08em;text-transform:uppercase;margin-bottom:4px;}
</style>
</head>
<body class="bg-sage-50 min-h-screen flex">

<!-- ===================== SIDEBAR ===================== -->
<aside id="sidebar" class="w-[220px] bg-sage-800 flex flex-col min-h-screen fixed left-0 top-0 bottom-0 z-40 transition-all">
  <!-- Logo -->
  <div class="px-4 py-4 border-b border-white/10 flex items-center gap-2.5">
    <div class="w-8 h-8 bg-sage-500 rounded-lg flex items-center justify-center flex-shrink-0">
      <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/>
        <rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/>
      </svg>
    </div>
    <div>
      <div class="text-white font-bold text-sm tracking-tight leading-tight">Inven<span class="text-sage-400">Track</span></div>
      <div class="text-[10px] text-white/30 font-medium">Admin Panel</div>
    </div>
  </div>

  <!-- Nav -->
  <div class="flex-1 overflow-y-auto px-2 py-3 space-y-0.5">

    <button class="nav-item active" onclick="goTo('dashboard')">
      <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
      Dashboard
    </button>

    <!-- Kelola User group -->
    <div>
      <button class="nav-item" onclick="toggleGroup('grp-user'); goTo('kelola-user')">
        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
        Kelola User
        <svg id="arr-grp-user" class="ml-auto w-3.5 h-3.5 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
      </button>
      <div id="grp-user" class="overflow-hidden" style="max-height:0;transition:max-height .25s ease">
        <button class="nav-item nav-sub mt-0.5" onclick="goTo('tambah-user')">
          <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
          Tambah User
        </button>
      </div>
    </div>

    <button class="nav-item" onclick="goTo('kelola-kategori')">
      <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h7"/></svg>
      Kelola Kategori
    </button>

    <button class="nav-item" onclick="goTo('kategori-alat')">
      <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M14.7 6.3a1 1 0 000 1.4l1.6 1.6a1 1 0 001.4 0l3.77-3.77a6 6 0 01-7.94 7.94l-6.91 6.91a2.12 2.12 0 01-3-3l6.91-6.91a6 6 0 017.94-7.94l-3.76 3.76z"/></svg>
      Kategori Alat
    </button>

    <button class="nav-item" onclick="goTo('alat-masuk')">
      <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="16 16 12 12 8 16"/><line x1="12" y1="12" x2="12" y2="21"/><path d="M20.39 18.39A5 5 0 0018 9h-1.26A8 8 0 103 16.3"/></svg>
      Alat Masuk
      <span class="badge bg-sage-500/25 text-sage-300 ml-auto">4</span>
    </button>

    <button class="nav-item" onclick="goTo('peminjaman')">
      <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
      Peminjaman
      <span class="badge bg-yellow-500/20 text-yellow-400 ml-auto">7</span>
    </button>

    <button class="nav-item" onclick="goTo('pengembalian')">
      <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 102.13-9.36L1 10"/></svg>
      Pengembalian
      <span class="badge bg-blue-500/20 text-blue-400 ml-auto">3</span>
    </button>

    <button class="nav-item" onclick="goTo('log-aktivitas')">
      <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
      Log Aktivitas
    </button>

  </div>

  <!-- User -->
  <div class="px-3 py-3 border-t border-white/10">
    <div class="flex items-center gap-2.5 px-2">
      <div class="w-8 h-8 rounded-full bg-sage-500 flex items-center justify-center text-white text-xs font-bold flex-shrink-0">AD</div>
      <div class="flex-1 min-w-0">
        <div class="text-xs font-semibold text-white truncate">Super Admin</div>
        <div class="text-[10px] text-white/30 truncate">admin@inventrack.id</div>
      </div>
      <a href="/login" title="Keluar" class="text-white/25 hover:text-red-400 transition-colors p-1 no-underline">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4M16 17l5-5-5-5M21 12H9"/></svg>
      </a>
    </div>
  </div>
</aside>

<!-- ===================== MAIN CONTENT ===================== -->
<div class="ml-[220px] flex-1 min-h-screen">

  <!-- Topbar -->
  <header class="sticky top-0 z-30 bg-white/90 backdrop-blur border-b border-sage-100 px-7 py-3.5 flex items-center justify-between">
    <div id="topbar-title" class="text-sm font-bold text-sage-800 tracking-tight">Dashboard</div>
    <div class="flex items-center gap-3">
      <div class="relative">
        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-sage-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
        <input type="text" placeholder="Cari..." class="input w-44 pl-9 py-1.5 text-xs bg-sage-50">
      </div>
      <button class="relative p-2 bg-sage-50 border border-sage-100 rounded-xl hover:border-sage-300 transition-all">
        <svg class="w-4 h-4 text-sage-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 01-3.46 0"/></svg>
        <span class="absolute -top-1 -right-1 w-3.5 h-3.5 bg-red-500 text-white text-[8px] font-bold rounded-full flex items-center justify-center">4</span>
      </button>
      <div class="flex items-center gap-2 bg-sage-50 border border-sage-100 rounded-xl px-3 py-1.5">
        <div class="w-6 h-6 bg-sage-500 rounded-full flex items-center justify-center text-white text-[10px] font-bold">AD</div>
        <span class="text-xs font-semibold text-sage-700">Super Admin</span>
        <span class="tag bg-red-100 text-red-600">Admin</span>
      </div>
    </div>
  </header>

  <!-- Pages -->
  <div class="p-7">

    <!-- ========== DASHBOARD ========== -->
    <div id="page-dashboard" class="page active animate-fade-in">
      <div class="mb-6">
        <h1 class="text-2xl font-bold text-sage-800 tracking-tight">Dashboard Admin</h1>
        <p class="text-sm text-sage-300 mt-0.5">Senin, 7 April 2026 — Ringkasan data sistem inventaris</p>
      </div>

      <!-- Stat cards -->
      <div class="grid grid-cols-2 xl:grid-cols-4 gap-4 mb-7">
        <div class="card p-5">
          <div class="flex items-center justify-between mb-3">
            <span class="section-label">Total Alat</span>
            <div class="w-9 h-9 bg-sage-100 rounded-xl flex items-center justify-center">
              <svg class="w-4 h-4 text-sage-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M14.7 6.3a1 1 0 000 1.4l1.6 1.6a1 1 0 001.4 0l3.77-3.77a6 6 0 01-7.94 7.94l-6.91 6.91a2.12 2.12 0 01-3-3l6.91-6.91a6 6 0 017.94-7.94l-3.76 3.76z"/></svg>
            </div>
          </div>
          <div class="text-3xl font-bold text-sage-800 tracking-tight">248</div>
          <div class="text-xs text-sage-300 mt-1.5 flex items-center gap-1"><span class="text-sage-500 font-semibold">↑ 5 alat</span> bulan ini</div>
        </div>
        <div class="card p-5">
          <div class="flex items-center justify-between mb-3">
            <span class="section-label">Dipinjam</span>
            <div class="w-9 h-9 bg-yellow-50 rounded-xl flex items-center justify-center">
              <svg class="w-4 h-4 text-yellow-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            </div>
          </div>
          <div class="text-3xl font-bold text-yellow-600 tracking-tight">37</div>
          <div class="text-xs text-sage-300 mt-1.5 flex items-center gap-1"><span class="text-yellow-500 font-semibold">7 baru</span> hari ini</div>
        </div>
        <div class="card p-5">
          <div class="flex items-center justify-between mb-3">
            <span class="section-label">Dikembalikan</span>
            <div class="w-9 h-9 bg-blue-50 rounded-xl flex items-center justify-center">
              <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 102.13-9.36L1 10"/></svg>
            </div>
          </div>
          <div class="text-3xl font-bold text-blue-600 tracking-tight">12</div>
          <div class="text-xs text-sage-300 mt-1.5 flex items-center gap-1"><span class="text-blue-500 font-semibold">3 baru</span> hari ini</div>
        </div>
        <div class="card p-5">
          <div class="flex items-center justify-between mb-3">
            <span class="section-label">Total User</span>
            <div class="w-9 h-9 bg-red-50 rounded-xl flex items-center justify-center">
              <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
            </div>
          </div>
          <div class="text-3xl font-bold text-sage-800 tracking-tight">28</div>
          <div class="text-xs text-sage-300 mt-1.5">2 Admin · 8 Petugas · 18 User</div>
        </div>
      </div>

      <!-- Tables row -->
      <div class="grid grid-cols-1 xl:grid-cols-5 gap-6">
        <!-- Peminjaman aktif -->
        <div class="card overflow-hidden xl:col-span-3">
          <div class="flex items-center justify-between px-5 py-4 border-b border-sage-100">
            <h3 class="text-sm font-semibold text-sage-800">Peminjaman Aktif</h3>
            <button class="btn btn-secondary btn-sm" onclick="goTo('peminjaman')">Lihat semua</button>
          </div>
          <table>
            <thead><tr><th>Peminjam</th><th>Alat</th><th>Tgl Pinjam</th><th>Tenggat</th><th>Status</th></tr></thead>
            <tbody>
              <tr><td class="font-medium">Rino Saputra</td><td>Bor Listrik #3</td><td class="mono text-sage-400">05/04/2026</td><td class="mono text-sage-400">10/04/2026</td><td><span class="tag bg-yellow-100 text-yellow-700">Aktif</span></td></tr>
              <tr><td class="font-medium">Siti Rahayu</td><td>Tang Kombinasi</td><td class="mono text-sage-400">04/04/2026</td><td class="mono text-sage-400">08/04/2026</td><td><span class="tag bg-red-100 text-red-600">Terlambat</span></td></tr>
              <tr><td class="font-medium">Andi Wijaya</td><td>Multimeter Digital</td><td class="mono text-sage-400">06/04/2026</td><td class="mono text-sage-400">12/04/2026</td><td><span class="tag bg-yellow-100 text-yellow-700">Aktif</span></td></tr>
              <tr><td class="font-medium">Lina Marlina</td><td>Obeng Set Lengkap</td><td class="mono text-sage-400">06/04/2026</td><td class="mono text-sage-400">11/04/2026</td><td><span class="tag bg-yellow-100 text-yellow-700">Aktif</span></td></tr>
            </tbody>
          </table>
        </div>
        <!-- Log singkat -->
        <div class="card overflow-hidden xl:col-span-2">
          <div class="flex items-center justify-between px-5 py-4 border-b border-sage-100">
            <h3 class="text-sm font-semibold text-sage-800">Aktivitas Terbaru</h3>
            <button class="btn btn-secondary btn-sm" onclick="goTo('log-aktivitas')">Semua log</button>
          </div>
          <div class="divide-y divide-sage-50">
            <div class="flex gap-3 items-start p-4">
              <div class="w-7 h-7 bg-sage-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5"><svg class="w-3.5 h-3.5 text-sage-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/></svg></div>
              <div><p class="text-xs font-medium text-sage-700">User baru: Rina Cahyani</p><p class="text-[11px] text-sage-300 mt-0.5">2 menit lalu</p></div>
            </div>
            <div class="flex gap-3 items-start p-4">
              <div class="w-7 h-7 bg-yellow-50 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5"><svg class="w-3.5 h-3.5 text-yellow-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/></svg></div>
              <div><p class="text-xs font-medium text-sage-700">Peminjaman: Bor Listrik #5</p><p class="text-[11px] text-sage-300 mt-0.5">18 menit lalu</p></div>
            </div>
            <div class="flex gap-3 items-start p-4">
              <div class="w-7 h-7 bg-blue-50 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5"><svg class="w-3.5 h-3.5 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 102.13-9.36L1 10"/></svg></div>
              <div><p class="text-xs font-medium text-sage-700">Pengembalian: Tang Set</p><p class="text-[11px] text-sage-300 mt-0.5">45 menit lalu</p></div>
            </div>
            <div class="flex gap-3 items-start p-4">
              <div class="w-7 h-7 bg-sage-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5"><svg class="w-3.5 h-3.5 text-sage-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="16 16 12 12 8 16"/><line x1="12" y1="12" x2="12" y2="21"/></svg></div>
              <div><p class="text-xs font-medium text-sage-700">Alat masuk: Gergaji Jigsaw</p><p class="text-[11px] text-sage-300 mt-0.5">1 jam lalu</p></div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- ========== KELOLA USER ========== -->
    <div id="page-kelola-user" class="page animate-fade-in">
      <div class="flex items-center justify-between mb-6">
        <div>
          <h1 class="text-2xl font-bold text-sage-800 tracking-tight">Kelola User</h1>
          <p class="text-sm text-sage-300 mt-0.5">Manajemen seluruh pengguna sistem</p>
        </div>
        <button class="btn btn-primary" onclick="goTo('tambah-user')">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
          Tambah User
        </button>
      </div>

      <!-- Filter -->
      <div class="card p-4 mb-5 flex flex-wrap gap-3 items-center">
        <input type="text" placeholder="Cari nama atau email..." class="input w-56">
        <select class="input w-36"><option>Semua Role</option><option>Admin</option><option>Petugas</option><option>User</option></select>
        <select class="input w-36"><option>Semua Status</option><option>Aktif</option><option>Nonaktif</option></select>
        <button class="btn btn-secondary">Filter</button>
      </div>

      <div class="card overflow-hidden">
        <table>
          <thead><tr><th>#</th><th>Nama</th><th>Email</th><th>Role</th><th>Dibuat</th><th>Status</th><th>Aksi</th></tr></thead>
          <tbody>
          @if(isset($users))
          @foreach($users as $user)
            <tr>
              <td class="mono text-sage-300">{{ $user->id_user }}</td>
              <td><div class="flex items-center gap-2.5"><div class="w-7 h-7 bg-sage-500 rounded-full flex items-center justify-center text-white text-[11px] font-bold">AD</div><span class="font-medium">Super Admin</span></div></td>
              <td class="text-sage-400">{{ $user->email }}</td>
              <td><span class="tag bg-red-100 text-red-600">{{ $user->role }}</span></td>
              <td class="mono text-sage-400 text-xs">{{ $user->no_hp }}</td>
              <td><span class="tag bg-sage-100 text-sage-600">{{ $user->nama }}</span></td>
              <td><div class="flex gap-1.5"><button class="btn btn-secondary btn-sm">Edit</button><button class="btn btn-danger btn-sm">Hapus</button></div></td>
            </tr>
            @endforeach
            @endif
          </tbody>
        </table>
        <div class="flex items-center justify-between px-5 py-3 border-t border-sage-100">
          <span class="text-xs text-sage-300">Menampilkan 4 dari 28 user</span>
          <div class="flex gap-1.5">
            <button class="btn btn-secondary btn-sm px-3">‹</button>
            <button class="btn btn-primary btn-sm px-3">1</button>
            <button class="btn btn-secondary btn-sm px-3">2</button>
            <button class="btn btn-secondary btn-sm px-3">›</button>
          </div>
        </div>
      </div>
    </div>

    <!-- ========== TAMBAH USER ========== -->
    <div id="page-tambah-user" class="page animate-fade-in">
      <div class="flex items-center gap-3 mb-6">
        <button class="btn btn-secondary btn-sm" onclick="goTo('kelola-user')">
          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
          Kembali
        </button>
        <div>
          <h1 class="text-2xl font-bold text-sage-800 tracking-tight">Tambah User Baru</h1>
          <p class="text-sm text-sage-300 mt-0.5">Isi form untuk membuat akun pengguna baru</p>
        </div>
      </div>

      <div class="max-w-2xl">
        <div class="card p-6 space-y-5">
          <div class="grid grid-cols-2 gap-4">
            <div>
              <label class="section-label block mb-1.5">Nama Lengkap <span class="text-red-400">*</span></label>
              <input type="text" placeholder="Contoh: Budi Santoso" class="input">
            </div>
            <div>
              <label class="section-label block mb-1.5">Username <span class="text-red-400">*</span></label>
              <input type="text" placeholder="budi.santoso" class="input">
            </div>
          </div>
          <div>
            <label class="section-label block mb-1.5">Email <span class="text-red-400">*</span></label>
            <input type="email" placeholder="budi@inventrack.id" class="input">
          </div>
          <div class="grid grid-cols-2 gap-4">
            <div>
              <label class="section-label block mb-1.5">Password <span class="text-red-400">*</span></label>
              <input type="password" placeholder="Min. 8 karakter" class="input">
            </div>
            <div>
              <label class="section-label block mb-1.5">Konfirmasi Password <span class="text-red-400">*</span></label>
              <input type="password" placeholder="Ulangi password" class="input">
            </div>
          </div>
          <div class="grid grid-cols-2 gap-4">
            <div>
              <label class="section-label block mb-1.5">Role <span class="text-red-400">*</span></label>
              <select class="input">
                <option value="">-- Pilih Role --</option>
                <option>Admin</option>
                <option>Petugas</option>
                <option>User</option>
              </select>
            </div>
            <div>
              <label class="section-label block mb-1.5">Status</label>
              <select class="input">
                <option>Aktif</option>
                <option>Nonaktif</option>
              </select>
            </div>
          </div>
          <div>
            <label class="section-label block mb-1.5">No. Telepon</label>
            <input type="text" placeholder="08xx-xxxx-xxxx" class="input">
          </div>
          <div>
            <label class="section-label block mb-1.5">Keterangan</label>
            <textarea rows="3" placeholder="Catatan tambahan..." class="input resize-none"></textarea>
          </div>
          <div class="flex gap-3 pt-2">
            <button class="btn btn-primary">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
              Simpan User
            </button>
            <button class="btn btn-secondary" onclick="goTo('kelola-user')">Batal</button>
          </div>
        </div>
      </div>
    </div>

    <!-- ========== KELOLA KATEGORI ========== -->
    <div id="page-kelola-kategori" class="page animate-fade-in">
      <div class="flex items-center justify-between mb-6">
        <div>
          <h1 class="text-2xl font-bold text-sage-800 tracking-tight">Kelola Kategori</h1>
          <p class="text-sm text-sage-300 mt-0.5">Manajemen kategori utama sistem</p>
        </div>
        <button class="btn btn-primary" onclick="openModal('modal-tambah-kategori')">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
          Tambah Kategori
        </button>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
        <div class="card p-5 flex items-center justify-between group hover:shadow-md hover:shadow-sage-100 transition-all">
          <div class="flex items-center gap-3.5">
            <div class="w-10 h-10 bg-sage-100 rounded-xl flex items-center justify-center"><svg class="w-5 h-5 text-sage-500" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M14.7 6.3a1 1 0 000 1.4l1.6 1.6a1 1 0 001.4 0l3.77-3.77a6 6 0 01-7.94 7.94l-6.91 6.91a2.12 2.12 0 01-3-3l6.91-6.91a6 6 0 017.94-7.94l-3.76 3.76z"/></svg></div>
            <div><div class="text-sm font-semibold text-sage-800">Alat Listrik</div><div class="text-xs text-sage-300 mt-0.5">24 item</div></div>
          </div>
          <div class="flex gap-1.5 opacity-0 group-hover:opacity-100 transition-opacity">
            <button class="btn btn-secondary btn-sm">Edit</button>
            <button class="btn btn-danger btn-sm">Hapus</button>
          </div>
        </div>
        <div class="card p-5 flex items-center justify-between group hover:shadow-md hover:shadow-sage-100 transition-all">
          <div class="flex items-center gap-3.5">
            <div class="w-10 h-10 bg-sage-100 rounded-xl flex items-center justify-center"><svg class="w-5 h-5 text-sage-500" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/></svg></div>
            <div><div class="text-sm font-semibold text-sage-800">Alat Pertukangan</div><div class="text-xs text-sage-300 mt-0.5">38 item</div></div>
          </div>
          <div class="flex gap-1.5 opacity-0 group-hover:opacity-100 transition-opacity">
            <button class="btn btn-secondary btn-sm">Edit</button>
            <button class="btn btn-danger btn-sm">Hapus</button>
          </div>
        </div>
        <div class="card p-5 flex items-center justify-between group hover:shadow-md hover:shadow-sage-100 transition-all">
          <div class="flex items-center gap-3.5">
            <div class="w-10 h-10 bg-sage-100 rounded-xl flex items-center justify-center"><svg class="w-5 h-5 text-sage-500" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg></div>
            <div><div class="text-sm font-semibold text-sage-800">Alat Ukur</div><div class="text-xs text-sage-300 mt-0.5">17 item</div></div>
          </div>
          <div class="flex gap-1.5 opacity-0 group-hover:opacity-100 transition-opacity">
            <button class="btn btn-secondary btn-sm">Edit</button>
            <button class="btn btn-danger btn-sm">Hapus</button>
          </div>
        </div>
        <div class="card p-5 flex items-center justify-between group hover:shadow-md hover:shadow-sage-100 transition-all">
          <div class="flex items-center gap-3.5">
            <div class="w-10 h-10 bg-sage-100 rounded-xl flex items-center justify-center"><svg class="w-5 h-5 text-sage-500" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
            <div><div class="text-sm font-semibold text-sage-800">Alat Keselamatan</div><div class="text-xs text-sage-300 mt-0.5">12 item</div></div>
          </div>
          <div class="flex gap-1.5 opacity-0 group-hover:opacity-100 transition-opacity">
            <button class="btn btn-secondary btn-sm">Edit</button>
            <button class="btn btn-danger btn-sm">Hapus</button>
          </div>
        </div>
      </div>
    </div>

    <!-- ========== KATEGORI ALAT ========== -->
    <div id="page-kategori-alat" class="page animate-fade-in">
      <div class="flex items-center justify-between mb-6">
        <div>
          <h1 class="text-2xl font-bold text-sage-800 tracking-tight">Kategori Alat</h1>
          <p class="text-sm text-sage-300 mt-0.5">Daftar seluruh alat berdasarkan kategori</p>
        </div>
        <button class="btn btn-primary" onclick="openModal('modal-tambah-alat')">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
          Tambah Alat
        </button>
      </div>

      <div class="card p-4 mb-5 flex flex-wrap gap-3">
        <input type="text" placeholder="Cari nama alat..." class="input w-56">
        <select class="input w-44"><option>Semua Kategori</option><option>Alat Listrik</option><option>Alat Pertukangan</option><option>Alat Ukur</option><option>Alat Keselamatan</option></select>
        <select class="input w-36"><option>Semua Status</option><option>Tersedia</option><option>Dipinjam</option><option>Rusak</option></select>
        <button class="btn btn-secondary">Cari</button>
      </div>

      <div class="card overflow-hidden">
        <table>
          <thead><tr><th>#</th><th>Nama Alat</th><th>Kode</th><th>Kategori</th><th>Stok</th><th>Dipinjam</th><th>Status</th><th>Aksi</th></tr></thead>
          <tbody>
            <tr><td class="mono text-sage-300">001</td><td class="font-medium">Bor Listrik</td><td class="mono text-sage-400 text-xs">BOR-001</td><td><span class="tag bg-purple-100 text-purple-600">Alat Listrik</span></td><td class="font-bold text-sage-700">10</td><td class="text-yellow-600 font-bold">3</td><td><span class="tag bg-sage-100 text-sage-600">Tersedia</span></td><td><div class="flex gap-1.5"><button class="btn btn-secondary btn-sm">Edit</button><button class="btn btn-danger btn-sm">Hapus</button></div></td></tr>
            <tr><td class="mono text-sage-300">002</td><td class="font-medium">Tang Kombinasi</td><td class="mono text-sage-400 text-xs">TNG-001</td><td><span class="tag bg-orange-100 text-orange-600">Alat Pertukangan</span></td><td class="font-bold text-sage-700">15</td><td class="text-yellow-600 font-bold">5</td><td><span class="tag bg-sage-100 text-sage-600">Tersedia</span></td><td><div class="flex gap-1.5"><button class="btn btn-secondary btn-sm">Edit</button><button class="btn btn-danger btn-sm">Hapus</button></div></td></tr>
            <tr><td class="mono text-sage-300">003</td><td class="font-medium">Multimeter Digital</td><td class="mono text-sage-400 text-xs">MLT-001</td><td><span class="tag bg-blue-100 text-blue-600">Alat Ukur</span></td><td class="font-bold text-sage-700">6</td><td class="text-yellow-600 font-bold">6</td><td><span class="tag bg-red-100 text-red-600">Habis</span></td><td><div class="flex gap-1.5"><button class="btn btn-secondary btn-sm">Edit</button><button class="btn btn-danger btn-sm">Hapus</button></div></td></tr>
            <tr><td class="mono text-sage-300">004</td><td class="font-medium">Helm Safety</td><td class="mono text-sage-400 text-xs">HLM-001</td><td><span class="tag bg-green-100 text-green-600">Alat Keselamatan</span></td><td class="font-bold text-sage-700">20</td><td class="text-yellow-600 font-bold">2</td><td><span class="tag bg-sage-100 text-sage-600">Tersedia</span></td><td><div class="flex gap-1.5"><button class="btn btn-secondary btn-sm">Edit</button><button class="btn btn-danger btn-sm">Hapus</button></div></td></tr>
            <tr><td class="mono text-sage-300">005</td><td class="font-medium">Gergaji Jigsaw</td><td class="mono text-sage-400 text-xs">GRG-002</td><td><span class="tag bg-purple-100 text-purple-600">Alat Listrik</span></td><td class="font-bold text-sage-700">4</td><td class="text-yellow-600 font-bold">1</td><td><span class="tag bg-yellow-100 text-yellow-600">Perawatan</span></td><td><div class="flex gap-1.5"><button class="btn btn-secondary btn-sm">Edit</button><button class="btn btn-danger btn-sm">Hapus</button></div></td></tr>
          </tbody>
        </table>
        <div class="flex items-center justify-between px-5 py-3 border-t border-sage-100">
          <span class="text-xs text-sage-300">Menampilkan 5 dari 248 alat</span>
          <div class="flex gap-1.5">
            <button class="btn btn-secondary btn-sm px-3">‹</button>
            <button class="btn btn-primary btn-sm px-3">1</button>
            <button class="btn btn-secondary btn-sm px-3">2</button>
            <button class="btn btn-secondary btn-sm px-3">3</button>
            <button class="btn btn-secondary btn-sm px-3">›</button>
          </div>
        </div>
      </div>
    </div>

    <!-- ========== ALAT MASUK ========== -->
    <div id="page-alat-masuk" class="page animate-fade-in">
      <div class="flex items-center justify-between mb-6">
        <div>
          <h1 class="text-2xl font-bold text-sage-800 tracking-tight">Alat Masuk</h1>
          <p class="text-sm text-sage-300 mt-0.5">Pencatatan penerimaan alat baru ke gudang</p>
        </div>
        <button class="btn btn-primary" onclick="openModal('modal-alat-masuk')">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
          Catat Alat Masuk
        </button>
      </div>
      <div class="card overflow-hidden">
        <div class="flex items-center justify-between px-5 py-4 border-b border-sage-100 flex-wrap gap-3">
          <div class="flex gap-3">
            <input type="text" placeholder="Cari nama alat..." class="input w-52">
            <input type="date" class="input w-40">
          </div>
          <button class="btn btn-secondary">Export Excel</button>
        </div>
        <table>
          <thead><tr><th>No. Terima</th><th>Nama Alat</th><th>Kode</th><th>Kategori</th><th>Jumlah</th><th>Kondisi</th><th>Tgl Masuk</th><th>Petugas</th></tr></thead>
          <tbody>
            <tr><td class="mono text-sage-400 text-xs">MAS-20260407-001</td><td class="font-medium">Bor Listrik Type B</td><td class="mono text-xs text-sage-400">BOR-005</td><td><span class="tag bg-purple-100 text-purple-600">Alat Listrik</span></td><td class="font-bold text-sage-700">5</td><td><span class="tag bg-sage-100 text-sage-600">Baik</span></td><td class="mono text-xs text-sage-400">07/04/2026</td><td>Budi S.</td></tr>
            <tr><td class="mono text-sage-400 text-xs">MAS-20260406-003</td><td class="font-medium">Gergaji Jigsaw</td><td class="mono text-xs text-sage-400">GRG-002</td><td><span class="tag bg-purple-100 text-purple-600">Alat Listrik</span></td><td class="font-bold text-sage-700">2</td><td><span class="tag bg-yellow-100 text-yellow-600">Bekas</span></td><td class="mono text-xs text-sage-400">06/04/2026</td><td>Sari R.</td></tr>
            <tr><td class="mono text-sage-400 text-xs">MAS-20260405-002</td><td class="font-medium">Helm Safety Merah</td><td class="mono text-xs text-sage-400">HLM-003</td><td><span class="tag bg-green-100 text-green-600">Keselamatan</span></td><td class="font-bold text-sage-700">10</td><td><span class="tag bg-sage-100 text-sage-600">Baik</span></td><td class="mono text-xs text-sage-400">05/04/2026</td><td>Budi S.</td></tr>
            <tr><td class="mono text-sage-400 text-xs">MAS-20260404-001</td><td class="font-medium">Obeng Set 30pc</td><td class="mono text-xs text-sage-400">OBN-004</td><td><span class="tag bg-orange-100 text-orange-600">Pertukangan</span></td><td class="font-bold text-sage-700">3</td><td><span class="tag bg-sage-100 text-sage-600">Baik</span></td><td class="mono text-xs text-sage-400">04/04/2026</td><td>Andi W.</td></tr>
          </tbody>
        </table>
        <div class="flex items-center justify-between px-5 py-3 border-t border-sage-100">
          <span class="text-xs text-sage-300">4 transaksi masuk</span>
          <div class="flex gap-1.5"><button class="btn btn-secondary btn-sm px-3">‹</button><button class="btn btn-primary btn-sm px-3">1</button><button class="btn btn-secondary btn-sm px-3">›</button></div>
        </div>
      </div>
    </div>

    <!-- ========== PEMINJAMAN ========== -->
    <div id="page-peminjaman" class="page animate-fade-in">
      <div class="flex items-center justify-between mb-6">
        <div>
          <h1 class="text-2xl font-bold text-sage-800 tracking-tight">Peminjaman</h1>
          <p class="text-sm text-sage-300 mt-0.5">Daftar seluruh transaksi peminjaman alat</p>
        </div>
        <button class="btn btn-primary" onclick="openModal('modal-pinjam')">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
          Buat Peminjaman
        </button>
      </div>

      <!-- Summary mini -->
      <div class="grid grid-cols-3 gap-4 mb-6">
        <div class="card p-4 flex items-center gap-3">
          <div class="w-10 h-10 bg-yellow-50 rounded-xl flex items-center justify-center flex-shrink-0"><svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/></svg></div>
          <div><div class="text-xl font-bold text-sage-800">37</div><div class="text-xs text-sage-300">Sedang dipinjam</div></div>
        </div>
        <div class="card p-4 flex items-center gap-3">
          <div class="w-10 h-10 bg-red-50 rounded-xl flex items-center justify-center flex-shrink-0"><svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg></div>
          <div><div class="text-xl font-bold text-red-600">5</div><div class="text-xs text-sage-300">Terlambat kembali</div></div>
        </div>
        <div class="card p-4 flex items-center gap-3">
          <div class="w-10 h-10 bg-sage-100 rounded-xl flex items-center justify-center flex-shrink-0"><svg class="w-5 h-5 text-sage-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg></div>
          <div><div class="text-xl font-bold text-sage-800">120</div><div class="text-xs text-sage-300">Selesai bulan ini</div></div>
        </div>
      </div>

      <div class="card overflow-hidden">
        <div class="flex items-center justify-between px-5 py-4 border-b border-sage-100 flex-wrap gap-3">
          <div class="flex gap-3 flex-wrap">
            <input type="text" placeholder="Cari peminjam..." class="input w-48">
            <select class="input w-36"><option>Semua Status</option><option>Aktif</option><option>Terlambat</option><option>Selesai</option></select>
          </div>
          <button class="btn btn-secondary">Export</button>
        </div>
        <table>
          <thead><tr><th>No. Pinjam</th><th>Peminjam</th><th>Alat</th><th>Tgl Pinjam</th><th>Tenggat</th><th>Status</th><th>Aksi</th></tr></thead>
          <tbody>
            <tr><td class="mono text-xs text-sage-400">PJM-20260407-001</td><td class="font-medium">Rino Saputra</td><td>Bor Listrik #3</td><td class="mono text-xs text-sage-400">05/04/2026</td><td class="mono text-xs text-sage-400">10/04/2026</td><td><span class="tag bg-yellow-100 text-yellow-700">Aktif</span></td><td><div class="flex gap-1.5"><button class="btn btn-secondary btn-sm">Detail</button><button class="btn btn-primary btn-sm" onclick="openModal('modal-konfirm-kembali')">Kembalikan</button></div></td></tr>
            <tr><td class="mono text-xs text-sage-400">PJM-20260406-004</td><td class="font-medium">Siti Rahayu</td><td>Tang Kombinasi</td><td class="mono text-xs text-sage-400">04/04/2026</td><td class="mono text-xs text-sage-400">08/04/2026</td><td><span class="tag bg-red-100 text-red-600">Terlambat</span></td><td><div class="flex gap-1.5"><button class="btn btn-secondary btn-sm">Detail</button><button class="btn btn-primary btn-sm" onclick="openModal('modal-konfirm-kembali')">Kembalikan</button></div></td></tr>
            <tr><td class="mono text-xs text-sage-400">PJM-20260405-002</td><td class="font-medium">Andi Wijaya</td><td>Multimeter Digital</td><td class="mono text-xs text-sage-400">06/04/2026</td><td class="mono text-xs text-sage-400">12/04/2026</td><td><span class="tag bg-yellow-100 text-yellow-700">Aktif</span></td><td><div class="flex gap-1.5"><button class="btn btn-secondary btn-sm">Detail</button><button class="btn btn-primary btn-sm" onclick="openModal('modal-konfirm-kembali')">Kembalikan</button></div></td></tr>
            <tr><td class="mono text-xs text-sage-400">PJM-20260401-010</td><td class="font-medium">Dian Pratama</td><td>Obeng Set Lengkap</td><td class="mono text-xs text-sage-400">01/04/2026</td><td class="mono text-xs text-sage-400">05/04/2026</td><td><span class="tag bg-sage-100 text-sage-600">Selesai</span></td><td><div class="flex gap-1.5"><button class="btn btn-secondary btn-sm">Detail</button></div></td></tr>
          </tbody>
        </table>
        <div class="flex items-center justify-between px-5 py-3 border-t border-sage-100">
          <span class="text-xs text-sage-300">Menampilkan 4 dari 157 transaksi</span>
          <div class="flex gap-1.5"><button class="btn btn-secondary btn-sm px-3">‹</button><button class="btn btn-primary btn-sm px-3">1</button><button class="btn btn-secondary btn-sm px-3">2</button><button class="btn btn-secondary btn-sm px-3">›</button></div>
        </div>
      </div>
    </div>

    <!-- ========== PENGEMBALIAN ========== -->
    <div id="page-pengembalian" class="page animate-fade-in">
      <div class="flex items-center justify-between mb-6">
        <div>
          <h1 class="text-2xl font-bold text-sage-800 tracking-tight">Pengembalian</h1>
          <p class="text-sm text-sage-300 mt-0.5">Proses penerimaan alat yang dikembalikan</p>
        </div>
        <button class="btn btn-primary" onclick="openModal('modal-konfirm-kembali')">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 102.13-9.36L1 10"/></svg>
          Proses Pengembalian
        </button>
      </div>
      <div class="card overflow-hidden">
        <table>
          <thead><tr><th>No. Kembali</th><th>Peminjam</th><th>Alat</th><th>Tgl Kembali</th><th>Tgl Tenggat</th><th>Kondisi</th><th>Denda</th><th>Status</th></tr></thead>
          <tbody>
            <tr><td class="mono text-xs text-sage-400">KBL-20260407-003</td><td class="font-medium">Dian Pratama</td><td>Tang Set</td><td class="mono text-xs text-sage-400">07/04/2026</td><td class="mono text-xs text-sage-400">07/04/2026</td><td><span class="tag bg-sage-100 text-sage-600">Baik</span></td><td class="font-bold text-sage-700">Rp 0</td><td><span class="tag bg-sage-100 text-sage-600">Tepat Waktu</span></td></tr>
            <tr><td class="mono text-xs text-sage-400">KBL-20260406-002</td><td class="font-medium">Lina Marlina</td><td>Obeng Set</td><td class="mono text-xs text-sage-400">06/04/2026</td><td class="mono text-xs text-sage-400">05/04/2026</td><td><span class="tag bg-yellow-100 text-yellow-600">Lecet</span></td><td class="font-bold text-red-500">Rp 5.000</td><td><span class="tag bg-red-100 text-red-600">Terlambat 1hr</span></td></tr>
            <tr><td class="mono text-xs text-sage-400">KBL-20260405-001</td><td class="font-medium">Riko Hendra</td><td>Bor Listrik #2</td><td class="mono text-xs text-sage-400">05/04/2026</td><td class="mono text-xs text-sage-400">05/04/2026</td><td><span class="tag bg-sage-100 text-sage-600">Baik</span></td><td class="font-bold text-sage-700">Rp 0</td><td><span class="tag bg-sage-100 text-sage-600">Tepat Waktu</span></td></tr>
          </tbody>
        </table>
        <div class="flex items-center justify-between px-5 py-3 border-t border-sage-100">
          <span class="text-xs text-sage-300">3 pengembalian hari ini</span>
          <div class="flex gap-1.5"><button class="btn btn-secondary btn-sm px-3">‹</button><button class="btn btn-primary btn-sm px-3">1</button><button class="btn btn-secondary btn-sm px-3">›</button></div>
        </div>
      </div>
    </div>

    <!-- ========== LOG AKTIVITAS ========== -->
    <div id="page-log-aktivitas" class="page animate-fade-in">
      <div class="flex items-center justify-between mb-6">
        <div>
          <h1 class="text-2xl font-bold text-sage-800 tracking-tight">Log Aktivitas</h1>
          <p class="text-sm text-sage-300 mt-0.5">Rekam jejak seluruh aktivitas sistem</p>
        </div>
        <button class="btn btn-secondary">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
          Export Log
        </button>
      </div>

      <div class="card p-4 mb-5 flex flex-wrap gap-3">
        <input type="text" placeholder="Cari aktivitas..." class="input w-52">
        <select class="input w-40"><option>Semua Tipe</option><option>Login</option><option>Peminjaman</option><option>Pengembalian</option><option>Alat Masuk</option><option>User</option></select>
        <input type="date" class="input w-36">
        <button class="btn btn-secondary">Filter</button>
      </div>

      <div class="card overflow-hidden">
        <table>
          <thead><tr><th>Waktu</th><th>User</th><th>Role</th><th>Aktivitas</th><th>Detail</th><th>IP</th></tr></thead>
          <tbody>
            <tr>
              <td class="mono text-xs text-sage-400 whitespace-nowrap">07/04 09:15</td>
              <td class="font-medium">Super Admin</td>
              <td><span class="tag bg-red-100 text-red-600">Admin</span></td>
              <td><span class="tag bg-blue-100 text-blue-600">Tambah User</span></td>
              <td class="text-sage-500 text-xs">Menambah user: Rina Cahyani</td>
              <td class="mono text-xs text-sage-300">192.168.1.1</td>
            </tr>
            <tr>
              <td class="mono text-xs text-sage-400 whitespace-nowrap">07/04 08:55</td>
              <td class="font-medium">Budi Santoso</td>
              <td><span class="tag bg-sage-100 text-sage-600">Petugas</span></td>
              <td><span class="tag bg-yellow-100 text-yellow-700">Peminjaman</span></td>
              <td class="text-sage-500 text-xs">Bor Listrik #5 → Rino Saputra</td>
              <td class="mono text-xs text-sage-300">192.168.1.2</td>
            </tr>
            <tr>
              <td class="mono text-xs text-sage-400 whitespace-nowrap">07/04 08:30</td>
              <td class="font-medium">Budi Santoso</td>
              <td><span class="tag bg-sage-100 text-sage-600">Petugas</span></td>
              <td><span class="tag bg-sage-100 text-sage-600">Alat Masuk</span></td>
              <td class="text-sage-500 text-xs">5x Bor Listrik Type B</td>
              <td class="mono text-xs text-sage-300">192.168.1.2</td>
            </tr>
            <tr>
              <td class="mono text-xs text-sage-400 whitespace-nowrap">06/04 16:45</td>
              <td class="font-medium">Sari Rahmawati</td>
              <td><span class="tag bg-blue-100 text-blue-600">User</span></td>
              <td><span class="tag bg-gray-100 text-gray-600">Login</span></td>
              <td class="text-sage-500 text-xs">Login berhasil</td>
              <td class="mono text-xs text-sage-300">192.168.1.5</td>
            </tr>
            <tr>
              <td class="mono text-xs text-sage-400 whitespace-nowrap">06/04 15:20</td>
              <td class="font-medium">Budi Santoso</td>
              <td><span class="tag bg-sage-100 text-sage-600">Petugas</span></td>
              <td><span class="tag bg-blue-100 text-blue-600">Pengembalian</span></td>
              <td class="text-sage-500 text-xs">Tang Set ← Dian Pratama</td>
              <td class="mono text-xs text-sage-300">192.168.1.2</td>
            </tr>
            <tr>
              <td class="mono text-xs text-sage-400 whitespace-nowrap">06/04 10:00</td>
              <td class="font-medium">Super Admin</td>
              <td><span class="tag bg-red-100 text-red-600">Admin</span></td>
              <td><span class="tag bg-green-100 text-green-600">Tambah Kategori</span></td>
              <td class="text-sage-500 text-xs">Kategori: Alat Keselamatan</td>
              <td class="mono text-xs text-sage-300">192.168.1.1</td>
            </tr>
          </tbody>
        </table>
        <div class="flex items-center justify-between px-5 py-3 border-t border-sage-100">
          <span class="text-xs text-sage-300">Menampilkan 6 dari 342 log</span>
          <div class="flex gap-1.5"><button class="btn btn-secondary btn-sm px-3">‹</button><button class="btn btn-primary btn-sm px-3">1</button><button class="btn btn-secondary btn-sm px-3">2</button><button class="btn btn-secondary btn-sm px-3">›</button></div>
        </div>
      </div>
    </div>

  </div><!-- end p-7 -->
</div><!-- end main -->


<!-- ===================== MODALS ===================== -->

<!-- Modal Tambah Kategori -->
<div id="modal-tambah-kategori" class="modal-bg" onclick="closeModalBg(event,'modal-tambah-kategori')">
  <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-6 animate-fade-in m-4">
    <div class="flex items-center justify-between mb-5">
      <h3 class="text-base font-bold text-sage-800">Tambah Kategori</h3>
      <button class="text-sage-300 hover:text-sage-600 transition-colors" onclick="closeModal('modal-tambah-kategori')"><svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
    </div>
    <div class="space-y-4">
      <div><label class="section-label block mb-1.5">Nama Kategori <span class="text-red-400">*</span></label><input type="text" placeholder="Contoh: Alat Listrik" class="input"></div>
      <div><label class="section-label block mb-1.5">Deskripsi</label><textarea rows="3" placeholder="Deskripsi singkat..." class="input resize-none"></textarea></div>
    </div>
    <div class="flex gap-3 mt-5"><button class="btn btn-primary flex-1">Simpan</button><button class="btn btn-secondary" onclick="closeModal('modal-tambah-kategori')">Batal</button></div>
  </div>
</div>

<!-- Modal Tambah Alat -->
<div id="modal-tambah-alat" class="modal-bg" onclick="closeModalBg(event,'modal-tambah-alat')">
  <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg p-6 animate-fade-in m-4 max-h-[90vh] overflow-y-auto">
    <div class="flex items-center justify-between mb-5">
      <h3 class="text-base font-bold text-sage-800">Tambah Alat Baru</h3>
      <button class="text-sage-300 hover:text-sage-600 transition-colors" onclick="closeModal('modal-tambah-alat')"><svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
    </div>
    <div class="space-y-4">
      <div class="grid grid-cols-2 gap-3">
        <div><label class="section-label block mb-1.5">Nama Alat *</label><input type="text" placeholder="Nama alat" class="input"></div>
        <div><label class="section-label block mb-1.5">Kode Alat *</label><input type="text" placeholder="BOR-001" class="input mono"></div>
      </div>
      <div><label class="section-label block mb-1.5">Kategori *</label><select class="input"><option>-- Pilih Kategori --</option><option>Alat Listrik</option><option>Alat Pertukangan</option><option>Alat Ukur</option><option>Alat Keselamatan</option></select></div>
      <div class="grid grid-cols-2 gap-3">
        <div><label class="section-label block mb-1.5">Jumlah Stok *</label><input type="number" placeholder="0" class="input"></div>
        <div><label class="section-label block mb-1.5">Kondisi</label><select class="input"><option>Baik</option><option>Bekas</option><option>Perawatan</option></select></div>
      </div>
      <div><label class="section-label block mb-1.5">Keterangan</label><textarea rows="2" placeholder="Catatan tambahan..." class="input resize-none"></textarea></div>
    </div>
    <div class="flex gap-3 mt-5"><button class="btn btn-primary flex-1">Simpan Alat</button><button class="btn btn-secondary" onclick="closeModal('modal-tambah-alat')">Batal</button></div>
  </div>
</div>

<!-- Modal Alat Masuk -->
<div id="modal-alat-masuk" class="modal-bg" onclick="closeModalBg(event,'modal-alat-masuk')">
  <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg p-6 animate-fade-in m-4">
    <div class="flex items-center justify-between mb-5">
      <h3 class="text-base font-bold text-sage-800">Catat Alat Masuk</h3>
      <button class="text-sage-300 hover:text-sage-600 transition-colors" onclick="closeModal('modal-alat-masuk')"><svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
    </div>
    <div class="space-y-4">
      <div><label class="section-label block mb-1.5">Pilih Alat *</label><select class="input"><option>-- Pilih Alat --</option><option>Bor Listrik</option><option>Tang Kombinasi</option><option>Multimeter</option><option>Helm Safety</option></select></div>
      <div class="grid grid-cols-2 gap-3">
        <div><label class="section-label block mb-1.5">Jumlah *</label><input type="number" placeholder="0" min="1" class="input"></div>
        <div><label class="section-label block mb-1.5">Kondisi</label><select class="input"><option>Baik</option><option>Bekas</option></select></div>
      </div>
      <div><label class="section-label block mb-1.5">Tanggal Masuk</label><input type="date" class="input"></div>
      <div><label class="section-label block mb-1.5">Catatan</label><textarea rows="2" placeholder="Asal pengadaan, dll..." class="input resize-none"></textarea></div>
    </div>
    <div class="flex gap-3 mt-5"><button class="btn btn-primary flex-1">Simpan</button><button class="btn btn-secondary" onclick="closeModal('modal-alat-masuk')">Batal</button></div>
  </div>
</div>

<!-- Modal Buat Peminjaman -->
<div id="modal-pinjam" class="modal-bg" onclick="closeModalBg(event,'modal-pinjam')">
  <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg p-6 animate-fade-in m-4">
    <div class="flex items-center justify-between mb-5">
      <h3 class="text-base font-bold text-sage-800">Buat Peminjaman Baru</h3>
      <button class="text-sage-300 hover:text-sage-600 transition-colors" onclick="closeModal('modal-pinjam')"><svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
    </div>
    <div class="space-y-4">
      <div><label class="section-label block mb-1.5">Peminjam *</label><select class="input"><option>-- Pilih User --</option><option>Rino Saputra</option><option>Siti Rahayu</option><option>Andi Wijaya</option><option>Lina Marlina</option></select></div>
      <div><label class="section-label block mb-1.5">Pilih Alat *</label><select class="input"><option>-- Pilih Alat --</option><option>Bor Listrik #1</option><option>Tang Kombinasi</option><option>Multimeter</option><option>Obeng Set</option></select></div>
      <div><label class="section-label block mb-1.5">Jumlah *</label><input type="number" min="1" value="1" class="input"></div>
      <div class="grid grid-cols-2 gap-3">
        <div><label class="section-label block mb-1.5">Tgl Pinjam *</label><input type="date" class="input"></div>
        <div><label class="section-label block mb-1.5">Tgl Tenggat *</label><input type="date" class="input"></div>
      </div>
      <div><label class="section-label block mb-1.5">Keperluan</label><textarea rows="2" placeholder="Untuk keperluan apa?" class="input resize-none"></textarea></div>
    </div>
    <div class="flex gap-3 mt-5"><button class="btn btn-primary flex-1">Buat Peminjaman</button><button class="btn btn-secondary" onclick="closeModal('modal-pinjam')">Batal</button></div>
  </div>
</div>

<!-- Modal Konfirm Pengembalian -->
<div id="modal-konfirm-kembali" class="modal-bg" onclick="closeModalBg(event,'modal-konfirm-kembali')">
  <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-6 animate-fade-in m-4">
    <div class="flex items-center justify-between mb-5">
      <h3 class="text-base font-bold text-sage-800">Konfirmasi Pengembalian</h3>
      <button class="text-sage-300 hover:text-sage-600 transition-colors" onclick="closeModal('modal-konfirm-kembali')"><svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
    </div>
    <div class="bg-sage-50 border border-sage-100 rounded-xl p-4 mb-4 space-y-2">
      <div class="flex justify-between text-sm"><span class="text-sage-400">Peminjam</span><span class="font-semibold text-sage-800">Rino Saputra</span></div>
      <div class="flex justify-between text-sm"><span class="text-sage-400">Alat</span><span class="font-semibold text-sage-800">Bor Listrik #3</span></div>
      <div class="flex justify-between text-sm"><span class="text-sage-400">Tenggat</span><span class="font-semibold text-sage-800">10/04/2026</span></div>
    </div>
    <div class="space-y-4">
      <div><label class="section-label block mb-1.5">Kondisi Alat Saat Kembali *</label><select class="input"><option>Baik</option><option>Lecet / Sedikit Rusak</option><option>Rusak Parah</option></select></div>
      <div><label class="section-label block mb-1.5">Tgl Pengembalian</label><input type="date" class="input"></div>
      <div><label class="section-label block mb-1.5">Catatan</label><textarea rows="2" placeholder="Catatan kondisi alat..." class="input resize-none"></textarea></div>
    </div>
    <div class="flex gap-3 mt-5"><button class="btn btn-primary flex-1">Konfirmasi Kembali</button><button class="btn btn-secondary" onclick="closeModal('modal-konfirm-kembali')">Batal</button></div>
  </div>
</div>


<script>
// Navigation
function goTo(pageId) {
  document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
  document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));

  const page = document.getElementById('page-' + pageId);
  if (page) page.classList.add('active');

  // highlight nav
  document.querySelectorAll('.nav-item').forEach(n => {
    if (n.getAttribute('onclick') && n.getAttribute('onclick').includes("'" + pageId + "'")) {
      n.classList.add('active');
    }
  });

  // titles
  const titles = {
    'dashboard':'Dashboard','kelola-user':'Kelola User','tambah-user':'Tambah User',
    'kelola-kategori':'Kelola Kategori','kategori-alat':'Kategori Alat',
    'alat-masuk':'Alat Masuk','peminjaman':'Peminjaman',
    'pengembalian':'Pengembalian','log-aktivitas':'Log Aktivitas'
  };
  document.getElementById('topbar-title').textContent = titles[pageId] || 'Dashboard';
  window.scrollTo(0,0);
}

// Sub-group toggle
function toggleGroup(id) {
  const el = document.getElementById(id);
  const arr = document.getElementById('arr-' + id);
  const expanded = el.style.maxHeight !== '0px' && el.style.maxHeight !== '';
  el.style.maxHeight = expanded ? '0px' : el.scrollHeight + 'px';
  if (arr) arr.style.transform = expanded ? 'rotate(0deg)' : 'rotate(180deg)';
}

// Modal
function openModal(id) { document.getElementById(id).classList.add('open'); }
function closeModal(id) { document.getElementById(id).classList.remove('open'); }
function closeModalBg(e, id) { if (e.target === document.getElementById(id)) closeModal(id); }
</script>
</body>
</html>