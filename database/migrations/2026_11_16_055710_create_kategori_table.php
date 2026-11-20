
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('kategori')) {
            Schema::create('kategori', function (Blueprint $table) {
                $table->id();
                $table->string('nama_kategori', 100);
                $table->text('deskripsi')->nullable();
                $table->timestamps();
            });
            return;
        }

        $deskripsi = !Schema::hasColumn('kategori', 'deskripsi');
        $created = !Schema::hasColumn('kategori', 'created_at');
        $updated = !Schema::hasColumn('kategori', 'updated_at');

        Schema::table('kategori', function (Blueprint $table) use ($deskripsi, $created, $updated) {
            if ($deskripsi) {
                $table->text('deskripsi')->nullable();
            }
            if ($created) {
                $table->timestamp('created_at')->nullable();
            }
            if ($updated) {
                $table->timestamp('updated_at')->nullable();
            }
        });
    }

    public function down(): void
    {
        // Mempertahankan tabel dan data kategori yang sudah ada.
    }
};
