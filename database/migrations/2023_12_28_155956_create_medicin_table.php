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
        Schema::create('medicin', function (Blueprint $table) {
            $table->id();
            $table->string('nama_obat');
            $table->string('harga');
            $table->text('deskripsi');
            $table->string('efek_samping');
            $table->string('golongan');
            $table->string('noregis');
            $table->integer('stock');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicin');
    }
};
