<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row">

            <iframe id='iframeX'  src="<?php echo base_url($controlador). '/' . $vista; ?>" width="100%" height="auto" style=" border:none;"></iframe>

        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script>
    function ResizeIframeFromParent(id) {
        if (jQuery('#' + id).length > 0) {
            var window = document.getElementById(id).contentWindow;
            var prevheight = jQuery('#' + id).attr('height');
            var newheight = Math.max(window.document.body.scrollHeight, window.document.body.offsetHeight, window.document.documentElement.clientHeight, window.document.documentElement.scrollHeight, window.document.documentElement.offsetHeight);
            if (newheight != prevheight && newheight > 0) {
                jQuery('#' + id).attr('height', newheight);
                console.log("Adjusting iframe height for " + id + ": " + prevheight + "px => " + newheight + "px");
            }
        }
    }
    setInterval(function () {
        ResizeIframeFromParent('iframeX');
    }, 300);
</script>