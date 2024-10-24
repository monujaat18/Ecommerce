<?php
session_start();
include('connection.php'); // Include your database connection

$error_message = ""; // Initialize error message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the username/email and password from the form
    $usernameOrEmail = $_POST['usernameOrEmail'];
    $password = $_POST['password'];

    // Prepare and execute the query to check the credentials
    $query = "SELECT password FROM signup WHERE (username = ? OR email = ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $usernameOrEmail, $usernameOrEmail);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashedPasswordFromDB = $row['password'];

        // Verify the password
        if (password_verify($password, $hashedPasswordFromDB)) {
            // Password is correct, proceed with login
            $_SESSION['username'] = $usernameOrEmail;

            // Set secure and HttpOnly flags for session cookie
            session_set_cookie_params(['secure' => true, 'httponly' => true]);
            header("Location: home.php");
            exit();
        }
    }
    // Generic error message
    $error_message = "Invalid username or password.";
    
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="signin.css">
</head>
<body>
    <div class="container">
        <div class="left">
            <span class="logo">Luxe Threads</span>
        </div>
        <div class="right">
            <h1>Sign In</h1>
            <p class="link">Don’t have an account yet? <a href="signup.php">Sign Up</a></p>
            <?php if (!empty($error_message)): ?>
                <p style="color: red;" class="error"><?php echo $error_message; ?></p>
            <?php endif; ?>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="text" name="usernameOrEmail" placeholder="Your username or email address" required>
                <div class="password-container">
                    <input type="password" name="password" placeholder="Password" required>
                    <img src="./assets/huge-icon-interface-outline-eye.svg" alt="eye icon">
                </div>
                <div class="options">
                    <label><input type="checkbox"> Remember me</label>
                    <a href="#" onclick="alert('Forgot password is temporarily unavailable'); return false;">Forgot password?</a>
                </div>
                <button type="submit">Sign In</button>
            </form>
        </div>
    </div>
</body>
</html>