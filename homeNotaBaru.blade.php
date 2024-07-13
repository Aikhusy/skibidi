@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
    {{-- pop up form untuk add barang --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Input Pesanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('transaksi.store') }}" method="post">
                        @csrf
                        <div class=" form-group">
                            <label>Barang</label>
                            <input type="hidden" name="FK_kode_invoice" value={{$invoice->id}}>
                            <select name="FK_kode_barang" class="form-control select2 select2-hidden-accessible"
                                tabindex="-1" aria-hidden="true">
                                @forelse ($barangs as $barang)
                                    <option value="{{ $barang->id }}">
                                        {{ $barang->nama_barang }}
                                    </option>
                                @empty
                                    <option value="" disabled>
                                        Kosong
                                    </option>
                                @endforelse
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Quantity</label>
                            <input type="number" min=0 class="form-control" name="jumlah">
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>

    {{-- pop up form untuk add pemesan baru --}}
    <div class="modal fade" id="inputNewPemesan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Pemesan Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="{{ route('nota_baru.userStore', ['id' => $invoice->id]) }}" method="post">
                        @csrf
                        <div class=" form-group">
                            <label for="message-text" class="col-form-label">Nama Pemesan</label>
                            <input type="text" class="form-control" name="nama_pemesan" placeholder="Nama Pemesan">
                        </div>

                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Alamat</label>
                            <input type="text" class="form-control" name="alamat" placeholder="Alamat">
                        </div>

                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Nomor Telepon</label>
                            <input type="text" class="form-control" name="no_telp" placeholder="No Telepon">
                        </div>

                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Kota</label>
                            <input type="text" class="form-control" name="kota" placeholder="Kota">
                        </div>

                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>

    {{-- Body --}}
    <section class="section">
        <div class="section-header">
            <h1>Invoice</h1>
            <div class="section-header-breadcrumb">
            </div>
        </div>

        <div class="section-body">
            <div class="invoice">
                <div class="invoice-print">
                    <form action="{{ route('nota_baru.update', ['nota_baru' => $invoice->id]) }}" method="post">
                        @csrf
                        @method('PATCH')

                        <input type="hidden" name="FK_pegawai" value="{{ auth()->user()->id }}">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="invoice-title">
                                    <h2>Invoice</h2>
                                    <div class="invoice-number">Order #{{ $invoice->nomor_invoice }}</div>
                                </div>
                                <hr>

                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Pemesan</label>

                                            <div class="d-flex align-items-center">

                                                <select name="FK_pemesan"
                                                    class="form-control select2 @error('FK_pemesan') is-invalid @enderror">
                                                    @forelse ($pemesans as $p)
                                                        <option value="{{ $p->id }}"
                                                            {{ $invoice->FK_pemesan == $p->id ? 'selected' : '' }}>
                                                            {{ $p->nama_pemesan }}
                                                        </option>
                                                    @empty
                                                        <option value="" disabled>Kosong</option>
                                                    @endforelse
                                                </select>
                                                @error('FK_pemesan')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror

                                                <button type="button" class="btn btn-primary ml-2" data-toggle="modal"
                                                    data-target="#inputNewPemesan" data-whatever="">+</button>
                                                <p class="section-lead mb-0 ml-2">Tambah data Pembeli</p>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <address>

                                            <strong>Payment Method:</strong><br>

                                            <div class="form-group">
                                                <label>Metode Pembayaran</label>
                                                <select name="is_cash"
                                                    class="form-control select2 select2-hidden-accessible" tabindex="-1"
                                                    aria-hidden="true" id="isCash">
                                                    <option value="1"
                                                        @if ($invoice->is_cash == 1) selected @endif>Cash</option>
                                                    <option value="0"
                                                        @if ($invoice->is_cash == 0) selected @endif>Transfer</option>
                                                </select>

                                            </div>

                                            <div class="form-group" id="bank">
                                                <label>Bank</label>
                                                <select name="FK_bank"
                                                    class="form-control select2 @error('FK_bank') is-invalid @enderror">
                                                    @forelse ($banks as $b)
                                                        <option value="{{ $b->id }}"
                                                            {{ $invoice->FK_bank == $b->id ? 'selected' : '' }}>
                                                            {{ $b->nama_bank }}
                                                        </option>
                                                    @empty
                                                        <option value="" disabled>Kosong</option>
                                                    @endforelse
                                                </select>
                                                @error('FK_bank')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                        </address>
                                    </div>
                                    <div class="col-4"></div>
                                    <div class="col-md-4 text-md-right">
                                        <address>
                                            <strong>Order Date:</strong><br>
                                            <div class="form-group">
                                                <label>Tanggal</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-calendar"></i>
                                                        </div>
                                                    </div>

                                                    <input type="date"
                                                        class="form-control datepicker @error('tanggal') is-invalid @enderror"
                                                        name="tanggal"
                                                        value="{{ old('tanggal', $invoice->tanggal ?? '') }}"
                                                        id="tanggal" />

                                                </div>
                                            </div>
                                        </address>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success btn-action mt-4" data-toggle="tooltip"
                            title="Save Info">
                            <i class="fas fa-save"></i> Save
                        </button>
                    </form>


                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="section-title ">Barang Pesanan</div>

                            <div class="row">
                                <p class="ml-3"><button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#exampleModal" data-whatever="">+</button>
                                    Tambah Barang Pesanan</p>
                            </div>
                            {{-- POP UP FORM --}}


                            {{-- table --}}
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-md">
                                    <thead>
                                        <tr>
                                            <th data-width="40">#</th>
                                            <th class="text-center">Item</th>
                                            <th class="text-center">Price</th>
                                            <th class="text-center">Quantity</th>
                                            <th class="text-right">Totals</th>
                                            <th class="text-right">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $total = 0; @endphp
                                        @isset($transaksi)
                                            @foreach ($transaksi as $index => $t)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td class="text-center">{{ $t->barang->nama_barang }}</td>
                                                    <td class="text-center">{{ $t->barang->harga }}</td>
                                                    <td class="text-center">{{ $t->jumlah }}</td>
                                                    <td class="text-right">{{ $t->jumlah * $t->barang->harga }}</td>
                                                    <td class="text-right">
                                                        <form action="{{ route('transaksi.destroy', $t) }}" method="POST"
                                                            onsubmit="return confirm('Are you sure you want to delete this item?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-action"
                                                                data-toggle="tooltip" title="Delete">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>

                                                </tr>
                                                @php $total+=($t->jumlah * $t->barang->harga)@endphp
                                            @endforeach
                                        @endisset
                                    </tbody>
                                </table>
                            </div>
                            <div class="row mt-4">
                                <div class="col-lg-8">
                                </div>
                                <div class="col-lg-4 text-right">
                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name">Subtotal</div>
                                        <div class="invoice-detail-value">Rp {{ $total }} </div>
                                    </div>
                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name">Shipping</div>
                                        <div class="invoice-detail-value">Rp {{ 0 }}</div>
                                    </div>
                                    <hr class="mt-2 mb-2">
                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name">Total</div>
                                        <div class="invoice-detail-value invoice-detail-value-lg">Rp {{ $total }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <hr>
            </div>
        </div>

    </section>
@endsection


@push('customStyle')
    <script src="{{ asset('assets/js/page/forms-advanced-forms.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/select2/dist/css/select2.min.css') }}">
@endpush
@push('customScript')
    <script src="{{ asset('assets/select2/dist/js/select2.full.min.js') }}"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
@endpush

@push('customScript')
    {{-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script> --}}
    <script>
        // get value from select option
        $(document).ready(function() {
            $('#bank').hide();
            $('#isCash').on('change', function() {
                var isCash = $(this).val();
                if (isCash == 0) {
                    $('#bank').show();
                } else {
                    $('#bank option[value="1"]').attr('selected', 'selected');
                    $('#bank').hide();
                }
            });
        });
    </script>
@endpush

@push('customScript')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var today = new Date().toISOString().split('T')[0];
            document.getElementById('tanggal').setAttribute('min', today);
        });
    </script>
@endpush
