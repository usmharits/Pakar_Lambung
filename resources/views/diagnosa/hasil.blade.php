<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Diagnosa Sistem Pakar</title>

    <!-- Google Fonts: Poppins & JetBrains Mono untuk Log -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

    <style>
        /* ── CSS Reset & Variables ── */
        :root {
            --primary: #1468a2;
            --primary-hover: #0f5483;
            --secondary: #74dff6;
            --text-main: #0b1e3f;
            --text-muted: #6b7280;
            --bg-body: #f4f7f9;
            --bg-card: #ffffff;
            --danger: #dc2626;
            --border-light: #e2e8f0;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: var(--bg-body);
            color: var(--text-main);
            min-height: 100vh;
            padding: 32px 16px 64px;
            -webkit-font-smoothing: antialiased;
        }

        /* ── Layout ── */
        .page-wrap {
            max-width: 1000px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .grid-main {
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 24px;
            align-items: start;
        }

        @media (max-width: 850px) {
            .grid-main { grid-template-columns: 1fr; }
        }

        /* ── Animations ── */
        @keyframes slide-up {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fill-bar {
            from { width: 0%; }
            to { width: var(--cf-width); }
        }

        .anim-1 { animation: slide-up 0.5s ease forwards; }
        .anim-2 { animation: slide-up 0.5s ease 0.15s both; }
        .anim-3 { animation: slide-up 0.5s ease 0.3s both; }

        /* ── Component: Card ── */
        .card {
            background-color: var(--bg-card);
            border-radius: 24px;
            border: 1px solid var(--border-light);
            box-shadow: 0 4px 12px rgba(11, 30, 63, 0.03);
            overflow: hidden;
        }

        /* ── Main Diagnosis Card (Top) ── */
        .result-main {
            padding: 40px;
            position: relative;
            text-align: center;
        }

        .top-accent {
            position: absolute;
            top: 0; left: 0; right: 0; height: 4px;
            background: linear-gradient(90deg, var(--secondary), var(--primary));
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background-color: rgba(116, 223, 246, 0.12);
            color: var(--primary);
            font-size: 11px;
            font-weight: 600;
            padding: 6px 16px;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 24px;
        }

        .disease-name {
            font-size: 36px;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 16px;
            letter-spacing: -1px;
        }

        .cf-badge-inline {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            background-color: #f8fafc;
            border: 1px solid var(--border-light);
            padding: 12px 24px;
            border-radius: 16px;
            margin-bottom: 24px;
        }

        .cf-badge-label {
            font-size: 13px;
            color: var(--text-muted);
        }

        .cf-badge-value {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-main);
        }

        .cf-progress-container {
            max-width: 400px;
            margin: 0 auto;
        }

        .cf-bar-track {
            height: 10px;
            background-color: #e2e8f0;
            border-radius: 20px;
            margin: 8px 0;
            overflow: hidden;
        }

        .cf-bar-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--secondary), var(--primary));
            border-radius: 20px;
            width: 0;
            animation: fill-bar 1.2s cubic-bezier(0.2, 0.8, 0.2, 1) 0.5s forwards;
        }

        .cf-labels {
            display: flex;
            justify-content: space-between;
            font-size: 11px;
            color: #94a3b8;
            font-weight: 500;
        }

        /* ── Medicine Section ── */
        .medicine-card {
            padding: 24px;
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }

        .icon-box {
            width: 40px;
            height: 40px;
            background-color: rgba(116, 223, 246, 0.1);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .medicine-group {
            border-radius: 16px;
            padding: 16px;
            margin-bottom: 16px;
        }

        .group-free { background-color: rgba(116, 223, 246, 0.05); border: 1px solid rgba(116, 223, 246, 0.15); }
        .group-hard { background-color: rgba(220, 38, 38, 0.03); border: 1px solid rgba(220, 38, 38, 0.1); }

        .group-tag {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 12px;
        }

        .obat-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .obat-item {
            background-color: #ffffff;
            border: 1px solid #eef2f6;
            padding: 12px 14px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.2s ease;
        }

        .obat-item:hover { border-color: var(--secondary); transform: translateX(4px); }

        .dot { width: 6px; height: 6px; border-radius: 50%; }

        /* ── Log Engine Panel (Dark) ── */
        .log-panel {
            background-color: #0b1e3f;
            padding: 24px;
            color: #ffffff;
        }

        .log-container {
            max-height: 450px;
            overflow-y: auto;
            padding-right: 8px;
        }

        /* Scrollbar */
        .log-container::-webkit-scrollbar { width: 4px; }
        .log-container::-webkit-scrollbar-thumb { background: rgba(116, 223, 246, 0.3); border-radius: 10px; }

        .log-entry {
            background-color: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 16px;
            padding: 16px;
            margin-bottom: 12px;
        }

        .log-entry-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            padding-bottom: 8px;
        }

        .log-entry-name { font-size: 13px; font-weight: 600; color: var(--secondary); }
        .log-entry-cf { font-size: 11px; font-weight: 700; background: rgba(116, 223, 246, 0.15); padding: 2px 8px; border-radius: 6px; }

        .log-step {
            font-family: 'JetBrains Mono', monospace;
            font-size: 11px;
            color: #cbd5e1;
            line-height: 1.6;
            background: rgba(0,0,0,0.2);
            padding: 8px;
            border-radius: 8px;
            margin-bottom: 4px;
        }

        /* ── CTA Button ── */
        .cta-wrap { text-align: center; margin-top: 8px; }
        
        .btn-retry {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background-color: #ffffff;
            color: var(--primary);
            border: 1px solid var(--border-light);
            padding: 14px 32px;
            border-radius: 16px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .btn-retry:hover {
            border-color: var(--secondary);
            background-color: #f8fafc;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>

<div class="page-wrap">

    {{-- CARD 1: HASIL UTAMA --}}
    <div class="card result-main anim-1">
        <div class="top-accent"></div>
        <div class="status-pill">
            <svg width="6" height="6" viewBox="0 0 8 8" fill="currentColor"><circle cx="4" cy="4" r="4"/></svg>
            Diagnosis Selesai
        </div>
        <h2 style="font-size: 14px; color: var(--text-muted); font-weight: 500; margin-bottom: 8px;">Kesimpulan Sistem Pakar</h2>
        <h1 class="disease-name">{{ $penyakit_terdiagnosa->nama }}</h1>

        <div class="cf-badge-inline">
            <span class="cf-badge-label">Tingkat Keyakinan (CF)</span>
            <span class="cf-badge-value">{{ number_format($top_cf_value, 2) }}%</span>
        </div>

        <div class="cf-progress-container">
            <div class="cf-labels">
                <span>0%</span>
                <span style="color: var(--primary)">Keyakinan Sistem</span>
                <span>100%</span>
            </div>
            <div class="cf-bar-track">
                <!-- Gunakan variabel CSS untuk animasi dinamis -->
                <div class="cf-bar-fill" style="--cf-width: {{ min($top_cf_value, 100) }}%;"></div>
            </div>
        </div>
    </div>

    {{-- GRID: OBAT & LOG --}}
    <div class="grid-main">
        
        {{-- CARD 2: OBAT --}}
        <div class="card medicine-card anim-2">
            <div class="section-header">
                <div class="icon-box">💊</div>
                <div>
                    <h3 style="font-size: 15px; font-weight: 700;">Rekomendasi E-Farmasi</h3>
                    <p style="font-size: 11px; color: var(--text-muted);">Berdasarkan diagnosis Anda</p>
                </div>
            </div>

            <!-- Obat Bebas -->
            <div class="medicine-group group-free">
                <div class="group-tag" style="color: var(--primary);">
                    <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Obat Bebas (Aman)
                </div>
                <div class="obat-list">
                    @forelse($obat_bebas as $obat)
                        <div class="obat-item">
                            <span class="dot" style="background: var(--secondary);"></span>
                            {{ $obat->nama }}
                        </div>
                    @empty
                        <p style="font-size: 12px; font-style: italic; color: #94a3b8;">Tidak ada rekomendasi.</p>
                    @endforelse
                </div>
            </div>

            <!-- Obat Keras -->
            <div class="medicine-group group-hard">
                <div class="group-tag" style="color: var(--danger);">
                    <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/></svg>
                    Wajib Resep Dokter
                </div>
                <div class="obat-list">
                    @forelse($obat_keras as $obat)
                        <div class="obat-item" style="border-color: rgba(220, 38, 38, 0.1);">
                            <span class="dot" style="background: var(--danger);"></span>
                            {{ $obat->nama }}
                        </div>
                    @empty
                        <p style="font-size: 12px; font-style: italic; color: #94a3b8;">Tidak ada rekomendasi.</p>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- CARD 3: LOG ENGINE --}}
        <div class="card log-panel anim-3">
            <div class="section-header">
                <div class="icon-box" style="background: rgba(255,255,255,0.05);">🧮</div>
                <div>
                    <h3 style="font-size: 15px; font-weight: 700; color: #fff;">Log Iterasi CF</h3>
                    <p style="font-size: 11px; color: rgba(255,255,255,0.5);">Engine Calculation Trace</p>
                </div>
            </div>

            <div class="log-container">
                @foreach($riwayat_sorted as $riwayat)
                    <div class="log-entry">
                        <div class="log-entry-header">
                            <span class="log-entry-name">{{ $riwayat['penyakit'] }}</span>
                            <span class="log-entry-cf">{{ $riwayat['hasil_akhir'] }}%</span>
                        </div>
                        @foreach($riwayat['langkah'] as $langkah)
                            <div class="log-step">{!! $langkah !!}</div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>

    </div>

    {{-- ACTION --}}
    <div class="cta-wrap anim-3">
        <a href="/" class="btn-retry">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <polyline points="1 4 1 10 7 10"/>
                <path d="M3.51 15a9 9 0 102.13-9.36L1 10"/>
            </svg>
            Hitung Diagnosa Ulang
        </a>
    </div>

</div>

</body>
</html>