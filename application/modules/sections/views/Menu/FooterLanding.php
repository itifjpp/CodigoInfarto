   <!-- FOOTER BEGIN -->
    <footer id="footer">
        <div class="container"> 
            <h4></h4>
        </div>
    </footer>
    <!-- FOOTER BEGIN END -->
    
</div>

    <!-- JavaScript --> 
    <script>
        var base_url='<?= base_url()?>';
        var base_domain=window.location.host;
    </script>
    <script src="<?= base_url()?>asset_landing/js/bootstrap.min.js"></script> 
    <script src="<?= base_url()?>asset_landing/js/owl.carousel.min.js"></script> 
    <script src="<?= base_url()?>assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script> 
    <script src="<?= base_url()?>asset_landing/js/jquery.validate.min.js"></script> 
    <script src="<?= base_url()?>asset_landing/js/wow.min.js"></script> 
    <script src="<?= base_url()?>asset_landing/js/smoothscroll.js"></script> 
    <script src="<?= base_url()?>asset_landing/js/jquery.smooth-scroll.min.js"></script> 
    <script src="<?= base_url()?>asset_landing/js/jquery.superslides.min.js"></script>
    <script src="<?= base_url()?>asset_landing/js/placeholders.jquery.min.js"></script>
    <script src="<?= base_url()?>asset_landing/js/jquery.magnific-popup.min.js"></script>
    <script src="<?= base_url()?>asset_landing/js/jquery.stellar.min.js"></script>
    <script src="<?= base_url()?>asset_landing/js/retina.min.js"></script>
    <script src="<?= base_url()?>asset_landing/js/typed.js"></script> 
    <script src="<?= base_url()?>asset_landing/js/bootbox.min.js"></script>
    <script src="<?= base_url()?>asset_landing/js/custom.js"></script> 
    <script src="<?=  base_url()?>assets/js/jquery.cookie.js"></script>
    <script src="<?= base_url()?>assets/js/sections/Landing.js?<?=md5(microtime())?>"></script>
    <script type="text/javascript">
        var csrf_token = $.cookie('csrf_cookie');
        $('body input[name=csrf_token]').val(csrf_token);    
    </script>

</body>
</html>

