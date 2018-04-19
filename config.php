<?php

return [
	'id' => 'phonebook',
	'class' => 'phonebook\humhub\modules\phonebook\Module',
	'namespace' => 'phonebook\humhub\modules\phonebook',
	'events' => [
		[
			'class' => \humhub\widgets\TopMenu::class,
			'event' => \humhub\widgets\TopMenu::EVENT_INIT,
			'callback' => ['phonebook\humhub\modules\phonebook\Events', 'onTopMenuInit'],
		],
		[
			'class' => humhub\modules\admin\widgets\AdminMenu::class,
			'event' => humhub\modules\admin\widgets\AdminMenu::EVENT_INIT,
			'callback' => ['phonebook\humhub\modules\phonebook\Events', 'onAdminMenuInit']
		],
	],
];
?>

