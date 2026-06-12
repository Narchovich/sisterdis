<footer class="footer">

<style>

.footer{
    background:#f3f3f3;
    padding:70px 60px 25px;
    margin-top:80px;
    font-family:'Poppins',sans-serif;
}

.footer-container{
    display:grid;
    grid-template-columns:2fr 1fr 1fr 1fr 1.2fr;
    gap:40px;
}

.footer-about h2{
    font-size:34px;
    font-weight:700;
    margin-bottom:20px;
    color:#222;
}

.footer-about p{
    color:#666;
    line-height:1.8;
    font-size:14px;
    max-width:320px;
}

.social-icons{
    margin-top:25px;
    display:flex;
    gap:12px;
}

.social-icons a{
    width:35px;
    height:35px;
    border-radius:50%;
    background:#7b2cff;
    color:#fff;
    display:flex;
    align-items:center;
    justify-content:center;
    text-decoration:none;
    transition:.3s;
}

.social-icons a:hover{
    transform:translateY(-3px);
}

.footer-links h4,
.newsletter h4{
    font-size:16px;
    margin-bottom:20px;
    color:#222;
}

.footer-links a{
    display:block;
    margin-bottom:12px;
    text-decoration:none;
    color:#555;
    font-size:14px;
}

.footer-links a:hover{
    color:#7b2cff;
}

.newsletter p{
    font-size:13px;
    color:#666;
    line-height:1.6;
    margin-bottom:18px;
}

.newsletter-box{
    display:flex;
    align-items:center;
    background:#fff;
    border-radius:25px;
    overflow:hidden;
    width:220px;
    box-shadow:0 2px 8px rgba(0,0,0,.08);
}

.newsletter-box input{
    flex:1;
    border:none;
    outline:none;
    padding:12px 15px;
    font-size:13px;
}

.newsletter-box button{
    width:40px;
    height:40px;
    border:none;
    background:#7b2cff;
    color:white;
    cursor:pointer;
}

.footer-bottom{
    border-top:1px solid #ddd;
    margin-top:50px;
    padding-top:20px;

    display:flex;
    justify-content:space-between;
    align-items:center;
}

.footer-bottom p{
    font-size:12px;
    color:#777;
}

.footer-theme{
    display:flex;
    gap:10px;
}

.footer-theme span{
    width:12px;
    height:12px;
    border:1px solid #999;
}

.footer-theme .active{
    background:#111;
}

@media(max-width:992px){

    .footer-container{
        grid-template-columns:1fr 1fr;
    }

}

@media(max-width:768px){

    .footer{
        padding:50px 25px;
    }

    .footer-container{
        grid-template-columns:1fr;
    }

    .footer-bottom{
        flex-direction:column;
        gap:15px;
    }

}

</style>

<div class="footer-container">

    <div class="footer-about">

        <h2>TiketKonser</h2>

        <p>
            Platform terpercaya untuk pembelian tiket konser
            musik terlengkap di Indonesia. Amankan momen tak
            terlupakanmu bersama kami.
        </p>

        <div class="social-icons">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
        </div>

    </div>

    <div class="footer-links">

        <h4>TiketKonser</h4>

        <a href="#">Tentang Kami</a>
        <a href="#">Karir</a>
        <a href="#">Blog</a>
        <a href="#">Media Kit</a>

    </div>

    <div class="footer-links">

        <h4>Dukungan</h4>

        <a href="#">Pusat Bantuan</a>
        <a href="#">Cara Beli</a>
        <a href="#">Refund Tiket</a>
        <a href="#">Kontak</a>

    </div>

    <div class="footer-links">

        <h4>Legal</h4>

        <a href="#">Syarat & Ketentuan</a>
        <a href="#">Kebijakan Privasi</a>
        <a href="#">Kebijakan Cookie</a>

    </div>

    <div class="newsletter">

        <h4>Newsletter</h4>

        <p>
            Dapatkan info konser terbaru
            langsung di emailmu.
        </p>

        <div class="newsletter-box">

            <input type="email" placeholder="Email Anda">

            <button>
                ➜
            </button>

        </div>

    </div>

</div>

<div class="footer-bottom">

    <p>
        © 2024 TiketKonser. Semua Hak Dilindungi.
    </p>

    <div class="footer-theme">
        <span></span>
        <span class="active"></span>
        <span></span>
    </div>

</div>

</footer>