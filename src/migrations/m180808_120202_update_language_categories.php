<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 *
 * @package    Open20Package
 * @category   CategoryName
 */

use yii\db\Migration;

class m180808_120202_update_language_categories extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        try {
            $this->update('language_source', ['category' => 'amosdashboard',], ['category' => 'amosdashbaord']);
        } catch (\Exception $exception) {
            return false;
        }
        return true;
    }
    
    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        return true;
    }
}
