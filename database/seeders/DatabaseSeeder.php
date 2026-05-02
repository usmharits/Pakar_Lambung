<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Penyakit;
use App\Models\Gejala;
use App\Models\Rule;
use App\Models\Obat;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 1. DATA PENYAKIT
        $penyakits = [
            ['kode' => 'P01', 'nama' => 'Gastroesophageal Reflux Disease (GERD)'],
            ['kode' => 'P02', 'nama' => 'Gastritis (Maag)'],
            ['kode' => 'P03', 'nama' => 'Dispepsia Fungsional'],
            ['kode' => 'P04', 'nama' => 'Ulkus Peptikum (Tukak Lambung) - Kritis'],
            ['kode' => 'P05', 'nama' => 'Karsinoma Gaster - Kritis'],
        ];
        foreach ($penyakits as $p) Penyakit::create($p);

        // 2. DATA GEJALA & TRIASE
        $gejalas = [
            ['kode' => 'G01', 'nama' => 'Rasa panas terbakar di area dada (Heartburn)', 'status' => 'AMAN'],
            ['kode' => 'G02', 'nama' => 'Mulut terasa pahit atau sangat asam', 'status' => 'AMAN'],
            ['kode' => 'G03', 'nama' => 'Nyeri perih tajam di bagian ulu hati', 'status' => 'AMAN'],
            ['kode' => 'G04', 'nama' => 'Perut terasa penuh, kembung, sering bersendawa', 'status' => 'AMAN'],
            ['kode' => 'G05', 'nama' => 'Merasa mual dan rasa ingin muntah setelah makan', 'status' => 'AMAN'],
            ['kode' => 'G06', 'nama' => 'Muntah cairan pekat bercampur darah', 'status' => 'RED FLAG'],
            ['kode' => 'G07', 'nama' => 'Warna feses berubah hitam menyengat', 'status' => 'RED FLAG'],
            ['kode' => 'G08', 'nama' => 'Sulit menelan makanan (Disfagia)', 'status' => 'RED FLAG'],
            ['kode' => 'G09', 'nama' => 'Penurunan berat badan secara drastis', 'status' => 'RED FLAG'],
        ];
        foreach ($gejalas as $g) Gejala::create($g);

        // 3. DATA ATURAN PAKAR (CF)
        $rules = [
            ['penyakit_id' => 1, 'gejala_id' => 1, 'bobot_pakar' => 0.90],
            ['penyakit_id' => 1, 'gejala_id' => 2, 'bobot_pakar' => 0.80],
            ['penyakit_id' => 2, 'gejala_id' => 3, 'bobot_pakar' => 0.85],
            ['penyakit_id' => 3, 'gejala_id' => 4, 'bobot_pakar' => 0.70],
            ['penyakit_id' => 4, 'gejala_id' => 6, 'bobot_pakar' => 0.95],
            ['penyakit_id' => 4, 'gejala_id' => 7, 'bobot_pakar' => 0.90],
        ];
        foreach ($rules as $r) Rule::create($r);

        // 4. DATA OBAT KLASIFIKASI BPOM (REVISI KE GOLONGAN FARMAKOLOGI)
        $obats = [
            // Golongan Obat Bebas (Swamedikasi)
            ['nama' => 'Antasida (Penetral Asam Lambung)', 'golongan' => 'Obat Bebas/Swamedikasi'],
            ['nama' => 'Bismut Subsalisilat (Pelindung Ringan Mukosa Lambung)', 'golongan' => 'Obat Bebas/Swamedikasi'],
            
            // Golongan Obat Keras (Wajib Resep)
            ['nama' => 'Proton Pump Inhibitor / PPI (Penekan Produksi Asam Kuat)', 'golongan' => 'Obat Keras/Wajib Resep'],
            ['nama' => 'H2-Receptor Antagonist / H2 Blocker (Pengurang Asam Lambung)', 'golongan' => 'Obat Keras/Wajib Resep'],
            ['nama' => 'Prokinetik (Pemercepat Pengosongan Lambung)', 'golongan' => 'Obat Keras/Wajib Resep'],
            ['nama' => 'Sitoprotektor (Pelapis Ekstra untuk Luka Lambung)', 'golongan' => 'Obat Keras/Wajib Resep'],
            ['nama' => 'Antibiotik Khusus (Eradikasi Bakteri H. pylori)', 'golongan' => 'Obat Keras/Wajib Resep'],
        ];
        foreach ($obats as $o) Obat::create($o);

        // 5. MAPPING GOLONGAN OBAT KE PENYAKIT (SANGAT DETAIL & AKURAT)
        
        // P01 (GERD) -> Butuh penetral asam, penekan asam, dan pendorong makanan
        Penyakit::where('kode', 'P01')->first()->obats()->attach([
            1, // Antasida (Bebas)
            3, // PPI (Keras)
            4, // H2 Blocker (Keras)
            5  // Prokinetik (Keras)
        ]);

        // P02 (Gastritis) -> Butuh penetral asam, penekan asam, dan pelapis radang
        Penyakit::where('kode', 'P02')->first()->obats()->attach([
            1, // Antasida (Bebas)
            3, // PPI (Keras)
            4, // H2 Blocker (Keras)
            6  // Sitoprotektor (Keras)
        ]);

        // P03 (Dispepsia Fungsional) -> Butuh penetral, pelindung ringan, dan pemercepat pencernaan
        Penyakit::where('kode', 'P03')->first()->obats()->attach([
            1, // Antasida (Bebas)
            2, // Bismut Subsalisilat (Bebas)
            3, // PPI (Keras)
            5  // Prokinetik (Keras)
        ]);

        // P04 (Ulkus Peptikum) -> Kritis! Butuh penekan asam kuat, pelapis luka, & pembunuh bakteri
        // Tidak disarankan swamedikasi bebas
        Penyakit::where('kode', 'P04')->first()->obats()->attach([
            3, // PPI (Keras)
            6, // Sitoprotektor (Keras)
            7  // Antibiotik Khusus (Keras)
        ]);
        
        // P05 (Karsinoma) tidak di-mapping ke obat karena 100% harus ditangani Onkologi.
    }
}