<?php
include '../config/db.php';
include '../includes/header.php';

// Lấy danh sách sản phẩm đang giảm giá
$query = "SELECT id, name, image_url, price, discount_price FROM products WHERE discount_price IS NOT NULL AND discount_price < price";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khuyến Mãi</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="main-content">
    <h2>🔥 Sản Phẩm Đang Giảm Giá</h2>
    <div class="product-list">
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="product-item">
                <a href="../Pages/productDetail.php?id=<?= $row['id'] ?>">
                    <img src="../<?= htmlspecialchars($row['image_url']) ?>" alt="<?= htmlspecialchars($row['name']) ?>">
                </a>
                <h3><?= htmlspecialchars($row['name']) ?></h3>
                <p class="old-price"><?= number_format($row['price'], 0, ',', '.') ?>đ</p>
                <p class="discount-price"><?= number_format($row['discount_price'], 0, ',', '.') ?>đ</p>
            </div>
        <?php } ?>
    </div>
</div>
</body>
</html>

<?php include '../includes/footer.php'; ?>