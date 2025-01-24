<?php

namespace App\Exports;

use App\Models\Produk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProdukExport implements FromCollection, WithHeadings
{
    protected $search;
    protected $kategori;

    /**
     * Konstruktor untuk menerima parameter filter
     */
    public function __construct($search = null, $kategori = null)
    {
        $this->search = $search;
        $this->kategori = $kategori;
    }

    /**
     * Ambil data produk berdasarkan filter
     */
    public function collection()
    {
        $query = Produk::query();

        if ($this->search) {
            $query->where('nama_produk', 'like', '%' . $this->search . '%');
        }

        if ($this->kategori) {
            $query->where('kategori_produk', $this->kategori);
        }

        return $query->select('nama_produk', 'kategori_produk', 'harga_beli', 'harga_jual', 'stok_produk')->get();
    }

    /**
     * Tambahkan header di file Excel
     */
    public function headings(): array
    {
        return [
            'Nama Produk',
            'Kategori Produk',
            'Harga Beli',
            'Harga Jual',
            'Stok Produk',
        ];
    }
}
