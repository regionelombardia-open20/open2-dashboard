<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    lispa\amos\dashboard\utility
 * @category   CategoryName
 */

namespace lispa\amos\dashboard\utility;

use lispa\amos\dashboard\models\AmosUserDashboards;
use lispa\amos\dashboard\models\AmosUserDashboardsWidgetMm;
use yii\base\Object;
use yii\db\Query;
use yii\log\Logger;

/**
 * Class DashboardUtility
 * @package lispa\amos\dashboard\utility
 */
class DashboardUtility extends Object
{
    /**
     * This method reset all dashboards by module. You can specify a user ID
     * and it will be used to reset only the dashboard of that user.
     * @param string $module
     * @param int $userId
     * @return bool
     */
    public static function resetDashboardsByModule($module, $userId = 0)
    {
        $allOk = true;
        $query = new Query();
        $query->from(AmosUserDashboards::tableName())->andWhere(['module' => $module]);
        if (is_numeric($userId) && ($userId > 0)) {
            $query->andWhere(['user_id' => $userId]);
        }
        $dashboards = $query->all();
        foreach ($dashboards as $dashboard) {
            try {
                AmosUserDashboardsWidgetMm::deleteAll(['amos_user_dashboards_id' => $dashboard['id']]);
                AmosUserDashboards::deleteAll(['id' => $dashboard['id']]);
            } catch (\Exception $exception) {
                $allOk = false;
            }
        }
        return $allOk;
    }

    /**
     * This method reset all dashboards by user ID. You can specify a module
     * and it will be used to reset only the dashboard of that module.
     * @param int $userId
     * @param string $module
     * @return bool
     */
    public static function resetDashboardsByUser($userId, $module = '')
    {
        $allOk = true;
        $query = new Query();
        $query->from(AmosUserDashboards::tableName())->andWhere(['user_id' => $userId]);
        if (is_string($module) && ($module > 0)) {
            $query->andWhere(['module' => $module]);
        }
        $dashboards = $query->all();
        foreach ($dashboards as $dashboard) {
            try {
                AmosUserDashboardsWidgetMm::deleteAll(['amos_user_dashboards_id' => $dashboard['id']]);
                AmosUserDashboards::deleteAll(['id' => $dashboard['id']]);
            } catch (\Exception $exception) {
                $allOk = false;
            }
        }
        return $allOk;
    }

    /**
     * This method reset all dashboards by user ID. You can specify a module
     * and it will be used to reset only the dashboard of that module.
     * @param int[] $excludedUserIds
     * @param string[] $excludedModules
     * @return bool
     */
    public static function resetAllDashboards($excludedUserIds = [], $excludedModules = [])
    {
        $allOk = true;
        $query = new Query();
        $query->from(AmosUserDashboards::tableName());
        if (is_array($excludedUserIds) && !empty($excludedUserIds)) {
            $query->andWhere(['not in', 'user_id', $excludedUserIds]);
        }
        if (is_array($excludedModules) && !empty($excludedModules)) {
            $query->andWhere(['not in', 'module', $excludedModules]);
        }
        $dashboards = $query->all();
        foreach ($dashboards as $dashboard) {
            try {
                AmosUserDashboardsWidgetMm::deleteAll(['amos_user_dashboards_id' => $dashboard['id']]);
                AmosUserDashboards::deleteAll(['id' => $dashboard['id']]);
            } catch (\Exception $exception) {
                \Yii::getLogger()->log($exception->getMessage(), Logger::LEVEL_ERROR);
                $allOk = false;
            }
        }
        return $allOk;
    }
}
