<header id="header">
    <div class="container">
        <div class="row header-banner">
            <img height="50%" src="./FE/image/banner.png" alt="">
        </div>
        <div class="row header-navbar">
            <nav class="navbar navbar-expand-lg navbar-light bg-light col-12">
                <div class="container nav-left-right">
                    <a class="navbar-brand" href="./index1.php">
                        <img src="./FE/image/logo.png" alt="">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse header-navbar--content col-sm-10" id="navbarSupportedContent">
                    <form class="" action="./search.php" method="GET">
                        <div class="input-group navbar-search">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-secondary" type="submit"><i class="fa fa-search"></i></button>
                            </div>
                            <input type="text" name="timkiem" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1" style="border-radius: 0 5px 5px 0;">
                        </div>
                    </form>
                        <div class="navbar-select">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="./index_product.php">Laptop</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="./index_sales.php">Giảm giá</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="./index_bestseller.php">Bán chạy</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="./cart.php">Giỏ hàng</a>
                                </li>
                                <li class="nav-item">
                                    <?php
                                        if(isset($_SESSION['taikhoan'])){
                                            echo "<a class=\"nav-link\" href=\"./account.php\">Tài khoản</a>";
                                        }
                                        else{
                                            echo "<a class=\"nav-link\" href=\"./login.php\">Tài khoản</a>";
                                        }
                                    ?>
                                    
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-angle-double-up"></i></button>
</header>