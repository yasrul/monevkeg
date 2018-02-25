<?php

use yii\grid\GridView;
use miloschuman\highcharts\Highcharts;

/* @var $this yii\web\View */

$this->title = 'Sistem Informasi Monitoring Kegiatan';
?>
<div class="site-index">

        <h1 align="center">MONEV KEGIATAN</h1>

        <p class="lead" align="center">Sistem Informasi Monitoring dan Evaluasi Kegiatan</p>   

    <div class="body-content">
        <div class="row">
            <div class="col-lg-6">               
                <?= Highcharts::widget([
                    'options' => [
                        'chart' => ['type'=> 'column'],
                        'title'=> ['text'=> 'Realisasi Program (%)'],
                        'xAxis'=> [
                            'categories'=> $categories,
                        ],
                        'yAxis'=> [
                            'title'=> ['text'=> 'Persen Realisasi(%)']
                        ],
                        'series'=> $series,
                        'plotOptions'=> [
                            'column'=> [
                                'dataLabels'=> ['enabled'=> TRUE]
                            ]
                        ]
                    ]
                ])
                ?>
            </div>
            <div class="col-lg-6">
                <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'formatter' => ['class'=>'yii\i18n\Formatter' ,'nullDisplay'=>'0'],
                'columns' => [
                    ['class'=>'yii\grid\SerialColumn','contentOptions'=>['style'=>'width :7%']],
                    
                    'Unit_Kerja',
                    'rerata_fisik',
                    'rerata_uang',
                ]
            ]) 
            ?>
            </div>
            
        </div>
        
    </div>
</div>
