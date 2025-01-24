@extends('layout.template')
@section('title', 'SIMS Web App - Edit Produk')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Edit Produk</h6>

                <form action="{{ route('produk.update', $produks->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{-- @method('PUT') --}}

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="kategori_produk" class="form-label">Kategori</label>
                            <select name="kategori_produk" id="kategori_produk" class="form-select" required>
                                <option value="Alat Olahraga" {{ old('kategori_produk', $produks->kategori_produk) == 'Alat Olahraga' ? 'selected' : '' }}>Alat Olahraga</option>
                                <option value="Alat Musik" {{ old('kategori_produk', $produks->kategori_produk) == 'Alat Musik' ? 'selected' : '' }}>Alat Musik</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="nama_produk" class="form-label">Nama Barang</label>
                            <input type="text" name="nama_produk" class="form-control" id="nama_produk" placeholder="Masukkan Nama Barang" value="{{ old('nama_produk', $produks->nama_produk) }}" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="harga_beli" class="form-label">Harga Beli</label>
                            <input type="text" name="harga_beli" class="form-control" id="harga_beli" placeholder="Masukkan Harga Beli" value="{{ old('harga_beli', $produks->harga_beli) }}" required>
                        </div>
                        <div class="col-md-4">
                            <label for="harga_jual" class="form-label">Harga Jual</label>
                            <input type="text" name="harga_jual" class="form-control" id="harga_jual" placeholder="Masukkan Harga Jual" value="{{ old('harga_jual', $produks->harga_jual) }}" required>
                        </div>
                        <div class="col-md-4">
                            <label for="stok_produk" class="form-label">Stok Produk</label>
                            <input type="text" name="stok_produk" class="form-control" id="stok_produk" placeholder="Masukkan Stok Produk" value="{{ old('stok_produk', $produks->stok_produk) }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto</label>
                        <input type="file" name="foto" class="form-control" id="foto">
                        @if($produks->foto)
                            <div class="mt-2">
                                <label>Foto Saat Ini:</label><br>
                                <img src="{{ asset('storage/produk_foto/' . $produks->foto) }}" alt="Foto Produk" width="100">
                            </div>
                        @endif
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('produk') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary ms-3">Simpan</button>
                    </div>                    
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
