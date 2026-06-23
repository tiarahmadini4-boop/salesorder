<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion"
    id="accordionSidebar">

    <!-- Logo -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center"
       href="<?= site_url('manager/dashboard'); ?>">

        <div class="sidebar-brand-icon">
            <i class="fas fa-chart-line"></i>
        </div>

        <div class="sidebar-brand-text mx-3">
            Sales Order
        </div>

    </a>

    <hr class="sidebar-divider my-0">

    <!-- Dashboard -->
    <li class="nav-item <?= (strpos(uri_string(), 'manager/dashboard') === 0 || uri_string() == 'manager') ? 'active' : ''; ?>">

        <a class="nav-link"
           href="<?= site_url('manager/dashboard'); ?>">

            <i class="fas fa-fw fa-tachometer-alt"></i>

            <span>Dashboard</span>

        </a>

    </li>

    <hr class="sidebar-divider">

    <!-- Laporan -->
    <li class="nav-item <?= (strpos(uri_string(), 'manager/laporan') === 0) ? 'active' : ''; ?>">

        <a class="nav-link"
           href="<?= site_url('manager/laporan'); ?>">

            <i class="fas fa-chart-bar"></i>

            <span>Laporan</span>

        </a>

    </li>

    <hr class="sidebar-divider">

    <!-- Logout -->
    <li class="nav-item">

        <a class="nav-link"
           href="<?= site_url('auth/logout'); ?>">

            <i class="fas fa-sign-out-alt"></i>

            <span>logout</span>

        </a>

    </li>

</ul>

<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">