<?php

include "./connexion/connexion.php";

$id = $_GET['id'];

$sql = "SELECT * FROM film
        WHERE id = :id";
$stmt = $cnx->prepare($sql);
$stmt->bindValue(':id', $id);
$stmt->execute();
$res = $stmt->fetch(PDO::FETCH_ASSOC);

foreach ($res as $cle => $val) {
    echo $cle . " : " .$val . "<br>";
}
?>
<body>
<select class="rating">
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
</select>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="./node_modules/jquery-bar-rating/jquery.barrating.js"></script>
<script type="text/javascript">
   $(function() {
      $('.rating').barrating({
        theme: 'fontawesome-stars'
      });
   });
</script>
</body>