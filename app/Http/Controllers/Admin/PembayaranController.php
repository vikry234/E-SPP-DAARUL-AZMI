<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\DataTables\PembayaranDataTable;
use App\Models\Spp;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, PembayaranDataTable $datatable)
    {
        if ($request->ajax()) {
            return $datatable->data();
        }

        return view('admin.pembayaran.index');
    }

    public function update(Request $request)
    {
        $pembayaran = Pembayaran::findOrFail($request->id);

        // Pastikan nilai yang diterima adalah angka tanpa simbol atau karakter non-numerik
        $jumlah_bayar_lama = (float) preg_replace('/[^0-9]/', '', $pembayaran->jumlah_bayar); // Remove non-numeric characters
        $jumlah_bayar_tambahan = (float) preg_replace('/[^0-9]/', '', $request->jumlah_bayar); // Remove non-numeric characters

        // Tambahkan jumlah pembayaran yang baru ke jumlah pembayaran lama
        $total_bayar = $jumlah_bayar_lama + $jumlah_bayar_tambahan;

        // Periksa apakah pembayaran sudah lunas atau belum
        $status = $total_bayar >= $pembayaran->nominal ? 'Lunas' : 'Belum Lunas';

        // Update jumlah bayar dan status
        $pembayaran->jumlah_bayar = $total_bayar;
        $pembayaran->status = $status;
        $pembayaran->save();

        // Redirect back dengan pesan sukses
        return redirect()->back()->with('success', 'Data pembayaran berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pembayaran::findOrFail($id)->delete();

        return response()->json([
            'message' => 'Data pembayaran berhasil dihapus!',
            'status' => 'OK',
        ]);
    }
}
