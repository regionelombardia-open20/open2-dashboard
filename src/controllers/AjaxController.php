<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    lispa\amos\dashboard\controllers
 * @category   CategoryName
 */

namespace lispa\amos\dashboard\controllers;

use lispa\amos\core\helpers\BreadcrumbHelper;
use lispa\amos\dashboard\controllers\base\DashboardController;
use lispa\amos\dashboard\models\AmosUserDashboards;
use yii\helpers\Url;

/**
 * Class DefaultController
 * @package lispa\amos\dashboard\controllers
 */
class AjaxController extends DashboardController
{

    /**
     * @inheritdoc
     */
    public function init() {

        parent::init();
        $this->setUpLayout();
   
    }

    /**
     * @return string
     */
    public function actionIndex($module, $parent = null)
    {
        $this->setUpLayout('dashboard');
        Url::remember();

//        $this->setCurrentDashboard($id);
        $currentDashboard = AmosUserDashboards::findOne(['user_id' => \Yii::$app->user->id, 'module' => $module]);
        $currentDashboard->showAllModule = true;
        $this->setCurrentDashboard($currentDashboard);
        BreadcrumbHelper::reset();
        $params = [
            'widgetParentClassname' => $parent,
            'currentDashboard' => $currentDashboard
        ];
        
        return $this->renderPartial('index', $params);
    }
     
     
}
