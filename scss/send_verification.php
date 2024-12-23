<?php
session_start();
include('dbconn.php');

if (isset($_POST['login'])) {
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = trim($_POST['password']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: adminlogin.php?error=Invalid email format");
        exit();
    }

    try {
        $stmt = $conn->prepare("SELECT `password`, `is_verified` FROM `admin` WHERE `email` = :email");
        $stmt->execute(['email' => $email]);
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($admin) {
            // Check if the admin is verified
            if ($admin['is_verified'] == 1) {
                // Verify the password
                if (password_verify($password, $admin['password'])) {
                    // Login successful, set session variables
                    $_SESSION['admin_email'] = $email;
                    echo "<script>
                            alert('Login successful.');
                            window.location.href = 'admin_dashboard.php'; // Redirect to admin dashboard
                          </script>";
                    exit();
                } else {
                    header("Location: adminlogin.php?error=Incorrect password");
                    exit();
                }
            } else {
                header("Location: adminlogin.php?error=Account not verified");
                exit();
            }
        } else {
            header("Location: adminlogin.php?error=No account found with that email");
            exit();
        }
    } catch (PDOException $e) {
        echo "Error: " . htmlspecialchars($e->getMessage());
    }
}
?>
