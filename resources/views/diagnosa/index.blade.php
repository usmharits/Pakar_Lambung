<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemeriksaan Gejala - Sistem Pakar</title>

    <!-- Google Fonts: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        /* CSS Reset & Variables */
        :root {
            --primary: #1468a2;
            --primary-hover: #0f5483;
            --primary-light: rgba(20, 104, 162, 0.06);
            --secondary: #74dff6;
            --secondary-light: rgba(116, 223, 246, 0.1);
            --text-main: #0b1e3f;
            --text-muted: #6b7280;
            --text-light: #9ca3af;
            --bg-body: #f4f7f9; /* Sedikit lebih berwarna dari f9fafb */
            --bg-card: #ffffff;
            --border-light: #e2e8f0;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-body);
            color: var(--text-main);
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            line-height: 1.5;
        }

        /* Layout Structure - Dimaksimalkan */
        .container {
            width: 100%;
            max-width: 1100px; /* Diperlebar biar gak terlalu banyak white space di kiri kanan */
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Sticky Header dengan Logo */
        .top-header {
            position: sticky;
            top: 0;
            background-color: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(8px);
            border-bottom: 1px solid var(--border-light);
            z-index: 100;
            box-shadow: 0 2px 10px rgba(11, 30, 63, 0.03);
        }

        .header-inner {
            height: 60px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Logo Sederhana */
        .header-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            background-color: var(--primary-light);
            color: var(--primary);
            border-radius: 8px;
        }

        .header-brand {
            font-size: 15px;
            font-weight: 600;
            color: var(--text-main);
            letter-spacing: 0.2px;
        }

        /* Main Content Spacing */
        .main-content {
            padding-top: 24px;
            padding-bottom: 48px;
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        /* Heading Section */
        .heading-section {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background-color: var(--secondary-light);
            color: var(--primary);
            font-size: 13px;
            font-weight: 500;
            padding: 4px 12px;
            border-radius: 12px;
            align-self: flex-start;
            margin-bottom: 4px;
            border: 1px solid rgba(116, 223, 246, 0.3);
        }

        .badge-dot {
            width: 6px;
            height: 6px;
            background-color: var(--primary);
            border-radius: 50%;
        }

        .page-title {
            font-size: 20px;
            font-weight: 600;
            color: var(--text-main);
        }

        .page-subtitle {
            font-size: 14px;
            font-weight: 400;
            color: var(--text-muted);
        }

        /* Alert Error */
        .alert {
            background-color: #fef2f2;
            border: 1px solid #fee2e2;
            color: #dc2626;
            padding: 16px;
            border-radius: 12px;
            font-size: 14px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .alert svg {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
            margin-top: 2px;
        }

        /* Form & Card */
        .form-section {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .symptoms-card {
            background-color: var(--bg-card);
            border-radius: 16px;
            padding: 20px;
            border: 1px solid var(--border-light);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02);
        }

        /* GRID 2x2 UNTUK GEJALA */
        .symptoms-list {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }

        /* Checkbox Item Styling */
        .symptom-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 14px;
            border-radius: 10px;
            border: 1px solid var(--border-light);
            cursor: pointer;
            transition: all 0.2s ease;
            background-color: #fafbfc;
        }

        /* Hover berwana sedikit tapi tetap calm */
        .symptom-item:hover {
            border-color: var(--secondary);
            background-color: var(--secondary-light);
        }

        /* Hide Native Checkbox */
        .symptom-item input[type="checkbox"] {
            display: none;
        }

        /* Custom Checkbox UI */
        .checkbox-custom {
            width: 20px;
            height: 20px;
            border-radius: 6px;
            border: 1px solid #cbd5e1;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            margin-top: 2px;
            transition: all 0.2s ease;
            background-color: var(--bg-card);
        }

        .checkbox-custom svg {
            width: 12px;
            height: 12px;
            fill: none;
            stroke: white;
            stroke-width: 2.5;
            stroke-linecap: round;
            stroke-linejoin: round;
            opacity: 0;
            transition: opacity 0.2s ease;
        }

        /* Checked State Styling */
        .symptom-item:has(input[type="checkbox"]:checked) {
            background-color: var(--primary-light);
            border-color: var(--primary);
        }

        .symptom-item:has(input[type="checkbox"]:checked) .checkbox-custom {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .symptom-item:has(input[type="checkbox"]:checked) .checkbox-custom svg {
            opacity: 1;
        }

        .symptom-item:has(input[type="checkbox"]:checked) .symptom-name {
            color: var(--primary);
            font-weight: 600;
        }

        /* Typography inside Card */
        .symptom-content {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .symptom-name {
            font-size: 13.5px;
            font-weight: 500;
            color: var(--text-main);
            transition: all 0.2s ease;
        }

        .symptom-code {
            font-size: 12px;
            color: var(--text-muted);
        }

        /* Call to Action Area */
        .action-area {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: var(--bg-card);
            padding: 16px 20px;
            border-radius: 12px;
            border: 1px solid var(--border-light);
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 10px 24px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s ease;
            font-family: inherit;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
        }

        .disclaimer {
            font-size: 13px;
            color: var(--text-light);
        }

        /* Responsive Breakpoints */
        @media (max-width: 768px) {
            .container {
                padding: 0 16px;
            }
            .symptoms-card {
                padding: 16px;
            }
            /* Tablet masih oke 2 kolom, tapi kalau layar mulai kecil, jadikan 1 kolom */
            .symptoms-list {
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            }
        }

        @media (max-width: 600px) {
            .symptoms-list {
                grid-template-columns: 1fr; /* Jadi 1 kolom di HP biar gak sempit */
            }
            .action-area {
                flex-direction: column;
                align-items: stretch;
                gap: 16px;
                text-align: center;
            }
            .btn-primary {
                width: 100%;
            }
        }
    </style>
</head>
<body>

    <!-- Sticky Header -->
    <header class="top-header">
        <div class="container header-inner">
            <div class="header-logo">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                </svg>
            </div>
            <span class="header-brand">Sistem Pakar Lambung</span>
        </div>
    </header>

    <main class="main-content container">
        
        <div class="heading-section">
            <div class="badge">
                <span class="badge-dot"></span>
                Pemeriksaan Awal
            </div>
            <h1 class="page-title">Pilih Gejala yang Dirasakan</h1>
            <p class="page-subtitle">Centang keluhan yang sesuai dengan kondisi Anda saat ini untuk dianalisis.</p>
        </div>

        @if(session('error'))
        <div class="alert">
            <svg fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
            </svg>
            <span>{{ session('error') }}</span>
        </div>
        @endif

        <form action="{{ route('diagnosa.hitung') }}" method="POST" class="form-section">
            @csrf

            <div class="symptoms-card">
                <!-- GRID 2 KOLOM -->
                <div class="symptoms-list">
                    @foreach($gejalas as $gejala)
                    <label class="symptom-item">
                        <input type="checkbox" name="gejala[]" value="{{ $gejala->id }}">
                        
                        <div class="checkbox-custom">
                            <svg viewBox="0 0 12 10">
                                <path d="M1 5l4 4L11 1"/>
                            </svg>
                        </div>

                        <div class="symptom-content">
                            <span class="symptom-name">{{ $gejala->nama }}</span>
                            <span class="symptom-code">{{ $gejala->kode }}</span>
                        </div>
                    </label>
                    @endforeach
                </div>
            </div>

            <div class="action-area">
                <button type="submit" class="btn-primary">
                    Mulai Diagnosa
                </button>
                <span class="disclaimer">Hasil bersifat indikatif, bukan diagnosis medis resmi.</span>
            </div>
        </form>

    </main>

</body>
</html>