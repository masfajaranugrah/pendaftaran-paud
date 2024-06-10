<!--  -->

<?php
if(isset($_POST['login'])){
    // Get data from the login form
    $nik = $_POST['nik'];
    $password = $_POST['password'];
    
    // Select user data from tbl_daftar with the corresponding nik
    $data = mysqli_query($koneksi, "SELECT * FROM tbl_daftar WHERE nik='$nik'") or die(mysqli_error($koneksi));
    
    // Check if the user exists
    if(mysqli_num_rows($data) > 0) {
        $data1 = mysqli_fetch_array($data);
        $no_pendaftaran = $data1['no_pendaftaran'];
        $hashed_password = $data1['password']; // Fetch the hashed password from the database
        
        // Verify the provided password against the hashed password
        if(password_verify($password, $hashed_password)) {
            $_SESSION['no_pendaftaran'] = $no_pendaftaran;
            echo '<script>alert("Login Sukses!"); document.location="user/home.php";</script>';
        } else {
            echo '<script>alert("Password Salah!");</script>';
        }
    } else {
        echo '<script>alert("NIK Tidak Ditemukan!");</script>';
    }
}
?>
