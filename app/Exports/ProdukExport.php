<?php

namespace App\Exports;

use App\Models\Produk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProdukExport implements FromCollection, WithHeadings
{
    protected $search;
    protected $kategori;

    public function __construct($search = null, $kategori = null)
    {
        $this->search = $search;
        $this->kategori = $kategori;
    }

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
