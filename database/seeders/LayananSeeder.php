<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('layanans')->insert([
            [
                'nama_layanan' => 'Pengurusan KTP Baru',
                'deskripsi' => 'Layanan ini membantu masyarakat dalam pembuatan KTP baru dengan proses cepat dan praktis. Tim kami akan memastikan seluruh dokumen persyaratan terpenuhi sehingga pelanggan tidak perlu repot.',
                'harga_modal' => 50000,
                'harga_jual' => 100000,
            ],
            [
                'nama_layanan' => 'Perpanjangan SIM A',
                'deskripsi' => 'Kami menyediakan layanan perpanjangan SIM A tanpa perlu mengantri di kantor polisi. Prosesnya cepat, aman, dan sesuai dengan peraturan yang berlaku.',
                'harga_modal' => 70000,
                'harga_jual' => 150000,
            ],
            [
                'nama_layanan' => 'Perpanjangan SIM C',
                'deskripsi' => 'Layanan ini mempermudah Anda dalam memperpanjang SIM C tanpa perlu mengantri panjang. Kami memastikan seluruh proses sesuai prosedur resmi.',
                'harga_modal' => 60000,
                'harga_jual' => 130000,
            ],
            [
                'nama_layanan' => 'Pengurusan KK Baru',
                'deskripsi' => 'Kami membantu keluarga baru dalam pembuatan Kartu Keluarga dengan proses yang cepat dan mudah. Tim kami akan memandu setiap langkahnya agar semua data tercatat dengan benar.',
                'harga_modal' => 80000,
                'harga_jual' => 160000,
            ],
            [
                'nama_layanan' => 'Perubahan Data di KK',
                'deskripsi' => 'Jika ada perubahan data anggota keluarga, kami siap membantu proses pembaruan Kartu Keluarga Anda. Layanan ini meliputi penambahan, penghapusan, atau perubahan informasi sesuai ketentuan.',
                'harga_modal' => 70000,
                'harga_jual' => 140000,
            ],
            [
                'nama_layanan' => 'Pengurusan Akta Kelahiran',
                'deskripsi' => 'Layanan ini membantu Anda mendapatkan akta kelahiran anak dengan proses yang efisien. Kami memastikan semua dokumen persyaratan dipenuhi sehingga akta dapat diterbitkan dengan cepat.',
                'harga_modal' => 60000,
                'harga_jual' => 120000,
            ],
            [
                'nama_layanan' => 'Pengurusan Akta Kematian',
                'deskripsi' => 'Kami menyediakan layanan pengurusan akta kematian bagi keluarga yang ditinggalkan. Proses ini dilakukan dengan cepat dan profesional agar dokumen resmi dapat segera diterbitkan.',
                'harga_modal' => 55000,
                'harga_jual' => 110000,
            ],
            [
                'nama_layanan' => 'Pengurusan Akta Nikah',
                'deskripsi' => 'Layanan ini membantu pasangan yang akan menikah dalam memperoleh akta nikah secara resmi. Kami memastikan seluruh persyaratan terpenuhi untuk mempermudah proses administrasi.',
                'harga_modal' => 75000,
                'harga_jual' => 150000,
            ],
            [
                'nama_layanan' => 'Pengurusan Paspor',
                'deskripsi' => 'Kami memfasilitasi pembuatan paspor baru bagi Anda yang ingin bepergian ke luar negeri. Prosesnya cepat, mudah, dan sesuai dengan ketentuan imigrasi.',
                'harga_modal' => 100000,
                'harga_jual' => 200000,
            ],
            [
                'nama_layanan' => 'Pengurusan Visa',
                'deskripsi' => 'Layanan ini mempermudah proses pengajuan visa ke berbagai negara. Tim kami akan membantu menyiapkan dokumen yang diperlukan dan memastikan proses aplikasi berjalan lancar.',
                'harga_modal' => 120000,
                'harga_jual' => 250000,
            ],
        ]);
    }
}
