@extends('layout.template')
@section('title', 'Tambah Produk - Rental Produk')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Tambah Produk</h6>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Form Tambah Produk -->
                <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="kategori_produk" class="form-label">Kategori</label>
                            <select name="kategori_produk" id="kategori_produk" class="form-select" required>
                                <option value="" selected disabled>Pilih Kategori</option>
                                <option value="Alat Olahraga">Alat Olahraga</option>
                                <option value="Alat Musik">Alat Musik</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="nama_produk" class="form-label">Nama Barang</label>
                            <input type="text" name="nama_produk" class="form-control" id="nama_produk" placeholder="Masukkan Nama Barang" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="harga_beli" class="form-label">Harga Beli</label>
                            <input type="text" name="harga_beli" class="form-control" id="harga_beli" placeholder="Masukkan Harga Beli" required>
                        </div>
                        <div class="col-md-4">
                            <label for="harga_jual" class="form-label">Harga Jual</label>
                            <input type="text" name="harga_jual" class="form-control" id="harga_jual" placeholder="Masukkan Harga Jual" required>
                        </div>
                        <div class="col-md-4">
                            <label for="stok_produk" class="form-label">Stok Produk</label>
                            <input type="text" name="stok_produk" class="form-control" id="stok_produk" placeholder="Masukkan Stok Produk" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto Produk</label>
                        <input type="file" name="foto" class="form-control" id="foto" required>
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
