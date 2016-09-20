<?php
    session_start();
    require_once('../php/database.php');

    if(!isset($_SESSION['username'])) { // Make sure to use a good variable
      die(header('location: ../index.php'));
    }

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
  <div id="topBar">
    <div id="header">
      Sidenvägen
    </div>
    <div id="user">
      <?php echo '<span id="userName">' . $_SESSION['username'] . '</span>' ?>
    </div>
    <div id="cartContent">
      <img id="cartImg" src="../pictures/cart.png"></img>
      <div id="cartAmount"><#></div>
    </div>
    <div id='topButtons'>
      <button id="btn-cart" class="btn-top" onclick="location.href = 'cart.php'">Shopping Cart</button>
      <button id="btn-logout" class="btn-top" onclick="location.href = '../php/logout.php';">Logout</button>
    </div>
  </div>
  <div id=productContainer>
    <?php
        foreach ($items as $row) {
          echo "<div id=product>";
          echo "<p id=pHeader>" . $row['name'] . "</p>";
          echo "<div id=productImage><img id=image src='" . $row['image'] . "'></img> </div>";
          echo "<p id=pDesc> Product description: </br>";
          echo $row['description'] . "</p>";
          echo "<p id=pPrice> <span class=\"bold\">Price</span>: ";
          echo "<span class=\"price\">" . '$' . $row['price'] . "</span> </p>";
          echo "<form id=\"" . $row['_id'] . "\">";
          echo "Amount: <input type=\"number\" name=\"amount\" size=\"2\" min=\"1\" max=\"9\">";
          echo "<button onclick=\"return addFunc(this)\" id=\"btn-add\">Add</button>";
          echo "</form>";
          echo "</div>";
        }
    ?>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src='../js/home.js'></script>
</body>
</html>
