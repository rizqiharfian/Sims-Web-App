@extends('layout.template')
@section('title', 'Data Users')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Data Users</h6>

                <!-- Flash Message -->
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif

                <!-- Tabel Data -->
                <div id="userTableContainer">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $index => $user)
                            <tr>
                                <td>{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                                <td class="text-center">
                                    <!-- Tombol Edit -->
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info btn-sm">Edit</a>

                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus user ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
                <!-- Navigasi Pagination -->
                <div id="paginationContainer" class="mt-3">
                    <!-- Tombol Previous -->
                    <a href="{{ $users->previousPageUrl() }}" class="btn btn-primary btn-sm prev-page" {{ $users->onFirstPage() ? 'disabled' : '' }}>
                        Previous
                    </a>

                    <!-- Informasi Halaman -->
                    <span>Page {{ $users->currentPage() }} of {{ $totalPages }}</span>

                    <!-- Tombol Next -->
                    <a href="{{ $users->nextPageUrl() }}" class="btn btn-primary btn-sm next-page" {{ $users->hasMorePages() ? '' : 'disabled' }}>
                        Next
                    </a>
                </div>

                <!-- Tombol Tambah -->
                <a href="{{ route('users.create') }}" class="btn btn-primary mt-3">Tambah</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Handle pagination click event
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        let url = $(this).attr('href');
        fetchUsers(url);
    });

    function fetchUsers(url) {
        $.ajax({
            url: url,
            type: 'GET',
            success: function(data) {
                // Replace the table and pagination container with new data
                $('#userTableContainer').html($(data).find('#userTableContainer').html());
            },
            error: function(xhr) {
                console.error('Error fetching user data:', xhr);
            }
        });
    }
</script>
@endsection
