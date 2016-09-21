<?php 

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<h1 class="page-header">Rating</h1>

<small><em> * NOTE: ONLY INSERT <strong>NUMERICAL CHARACTER</strong> FOR ALL FIELDS</em></small>

<div class="row" style="padding: 10px 20px; margin-top:10px;">
  <div class="col-md-8">
    <?php

      $form = ActiveForm::begin([
          'id' => 'rating-form',
          'options' => ['class' => 'form-horizontal'],
      ]) 
    ?>

      <?php if(!empty(Yii::$app->session->getFlash('error')) || $rating->hasErrors()): ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <?= Yii::$app->session->getFlash('error').'<br />'.$form->errorSummary($rating); ?>
        </div>
      <?php endif; ?>

      <div class="row">
        <div class="col-md-4">Limit</div>
        <div class="col-md-8">
          <?= $form->field($rating, 'wdbbLimit')->textInput(['class' => 'form-control rating-fields'])->label(false) ?>
        </div>
      </div>

      <div class="row">
        <div class="col-md-4">Deductible</div>
        <div class="col-md-8">
          <?= $form->field($rating, 'deductible')->textInput(['class' => 'form-control rating-fields'])->textInput(['readonly' => ''])->label(false); ?>
        </div>
      </div>

      <div class="row">
        <div class="col-md-4">Base Rate</div>
        <div class="col-md-8">
          <div class="form-group">
            <div class="input-group">
              <input type="text" class="form-control rating-fields" name="Rating[baseRate]" aria-label="Amount (to the nearest dollar)" id="rating-baserate">
              <span class="input-group-addon">%</span>
            </div>
            <div class="help-block"></div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-4">Credit Modification</div>
        <div class="col-md-8">
          <div class="form-group">
            <div class="input-group">
              <input type="text" class="form-control rating-fields" name="Rating[creditModification]" aria-label="Amount (to the nearest dollar)" id="rating-creditmod">
              <span class="input-group-addon">%</span>
            </div>
            <div class="help-block"></div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-4">Debit Modification</div>
        <div class="col-md-8">
          <div class="form-group">
            <div class="input-group">
              <input type="text" class="form-control rating-fields" name="Rating[debitModification]" aria-label="Amount (to the nearest dollar)" id="rating-debitmod">
              <span class="input-group-addon">%</span>
            </div>
            <div class="help-block"></div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-4">Premium (Price)</div>
        <div class="col-md-8">
          <?= $form->field($rating, 'price')->textInput(['class' => 'form-control rating-fields'])->textInput(['readonly' => ''])->label(false); ?>
        </div>
      </div>

      <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />

      <div class="form-group">
          <div class="pull-right">
              <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
          </div>
      </div>

    <?php ActiveForm::end() ?>
  </div>
</div>