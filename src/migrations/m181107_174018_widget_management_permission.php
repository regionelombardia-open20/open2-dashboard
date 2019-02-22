<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    lispa\amos\basic\template
 * @category   CategoryName
 */

use yii\db\Schema;

/**
 * Default migration for the relations of the Application Project
 */
class m181107_174018_widget_management_permission extends \lispa\amos\core\migration\AmosMigrationPermissions {

    protected function setAuthorizations()
    {
        $this->authorizations = [
            [
                'name' => \lispa\amos\dashboard\widgets\icons\WidgetIconManagement::className(),
                'type' => \yii\rbac\Permission::TYPE_PERMISSION,
                'description' => 'Permission invitation frontend',
                'ruleName' => null,
                'parent' => ['ADMIN']
            ],
        ];
    }

}
