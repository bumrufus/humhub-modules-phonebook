<?php

namespace humhub\modules\phonebook\controllers;

use Yii;
use humhub\components\Controller;

class IndexController extends Controller
{

    public $subLayout = "@phonebook/views/layouts/default";

    /**
     * Renders the index view for the module
     *
     * @return string
     */
    

  public function actionIndex()
    {
        return $this->render('index');
    }


 
   

  


}

