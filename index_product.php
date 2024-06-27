<?php
require_once('./includes/include.php');
require_once('./includes/conn.php');
require_once('./includes/product.php');
$sql_all_product = "SELECT * FROM sanpham" ;
$res_all_product = Check_db($sql_all_product);

?>
<!DOCTYPE html>
<html>
<?php include('./includes/head.php') ?>

<body>
<!-- header -->
  <?php include('./includes/header.php') ?>
    <!-- banner -->
    <section class="carousel">
        <div class="container">
            <div id="carouselExampleSlidesOnly" class="carousel- slide" data-ride="carousel">
                <div class="carousel-inner" role="listbox">
                    <div class="carousel-item active">
                        <img src="./FE/image/banner-1143x357-1.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="./FE/image/banner2.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="./FE/image/banner-laptop-800x300.png" class="d-block w-100" alt="...">
                    </div>
                </div>
            </div>
        </div>
    </section>
   <!-- filter -->
    <?php include('./includes/filter.php') ?>
    <!-- New Item -->
    <?php
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        switch ($action) {
            case 'filter_ram';
                include './includes/filter_ram.php';
                break;

            case 'filter_cpu';
                include './includes/filter_cpu.php';
                break;

            case 'filter_producer';
                include './includes/filter_producer.php';
                break;

            case 'filter_price';
                include './includes/filter_price.php';
                break;
        }
    } else {
        include './includes/item.php';
      }
    ?>

 <!-- footer -->
    <?php include('./includes/footer.php') ?>
    <!-- script -->
    <?php include('./includes/script.php') ?> 
</body>
</html>