<div style="margin-top: 0px;font-size: 30px;margin-left: -20px">
    <center>
        <br><br>
        <img class="code128" style="margin-left:-20px "><br><br>
    </center>
</div>
<script src="<?=  base_url()?>assets/libs/jquery/jquery/dist/jquery.js"></script>
<script src="<?= base_url('assets/js/os/barcode/jquery-barcode.js')?>" type="text/javascript"></script>
<script>
    $(document).ready(function (e){
        JsBarcode(".code128", "<?=$info['existencia_id']?>",{
            displayValue: true,
            height: 50,
            width: 1
        });
        print(true);
    })
</script>