use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Сокращение ссылок';
?>

<div class="short-link-form">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success">
            <?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php endif; ?>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'original_url')->textInput(['maxlength' => true, 'placeholder' => 'Введите ссылку'])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Сократить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
