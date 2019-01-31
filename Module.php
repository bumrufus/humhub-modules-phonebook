<?php

namespace humhub\modules\phonebook;

use Yii; 
use yii\helpers\Url; 

class Module extends \humhub\components\Module
{
 
    /**
    * @inheritdoc
    */
    public function getConfigUrl()
    {
        return Url::to(['/phonebook/admin']);
    }

    /**
    * @inheritdoc
    */
    public function disable()
    {
        // Cleanup all module data, don't remove the parent::disable()!!!
        parent::disable();
    }
    public function getImage ( )
   	{
		 $url = $this->getPublishedUrl('/module_image.png');
		return $url;
		
   	}
    public function getName()
    {
        return Yii::t('PhonebookModule.base', 'Phonebook');
    }
    public function getDescription()
    {
        return Yii::t('PhonebookModule.base', 'A simple phonebook with Ajax Search');
    }
}




