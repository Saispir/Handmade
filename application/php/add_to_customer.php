<?
session_start();
ob_start();
print_r($_GET);
if(session_status() === PHP_SESSION_NONE){
    $_SESSION['cart'] = [];
}
else{
    print_r($_SESSION);
}

$_SESSION['cart'][] = $_GET['id'];

print_r($_SESSION);

header("Location: ../catalog.php");
ob_end_flush();
?>
