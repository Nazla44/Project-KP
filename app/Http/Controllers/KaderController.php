<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kader;
use App\Models\Klinik;

class KaderController extends Controller
{
    public function index()
    {
        $kaders = Kader::with('klinik')->get();
        return view('admin.kader.index', compact('kaders'));
    }

    public function create()
    {
        $klinik = Klinik::all();
        return view('admin.kader.create', compact('klinik'));
    }

    public function store(Request $r)
    {
        Kader::create($r->all());
        return redirect()->route('kader.index');
    }

    public function edit(Kader $kader)
    {
        $klinik = Klinik::all();
        return view('admin.kader.edit', compact('kader', 'klinik'));
    }

    public function update(Request $r, Kader $kader)
    {
        $kader->update($r->all());
        return redirect()->route('kader.index');
    }

    public function destroy(Kader $kader)
    {
        $kader->delete();
        return back();
    }

    public function verifikasi($id)
    {
        $kader = Kader::findOrFail($id);
        $kader->status = 'aktif';
        $kader->save();
        return back();
    }
}