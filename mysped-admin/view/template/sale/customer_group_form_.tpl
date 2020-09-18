<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/customer.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="form">
          <tr>
            <td><span class="required">*</span> <?php echo $entry_name; ?></td>
            <td><?php foreach ($languages as $language) { ?>
              <input type="text" name="customer_group_description[<?php echo $language['language_id']; ?>][name]" value="<?php echo isset($customer_group_description[$language['language_id']]) ? $customer_group_description[$language['language_id']]['name'] : ''; ?>" />
              <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /><br />
              <?php if (isset($error_name[$language['language_id']])) { ?>
              <span class="error"><?php echo $error_name[$language['language_id']]; ?></span><br />
              <?php } ?>
              <?php } ?></td>
          </tr>
          <?php foreach ($languages as $language) { ?>
          <tr>
            <td><?php echo $entry_description; ?></td>
            <td>
                <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" align="top" />
               <b> <?php echo $language['name']; ?> </b>
                <textarea name="customer_group_description[<?php echo $language['language_id']; ?>][description]" id="description<?php echo $language['language_id']; ?>" cols="40" rows="5">
                    <?php echo isset($customer_group_description[$language['language_id']]) ? $customer_group_description[$language['language_id']]['description'] : ''; ?>
                </textarea>
            </td>
          </tr>
          <?php } ?>
          <tr>
            <td><?php echo $entry_approval; ?></td>
            <td><?php if ($approval) { ?>
              <input type="radio" name="approval" value="1" checked="checked" />
              <?php echo $text_yes; ?>
              <input type="radio" name="approval" value="0" />
              <?php echo $text_no; ?>
              <?php } else { ?>
              <input type="radio" name="approval" value="1" />
              <?php echo $text_yes; ?>
              <input type="radio" name="approval" value="0" checked="checked" />
              <?php echo $text_no; ?>
              <?php } ?></td>
          </tr>
          <tr>
            <td><?php echo $entry_company_id_display; ?></td>
            <td><?php if ($company_id_display) { ?>
              <input type="radio" name="company_id_display" value="1" checked="checked" />
              <?php echo $text_yes; ?>
              <input type="radio" name="company_id_display" value="0" />
              <?php echo $text_no; ?>
              <?php } else { ?>
              <input type="radio" name="company_id_display" value="1" />
              <?php echo $text_yes; ?>
              <input type="radio" name="company_id_display" value="0" checked="checked" />
              <?php echo $text_no; ?>
              <?php } ?></td>
          </tr>
          <tr>
            <td><?php echo $entry_company_id_required; ?></td>
            <td><?php if ($company_id_required) { ?>
              <input type="radio" name="company_id_required" value="1" checked="checked" />
              <?php echo $text_yes; ?>
              <input type="radio" name="company_id_required" value="0" />
              <?php echo $text_no; ?>
              <?php } else { ?>
              <input type="radio" name="company_id_required" value="1" />
              <?php echo $text_yes; ?>
              <input type="radio" name="company_id_required" value="0" checked="checked" />
              <?php echo $text_no; ?>
              <?php } ?></td>
          </tr>
          <tr>
            <td><?php echo $entry_tax_id_display; ?></td>
            <td><?php if ($tax_id_display) { ?>
              <input type="radio" name="tax_id_display" value="1" checked="checked" />
              <?php echo $text_yes; ?>
              <input type="radio" name="tax_id_display" value="0" />
              <?php echo $text_no; ?>
              <?php } else { ?>
              <input type="radio" name="tax_id_display" value="1" />
              <?php echo $text_yes; ?>
              <input type="radio" name="tax_id_display" value="0" checked="checked" />
              <?php echo $text_no; ?>
              <?php } ?></td>
          </tr>
          <tr>
            <td><?php echo $entry_tax_id_required; ?></td>
            <td><?php if ($tax_id_required) { ?>
              <input type="radio" name="tax_id_required" value="1" checked="checked" />
              <?php echo $text_yes; ?>
              <input type="radio" name="tax_id_required" value="0" />
              <?php echo $text_no; ?>
              <?php } else { ?>
              <input type="radio" name="tax_id_required" value="1" />
              <?php echo $text_yes; ?>
              <input type="radio" name="tax_id_required" value="0" checked="checked" />
              <?php echo $text_no; ?>
              <?php } ?></td>
          </tr>
          <tr>
            <td><?php echo $entry_sort_order; ?></td>
            <td><input type="text" name="sort_order" value="<?php echo $sort_order; ?>" size="1" /></td>
          </tr>
          
          <tr>
            <td>Priority View</td>
             <span class="help">Select the priority to be viewd on the lists </span>
            <td>
                <input type="text" name="priority_view" value="<?php echo $priority_view; ?>" size="1" />
            </td>
          </tr>
                   
          <tr>
            <td>Gift program
            <span class="help">Participation on a gift program </span>
            </td>
            <td>
            <?php if ($gift_program == 1) { ?>
              <input type="radio" name="gift_program" value="1" checked="checked" />
              <?php echo $text_yes; ?>
              <input type="radio" name="gift_program" value="0" />
              <?php echo $text_no; ?>
              <?php } else { ?>
              <input type="radio" name="gift_program" value="1" />
              <?php echo $text_yes; ?>
              <input type="radio" name="gift_program" value="0" checked="checked" />
              <?php echo $text_no; ?>
              <?php } ?>
            </td>
          </tr>
          
          <tr>
            <td>Skype assistance
             <span class="help">This group receives assistance through skype</span>
            </td>
            <td>
              <?php if ($skype_assistance == 1) { ?>
                <input type="radio" name="skype_assistance" value="1" checked="checked" />
                <?php echo $text_yes; ?>
                <input type="radio" name="skype_assistance" value="0" />
                <?php echo $text_no; ?>
                <?php } else { ?>
                <input type="radio" name="skype_assistance" value="1" />
                <?php echo $text_yes; ?>
                <input type="radio" name="skype_assistance" value="0" checked="checked" />
                <?php echo $text_no; ?>
              <?php } ?>          
            </td>        
          </tr>
          
          <tr>
            <td>Personal Agent
             <span class="help">This group receives a personal agent assistance</span>
            </td>
            <td>       
              <?php if ($personal_agent == 1) { ?>
                <input type="radio" name="personal_agent" value="1" checked="checked" />
                <?php echo $text_yes; ?>
                <input type="radio" name="personal_agent" value="0" />
                <?php echo $text_no; ?>
                <?php } else { ?>
                <input type="radio" name="personal_agent" value="1" />
                <?php echo $text_yes; ?>
                <input type="radio" name="personal_agent" value="0" checked="checked" />
                <?php echo $text_no; ?>
              <?php } ?>          
            </td>        
          </tr>
          
          <tr>
            <td>Logo preview
            <span class="help">Logo shown on the carousel</span>
            </td>
            <td>                          
              <?php if ($logo_preview == 1) { ?>
                <input type="radio" name="logo_preview" value="1" checked="checked" />
                <?php echo $text_yes; ?>
                <input type="radio" name="logo_preview" value="0" />
                <?php echo $text_no; ?>
                <?php } else { ?>
                <input type="radio" name="logo_preview" value="1" />
                <?php echo $text_yes; ?>
                <input type="radio" name="logo_preview" value="0" checked="checked" />
                <?php echo $text_no; ?>
              <?php } ?>          
            </td>        
          </tr> 
          
          
          <tr>
              <td>Photos number
                  <span class="help">Number of photos to upload</span>
              </td>
            <td>                          
                <input type="text" name="photo_album_number" value="<?php echo $photo_album_number; ?>" size="10" />
            </td>        
          </tr>  
          
          <tr>
              <td>Products number
                  <span class="help">Number of products to upload</span>
              </td>
            <td>                          
                <input type="text" name="products_number" value="<?php echo $products_number; ?>" size="10" />
            </td>        
          </tr>
          
          <tr>
              <td>Freights number
                  <span class="help">Number of freights to upload</span>
              </td>
            <td>                          
                <input type="text" name="freights_number" value="<?php echo $freights_number; ?>" size="10" />
            </td>        
          </tr>
          
          <tr>
              <td>Trucks number
                  <span class="help">Number of trucks to upload</span>
              </td>
            <td>                          
                <input type="text" name="trucks_number" value="<?php echo $trucks_number; ?>" size="10" />
            </td>        
          </tr>
          
          <tr>
              <td>Warehouse number
                  <span class="help">Number of warehouses to upload</span>
              </td>
            <td>                          
                <input type="text" name="warehouse_number" value="<?php echo $warehouse_number; ?>" size="10" />
            </td>        
          </tr>
          
          <tr>
              <td>Show views
                  <span class="help">Show how many times have been viewed the Products, Freights, Trucks</span>
              </td>
              
              <td>                          
              <?php if ($show_views == 1) { ?>
                <input type="radio" name="show_views" value="1" checked="checked" />
                <?php echo $text_yes; ?>
                <input type="radio" name="show_views" value="0" />
                <?php echo $text_no; ?>
                <?php } else { ?>
                <input type="radio" name="show_views" value="1" />
                <?php echo $text_yes; ?>
                <input type="radio" name="show_views" value="0" checked="checked" />
                <?php echo $text_no; ?>
              <?php } ?>          
              </td>     
                  
          </tr>
          
          
          
          <tr>
              <td>Price
                  <span class="help">The price to pay to registrer that customer group </span>
              </td>
            <td>                          
                <input type="text" name="registration_price" value="<?php echo $registration_price; ?>" size="10" />
            </td>        
          </tr> 
          
          <tr>
              <td>Duration (in days)
                  <span class="help">The duration of membership in days</span>
              </td>
            <td>                          
                <input type="text" name="duration" value="<?php echo $duration; ?>" size="10" />
            </td>        
          </tr>  
          
          
          
        </table>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript" src="view/javascript/ckeditor/ckeditor.js"></script> 
<script type="text/javascript"><!--
<?php foreach ($languages as $language) { ?>
CKEDITOR.replace('description<?php echo $language['language_id']; ?>', {
	filebrowserBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserImageUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>'
});
<?php } ?>
//--></script> 

<?php echo $footer; ?>