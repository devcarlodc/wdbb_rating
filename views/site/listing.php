<?php

use yii\grid\GridView; 
?>
<?php if(!empty(Yii::$app->session->getFlash('success'))): ?>
	<div class="alert alert-success alert-dismissible" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <?= Yii::$app->session->getFlash('success'); ?>
	</div>
<?php endif; ?>
<?= GridView::widget([
    'dataProvider' => $ratingDP,
    'columns' => [
     	[
            'attribute' => 'wdbbLimit',
            'format' => 'html',
			'value'=>function($data) { return "$".number_format($data->wdbbLimit); },
        ],   
        [
            'attribute' => 'deductible',
            'format' => 'html',
			'value'=>function($data) { return "$".number_format($data->deductible); },
        ], 
        [
            'attribute' => 'baseRate',
            'format' => 'html',
			'value'=>function($data) { return $data->baseRate."%"; },
        ], 
        [
            'attribute' => 'debitModification',
            'format' => 'html',
			'value'=>function($data) { return $data->debitModification."%"; },
        ], 
       	[
            'attribute' => 'creditModification',
            'format' => 'html',
			'value'=>function($data) { return $data->creditModification."%"; },
        ], 
        [
            'attribute' => 'price',
            'format' => 'html',
			'value'=>function($data) { return "$".number_format($data->price); },
        ], 
        'created'
    ],
]); ?>