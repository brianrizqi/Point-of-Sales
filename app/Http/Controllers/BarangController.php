<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Kategori;
use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = Barang::join('suppliers', function ($join) {
                $join->on('barangs.id_supplier', '=', 'suppliers.id');
            })
            ->join('kategoris', function ($join) {
                $join->on('barangs.id_kategori', '=', 'kategoris.id_kategori');
            })
            ->get();
        return view('barang', ['barang' => $barang]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $supplier = Supplier::all();
        $kategori = DB::table('kategoris')->get();
        return view('create_barang', ['supplier' => $supplier, 'kategori' => $kategori]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_barang' => 'required|string|max:255',
            'id_supplier' => 'required|integer',
            'id_kategori' => 'required|integer',
            'harga_beli' => 'required|integer',
            'harga_jual' => 'required|integer',
            'ukuran' => 'required|string',
            'stok' => 'required|integer'
        ]);
        $barang = new Barang();
        $barang->nama_barang = $request->nama_barang;
        $barang->id_kategori = $request->id_kategori;
        $barang->id_supplier = $request->id_supplier;
        $barang->harga_beli = $request->harga_beli;
        $barang->harga_jual = $request->harga_jual;
        $laba = (($request->harga_jual - $request->harga_beli) / $request->harga_beli) * 100;
        $barang->laba = $laba;
        $barang->ukuran = $request->ukuran;
        $barang->stok = $request->stok;
        $barang->save();
        return redirect('barang');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Barang $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Barang $barang
     * @return \Illuminate\Http\Response
     */
    public function edit($id_barang)
    {
        $supplier = Supplier::all();
        $kategori = DB::table('kategoris')->get();
        $barang = DB::table('barangs')
            ->join('suppliers', function ($join) {
                $join->on('barangs.id_supplier', '=', 'suppliers.id');
            })
            ->join('kategoris', function ($join) {
                $join->on('barangs.id_kategori', '=', 'kategoris.id_kategori');
            })
            ->where('id_barang', $id_barang)->first();
        return view('edit_barang', ['barang' => $barang], ['supplier' => $supplier, 'kategori' => $kategori]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Barang $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_barang' => 'required|string|max:255',
            'id_supplier' => 'required|integer',
            'id_kategori' => 'required|integer',
            'harga_beli' => 'required|integer',
            'harga_jual' => 'required|integer',
            'ukuran' => 'required|string',
            'stok' => 'required|integer'
        ]);
        $laba = (($request->harga_jual - $request->harga_beli) / $request->harga_beli) * 100;
        $barang = DB::table('barangs')
            ->where('id_barang', $id)->
            update([
                'nama_barang' => $request->nama_barang,
                'id_kategori' => $request->id_kategori,
                'id_supplier' => $request->id_supplier,
                'harga_beli' => $request->harga_beli,
                'harga_jual' => $request->harga_jual,
                'laba' => $laba,
                'ukuran' => $request->ukuran,
                'stok' => $request->stok
            ]);
        return redirect('barang');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Barang $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Barang::where('id_barang',$id);
        $supplier->delete();
        return redirect('barang');
    }
}
