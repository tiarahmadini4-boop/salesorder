<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion"
    id="accordionSidebar">

    <!-- Logo -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center"
       href="<?= site_url('sales'); ?>">

        <div class="sidebar-brand-icon">
            <i class="fas fa-box"></i>
        </div>

        <div class="sidebar-brand-text mx-3">
            Sales Order
        </div>

    </a>

    <hr class="sidebar-divider my-0">

    <!-- Dashboard -->
    <li class="nav-item <?= (uri_string() == 'sales' || uri_string() == 'sales/dashboard') ? 'active' : ''; ?>">

        <a class="nav-link"
           href="<?= site_url('sales'); ?>">

            <i class="fas fa-fw fa-tachometer-alt"></i>

            <span>Dashboard</span>

        </a>

    </li>

    <hr class="sidebar-divider">

    <!-- Order Saya -->
    <li class="nav-item <?= (uri_string() == 'sales/sales_order') ? 'active' : ''; ?>">

        <a class="nav-link"
           href="<?= site_url('sales/sales_order'); ?>">

            <i class="fas fa-file-invoice-dollar"></i>

            <span>Order Saya</span>

        </a>

    </li>

    <!-- Buat Order Baru -->
    <li class="nav-item <?= (uri_string() == 'sales/sales_order/tambah') ? 'active' : ''; ?>">

        <a class="nav-link"
           href="<?= site_url('sales/sales_order_tambah'); ?>">

            <i class="fas fa-plus-circle"></i>

            <span>Buat Order Baru</span>

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
