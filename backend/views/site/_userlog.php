<?php
use yii\helpers\Html;
//use yii\widgets\Pjax;

?>
<?php
/*
$script = <<< JS
$(document).ready(function() {
   setInterval(function(){ $("#refreshButton").click(); }, 1000);
});
JS;
$this->registerJs($script);*/
?>

<h1>Users Logs</h1>
<ul>
<?php //Pjax::begin(); ?>
<?php //echo Html::a("", ['userlog/index'], ['class' => 'hidden', 'id' => 'refreshButton']);?>
<?php foreach ($userlog as $item)
{
    echo '<li>';
        echo Html::encode(" {$item->time_event} @ {$item->user_name} => {$item->type_event} | {$item->client_id}");
        if($item->type_event == 'update')
		{
			echo ' - ';
			if($item->ch_name) echo Html::encode(" [name] ");
			if($item->ch_surname) echo Html::encode(" [surname] ");
			if($item->ch_email) echo Html::encode(" [email] ");
			if($item->ch_age) echo Html::encode(" [age] ");	
			if($item->ch_born) echo Html::encode(" [born] ");

		}
    echo '</li>';
}
?>
<?php //Pjax::end(); ?>
</ul>

