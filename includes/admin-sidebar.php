<aside class="sidebar">

    <div>

        <!-- Header Sidebar -->
        <div class="sidebar-header">

            <h1>TiketKonser</h1>

            <p>ADMIN DASHBOARD</p>

        </div>

        <!-- Menu -->
        <nav class="sidebar-menu">

            <a href="dashboard.php"
                class="menu-item <?= basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : '' ?>">

                <i class="fas fa-chart-line"></i>

                Dashboard

            </a>

            <a href="events.php"
                class="menu-item <?= basename($_SERVER['PHP_SELF']) == 'events.php' ? 'active' : '' ?>">

                <i class="fas fa-calendar-alt"></i>

                Manajemen Event

            </a>

            <a href="orders.php"
                class="menu-item <?= basename($_SERVER['PHP_SELF']) == 'orders.php' ? 'active' : '' ?>">

                <i class="fas fa-receipt"></i>

                Manajemen Pesanan

            </a>

            <a href="tickets.php"
                class="menu-item <?= basename($_SERVER['PHP_SELF']) == 'tickets.php' ? 'active' : '' ?>">

                <i class="fas fa-ticket-alt"></i>

                Distribusi Tiket

            </a>

        </nav>

    </div>

    <!-- Footer Sidebar -->
    <div class="sidebar-footer">

        <nav class="sidebar-menu">

            <a href="settings.php"
                class="menu-item <?= basename($_SERVER['PHP_SELF']) == 'settings.php' ? 'active' : '' ?>">

                <i class="fas fa-cog"></i>

                Pengaturan

            </a>

        </nav>

    </div>
</aside>