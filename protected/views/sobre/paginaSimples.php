<div class="span8 main-listing">
    <article class="format-standard type-post hentry clearfix">
        <header class="clearfix">
            <h3 class="article-entry standard">
                <?= Organizacao::model()->getAttributeLabel($attr); ?>
            </h3>

            <div class="clearfix">
            </div><!-- end of post meta -->
        </header>
        <?= $org->{$attr}; ?>
    </article>
</div>