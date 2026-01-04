<?php
session_start();
include 'db.php';

if ($_POST['username'] && $_POST['password']) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            echo "<script>
                    alert('اسم المستخدم غير موجود. يرجى إنشاء حساب جديد.');
                    window.location.href = 'signup.html';
                  </script>";
            exit();
        }

        $user = $result->fetch_assoc();

        if (password_verify($password, $user["password"])) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['login_success'] = "تم تسجيل الدخول بنجاح!";
            header("Location: index.php");
            exit();
        } else {
            echo "<script>
                    alert('كلمة المرور غير صحيحة، حاول مرة أخرى.');
                    window.location.href = 'login.html';
                  </script>";
            exit();
        }

    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }

    $conn->close();
}
?>
