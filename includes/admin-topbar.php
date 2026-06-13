<?php
$adminName = $adminName ?? 'Admin';
?>
<header class="topbar">

    <div class="search-box">

        <i class="fas fa-search"></i>

        <input
            type="text"
            placeholder="Cari event, pesanan, atau tiket...">

    </div>

    <div class="topbar-right">

        <button class="notification-btn">

            <i class="fas fa-bell"></i>

            <span class="notif-dot"></span>

        </button>

        <div class="profile-box">

            <div>

                <span class="profile-label">
                    Admin Profile
                </span>

            </div>

            <div class="profile-avatar">

                <?= strtoupper(substr($adminName, 0, 1)); ?>

            </div>

        </div>

    </div>

</header>