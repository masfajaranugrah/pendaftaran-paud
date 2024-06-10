<?php 
// Start session
session_start();

// Include database connection
include '../koneksi/config.php';

// Get username and password from the login form
$username = $_POST['username'];
$password = $_POST['password'];

// Query to select user data based on the provided username
$login = mysqli_query($koneksi, "SELECT * FROM tbl_admin WHERE username='$username'");
// Check if user exists
if(mysqli_num_rows($login) > 0){
    // Fetch user data
    $data = mysqli_fetch_assoc($login);
    
    // Verify the provided password against the hashed password stored in the database
    if(password_verify($password, $data['password'])){
        // Set session variables based on user level
        $_SESSION['username'] = $username;
        $_SESSION['level'] = $data['level'];
        
        // Redirect based on user level
        if($data['level'] == "admin"){
            header("location: halaman_admin.php");
        } elseif($data['level'] == "super_admin"){
            header("location: halaman_super_admin.php");
        }
    } else {
        // Redirect to login page with error message
        header("location: index.php?pesan=gagal");
    }
} else {
    // Redirect to login page with error message
    header("location: index.php?pesan=gagal");
}
?>
