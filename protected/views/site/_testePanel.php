<script>
    sagecell.makeSagecell({
        inputLocation: ' .sage-auto',
        autoeval: true,
        evalButtonText: 'Resolver',
    });
</script>
<div class='sage-auto'>
    <script type='text/x-sage'>
        <?php echo CHtml::decode(stripslashes($conteudo)); ?>
    </script>
</div>
<style>
    .sage-auto .sagecell_input, .sage-auto .sagecell_permalink, .sage-auto .sagecell_pyout, .sage-auto .sagecell_pyerr {
        display: none;
    }
    .sage-auto .sagecell_sessionOutput{
        border: none;
    }
</style>