<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil: Gejala Ringan - Sistem Pakar</title>

    <!-- Google Fonts: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* ── CSS Reset & Variables ── */
        :root {
            --primary: #1468a2;
            --primary-hover: #0f5483;
            --text-main: #0b1e3f;
            --text-muted: #6b7280;
            --bg-body: #f4f7f9;
            --bg-card: #ffffff;
            
            /* Theme Colors for "Mild/Safe" */
            --safe-main: #d97706; /* Amber */
            --safe-light: #fef3c7;
            --safe-border: #fde68a;
            --safe-gradient-start: #fcd34d;
            --safe-gradient-end: #f59e0b;
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
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px 16px;
            -webkit-font-smoothing: antialiased;
        }

        /* ── Keyframes Animasi ── */
        @keyframes slide-up {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50%      { transform: translateY(-8px); }
        }

        @keyframes fill-bar {
            from { width: 0%; }
            to   { width: var(--cf-width); } /* Mengambil nilai dinamis dari Blade */
        }

        @keyframes fade-in {
            from { opacity: 0; }
            to   { opacity: 1; }
        }

        /* ── Modal Container ── */
        .modal-card {
            background-color: var(--bg-card);
            width: 100%;
            max-width: 440px;
            border-radius: 20px;
            padding: 40px 32px 32px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(11, 30, 63, 0.04);
            border: 1px solid #e2e8f0;
            text-align: center;
            animation: slide-up 0.5s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
        }

        /* ── Top Accent Line ── */
        .top-accent {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--safe-gradient-start), var(--safe-gradient-end));
        }

        /* ── Floating Icon ── */
        .icon-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .icon-box {
            width: 80px;
            height: 80px;
            background-color: var(--safe-light);
            border: 1px solid var(--safe-border);
            border-radius: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 16px rgba(245, 158, 11, 0.08);
            animation: float 4s ease-in-out infinite;
        }

        .icon-box span {
            font-size: 40px;
            line-height: 1;
        }

        /* ── Typography & Badges ── */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background-color: rgba(245, 158, 11, 0.1);
            color: var(--safe-main);
            border: 1px solid rgba(245, 158, 11, 0.2);
            font-size: 11px;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 12px;
        }

        .status-badge circle {
            fill: var(--safe-main);
        }

        .modal-title {
            font-size: 22px;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 8px;
            letter-spacing: -0.3px;
        }

        .modal-desc {
            font-size: 14px;
            color: var(--text-muted);
            line-height: 1.6;
            margin-bottom: 24px;
        }

        /* ── CF Score Visualizer ── */
        .cf-card {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 16px 20px;
            margin-bottom: 24px;
            text-align: left;
        }

        .cf-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .cf-title {
            font-size: 12px;
            font-weight: 500;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .cf-value {
            font-size: 20px;
            font-weight: 600;
            color: var(--safe-main);
            animation: fade-in 0.5s ease 0.6s both;
        }

        .cf-bar-track {
            height: 8px;
            background-color: #e2e8f0;
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 8px;
        }

        .cf-bar-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--safe-gradient-start), var(--safe-gradient-end));
            border-radius: 10px;
            width: 0; /* Starter value */
            animation: fill-bar 1s cubic-bezier(0.2, 0.8, 0.2, 1) 0.3s forwards;
        }

        .cf-labels {
            display: flex;
            justify-content: space-between;
            font-size: 11px;
            color: #94a3b8;
            font-weight: 500;
        }

        .cf-labels .limit {
            color: var(--safe-main);
            opacity: 0.8;
        }

        /* ── Saran Perawatan List ── */
        .saran-wrapper {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 24px;
            text-align: left;
        }

        .saran-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 16px;
        }

        .saran-header-icon {
            width: 28px;
            height: 28px;
            background-color: var(--safe-light);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .saran-header-icon svg {
            width: 14px;
            height: 14px;
            stroke: var(--safe-main);
        }

        .saran-header-title {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-main);
        }

        .saran-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .saran-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding-bottom: 16px;
            border-bottom: 1px solid #f1f5f9;
        }

        .saran-item:last-child {
            padding-bottom: 0;
            border-bottom: none;
        }

        .saran-icon {
            width: 32px;
            height: 32px;
            background-color: rgba(245, 158, 11, 0.08);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .saran-icon svg {
            width: 16px;
            height: 16px;
            stroke: var(--safe-main);
        }

        .saran-text h4 {
            font-size: 13px;
            font-weight: 500;
            color: var(--text-main);
            margin-bottom: 2px;
        }

        .saran-text p {
            font-size: 12px;
            color: var(--text-muted);
            line-height: 1.5;
        }

        /* ── Action Button ── */
        .btn-primary {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            background-color: var(--primary);
            color: white;
            font-size: 14px;
            font-weight: 500;
            padding: 14px 24px;
            border-radius: 12px;
            border: none;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
        }

        .btn-primary svg {
            width: 16px;
            height: 16px;
            stroke: currentColor;
            transition: transform 0.2s ease;
        }

        .btn-primary:hover svg {
            transform: rotate(-45deg);
        }
    </style>
</head>
<body>

    <!-- Modal Card Hasil Ringan -->
    <div class="modal-card">
        
        <!-- Top Accent Line -->
        <div class="top-accent"></div>

        <!-- Floating Icon -->
        <div class="icon-container">
            <div class="icon-box">
                <span>🍵</span>
            </div>
        </div>

        <!-- Status & Heading -->
        <div class="status-badge">
            <svg width="6" height="6" viewBox="0 0 8 8"><circle cx="4" cy="4" r="4"/></svg>
            Aman · CF di bawah 40%
        </div>
        
        <h1 class="modal-title">Gejala Masih Ringan</h1>
        <p class="modal-desc">Kondisimu saat ini terpantau aman dan belum mengarah ke penyakit spesifik.</p>

        <!-- CF Score Visualizer -->
        <div class="cf-card">
            <div class="cf-header">
                <span class="cf-title">Nilai Kepercayaan (CF)</span>
                <!-- Angka di-render dari Blade -->
                <span class="cf-value">{{ round($nilaiCF * 100) }}%</span>
            </div>
            
            <div class="cf-bar-track">
                <!-- Logic animasi dinamis menggunakan CSS Variable berdasarkan nilai Blade -->
                <div class="cf-bar-fill" style="--cf-width: {{ round($nilaiCF * 100) }}%;"></div>
            </div>
            
            <div class="cf-labels">
                <span>0%</span>
                <span class="limit">Batas: 40%</span>
                <span>100%</span>
            </div>
        </div>

        <!-- Saran Perawatan Card -->
        <div class="saran-wrapper">
            <div class="saran-header">
                <div class="saran-header-icon">
                    <svg fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <span class="saran-header-title">Saran Perawatan</span>
            </div>

            <div class="saran-list">
                <!-- Row 1 -->
                <div class="saran-item">
                    <div class="saran-icon">
                        <svg fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <path d="M12 3v1m0 16v1M4.22 4.22l.7.7m12.16 12.16l.7.7M1 12h2m18 0h2M4.22 19.78l.7-.7M18.36 5.64l.7-.7"/>
                        </svg>
                    </div>
                    <div class="saran-text">
                        <h4>Istirahat yang cukup</h4>
                        <p>Tidur 7–8 jam per malam untuk membantu pemulihan.</p>
                    </div>
                </div>

                <!-- Row 2 -->
                <div class="saran-item">
                    <div class="saran-icon">
                        <svg fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <path d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                        </svg>
                    </div>
                    <div class="saran-text">
                        <h4>Hindari makanan pedas & asam</h4>
                        <p>Sementara hindari kopi, jeruk, dan makanan berminyak.</p>
                    </div>
                </div>

                <!-- Row 3 -->
                <div class="saran-item">
                    <div class="saran-icon">
                        <svg fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                        </svg>
                    </div>
                    <div class="saran-text">
                        <h4>Perbanyak air hangat</h4>
                        <p>Bila sakit berlanjut 3 hari, segera konsultasi ke dokter.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Button -->
        <a href="/" class="btn-primary">
            <svg fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <polyline points="1 4 1 10 7 10"/>
                <path d="M3.51 15a9 9 0 102.13-9.36L1 10"/>
            </svg>
            Coba Diagnosa Ulang
        </a>

    </div>

</body>
</html>