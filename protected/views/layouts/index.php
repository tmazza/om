<?php $this->beginContent('application.views.layouts.main'); ?>
<div class="page-container">   
    <div class="container">
        <div class="row">
            <div class="span3">
                <br>
                <p style="font-size: 18px;"><b>Panorama</b> de tópicos:</p>
            </div>
            <div class="span9" id='s-top'>
                <?php
                $this->widget('application.widgets.SearchBox.SearchBox', array(
                    'source' => 'search/AjaxMenuResults',
                    'formAction' => 'search/Results',
                ));
                ?>
                <hr>
            </div>
        </div>
        <div class="row">
            <!-- start of sidebar -->
            <aside class="span3 page-sidebar" data-open='true'>

                <?php
//                $this->widget('application.widgets.SearchBox.SearchBox', array(
//                    'source' => 'search/AjaxMenuResults',
//                    'formAction' => 'search/Results',
//                ));
                $this->widget('application.widgets.MenuMultiLevel.MenuMultiLevel', array(
                    'title' => null,
                    'items' => $this->multiLevelMenu(),
                ));
                $this->widget('application.widgets.MenuListaTopicos.MenuListaTopicos', array(
                    'title' => $this->titleMenuContexto,
                    'items' => $this->menuContexto,
                ));
                //                $this->widget('application.widgets.MenuMaisLidos.MenuMaisLidos', array(
//                    'title' => $this->titleTags,
//                    'items' => $this->tags,
//                ));
                ?>

            </aside>
            <br>
            <!--end of sidebar -->

            <!--start of page content -->
            <div class = "span9 page-content">
                <?php echo $content; ?>
            </div>


        </div>
    </div>
</div>
<?php $this->endContent(); ?>
<style>
    #s-top input[type=text] {
        /*background: red;*/
        display: block!important;
        /*margin: 0 auto;*/
        width: 50%!important;
        padding: 12px;
    }    
</style>