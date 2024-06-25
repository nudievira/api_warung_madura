<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Barang;
use App\Models\Transaksi;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function dataTable(Request $request)
    {
        // $transkasi = Transaksi::with('barang')->get();
        $query = Transaksi::with('barang');

        // Tambahkan kondisi filter jika ada input tanggal
        if ($request->filled('start') && $request->filled('end')) {
            $query->whereBetween('tanggal_transaksi', [$request->start, $request->end]);
        }

        // Jalankan query
        $transaksi = $query->get();

        return ResponseFormatter::success($transaksi);
    }

    public function item()
    {
        $barang = Barang::with('transaksi')->get();
        return ResponseFormatter::success($barang);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            foreach ($request->product as $data) {

                $barang = Barang::where('id', $data['idProduct'])->first();
                $stokAkhir = $barang->stok - $data['qty'];

                Transaksi::lockforUpdate() // Store new transaksi
                    ->create([
                        'id_barang' => $data['idProduct'],
                        'stok_akhir' => $stokAkhir,
                        'jumlah_terjual' => $data['qty'],
                        'tanggal_transaksi' => Carbon::now(),
                    ]);

                $barang->update([
                    'stok' => $stokAkhir,
                ]);
            }
            DB::commit();

            return ResponseFormatter::success();
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage());
        }

        return ResponseFormatter::success($request->all());
    }

    public function show($id)
    {
        $transkasi = Transaksi::where('id', $id)->with('barang')->first();
        return ResponseFormatter::success($transkasi);
    }

    public function update(Request $request)
    {
        try {
            DB::beginTransaction();

            $transkasi = Transaksi::where('id', $request->id)->with('barang')->first();
            $pengurangan_stok = $transkasi->jumlah_terjual - $request->qty;
            $total_transaksi = $transkasi->stok_akhir + $pengurangan_stok;
            $total_stok = $transkasi->barang->stok + $pengurangan_stok;

            $update_transaksi = $transkasi->update([
                'stok_akhir' => $total_transaksi,
                'jumlah_terjual' => $request->qty,
            ]);
            if ($update_transaksi) {
                $barang = Barang::where('id', $transkasi->id_barang)->update([
                    'stok' => $total_stok
                ]);
            } else {
                DB::rollBack();
                return ResponseFormatter::error('transaksi tidak berhasil disimpan');
            }
            DB::commit();
            return ResponseFormatter::success($total_stok);
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage());
        }
    }

    public function dataTableReport(Request $request)
    {
        try {

            $query = DB::table('barang')
                ->select('barang.id', 'barang.nama', 'jenis_barang', DB::raw('SUM(transaksi.jumlah_terjual) as jumlah_terjual'))
                ->leftJoin('transaksi', 'barang.id', '=', 'transaksi.id_barang')
                ->when($request->filled('start') && $request->filled('end'), function ($query) use ($request) {
                    $query->whereBetween('transaksi.tanggal_transaksi', [$request->start, $request->end]);
                })
                ->groupBy('barang.id', 'barang.nama');

            $barangs = $query->get();
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage());
        }
        return ResponseFormatter::success($barangs);
    }
}
