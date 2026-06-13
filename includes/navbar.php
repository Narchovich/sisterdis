<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

.navbar{
    width:100%;
    background:#fff;
    padding:20px 50px;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.logo{
    font-size:24px;
    font-weight:700;
    color:#6f2cff;
}

.nav-menu{
    display:flex;
    gap:35px;
}

.nav-menu a{
    text-decoration:none;
    color:#555;
    font-size:14px;
    transition:0.3s;
}

.nav-menu a:hover{
    color:#6f2cff;
}

.nav-menu .active{
    color:#6f2cff;
    font-weight:600;
    border-bottom:2px solid #6f2cff;
    padding-bottom:4px;
}

.btn-ticket{
    text-decoration:none;
    color:#6f2cff;
    border:2px solid #6f2cff;
    padding:10px 22px;
    border-radius:25px;
    font-size:14px;
    font-weight:600;
    transition:0.3s;
}

.btn-ticket:hover{
    background:#6f2cff;
    color:white;
}

@media(max-width:768px){

    .navbar{
        flex-direction:column;
        gap:15px;
        padding:20px;
    }

    .nav-menu{
        gap:15px;
        flex-wrap:wrap;
        justify-content:center;
    }

}

</style>

<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<nav class="navbar">

    <div class="logo">
        TiketKonser
    </div>

    <div class="nav-menu">

        <a href="home.php"
        class="<?= ($current_page == 'home.php') ? 'active' : ''; ?>">
            Beranda
        </a>

        <a href="events.php"
        class="<?= ($current_page == 'events.php') ? 'active' : ''; ?>">
            Event
        </a>

        <a href="how_to_buy.php"
        class="<?= ($current_page == 'how_to_buy.php') ? 'active' : ''; ?>">
            Cara Beli
        </a>

        <a href="konfirmasi.php"
        class="<?= ($current_page == 'confirm.php') ? 'active' : ''; ?>">
            konfirmasi
        </a>

        <a href="contact.php"
        class="<?= ($current_page == 'contact.php') ? 'active' : ''; ?>">
            Kontak
        </a>

    </div>

    <a href="check_ticket.php" class="btn-ticket">
        Cek Tiket
    </a>

</nav>