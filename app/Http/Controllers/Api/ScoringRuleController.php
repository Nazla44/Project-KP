<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ScoringRule;
use Illuminate\Http\JsonResponse;

class ScoringRuleController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'message' => 'Konfigurasi scoring berhasil diambil.',
            'data' => ScoringRule::query()->where('is_active', true)->orderBy('sort_order')->get(),
        ]);
    }
}
