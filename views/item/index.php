<?php

use yii\helpers\Html;
use yii\grid\GridView;
use mdm\admin\components\RouteRule;
use mdm\admin\components\Configs;

$context = $this->context;
$labels = $context->labels();
$this->title = $labels['Items'];
$this->params['breadcrumbs'][] = $this->title;

$rules = array_keys(Configs::authManager()->getRules());
$rules = array_combine($rules, $rules);
unset($rules[RouteRule::RULE_NAME]);
?>
<div class="role-index">
    <div class="card card-body ">

        <div class="row mt-3">
            <div class="col">
                <h2 class="title-content"><?= Html::encode($this->title) ?></h2>
            </div>
            <div class="col">
                <p class="float-right">
                    <?= Html::a('<i class="fa fa-plus"></i> &nbsp;' . $labels['Item'], ['create'], ['class' => 'btn btn-success']) ?>
                </p>
            </div>
        </div>
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'name',
                    'label' => 'Name',
                ],
                [
                    'attribute' => 'ruleName',
                    'label' => 'Rule Name',
                    'filter' => $rules
                ],
                [
                    'attribute' => 'description',
                    'label' => 'Description',
                ],
                ['class' => 'app\helpers\ButtonActionColumn',],
            ],
        ])
        ?>
    </div>
</div>