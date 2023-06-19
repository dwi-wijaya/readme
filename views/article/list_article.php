<?php

use app\helpers\Utils;
use app\models\Article;
use richardfan\widget\JSRegister;
use yii\bootstrap4\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */
$this->title = 'My Article';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .btn-create {
        right: 0;
        position: absolute;
        margin-right: 1.2rem;
    }
</style>
<div class="article-index">
    <div class=" card card-body b-10">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Submitted</a>
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">All</a>
                <a class="btn btn-sm btn-success btn-create" href="<?= Url::to(['/article/create']); ?>"><i class="fa-solid fa-plus"></i>&nbsp; Create</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="mt-4">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            'title',
                            'tag',
                            [
                                'attribute' => 'created_at',
                                'value' => function ($m) {
                                    return Yii::$app->formatter->asDate($m->created_at);
                                }
                            ],
                            [
                                'headerOptions' => ['class' => 'text-center', 'style' => 'min-width:50px'],
                                'contentOptions' => ['class' => 'text-center', 'style' => 'min-width:50px;vertical-align:middle'],
                                'attribute' => 'status',
                                'value' => function ($m) {
                                    return Utils::getStatus($m->status);
                                },
                                'format' => 'raw',
                            ],
                            //'content:ntext',
                            //'author_id',
                            //'thumbnail',
                            //'cetegory',
                            //'updated_at',
                            //'status',
                            //'slug',
                            //'editor_id',
                            //'approved_at',
                            [
                                'class' => 'app\helpers\ButtonActionColumn',
                                'headerOptions' => ['style' => 'min-width:50px'],
                                'contentOptions' => ['class' => 'text-center', 'style' => 'display:flex;min-width:50px;vertical-align:middle'],
                                'template' => '{history}{detail}{update}',
                                'buttons' => [
                                    'detail' => function ($url, $model) {
                                        return Html::a('<i class="fa fa-search"></i>', ['detail', 'id' => $model['slug']], [
                                            'title' => 'Detail',
                                            'style' => 'font-size:10px',
                                            'class' => 'mb-1 mr-1 btn btn-sm btn-outline-primary'
                                        ]);
                                    },
                                    'update' => function ($url, $model) {
                                        return Html::a('<i class="fa fa-pen"></i>', ['update', 'id' => $model['idarticle']], [
                                            'title' => 'Update',
                                            'style' => 'font-size:10px',
                                            'class' => 'mb-1 mr-1 btn btn-sm btn-outline-success',
                                        ]);
                                    },
                                    'history' => function ($url, $model) {
                                        return Html::a('<i class="fa fa-history"></i>', '#history', [
                                            'title' => 'History',
                                            'style' => 'font-size:10px',
                                            'class' => 'mb-1 mr-1 btn btn-sm btn-outline-secondary',
                                        ]);
                                    },

                                ],
                                'visibleButtons' => [
                                    'update' => function ($m) {
                                        return $m->status == -2 || $m->status == -1 || $m->status == 0 ? true : false;
                                    }
                                ]
                            ]
                        ],
                    ]); ?>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <div class="mt-4">

                    <?= GridView::widget([
                        'dataProvider' => $all,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            'title',
                            'tag',
                            [
                                'attribute' => 'created_at',
                                'value' => function ($m) {
                                    return Yii::$app->formatter->asDate($m->created_at);
                                }
                            ],
                            [
                                'attribute' => 'status',
                                'value' => function ($m) {
                                    return Utils::getStatus($m->status);
                                },
                                'format' => 'raw',
                            ],
                            //'content:ntext',
                            //'author_id',
                            //'thumbnail',
                            //'cetegory',
                            //'updated_at',
                            //'status',
                            //'slug',
                            //'editor_id',
                            //'approved_at',
                            [
                                'class' => 'app\helpers\ButtonActionColumn',
                                'headerOptions' => ['style' => 'min-width:50px'],
                                'contentOptions' => ['class' => 'text-center', 'style' => 'min-width:50px;vertical-align:middle'],
                                'template' => '{detail}{approve}{stat}',
                                'buttons' => [
                                    'detail' => function ($url, $model) {
                                        return Html::a('<i class="fa fa-search"></i>', ['article/detail', 'id' => $model['slug']], [
                                            'title' => 'Detail',
                                            'style' => 'font-size:10px',
                                            'class' => 'mb-1 mr-1 btn btn-sm btn-outline-primary'
                                        ]);
                                    },
                                    'stat' => function ($url, $model) {
                                        return Html::a('<i class="fa fa-chart-line"></i>', '#', [
                                            'title' => 'Detail',
                                            'style' => 'font-size:10px',
                                            'data' => $model['idarticle'],
                                            'class' => 'mb-1 mr-1 btn btn-sm btn-outline-secondary statistic'
                                        ]);
                                    },

                                ],
                            ]
                        ],
                    ]); ?>
                </div>
            </div>
        </div>


    </div>
    <div class="article mt-4">
        <?php if ($article == null) : ?>
            <p>Sorry, Searching for <b><?= $model->search; ?></b> not found !</p>
        <?php endif ?>
        <div class="row">
            <?php foreach ($article as $t) : ?>
                <div class="col-6 col-md-4 col-lg-4 mb-4">
                    <div class="article-card card card-body b-10">
                        <div class="card-img">
                            <a href="<?= Url::to(['/article/detail', 'id' => $t['slug']]); ?>">

                                <img class="thumbnail b-10 w-100" src="<?= Utils::baseUploadsthumbnail($t['thumbnail']); ?>" alt="" class="b-10">
                            </a>
                        </div>
                        <div class="title mt-3">
                            <a href="<?= Url::to(['/article/detail', 'id' => $t['slug']]); ?>">

                                <p class="m-0"><b><?= $t['title']; ?></b></p>
                            </a>
                            <small class="text-muted sub-title">
                                <?= $t['subtitle'] ?>
                            </small>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>
<?php
Modal::begin([
    'title' => 'Statistic',
    'id' => 'modal-form',
    'size' => 'modal-lg',
    'class' => 'text-center'
]);
echo "<div id='modal-content'>Mohon Tunggu ...</div>";
Modal::end();

JSRegister::begin();
?>
<script>
    $('.statistic').click(function() {
        var id = $(this).attr('data');
        $('#modal-form').modal('show');
        var url = "<?= Url::to(['article/statistic']) ?>";
        $.post(url, {
            data: {
                id: id
            }
        }, function(data) {
            $('#modal-content').html(data);
        });
    })
</script>


<?php JSRegister::end() ?>