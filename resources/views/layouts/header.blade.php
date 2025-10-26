<!-- Custom Admin Button Styles -->
<style>
    .admin-button {
        background-color: #4e73df;
        color: white !important;
        border-radius: 5px;
        padding: 6px 14px !important;
        transition: all 0.2s ease;
        box-shadow: 0 1px 2px rgba(78, 115, 223, 0.2);
        font-weight: 400;
        border: none;
        font-size: 0.85rem;
        height: 32px;
        display: flex;
        align-items: center;
        margin: 0;
    }
    
    .admin-button:hover, .admin-button:focus {
        background-color: #375bc8;
        box-shadow: 0 2px 4px rgba(78, 115, 223, 0.3);
        transform: translateY(-1px);
    }
    
    .admin-button i {
        font-size: 0.75rem;
    }
    
    /* Override Bootstrap dropdown toggle arrow */
    .admin-button::after {
        display: none;
    }
    
    @media (max-width: 768px) {
        .admin-button {
            padding: 5px 10px !important;
            font-size: 0.8rem;
            height: 30px;
        }
    }
    
    /* Enhanced dropdown menu styles */
    .dropdown-menu-right {
        min-width: 200px;
        border: none;
        border-radius: 0.5rem;
        overflow: hidden;
    }
    
    .dropdown-menu-right .dropdown-item {
        padding: 0.75rem 1.5rem;
        transition: background-color 0.2s;
    }
    
    .dropdown-menu-right .dropdown-item:hover {
        background-color: #eaecf4;
    }
    
    .dropdown-menu-right .dropdown-item i {
        color: #4e73df;
        margin-right: 0.75rem;
    }
</style>

<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow" style="min-height: 60px;">
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Logo -->
    <div class="d-none d-sm-inline-block ml-md-3 my-2 my-md-0 mw-100">
        <a href="{{ url('/') }}" class="text-decoration-none">
            <img src="{{ asset('images/logo-geric.png') }}" alt="GERIC Logo" height="32" style="max-width: 180px; object-fit: contain;">
        </a>
    </div>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto" style="height: 100%; display: flex; align-items: center;">
        <!-- Divider -->
        <div class="topbar-divider d-none d-sm-block"></div>
        
        <!-- User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="dropdown-toggle d-flex align-items-center admin-button" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @if(Auth::user()->profilePicture)
                <img class="rounded-circle mr-2" src="{{ asset('images/' . Auth::user()->profilePicture) }}" width="20" height="20">
                @else
                <i class="fas fa-user-circle mr-2" style="font-size: 0.9rem;"></i>
                @endif
                <span class="d-none d-lg-inline">{{ Auth::user()->username }}</span>
                <i class="fas fa-chevron-down ml-2" style="font-size: 0.75rem;"></i>
            </a>
            <!-- Dropdown – User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <div class="px-3 py-2 text-center border-bottom">
                    <span class="d-block text-gray-600 font-weight-bold">{{ Auth::user()->username }}</span>
                    <small class="text-gray-500">{{ Auth::user()->email }}</small>
                </div>
                <a class="dropdown-item" href="{{ route('admin.manageProfile') }}">
                    <i class="fas fa-user fa-sm fa-fw mr-2"></i>
                    Profil Saya
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>
                    Log Keluar
                </a>
            </div>
        </li>
    </ul>
</nav>
<!-- End of Topbar -->

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content border-0">
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title font-weight-bold">Log Keluar Sistem</h5>
                <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body py-4">
                <div class="text-center mb-3">
                    <i class="fas fa-sign-out-alt fa-3x text-gray-300 mb-3"></i>
                    <h5>Adakah anda pasti untuk log keluar?</h5>
                    <p class="text-gray-600">Pilih "Log Keluar" jika anda ingin menamatkan sesi anda.</p>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <button class="btn btn-outline-secondary" type="button" data-dismiss="modal">
                    <i class="fas fa-times mr-1"></i> Batal
                </button>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-sign-out-alt mr-1"></i> Log Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>