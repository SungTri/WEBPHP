<?php
include '../config/db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['product_id'];
    $size = $_POST['size'];
    $quantity = $_POST['quantity'];

    // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
    $check_cart_query = "SELECT * FROM cart WHERE user_id = ? AND product_id = ? AND size = ?";
    $stmt = mysqli_prepare($conn, $check_cart_query);
    mysqli_stmt_bind_param($stmt, "iis", $user_id, $product_id, $size);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $cart_item = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    if ($cart_item) {
        // Nếu sản phẩm đã có trong giỏ hàng, cập nhật số lượng
        $new_quantity = $cart_item['quantity'] + $quantity;
        $update_cart_query = "UPDATE cart SET quantity = ? WHERE user_id = ? AND product_id = ? AND size = ?";
        $stmt = mysqli_prepare($conn, $update_cart_query);
        mysqli_stmt_bind_param($stmt, "iiis", $new_quantity, $user_id, $product_id, $size);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    } else {
        // Nếu sản phẩm chưa có trong giỏ hàng, thêm mới
        $add_to_cart_query = "INSERT INTO cart (user_id, product_id, size, quantity) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $add_to_cart_query);
        mysqli_stmt_bind_param($stmt, "iisi", $user_id, $product_id, $size, $quantity);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    header("Location: ../Pages/Cart.php");
    exit();
} else {
    echo "<script>alert('Phương thức không hợp lệ!'); window.location.href='../Pages/Shop.php';</script>";
}
?>