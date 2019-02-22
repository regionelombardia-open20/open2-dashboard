<?php
/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    lispa\amos\dashboard
 * @category   CategoryName
 */

namespace lispa\amos\dashboard\models;

use lispa\amos\dashboard\models\base\AmosWidgets as BaseAmosWidgets;
use lispa\amos\dashboard\AmosDashboard;
use yii\helpers\ArrayHelper;

/**
 * @property AmosWidgets[] $childrens
 * @property AmosWidgets $father
 */
class AmosWidgets extends BaseAmosWidgets
{
    const STATUS_ENABLED  = 1;
    const STATUS_DISABLED = 0;
    const TYPE_ICON       = 'ICON';
    const TYPE_GRAPHIC    = 'GRAPHIC';

    public $classname_subdashboard;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['classname_subdashboard'], 'safe'],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'classname_subdashboard' => AmosDashboard::t('amosdashboard', 'Classname'),
        ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChildrens()
    {
        return $this->hasMany(
                \lispa\amos\dashboard\models\AmosWidgets::className(), ['child_of' => 'classname']
        );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFather()
    {
        return $this->hasOne(
                \lispa\amos\dashboard\models\AmosWidgets::className(), ['classname' => 'child_of']
        );
    }
}