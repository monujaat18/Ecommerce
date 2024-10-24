<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("connection.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if all fields are filled
    if (!empty($name) && !empty($username) && !empty($email) && !empty($password) && isset($_POST['agree'])) {
        
        // Check if username or email already exists
        $checkQuery = $conn->prepare("SELECT * FROM signup WHERE USERNAME = ? OR EMAIL = ?");
        $checkQuery->bind_param("ss", $username, $email);
        $checkQuery->execute();
        $result = $checkQuery->get_result();

        if ($result->num_rows > 0) {
            // User or email already exists
            $error = "Username or Email already exists. Please choose another.";
        } else {
            // Insert new user into the database
            $sql = $conn->prepare("INSERT INTO signup(NAME,USERNAME,EMAIL,PASSWORD) VALUES(?,?,?,?)");
            if ($sql === false) {
                die("Prepare failed: " . $conn->error);
            }
            $passhash = password_hash($password, PASSWORD_DEFAULT);
            $sql->bind_param("ssss", $name, $username, $email, $passhash);

            if ($sql->execute()) {
                // Check if data was added
                if ($conn->affected_rows === 1) {
                    // Data was successfully added
                    header("Location: signin.php");
                    exit(); // Ensure no further code is executed
                } else {
                    $error = "Error occurred while signing up. Please enter details  again.";

                }
            } else {
                $error = "Error occurred while signing up. Please try again.";
            }
            $sql->close();
        }
        $checkQuery->close();
    } else {
        $error = "Please fill in all fields and agree to the terms.";
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="signupstyle.css">
</head>
<body>
    <div class="container">
        <div class="left">
            <span class="logo">Luxe Threads</span>
        </div>
        <div class="right">
            <h1>Sign up</h1>
            <p class="link">Already have an account? <a href="signin.php">Sign In</a></p>
            <?php if (isset($error)) {
                echo "<p style='color:red;'>$error</p>";
            } ?>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="text" name="name" placeholder="Your name" required>
                <input type="text" name="username" placeholder="Username" required>
                <input type="email" name="email" placeholder="Email address" required>
                <div class="password-container">
                    <input type="password" id="password" name="password" placeholder="Password" required>
                    <img src="./assets/huge-icon-interface-outline-eye.svg" id="togglePassword" alt="Toggle Password Visibility" style="cursor: pointer;">
                </div>
                <div class="checkbox-container">
                    <input type="checkbox" id="agree" name="agree" required>
                    <label for="agree" class="terms">I agree with Privacy Policy and Terms of Use</label>
                </div>
                <button type="submit">Sign Up</button>
            </form>
        </div>
    </div>
    <script src="signup.js"></script>
</body>
</html>