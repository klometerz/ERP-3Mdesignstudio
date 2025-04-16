<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pelanggan;
use App\Models\Order;

class DeleteDummyPelanggan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:dummy-pelanggan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Menghapus semua pelanggan dummy dan semua order terkait';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('*** MODE DELETE PELANGGAN DUMMY ***');

        $dummyPelanggan = Pelanggan::where('is_dummy', true)->get();
        $countPelanggan = $dummyPelanggan->count();

        if ($countPelanggan == 0) {
            $this->info('Tidak ada pelanggan dummy ditemukan. Database sudah bersih.');
            return;
        }

        $this->warn("Ditemukan {$countPelanggan} pelanggan dummy.");
        
        // Konfirmasi sebelum eksekusi
        if (!$this->confirm('Apakah Anda yakin ingin menghapus semua pelanggan dummy dan order terkait? Ini tidak bisa dibatalkan!', false)) {
            $this->info('Operasi dibatalkan.');
            return;
        }

        foreach ($dummyPelanggan as $pelanggan) {
            // Hapus semua orders yang terkait
            $orderCount = Order::where('pelanggan_id', $pelanggan->id)->count();
            Order::where('pelanggan_id', $pelanggan->id)->delete();

            // Hapus pelanggan
            $pelanggan->delete();

            $this->info("Pelanggan {$pelanggan->nama} berhasil dihapus beserta {$orderCount} order.");
        }

        $this->info("*** Semua pelanggan dummy berhasil dihapus! ***");
    }
}
