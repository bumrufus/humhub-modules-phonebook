<?php

use humhub\widgets\Button;
use yii\helpers\Html;
use humhub\modules\user\widgets\Image;
use humhub\modules\user\models\User;
use humhub\modules\user\models\Profile;

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

<div class="panel panel-default">

    <div class="panel-heading">
        <?php if ($group === null) : ?>
            <?= Yii::t('PhonebookModule.base', '<strong>Member</strong> directory'); ?>
        <?php else: ?>
            <?= Yii::t('PhonebookModule.base', '<strong>Group</strong> members - {group}', ['{group}' => Html::encode($group->name)]); ?>
        <?php endif; ?>
    </div>

    <div class="panel-body">
        <?= Html::beginForm('', 'get', ['class' => 'form-search']); ?>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="form-group form-group-search">
                    <?= Html::hiddenInput('page', '1'); ?>
                    <?= Html::textInput("keyword", $keyword, ['class' => 'form-control form-search', 'placeholder' => Yii::t('PhonebookModule.base', 'search for members')]); ?>
                    <?= Html::submitButton(Yii::t('PhonebookModule.base', 'Search'), ['class' => 'btn btn-default btn-sm form-button-search']); ?>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
        <?= Html::endForm(); ?>

        <?php if (count($users) == 0): ?>
            <p><?= Yii::t('PhonebookModule.base', 'No members found!'); ?></p>
        <?php endif; ?>
    </div>

    <hr>
	
	<center><div class="panel_s"><input type="text" id="search" class="form-field" onkeyup="filter_table()" placeholder="Suchen.."></div></center>
		<?php if($uid) { ?>
		<span class="command f-right" onclick="f_edit(null);">Add contact</span>
		<?php } ?>
		<div class="panel"><table id="table" class="main-table">
			<thead>
			<tr class="thead">
				<?php $i = 0; ?>
				<?php if($uid) { ?>
				<th width="1%"><input type="checkbox" onclick="f_select_all(event)"/></th>
				<?php $i++; } ?>
				<th width="1%" onclick="sortTable(<?php eh($i++); ?>)">Foto</th>
				<th width="5%" onclick="sortTable(<?php eh($i++); ?>)">Kürzel</th>
				<th width="15%" onclick="sortTable(<?php eh($i++); ?>)">Name</th>
				<th width="10%" onclick="sortTable(<?php eh($i++); ?>)">Festnetz</th>
				<th width="10%" onclick="sortTable(<?php eh($i++); ?>)">Handy</th>
				<th width="20%" onclick="sortTable(<?php eh($i++); ?>)">E-Mail</th>
				<th width="20%" onclick="sortTable(<?php eh($i++); ?>)">Position</th>
				<th width="15%" onclick="sortTable(<?php eh($i++); ?>)">Abteilung</th>
				<?php if($uid) { ?>
				<th width="15%">Operations</th>
				<?php } ?>
			</tr>
			</thead>
			<tbody id="table-data">
		<?php $i = 0; foreach($users as $user) { $i++; ?>
			<tr class="tbody">
				
				<td> <?= Image::widget(['user' => $user, 'htmlOptions' => ['class' => 'pull-left']]); ?></td>
				<td style="padding-left:5px;"><?= Html::encode($user->profile->kuerzel); ?></td>
				<td style="padding-left:5px;"> <a href="<?= $user->getUrl(); ?>"><?= Html::encode($user->profile->lastname); ?>&nbsp;<?= Html::encode($user->profile->firstname); ?></a></td>
				<td style="padding-left:5px;"><a class="mobil_phone" href="tel:+4350148<?= Html::encode($user->profile->festnetz); ?>"><?= Html::encode($user->profile->festnetz); ?></a></td>
				<td style="padding-left:5px;"><a class="mobil_phone" href="tel:<?= Html::encode($user->profile->handy); ?>"><?= Html::encode($user->profile->handy); ?></a></td>
				<td style="padding-left:5px;"><a href="mailto:<?= Html::encode($user->email); ?>"><?= Html::encode($user->email); ?></a></td>
				<td style="padding-left:5px;"><?= Html::encode($user->profile->title); ?></td>
				<td style="padding-left:5px;"><?= Html::encode($user->profile->abteilung); ?></td>
				<?php if($uid) { ?>
				
				<?php } ?>
			</tr>
		<?php } ?>
			</tbody>
		</table></div>

    <ul class="media-list">
        <?php foreach ($users as $user) : ?>
            <li>
                <div class="media">
                    <div class="pull-right memberActions">
                        <?= MemberActionsButton::widget(['user' => $user]); ?>
                    </div>

                    <?= Image::widget(['user' => $user, 'htmlOptions' => ['class' => 'pull-left']]); ?>
                    <div class="media-body">
                        <h4 class="media-heading">
                            <a href="<?= $user->getUrl(); ?>"><?= Html::encode($user->displayName); ?></a>
                            <?= UserGroupList::widget(['user' => $user]); ?>
                        </h4>
                        <h5><?= Html::encode($user->profile->title); ?></h5>
                        <?= UserTagList::widget(['user' => $user]); ?>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>

</div>

<div class="pagination-container">
    <?= \humhub\widgets\LinkPager::widget(['pagination' => $pagination]); ?>
</div>

<div class="panel-heading"><strong>Phonebook</strong> <?= Yii::t("PhonebookModule.base", "overview") ?></div>

<div class="panel-body">
    <p><?= Yii::t("PhonebookModule.base", "Hello World!") ?></p>

    <?=  Button::primary(Yii::t("PhonebookModule.base", "Say Hello!"))->action("phonebook.hello")->loader(false); ?></div>
