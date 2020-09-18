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
    <table class="form">
      <tr>
          <td style="color: blue; font-size: 150%;">
              <img src="image/upgrade.png" width="100">
          </td>
          <td colspan="2" style="font-size: 150%">
                    Upgrade your account now to <br> Promote your business.<br> Get free assistance from our manager. <br>
                    Upgrade your freights , trucks , products number limits.
          </td>
       </tr>
       <tr>
              <td>
                    Upgrade to 
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
              <td>
                  <?php if ($error_warning) { ?>
                        <div class="warning" style=" width: 200px; ">
                        <?php echo $error_warning; ?>
                        </div>
                  <?php } ?>
              </td>
       </tr>       
     </table>
        
    </div>
    <div class="buttons">
      <div class="left"><a href="<?php echo $back; ?>" class="button"><?php echo $button_back; ?></a></div>
      <div class="right">
        <input type="submit" value="Upgrade" class="button" />
       <!-- <input type="submit" value="<?php echo $button_continue; ?>" class="button" /> -->
      </div>
    </div>
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