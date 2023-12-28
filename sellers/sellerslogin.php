<?php
include '../cors.php';
session_name('validseller');
session_start();
include '../dbconnection.php';
if (!$conn) {
    die("Error connecting to database: " . mysqli_connect_error());
}
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $query = "SELECT * FROM sellers WHERE email = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['ref_seller_id'] = $row['id'];
            $_SESSION['seller_name'] = $row['full_name'];
            $_SESSION['seller_email'] = $row['email'];
            echo "<script>alert('You are logged in')</script>";
            // echo "<script>window.location.href='addproduct.php'</script>";
            echo "<script>window.location.href='./sellerpage.php'</script>";

            // header("Location: addproduct.php");
            // header('Content-Type: application/json');
            // echo json_encode([
            //     'error' => false,
            //     'errormessage' => null,
            //     'seller_name' => $row['full_name'],
            //     'seller_email' => $row['email'],
            //     'seller_phone' => $row['phone_number'],
            //     'seller_address' => $row['address'],
            //     'seller_id' => $row['id'],
            // ]);
            exit();
        } else {
            echo "<script>alert('Invalid password')</script>";
            exit();
        }
    } else {
        echo "<script>alert('Invalid email')</script>";
        // header('Content-Type: application/json');
        // echo json_encode([
        //     'error' => true,
        //     'errormessage' => "User does not exist with this email",
        // ]);
        exit();
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
?>

<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sellers Login Page</title>
</head>

<body>
    <form action="sellerslogin.php" method="post">
        <label>login as selllers </label><br><br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br><br>

        <input type="submit" value="Login"><br><br>
    </form>
    <form action="index.php" method="POST">
        <input type="submit" value="Register new account">
    </form>
    <br><br><button><a href="../index.html">Go to website</a></button><br><br>

</body>

</html> -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Signin Page</title>
    <link href="../dist/output.css" rel="stylesheet" />
</head>

<body>
    <div class="bg-gray-200 dark:bg-gray-900">
        <div class="container flex items-center px-6 py-4 mx-auto overflow-x-auto whitespace-nowrap">
            <a href="../index.html" class="text-gray-600 dark:text-gray-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                </svg>
            </a>

            <span class="mx-5 text-gray-500 dark:text-gray-300 rtl:-scale-x-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
            </span>

            <a href="#" class="text-gray-600 dark:text-gray-200 hover:underline">
                Seller
            </a>

            <span class="mx-5 text-gray-500 dark:text-gray-300 rtl:-scale-x-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
            </span>

            <a href="#" class="text-gray-600 dark:text-gray-200 hover:underline">
                Sign in
            </a>
        </div>
    </div>

    <section class="bg-white dark:bg-gray-900">
        <div class="container flex items-center justify-center min-h-screen px-6 mx-auto">
            <form action="sellerslogin.php" method="post" class="w-full max-w-md">
                <div class="flex justify-center mx-auto">
                    <img class=" h-21" src="../logo.jpg" alt="logo">
                </div>

                <div class="flex items-center justify-center mt-6">
                    <a href="#" class="w-1/3 pb-4 font-medium text-center text-gray-800 capitalize border-b-2 border-blue-500 dark:border-blue-400 dark:text-white">
                        sign in
                    </a>
                    <a href="index.php" class="w-1/3 pb-4 font-medium text-center text-gray-500 capitalize border-b dark:border-gray-400 dark:text-gray-300">
                        sign up
                    </a>

                </div>
                <div class="relative flex items-center mt-6">
                    <span class="absolute">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-3 text-gray-300 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </span>

                    <input type="email" class="block w-full py-3 text-gray-700 bg-white border rounded-lg px-11 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40" placeholder="Email address" name="email" id="email" required>
                </div>
                <div class="relative flex items-center mt-4">
                    <span class="absolute">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-3 text-gray-300 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </span>

                    <input type="password" class="block w-full px-10 py-3 text-gray-700 bg-white border rounded-lg dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40" placeholder="Password" name="password" id="password" required>
                </div>


                <div class="mt-6">
                    <button class="w-full px-6 py-3 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-500 rounded-lg hover:bg-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                        Sign In
                    </button>

                    <div class="mt-6 text-center ">
                        <a href="index.php" class="text-sm text-blue-500 hover:underline dark:text-blue-400">
                            Don't have an account?
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </section>
</body>

</html>