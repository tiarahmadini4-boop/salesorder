<ul class="navbar-nav bg-white sidebar accordion shadow-sm"
    id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-center"
       href="<?= site_url('customer'); ?>">

        <div class="sidebar-brand-icon">
            <i class="fas fa-car-side"></i>
        </div>

        <div class="sidebar-brand-text mx-3">
            ARTA RENTAL
        </div>

    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item active">
        <a class="nav-link"
           href="<?= site_url('customer/dashboard'); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link"
           href="<?= site_url('customer/mobil'); ?>">
            <i class="fas fa-car"></i>
            <span>Daftar Mobil</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link"
           href="<?= site_url('customer/pemesanan'); ?>">
            <i class="fas fa-calendar-check"></i>
            <span>Pemesanan</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link"
           href="<?= site_url('customer/riwayat'); ?>">
            <i class="fas fa-history"></i>
            <span>Riwayat Sewa</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link"
           href="<?= site_url('customer/profil'); ?>">
            <i class="fas fa-user"></i>
            <span>Profil</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link"
           href="<?= site_url('auth/logout'); ?>">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
    </li>

</ul>

<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">