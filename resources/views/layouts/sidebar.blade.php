@php
// Admin-only system - all routes use 'admin.' prefix
$routePrefix = function($route) {
    return 'admin.' . $route;
};
@endphp

{{-- Sidebar --}}
<ul id="accordionSidebar" class="navbar-nav sidebar sidebar-dark accordion">
  
  <!-- Brand / Logo -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route($routePrefix('dashboard')) }}">
  <div class="sidebar-brand-icon">
    <span class="brand-burger" title="Menu">
      <img src="{{ asset('images/bulat_logo2.png') }}" alt="Menu" class="brand-burger" />
    </span>
     <img src="{{ asset('images/logo.jpeg') }}" alt="Logo" class="geric-logo-text" />
  </div>
</a>

  <hr class="sidebar-divider my-0">

  <!-- HOME -->
  <li class="nav-item {{ request()->routeIs('*.dashboard') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route($routePrefix('dashboard')) }}">
      <i class="fas fa-fw fa-home"></i>
      <span>Laman Utama</span>
    </a>
  </li>

  <hr class="sidebar-divider">

  <!-- PERMOHONAN Dropdown -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePermohonan"
       aria-expanded="true" aria-controls="collapsePermohonan">
      <i class="fas fa-fw fa-file-alt"></i>
      <span>Permohonan</span>
    </a>
    <div id="collapsePermohonan" class="collapse" aria-labelledby="headingPermohonan"
         data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Jenis Permohonan:</h6>
        <a class="collapse-item" href="{{ route('admin.geranpenyelidikan') }}">Geran Penyelidikan</a>
        <a class="collapse-item" href="{{ route('admin.geranpadanan') }}">Geran Padanan</a>
        <a class="collapse-item" href="{{ route('admin.granindustri') }}">Geran Industri</a>
        <a class="collapse-item" href="{{ route('admin.perundingan') }}">Perundingan</a>
        <a class="collapse-item" href="{{ route('admin.kajiankes') }}">Kajian Kes</a>
        <a class="collapse-item" href="{{ route('admin.moamou') }}">MoA/MoU</a>
      </div>
    </div>
  </li>

  <hr class="sidebar-divider">

  <!-- PELAPORAN Dropdown -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePelaporan"
       aria-expanded="true" aria-controls="collapsePelaporan">
      <i class="fas fa-fw fa-chart-line"></i>
      <span>Pelaporan</span>
    </a>
    <div id="collapsePelaporan" class="collapse" aria-labelledby="headingPelaporan"
         data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Jenis Pelaporan:</h6>
        <a class="collapse-item" href="{{ route('admin.penerbitanpenulisan') }}">Penerbitan dan Penulisan Kreatif</a>
        <a class="collapse-item" href="{{ route('admin.globalantarabangsa') }}">Global dan Pengantarabangsaan</a>
        <a class="collapse-item" href="{{ route('admin.inovasipengkomersilan') }}">Inovasi dan Pengkomersilan</a>
        <a class="collapse-item" href="{{ route('admin.penyelidikankeusahawanan') }}">Penyelidikan dan Keusahawanan</a>
      </div>
    </div>
  </li>

  <hr class="sidebar-divider">

  <!-- URUS PENGGUNA - Only visible to Admin -->
  @if(Auth::user()->role == 'Admin')
  <li class="nav-item {{ request()->routeIs('admin.manageUser') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.manageUser') }}">
      <i class="fas fa-fw fa-users-cog"></i>
      <span>Urus Pengguna</span>
    </a>
  </li>
  @endif

  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- End of Sidebar -->

<style>
.edu-nsw-act-cursive-<uniquifier> {
  font-family: "Edu NSW ACT Cursive", cursive;
  font-optical-sizing: auto;
  font-weight: 700;
  font-style: normal;
}

.sidebar-brand-icon img.brand-burger {
  max-width: 60px;
  height: auto;
  display: inline-block;
}

/* tighten text logo */
.geric-logo-text {
    max-width: 160px;   /* adjust to fit your sidebar */
    height: auto;
    display: inline-block;
    object-fit: contain;
}

/* reduce burger icon size */
.brand-burger-icon {
  font-size: 1rem;
}

/* slightly reduce brand container padding */
.sidebar-brand {
  padding: 0.35rem 0.5rem;
}

