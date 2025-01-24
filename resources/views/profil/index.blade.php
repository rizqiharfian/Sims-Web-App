@extends('layout.template')
@section('title', 'Profil Pengguna')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-light rounded h-100 p-4">
                {{-- <h6 class="mb-4">Profil Pengguna</h6> --}}
                <div class="row mb-3">
                    <div class="col-12 mb-3">
                        <img src="{{ asset('assets/RizqiHarfian_181011401021.jpg') }}" alt="Foto Profil" class="img-fluid" style="max-width: 15%; height: auto;">
                    </div>
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nama Kandidat</label>
                        <input type="text" class="form-control" id="name" value="{{ $user->name }}" disabled>
                    </div>
                    <div class="col-md-6">
                        <label for="role" class="form-label">Posisi Kandidat</label>
                        <input type="text" class="form-control" id="role" value="{{ $user->role }}" disabled>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
