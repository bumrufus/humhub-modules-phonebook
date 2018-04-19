<?php

use humhub\widgets\Button;

// Register our module assets, this could also be done within the controller
\phonebook\humhub\modules\phonebook\assets\Assets::register($this);

$displayName = (Yii::$app->user->isGuest) ? Yii::t("PhonebookModule.base", "Guest") : Yii::$app->user->getIdentity()->displayName;

// Add some configuration to our js module
$this->registerJsConfig("phonebook", [
    'username' => (Yii::$app->user->isGuest) ? $displayName : Yii::$app->user->getIdentity()->username,
    'text' => [
        'hello' => Yii::t("PhonebookModule.base", "Hi there {name}!", ["name" => $displayName])
    ]
])

?>

<div class="panel-heading"><strong>Phonebook</strong> <?= Yii::t("PhonebookModule.base", "overview") ?></div>

<div class="panel-body">
    <p><?= Yii::t("PhonebookModule.base", "Hello World!") ?></p>

    <?=  Button::primary(Yii::t("PhonebookModule.base", "Say Hello!"))->action("phonebook.hello")->loader(false); ?></div>
