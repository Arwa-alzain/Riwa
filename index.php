<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>رِواء</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    rel="stylesheet"
  />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
  /> 
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <header>
    <div id="add-toast" style="
          display: none;
          position: fixed;
          top: 80px;
          right: 20px;
          background-color: #4caf50;
          color: white;
          padding: 10px 20px;
          border-radius: 8px;
          z-index: 8888;
          font-size: 18px;
        " class="add-toast">
      تمت الإضافة إلى السلة
    </div>

    <nav class="nav-bar fixed-top">
      <div class="container-fluid bg-light">
        <div class="d-flex justify-content-between align-items-center p-3">
          <div class="d-flex align-items-center">
            <img src="images/riwa.avif" alt="logo" width="50" height="50" class="mx-3" />
            <a href="cart.html" class="position-relative mx-3">
              <i class="fas fa-shopping-cart fa-lg" style="color: black"></i>
              <span id="cart-count"
                class="position-absolute top-0 translate-middle badge rounded-pill bg-danger">0</span>
            </a>
            <?php if (isset($_SESSION['username'])): ?>
              <div class="dropdown mx-3">
                <button class="profile-btn">
                  <i class="far fa-user-circle" style="font-size: 30px; color: black"></i>
                  <span><?= htmlspecialchars($_SESSION['username']); ?></span>
                </button>
                <div class="dropdown-content">
                  <a href="profile.php">الملف الشخصي</a>
                  <a href="logout.php">تسجيل الخروج</a>
                </div>
              </div>
            <?php else: ?>
              <a href="login.html" class="mx-3">
                <i class="far fa-user-circle" style="font-size: 30px; color: black"></i>
              </a>
            <?php endif; ?>
            <form action="search.php" method="POST">
              <input type="text" class="search mx-3" id="search" name="search" placeholder="ابحث عن منتج"
                style="direction: rtl" />
            </form>
          </div>
          <div>
            <a href="#main-page" class="text-decoration-none text-dark mx-3">الرئيسية</a>
            <a href="#about-riwa" class="text-decoration-none text-dark mx-3">عن رِواء</a>
            <a href="#our-product" class="text-decoration-none text-dark mx-3">منتجاتنا</a>
            <a href="#footer" class="text-decoration-none text-dark mx-3">تواصل معنا</a>
          </div>
        </div>
      </div>
    </nav>
  </header>

  <div class="hero position-relative text-center text-white" id="main-page">
    <img src="images/hero.png" alt="hero-section" class="img-fluid w-100 hero-img" />
    <div class="overlay"></div>
    <div class="hero-content position-absolute top-50 start-50 translate-middle">
      <h1 class="fw-bold mb-3">لمسة من الأناقة... مصنوعة بحب</h1>
      <p class="mb-4">شنط خرز يدوية تجمع بين الجمال والفن في كل تفصيلة</p>
      <a href="#our-product" class="btn btn-light px-4 py-2 fw-semibold"
        style="background-color: #c7b485; border: navajowhite">تسوقي الآن
      </a>
    </div>
  </div>

  <div class="container">
    <div class="about-riwa" id="about-riwa">
      <h2 class="text-center my-5 fw-bold">عن رِواء</h2>
      <p class="text-center mb-5">
        رِواء هي علامة تجارية سعودية متخصصة في تصميم وتصنيع حقائب الخرز
        اليدوية الفريدة. تأسست رِواء بهدف تقديم منتجات تجمع بين الحرفية
        التقليدية والتصاميم العصرية، مما يجعل كل حقيبة قطعة فنية تعكس ذوق
        وأناقة مرتديها. نحن نؤمن بأن كل حقيبة تحكي قصة، ولذلك نستخدم أجود
        أنواع الخرز والخيوط لنضمن جودة تدوم طويلاً. سواء كنتِ تبحثين عن حقيبة
        تناسب المناسبات الخاصة أو تضيف لمسة فريدة إلى إطلالتك اليومية، فإن
        رِواء تقدم لكِ مجموعة متنوعة من التصاميم التي تلبي جميع الأذواق.
        اكتشفي تشكيلتنا اليوم ودعي رِواء تكون جزءًا من رحلتك في التعبير عن
        نفسك بأناقة
      </p>
    </div>
    <div class="service">
      <h2 class="text-center fw-bold" id="our-product">منتجاتنا</h2>
    </div>
    <div id="products" class="row g-4 text-center product-container">
    </div>
  </div>
  <br>
  <footer class="text-white text-center py-3" style="background-color: #c7b485; width: 100%" , id="footer">
    <div>
      <p class="mb-2" style="color: black">صنع بإتقان | 2025</p>
      <p style="color: black">تواصل معنا</p>
      <a href="https://api.whatsapp.com/send/?phone=966590356704&text&type=phone_number&app_absent=0" target="_blank"
        class="text-black me-3">
        <i class="fab fa-whatsapp fa-lg"></i>
      </a>
      <a href="https://www.instagram.com/@riwa_bags" target="_blank" class="text-black me-3">
        <i class="fab fa-instagram fa-lg"></i>
      </a>
      <a href="https://www.snapchat.com/@riwa_bags" target="_blank" class="text-black me-3">
        <i class="fab fa-snapchat fa-lg"></i>
      </a>
      <a href="https://www.x.com/@riwa_bags" target="_blank" class="text-black me-3">
        <i class="fab fa-x fa-lg"></i>
      </a>
      <a href="https://www.tiktok.com/@riwa_bags" target="_blank" class="text-black me3">
        <i class="fab fa-tiktok fa-lg"></i>
      </a>
    </div>
  </footer>
  <div id="add-toast" class="toast-message"></div>
</body>
<script src="cart.js"></script>
</html>