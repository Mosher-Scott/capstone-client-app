<?php 
  include_once('common/header.php');
  include_once('common/nav.php');
  include_once('library/connections.php');
  include_once('model/accounts.php');
  //print_r($_SERVER);
?>

<main>
<?php
  
  $emailFound = CheckEmail("scott@scottmosherphotography.com");

  
  echo("Found? $emailFound");
  
?>
</main>

<?php
    require_once('common/footer.php');
?>

<h1>bite me</h1>
</body>
</html>

