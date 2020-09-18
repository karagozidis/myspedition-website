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
  <h1><img src="view/image/information.png" alt="" /> <?php echo $heading_title; ?></h1>
   <div class="buttons"><a onclick="$('#form').submit();" class="button"><span><?php echo $button_save; ?></span></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><span><?php echo $button_cancel; ?></span></a></div>
</div>
<div class="content">
<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
  <div id="tab_general" class="page">
    <table class="form">
	<thead>
	<tr> <td style="background: #06f; border: 4px solid #ddd; border-right: none;">
	<div style=" padding: 8px; font-size: 16px; color: #fff; font-weight: bold; display: block;"><?php echo $tab_general; ?></div>
	</td> <td style="background: #444; border: 4px solid #ddd; border-left: none;"></td></tr>
	</thead>
      <?php foreach ($languages as $language) { ?>
        <tr>
          <td width="25%"><span class="required">*</span> <?php echo $entry_title; ?></td>
          <td><input name="news_description[<?php echo $language['language_id']; ?>][title]" value="<?php echo isset( $news_description[$language['language_id']]['title']) ? $news_description[$language['language_id']]['title'] : ''; ?>" />
            <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /><br />
			<?php if (isset($error_title[$language['language_id']])) { ?>
                  <span class="error"><?php echo $error_title[$language['language_id']]; ?></span>
                  <?php } ?>
               </td>
        </tr>
		
      <tr>
          <td><span class="required">*</span> <?php echo $entry_description; ?></td>
          <td><textarea name="news_description[<?php echo $language['language_id']; ?>][description]" id="description<?php echo $language['language_id']; ?>"><?php echo isset( $news_description[$language['language_id']]['description']) ? $news_description[$language['language_id']]['description'] : ''; ?></textarea>
            <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" style="vertical-align: top;" />
            <?php if (isset($error_description[$language['language_id']])) { ?>
                  <br /><span class="error"><?php echo $error_description[$language['language_id']]; ?></span>
                  <?php } ?>
			</td>
        </tr>
      <?php } ?>
	  <tr>
              <td><?php echo $entry_image; ?></td>
              <td><div class="image"><img src="<?php echo $thumb; ?>" alt="" id="thumb" /><br />
                  <input type="hidden" name="image" value="<?php echo $image; ?>" id="image" />
                  <a onclick="image_upload('image', 'thumb');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#thumb').attr('src', '<?php echo $no_image; ?>'); $('#image').attr('value', '');"><?php echo $text_clear; ?></a></div></td>
            </tr>
	  <thead>
	<tr> <td style="background: #06f; border: 4px solid #ddd; border-right: none;">
	<div style=" padding: 8px; font-size: 16px; color: #fff; font-weight: bold; display: block;"><?php echo $tab_seo; ?></div>
	</td> <td style="background: #444; border: 4px solid #ddd; border-left: none;"></td></tr>
	</thead>
	  <?php foreach ($languages as $language) { ?>
		 <tr>
          <td><?php echo $entry_meta_desc; ?></td>
          <td><textarea name="news_description[<?php echo $language['language_id']; ?>][meta_desc]" cols="60" rows="3"><?php echo isset( $news_description[$language['language_id']]['meta_desc']) ? $news_description[$language['language_id']]['meta_desc'] : ''; ?></textarea>
            <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" style="vertical-align: top;" />
            </td>
        </tr>
		<tr>
          <td> <?php echo $entry_meta_key; ?></td>
          <td><textarea name="news_description[<?php echo $language['language_id']; ?>][meta_key]" cols="60" rows="3"><?php echo isset( $news_description[$language['language_id']]['meta_key']) ? $news_description[$language['language_id']]['meta_key'] : ''; ?></textarea>
            <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" style="vertical-align: top;" />
            </td>
        </tr>
	   <tr>
	    <?php } ?>
              <td><?php echo $entry_keyword; ?></td>
              <td><input type="text" name="keyword" value="<?php echo $keyword; ?>" /></td>
       </tr>
	     <thead>
	<tr> <td style="background: #06f; border: 4px solid #ddd; border-right: none;">
	<div style=" padding: 8px; font-size: 16px; color: #fff; font-weight: bold; display: block;"><?php echo $tab_settings; ?></div>
	</td> <td style="background: #444; border: 4px solid #ddd; border-left: none;"></td></tr>
	</thead>
			<tr>
              <td><?php echo $entry_acom; ?></td>
              <td><select name="acom">
          <?php if ($acom) { ?>
          <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
          <option value="0"><?php echo $text_disabled; ?></option>
          <?php } else { ?>
          <option value="1"><?php echo $text_enabled; ?></option>
          <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
          <?php } ?>
        </select></td>
            </tr>
			<tr>
              <td><?php echo $entry_sort_order; ?></td>
              <td><input type="text" name="sort_order" value="<?php echo $sort_order; ?>" size="2" /></td>
            </tr>
			<tr>
			  <td><?php echo $entry_category; ?></td>
              <td><div class="scrollbox">
                  <?php $class = 'odd'; ?>
                  <?php foreach ($ncategories as $category) { ?>
                  <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                  <div class="<?php echo $class; ?>">
                    <?php if (in_array($category['ncategory_id'], $news_ncategory)) { ?>
                    <input type="checkbox" name="news_ncategory[]" value="<?php echo $category['ncategory_id']; ?>" checked="checked" />
                    <?php echo $category['name']; ?>
                    <?php } else { ?>
                    <input type="checkbox" name="news_ncategory[]" value="<?php echo $category['ncategory_id']; ?>" />
                    <?php echo $category['name']; ?>
                    <?php } ?>
                  </div>
                  <?php } ?>
                </div>
                <a onclick="$(this).parent().find(':checkbox').attr('checked', true);"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().find(':checkbox').attr('checked', false);"><?php echo $text_unselect_all; ?></a></td>
            </tr>
            <tr>
              <td><?php echo $entry_store; ?></td>
              <td><div class="scrollbox">
                  <?php $class = 'even'; ?>
                  <div class="<?php echo $class; ?>">
                    <?php if (in_array(0, $news_store)) { ?>
                    <input type="checkbox" name="news_store[]" value="0" checked="checked" />
                    <?php echo $text_default; ?>
                    <?php } else { ?>
                    <input type="checkbox" name="news_store[]" value="0" />
                    <?php echo $text_default; ?>
                    <?php } ?>
                  </div>
                  <?php foreach ($stores as $store) { ?>
                  <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                  <div class="<?php echo $class; ?>">
                    <?php if (in_array($store['store_id'], $news_store)) { ?>
                    <input type="checkbox" name="news_store[]" value="<?php echo $store['store_id']; ?>" checked="checked" />
                    <?php echo $store['name']; ?>
                    <?php } else { ?>
                    <input type="checkbox" name="news_store[]" value="<?php echo $store['store_id']; ?>" />
                    <?php echo $store['name']; ?>
                    <?php } ?>
                  </div>
                  <?php } ?>
                </div></td>
            </tr>
      <tr>	  
        <td width="25%"><?php echo $entry_status; ?></td>
        <td><select name="status">
          <?php if ($status) { ?>
          <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
          <option value="0"><?php echo $text_disabled; ?></option>
          <?php } else { ?>
          <option value="1"><?php echo $text_enabled; ?></option>
          <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
          <?php } ?>
        </select></td>
      </tr>
	<thead>
	<tr> <td style="background: #06f; border: 4px solid #ddd; border-right: none;">
	<div style=" padding: 8px; font-size: 16px; color: #fff; font-weight: bold; display: block;"><?php echo $tab_related; ?></div>
	</td> <td style="background: #444; border: 4px solid #ddd; border-left: none;"></td></tr>
	</thead>
	<tr><td><?php echo $entry_related; ?></td>
              <td><input type="text" name="related" value="" /></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><div class="scrollbox" id="news-related">
                  <?php $class = 'odd'; ?>
                  <?php foreach ($news_related as $news_related) { ?>
                  <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                  <div id="news-related<?php echo $news_related['product_id']; ?>" class="<?php echo $class; ?>"> <?php echo $news_related['name']; ?><img src="view/image/delete.png" />
                    <input type="hidden" name="news_related[]" value="<?php echo $news_related['product_id']; ?>" />
                  </div>
                  <?php } ?>
                </div>
	</td></tr>
	<thead>
	<tr> <td style="background: #06f; border: 4px solid #ddd; border-right: none;">
	<div style=" padding: 8px; font-size: 16px; color: #fff; font-weight: bold; display: block;"><?php echo $entry_layout; ?></div>
	</td> <td style="background: #444; border: 4px solid #ddd; border-left: none;"></td></tr>
	</thead>
