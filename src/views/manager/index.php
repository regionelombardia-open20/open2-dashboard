<?php

use lispa\amos\core\forms\ActiveForm;
use lispa\amos\core\icons\AmosIcons;
use lispa\amos\core\views\AmosGridView;
use lispa\amos\core\views\DataProviderView;
use lispa\amos\dashboard\AmosDashboard;
use yii\helpers\Html;

/* * @var \lispa\amos\dashboard\models\AmosUserDashboards $currentDashboard * */
/* * @var \lispa\amos\dashboard\models\AmosWidgets $widgetIconSelectable * */
/* * @var \lispa\amos\dashboard\models\AmosWidgets $widgetGraphicSelectable * */
/* * @var array $widgetSelected * */

/* * @var \yii\web\View $this * */
AmosIcons::map($this);

$this->title = AmosDashboard::t('amosdashboard', 'Gestisci widget');

if ($currentDashboard->module != 'dashboard') {
    $this->params['breadcrumbs'][] = ['label' => AmosDashboard::t('amosdashboard',
            'Amministrazione '.$currentDashboard->module), 'url' => Yii::$app->urlManager->createUrl([$currentDashboard->module])];
}


$this->params['breadcrumbs'][]  = $this->title;
$this->params['widgetSelected'] = $widgetSelected;
?>
<div class="dashboard-default-index">

    <?php $form                           = ActiveForm::begin(); ?>

    <?= Html::hiddenInput('module', $currentDashboard->module) ?>
    <?= Html::hiddenInput('slide', $currentDashboard->slide) ?>
    <input type="hidden" id="saveDashboardUrl" value="<?= Yii::$app->urlManager->createUrl(['dashboard/manager/save-dashboard-order']); ?>"/>
    <h2><?= AmosDashboard::tHtml('amosdashboard', 'Plugins'); ?></h2>
    <div class="plugin-list">
        <?=
        DataProviderView::widget([
            'dataProvider' => $providerIcon,
            'currentView' => $currentView,
            'gridView' => [
                'summary' => false,
                'columns' => [
                    [
                        'class' => 'lispa\amos\core\views\grid\CheckboxColumn',
                        'name' => 'amosWidgetsClassnames[]',
                        'checkboxOptions' => function ($model, $key, $index, $column) {
                            return [
                                'id' => \yii\helpers\StringHelper::basename($model['classname']),
                                'value' => $model['classname'],
                                'checked' => in_array($model['classname'], $this->params['widgetSelected'])
                            ];
                        }
                    ],
                    [
                        'label' => 'Icona',
                        'contentOptions' => ['class' => 'icona'],
                        'format' => 'html',
                        'value' => function ($model) {
                            $object          = \Yii::createObject($model['classname']);
                            $object->setUrl('');
                            $backgroundColor = Yii::createObject($model['classname'])->getClassSpan();
                            if (!$backgroundColor) {
                                $backgroundColor = [1 => 'color-base'];
                            }

                            if (!$backgroundColor[1]) {
                                $backgroundColor = [1 => 'bk-backgroundIcon'];
                            }

                            if (!$backgroundColor[2]) {
                                $backgroundColor = [2 => 'color-base'];
                            }
                            return '<p class="'.$backgroundColor[1].' '.$backgroundColor[2].'">'.AmosIcons::show(Yii::createObject($model['classname'])->getIcon(),
                                    '', 'dash').'</p>';
                        }
                    ],
                    [
                        'label' => 'Nome',
                        'format' => 'html',
                        'attribute' => 'classname',
                        'value' => function ($model) {
                            $object = \Yii::createObject($model['classname']);
                            return $object->getLabel();
                        }
                    ],
                    [
                        'label' => 'Descrizione',
                        'value' => function ($model) {
                            $object = \Yii::createObject($model['classname']);
                            return $object->getDescription();
                        }
                    ],
//TODO - colonna per ragruppamento in base al plugin
//                    [
//                        //'class'=>'kartik\grid\DataColumn',
//                        'attribute' => 'module',
//                        'label' => 'Plugin',
//                        'format' => 'html',
//                        //'group' => true,
//                        'value' => function ($model){
//                            return \yii\helpers\Inflector::camel2words($model->module);
//                        }
//                    ],
                ],
            ],
            'iconView' => [
                'itemView' => '_icon',
                'itemOptions' => [
                    'class' => 'col-xs-12 col-sm-6 col-md-2 col-lg-2 flex-column-item'
                ],
            ],
        ]);
        ?>

        <hr class="m-b-25"/>

        <h2><?= AmosDashboard::tHtml('amosdashboard', 'Widget'); ?></h2>
        <?=
        AmosGridView::widget([
            'dataProvider' => $providerGraphic,
            'summary' => false,
            'columns' => [
                [
                    'attribute' => 'module',
                    'label' => 'Plugin',
                ],
                [
                    'class' => 'lispa\amos\core\views\grid\CheckboxColumn',
                    'name' => 'amosWidgetsClassnames[]',
                    'checkboxOptions' => function ($model, $key, $index, $column) {
                        return [
                            'id' => \yii\helpers\StringHelper::basename($model['classname']),
                            'value' => $model['classname'],
                            'checked' => in_array($model['classname'], $this->params['widgetSelected'])
                        ];
                    }
                ],
                [
                    'label' => 'Icona',
                    'contentOptions' => ['class' => 'icona'],
                    'format' => 'html',
                    'value' => function ($model) {
                        $backgrounColor = 'color-border-mediumBase';
                        return '<p class="'.$backgrounColor.'">'.AmosIcons::show('view-web').'</p>';
                    }
                ],
                [
                    'label' => 'Nome',
                    'format' => 'html',
                    'attribute' => 'classname',
                    'value' => function ($model) {
                        $object = \Yii::createObject($model['classname']);
                        return $object->getLabel();
                    }
                ],
                [
                    'label' => 'Descrizione',
                    'value' => function ($model) {
                        $object = \Yii::createObject($model['classname']);
                        return $object->getDescription();
                    }
                ],
            ]
        ]);
        ?>

        <div class="form-actions pull-right">
            <?=
            Html::submitButton(
                AmosDashboard::t('amosdashboard', 'Salva'), [
                'class' => 'btn btn-success'
            ]);
            ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>




