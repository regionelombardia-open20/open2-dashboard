<?php
/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    lispa\amos\dashboard
 * @category   CategoryName
 */

namespace lispa\amos\dashboard\assets;

use yii\web\AssetBundle;

class SubDashboardAsset extends AssetBundle
{
    public $sourcePath = '@vendor/lispa/amos-dashboard/src/assets/web';
    public $css        = [
        'less/sub-dashboard.less'
    ];
    public $js         = [
        'js/sub-dashboard.js'
    ];
    public $depends = [
    ];

    public function init()
    {
        $moduleL = \Yii::$app->getModule('layout');
        if(!empty($moduleL))
        {
            $this->depends [] = 'lispa\amos\layout\assets\BaseAsset';
            $this->depends [] = 'lispa\amos\layout\assets\IsotopeAsset';
        }
        else
        {
            $this->depends [] = 'lispa\amos\core\views\assets\AmosCoreAsset';
            $this->depends [] = 'lispa\amos\core\views\assets\IsotopeAsset';
        }
        parent::init();
    }
}