<tr>
<td class="left"><?php echo $entry_store; ?></td>
<td class="left"><?php echo $entry_layout; ?></td>
</tr>
              <tr>
                <td class="left"><?php echo $text_default; ?></td>
                <td class="left"><select name="news_layout[0][layout_id]">
                    <option value=""></option>
                    <?php foreach ($layouts as $layout) { ?>
                    <?php if (isset($news_layout[0]) && $news_layout[0] == $layout['layout_id']) { ?>
                    <option value="<?php echo $layout['layout_id']; ?>" selected="selected"><?php echo $layout['name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select></td>
              </tr>
            <?php foreach ($stores as $store) { ?>
              <tr>
                <td class="left"><?php echo $store['name']; ?></td>
                <td class="left"><select name="news_layout[<?php echo $store['store_id']; ?>][layout_id]">
                    <option value=""></option>
                    <?php foreach ($layouts as $layout) { ?>
                    <?php if (isset($news_layout[$store['store_id']]) && $news_layout[$store['store_id']] == $layout['layout_id']) { ?>
                    <option value="<?php echo $layout['layout_id']; ?>" selected="selected"><?php echo $layout['name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select></td>
              </tr>
            <?php } ?>
    </table>
  </div>
</form>
<script type="text/javascript"><!--
$('input[name=\'related\']').autocomplete({
	delay: 0,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item.name,
						value: item.product_id
					}
				}));
			}
		});
		
	}, 
	select: function(event, ui) {
		$('#news-related' + ui.item.value).remove();
		
		$('#news-related').append('<div id="news-related' + ui.item.value + '">' + ui.item.label + '<img src="view/image/delete.png" /><input type="hidden" name="news_related[]" value="' + ui.item.value + '" /></div>');

		$('#news-related div:odd').attr('class', 'odd');
		$('#news-related div:even').attr('class', 'even');
				
		return false;
	}
});

$('#news-related div img').live('click', function() {
	$(this).parent().remove();
	
	$('#news-related div:odd').attr('class', 'odd');
	$('#news-related div:even').attr('class', 'even');	
});
//--></script> 
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
<script type="text/javascript"><!--
function image_upload(field, thumb) {
	$('#dialog').remove();
	
	$('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="index.php?route=common/filemanager&token=<?php echo $token; ?>&field=' + encodeURIComponent(field) + '" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
	
	$('#dialog').dialog({
		title: '<?php echo $text_image_manager; ?>',
		close: function (event, ui) {
			if ($('#' + field).attr('value')) {
				$.ajax({
					url: 'index.php?route=common/filemanager/image&token=<?php echo $token; ?>&image=' + encodeURIComponent($('#' + field).attr('value')),
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

</div>
