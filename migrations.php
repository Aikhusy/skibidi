<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->integer('harga');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('jenis_kendaraan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_jenis');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('pemesan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pemesan');
            $table->string('alamat');
            $table->string('no_telp');
            $table->string('kota');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('pegawai', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pegawai');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('invoice', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_invoice');
            $table->date('tanggal')->nullable();
            $table->boolean('is_cash')->nullable(); // 1(true) = cash, 0(false) = transfer
            $table->unsignedBigInteger('FK_bank')->nullable();
            $table->unsignedBigInteger('FK_pegawai')->nullable();
            $table->unsignedBigInteger('FK_pemesan')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('FK_kode_invoice');
            $table->unsignedBigInteger('FK_kode_barang');
            $table->integer('jumlah');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('bank', function (Blueprint $table) {
            $table->id();
            $table->string('nama_bank');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('pengirim', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pengirim');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('penerima', function (Blueprint $table) {
            $table->id();
            $table->string('nama_penerima');
            $table->softDeletes();
            $table->timestamps();
        });


        Schema::create('tanda_terima', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('FK_kode_invoice');
            $table->date('tanggal');
            $table->unsignedBigInteger('FK_jenis_kendaraan');
            $table->string('plat');
            $table->unsignedBigInteger('FK_pegawai');
            $table->unsignedBigInteger('FK_pengirim');
            $table->unsignedBigInteger('FK_penerima');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
        Schema::dropIfExists('jenis_kendaraan');
        Schema::dropIfExists('pemesan');
        Schema::dropIfExists('pegawai');
        Schema::dropIfExists('invoice');
        Schema::dropIfExists('transaksi');
        Schema::dropIfExists('bank');
        Schema::dropIfExists('pengirim');
        Schema::dropIfExists('pengirim');
        Schema::dropIfExists('tanda_terima');
    }
};
