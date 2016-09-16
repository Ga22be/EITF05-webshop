<?php
    require_once('../php/database.php');
    //require_once('../php/connect_data.php');

    /*
    if(!isset($_SESSION['username'])) { // Make sure to use a good variable
      die(header('location: index.php'));
    }
    */

    $db = new Database();
    $items = $db->getItems();
    /*
    if($db->isConnected()){
      header("Location: noDatabase.html");
      exit();
    }
    */

?>

<!DOCTYPE html> <html lang="en"> <head> <meta charset="UTF-8">
	<title>Sidenvägen</title>
	<link href="/favicon.ico" rel="icon" type="image/x-icon" />
	<style type="text/css">
		@import 'https://fonts.googleapis.com/css?family=Roboto';
		@import '../css/home.css';
		@import '../css/global.css';
	</style>
</head>
<body>
  <div id="header">
    <h1>Here Goes The Title</h1>
  </div>
	<div id="container">
    <p>You have successfully logged in, welcome *insert username*</p>
	</div>
  <div id=productContainer>
    <?php
      //if($items->num_rows() > 0) {
        foreach ($items as $row) {
          echo "<div id=product>";
          echo $row['name'];
          echo "</br>";
          echo "Product description:";
          echo "</br>";
          echo $row['description'];
          echo "</br>";
          echo '$' . $row['price'];
          echo "</div>";
        }
      //}

    ?>
  </div>
</body>
</html>
