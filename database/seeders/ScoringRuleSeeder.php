<?php

namespace Database\Seeders;

use App\Models\ScoringRule;
use Illuminate\Database\Seeder;

class ScoringRuleSeeder extends Seeder
{
    public function run(): void
    {
        $rules = [
            ['code' => 'batuk_2_minggu', 'label' => 'Batuk terus-menerus ≥ 2 minggu', 'group' => 'gejala_utama', 'score' => 3, 'is_gate' => true, 'sort_order' => 10],
            ['code' => 'demam_2_minggu', 'label' => 'Demam > 2 minggu', 'group' => 'gejala_utama', 'score' => 2, 'is_gate' => true, 'sort_order' => 20],
            ['code' => 'keringat_malam', 'label' => 'Keringat malam tanpa aktivitas', 'group' => 'gejala_utama', 'score' => 2, 'is_gate' => true, 'sort_order' => 30],
            ['code' => 'bb_turun', 'label' => 'Penurunan berat badan signifikan', 'group' => 'gejala_utama', 'score' => 2, 'is_gate' => true, 'sort_order' => 40],
            ['code' => 'batuk_darah', 'label' => 'Batuk darah atau hemoptisis', 'group' => 'faktor_pemberat', 'score' => 3, 'is_gate' => false, 'sort_order' => 50],
            ['code' => 'kontak_serumah', 'label' => 'Kontak serumah dengan pasien TBC aktif', 'group' => 'faktor_pemberat', 'score' => 3, 'is_gate' => false, 'sort_order' => 60],
            ['code' => 'dm_hiv', 'label' => 'Penyakit penyerta DM atau HIV', 'group' => 'faktor_pemberat', 'score' => 2, 'is_gate' => false, 'sort_order' => 70],
            ['code' => 'merokok_aktif', 'label' => 'Merokok aktif', 'group' => 'faktor_pemberat', 'score' => 1, 'is_gate' => false, 'sort_order' => 80],
            ['code' => 'lingkungan_padat', 'label' => 'Tinggal di lingkungan padat atau kumuh', 'group' => 'faktor_pemberat', 'score' => 1, 'is_gate' => false, 'sort_order' => 90],
        ];

        foreach ($rules as $rule) {
            ScoringRule::query()->updateOrCreate(['code' => $rule['code']], $rule);
        }
    }
}
