<div id='hide-show-content' style="z-index: 100;">
    <button class="btn btn-default btn-mini" type="button">
        &laquo; Ocultar menu
    </button>
</div>
<style>
/*    #hide-show-content{
        position: fixed;
        bottom: 5%;
        left: 5%;
        z-index: 99999;
    }*/
</style>
<script>
    $('#hide-show-content').click(function() {
        if ($(this).attr("c") === "y") {
            $(this).find("button").html("&laquo; Ocultar menu");
            $(this).attr("c", "n");

            $('.page-sidebar').toggle("slide");
            $('.page-content').removeClass('span12').addClass('span8', 300);
        } else {
            $(this).find("button").html("Abrir menu &raquo;");
            $(this).attr("c", "y");

            $('.page-sidebar').toggle("slide", function() {
                $('.page-content').removeClass('span8', 1000);
            });
        }
    });
</script>