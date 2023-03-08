<!-- HEADER -->
<header>
    <!-- MAIN HEADER -->
    <div id="header">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- LOGO --O -->

                <!-- SEARCH BAR -->
                <div class="col-md-6">
                    <div class="header-search">
                        <form method="post" action="<?= site_url('page/cari') ?>">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Cari disini" aria-label="Cari disini" id="cari" name="cari" aria-describedby="button-addon2">
                                <div class="input-group-append">
                                    <!-- <i class="fa-solid fa-magnifying-glass"></i> -->
                                    <input type="submit" class="btn btn-warning" id="search" value="Cari">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /SEARCH BAR -->

                <!-- ACCOUNT -->
                <div class="col-md-12 clearfix">
                    <div class="header-ctn">

                        <!-- Cart -->
                        <div class="cart-dropdown">
                            <div class="cart-list">
                                <div class="product-widget">
                                    <div class="product-img">
                                        <img src="./img/product01.png" alt="">
                                    </div>
                                    <div class="product-body">
                                        <h3 class="product-name"><a href="#">product name goes here</a></h3>
                                        <h4 class="product-price"><span class="qty">1x</span>$980.00</h4>
                                    </div>
                                    <button class="delete"><i class="fa fa-close"></i></button>
                                </div>

                                <div class="product-widget">
                                    <div class="product-img">
                                        <img src="./img/product02.png" alt="">
                                    </div>
                                    <div class="product-body">
                                        <h3 class="product-name"><a href="#">product name goes here</a></h3>
                                        <h4 class="product-price"><span class="qty">3x</span>$980.00</h4>
                                    </div>
                                    <button class="delete"><i class="fa fa-close"></i></button>
                                </div>
                            </div>
                            <div class="cart-summary">
                                <small>3 Item(s) selected</small>
                                <h5>SUBTOTAL: $2940.00</h5>
                            </div>
                            <div class="cart-btns">
                                <a href="#">View Cart</a>
                                <a href="#">Checkout <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- /Cart -->

                    <!-- NAVIGATION -->
                    <nav id="navigation">
                        <!-- container -->
                        <!-- responsive-nav -->
                        <div id="responsive-nav">
                            <!-- NAV -->
                            <ul class="navbar-nav">
                                <li><a href="<?= site_url('') ?>" class="active">Home</a></li>
                                <?php if ($activeUser) : ?>
                                    <li><a href="<?= site_url('page/penawaran') ?>">Riwayat Penawaran</a></li>
                                    <li><a href="<?= site_url('page/lelang') ?>">Pemenang Lelang</a></li>
                                    <li><a href="<?= site_url('page/edit') ?>">Hi, <?= $activeUser->nama; ?></a></li>
                                    <li><a href="<?= site_url('page/change') ?>">Change Password</a></li>
                                    <li><a href="<?= site_url('page/logout') ?>">Logout</a></li>
                                <?php endif ?>
                                <?php if (!$activeUser) : ?>
                                    <li><a href="<?= site_url('page/login') ?>">Login</a></li>
                                    <li><a href="<?= site_url('page/register') ?>">Register</a></li>
                                <?php endif ?>
                            </ul>
                            <!-- /NAV -->
                        </div>
                        <!-- /responsive-nav -->
                </div>
                <!-- /container -->
                </nav>
                <!-- /NAVIGATION -->
            </div>
        </div>
        <!-- /ACCOUNT -->
    </div>
    <!-- row -->
    </div>
    <!-- container -->
    </div>
    <!-- /MAIN HEADER -->
</header>
<!-- /HEADER -->