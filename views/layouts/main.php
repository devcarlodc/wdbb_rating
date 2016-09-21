<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <?= Html::csrfMetaTags() ?>
    <title> Channel Wind Deductable Buy Back </title>
    <?php $this->head() ?>
  </head>

  <body>
  <?php $this->beginBody() ?>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Channel Wind Deductable Buy Back</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="<?= Url::base(); ?>">Home</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li><a href="<?= Url::base(); ?>">Home</a></li>
            <li><a href="<?= Url::to(['site/listing']); ?>">List</a></li>
            <li><a href="<?= Url::to(['site/rating']); ?>">Rating</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <?= $content; ?>
        </div>
      </div>
    </div>

  <?php $this->endBody() ?>
  </body>
</html>
<?php $this->endPage() ?>


<script>
$(document).on('keyup', '#rating-wdbblimit', function() {
  var wdbbLimit = ifIsNan($(this).val());
  $.ajax({
     url: "<?= Url::to(['site/deductiblerate']); ?>",
     method: "POST",
     data: { 'limit' : wdbbLimit, '_csrf' : "<?=Yii::$app->request->getCsrfToken()?>" },
     success: function(response) {
        rate = (response / 100);
     },
     complete: function() {
        var deductible = parseFloat(wdbbLimit * rate).toFixed(2);
        $('#rating-deductible').val(deductible);
     },
     error: function() {
        alert("ERROR in running requested function. Page will now reload.");
        location.reload();
     }
  });
});

$(document).on('keyup', '.rating-fields', function() {
  var wdbbLimit = ifIsNan($('#rating-wdbblimit').val());
  var deductible = ifIsNan($('#rating-deductible').val());
  var baseRate = ifIsNan($('#rating-baserate').val()) / 100;
  var creditModification = ifIsNan($('#rating-creditmod').val()) / 100;
  var debitModification = ifIsNan($('#rating-debitmod').val()) / 100;
  var rating_price = 0;

  rating_price = parseFloat((wdbbLimit - deductible) * (baseRate * (1 + (debitModification - creditModification)))).toFixed(2);

  $('#rating-price').val(rating_price);
});

function ifIsNan(val)
{
  if(isNaN(val) ) {
    return 0;
  } else {
    return val;
  }
}

</script>
