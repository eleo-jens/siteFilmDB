<?php

include "./connexion/connexion.php";

$id = $_GET['id'];

$sql = "SELECT * FROM film
        WHERE id = :id";
$stmt = $cnx->prepare($sql);
$stmt->bindValue(':id', $id);
$stmt->execute();
$res = $stmt->fetch(PDO::FETCH_ASSOC);
// style="max-width: 840px;"
echo '<div class="card mb-3">';
echo '<div class="row g-0">';
echo '<div class="col-md-4">';
echo '<img src="./img/'. $res['image'] . '" class="img-fluid rounded-start" alt="'. $res['titre'].'">';
echo '</div>';
echo '<div class="col-md-8">';
echo '<div class="card-body">';
echo '<h5 class="card-title">'. $res['titre'] .'</h5>';
echo '<p class="card-text">'. $res['description'] .'</p>';
echo '<p class="card-text">'. $res['dateSortie'] .'</p>';
echo '<p class="card-text">'. $res['duree'] .' minutes</p>';

echo '<select class="rating" data-id="'. $_GET['id']. '">';
echo '<option value="1">Bad</option>';
echo '<option value="2">Mediocre</option>';
echo '<option value="3">Good</option>';
echo '<option value="4">Awsome</option>';
echo '</select>';

echo '</div>';
echo '</div>';
echo '</div>';
echo '<div class="card-footer bg-transparent border-success">';
echo '<p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>';
echo '</div>';
echo '</div>';

?>

<body>
  <!-- <select class="rating" data-id="$id">
    <option value="1">Bad</option>
    <option value="2">Mediocre</option>
    <option value="3">Good</option>
    <option value="4">Awsome</option>
  </select> -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="./node_modules/jquery-bar-rating/jquery.barrating.js"></script>
  <script src="./script/note.js" type="text/javascript"></script>
</body>