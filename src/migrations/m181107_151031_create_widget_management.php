<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    lispa\amos\basic\template
 * @category   CategoryName
 */

use lispa\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;

class m181107_151031_create_widget_management  extends \lispa\amos\core\migration\AmosMigrationWidgets
{
    const MODULE_NAME = 'dashboard';

    /**
     * @inheritdoc
     */
    protected function initWidgetsConfs()
    {
        $this->widgets = [
            [
                'classname' => \lispa\amos\dashboard\widgets\icons\WidgetIconManagement::className(),
                'type' => \lispa\amos\dashboard\models\AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'dashboard_visible' => 1,
                'status' => \lispa\amos\dashboard\models\AmosWidgets::STATUS_ENABLED
            ]
        ];
    }
}
