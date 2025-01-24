<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3">
    <nav class="navbar costum-navbar navbar-light">
        <a href="{{ route ('home') }}" class="navbar-brand mx-4 mb-3">
            <h4 class="text-white"></i>SIMS Web App</h4>
        </a>
        {{-- <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="{{ asset('assets/img/user.jpg') }}" alt="" style="width: 40px; height: 40px;">
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">{{ auth()->user()->name }}</h6>
                <span>{{ auth()->user()->role }}</span>
            </div>
        </div> --}}
        <div class="navbar-nav w-100">
            {{-- <a href="index.html" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a> --}}
            {{-- <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Elements</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="button.html" class="dropdown-item">Buttons</a>
                    <a href="typography.html" class="dropdown-item">Typography</a>
                    <a href="element.html" class="dropdown-item">Other Elements</a>
                </div>
            </div> --}}
            <a href="{{ route('produk') }}" class="nav-item nav-link"><i class="fa fa-file-archive me-2"></i>Produk</a>
            <a href="{{ route('profil') }}" class="nav-item nav-link"><i class="fa fa-car me-2"></i>Profil</a>
            <form action="{{ route('login.keluar') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="nav-item nav-link" style="border: none; background: none;">
                    <i class="fa fa-users me-2"></i>Logout
                </button>
            </form>            
            {{-- <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Pages</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="signin.html" class="dropdown-item">Sign In</a>
                    <a href="signup.html" class="dropdown-item">Sign Up</a>
                    <a href="404.html" class="dropdown-item">404 Error</a>
                    <a href="blank.html" class="dropdown-item">Blank Page</a>
                </div>
            </div> --}}
        </div>
    </nav>
</div>
<style>
    .custom-navbar {
        background-color: #ff0000; /* Merah */
    }

    .navbar-brand h4 {
        color: white; /* Mengubah warna teks menjadi putih */
        font-size: 1.5rem;
    }
</style>
<!-- Sidebar End -->