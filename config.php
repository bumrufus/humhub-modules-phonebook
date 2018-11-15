<?php

use humhub\widgets\TopMenu;

return [
    'id' => 'phonebook',
    'class' => 'humhub\modules\phonebook\Module',
    'namespace' => 'humhub\modules\phonebook',
    'events' => [
        ['class' => TopMenu::class, 'event' => TopMenu::EVENT_INIT, 'callback' => ['humhub\modules\phonebook\Events', 'onTopMenuInit']],
    ],
];
