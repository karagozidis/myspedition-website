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
          <td><span class="required">*</span> <?php echo $entry_firstname; ?></td>
          <td><input type="text" name="firstname" value="<?php echo $firstname; ?>" />
            <?php if ($error_firstname) { ?>
            <span class="error"><?php echo $error_firstname; ?></span>
            <?php } ?></td>
        </tr>
        <tr>
          <td><span class="required">*</span> <?php echo $entry_lastname; ?></td>
          <td><input type="text" name="lastname" value="<?php echo $lastname; ?>" />
            <?php if ($error_lastname) { ?>
            <span class="error"><?php echo $error_lastname; ?></span>
            <?php } ?></td>
        </tr>
        <tr>
          <td><span class="required">*</span> <?php echo $entry_email; ?></td>
          <td><input type="text" name="email" value="<?php echo $email; ?>" />
            <?php if ($error_email) { ?>
            <span class="error"><?php echo $error_email; ?></span>
            <?php } ?></td>
        </tr>
        <tr>
          <td><span class="required">*</span> <?php echo $entry_telephone; ?></td>
          <td><input type="text" name="telephone" value="<?php echo $telephone; ?>" />
            <?php if ($error_telephone) { ?>
            <span class="error"><?php echo $error_telephone; ?></span>
            <?php } ?></td>
        </tr>
        <tr>
          <td><?php echo $entry_fax; ?></td>
          <td><input type="text" name="fax" value="<?php echo $fax; ?>" /></td>
        </tr>
        
        
        <tr>
          <td>Skype</td>
          <td><input type="text" name="skype" value="<?php echo $skype; ?>" /></td>
        </tr>
        <tr>
          <td>ICQ</td>
          <td><input type="text" name="icq" value="<?php echo $icq; ?>" /></td>
        </tr>
        <tr>
          <td>WebSite</td>
          <td><input type="text" name="website" value="<?php echo $website; ?>" /></td>
        </tr>
        
        
        <tr>
          <td>
              <span class="required">*</span>
              <?php echo $general_company_name_text; ?>
          </td>
          <td>
                <input type="text" name="main_company" value="<?php echo $main_company; ?>" />
            <?php if ($error_main_company) { ?>
                <span class="error">
                    <?php echo $company_name_error_text; ?>
                </span>
            <?php } ?>
          </td>
        </tr>
        
       <tr>
              <td>
                 <?php echo $image_size_text; ?>
              </td>
              <td>
                  <div class="image">
                      <img width="120" height="120" src="image/<?php echo $companyImage ?>" alt="" id="thumb" />
                      <br />
                      <input type="hidden" name="image" value="<?php echo $companyImage; ?>" id="image" />
                        <a onclick="image_upload('image', 'thumb');">
                           <?php echo $browse_text; ?>
                        </a>
                      &nbsp;&nbsp;|&nbsp;&nbsp;
                      <a onclick="$('#thumb').attr('src', 'image/<?php echo $defaultCompanyImage ?>'); $('#thumb').attr('width', '120'); $('#thumb').attr('height', '120'); $('#image').attr('value', '');">
                          <?php echo $clear_text; ?>
                      </a>
                  </div>
              </td>
      </tr>
             
        
         <tr>
          <td><?php echo $company_type_text; ?></td>
          <td>
             <select name="company_type_id">
              <?php foreach ($company_types as $company_type) { ?>
                  <?php  if ($company_type['company_type_id'] == $company_type_id ) { ?>
                    <option value="<?php echo $company_type['company_type_id']; ?>" selected><?php echo $company_type['name']; ?></option>  
                 <?php } else { ?>  
                    <option value="<?php echo $company_type['company_type_id']; ?>"><?php echo $company_type['name']; ?></option>  
                 <?php } ?>
              <?php } ?>
            </select>
          </td>
        </tr>
        
        <tr>
          <td><?php echo $company_country_text; ?></td>
          <td>
             <select name="main_country_id">
              <?php foreach ($countries as $country) { ?>
                  <?php  if ($country['country_id'] == $main_country_id ) { ?>
                    <option value="<?php echo $country['country_id']; ?>" selected><?php echo $country['name']; ?></option>  
                 <?php } else { ?>  
                    <option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>  
                 <?php } ?>
              <?php } ?>
            </select>
             <!-- <input type="text" name="country_id" value="" />-->
          </td>
        </tr>
        <tr>
          <td><?php echo $company_general_description_text; ?></td>
          <td>
          <textarea rows="10" cols="70" class="ckeditor" name="main_description"><?php echo $main_description; ?></textarea>
          </td>
        </tr>
        
      </table>
    </div>
    <div class="buttons">
      <div class="left"><a href="<?php echo $back; ?>" class="button"><?php echo $button_back; ?></a></div>
      <div class="right">
        <input type="submit" value="<?php echo $button_continue; ?>" class="button" />
      </div>
    </div>
  </form>
  <?php echo $content_bottom; ?></div>

<script type="text/javascript" src="catalog/view/javascript/ckeditor/ckeditor.js"></script> 
<script type="text/javascript"><!--
function image_upload(field, thumb) {
	$('#dialog').remove();
	
	$('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="index.php?route=common/filemanager/&field=' + encodeURIComponent(field) + '" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
	
	$('#dialog').dialog({
		title: 'Filemanager',
		close: function (event, ui) {
			if ($('#' + field).attr('value')) {
				$.ajax({
					url: 'index.php?route=common/filemanager/image&&image=' + encodeURIComponent($('#' + field).attr('value')),
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