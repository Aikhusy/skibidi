{{-- home barang --}}
@extends('layouts.app')
@section('title', 'Dashboard')
@section('dynamicRoute')
    {{ route('barang.index') }}
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tabel Barang</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4>LIST TABEL BARANG</h4>
                    <div class="card-header-action">
                        <a href="{{ route('barang.create') }}" class="btn btn-primary">Tambah Baru</a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($items)
                                    @foreach ($items as $barang)
                                        <tr>
                                            <td>{{ $barang->id }}</td>
                                            <td>{{ $barang->nama_barang }}</td>
                                            <td>{{ $barang->harga }}</td>
                                            <td>
                                                <a href="{{ route('barang.edit', ['barang' => $barang]) }}"
                                                    class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title=""
                                                    data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                                <form action="{{ route('barang.destroy', ['barang' => $barang]) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"><i
                                                            class="fas fa-trash"></i></button>
                                                </form>
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
