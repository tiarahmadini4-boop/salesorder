<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion"
    id="accordionSidebar">
 
    <!-- Logo -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center"
       href="<?= site_url('admin'); ?>">
 
        <div class="sidebar-brand-icon">
            <i class="fas fa-box"></i>
        </div>
 
        <div class="sidebar-brand-text mx-3">
            Sales Order
        </div>
 
    </a>
 
    <hr class="sidebar-divider my-0">
 
    <!-- Dashboard -->
    <li class="nav-item <?= (uri_string() == 'admin' || uri_string() == 'admin/dashboard') ? 'active' : ''; ?>">
 
        <a class="nav-link"
           href="<?= site_url('admin'); ?>">
 
            <i class="fas fa-fw fa-tachometer-alt"></i>
 
            <span>Dashboard</span>
 
        </a>
 
    </li>
 
    <hr class="sidebar-divider">
 
    <!-- Data Produk -->
    <li class="nav-item <?= (strpos(uri_string(), 'admin/produk') === 0) ? 'active' : ''; ?>">
 
        <a class="nav-link"
           href="<?= site_url('admin/produk'); ?>">
 
            <i class="fas fa-boxes"></i>
 
            <span>Data Produk</span>
 
        </a>
 
    </li>
 
    <!-- Data Pelanggan -->
    <li class="nav-item <?= (strpos(uri_string(), 'admin/pelanggan') === 0) ? 'active' : ''; ?>">
 
        <a class="nav-link"
           href="<?= site_url('admin/pelanggan'); ?>">
 
            <i class="fas fa-users"></i>
 
            <span>Data Pelanggan</span>
 
        </a>
 
    </li>
 
    <!-- Data Sales -->
    <li class="nav-item <?= (strpos(uri_string(), 'admin/sales') === 0) ? 'active' : ''; ?>">
 
        <a class="nav-link"
           href="<?= site_url('admin/sales'); ?>">
 
            <i class="fas fa-user-tie"></i>
 
            <span>Data Sales</span>
 
        </a>
 
    </li>
 
    <!-- Sales Order -->
    <li class="nav-item <?= (strpos(uri_string(), 'admin/sales_order') === 0) ? 'active' : ''; ?>">
 
        <a class="nav-link"
           href="<?= site_url('admin/sales_order'); ?>">
 
            <i class="fas fa-file-invoice-dollar"></i>
 
            <span>Sales Order</span>
 
        </a>
 
    </li>
 
    <!-- Laporan -->
    <li class="nav-item <?= (strpos(uri_string(), 'admin/laporan') === 0) ? 'active' : ''; ?>">
 
        <a class="nav-link"
           href="<?= site_url('admin/laporan'); ?>">
 
            <i class="fas fa-file-alt"></i>
 
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