/* default: show text, hide burger */
  .sidebar-brand-icon { position: relative; display:flex; align-items:center; gap:.5rem; }
  .brand-burger { display: none; font-size: 1.05rem; color: #fff; }

    /* when sidebar is collapsed/toggled: hide text, show burger only */
  #accordionSidebar.toggled .geric-logo-text,
  #accordionSidebar.sidebar.toggled .geric-logo-text {
    display: none !important;
  }
  #accordionSidebar.toggled .brand-burger,
  #accordionSidebar.sidebar.toggled .brand-burger {
    display: inline-flex !important;
    justify-content: center;
    align-items: center;
  }

  /* ensure icon stays centered in compact sidebar */
  #accordionSidebar.toggled .sidebar-brand,
  #accordionSidebar.sidebar.toggled .sidebar-brand {
    padding: .5rem;
  }

  .geric-logo-text {
  font-family: "Edu NSW ACT Cursive", cursive;
  display: inline-block;
  width: 100%;
  text-align: center;
  white-space: normal;           /* allow wrapping */
  overflow-wrap: break-word;    /* break long words */
  word-break: break-word;
  hyphens: auto;
  font-size: 1rem;              /* tweak if too large */
  line-height: 1.35;
  padding: 0.25rem 0;
 color: #fff;
 font-weight: 700;
    letter-spacing: .5px;
}


  /* Modern gradient sidebar background with subtle animation */
  #accordionSidebar {
      background: linear-gradient(180deg, #6e0827ff 0%, #110785ff 81%) !important;
      box-shadow: 4px 0 30px rgba(102, 126, 234, 0.4);
      overflow-x: hidden;
      position: relative;
  }

  #accordionSidebar::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: linear-gradient(180deg, rgba(255,255,255,0.05) 0%, transparent 100%);
      pointer-events: none;
  }




  /* Enhanced divider with glow effect */
  .sidebar-divider {
      border-top: 1px solid rgba(255, 255, 255, 0.2) !important;
      box-shadow: 0 1px 8px rgba(255, 255, 255, 0.1);
      margin: 0.75rem 0;
  }

#accordionSidebar.toggled {
    width: 4.5rem !important;  /* Reduce sidebar width when toggled */
}

#accordionSidebar.toggled .sidebar-brand-text {
    display: none;
}

#accordionSidebar.toggled .nav-item .nav-link {
    padding: 1rem;
    text-align: center;
    width: 4.5rem;
}

#accordionSidebar.toggled .nav-item .nav-link span {
    display: none;
}

#accordionSidebar.toggled .nav-item .nav-link i {
    font-size: 1.2rem;
    margin: 0;
    width: auto;
}

#accordionSidebar.toggled .collapse {
    position: absolute;
    left: 4.5rem;
    top: 0;
    margin: 0;
    padding: 0;
    width: auto;
    background: #fff;
    border-radius: 0.35rem;
    box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
}

#accordionSidebar.toggled .collapse.show {
    display: block;
}

/* Hide divider text when toggled */
#accordionSidebar.toggled .sidebar-divider {
    margin: 0 1rem 1rem;
}

#accordionSidebar.toggled .sidebar-heading {
    display: none;
}


  /* Modern nav items with smooth interactions */
  #accordionSidebar .nav-item .nav-link {
      color: rgba(255, 255, 255, 0.95) !important;
      padding: 0.9rem 1.1rem;
      border-radius: 12px;
      margin: 0.35rem 0.75rem;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      max-width: calc(100% - 1.5rem);
      font-weight: 500;
      letter-spacing: 0.3px;
      position: relative;
      overflow: hidden;
      display:flex;
      align-items:center;
      justify-content:space-between;
  }

  #accordionSidebar .nav-item .nav-link span {
    flex: 1;
    margin-left: 0.5rem;
}

#accordionSidebar .nav-item .nav-link i {
    width: 1.25rem;
    text-align: center;
}

