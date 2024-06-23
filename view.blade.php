@extends('layouts.app')
@section('title', 'Rekap')

@section('content')
    <section class="section">
        <div class="section-body">
            <div class="card">
                @foreach ($datas as $year => $invoices)
                    <div class="card-header">
                        <h4>{{ $year }}</h4>
                    </div>
                    <div class="card-body">
                        <?php $totalKeseluruhan = 0; ?>
                        @foreach ($invoices as $invoiceId => $transactions)
                            <div class="card-header">
                                <h3>Invoice: {{ $invoiceId }}</h3>
                            </div>
                            <div class="card-body">

                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>Transaksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $total = 0; ?>
                                        @foreach ($transactions as $transaction)
                                            <tr style="margin-top:2px">
                                                <td>Nama: {{ $transaction->barang->nama_barang }}<br>
                                                    Harga: {{ $transaction->barang->harga }}<br>
                                                    Total: {{ $transaction->barang->harga * $transaction->jumlah }}
                                                </td>
                                                <?php $total += $transaction->barang->harga * $transaction->jumlah; ?>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="3" align="right">
                                                <h5>Total : {{ $total }}</h5>
                                                <?php $totalKeseluruhan += $total; ?>
                                            </td>
                                        </tr>
                                        
                                    </tbody>

                                </table>
                            </div>
                        @endforeach
                    </div>
                @endforeach
                <div class="card">
                    <div class="card-header">
                        <h2>
                            total Keseluruhan {{$totalKeseluruhan}}
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
