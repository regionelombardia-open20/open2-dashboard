<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    lispa\amos\dashboard
 * @category   CategoryName
 */

use yii\db\Migration;

class m160830_153211_alter_child_of_widgets extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%amos_widgets}}', 'child_of', \yii\db\Schema::TYPE_STRING . ' NULL DEFAULT NULL AFTER status');
        return true;
    }

    public function safeDown()
    {
        echo "m160830_153211_alter_child_of_widgets cannot be reverted.\n";
        $this->dropColumn('{{%amos_widgets}}', 'child_of');
        return true;
    }
}
