<?php

$errors = [];

if (isset($_POST['delete']) && !empty($_POST['checkedProducts'])) {
  $delProducts = implode(',', $_POST['checkedProducts']);
  $pdo = require_once '../../DBConn.php';
  $query = "DELETE FROM products WHERE id IN ($delProducts)";
  $stmt = $pdo->prepare($query);
  $stmt->execute();
  header('Location: index.php');
} else {
  header('Location: index.php');
}


  // if (empty($_POST['checkedProducts'])) {
  //   header("Location: index.php");
  //   exit();
  // }
