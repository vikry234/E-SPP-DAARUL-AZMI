<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public function index()
    {
        $siswa_laki_laki = DB::table('siswa')->where('jenis_kelamin', 'Laki-laki')->count();
        $siswa_perempuan = DB::table('siswa')->where('jenis_kelamin', 'Perempuan')->count();

        // Hitung total pembayaran lunas dan belum lunas
        $total_pembayaran_lunas = DB::table('pembayaran')->where('status', 'Lunas')->count();
        $total_pembayaran_belum_lunas = DB::table('pembayaran')->where('status', 'Belum Lunas')->count();

        return view('admin.dashboard', [
            'total_siswa' => DB::table('siswa')->count(),
            'total_kelas' => DB::table('kelas')->count(),
            'total_pembayaran_lunas' => $total_pembayaran_lunas,
            'total_pembayaran_belum_lunas' => $total_pembayaran_belum_lunas,
            'siswa_laki_laki' => $siswa_laki_laki,
            'siswa_perempuan' => $siswa_perempuan,
        ]);
    }
}
