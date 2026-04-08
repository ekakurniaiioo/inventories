<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>InvenTrack — Dashboard Petugas</title>
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
      keyframes: { fadeIn:{from:{opacity:'0',transform:'translateY(12px)'},to:{opacity:'1',transform:'translateY(0)'}} },
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
  .badge{display:inline-flex;align-items:center;justify-content:center;min-width:18px;height:18px;padding:0 5px;border-radius:99px;font-size:10px;font-weight:700;}
  .card{background:white;border:1px solid #D4E4DE;border-radius:16px;}
  .tag{display:inline-block;padding:2px 10px;border-radius:999px;font-size:11px;font-weight:700;}
  .btn{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;border-radius:10px;font-size:13px;font-weight:600;cursor:pointer;transition:all .18s;border:none;}
  .btn-primary{background:#1E2A26;color:white;}.btn-primary:hover{background:#3D8C6E;}
  .btn-secondary{background:#EEF2F0;color:#2E5C4A;border:1px solid #D4E4DE;}.btn-secondary:hover{border-color:#3D8C6E;color:#3D8C6E;}
  .btn-danger{background:#FEF2F2;color:#DC2626;border:1px solid #FECACA;}.btn-danger:hover{background:#DC2626;color:white;}
  .btn-success{background:#ECFDF5;color:#059669;border:1px solid #A7F3D0;}.btn-success:hover{background:#059669;color:white;}
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
<aside class="w-[220px] bg-sage-700 flex flex-col min-h-screen fixed left-0 top-0 bottom-0 z-40">

  <!-- Logo -->
  <div class="px-4 py-4 border-b border-white/10 flex items-center gap-2.5">
    <div class="w-8 h-8 bg-sage-400 rounded-lg flex items-center justify-center flex-shrink-0">
      <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/>
        <rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/>
      </svg>
    </div>
    <div>
      <div class="text-white font-bold text-sm tracking-tight leading-tight">Inven<span class="text-sage-300">Track</span></div>
      <div class="text-[10px] text-white/30 font-medium">Portal Petugas</div>
    </div>
  </div>

  <!-- Nav -->
  <div class="flex-1 overflow-y-auto px-2 py-3 space-y-0.5">

    <button class="nav-item active" onclick="goTo('dashboard')">
      <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
      Dashboard
    </button>

    <button class="nav-item" onclick="goTo('peminjaman')">
      <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
      Peminjaman
      <span class="badge bg-yellow-500/20 text-yellow-300 ml-auto">7</span>
    </button>

    <button class="nav-item" onclick="goTo('pengembalian')">
      <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 102.13-9.36L1 10"/></svg>
      Pengembalian
      <span class="badge bg-blue-500/20 text-blue-300 ml-auto">3</span>
    </button>

    <button class="nav-item" onclick="goTo('laporan')">
      <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
      Laporan
    </button>

  </div>

  <!-- Divider & Quick Info -->
  <div class="px-3 pb-2">
    <div class="bg-white/[0.06] border border-white/10 rounded-xl p-3">
      <p class="text-[10px] font-bold text-white/25 uppercase tracking-widest mb-2">Shift Hari Ini</p>
      <p class="text-xs font-semibold text-white/70">Senin, 7 Apr 2026</p>
      <p class="mono text-[11px] text-sage-300 mt-0.5">08:00 — 17:00 WIB</p>
      <div class="flex items-center gap-1.5 mt-2">
        <span class="w-1.5 h-1.5 rounded-full bg-sage-400 inline-block"></span>
        <span class="text-[11px] text-sage-300 font-medium">On Duty</span>
      </div>
    </div>
  </div>

  <!-- User -->
  <div class="px-3 py-3 border-t border-white/10">
    <div class="flex items-center gap-2.5 px-2">
      <div class="w-8 h-8 rounded-full bg-sage-400 flex items-center justify-center text-white text-xs font-bold flex-shrink-0">BS</div>
      <div class="flex-1 min-w-0">
        <div class="text-xs font-semibold text-white truncate">Budi Santoso</div>
        <div class="text-[10px] text-white/30 truncate">Petugas Gudang</div>
      </div>
      <a href="/login" title="Keluar" class="text-white/25 hover:text-red-400 transition-colors p-1 no-underline">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4M16 17l5-5-5-5M21 12H9"/></svg>
      </a>
    </div>
  </div>
</aside>

<!-- ===================== MAIN ===================== -->
<div class="ml-[220px] flex-1 min-h-screen">

  <!-- Topbar -->
  <header class="sticky top-0 z-30 bg-white/90 backdrop-blur border-b border-sage-100 px-7 py-3.5 flex items-center justify-between">
    <div id="topbar-title" class="text-sm font-bold text-sage-800 tracking-tight">Dashboard</div>
    <div class="flex items-center gap-3">
      <div class="relative">
        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-sage-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
        <input type="text" placeholder="Cari transaksi..." class="input w-44 pl-9 py-1.5 text-xs bg-sage-50">
      </div>
      <button class="relative p-2 bg-sage-50 border border-sage-100 rounded-xl hover:border-sage-300 transition-all">
        <svg class="w-4 h-4 text-sage-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 01-3.46 0"/></svg>
        <span class="absolute -top-1 -right-1 w-3.5 h-3.5 bg-yellow-400 text-white text-[8px] font-bold rounded-full flex items-center justify-center">3</span>
      </button>
      <div class="flex items-center gap-2 bg-sage-50 border border-sage-100 rounded-xl px-3 py-1.5">
        <div class="w-6 h-6 bg-sage-400 rounded-full flex items-center justify-center text-white text-[10px] font-bold">BS</div>
        <span class="text-xs font-semibold text-sage-700">Budi Santoso</span>
        <span class="tag bg-sage-100 text-sage-600">Petugas</span>
      </div>
    </div>
  </header>

  <div class="p-7">

    <!-- ========== DASHBOARD ========== -->
    <div id="page-dashboard" class="page active animate-fade-in">
      <div class="mb-6">
        <h1 class="text-2xl font-bold text-sage-800 tracking-tight">Dashboard Petugas</h1>
        <p class="text-sm text-sage-300 mt-0.5">Senin, 7 April 2026 — Selamat datang, Budi!</p>
      </div>

      <!-- Stat cards -->
      <div class="grid grid-cols-2 xl:grid-cols-4 gap-4 mb-7">
        <div class="card p-5">
          <div class="flex items-center justify-between mb-3">
            <span class="section-label">Peminjaman Aktif</span>
            <div class="w-9 h-9 bg-yellow-50 rounded-xl flex items-center justify-center">
              <svg class="w-4 h-4 text-yellow-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="1"/></svg>
            </div>
          </div>
          <div class="text-3xl font-bold text-yellow-600 tracking-tight">37</div>
          <div class="text-xs text-sage-300 mt-1.5 flex items-center gap-1"><span class="text-yellow-500 font-semibold">7 baru</span> hari ini</div>
        </div>
        <div class="card p-5">
          <div class="flex items-center justify-between mb-3">
            <span class="section-label">Terlambat Kembali</span>
            <div class="w-9 h-9 bg-red-50 rounded-xl flex items-center justify-center">
              <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            </div>
          </div>
          <div class="text-3xl font-bold text-red-600 tracking-tight">5</div>
          <div class="text-xs text-sage-300 mt-1.5">perlu ditindaklanjuti</div>
        </div>
        <div class="card p-5">
          <div class="flex items-center justify-between mb-3">
            <span class="section-label">Pengembalian Hari Ini</span>
            <div class="w-9 h-9 bg-blue-50 rounded-xl flex items-center justify-center">
              <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 102.13-9.36L1 10"/></svg>
            </div>
          </div>
          <div class="text-3xl font-bold text-blue-600 tracking-tight">3</div>
          <div class="text-xs text-sage-300 mt-1.5 flex items-center gap-1"><span class="text-blue-500 font-semibold">sudah diproses</span></div>
        </div>
        <div class="card p-5">
          <div class="flex items-center justify-between mb-3">
            <span class="section-label">Alat Tersedia</span>
            <div class="w-9 h-9 bg-sage-100 rounded-xl flex items-center justify-center">
              <svg class="w-4 h-4 text-sage-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            </div>
          </div>
          <div class="text-3xl font-bold text-sage-800 tracking-tight">211</div>
          <div class="text-xs text-sage-300 mt-1.5">dari 248 total alat</div>
        </div>
      </div>

      <!-- Main content -->
      <div class="grid grid-cols-1 xl:grid-cols-5 gap-6">

        <!-- Peminjaman menunggu aksi -->
        <div class="card overflow-hidden xl:col-span-3">
          <div class="flex items-center justify-between px-5 py-4 border-b border-sage-100">
            <div>
              <h3 class="text-sm font-semibold text-sage-800">Peminjaman Perlu Aksi</h3>
              <p class="text-xs text-sage-300 mt-0.5">Terlambat & jatuh tempo hari ini</p>
            </div>
            <button class="btn btn-secondary btn-sm" onclick="goTo('peminjaman')">Lihat semua</button>
          </div>
          <table>
            <thead><tr><th>Peminjam</th><th>Alat</th><th>Tenggat</th><th>Status</th><th>Aksi</th></tr></thead>
            <tbody>
              <tr>
                <td><div class="flex items-center gap-2.5"><div class="w-7 h-7 bg-red-100 rounded-full flex items-center justify-center text-red-600 text-[11px] font-bold">SR</div><span class="font-medium">Siti Rahayu</span></div></td>
                <td>Tang Kombinasi</td>
                <td class="mono text-xs text-red-500 font-bold">08/04/2026</td>
                <td><span class="tag bg-red-100 text-red-600">Terlambat</span></td>
                <td><button class="btn btn-primary btn-sm" onclick="openModal('modal-konfirm-kembali')">Proses</button></td>
              </tr>
              <tr>
                <td><div class="flex items-center gap-2.5"><div class="w-7 h-7 bg-red-100 rounded-full flex items-center justify-center text-red-600 text-[11px] font-bold">AK</div><span class="font-medium">Adi Kusuma</span></div></td>
                <td>Helm Safety</td>
                <td class="mono text-xs text-red-500 font-bold">06/04/2026</td>
                <td><span class="tag bg-red-100 text-red-600">Terlambat</span></td>
                <td><button class="btn btn-primary btn-sm" onclick="openModal('modal-konfirm-kembali')">Proses</button></td>
              </tr>
              <tr>
                <td><div class="flex items-center gap-2.5"><div class="w-7 h-7 bg-yellow-100 rounded-full flex items-center justify-center text-yellow-700 text-[11px] font-bold">LM</div><span class="font-medium">Lina Marlina</span></div></td>
                <td>Obeng Set Lengkap</td>
                <td class="mono text-xs text-yellow-600 font-bold">07/04/2026</td>
                <td><span class="tag bg-yellow-100 text-yellow-700">Jatuh Tempo</span></td>
                <td><button class="btn btn-success btn-sm" onclick="openModal('modal-konfirm-kembali')">Terima</button></td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Quick actions -->
        <div class="xl:col-span-2 space-y-4">
          <div class="card p-5">
            <h3 class="text-sm font-semibold text-sage-800 mb-4">Aksi Cepat</h3>
            <div class="space-y-2.5">
              <button onclick="openModal('modal-pinjam')" class="w-full btn btn-primary justify-start gap-3 py-3">
                <div class="w-7 h-7 bg-white/10 rounded-lg flex items-center justify-center flex-shrink-0">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                </div>
                <span>Buat Peminjaman Baru</span>
              </button>
              <button onclick="openModal('modal-konfirm-kembali')" class="w-full btn btn-secondary justify-start gap-3 py-3">
                <div class="w-7 h-7 bg-sage-100 rounded-lg flex items-center justify-center flex-shrink-0">
                  <svg class="w-4 h-4 text-sage-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 102.13-9.36L1 10"/></svg>
                </div>
                <span>Proses Pengembalian</span>
              </button>
              <button onclick="openModal('modal-scan')" class="w-full btn btn-secondary justify-start gap-3 py-3">
                <div class="w-7 h-7 bg-sage-100 rounded-lg flex items-center justify-center flex-shrink-0">
                  <svg class="w-4 h-4 text-sage-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="5" y="2" width="14" height="20" rx="2"/><path d="M12 18h.01"/></svg>
                </div>
                <span>Scan Barcode / QR</span>
              </button>
              <button onclick="goTo('laporan')" class="w-full btn btn-secondary justify-start gap-3 py-3">
                <div class="w-7 h-7 bg-sage-100 rounded-lg flex items-center justify-center flex-shrink-0">
                  <svg class="w-4 h-4 text-sage-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                </div>
                <span>Lihat Laporan</span>
              </button>
            </div>
          </div>

          <!-- Today summary -->
          <div class="card p-5">
            <h3 class="text-sm font-semibold text-sage-800 mb-3">Ringkasan Shift</h3>
            <div class="space-y-2.5">
              <div class="flex justify-between items-center text-sm">
                <span class="text-sage-400">Peminjaman diproses</span>
                <span class="font-bold text-sage-800">7</span>
              </div>
              <div class="flex justify-between items-center text-sm">
                <span class="text-sage-400">Pengembalian diterima</span>
                <span class="font-bold text-sage-800">3</span>
              </div>
              <div class="flex justify-between items-center text-sm">
                <span class="text-sage-400">Alat rusak dilaporkan</span>
                <span class="font-bold text-red-500">1</span>
              </div>
              <div class="flex justify-between items-center text-sm pt-2 border-t border-sage-100">
                <span class="text-sage-400">Total transaksi</span>
                <span class="font-bold text-sage-800">10</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- ========== PEMINJAMAN ========== -->
    <div id="page-peminjaman" class="page animate-fade-in">
      <div class="flex items-center justify-between mb-6">
        <div>
          <h1 class="text-2xl font-bold text-sage-800 tracking-tight">Peminjaman</h1>
          <p class="text-sm text-sage-300 mt-0.5">Kelola transaksi peminjaman alat</p>
        </div>
        <button class="btn btn-primary" onclick="openModal('modal-pinjam')">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
          Buat Peminjaman
        </button>
      </div>

      <!-- Summary -->
      <div class="grid grid-cols-3 gap-4 mb-6">
        <div class="card p-4 flex items-center gap-3">
          <div class="w-10 h-10 bg-yellow-50 rounded-xl flex items-center justify-center flex-shrink-0">
            <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/></svg>
          </div>
          <div><div class="text-xl font-bold text-sage-800">37</div><div class="text-xs text-sage-300">Sedang dipinjam</div></div>
        </div>
        <div class="card p-4 flex items-center gap-3">
          <div class="w-10 h-10 bg-red-50 rounded-xl flex items-center justify-center flex-shrink-0">
            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/></svg>
          </div>
          <div><div class="text-xl font-bold text-red-600">5</div><div class="text-xs text-sage-300">Terlambat</div></div>
        </div>
        <div class="card p-4 flex items-center gap-3">
          <div class="w-10 h-10 bg-sage-100 rounded-xl flex items-center justify-center flex-shrink-0">
            <svg class="w-5 h-5 text-sage-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
          </div>
          <div><div class="text-xl font-bold text-sage-800">120</div><div class="text-xs text-sage-300">Selesai bulan ini</div></div>
        </div>
      </div>

      <!-- Tabs -->
      <div class="flex gap-1 bg-white border border-sage-100 rounded-xl p-1 w-fit mb-5">
        <button onclick="filterStatus('semua')" id="tab-semua" class="px-4 py-2 rounded-lg text-xs font-semibold bg-sage-800 text-white transition-all">Semua</button>
        <button onclick="filterStatus('aktif')" id="tab-aktif" class="px-4 py-2 rounded-lg text-xs font-semibold text-sage-500 hover:bg-sage-50 transition-all">Aktif</button>
        <button onclick="filterStatus('terlambat')" id="tab-terlambat" class="px-4 py-2 rounded-lg text-xs font-semibold text-sage-500 hover:bg-sage-50 transition-all">Terlambat</button>
        <button onclick="filterStatus('selesai')" id="tab-selesai" class="px-4 py-2 rounded-lg text-xs font-semibold text-sage-500 hover:bg-sage-50 transition-all">Selesai</button>
      </div>

      <!-- Search -->
      <div class="card p-3.5 mb-4 flex gap-3 flex-wrap">
        <input type="text" placeholder="Cari nama peminjam atau kode alat..." class="input flex-1 min-w-0">
        <input type="date" class="input w-36">
        <button class="btn btn-secondary">Cari</button>
      </div>

      <div class="card overflow-hidden">
        <table>
          <thead><tr><th>No. Pinjam</th><th>Peminjam</th><th>Alat</th><th>Jumlah</th><th>Tgl Pinjam</th><th>Tenggat</th><th>Status</th><th>Aksi</th></tr></thead>
          <tbody>
            <tr>
              <td class="mono text-xs text-sage-400">PJM-20260407-007</td>
              <td><div class="flex items-center gap-2"><div class="w-6 h-6 bg-sage-100 rounded-full flex items-center justify-center text-sage-600 text-[10px] font-bold">RS</div><span class="font-medium">Rino Saputra</span></div></td>
              <td>Bor Listrik #3</td>
              <td class="font-bold text-sage-700">1</td>
              <td class="mono text-xs text-sage-400">05/04/2026</td>
              <td class="mono text-xs text-sage-400">10/04/2026</td>
              <td><span class="tag bg-yellow-100 text-yellow-700">Aktif</span></td>
              <td><div class="flex gap-1.5"><button class="btn btn-secondary btn-sm" onclick="openModal('modal-detail-pinjam')">Detail</button><button class="btn btn-primary btn-sm" onclick="openModal('modal-konfirm-kembali')">Kembalikan</button></div></td>
            </tr>
            <tr>
              <td class="mono text-xs text-sage-400">PJM-20260406-004</td>
              <td><div class="flex items-center gap-2"><div class="w-6 h-6 bg-red-100 rounded-full flex items-center justify-center text-red-600 text-[10px] font-bold">SR</div><span class="font-medium">Siti Rahayu</span></div></td>
              <td>Tang Kombinasi</td>
              <td class="font-bold text-sage-700">2</td>
              <td class="mono text-xs text-sage-400">04/04/2026</td>
              <td class="mono text-xs text-red-500 font-bold">08/04/2026</td>
              <td><span class="tag bg-red-100 text-red-600">Terlambat</span></td>
              <td><div class="flex gap-1.5"><button class="btn btn-secondary btn-sm" onclick="openModal('modal-detail-pinjam')">Detail</button><button class="btn btn-primary btn-sm" onclick="openModal('modal-konfirm-kembali')">Kembalikan</button></div></td>
            </tr>
            <tr>
              <td class="mono text-xs text-sage-400">PJM-20260406-003</td>
              <td><div class="flex items-center gap-2"><div class="w-6 h-6 bg-sage-100 rounded-full flex items-center justify-center text-sage-600 text-[10px] font-bold">AW</div><span class="font-medium">Andi Wijaya</span></div></td>
              <td>Multimeter Digital</td>
              <td class="font-bold text-sage-700">1</td>
              <td class="mono text-xs text-sage-400">06/04/2026</td>
              <td class="mono text-xs text-sage-400">12/04/2026</td>
              <td><span class="tag bg-yellow-100 text-yellow-700">Aktif</span></td>
              <td><div class="flex gap-1.5"><button class="btn btn-secondary btn-sm" onclick="openModal('modal-detail-pinjam')">Detail</button><button class="btn btn-primary btn-sm" onclick="openModal('modal-konfirm-kembali')">Kembalikan</button></div></td>
            </tr>
            <tr>
              <td class="mono text-xs text-sage-400">PJM-20260401-010</td>
              <td><div class="flex items-center gap-2"><div class="w-6 h-6 bg-sage-100 rounded-full flex items-center justify-center text-sage-600 text-[10px] font-bold">DP</div><span class="font-medium">Dian Pratama</span></div></td>
              <td>Obeng Set Lengkap</td>
              <td class="font-bold text-sage-700">1</td>
              <td class="mono text-xs text-sage-400">01/04/2026</td>
              <td class="mono text-xs text-sage-400">05/04/2026</td>
              <td><span class="tag bg-sage-100 text-sage-600">Selesai</span></td>
              <td><div class="flex gap-1.5"><button class="btn btn-secondary btn-sm" onclick="openModal('modal-detail-pinjam')">Detail</button></div></td>
            </tr>
            <tr>
              <td class="mono text-xs text-sage-400">PJM-20260331-008</td>
              <td><div class="flex items-center gap-2"><div class="w-6 h-6 bg-sage-100 rounded-full flex items-center justify-center text-sage-600 text-[10px] font-bold">RH</div><span class="font-medium">Riko Hendra</span></div></td>
              <td>Bor Listrik #2</td>
              <td class="font-bold text-sage-700">1</td>
              <td class="mono text-xs text-sage-400">31/03/2026</td>
              <td class="mono text-xs text-sage-400">05/04/2026</td>
              <td><span class="tag bg-sage-100 text-sage-600">Selesai</span></td>
              <td><div class="flex gap-1.5"><button class="btn btn-secondary btn-sm" onclick="openModal('modal-detail-pinjam')">Detail</button></div></td>
            </tr>
          </tbody>
        </table>
        <div class="flex items-center justify-between px-5 py-3 border-t border-sage-100">
          <span class="text-xs text-sage-300">Menampilkan 5 dari 157 transaksi</span>
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

      <!-- Menunggu pengembalian -->
      <div class="card p-5 mb-6 border-l-4 border-l-yellow-400">
        <div class="flex items-center justify-between mb-3">
          <h3 class="text-sm font-semibold text-sage-800">Menunggu Pengembalian Hari Ini</h3>
          <span class="badge bg-yellow-100 text-yellow-700 text-xs px-3 py-1 rounded-full">3 alat</span>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
          <div class="flex items-center gap-3 bg-sage-50 rounded-xl p-3">
            <div class="w-9 h-9 bg-yellow-100 rounded-xl flex items-center justify-center flex-shrink-0">
              <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M14.7 6.3a1 1 0 000 1.4l1.6 1.6a1 1 0 001.4 0l3.77-3.77a6 6 0 01-7.94 7.94l-6.91 6.91a2.12 2.12 0 01-3-3l6.91-6.91a6 6 0 017.94-7.94l-3.76 3.76z"/></svg>
            </div>
            <div>
              <div class="text-xs font-semibold text-sage-800">Lina Marlina</div>
              <div class="text-[11px] text-sage-400">Obeng Set · tenggat hari ini</div>
            </div>
          </div>
          <div class="flex items-center gap-3 bg-red-50 rounded-xl p-3">
            <div class="w-9 h-9 bg-red-100 rounded-xl flex items-center justify-center flex-shrink-0">
              <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/></svg>
            </div>
            <div>
              <div class="text-xs font-semibold text-sage-800">Siti Rahayu</div>
              <div class="text-[11px] text-red-500">Tang · terlambat 1 hari</div>
            </div>
          </div>
          <div class="flex items-center gap-3 bg-red-50 rounded-xl p-3">
            <div class="w-9 h-9 bg-red-100 rounded-xl flex items-center justify-center flex-shrink-0">
              <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/></svg>
            </div>
            <div>
              <div class="text-xs font-semibold text-sage-800">Adi Kusuma</div>
              <div class="text-[11px] text-red-500">Helm · terlambat 2 hari</div>
            </div>
          </div>
        </div>
      </div>

      <!-- Histori pengembalian -->
      <div class="card overflow-hidden">
        <div class="flex items-center justify-between px-5 py-4 border-b border-sage-100">
          <h3 class="text-sm font-semibold text-sage-800">Riwayat Pengembalian</h3>
          <div class="flex gap-2"><input type="date" class="input w-36 py-1.5 text-xs"><button class="btn btn-secondary btn-sm">Filter</button></div>
        </div>
        <table>
          <thead><tr><th>No. Kembali</th><th>Peminjam</th><th>Alat</th><th>Tgl Kembali</th><th>Tenggat</th><th>Kondisi</th><th>Denda</th><th>Proses oleh</th></tr></thead>
          <tbody>
            <tr>
              <td class="mono text-xs text-sage-400">KBL-20260407-003</td>
              <td class="font-medium">Dian Pratama</td>
              <td>Tang Set</td>
              <td class="mono text-xs text-sage-400">07/04/2026</td>
              <td class="mono text-xs text-sage-400">07/04/2026</td>
              <td><span class="tag bg-sage-100 text-sage-600">Baik</span></td>
              <td class="font-bold text-sage-700">Rp 0</td>
              <td class="text-sage-400 text-xs">Budi S.</td>
            </tr>
            <tr>
              <td class="mono text-xs text-sage-400">KBL-20260406-002</td>
              <td class="font-medium">Lina Marlina</td>
              <td>Obeng Set</td>
              <td class="mono text-xs text-sage-400">06/04/2026</td>
              <td class="mono text-xs text-sage-400">05/04/2026</td>
              <td><span class="tag bg-yellow-100 text-yellow-600">Lecet</span></td>
              <td class="font-bold text-red-500">Rp 5.000</td>
              <td class="text-sage-400 text-xs">Budi S.</td>
            </tr>
            <tr>
              <td class="mono text-xs text-sage-400">KBL-20260405-001</td>
              <td class="font-medium">Riko Hendra</td>
              <td>Bor Listrik #2</td>
              <td class="mono text-xs text-sage-400">05/04/2026</td>
              <td class="mono text-xs text-sage-400">05/04/2026</td>
              <td><span class="tag bg-sage-100 text-sage-600">Baik</span></td>
              <td class="font-bold text-sage-700">Rp 0</td>
              <td class="text-sage-400 text-xs">Sari R.</td>
            </tr>
          </tbody>
        </table>
        <div class="flex items-center justify-between px-5 py-3 border-t border-sage-100">
          <span class="text-xs text-sage-300">3 pengembalian hari ini</span>
          <div class="flex gap-1.5"><button class="btn btn-secondary btn-sm px-3">‹</button><button class="btn btn-primary btn-sm px-3">1</button><button class="btn btn-secondary btn-sm px-3">›</button></div>
        </div>
      </div>
    </div>

    <!-- ========== LAPORAN ========== -->
    <div id="page-laporan" class="page animate-fade-in">
      <div class="flex items-center justify-between mb-6">
        <div>
          <h1 class="text-2xl font-bold text-sage-800 tracking-tight">Laporan</h1>
          <p class="text-sm text-sage-300 mt-0.5">Ringkasan dan ekspor data transaksi</p>
        </div>
        <div class="flex gap-2">
          <button class="btn btn-secondary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
            Export PDF
          </button>
          <button class="btn btn-primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
            Export Excel
          </button>
        </div>
      </div>

      <!-- Filter periode -->
      <div class="card p-4 mb-6 flex flex-wrap items-center gap-3">
        <span class="text-xs font-semibold text-sage-400">Periode:</span>
        <div class="flex gap-1 bg-sage-50 rounded-xl p-1">
          <button class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-sage-800 text-white">Hari Ini</button>
          <button class="px-3 py-1.5 rounded-lg text-xs font-semibold text-sage-500 hover:bg-white transition-all">Minggu Ini</button>
          <button class="px-3 py-1.5 rounded-lg text-xs font-semibold text-sage-500 hover:bg-white transition-all">Bulan Ini</button>
          <button class="px-3 py-1.5 rounded-lg text-xs font-semibold text-sage-500 hover:bg-white transition-all">Custom</button>
        </div>
        <input type="date" class="input w-36">
        <span class="text-sage-300 text-sm">—</span>
        <input type="date" class="input w-36">
        <button class="btn btn-secondary">Terapkan</button>
      </div>

      <!-- Summary stats -->
      <div class="grid grid-cols-2 xl:grid-cols-4 gap-4 mb-7">
        <div class="card p-5 text-center">
          <div class="text-3xl font-bold text-sage-800 tracking-tight mb-1">7</div>
          <div class="section-label">Peminjaman Baru</div>
          <div class="text-xs text-sage-400 mt-2">Hari ini</div>
        </div>
        <div class="card p-5 text-center">
          <div class="text-3xl font-bold text-blue-600 tracking-tight mb-1">3</div>
          <div class="section-label">Pengembalian</div>
          <div class="text-xs text-sage-400 mt-2">Hari ini</div>
        </div>
        <div class="card p-5 text-center">
          <div class="text-3xl font-bold text-red-600 tracking-tight mb-1">1</div>
          <div class="section-label">Alat Rusak</div>
          <div class="text-xs text-sage-400 mt-2">Dilaporkan</div>
        </div>
        <div class="card p-5 text-center">
          <div class="text-3xl font-bold text-sage-800 tracking-tight mb-1">Rp 5rb</div>
          <div class="section-label">Total Denda</div>
          <div class="text-xs text-sage-400 mt-2">Terkumpul</div>
        </div>
      </div>

      <!-- Alat paling sering dipinjam -->
      <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
        <div class="card overflow-hidden">
          <div class="px-5 py-4 border-b border-sage-100">
            <h3 class="text-sm font-semibold text-sage-800">Alat Paling Sering Dipinjam</h3>
          </div>
          <div class="p-4 space-y-3">
            <div class="flex items-center gap-3">
              <span class="w-6 text-center text-xs font-bold text-sage-300">1</span>
              <div class="flex-1">
                <div class="flex justify-between mb-1"><span class="text-xs font-semibold text-sage-700">Bor Listrik</span><span class="text-xs text-sage-400 mono">48x</span></div>
                <div class="h-2 bg-sage-100 rounded-full overflow-hidden"><div class="h-2 bg-sage-500 rounded-full" style="width:80%"></div></div>
              </div>
            </div>
            <div class="flex items-center gap-3">
              <span class="w-6 text-center text-xs font-bold text-sage-300">2</span>
              <div class="flex-1">
                <div class="flex justify-between mb-1"><span class="text-xs font-semibold text-sage-700">Tang Kombinasi</span><span class="text-xs text-sage-400 mono">35x</span></div>
                <div class="h-2 bg-sage-100 rounded-full overflow-hidden"><div class="h-2 bg-sage-400 rounded-full" style="width:60%"></div></div>
              </div>
            </div>
            <div class="flex items-center gap-3">
              <span class="w-6 text-center text-xs font-bold text-sage-300">3</span>
              <div class="flex-1">
                <div class="flex justify-between mb-1"><span class="text-xs font-semibold text-sage-700">Multimeter</span><span class="text-xs text-sage-400 mono">29x</span></div>
                <div class="h-2 bg-sage-100 rounded-full overflow-hidden"><div class="h-2 bg-sage-300 rounded-full" style="width:48%"></div></div>
              </div>
            </div>
            <div class="flex items-center gap-3">
              <span class="w-6 text-center text-xs font-bold text-sage-300">4</span>
              <div class="flex-1">
                <div class="flex justify-between mb-1"><span class="text-xs font-semibold text-sage-700">Obeng Set</span><span class="text-xs text-sage-400 mono">22x</span></div>
                <div class="h-2 bg-sage-100 rounded-full overflow-hidden"><div class="h-2 bg-sage-200 rounded-full" style="width:37%"></div></div>
              </div>
            </div>
            <div class="flex items-center gap-3">
              <span class="w-6 text-center text-xs font-bold text-sage-300">5</span>
              <div class="flex-1">
                <div class="flex justify-between mb-1"><span class="text-xs font-semibold text-sage-700">Helm Safety</span><span class="text-xs text-sage-400 mono">18x</span></div>
                <div class="h-2 bg-sage-100 rounded-full overflow-hidden"><div class="h-2 bg-sage-100 rounded-full" style="width:30%;background:#C2DDD5"></div></div>
              </div>
            </div>
          </div>
        </div>

        <!-- Detail transaksi -->
        <div class="card overflow-hidden">
          <div class="px-5 py-4 border-b border-sage-100">
            <h3 class="text-sm font-semibold text-sage-800">Rekap Transaksi Harian</h3>
          </div>
          <table>
            <thead><tr><th>Jam</th><th>Jenis</th><th>Peminjam</th><th>Alat</th></tr></thead>
            <tbody>
              <tr><td class="mono text-xs text-sage-400">09:15</td><td><span class="tag bg-yellow-100 text-yellow-700">Pinjam</span></td><td class="font-medium text-xs">Rino S.</td><td class="text-xs">Bor Listrik</td></tr>
              <tr><td class="mono text-xs text-sage-400">09:42</td><td><span class="tag bg-blue-100 text-blue-600">Kembali</span></td><td class="font-medium text-xs">Dian P.</td><td class="text-xs">Tang Set</td></tr>
              <tr><td class="mono text-xs text-sage-400">10:05</td><td><span class="tag bg-yellow-100 text-yellow-700">Pinjam</span></td><td class="font-medium text-xs">Andi W.</td><td class="text-xs">Multimeter</td></tr>
              <tr><td class="mono text-xs text-sage-400">10:30</td><td><span class="tag bg-yellow-100 text-yellow-700">Pinjam</span></td><td class="font-medium text-xs">Lina M.</td><td class="text-xs">Obeng Set</td></tr>
              <tr><td class="mono text-xs text-sage-400">11:15</td><td><span class="tag bg-blue-100 text-blue-600">Kembali</span></td><td class="font-medium text-xs">Riko H.</td><td class="text-xs">Bor Listrik</td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div><!-- end p-7 -->
</div><!-- end main -->


<!-- ===================== MODALS ===================== -->

<!-- Modal Buat Peminjaman -->
<div id="modal-pinjam" class="modal-bg" onclick="closeModalBg(event,'modal-pinjam')">
  <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg p-6 animate-fade-in m-4">
    <div class="flex items-center justify-between mb-5">
      <h3 class="text-base font-bold text-sage-800">Buat Peminjaman Baru</h3>
      <button class="text-sage-300 hover:text-sage-600 transition-colors" onclick="closeModal('modal-pinjam')"><svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
    </div>
    <div class="space-y-4">
      <div>
        <label class="section-label block mb-1.5">Peminjam <span class="text-red-400">*</span></label>
        <select class="input"><option>-- Pilih User --</option><option>Rino Saputra</option><option>Siti Rahayu</option><option>Andi Wijaya</option><option>Lina Marlina</option><option>Dian Pratama</option></select>
      </div>
      <div>
        <label class="section-label block mb-1.5">Pilih Alat <span class="text-red-400">*</span></label>
        <select class="input"><option>-- Pilih Alat --</option><option>Bor Listrik #1 (Tersedia)</option><option>Bor Listrik #4 (Tersedia)</option><option>Tang Kombinasi (Tersedia)</option><option>Obeng Set (Tersedia)</option><option>Helm Safety (Tersedia)</option></select>
      </div>
      <div>
        <label class="section-label block mb-1.5">Jumlah <span class="text-red-400">*</span></label>
        <input type="number" min="1" value="1" class="input">
      </div>
      <div class="grid grid-cols-2 gap-3">
        <div>
          <label class="section-label block mb-1.5">Tanggal Pinjam <span class="text-red-400">*</span></label>
          <input type="date" class="input">
        </div>
        <div>
          <label class="section-label block mb-1.5">Tanggal Tenggat <span class="text-red-400">*</span></label>
          <input type="date" class="input">
        </div>
      </div>
      <div>
        <label class="section-label block mb-1.5">Keperluan</label>
        <textarea rows="2" placeholder="Untuk keperluan apa?" class="input resize-none"></textarea>
      </div>
    </div>
    <div class="flex gap-3 mt-5">
      <button class="btn btn-primary flex-1">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
        Konfirmasi Peminjaman
      </button>
      <button class="btn btn-secondary" onclick="closeModal('modal-pinjam')">Batal</button>
    </div>
  </div>
</div>

<!-- Modal Konfirmasi Pengembalian -->
<div id="modal-konfirm-kembali" class="modal-bg" onclick="closeModalBg(event,'modal-konfirm-kembali')">
  <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-6 animate-fade-in m-4">
    <div class="flex items-center justify-between mb-5">
      <h3 class="text-base font-bold text-sage-800">Proses Pengembalian</h3>
      <button class="text-sage-300 hover:text-sage-600 transition-colors" onclick="closeModal('modal-konfirm-kembali')"><svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
    </div>
    <!-- Info pinjam -->
    <div class="bg-sage-50 border border-sage-100 rounded-xl p-4 mb-4 space-y-2">
      <div class="flex justify-between text-sm"><span class="text-sage-400">No. Pinjam</span><span class="font-semibold mono text-sage-700 text-xs">PJM-20260407-007</span></div>
      <div class="flex justify-between text-sm"><span class="text-sage-400">Peminjam</span><span class="font-semibold text-sage-800">Rino Saputra</span></div>
      <div class="flex justify-between text-sm"><span class="text-sage-400">Alat</span><span class="font-semibold text-sage-800">Bor Listrik #3</span></div>
      <div class="flex justify-between text-sm"><span class="text-sage-400">Tenggat</span><span class="font-semibold text-sage-800">10/04/2026</span></div>
    </div>
    <div class="space-y-4">
      <div>
        <label class="section-label block mb-1.5">Kondisi Alat Saat Kembali <span class="text-red-400">*</span></label>
        <select class="input">
          <option>Baik — Tidak ada kerusakan</option>
          <option>Lecet / Sedikit Rusak</option>
          <option>Rusak Parah — Tidak bisa digunakan</option>
        </select>
      </div>
      <div>
        <label class="section-label block mb-1.5">Tanggal Pengembalian</label>
        <input type="date" class="input">
      </div>
      <div>
        <label class="section-label block mb-1.5">Catatan Petugas</label>
        <textarea rows="2" placeholder="Catatan kondisi, kerusakan, dll..." class="input resize-none"></textarea>
      </div>
    </div>
    <div class="flex gap-3 mt-5">
      <button class="btn btn-primary flex-1">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 102.13-9.36L1 10"/></svg>
        Konfirmasi Diterima
      </button>
      <button class="btn btn-secondary" onclick="closeModal('modal-konfirm-kembali')">Batal</button>
    </div>
  </div>
</div>

<!-- Modal Detail Peminjaman -->
<div id="modal-detail-pinjam" class="modal-bg" onclick="closeModalBg(event,'modal-detail-pinjam')">
  <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-6 animate-fade-in m-4">
    <div class="flex items-center justify-between mb-5">
      <h3 class="text-base font-bold text-sage-800">Detail Peminjaman</h3>
      <button class="text-sage-300 hover:text-sage-600 transition-colors" onclick="closeModal('modal-detail-pinjam')"><svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
    </div>
    <div class="space-y-3">
      <div class="flex justify-between py-2.5 border-b border-sage-50"><span class="text-xs text-sage-400">No. Pinjam</span><span class="mono text-xs font-semibold text-sage-700">PJM-20260407-007</span></div>
      <div class="flex justify-between py-2.5 border-b border-sage-50"><span class="text-xs text-sage-400">Peminjam</span><span class="text-sm font-semibold text-sage-800">Rino Saputra</span></div>
      <div class="flex justify-between py-2.5 border-b border-sage-50"><span class="text-xs text-sage-400">Alat</span><span class="text-sm font-semibold text-sage-800">Bor Listrik #3</span></div>
      <div class="flex justify-between py-2.5 border-b border-sage-50"><span class="text-xs text-sage-400">Jumlah</span><span class="text-sm font-semibold text-sage-800">1 unit</span></div>
      <div class="flex justify-between py-2.5 border-b border-sage-50"><span class="text-xs text-sage-400">Tanggal Pinjam</span><span class="mono text-xs font-semibold text-sage-700">05/04/2026</span></div>
      <div class="flex justify-between py-2.5 border-b border-sage-50"><span class="text-xs text-sage-400">Tanggal Tenggat</span><span class="mono text-xs font-semibold text-sage-700">10/04/2026</span></div>
      <div class="flex justify-between py-2.5 border-b border-sage-50"><span class="text-xs text-sage-400">Status</span><span class="tag bg-yellow-100 text-yellow-700">Aktif</span></div>
      <div class="flex justify-between py-2.5 border-b border-sage-50"><span class="text-xs text-sage-400">Keperluan</span><span class="text-sm text-sage-600">Proyek konstruksi lantai 2</span></div>
      <div class="flex justify-between py-2.5"><span class="text-xs text-sage-400">Diproses oleh</span><span class="text-sm font-semibold text-sage-800">Budi Santoso</span></div>
    </div>
    <div class="flex gap-3 mt-5">
      <button class="btn btn-primary flex-1" onclick="closeModal('modal-detail-pinjam');openModal('modal-konfirm-kembali')">Proses Pengembalian</button>
      <button class="btn btn-secondary" onclick="closeModal('modal-detail-pinjam')">Tutup</button>
    </div>
  </div>
</div>

<!-- Modal Scan -->
<div id="modal-scan" class="modal-bg" onclick="closeModalBg(event,'modal-scan')">
  <div class="bg-white rounded-2xl shadow-2xl w-full max-w-sm p-6 animate-fade-in m-4 text-center">
    <h3 class="text-base font-bold text-sage-800 mb-2">Scan Barcode / QR Code</h3>
    <p class="text-xs text-sage-400 mb-5">Arahkan kamera ke barcode atau QR code alat</p>
    <div class="w-full h-48 bg-sage-900 rounded-xl flex flex-col items-center justify-center mb-5 relative overflow-hidden">
      <div class="absolute inset-4 border-2 border-sage-400 rounded-lg opacity-60"></div>
      <svg class="w-10 h-10 text-sage-500 mb-2 relative z-10" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><rect x="5" y="2" width="14" height="20" rx="2"/><path d="M12 18h.01"/></svg>
      <span class="text-xs text-sage-500 relative z-10">Kamera tidak aktif</span>
    </div>
    <p class="text-xs text-sage-300 mb-4">atau input manual:</p>
    <input type="text" placeholder="Masukkan kode alat (BOR-001)" class="input mb-4">
    <div class="flex gap-3">
      <button class="btn btn-primary flex-1">Cari Alat</button>
      <button class="btn btn-secondary" onclick="closeModal('modal-scan')">Tutup</button>
    </div>
  </div>
</div>


<script>
function goTo(pageId) {
  document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
  document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));

  const page = document.getElementById('page-' + pageId);
  if (page) page.classList.add('active');

  document.querySelectorAll('.nav-item').forEach(n => {
    const oc = n.getAttribute('onclick') || '';
    if (oc.includes("'" + pageId + "'")) n.classList.add('active');
  });

  const titles = { 'dashboard':'Dashboard','peminjaman':'Peminjaman','pengembalian':'Pengembalian','laporan':'Laporan' };
  document.getElementById('topbar-title').textContent = titles[pageId] || 'Dashboard';
  window.scrollTo(0, 0);
}

function openModal(id) { document.getElementById(id).classList.add('open'); }
function closeModal(id) { document.getElementById(id).classList.remove('open'); }
function closeModalBg(e, id) { if (e.target === document.getElementById(id)) closeModal(id); }

function filterStatus(status) {
  document.querySelectorAll('[id^="tab-"]').forEach(t => {
    t.className = t.className.replace('bg-sage-800 text-white','text-sage-500 hover:bg-sage-50');
  });
  const active = document.getElementById('tab-' + status);
  if (active) {
    active.className = active.className.replace('text-sage-500 hover:bg-sage-50','bg-sage-800 text-white');
  }
}
</script>
</body>
</html>