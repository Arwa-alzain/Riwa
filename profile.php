<?php
session_start();
include "db.php";

if (!isset($_SESSION['username'])) {
    header('Location: login.html');
    exit();
}

$username = $_SESSION['username'];

$stmt = $conn->prepare("SELECT username, email FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$order_query = $conn->prepare("SELECT * FROM orders WHERE username = ? ORDER BY order_date DESC");
$order_query->bind_param("s", $username);
$order_query->execute();
$orders = $order_query->get_result();
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الملف الشخصي</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <style>
        body {
            font-family: "Cairo", sans-serif;
            background-color: #eae0c8;
        }

        .profile-container {
            max-width: 600px;
            margin: 100px auto 40px auto;
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h2, h4 {
            color: #5a2c04;
            margin-bottom: 20px;
        }

        .order-card {
            background-color: #fff8e6;
            border: 1px solid #c7b485;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
        }

        .order-card strong {
            color: #5a2c04;
        }

        .nav-bar {
            background-color: #fff;
            padding: 10px 30px;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            direction: ltr;
        }
    </style>
</head>

<body>
    <nav class="nav-bar fixed-top">
        <div class="container d-flex justify-content-between align-items-center">
            <img src="images/riwa.avif" alt="logo" width="55" height="55" />
        </div>
    </nav>
    
    <div class="profile-container text-center">
        <h2>الملف الشخصي</h2>
        <p><strong>اسم المستخدم:</strong> <?= htmlspecialchars($user['username']); ?></p>
        <p><strong>البريد الإلكتروني:</strong> <?= htmlspecialchars($user['email']); ?></p>
        <a href="index.php" class="btn btn-dark mt-3">العودة للرئيسية</a>
        <a href="logout.php" class="btn btn-dark mt-3">تسجيل الخروج</a>

        <hr class="my-4">

        <h4>طلباتي السابقة</h4>

        <?php if ($orders->num_rows > 0): ?>
            <?php while ($order = $orders->fetch_assoc()): ?>
                <div class="order-card text-end">
                    <p><strong>رقم الطلب:</strong> <?= $order['order_id']; ?></p>
                    <p><strong>طريقة الدفع:</strong> <?= $order['payment_method']; ?></p>
                    <p><strong>المجموع:</strong> <?= number_format($order['total_price'], 2); ?><img
                            src="images/Saudi_Riyal_Symbol-1.png" alt="ريال"
                            style="width: 20px; height: 20px; vertical-align: middle; margin-right: 5px;"></p>
                    <p><strong>تاريخ الطلب:</strong> <?= $order['order_date']; ?></p>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>لا توجد طلبات سابقة بعد.</p>
        <?php endif; ?>
    </div>
</body>

</html>