#accordionSidebar .nav-item .nav-link[aria-expanded="true"] i.fa-angle-right {
    transform: rotate(90deg);
}

  #accordionSidebar .nav-item .nav-link::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
      transition: left 0.5s;
  }

  #accordionSidebar .nav-item .nav-link:hover::before {
      left: 100%;
  }

  #accordionSidebar .nav-item .nav-link:hover {
      background: rgba(255, 255, 255, 0.2);
      color: #ffffff !important;
      transform: translateX(5px);
      box-shadow: 0 6px 20px rgba(255, 255, 255, 0.15);
  }

  #accordionSidebar .nav-item .nav-link i {
      transition: transform 0.3s ease;
  }

  #accordionSidebar .nav-item .nav-link:hover i {
      transform: scale(1.15);
  }

  #accordionSidebar .nav-item.active .nav-link {
      background: linear-gradient(90deg, rgba(255, 255, 255, 0.25) 0%, rgba(255, 255, 255, 0.15) 100%);
      color: #ffffff !important;
      box-shadow: 0 8px 24px rgba(255, 255, 255, 0.2);
      border-left: 5px solid #ffffff;
      padding-left: calc(1.1rem - 5px);
      font-weight: 600;
  }

  /* Beautiful dropdown styling */
  #accordionSidebar .collapse-inner {
      background: linear-gradient(135deg, #ffffff 0%, #f8f9fc 100%) !important;
      border-radius: 12px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15), inset 0 1px 3px rgba(255, 255, 255, 0.8);
      margin: 0.5rem 1rem;
      min-width: 200px; /* Adjust this value based on your longest text */
      max-width: 100%;
      overflow: hidden;
      border: 1px solid rgba(255, 255, 255, 0.5);
  }

  #accordionSidebar .collapse-header {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white !important;
      font-weight: 700;
      font-size: 0.7rem;
      letter-spacing: 1.2px;
      padding: 0.85rem 1.1rem;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      box-shadow: 0 2px 8px rgba(102, 126, 234, 0.3);
      position: relative;
  }

  #accordionSidebar .collapse-header::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      height: 2px;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.5), transparent);
  }

  #accordionSidebar .collapse-item {
      color: #000000ff !important;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      margin: 0.3rem 0.7rem;
      border-radius: 8px;
      padding: 0.8rem 1.1rem;
      font-size: 0.875rem;
      white-space: normal;
      word-wrap: break-word;
      font-weight: 500;
      position: relative;
      overflow: hidden;
  }

  #accordionSidebar .collapse-item::before {
      content: '';
      position: absolute;
      left: 0;
      top: 0;
      bottom: 0;
      width: 3px;
      background: linear-gradient(180deg, #667eea, #764ba2);
      transform: scaleY(0);
      transition: transform 0.3s ease;
  }

  #accordionSidebar .collapse-item:hover::before {
      transform: scaleY(1);
  }

  #accordionSidebar .collapse-item:hover {
      background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
      color: white !important;
      transform: translateX(5px);
      box-shadow: 0 4px 16px rgba(102, 126, 234, 0.4);
      padding-left: 1.4rem;
  }

  #accordionSidebar .collapse-item:active {
      transform: translateX(3px) scale(0.98);
  }

  /* Make sure collapsed sidebar doesn't show text overflow */
  .sidebar.toggled .collapse-item {
      font-size: 0.6rem;
  }

  /* Sidebar toggler button enhancement */
  #sidebarToggle {
      background: rgba(255, 255, 255, 0.2) !important;
      border: 2px solid rgba(255, 255, 255, 0.3) !important;
      width: 2.5rem;
      height: 2.5rem;
      transition: all 0.3s ease;
  }

  #sidebarToggle:hover {
      background: rgba(255, 255, 255, 0.3) !important;
      border-color: rgba(255, 255, 255, 0.5) !important;
      transform: rotate(180deg) scale(1.1);
      box-shadow: 0 4px 12px rgba(255, 255, 255, 0.3);
  }

  #sidebarToggle::after {
      color: #ffffff;
      font-weight: 900;
  }

  /* Smooth scrollbar styling */
  #accordionSidebar::-webkit-scrollbar {
      width: 8px;
  }

  #accordionSidebar::-webkit-scrollbar-track {
      background: rgba(255, 255, 255, 0.05);
      border-radius: 4px;
  }

  #accordionSidebar::-webkit-scrollbar-thumb {
      background: rgba(255, 255, 255, 0.3);
      border-radius: 4px;
      transition: background 0.3s ease;
  }

  #accordionSidebar::-webkit-scrollbar-thumb:hover {
      background: rgba(255, 255, 255, 0.5);
  }

  /* Add subtle pulse animation to active items */
  @keyframes pulse {
      0%, 100% {
          box-shadow: 0 8px 24px rgba(255, 255, 255, 0.2);
      }
      50% {
          box-shadow: 0 8px 32px rgba(255, 255, 255, 0.3);
      }
  }

  #accordionSidebar .nav-item.active .nav-link {
      animation: pulse 3s ease-in-out infinite;
  }

  .collapse-item {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    display: block;
    padding: 0.5rem 1rem;
    font-size: 0.85rem;
    margin: 0 0.5rem;
    border-radius: 0.35rem;
}


</style>


