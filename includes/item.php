<section id="item" class="item">
<div class="container">
    <div class="product-gallery-one-content">
    <div class="slider-product-one-content-title">
        <h2>Sản phẩm </h2>
      </div>
      <div class="product-gallery-one-content-product">
        <?php
            $sql_all_product = "SELECT * FROM sanpham" ;
            $res_all_product = Check_db($sql_all_product);

                while ($row = mysqli_fetch_assoc($res_all_product)) {
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
      ?>
      </div>
    </div>
</div>
</section>