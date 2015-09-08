<div class="container">
    <br><br>
    <div id="accordion">
        <?php
            $this->renderPartial('cat',array('cats'=>$cats));
        ?>
    </div>
</div>
<?php ShCode::getGoogleAnalytics();?>