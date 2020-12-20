<?PHP
$db = mysqli_connect('mysql', 'root', 'tiger', 'camagru');
$sql_u = "SELECT * FROM users WHERE username='yazid'";
$res_u = mysqli_query($db, $sql_u);
echo mysqli_num_rows($res_u);
?>