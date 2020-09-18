<?php echo $header; ?>
<?php if ($error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?>
<?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content"><?php echo $content_top; ?>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <h1><?php echo $heading_title; ?></h1>
  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
    <h2><?php echo $text_your_details; ?></h2>
    <div class="content">
        

    <div style="font-weight: normal;" class="content">
        
            <div class="show_hide"  style="border: 1px solid #EEEEEE;background: #E6E6E6;cursor: pointer;">
                <?php echo html_entity_decode($upgradeText['text']); ?>
            </div>
            
        <div class="slidingDiv" style="display: none;" >
                <table align="center" valign="top" > 
                  <tr  align="center" valign="top">
                   <?php  foreach($available_customer_groups as $customer_group) { ?>
                   <td  align="center" valign="top" style="padding: 15px;">
                     <table align="center" valign="top" >
                         <tr>
                             <td>    
                                <h2> <?php echo $customer_group['name'];  ?>  </h2>
                             </td>
                         </tr><tr>
                             <td>
                                 <?php echo html_entity_decode($customer_group['description']);  ?>  
                             </td>
                         </tr>

                      </table> 
                     </td>
                    <?php } ?> 
                  </tr>
                </table>

       
            <form action="<?php echo $upgradeAction; ?>" method="post" enctype="multipart/form-data">
                <table class="form1">
                  <tr>
                      <td>
                          <b>Choose your Package:</b> &nbsp;&nbsp;&nbsp; 
                      </td>
                      <td>
                         <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">  
                         <select name="customer_group" >
                          <?php foreach( $customer_groups as $customer_group ) { ?>
                              <option value="<?php echo $customer_group['customer_group_id']; ?>">
                                  <?php echo $customer_group['name']; ?>
                              </option>
                          <?php } ?>
                        </select>
                      </td>
                      <td><input type="submit" value="Pay online Now" class="button" /></td>
                   </tr> 
                    <tr>  
                        <td colspan="3">
                          <a href="?route=information/information&information_id=10" target="_black">
                             See Users and prices in detail from Here  <img src="image/zoom.png" width="16">
                          </a>
                        </td>
                    </tr>
                </table> 
           </form>
      </div>         
    </div>  
         
         
        
         
          
          
         
    <script type="text/javascript">
        $(document).ready(function(){

  
                             
            $('.slidingDiv').show();
            $('.show_hide').click(function(){
            $(".slidingDiv").slideToggle();
            });

        });
    </script>
         
       <?php echo html_entity_decode($accountUpgradeText['text']); ?>   
          
    </div>
   <!-- <div class="buttons">
      <div class="left"><a href="<?php echo $back; ?>" class="button"><?php echo $button_back; ?></a></div>
      <div class="right">
        <input type="submit" value="Upgrade" class="button" />
      </div>
    </div>-->
  </form>
  <?php echo $content_bottom; ?></div>


<script type="text/javascript"><!--
function image_upload(field, thumb) {
	$('#dialog').remove();
	
	$('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="index.php?route=common/docmanager/&field=' + encodeURIComponent(field) + '" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
	
	$('#dialog').dialog({
		title: 'Upload your documents',
		close: function (event, ui) {
			if ($('#' + field).attr('value')) {
				$.ajax({
					url: 'index.php?route=common/docmanager/image&&image=' + encodeURIComponent($('#' + field).attr('value')),
					dataType: 'text',
					success: function(text) {
						$('#' + thumb).replaceWith('<img src="' + text + '" alt="" id="' + thumb + '" />');
					}
				});
			}
		},	
		bgiframe: false,
		width: 800,
		height: 400,
		resizable: false,
		modal: false
	});
};
//--></script> 


<?php echo $footer; ?>