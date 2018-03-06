<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\PermissionHelpers;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'BAPPEDA Pemerintah Provinsi NTB',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-default navbar-fixed-top',
        ],
    ]);
    
    $menuItems = [
        ['label'=>'Home', 'url'=>['/site/index']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label'=>'Signup', 'url'=>['/site/signup']];
        $menuItems[] = ['label'=>'Login', 'url'=>['/site/login']];
    } else {
        $menuItems[] = ['label'=>'Monev Kegiatan', 'items'=>[
            ['label'=>'Entry Monev','url'=>['realisasi-keg/index']],
            ['label'=>'Laporan','url'=>['report/lap-monev']],
        ]];
        
        $is_admin = PermissionHelpers::requireMinimumRole('AdminSystem');
        if($is_admin) {
            $menuItems[] = ['label'=>'Admin', 'items'=> [
                ['label'=>'User','url'=>['user/index']],
                ['label'=>'Role', 'url'=>['role/index']],
                ['label'=>'Status', 'url'=>['status/index']],
            ]];
        }
        $menuItems[] = [
            'label'=>'Logout ('.Yii::$app->user->identity->username.')',
            'url'=>['/site/logout'],
            'linkOptions'=>['data-method'=>'post'],
            ];             
    }
    $menuItems[] = ['label'=>'About', 'url'=>['/site/about']];
    
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
 
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; BAPPEDA Provinsi NTB <?= date('Y') ?></p>

    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
