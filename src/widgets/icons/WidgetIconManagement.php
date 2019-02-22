<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    lispa\amos\dashboard\widgets
 * @category   CategoryName
 */

namespace lispa\amos\dashboard\widgets\icons;

use lispa\amos\core\widget\WidgetIcon;
use lispa\amos\dashboard\AmosDashboard;
use yii\helpers\ArrayHelper;

/**
 * Class WidgetIconEenDashboard
 *
 * @package lispa\amos\een\widgets\icons
 */
class WidgetIconManagement extends WidgetIcon
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        
        $this->setLabel(AmosDashboard::tHtml('amosdashboard', 'Management'));
        $this->setDescription(AmosDashboard::t('amosdashboard', 'Plugin Management'));
        $this->setIcon('wrench');
        $this->enableDashboardModal();
        $this->setUrl(['']);
        $this->setCode('MANAGEMENT');
        $this->setModuleName('admin');
        $this->setNamespace(__CLASS__);
        $this->setClassSpan(ArrayHelper::merge($this->getClassSpan(), [
            'bk-backgroundIcon',
            'color-primary'
        ]));
    }
}
