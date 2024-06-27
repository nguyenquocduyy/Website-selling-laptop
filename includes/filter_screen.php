<?php 
    require_once('include.php');
    require_once('conn.php');
    require_once('product.php');

    $screen = substr($_GET['screen'],0,3); 
    $sql_kichthuocmh = "SELECT * FROM SANPHAM WHERE kichthuocmh LIKE '%$screen%'";
    $res_screen = Check_db($sql_kichthuocmh);
    
?>

<section id="item" class="item">
<div class="container">
    <div class="product-gallery-one-content">
    <div class="slider-product-one-content-title">
        <h2>Sản phẩm </h2>
      </div>
      <div class="product-gallery-one-content-product">
        <?php
            if(mysqli_num_rows($res_screen) > 0){
                while ($row = mysqli_fetch_assoc($res_screen)) {
                    $masp = $row['MASP'];
                    $tensp = $row['TENSP'];
                    $gia = $row['GIA'];
                    $res_hinh = Get_image($masp);
                    $row_hinh = mysqli_fetch_assoc($res_hinh);
                    $hinh = $row_hinh['LINK'];
                    $phantram = View_Discount_Of_Product($masp);
                    if ($gia - $gia * $phantram / 100 != $gia) {
                        $giamoi = $gia - $gia * $phantram / 100;
                    } else {
                        $giamoi = "";
                    }
                    $kichthuocmh = $row['KICHTHUOCMH'];
                    $vixuly = $row['VIXULY'];
                    $ram = $row['RAM']
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
                          <span >&nbsp - " . $phantram . "%</span>
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
            else{
            ?>
            <div class="row searchItem-content justify-content-center flex-column align-items-center">
            <div class="row" style="padding: 15px">
            <img src='./hinhanh/Out_of_stock.jpg' width="70%" height="70%">
            </div>
                <h3>Rất tiếc cửa hàng tạm hết mặt hàng này</h3>
            </div>
        <?php
            }
        ?>
      </div>
    </div>
</div>
</section>