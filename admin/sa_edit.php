<?php 

include('../koneksi/config.php'); 

?>


<!DOCTYPE html>
<html>
<head>
	<title>Halaman Edit</title>
	 <link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    
	<script src="../assets/js/jquery-3.3.1.slim.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/jquery.min.js"></script>
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<div class="container">
			<a class="navbar-brand" href="#">Paud Ceria</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" 
			aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
 
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<a class="nav-link" href="sa_index.php"><span class="fa fa-home fa-fw"></span> Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="sa_tambah.php"><span class="fa fa-plus fa-fw"></span> Tambah</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="logout.php"><span class="fa fa-sign-out fa-fw"></span> Logout</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	
	<div class="container" style="margin-top:20px">
		<h2>Edit Admin</h2>
		
		<hr>
		
		<?php
// Check if the 'id_admin' parameter is set in the URL
if(isset($_GET['id_admin'])){
    // Get the 'id_admin' value from the URL
    $id_admin = $_GET['id_admin'];
    
    // Select the admin data from the database based on the 'id_admin'
    $select = mysqli_query($koneksi, "SELECT * FROM tbl_admin WHERE id_admin='$id_admin'") or die(mysqli_error($koneksi));
    
    // Check if the query returned any rows
    if(mysqli_num_rows($select) == 0){
        echo '<div class="alert alert-warning">ID tidak ada dalam database.</div>';
        exit();
    } else {
        // Fetch the admin data
        $data = mysqli_fetch_assoc($select);
    }

    // Store the admin's level
    $level = $data['level'];
}

// If the 'submit' button is clicked
if(isset($_POST['submit'])){
    // Get data from the form
    $id_admin = $_POST['id_admin'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password']; // Plain text password from the form
    $level = $_POST['level'];

    // Encrypt the plain text password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Update the admin data in the database
    $sql = mysqli_query($koneksi, "UPDATE tbl_admin SET nama='$nama', username='$username', password='$hashed_password', level='$level' WHERE id_admin ='$id_admin'") or die(mysqli_error($koneksi));
    
    if($sql){
        echo '<script>alert("Berhasil menyimpan data."); document.location="sa_index.php";</script>';
    } else {
        echo '<div class="alert alert-warning">Gagal melakukan proses edit data.</div>';
    }
}
?>

		
		<form action="" method="post">

			
			<input type="hidden" name="id_admin" class="form-control" size="4" value="<?php echo $data['id_admin']; ?>">

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nama</label>
				<div class="col-sm-10">
					<input type="text" name="nama" class="form-control" size="4" value="<?php echo $data['nama']; ?>" required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Username</label>
				<div class="col-sm-10">
					<input type="username" name="username" class="form-control" value="<?php echo $data['username']; ?>" required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Password</label>
				<div class="col-sm-10">
					<input type="password" name="password" class="form-control" value="<?php echo $data['password']; ?>" required>
					
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">level</label>
				<div class="col-sm-10">
					
              <div class="radio">
                <label><input type="radio" name="level" value="admin" 
                <?php if ($level == 'admin') { echo "checked"; }?>> Admin</label>
              </div>
             <div class="radio">
                <label><input type="radio" name="level" value="super_admin"
                <?php if ($level == 'super_admin') { echo "checked"; }?>> Super Admin</label>
             </div>
				</div>
			</div>
          
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">&nbsp;</label>
				<div class="col-sm-10">
					<input type="submit" name="submit" class="btn btn-primary" value="SIMPAN">
					<a href="sa_index.php" class="btn btn-warning">KEMBALI</a>
				</div>
			</div>
		</form>
		
	</div>

	
	
</body>
</html>