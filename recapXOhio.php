<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
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

    public function getInvoiceAndTransactions($year, $month)
    {
        
        self::initializeYears();

        if (!in_array($year, self::$years) && !in_array($month, self::$monthInNumber)){
            return view('fanumtax.showChoosen')->with('bulan', self::$months)->with('tahun', self::$years);
        }

        $monthNumber = array_search($month, self::$months) + 1;

        $dataInvoice = DB::table('invoice')->whereMonth('tanggal', $monthNumber)->whereYear('tanggal', $year)->get();

        $idInvoice = $dataInvoice->pluck('id')->all();

        $dataTransaksi = DB::table('transaksi')->whereIn('FK_kodeInvoice', $idInvoice)->get();

        return view('fanumtax.showChoosen', ['invoices' => $dataInvoice, 'transactions' => $dataTransaksi, 'bulan' => self::$months, 'tahun'=> self::$years]);
    }

    public function fanumTaxing()
    {
        self::initializeYears();
        
        return view('fanumtax.showChoosen')->with('bulan', self::$months)->with('tahun', self::$years);
    }
}
