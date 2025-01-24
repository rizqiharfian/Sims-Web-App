<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Exports\ProdukExport;
use Maatwebsite\Excel\Facades\Excel;


class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $perPage = 10;

        $search = $request->input('search');
        $kategori = $request->input('kategori_produk');

        $query = Produk::query();

        if ($search) {
            $query->where('nama_produk', 'like', '%' . $search . '%');
        }

        if ($kategori) {
            $query->where('kategori_produk', $kategori);
        }

        $produks = $query->paginate($perPage);

        // Ambil kategori unik untuk dropdown filter
        $kategoriProduk = Produk::select('kategori_produk')->distinct()->pluck('kategori_produk');

        // Hitung total halaman
        $totalPages = $produks->lastPage();
        $currentPage = $produks->currentPage();

        return view('produk.index', compact('produks', 'totalPages', 'currentPage', 'kategoriProduk'));
    }

    public function create()
    {
        return view('produk.create'); // Menampilkan form tambah produk
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori_produk' => 'required|string|max:255',
            'harga_beli' => 'required|string',
            'harga_jual' => 'required|numeric',
            'stok_produk' => 'required|numeric',
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048', // Validasi file gambar
        ]);

        // Proses unggah foto
        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            // Menyimpan file gambar di folder public/mobil_foto
            $fotoPath = $request->file('foto')->store('produk_foto', 'public'); // Menggunakan 'public' disk yang akan menyimpan file di storage/app/public

            // Simpan data mobil ke database
            Produk::create([
                'nama_produk' => $request->nama_produk,
                'kategori_produk' => $request->kategori_produk,
                'harga_beli' => $request->harga_beli,
                'harga_jual' => $request->harga_jual,
                'stok_produk' => $request->stok_produk,
                'foto' => basename($fotoPath), // Simpan nama file foto, bukan path lengkap
            ]);

            return redirect()->route('produk')->with('message', 'Produk berhasil ditambahkan.');
        }

        return back()->withErrors(['foto' => 'File foto tidak valid.']);
    }

    public function edit($id)
    {
        $produks = Produk::findOrFail($id); // Cari mobil berdasarkan ID
        return view('produk.edit', compact('produks')); // Kirim data ke view
    }

    public function update(Request $request, $id)
    {
        $produks = Produk::findOrFail($id);

        // Validasi input
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori_produk' => 'required|string|max:255',
            'harga_beli' => 'required|string',
            'harga_jual' => 'required|string|max:255',
            'stok_produk' => 'required|numeric',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $produks->update([
            'nama_produk' => $request->nama_produk,
            'kategori_produk' => $request->kategori_produk,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'stok_produk' => $request->stok_produk,
        ]);

        // Jika ada foto baru yang diupload
        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            // Hapus foto lama jika ada
            if ($produks->foto && file_exists(storage_path('app/public/produk_foto/' . $produks->foto))) {
                unlink(storage_path('app/public/produk_foto/' . $produks->foto));
            }

            // Proses upload foto baru
            $fotoPath = $request->file('foto')->store('produk_foto', 'public');
            $produks->update(['foto' => basename($fotoPath)]);
        }

        return redirect()->route('produk')->with('message', 'Produk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $produks = Produk::findOrFail($id); // Cari mobil berdasarkan ID
        $produks->delete(); // Hapus data mobil
        return redirect()->route('produk')->with('message', 'Produk berhasil dihapus.');
    }

    public function export(Request $request)
{
    $search = $request->input('search');
    $kategori = $request->input('kategori_produk');

    return \Maatwebsite\Excel\Facades\Excel::download(
        new \App\Exports\ProdukExport($search, $kategori),
        'data-produk.xlsx'
    );
}
}
