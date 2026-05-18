<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;

class ArtikelController extends Controller
{
    public function index()
    {
        $artikel = Artikel::all();
        return view('admin.artikel.index', compact('artikel'));
    }

    public function create()
    {
        return view('admin.artikel.create');
    }

    public function store(Request $r)
    {
        Artikel::create($r->all());
        return redirect()->route('artikel.index');
    }

    public function edit(Artikel $artikel)
    {
        return view('admin.artikel.edit', compact('artikel'));
    }

    public function update(Request $r, Artikel $artikel)
    {
        $artikel->update($r->all());
        return redirect()->route('artikel.index');
    }

    public function destroy(Artikel $artikel)
    {
        $artikel->delete();
        return back();
    }

    public function publish($id)
    {
        $artikel = Artikel::findOrFail($id);
        $artikel->status = 'tayang';
        $artikel->save();
        return back();
    }
}