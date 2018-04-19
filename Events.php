<?php

namespace  phonebook\humhub\modules\phonebook;

use Yii;
use yii\helpers\Url;

class Events extends \yii\base\Object
{

    /**
     * Defines what to do when the top menu is initialized.
     *
     * @param $event
     */
    public static function onTopMenuInit($event)
    {
        $event->sender->addItem([
            'label' => "Phonebook",
            'icon' => '<i class="fa fa-phone"></i>',
            'url' => Url::to(['/phonebook/index']),
            'sortOrder' => 99999,
            'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'phonebook' && Yii::$app->controller->id == 'index'),
        ]);
    }


    /**
     * Defines what to do if admin menu is initialized.
     *
     * @param $event
     */
    public static function onAdminMenuInit($event)
    {
        $event->sender->addItem(array(
            'label' => "Phonebook",
            'url' => Url::to(['/phonebook/admin']),
            'group' => 'manage',
            'icon' => '<i class="fa fa-phone"></i>',
            'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'phonebook' && Yii::$app->controller->id == 'admin'),
            'sortOrder' => 99999,
        ));
    }

}

