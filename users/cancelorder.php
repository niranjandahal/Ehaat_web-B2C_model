<?php
include '../cors.php';
include '../dbconnection.php';
session_name('validuser');
session_start();
if (isset($_SESSION['userloggedin']) && $_SESSION['userloggedin'] === 'true') {
    $user_id = $_SESSION['user_id'];
    if ($user_id != null) {
        if (isset($_POST['cancelorder'])) {
            //removing product id on the ordereditem column
            $productid = $_POST['product_id'];
            //ordered item listing
            $sql = "SELECT ordereditem FROM users WHERE id = $user_id";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $ordereditem = $row['ordereditem'];
            $ordereditemarray = explode(',', $ordereditem);

            //search for the product id in the ordereditem column and remove it
            $index = array_search($productid, $ordereditemarray);
            if ($index !== false) {
                unset($ordereditemarray[$index]);
            }
            $ordereditem = implode(',', $ordereditemarray);
            $sql = "UPDATE users SET ordereditem = '$ordereditem' WHERE id = $user_id";


            //removing the user id on booked column of the products table where products = $productid
            $sql1 = "SELECT booked FROM products WHERE id = $productid";
            $result1 = $conn->query($sql1);
            $row1 = $result1->fetch_assoc();
            $bookeditem = $row1['booked'];
            $bookeditemarray = explode(',', $bookeditem);


            //search for the user id in the booked column and remove it
            $index1 = array_search($user_id, $bookeditemarray);
            if ($index1 !== false) {
                unset($bookeditemarray[$index1]);
            }
            $bookeditem = implode(',', $bookeditemarray);
            $sql1 = "UPDATE products SET booked = '$bookeditem' WHERE id = $productid";
            if ($conn->query($sql) === TRUE) {
                if ($conn->query($sql1) === TRUE) {
                    // echo "<script>alert('Product removed from your ordered list.')</script>";
                    echo "<script>window.location.href='./ordereditem.php'</script>";
                }
            } else {
                echo "<script>alert('Error removing product from your ordered list.')</script>";
                echo "<script>window.location.href='../index.html'</script>";
            }
        }
    }
} else {
    echo "<script>alert('You are not logged in. Please log in to buy products.')</script>";
    echo "<script>window.location.href='../index.html'</script>";
}
