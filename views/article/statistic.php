<?php

use richardfan\widget\JSRegister;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Article $model */

$this->title = $model['title'];
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);


$this->registerjsfile('@web/vendor/c3/d3.v3.min.js', );
$this->registerjsfile('@web/vendor/c3/c3.min.js', );
$this->registerCssFile('@web/vendor/c3/c3.min.css', );

?>
<div class="article-view">
    <div class="card card-body">

        <div class="row">
            <div class="col-12">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'title',
                        [
                            'attribute' => 'created_at',
                            'value' => function ($m) {
                                return Yii::$app->formatter->asDate($m['created_at']);
                            }
                        ],
                        'catname:ntext:Category',
                        'tag',
                        [
                            'attribute' => 'clike',
                            'value' => function ($m) {
                                return $m['clike'] + 0;
                            },
                            'label' => 'Like Total',
                        ],
                        [
                            'attribute' => 'cbookmark',
                            'value' => function ($m) {
                                return $m['cbookmark'] + 0;
                            },
                            'label' => 'Bookmark Total',
                        ],
                        [
                            'attribute' => 'view',
                            'value' => function ($m) {
                                return $m['view'] + 0 . ' x';
                            },
                            'label' => 'View',
                        ],

                    ],
                ]) ?>
            </div>
            <div class="col-12">
                <div class="chart" id="chart"></div>
            </div>
        </div>
    </div>

</div>
<?php JSRegister::begin() ?>
<script>
    var chart = c3.generate({
        bindto: '#chart',
        padding: {
            right: 15,
        },
        data: {
            x: 'x',
            columns: <?= $chart; ?>,
        },
        title: {
            text: 'Statistic'
        },
        axis: {
            x: {
                type: 'timeseries',
                tick: {
                    fit: true,
                    format: '%d-%m-%Y'
                }
            },
            y: {
            min: 0,
            max: 10,
            tick: {
                format: d3.format('d')
            },
            padding: {top: 0, bottom: 0}
        }
        },
        line: {
            conenctNull: true
        }
    });
</script>
<?php JSRegister::end() ?>