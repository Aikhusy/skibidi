<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Barang;
use App\Models\Invoice;
use App\Models\Pemesan;
use Carbon\Carbon;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;

class SkibidiXGoons extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $newEmptyInvoice = new Invoice();

        $randomNumbers = str_pad(rand(0, 99), 2, '0', STR_PAD_LEFT);

        $randomLetter = chr(rand(65, 90)); 

        $kode_inv = 'INV' . $randomNumbers . $randomLetter . date('Ymd') . date('His');

        $newEmptyInvoice['nomor_invoice'] = $kode_inv;

        $newEmptyInvoice->save();

        return redirect()->route('nota_baru.edit', ['nota_baru' => $newEmptyInvoice->id]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //

        $invoice = Invoice::find($id);

        $barangs = Barang::all();

        $banks = Bank::all();

        $pemesan = Pemesan::all();

        return view('nota_baru/home')->with(['barangs' => $barangs, 'banks' => $banks, 'pemesans' => $pemesan, 'invoice' => $invoice]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $nota_baru)
    {
        //
        
        $validated_data = $request->validate([
            'tanggal' => 'required|date|date_format:Y-m-d|after_or_equal:' . Carbon::today()->format('Y-m-d'),
            'is_cash' => 'required|boolean',
            'FK_bank' => 'required',
            'FK_pegawai' => 'required',
            'FK_pemesan' => 'required',
        ]);

        $invoice=Invoice::find($nota_baru);

        $invoice->update($validated_data);
        
        // dd($request);

        return redirect()->route('nota_baru.edit' ,['nota_baru' => $invoice->id])->with('success', 'data berhasil disimpan');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function userStore(Request $request, String $id)
    {
        $validated_data = $request->validate([
            'nama_pemesan' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'kota' => 'required',
        ]);

        Pemesan::create($validated_data);

        $invoice=Invoice::find($id);

        return redirect()->route('nota_baru.edit' ,['nota_baru' => $invoice])->with('success', 'data berhasil disimpan');
    }
}
