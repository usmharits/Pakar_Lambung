<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peringatan Medis - Sistem Pakar</title>

    <!-- Google Fonts: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* CSS Reset & Variables */
        :root {
            /* Main Theme Colors */
            --primary: #1468a2;
            --primary-hover: #0f5483;
            --secondary: #74dff6;
            --text-main: #0b1e3f;
            --text-muted: #6b7280;
            --bg-body: #f4f7f9;
            --bg-card: #ffffff;
            
            /* Alert Colors (SaaS Premium standard) */
            --danger-main: #dc2626;
            --danger-light: #fef2f2;
            --danger-border: #fecaca;
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
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        @keyframes pulse-ring {
            0%   { transform: scale(0.9); opacity: 0.8; }
            70%  { transform: scale(1.15); opacity: 0; }
            100% { transform: scale(0.9); opacity: 0; }
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
            background-color: var(--danger-main);
        }

        /* ── Pulse Icon ── */
        .icon-container {
            display: flex;
            justify-content: center;
            margin-bottom: 24px;
        }

        .icon-wrapper {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 72px;
            height: 72px;
        }

        .pulse-ring {
            position: absolute;
            inset: 0;
            border-radius: 50%;
            background-color: var(--danger-light);
            border: 1px solid var(--danger-border);
            animation: pulse-ring 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        .icon-bg {
            position: absolute;
            inset: 4px;
            border-radius: 50%;
            background-color: var(--danger-light);
            z-index: 1;
        }

        .icon-wrapper svg {
            position: relative;
            z-index: 2;
            width: 32px;
            height: 32px;
            stroke: var(--danger-main);
        }

        /* ── Typography & Badges ── */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background-color: var(--danger-light);
            color: var(--danger-main);
            border: 1px solid var(--danger-border);
            font-size: 11px;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 12px;
        }

        .status-badge circle {
            fill: var(--danger-main);
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
            margin-bottom: 16px;
        }

        .symptom-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background-color: #fafafa;
            border: 1px solid #e2e8f0;
            color: var(--text-main);
            font-weight: 500;
            font-size: 14px;
            padding: 8px 16px;
            border-radius: 12px;
        }

        .symptom-badge svg {
            width: 16px;
            height: 16px;
            stroke: var(--danger-main);
        }

        /* ── Divider ── */
        .divider {
            height: 1px;
            background-color: #f1f5f9;
            margin: 24px 0;
        }

        /* ── Warning Box (SaaS Style) ── */
        .warning-box {
            background-color: var(--danger-main);
            border-radius: 12px;
            padding: 16px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            text-align: left;
            margin-bottom: 16px;
        }

        .warning-icon {
            width: 32px;
            height: 32px;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .warning-text-group {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .warning-title {
            color: #ffffff;
            font-weight: 600;
            font-size: 14px;
        }

        .warning-desc {
            color: rgba(255, 255, 255, 0.9);
            font-size: 13px;
            line-height: 1.5;
        }

        /* ── Info Tips ── */
        .info-box {
            background-color: rgba(116, 223, 246, 0.1);
            border: 1px solid rgba(116, 223, 246, 0.2);
            border-radius: 12px;
            padding: 12px 16px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            text-align: left;
            margin-bottom: 24px;
        }

        .info-box svg {
            width: 16px;
            height: 16px;
            stroke: var(--primary);
            flex-shrink: 0;
            margin-top: 2px;
        }

        .info-desc {
            font-size: 13px;
            color: var(--text-main);
            line-height: 1.5;
            opacity: 0.8;
        }

        /* ── Action Button ── */
        .btn-back {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            background-color: transparent;
            color: var(--primary);
            font-size: 14px;
            font-weight: 500;
            padding: 12px 20px;
            border-radius: 10px;
            border: 1px solid rgba(20, 104, 162, 0.2);
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .btn-back:hover {
            background-color: rgba(20, 104, 162, 0.04);
            border-color: var(--primary);
        }

        .btn-back svg {
            width: 16px;
            height: 16px;
            stroke: currentColor;
            transition: transform 0.2s ease;
        }

        .btn-back:hover svg {
            transform: translateX(-4px);
        }
    </style>
</head>
<body>

    <!-- Modal Card Peringatan Medis -->
    <div class="modal-card">
        
        <!-- Top Accent Line -->
        <div class="top-accent"></div>

        <!-- Pulse Icon -->
        <div class="icon-container">
            <div class="icon-wrapper">
                <div class="pulse-ring"></div>
                <div class="icon-bg"></div>
                <svg fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                    <line x1="12" y1="9" x2="12" y2="13"/>
                    <line x1="12" y1="17" x2="12.01" y2="17"/>
                </svg>
            </div>
        </div>

        <!-- Status & Heading -->
        <div class="status-badge">
            <svg width="6" height="6" viewBox="0 0 8 8"><circle cx="4" cy="4" r="4"/></svg>
            Red Flag Terdeteksi
        </div>
        
        <h1 class="modal-title">Tanda Bahaya!</h1>
        <p class="modal-desc">Sistem mendeteksi keluhan berisiko tinggi yang memerlukan penanganan medis segera:</p>

        <!-- Gejala Berbahaya (Variable Blade) -->
        <div class="symptom-badge">
            <svg fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
            </svg>
            {{ $gejala->nama }}
        </div>

        <div class="divider"></div>

        <!-- Warning CTA Box -->
        <div class="warning-box">
            <div class="warning-icon">
                <svg width="18" height="18" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                    <polyline points="9 22 9 12 15 12 15 22"/>
                </svg>
            </div>
            <div class="warning-text-group">
                <span class="warning-title">Jangan Lakukan Swamedikasi</span>
                <span class="warning-desc">Segera kunjungi <strong>IGD Rumah Sakit</strong> atau hubungi tenaga medis profesional.</span>
            </div>
        </div>

        <!-- Info Tips -->
        <div class="info-box">
            <svg fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10"/>
                <line x1="12" y1="8" x2="12" y2="12"/>
                <line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
            <span class="info-desc">Kondisi ini bisa mengindikasikan perdarahan saluran cerna bagian atas. Diperlukan pemeriksaan endoskopi segera.</span>
        </div>

        <!-- Back Link Button -->
        <a href="/" class="btn-back">
            <svg fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <path d="M19 12H5m7-7l-7 7 7 7"/>
            </svg>
            Kembali ke Form Diagnosa
        </a>

    </div>

</body>
</html>