<?php

use yii\helpers\Html;
use app\models\Wsclient;

/* @var $this yii\web\View */
$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
$Wsclient = new Wsclient('185.46.8.97', 8000);
if(isset ($Wsclient)) {
	echo $Wsclient->getData();
	//echo "<input class='form-control' id='disabledInput' type='text' value=$i disabled>";
}
?>

    <h1><?= Html::encode($this->title) ?></h1>

    <p>This is the About page. You may modify the following file to customize its content:</p>

    <code><?= __FILE__ ?></code>
</div>
