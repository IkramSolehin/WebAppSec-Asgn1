<?php
// Connect to the MySQL database
$host = 'localhost';
$dbname = 'database';
$username = 'root';
$password = '';

try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
} catch (PDOException $e) {
  die("Error connecting to database: " . $e->getMessage());
}

// Prepare the SQL statement
$stmt = $pdo->prepare("INSERT INTO user_info (name, matricno, currentaddress, homeaddress, email, mobilephone, homephone) VALUES (?, ?, ?, ?, ?, ?, ?)");

// Bind parameters and execute the statement
$stmt->bindParam(1, $_POST['name']);
$stmt->bindParam(2, $_POST['matricno']);
$stmt->bindParam(3, $_POST['currentaddress']);
$stmt->bindParam(4, $_POST['homeaddress']);
$stmt->bindParam(5, $_POST['email']);
$stmt->bindParam(6, $_POST['mobilephone']);
$stmt->bindParam(7, $_POST['homephone']);


$name = $_POST['name'];
$matricno = $_POST['matricno'];
$currentaddress = $_POST['currentaddress'];
$homeaddress = $_POST['homeaddress'];
$email = $_POST['email'];
$mobilephone = $_POST['mobilephone'];
$homephone = $_POST['homephone'];

// Validate the user's input (Late validation)
if (!preg_match('/^[A-Za-z ]+$/', $name)) {
  die("Invalid name");
}

if (!preg_match('/^[0-9]+$/', $matricno)) {
  die("Invalid matric number");
}

if (!preg_match('/^[a-zA-Z0-9\s,\'-]*$/', $currentaddress)) {
  die("Invalid current address");
}

if (!preg_match('/^[a-zA-Z0-9\s,\'-]*$/', $homeaddress)) {
  die("Invalid home address");
}

if (!preg_match('/^[a-z0-9._%+-]+@gmail\.com$/', $email)) {
  die("Invalid email address");
}

if (!preg_match('/^[0-9]+$/', $mobilephone)) {
  die("Invalid mobile phone number");
}

if (!preg_match('/^[0-9]+$/', $homephone)) {
  die("Invalid home phone number");
}

if ($stmt->execute()) {
  // Success. Redirect back to the form page
  header('Location: index.html?status=success');
  exit;
} else {
  // Something wrong
  header('Location: index.html?status=error');
  exit;
}
?>
