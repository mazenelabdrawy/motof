<?php
$physical_check = $this->crud_model->get_type_name_by_id('general_settings','68','value');
$digital_check = $this->crud_model->get_type_name_by_id('general_settings','69','value');
$vend = $this->db->get_where('vendor',array('vendor_id'=>$this->session->userdata('vendor_id')))->row();
$membership = $vend->membership;
?>

<div id="content-container">

	<div id="page-title">
        <?php
        if($membership == '8'|| $membership == '0'&& $this->crud_model->vendor_permission('digital') ){
        ?>

		<h1 class="page-header text-overflow"><?php echo translate('Manage_products_(_Individual_&_Dealer)');?></h1>

            <?php
        }
        ?>
	</div>



        <div id="page-title">
            <?php
            if($membership !== '8'&& $membership !== '0'&& $this->crud_model->vendor_permission('digital') ){
                ?>

                <h1 class="page-header text-overflow"><?php echo translate('Manage_products_(_Motorcycles)');?></h1>

                <?php
            }
            ?>
        </div>




        <div class="tab-base">
            <div class="panel">
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="col-md-12" style="border-bottom: 1px solid #ebebeb;padding: 5px;">
                            <button class="btn btn-primary btn-labeled fa fa-plus-circle add_pro_btn pull-right" 
                                onclick="ajax_set_full('add','<?php echo translate('add_product'); ?>','<?php echo translate('successfully_added!'); ?>','digital_add',''); proceed('to_list');"><?php echo translate('create_product');?>
                            </button>
                            <button class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn" 
                                style="display:none;"  onclick="ajax_set_list();  proceed('to_add');"><?php echo translate('back_to_product_list');?>
                            </button>
                        </div>
                    <!-- LIST -->
                    <div class="tab-pane fade active in" id="list" style="border:1px solid #ebebeb; border-radius:4px;">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<span id="prod" style="display:none;"></span>
<script>
	var base_url = '<?php echo base_url(); ?>';
	var timer = '<?php $this->benchmark->mark_time(); ?>';
	var user_type = 'vendor';
	var module = 'digital';
	var list_cont_func = 'list';
	var dlt_cont_func = 'delete';
	
	function proceed(type){
		if(type == 'to_list'){
			$(".pro_list_btn").show();
			$(".add_pro_btn").hide();
		} else if(type == 'to_add'){
			$(".add_pro_btn").show();
			$(".pro_list_btn").hide();
		}
	}
	
	function digital_download(id){
		$.ajax({
                url: base_url+'index.php/'+user_type+'/'+module+'/can_download/'+id, // form action url
                type: 'GET', // form submit method get/post
                dataType: 'html', // request type html/json/xml
                beforeSend: function() {
					
                },
                success: function(data) {
					if(data == 'yes'){
						window.location = base_url+'index.php/'+user_type+'/'+module+'/download_file/'+id;	
					}else if(data == 'no'){
						$.activeitNoty({
							type: 'danger',
							icon : 'fa fa-times',
							message : '<?php echo translate('download_failed!'); ?>',
							container : 'floating',
							timer : 3000
						});
					}
                },
                error: function(e) {
                    console.log(e)
                }
            });
		 
	}
</script>
