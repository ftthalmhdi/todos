<?php //Menandakan awal dari file PHP.

// Mengimpor tiga kelas utama yang digunakan dalam migrasi:
use Illuminate\Database\Migrations\Migration; //Kelas utama untuk membuat perubahan dalam database.
use Illuminate\Database\Schema\Blueprint; //Digunakan untuk membangun struktur tabel.
use Illuminate\Support\Facades\Schema; //Digunakan untuk mengakses metode database seperti create() dan dropIfExists().

// Mendefinisikan Kelas Migrasi
// Membuat class anonim yang mewarisi Migration, yang berarti class ini akan digunakan untuk migrasi database.
return new class extends Migration {
    // Metode up() digunakan untuk menjalankan migrasi atau membuat tabel di database.
    public function up(): void
    {
        //Membuat tabel bernama todolists di database.
        //Menggunakan Blueprint untuk mendefinisikan kolom tabel.
        Schema::create('todolists', function (Blueprint $table) {
            // Membuat kolom id sebagai primary key (kunci utama). Secara otomatis akan bertipe BIGINT dan AUTO_INCREMENT.
            $table->id();
            //Membuat Kolom user_id (Foreign Key)
            //foreignId('user_id') → Membuat kolom user_id sebagai foreign key.
            //->constrained('users') → Menghubungkan user_id ke tabel users (kolom id sebagai referensi).
            //->onDelete('cascade') → Jika pengguna dihapus dari tabel users, maka semua to-do list miliknya juga akan dihapus otomatis (Cascade Delete).
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            //Membuat Kolom nama_tugas
            //Membuat kolom nama_tugas bertipe VARCHAR(255).
            //Kolom ini akan menyimpan nama tugas yang dibuat pengguna.
            $table->string('nama_tugas');
            //Membuat Kolom status_tugas (Enum)
            //Membuat kolom status_tugas dengan tipe ENUM, hanya bisa memiliki dua nilai:
            //'pending' → Tugas masih dalam proses.
            //'completed' → Tugas sudah selesai.
            //->default('pending') → Secara default, status tugas akan menjadi 'pending' jika tidak diisi.
            $table->enum('status_tugas', ['pending', 'completed'])->default('pending');
            //Menambahkan Kolom timestamps
            //Membuat dua kolom tambahan otomatis:
            //created_at → Menyimpan kapan tugas dibuat.
            //updated_at → Menyimpan kapan tugas terakhir diperbarui.
            $table->timestamps();
        });
    }

    //Metode down() digunakan untuk menghapus tabel jika migrasi dibatalkan.
    public function down(): void
    {
        //Schema::dropIfExists('todolists') → Jika tabel todolists ada, maka akan dihapus.
        Schema::dropIfExists('todolists');
    }
};
