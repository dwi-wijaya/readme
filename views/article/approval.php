<?php

use app\controllers\ArticleController;
use app\helpers\AuthHelpers;
use app\models\Article;
use app\models\MSTLABEL;
use app\models\MSTLOC;
use app\models\MSTRELAY;
use kartik\bs4dropdown\Dropdown as Bs4dropdownDropdown;
use kartik\daterange\DateRangePicker;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;
use kartik\select2\Select2;
use richardfan\widget\JSRegister;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\ButtonDropdown;
use yii\bootstrap4\Dropdown;
use yii\bootstrap5\Dropdown as Bootstrap5Dropdown;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Submission ';
$this->params['breadcrumbs'][] = $this->title;
$status = [
    1 => 'DONE',
    0 => 'DRAFT'
]
?>
<style>
    .kv-table-header {
        background: white !important;
    border-top: 1px solid #dee2e6;
    }
</style>
<!-- <span class="badge badge-secondary p-2">Waiting</span> -->
<div class="trs-data-index">

    <div class=" card card-body  b-10">
        <h3 class="text-center">Waiting Approval</h3>
        <hr>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'author_id',
                'title',
                'category.name',
                [
                    'attribute' => 'created_at',
                    'value' => function($m){
                        return Yii::$app->formatter->asDate($m->created_at);
                    }
                ],
                [
                    'attribute' => 'status',
                    'value' => function($m){
                        return '<span class="badge badge-primary p-2">Waiting</span>';
                    },
                    'format' => 'html',
                ],
                [
                    'class' => 'app\helpers\ButtonActionColumn',
                    'headerOptions' => ['style' => 'min-width:50px'],
                    'contentOptions' => ['class' => 'text-center', 'style' => 'min-width:50px;vertical-align:middle'],
                    'template' => '{review}',
                    'buttons' => [
                        'review' => function ($url, $model) {
                            return Html::a('<i class="fa fa-search"></i>', ['review', 'id' => $model['idarticle'],'urlfrom' => 'approval'], [
                                'title' => 'Review',
                                'style' => 'font-size:10px',
                                'class' => 'mb-1 mr-1 btn btn-sm btn-outline-primary'
                            ]);
                        },
                    ],
                    // 'urlCreator' => function ($action, $model, $key, $index) {
                    //     return Url::to(['mstmap/' . $action, 'id' => $model['idmap']]);
                    // },
                ]
                // [
                //     'attribute' => 'ideqp',
                //     'value' => 'relayname',
                //     'label' => 'Nama Alat',
                // ],

            ],
        ]); ?>
        <div class="pull-right">
            <?php
            
            ?>
            <?php  ?>
        </div>
    </div>
</div>

<?php JSRegister::begin(); ?>
<script>
        $('#single-approve').click(function() {
        var id = $(this).attr('data');
        console.log("id : " + id);
        var url = "<?= Url::to(['ajax-approved']) ?>";
        $.post(url, {
            data: {
                id: id
            }
        });
    });
    $('#btn-approve').on('click', function(e) {
        var form_input = document.getElementById('form-input');
        var data = getData();
        console.log(data)
        if (data.length == 0) {
            return false;
        }
        form_input.value = data.join('-');
    });

    $('#btn-reject').on('click', function(e) {
        var form_input = document.getElementById('form-input');
        var data = getDataReject();
        if (data.length == 0) {
            return false;
        }
        form_input.value = data.join('-');
    });

    function getData() {
        var selected = $("input[name='items[]']:checked");
        var data = [];
        if (selected.length < 1) {
            $('#modal-form-warning').modal('show');
        }
        $(selected).each(function() {
            data.push($(this).val());
        });
        return data;
    }

    function getDataReject() {
        var selected = $("input[name='items[]']:checked");
        var data = [];
        if (selected.length < 1) {
            $('#modal-form-warning').modal('show');
        } else {
            data.push('reject');
            $(selected).each(function() {
                data.push($(this).val());
            });
        }
        return data;
    }
</script>
<?php JSRegister::end(); ?>