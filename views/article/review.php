<?php

use app\helpers\Utils;
use kartik\depdrop\DepDrop;
use richardfan\widget\JSRegister;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Article $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$status = [
    Utils::STAT_APPROVED => 'Approve',
    Utils::STAT_REVISION => 'Revision',
    Utils::STAT_REJECT => 'Reject',
]
?>
<div class="article-view">

    <div class="card card-body b-10">

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'title',
                'subtitle',
                'created_at',
                'tag',
                'author_id',
                'cetegory',
                'updated_at',
                'slug',
            ],
        ]) ?>
        <hr>
        <div class="card card-body content">

            <img class=" b-10 w-100" src="<?= Utils::baseUploadsthumbnail($model->thumbnail); ?>" alt="">
            <div class="mt-5">
                <?= Html::decode($model->content) ?>
            </div>
        </div>

        <hr>

        <div class="card card-body">
            <?php $form = ActiveForm::begin(); ?>
            <div class="row">
                <div class="col">
                    <?= $form->field($approval, 'status')->dropDownList($status, ['prompt' => 'Select . . .', 'id' => 'stat']) ?>
                </div>
                <div class="col">
                    <div class="not-approve">

                    </div>
                    <div style="display: none;" class="cl-reason">
                        <?= $form->field($approval, 'idreason')->widget(DepDrop::className(), [
                            'data' => '',
                            'type' => DepDrop::TYPE_SELECT2,
                            'options' => ['id' => 'idbay', 'placeholder' => 'Select ...'],
                            'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                            'pluginOptions' => [
                                'depends' => ['stat'],
                                'url' => Url::to(['reason/ajax-listreason']),
                            ]
                        ])->label('Reason') ?>
                    </div>
                </div>
            </div>
            <div style="display: none;" class="cl-note">
                <?= $form->field($approval, 'note')->widget(alexantr\ckeditor\CKEditor::class, [
                    'clientOptions' => [
                        // 'readOnly' => true,
                        'toolbar' => [
                            ['Styles', '-',]
                        ]
                    ]
                ]); ?>
            </div>

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>



            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
<?php JSRegister::begin() ?>
<script>
    $('#stat').change(function() {
        var stat = $(this).val();
        console.log(stat);
        if (stat == <?= Utils::STAT_APPROVED; ?>) {
            $('.cl-reason').hide();
            $('.cl-note').hide();
            $('.submit-btn').removeClass('btn-danger');
            $('.submit-btn').removeClass('btn-warning');
            $('.submit-btn').removeClass('btn-success');
        } else if (stat == <?= Utils::STAT_REVISION; ?>) {
            $('.cl-reason').show();
            $('.cl-note').show();
            $('.submit-btn').removeClass('btn-danger');
            $('.submit-btn').removeClass('btn-success');
            $('.submit-btn').addClass('btn-warning');
        } else if (stat == <?= Utils::STAT_REJECT; ?>) {
            $('.cl-reason').show();
            $('.cl-note').show();
            $('.submit-btn').addClass('btn-danger');
            $('.submit-btn').removeClass('btn-success');
            $('.submit-btn').removeClass('btn-warning');
        }
    })
</script>
<?php JSRegister::end() ?>