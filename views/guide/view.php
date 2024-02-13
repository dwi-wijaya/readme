<?php

use app\helpers\Utils;
use app\models\User;
use richardfan\widget\JSRegister;
use yii\bootstrap4\Modal;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Guides $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Guides', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="guides-view">
    <div class="card card-body">
        <div class="d-flex mb-3 gap-3" style="gap: 1rem;">
            <img width="100" style="border-radius: 5px;" src="<?= Url::base(true) . '/uploads/guides-thumbnail/' . $model->thumbnail  ?>" alt="" srcset="">
            <div class="">
                <h1><?= Html::encode($this->title) ?></h1>
                <p>
                    <?= Html::a('Update', ['update', 'idguide' => $model->idguide], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Delete', ['delete', 'idguide' => $model->idguide], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>
            </div>

        </div>


        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'description',
                'author',
                'level',
                'created_at',
            ],
        ]) ?>
        <hr class="mb-0">
        <div class="row mt-3">
            <div class="col">
                <h3>Guide List</h3>
            </div>
            <div class="col">
                <p class="float-right">
                    <?= Html::a('<i class="fa fa-plus"></i> &nbsp; List', '#', ['data-id' => $model->idguide, 'data-author' => $model->author, 'class' => 'add-list btn trans fw-300 text-upper create-btn btn-success', 'style' => 'float:right;']) ?>
                </p>
            </div>
        </div>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                'order',
                'article.title',
                [
                    'class' => 'app\helpers\ButtonActionColumn',
                    'buttons' => [
                        'update' => function ($url, $list) use ($model) {
                            return  Html::a('<span class="fa fa-pen"><span>',  '#', [
                                'data-id' => $model->idguide,
                                'data-author' => $model->author,
                                'idlist' => $list->idguide_list,
                                'class' => 'btn-modal btn btn-sm btn-warning update-list'
                            ]);
                        },
                    ],
                    'contentOptions' => ['class' => 'text-center', 'style' => 'width:160px;vertical-align:middle'],
                ],
            ],
        ]); ?>
    </div>


</div>
<?php
Modal::begin([
    'title' => '',
    'id' => 'modal-form',
    'centerVertical' => true,
    'size' => 'modal-md',
]);
echo "<div id='modal-content'>Please wait ...</div>";
Modal::end();

JSRegister::begin();
?>
<script>
    $('.add-list').click(function() {
        let id = $(this).data('id');
        let url = "<?= Url::to(['add-list']) ?>";
        let author = $(this).data('author');
        $('#modal-form .modal-title').text('Add List');
        $('#modal-form').modal('show');
        $.post(url, {
            data: {
                id: id,
                author: author
            }
        }, function(data) {
            $('#modal-content').html(data);
        });
    })
    $('.update-list').click(function() {
        $('#modal-form .modal-title').text('Update Lisst');
        var id = $(this).data('id');
        var author = $(this).data('author');
        var idlist = $(this).attr('idlist');
        console.log(idlist);
        console.log(id);
        console.log(author);
        $('#modal-form').modal('show');
        var url = "<?= Url::to(['update-list']) ?>";
        $.post(url, {
            data: {
                id: idlist,
                idlist: idlist,
                author: author

            }
        }, function(data) {
            $('#modal-content').html(data);
        });
    })
</script>


<?php JSRegister::end() ?>