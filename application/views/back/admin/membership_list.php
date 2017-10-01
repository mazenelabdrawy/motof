<script src="<?php echo base_url(); ?>template/back/plugins/bootstrap-table/extensions/export/bootstrap-table-export.js"></script>
<div class="panel-body" id="demo_s">
    <table id="demo-table" class="table table-striped" data-url="<?php echo base_url(); ?>index.php/admin/membership/list_data" data-side-pagination="server" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200]"  data-show-refresh="true" data-search="true"  data-show-export="true" >
        <thead>
            <tr>
                <th><?php echo translate('no');?></th>
                <th><?php echo translate('seal');?></th>
                <th><?php echo translate('title');?></th>
                <th><?php echo translate('price');?></th>
                <th><?php echo translate('for');?></th>

                <th class="text-right"><?php echo translate('options');?></th>

                <!--th  data-feild="publish" data-sortable="false">

                    <?php echo translate('publish');?>
                </th-->
            </tr>
        </thead>				
        <tbody >
        <tr>
            <td><?php echo 1; ?></td>
            <td>
                <img class="img-md img-circle"
                    src="<?php echo $this->crud_model->file_view('membership',0,'100','','thumb','src','','','.png') ?>"  />
            </td>
            <td>Individual</td>
            <td><?php echo currency('','def').'0'; ?></td>
            <td><?php echo translate('lifetime');?></td>
            <td class="text-right">
                <a class="btn btn-success btn-xs btn-labeled fa fa-wrench" data-toggle="tooltip" 
                    onclick="ajax_modal('default','<?php echo translate('edit_vendor_package'); ?>','<?php echo translate('successfully_edited!'); ?>','membership_edit',0)" data-original-title="Edit" data-container="body">
                        <?php echo translate('edit');?>
                </a>
            </td>
        </tr>
        <?php
            $i=1;
            foreach($all_memberships as $row){
                $i++;
        ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td >
                <img class="img-md img-circle"
                    src="<?php echo $this->crud_model->file_view('membership',$row['membership_id'],'100','','thumb','src','','','.png') ?>"  />
            </td>
            <td><?php echo $row['title']; ?></td>
            <td><?php echo currency('','def').$row['price']; ?></td>
            <td><?php echo $row['timespan']; ?> <?php echo translate('days');?></td>
            <td class="text-right">
                <a class="btn btn-success btn-xs btn-labeled fa fa-wrench" data-toggle="tooltip" 
                    onclick="ajax_modal('edit','<?php echo translate('edit_vendor_package'); ?>','<?php echo translate('successfully_edited!'); ?>','membership_edit','<?php echo $row['membership_id']; ?>')" data-original-title="Edit" data-container="body">
                        <?php echo translate('edit');?>
                </a>
                <a onclick="delete_confirm('<?php echo $row['membership_id']; ?>','<?php echo translate('really_want_to_delete_this?'); ?>')" 
                        class="btn btn-danger btn-xs btn-labeled fa fa-trash" data-toggle="tooltip"
                            data-original-title="Delete" data-container="body">
                                <?php echo translate('delete');?>
                </a>
            </td>




        </tr>

        <?php
            }
        ?>
        </tbody>
    </table>
</div>
           
<div id='export-div'>
    <h1 style="display:none;"><?php echo translate('membership');?></h1>
    <table id="export-table" data-name='membership' data-orientation='p' style="display:none;">
            <thead>
                <tr>
                    <th><?php echo translate('no');?></th>
                    <th><?php echo translate('title');?></th>
                    <th><?php echo translate('price');?></th>
                </tr>
            </thead>
                
            <tbody >
            <?php
                $i = 0;
                foreach($all_memberships as $row){
                    $i++;
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo currency('','def').$row['price']; ?></td>
            </tr>
            <?php
                }
            ?>
            </tbody>
    </table>
</div>

<style>
    .onoffswitch {
        position: relative; width: 90px; float: left;
        -webkit-user-select:none; -moz-user-select:none; -ms-user-select: none;
    }
    .onoffswitch-checkbox {
        display: none;
    }
    .onoffswitch-label {
        display: block; overflow: hidden; cursor: pointer;
        border: 2px solid #999999; border-radius: 20px;
    }
    .onoffswitch-inner {
        display: block; width: 200%; margin-left: -100%;
        transition: margin 0.3s ease-in 0s;
    }
    .onoffswitch-inner:before, .onoffswitch-inner:after {
        display: block; float: left; width: 50%; height: 30px; padding: 0; line-height: 30px;
        font-size: 14px; color: white; font-family: Trebuchet, Arial, sans-serif; font-weight: bold;
        box-sizing: border-box;
    }
    .onoffswitch-inner:before {
        content: "ON";
        value: '1';
        padding-left: 10px;
        background-color: #34A7C1; color: #FFFFFF;
    }
    .onoffswitch-inner:after {
        content: "OFF";
        value: '0';
        padding-right: 10px;
        background-color: #EEEEEE; color: #999999;
        text-align: right;
    }
    .onoffswitch-switch {
        display: block; width: 18px; margin: 6px;
        background: #FFFFFF;
        position: absolute; top: 0; bottom: 0;
        right: 56px;
        border: 2px solid #999999; border-radius: 20px;
        transition: all 0.3s ease-in 0s;
    }
    .onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-inner {
        margin-left: 0;
    }
    .onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-switch {
        right: 0px;
    }
</style>
<script <script type="text/javascript">
    $(document).ready(function(){
        $('#demo-table').bootstrapTable({

             onAll: function (name, args) {
             console.log('Event: onAll, data: ', args);
             }
             onClickRow: function (row) {
             $result.text('Event: onClickRow, data: ' + JSON.stringify(row));
             },
             onDblClickRow: function (row) {
             $result.text('Event: onDblClickRow, data: ' + JSON.stringify(row));
             },
             onSort: function (name, order) {
             $result.text('Event: onSort, data: ' + name + ', ' + order);
             },
             onCheck: function (row) {
             $result.text('Event: onCheck, data: ' + JSON.stringify(row));
             },
             onUncheck: function (row) {
             $result.text('Event: onUncheck, data: ' + JSON.stringify(row));
             },
             onCheckAll: function () {
             $result.text('Event: onCheckAll');
             },
             onUncheckAll: function () {
             $result.text('Event: onUncheckAll');
             },
             onLoadSuccess: function (data) {
             $result.text('Event: onLoadSuccess, data: ' + data);
             },
             onLoadError: function (status) {
             $result.text('Event: onLoadError, data: ' + status);
             },
             onColumnSwitch: function (field, checked) {
             $result.text('Event: onSort, data: ' + field + ', ' + checked);
             },
             onPageChange: function (number, size) {
             $result.text('Event: onPageChange, data: ' + number + ', ' + size);
             },
             onSearch: function (text) {
             $result.text('Event: onSearch, data: ' + text);
             }


        }).on('load-error.bs.table', function (e, status) {

        }).on('column-switch.bs.table', function (e, field, checked) {


            set_switchery();

        }).on('search.bs.table', function (e, text) {

        });
    });

</script>

</script>
