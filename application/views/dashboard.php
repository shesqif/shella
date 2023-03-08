<div id="hot-deal" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <div class="hot-deal">
                    <ul class="hot-deal-countdown">
                        <li>
                            <div>
                                <span>Dress</span>
                            </div>
                        </li>
                        <li>
                            <div>
                                <span>Tas</span>
                            </div>
                        </li>
                        <li>
                            <div>
                                <span>Sepatu</span>
                            </div>
                        </li>
                        <li>
                            <div>
                                <span>Aksesoris</span>
                            </div>
                        </li>
                    </ul>
                    <h2 class="text-uppercase">Fashion</h2>
                    <p>Koleksi</p>
                </div>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /HOT DEAL SECTION -->

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- Products tab & slick -->
            <div class="col-md-13">
                <div class="row">
                    <div class="products-tabs">
                        <!-- tab -->
                        <div id="tab2" class="tab-pane fade in active">
                            <div class="products-slick" data-nav="#slick-nav-2">
                                <!-- product -->
                                <?php foreach ($lelang as $l) : ?>
                                    <div class="product">
                                        <div class="product-img">
                                            <img src="<?= base_url('upload/barang/' . $l->gambar); ?>" alt="" style="width:100%; height: 50vh ;">
                                            <div class="product-label">
                                                <!-- <span class="sale">-30%</span> -->
                                                <!-- <span class="new"></span> -->
                                            </div>
                                        </div>
                                        <div class="product-body">
                                            <h3 class="product-name"><a href="#"><?= $l->nama_barang ?></a></h3>
                                            <h4 class="product-price">IDR <?= number_format($l->harga_awal, 2) ?></h4>
                                            <div class="product-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
                                        <div class="add-to-cart">
                                            <button class="add-to-cart-btn"> <a href="<?= site_url('page/detail_lelang/' . $l->id_lelang) ?>">Tawar Barang</a></button>
                                        </div>
                                    </div>
                                    <!-- /product -->
                                <?php endforeach ?>
                                <!-- product -->
                            </div>
                            <div id="slick-nav-2" class="products-slick-nav"></div>
                        </div>
                        <!-- /tab -->
                    </div>
                </div>
            </div>
            <!-- /Products tab & slick -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->