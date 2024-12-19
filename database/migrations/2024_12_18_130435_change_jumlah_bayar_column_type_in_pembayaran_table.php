<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeJumlahBayarColumnTypeInPembayaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pembayaran', function (Blueprint $table) {
            $table->decimal('jumlah_bayar', 15, 2)->change();  // Mengubah tipe data menjadi decimal
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pembayaran', function (Blueprint $table) {
            $table->integer('jumlah_bayar')->nullable()->change();  // Mengembalikan ke tipe integer jika perlu rollback
        });
    }
}
