<?php

use App\Http\Controllers\RecapXFanumTaxSkibidi;

// route::XX(XX,XX);
Route::middleware(['auth'])->group(function () {
    // route::XX(XX,XX);
    // route::XX(XX,XX);
    // route::XX(XX,XX);
    Route::get('fanum', [RecapXFanumTaxSkibidi::class, 'fanumTaxing']);
    Route::get('fanumWithTax/{month}/{ye    ar}', [RecapXFanumTaxSkibidi::class, 'getInvoiceAndTransactions'])->name('skibidi');

});