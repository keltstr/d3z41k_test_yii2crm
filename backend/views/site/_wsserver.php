<?php
use yii\helpers\Html;

echo '<b>WebSocket Server</b>';

?>
<br>
<?= Html::a('Start Server', ['wsserver'], ['class' => 'btn btn-success', 'name' => 'On', 'value' => '1']) ?>
