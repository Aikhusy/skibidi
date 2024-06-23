<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RecapXFanumTaxSkibidi extends Controller
{
    public static $months = [

        'January', 'February', 'March', 'April', 'May', 'June', 
        'July', 'August', 'September', 'October', 'November', 'December'

    ];
    public static $years = [];

    public static $monthInNumber = [1,2,3,4,5,6,7,8,9,10,11,12];

    public static function initializeYears()
    {
        $currentYear = Carbon::now()->year;
        for ($year = 2021; $year <= $currentYear; $year++) {
            self::$years[] = $year;
        }
    }

    public function getInvoiceAndTransactions($month)
    {
        
        self::initializeYears();

        if (!in_array($month, self::$months)){
            return redirect()->route('rekap.index');
        }

        $monthNumber = array_search($month, self::$months)+1;
        $data=[];
        foreach (self::$years as $year) {
            $dataInvoice = DB::table('invoice')->whereMonth('tanggal', $monthNumber)->whereYear('tanggal',$year)->get();

            foreach ($dataInvoice as $invoice) {

                $idInvoice = $invoice->id;
                $kodeInvoice = $invoice->nomor_invoice;
                $dataTransaksi = Transaksi::where('fk_kode_invoice', $idInvoice)->get();
                
                $data[$year][$kodeInvoice] = $dataTransaksi;

            }
        }

        return view('fanumtax.showChoosen', ['datas' => $data]);
    }

}
