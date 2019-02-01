<?php
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "database";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    

    // prepare sql statements and bind parameters
    $stmt = $conn->prepare("SELECT url, thumbnail FROM `users` WHERE `id` = ?");
	
	$stmt->bind_param("s", $_GET['id']);
	$stmt->execute();
	$result = $stmt->get_result();
	if($result->num_rows === 0) exit('No rows');
	while($website = $result->fetch_assoc()) {
	  
	  echo "<h3>" . $website['url'] . "</h3>";
	  echo "<img src=". $website['thumbnail'] ."/>";
	  echo "You are viewing <a href=" . $_SERVER['PHP_SELF']. "?id=". $_GET['id'] . ">This website</a>";

	}
	
	$stmt->close();
    echo "New records created successfully";
    }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
$conn = null;
?>