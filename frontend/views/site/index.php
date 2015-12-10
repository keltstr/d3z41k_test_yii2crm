<?php
/* @var $this yii\web\View */
use yii\bootstrap\Modal;

$this->title = 'yii2crm';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Wellcome to Yii2CRM!</h1>

        <p class="lead">This is our test CRM.</p>
        <?php
        Modal::begin([
            'header' => '<h2>This is the test CRM system.</h2>',
            'toggleButton' => [
            'tag' => 'button',
            'class' => 'btn btn-default btn-lg btn-success',
            'label' => 'Information about application',
            ]
        ]);

        echo 'It was developed for learning to the yii2 framework.';
        Modal::end();
        ?>
        <!-- <p><a class="btn btn-lg btn-success" href="/frontend/web/site/login">Get started with yii2crm</a></p> -->
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>About</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii2CRM About &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Documentation</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii2CRM Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Forum</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii2CRM Forum &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
