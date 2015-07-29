<?php $this->beginContent('application.views.layouts.main'); ?>
<div class="container">
    <div style="z-index: 1001;" id="stk">
        <?php
        if ($this->showHideMenu) {
            $this->widget('application.widgets.ButtonHideShowMenu.ButtonHideShowMenu', array(
                    //                    'items' => $this->tags,
            ));
            $this->widget('shared.widgets.StickyContent.StickyContent', array(
                'contentID' => 'stk',
            ));
        }
        ?>
    </div>
</div>
<div class="page-container">   
    <div class="container">
        <div class="row">
            <!-- start of sidebar -->
            <aside class="span4 page-sidebar" data-open='true'>
                <?php
                $this->widget('application.widgets.MenuListaTopicos.MenuListaTopicos', array(
                    'title' => $this->titleMenuContexto,
                    'items' => $this->menuContexto,
                ));
                ?>
                <?php
                $this->widget('application.widgets.MenuListaItems.MenuListaItems', array(
                    'title' => $this->titleSubindice,
                    'items' => $this->subindice,
                ));
                ?>
                <?php
                $this->widget('application.widgets.MenuMaisLidos.MenuMaisLidos', array(
                    'title' => $this->titleTags,
                    'items' => $this->tags,
                ));
                ?>

                <?php
                if ($this->showMenuConteudo) {
                    echo '<br><hr><br>';
                    $this->widget('application.widgets.MenuMultiLevel.MenuMultiLevel', array(
                        'title' => null,
                        'items' => $this->multiLevelMenu(),
                    ));
                }
                ?>
            </aside>
            <br>
            <!--end of sidebar -->

            <!--start of page content -->
            <div class = "span8 page-content">
                <?php echo $content; ?>
            </div>


        </div>
    </div>
</div>
<?php $this->endContent(); ?>
<style>
    <!--
    .span0 {
        width: 1px;
    }
    .page-sidebar {
        /*background: red;*/
        /*width: 200px;*/
        overflow: hidden;
    }
    -->
</style>