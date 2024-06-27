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
   <!-- filter -->

    <!-- New Item -->

<section id="sales" class="sales">
<div class="container">
    <div class="product-gallery-one-content">
      <div class="slider-product-one-content-title">
        <h2>Sản phẩm giảm giá</h2>
      </div>
      <div class="product-gallery-one-content-product">
          <?php
                    $sql = "SELECT * FROM sanpham where MAGIAMGIA IS NOT NULL";
                    $res = Check_db($sql);
                    if(mysqli_num_rows($res)){
                        while ($row = mysqli_fetch_assoc($res)) {
                            $masp = $row['MASP'];
                            $tensp = $row['TENSP'];
                            $gia = $row['GIA'];
                            $phantram = View_Discount_Of_Product($masp);
                            if ($gia - $gia * $phantram / 100 != $gia) {
                                $giamoi = $gia - $gia * $phantram / 100;
                            } else {
                                $giamoi = "";
                            }
                            $kichthuocmh = $row['KICHTHUOCMH'];
                            $vixuly = $row['VIXULY'];
                            $ram = $row['RAM'];
                            $res_img = Get_image($masp);
                            $row_img = mysqli_fetch_assoc($res_img);
                            $hinh = $row_img['LINK'];
              ?>
        <div class="product-gallery-one-content-product-item">
          <a href='./view_product.php?masp=<?php echo $masp ?>'>
            <img src='./admin/product_images/<?php echo $hinh ?>' class='card-img-top' alt=''>
            <div class="product-gallery-one-content-product-item-text">
              <h4 class='card-title'><?php echo $tensp ?></h4>
            </div>
            <div class="row mt-3">
              <div class="slider-product-one-content-item-text-money col">
                <?php
                  if ($giamoi == "") {
                    echo " <span>" . $gia . " đ</span>";
                  } else {
                    echo "<s>
                      <span>" . $gia . " đ</span>
                    </s>
                      &nbsp<span style='font-size: 1.2rem; color: white; background-color: red; border: 1px solid transparent; border-radius: 50%'>&nbsp - " . $phantram . "%</span>
                      <li><span class='giaMoi'>" . $giamoi . " đ</span></li>";
                    }
                ?>
              </div>    
            </div>
          </a> 
        </div>
        <?php
        }
      }
      ?>
      </div>
    </div>
</div>
</section>

 <!-- footer -->
    <?php include('./includes/footer.php') ?>
    <!-- script -->
    <?php include('./includes/script.php') ?> 
</body>
</html>