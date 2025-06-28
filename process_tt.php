<?php
include '../config/db.php';

if (isset($_POST['confirm_payment'])) {
    $order_id = $_POST['order_id'];
    $transaction_id = $_POST['transaction_id'];

    // Cập nhật trạng thái thanh toán
    $updatePayment = "UPDATE Payments SET payment_status = 'Đã thanh toán', transaction_id = ?, paid_at = NOW() WHERE order_id = ?";
    $stmt = mysqli_prepare($conn, $updatePayment);
    mysqli_stmt_bind_param($stmt, "si", $transaction_id, $order_id);
    $result = mysqli_stmt_execute($stmt);
    
    if ($result) {
        echo "<script>alert('Thanh toán đã được xác nhận!'); window.location.href='../admin/admin_order_manage.php';</script>";
    } else {
        echo "<script>alert('Lỗi khi xác nhận thanh toán!'); window.history.back();</script>";
    }
}
?>
