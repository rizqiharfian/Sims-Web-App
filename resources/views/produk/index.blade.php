@extends('layout.template')
@section('title', 'Data Produk')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-light rounded h-100 p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h6>Data Produk</h6>
                </div>

                <div class="row mb-3 align-items-center">
                    <div class="col-md-6 d-flex gap-2">
                        <form action="{{ route('produk') }}" method="GET" class="d-flex">
                            <input type="text" name="search" class="form-control" placeholder="Cari produk..." value="{{ request('search') }}" oninput="debouncedSearch(this)">
                        </form>

                        <form action="{{ route('produk') }}" method="GET" class="ms-3">
                            <select name="kategori_produk" class="form-select" onchange="this.form.submit()">
                                <option value="">Semua Kategori</option>
                                @foreach($kategoriProduk as $kategori)
                                    <option value="{{ $kategori }}" {{ request('kategori_produk') == $kategori ? 'selected' : '' }}>
                                        {{ $kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </div>

                    <div class="col-md-6 d-flex justify-content-end gap-2">
                        <a href="{{ route('produk.export', ['search' => request('search'), 'kategori_produk' => request('kategori_produk')]) }}" 
                            class="btn btn-success">
                             Export Excel
                         </a>                         
                        <a href="{{ route('produk.create') }}" class="btn btn-danger">Tambah Produk</a>
                    </div>
                </div>

                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif

                <div id="produkTableContainer">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Foto</th>
                                <th>Nama Produk</th>
                                <th>Kategori Produk</th>
                                <th>Harga Beli</th>
                                <th>Harga Jual</th>
                                <th class="text-center">Stok Produk</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produks as $item)
                            <tr>
                                <td>{{ $loop->iteration + ($produks->currentPage() - 1) * $produks->perPage() }}</td>
                                <td>
                                    @if($item->foto)
                                        <img src="{{ asset('storage/produk_foto/' . $item->foto) }}" alt="Foto Produk" class="img-thumbnail" style="width: 80px; height: 100px; object-fit: cover;">
                                    @else
                                        <span>No Foto</span>
                                    @endif
                                </td>                                
                                <td>{{ $item->nama_produk }}</td>
                                <td>{{ $item->kategori_produk }}</td>
                                <td>{{ $item->harga_beli }}</td>
                                <td>{{ $item->harga_jual }}</td>
                                <td class="text-center">{{ $item->stok_produk }}</td>
                                <td class="text-center">
                                    <a href="{{ route('produk.edit', $item->id) }}" class="btn btn-info btn-sm">Edit</a>

                                    <form action="{{ route('produk.destroy', $item->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus Produk ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div id="paginationContainer" class="mt-3">
                    <a href="{{ $produks->previousPageUrl() }}" class="btn btn-primary btn-sm prev-page" {{ $produks->onFirstPage() ? 'disabled' : '' }}>
                        Previous
                    </a>

                    <span>Page {{ $produks->currentPage() }} of {{ $totalPages }}</span>

                    <a href="{{ $produks->nextPageUrl() }}" class="btn btn-primary btn-sm next-page" {{ $produks->hasMorePages() ? '' : 'disabled' }}>
                        Next
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    let searchTimeout;

    function debouncedSearch(input) {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            const search = input.value;
            const url = new URL(window.location.href);
            url.searchParams.set('search', search);
            window.location.href = url.toString();
        }, 500);
    }
</script>
@endsection
