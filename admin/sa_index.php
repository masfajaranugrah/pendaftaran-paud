<?php
//memasukkan file ../koneksi/config.php
include('../koneksi/config.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Halaman Index</title>
	 <link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    
	<script src="../assets/js/jquery-3.3.1.slim.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/jquery.min.js"></script>
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="../assets/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/dataTables.bootstrap4.css">
    <script type="text/javascript" src="../assets/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="../assets/js/dataTables.bootstrap4.js"></script>
	
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
					<li class="nav-item active">
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
		<h2>Daftar Admin</h2>
		
		<hr>
		
		<table class="table table-striped table-hover table-sm table-bordered" id="table_admin">
			<thead class="thead-dark">
				<tr>
					<th>NO.</th>
					<th>ID Admin </th>
					<th>Nama </th>
					<th>Username</th>
					<th>Password</th>
					<th>Level</th>
					<th>AKSI</th>
				</tr>
			</thead>
			<tbody>
			<?php
 
// Query to retrieve data from tbl_admin ordered by id_admin
$sql = mysqli_query($koneksi, "SELECT * FROM tbl_admin ORDER BY id_admin DESC") or die(mysqli_error($koneksi));

// Check if there are any rows returned
if(mysqli_num_rows($sql) > 0){
    $no = 1; // Initialize a variable to store the row number
    // Loop through each row of the result set
    while($data = mysqli_fetch_assoc($sql)){
        // Display data in each row
        echo '
        <tr>
            <td>'.$no.'</td>
            <td>'.$data['id_admin'].'</td>
            <td>'.$data['nama'].'</td>
            <td>'.$data['username'].'</td>';
        // Check if the plaintext_password column exists and is not empty
        if(isset($data['plaintext_password']) && !empty($data['plaintext_password'])){
            // Display the plaintext password if it exists
            echo '<td>'.$data['plaintext_password'].'</td>';
        } else {
            // Display the hashed password if plaintext_password does not exist
            echo '<td>'.$data['password'].'</td>';
        }
        echo '<td>'.$data['level'].'</td>
            <td>
                <a href="sa_edit.php?id_admin='.$data['id_admin'].'" class="badge badge-warning">Edit</a>
                <a href="sa_delete.php?id_admin='.$data['id_admin'].'" class="badge badge-danger" onclick="return confirm(\'Yakin ingin menghapus data ini?\')">Delete</a>
            </td>
        </tr>';
        $no++; // Increment the row number
    }
} else {
    // If no rows are returned, display a message
    echo '<tr><td colspan="6">Tidak ada data.</td></tr>';
}
?>

			<tbody>
		</table>
		
	</div>
	
	
</body>
</html>

<script type="text/javascript">
  $(document).ready( function () {
    $('#table_admin').DataTable();
} );

</script>