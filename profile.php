<?php
ob_start();
session_start();
require_once 'connect.php';
if(!isset($_SESSION['user'])){
  header("Location: index.php");
  exit;
}

$query = "SELECT * FROM people WHERE userid=?";
$stmt = $pdo->prepare($query);
$stmt->execute([$_SESSION['user']]);
$userRow = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<html>
<head><title>You are logged in!</title></head>
<body>
You've made it to the profile page! Congrats... there's nothing here by design, but hey,
you're logged in! Isn't that great? <?php echo $userRow['fname']; ?>
<table><tr>
<td><a href="http://196.168.0.6/Enough_Home.html">Home</a></td>
        <?php
        if($userRow['role'] == "administrator") {
            echo "<td><a href='edit.php'>EDIT</a></td>";
        }
        ?>
<td><a href="logout.php">Logout</a></td>
</tr>
</table>
</body>
</html>
<?php ob_end_flush(); ?>