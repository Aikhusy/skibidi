@extends('layouts.app')
@section('title', 'Dashboard')
@section('dynamicRoute')
    {{ route('barang.index') }}
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Invoice</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4>LIST INVOICE</h4>
                    <div class="card-header-action">
                        <a href="{{ route('nota_baru.create') }}" class="btn btn-primary">Nota Kosong</a>
                        <a href="{{ route('invoice.create') }}" class="btn btn-primary">Tambah Baru</a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>Nomor</th>
                                    <th>Tanggal</th>
                                    <th>Metode</th>
                                    <th>Bank</th>
                                    <th>Pegawai</th>
                                    <th>Pemesan </th>
                                    <th>Action</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($items)
                                    @foreach ($items as $i)
                                        <tr>
                                            <td>{{ $i->nomor_invoice }}</td>
                                            <td>{{ $i->tanggal }}</td>
                                            <td>{{ $i->is_cash ? 'Cash' : 'Transfer' }}</td>
                                            <td>{{ optional($i->bank)->nama_bank ?? 'N/A' }}</td>
                                            <td>{{ optional($i->pegawai)->name ?? 'N/A' }}</td>
                                            <td>{{ optional($i->pemesan)->nama_pemesan ?? 'N/A' }}</td>

                                            <td>
                                                <a href="{{ route('nota_baru.edit', ['nota_baru' => $i->id]) }}"
                                                    class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title=""
                                                    data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"><i
                                                        class="fas fa-trash"></i></button>
                                            </td>
                                            <td>
                                                <a href="{{ route('transaksi.index', ['id' => $i->id]) }}"
                                                    class="btn btn-success btn-action mr-1" data-toggle="tooltip" title=""
                                                    data-original-title="Edit"><i class="fa fa-shopping-basket"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endisset
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            @include('layouts.pagination')
        </div>
    </section>
@endsection
