<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            ['attribute'=>'id','contentOptions'=>['style'=>'width: 7%']],
            'username',
            ['attribute'=>'unit_id','value'=>'unitKerja.unit_kerja'],
            ['attribute'=>'role_id', 'value'=>'role.role_name'],
            ['attribute'=>'status_id','value'=>'status.status_name','contentOptions'=>['style'=>'width: 10%']],
            'created_at:datetime',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn','contentOptions'=>['style'=>'width: 6%']],
        ],
    ]); ?>
</div>
