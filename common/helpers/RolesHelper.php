<?php

namespace common\helpers;
use Yii;
use \common\models\User;
/**
 * Class RolesHelper
 * Небольшой хелпер для ролей
 */
class RolesHelper
{
    /**
     * Админ наследует все роли
     *
     * @return bool
     */
    public static function isAdmin()
    {
        return Yii::$app->user->identity->role === User::ROLE_ADMIN || self::isManager();
    }

    /**
     * Роль менеджера
     *
     * @return bool
     */
    public static function isManager()
    {
        return Yii::$app->user->identity->role === User::ROLE_MANAGER;
    }
}
