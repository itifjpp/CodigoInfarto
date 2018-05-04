<html>
<title><?=$this->sigh->getInfo('hospital_tipo')?> | <?=$this->sigh->getInfo('hospital_nombre')?></title>
<boby>
<div style="margin: 20px auto;display: table;width: 300px">
    <div style="width: 100%;margin-top: 0px">
        <table style="width: 100%">
            <tr>
                <td style="width: 10%">
                    <img src="<?= base_url()?>assets/img/<?=$this->sigh->getInfo('hospital_img_doc')?>" style="width: 40px">
                </td>
                <td style="text-align: left;width: 90%">
                    <p style="text-transform: uppercase;font-size: 11px;font-weight: bold;margin: 0px;text-align: left"><?=$this->sigh->getInfo('hospital_siglas_des')?></p>
                    <p style="text-transform: uppercase;font-size: 10px;font-weight: 300;margin-top: 3px;margin-bottom: 0px"><?=$this->sigh->getInfo('hospital_tipo')?> <?=$this->sigh->getInfo('hospital_nombre')?></p>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center">
                    <p style="text-align: center;font-size: 15px;margin-top: 20px"><b>TRIAGE & URGENCIAS</b></p>
                    <img class="code128"><br>
                    <p style="text-align:  center;font-size: 12px;line-height: 1.5">
                        <?=$this->sigh->getInfo('hospital_direccion')?>
                    </p>
                </td>
            </tr>
        </table>
    </div>
</div>
<script src="<?=  base_url()?>assets/libs/jquery/jquery/dist/jquery.js"></script>
<script src="<?= base_url('assets/js/os/barcode/jquery-barcode.js')?>" type="text/javascript"></script>
</boby>
<script>
    $(document).ready(function (e){
        
        JsBarcode(".code128", "<?=$info['ingreso_id']?>",{
            displayValue: true,
            height: 50,
            width: 1
        });
        print(true);
        window.top.close();
        window.opener = this;
        window.close();
    })

</script>
</html>