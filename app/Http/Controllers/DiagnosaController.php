<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gejala;
use App\Models\Penyakit;
use App\Models\Rule;

class DiagnosaController extends Controller
{
    public function index()
    {
        $gejalas = Gejala::all();
        return view('diagnosa.index', compact('gejalas'));
    }

    public function hitung(Request $request)
    {
        $selectedGejalaIds = $request->input('gejala', []);

        if (empty($selectedGejalaIds)) {
            return back()->with('error', 'Omaigat! Kamu belum milih gejala satupun nih. Pilih dulu yuk!');
        }

        $gejalas = Gejala::whereIn('id', $selectedGejalaIds)->get();

        // 1. TRIASE (Filter Red Flag)
        foreach ($gejalas as $gejala) {
            if ($gejala->status == 'RED FLAG') {
                return view('diagnosa.darurat', compact('gejala'));
            }
        }

        // 2. INFERENSI CERTAINTY FACTOR (CF)
        $cf_results = [];
        $riwayat_perhitungan = []; 
        $penyakits = Penyakit::all();

        foreach ($penyakits as $penyakit) {
            $rules = Rule::where('penyakit_id', $penyakit->id)
                         ->whereIn('gejala_id', $selectedGejalaIds)
                         ->get();

            if ($rules->count() > 0) {
                $cf_combine = 0;
                $langkah_detail = []; 
                
                foreach ($rules as $index => $rule) {
                    $cf_baru = $rule->bobot_pakar * 1; // CF User dianggap 1 (Sangat Yakin)
                    $nama_gejala = $gejalas->where('id', $rule->gejala_id)->first()->nama;

                    if ($index == 0) {
                        $cf_combine = $cf_baru; 
                        $langkah_detail[] = "Gejala 1: [{$nama_gejala}] -> CF Pakar = {$cf_baru}. <br> <b>CF_Combine Pertama = {$cf_combine}</b>";
                    } else {
                        $cf_lama = $cf_combine;
                        $cf_combine = $cf_combine + ($cf_baru * (1 - $cf_combine));
                        $langkah_detail[] = "Gejala ".($index+1).": [{$nama_gejala}] -> CF Pakar = {$cf_baru}. <br> Rumus: CF_Lama + CF_Baru * (1 - CF_Lama) <br> {$cf_lama} + {$cf_baru} * (1 - {$cf_lama}) <br> <b>CF_Combine = " . round($cf_combine, 4) . "</b>";
                    }
                }
                
                $cf_results[$penyakit->id] = $cf_combine * 100;
                
                // Simpan log perhitungan untuk UI
                $riwayat_perhitungan[$penyakit->id] = [
                    'penyakit' => $penyakit->nama,
                    'langkah' => $langkah_detail,
                    'hasil_akhir' => round($cf_combine * 100, 2)
                ];
            }
        }

        // Cek jika tidak ada gejala yang cocok dengan rule manapun
        if (empty($cf_results)) {
            return view('diagnosa.tidak_spesifik', ['nilaiCF' => 0]);
        }

        // Urutkan hasil dari persentase terbesar
        arsort($cf_results);
        
        $top_penyakit_id = array_key_first($cf_results);
        $top_cf_value = $cf_results[$top_penyakit_id];
        $penyakit_terdiagnosa = Penyakit::with('obats')->find($top_penyakit_id);

        // 3. THRESHOLD (< 40%) - Jika keyakinan rendah, tampilkan halaman tidak spesifik
        if ($top_cf_value < 40) {
            $nilaiCF = $top_cf_value / 100; // Dikirim sebagai desimal agar sesuai rumus di Blade
            return view('diagnosa.tidak_spesifik', compact('nilaiCF'));
        }

        // Sinkronisasi urutan riwayat log dengan hasil ranking
        $riwayat_sorted = [];
        foreach ($cf_results as $p_id => $val) {
            $riwayat_sorted[] = $riwayat_perhitungan[$p_id];
        }

        // 4. BPOM FILTER (Klasifikasi Jenis Obat)
        $obat_bebas = $penyakit_terdiagnosa->obats->where('golongan', 'Obat Bebas/Swamedikasi');
        $obat_keras = $penyakit_terdiagnosa->obats->where('golongan', 'Obat Keras/Wajib Resep');

        return view('diagnosa.hasil', compact(
            'penyakit_terdiagnosa', 
            'top_cf_value', 
            'obat_bebas', 
            'obat_keras',
            'riwayat_sorted'
        ));
    }
}