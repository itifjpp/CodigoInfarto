<?= modules::run('Sections/Menu/loadHeader'); ?> 
<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/libs/light-bootstrap/all.min.css" />
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-8 col-centered">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin color-white">ViDAL Vademecum</h4>
                    </div>
                    <div class="grid-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon sigh-background-secundary no-border">
                                            <i class="fa fa-search"></i>
                                        </span>
                                        <input type="text" name="input_search_vidal" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 response-vidal">
                                
                            </div>
                        </div>
                    </div>
                </div>        
            </div>
        </div>
        
    </div>
</div>
<?= modules::run('Sections/Menu/loadFooter'); ?>
<script type="text/javascript" src="<?= base_url()?>assets/libs/light-bootstrap/shieldui-all.min.js"></script>
<script src="<?= base_url('assets/js/sections/Documentos.js?'). md5(microtime())?>" type="text/javascript"></script>
<script>
$(document).ready(function(ry) {
    $('input[name=input_search_vidal]').keydown(function(evt) {
        var search=$(this).val();
        var response_vidal=[];
        if($(this).val()!='' && search.length>=5){
            $.ajax({
                url: "https://api-mx.vidal.fr/rest/api/vmps?q="+search,
                data:{
                    'app_id':'edf22c7a',
                    'app_key':'cea6aa93a13d2a348663c41e8420592e'
                },
                contentType: 'text/xml',
                type:'GET',
                dataType: "xml",
                success: function (data, textStatus, response) {
                    console.log(response);
                    $(data).find("entry").each(function(){
                        //$(".response-vidal").append($(this).find("title").text() + "<br><br>");
                        if($(this).find("title").text()!=''){
                            response_vidal.push($(this).find("title").text());
                        }
                        $('input[name=input_search_vidal]').shieldAutoComplete({
                            dataSource: {
                                data: response_vidal
                            },minLength: 1
                        });
                        $('input[name=input_search_vidal]').removeClass('sui-input');
                        
                    });
                    response_vidal=[];
                },error: function (error) {
                    console.log(error)
                }
            })
        }
    });
    
});    
</script>
