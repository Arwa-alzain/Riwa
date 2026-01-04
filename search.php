<?php
include 'db.php';

$search = $_POST['search'] ?? '';
$results = [];

if (!empty($search)) {
    $search = $conn->real_escape_string($search);
    $sql = "SELECT * FROM products WHERE name LIKE '%$search%'";
    $query = $conn->query($sql);

    if ($query->num_rows > 0) {
        while ($row = $query->fetch_assoc()) {
            $results[] = $row;
        }
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>نتائج البحث</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <style>
        body {
            font-family: "Cairo", sans-serif;
            background-color: #fff;
            text-align: center;
            direction: rtl;
            margin: 0;
            padding-top: 100px;
        }

        .navbar {
            background-color: #eae0c8;
            direction: ltr;
        }

        .card {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin: 15px;
            width: 300px;
            background-color: #eae0c8;
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 4px 12px rgba(238, 155, 30, 0.3);
        }

        .card img {
            padding: 10px;
            border-radius: 20px;
        }


        .btn-dark:hover {
            background-color: #8b5e2f;
        }

        .card-price {
            font-size: 20px;
            color: #333;
            margin: 7px;
        }

        #add-toast {
            position: fixed;
            top: 90px;
            right: 30px;
            background-color: #28a745;
            color: white;
            padding: 15px 25px;
            border-radius: 8px;
            font-size: 18px;
            display: none;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            z-index: 9999;
        }
    </style>
</head>

<body>

    <nav class="navbar fixed-top">
        <div class="container d-flex justify-content-between align-items-center">
            <img src="images/riwa.avif" alt="logo" width="50" height="50" class="mx-3" />
        </div>
    </nav>

    <div id="add-toast">تمت الإضافة إلى السلة</div>

    <div class="container">
        <h3 class="my-4">نتائج البحث</h3>

        <div class="row justify-content-center">
            <?php if (empty($results)): ?>
                <p>المنتج غير موجود</p>
            <?php else: ?>
                <?php foreach ($results as $p): ?>
                    <div class="card">
                        <img src="<?= $p['image'] ?>" alt="<?= $p['name'] ?>"
                            style="width:100%; height:300px; object-fit:cover;">
                        <div class="card-body">
                            <h5><?= $p['name'] ?></h5>
                            <p class="card-price"><strong><?= $p['price'] ?><img src="/images/Saudi_Riyal_Symbol-1.png"
                                        alt="full" style="width: 20px; height: 20px;" /></strong></p>
                            <button class="btn btn-dark add-to-cart" data-name="<?= htmlspecialchars($p['name']) ?>"
                                data-price="<?= $p['price'] ?>" data-image="<?= $p['image'] ?>">
                                اشترِ الآن
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <a href="index.php" class="btn btn-dark my-3">العودة للصفحة الرئيسية</a>
    </div>

    <script>
        document.addEventListener("click", function (e) {
            if (e.target.classList.contains("add-to-cart")) {
                const button = e.target;
                const name = button.dataset.name;
                const price = Number(button.dataset.price);
                const image = button.dataset.image;

                let cart = JSON.parse(localStorage.getItem("cart")) || [];
                const existingIndex = cart.findIndex(item => item.name === name);

                if (existingIndex > -1) {
                    cart[existingIndex].quantity = (cart[existingIndex].quantity || 1) + 1;
                } else {
                    cart.push({ name, price, image, quantity: 1 });
                }

                localStorage.setItem("cart", JSON.stringify(cart));

                const toast = document.getElementById("add-toast");
                toast.style.display = "block";
                toast.textContent = `تمت إضافة "${name}" إلى السلة`;
                setTimeout(() => toast.style.display = "none", 2000);
            }
        });
    </script>
</body>

</html>