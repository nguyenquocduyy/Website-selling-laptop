<?php
require_once('./includes/include.php');
require_once('./includes/product.php');
$timkiem = $_GET['timkiem'];
?>
<!DOCTYPE html>
<html lang="en">
<?php include('./includes/head.php') ?>

<body>
    <!-- header -->
    <?php include('./includes/header.php') ?>
    <!-- filter -->
    <?php include('includes/filter.php') ?>
    <!-- search item -->
    <section class="searchItem" id="searchItem">
        <div class="container">
            <div class="row searchItem-title">
                <h2>Kết quả sản phẩm tìm kiếm với từ khóa "<strong><?php echo $timkiem ?></strong>"</h2>
            </div>
            <?php
            if (isset($_GET['timkiem'])) {
                $sql = "SELECT * FROM SANPHAM WHERE TENSP LIKE '%$timkiem%'";
                $res = Check_db($sql);
                if (mysqli_num_rows($res) > 0) {
            ?>
            <div class="row searchItem-content">
                <!-- <div class="row"> -->
                <div class="row" style="padding: 15px">
                    <?php
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
                <?php
                }
                 else {
                ?> <div class="row searchItem-content justify-content-center flex-column align-items-center">
                    <!-- <div class="row"> -->
                        <div class="row" style="padding: 15px">
                            <img src='https://fptshop.com.vn/Content/v4/images/noti-search.png'>
                        </div>
                        <div>
                            <h3>Rất tiếc không tìm thấy kết quả của "<strong><?php echo $timkiem ?></strong>"</h3>
                        </div>
                    </div>
                    <?php
                }
            }
                    ?>
    </section>
    <!-- footer -->
    <?php include('./includes/footer.php') ?>
    <!-- script -->
    <?php include('./includes/script.php') ?>
</body>

</html>