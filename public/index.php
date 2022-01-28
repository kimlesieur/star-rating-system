<?php
  require dirname(__DIR__).'./vendor/autoload.php';
  use App\{Connection, ProductTable, Products, Notation};

  $userId = 900; //fixe pour la démo

  /* 
  Librairie Whoops pour visualisation des erreurs plus détaillée
  */
  $whoops = new \Whoops\Run;
  $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
  $whoops->register();

  $pdo = Connection::getPDO();
  $products = (new ProductTable($pdo))->getProducts(Products::class);

  $notation = new Notation($pdo);

  //If detect that JS made a submit of the invisible form (by click), Launch saveNotation() and display a notification of success
  if (isset($_POST["pid"]) && isset($_POST["stars"])) {
      if ($notation->saveNotation($_POST["pid"], $userId, $_POST["stars"])) {
        echo "<div class='note'>Merci pour la note !</div>";
      } else { echo "<div class='note'>$notation->error</div>"; }
    }
  

 ?>

<!DOCTYPE html>
<html>
  <head>
    <title>Rate me !</title>
    <link rel="stylesheet" href="./assets/css/style.css"/>
  </head>
  <body>
    <div id="demo">  
      <?php foreach ($products as $product): ?>
          <div class="pRow">
            <div class="pName"><?=$product->getName()?></div>
            <div>id = <?=$product->getId()?></div>
            <div class="pPrice"><?=$product->getPrice()?> €</div>
            <div class="pDesc"><?=$product->getDescription()?></div>
            <div class="pReview">Note client</div>
            <div class="pStar" data-pid="<?=$product->getId()?>">

              <?php
                 $note2 = $notation->getNotation($userId, $product->getId());
                for($i=1; $i<=5; $i++)
                {
                  $class = $i<=$note2 ? "star" : "star blank";
                  echo "<div class='$class' data-num='$i'></div>";
                }
              ?>

            </div>
            <div class="pStat">
            <?php  
              $note = $notation->getNotation($userId, $product->getId());
              echo "Votre note : ".$note." sur 5 étoiles";
                ?>  
            </div>
            <div class="pStat">
                  Note moyenne : <?php echo $notation->getAverageNotation($product->getId()) ?> sur 5 pour <?php echo $notation->getTotalCount($product->getId()) ?> évaluations.
            </div>
          </div>
      <?php endforeach; ?>
    </div>

    <!-- Hidden form to submit a new notation when click on stars -->
    <form id="form" method="post" target="_self">
      <input id="product" type="hidden" name="pid"/>
      <input id="starNum" type="hidden" name="stars"/>
    </form>

    <script src="./assets/js/script.js" type="text/javascript"></script>
  </body>
</html>
