<?php

namespace App\Services;

use App\Models\ScoringRule;

class TbRiskScoringService
{
    public function calculate(array $answers): array
    {
        $answers = collect($answers)->mapWithKeys(fn ($value, $key) => [(string) $key => (bool) $value])->all();
        $rules = ScoringRule::query()->where('is_active', true)->orderBy('sort_order')->get();

        $hasGateSymptom = $rules
            ->where('is_gate', true)
            ->contains(fn (ScoringRule $rule) => ($answers[$rule->code] ?? false) === true);

        if (! $hasGateSymptom) {
            return [
                'score' => 0,
                'level' => 'rendah',
                'recommendation' => 'Edukasi pencegahan TBC, catat data warga, jadwalkan skrining ulang 6 bulan kemudian.',
                'matched_rules' => [],
            ];
        }

        $matched = [];
        $score = 0;

        foreach ($rules as $rule) {
            if (($answers[$rule->code] ?? false) === true) {
                $score += $rule->score;
                $matched[] = [
                    'code' => $rule->code,
                    'label' => $rule->label,
                    'score' => $rule->score,
                ];
            }
        }

        $level = match (true) {
            $score >= 8 => 'tinggi',
            $score >= 4 => 'sedang',
            default => 'rendah',
        };

        $recommendation = match ($level) {
            'tinggi' => 'Segera arahkan ke klinik/faskes untuk pemeriksaan dahak atau rontgen dada. Tampilkan klinik terdekat dari direktori.',
            'sedang' => 'Catat dan pantau, sarankan ke Puskesmas terdekat, jadwalkan skrining ulang 1 bulan kemudian.',
            default => 'Edukasi pencegahan TBC, catat data warga, jadwalkan skrining ulang 6 bulan kemudian.',
        };

        return compact('score', 'level', 'recommendation', 'matched');
    }
}
