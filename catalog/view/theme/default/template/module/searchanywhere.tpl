<div class="box">
  <div class="box-heading"><?php echo $heading_title; ?></div>
  <div class="box-content">
      <div class="cart">
        <?php if (($setting['position'] == 'content_top') || ($setting['position'] == 'content_bottom')) { ?>
            <p><?php echo $text_content_explain; ?></p>
            <div>
              <input type="text" name="filter_searchanywhere" size="20" value="" />
              &nbsp;<a id="button-searchanywhere" class="button"><span><?php echo $button_search; ?></span></a>
            </div>
        <?php }else{ ?>
            <div>
              <input class="tooltip" type="text" name="filter_searchanywhere" size="20" value="" title="<?php echo $text_sidebar_explain; ?>" /><br /><br />
              <a id="button-searchanywhere" class="button"><span><?php echo $button_search; ?></span></a>
            </div>        
        <?php } ?>
      </div>
  </div>
</div>
<script type="text/javascript"><!--
$('input[name=\'filter_searchanywhere\']').keydown(function(e) {
	if (e.keyCode == 13) {
		$('#button-searchanywhere').trigger('click');
	}
});

$('#button-searchanywhere').bind('click', function() {
	url = 'index.php?route=product/search';
	
	var filter_searchanywhere = $('input[name=\'filter_searchanywhere\']').attr('value');
	var filter_name = $('input[name=\'filter_searchanywhere\']').attr('value');
	
	if (filter_searchanywhere) {
		url += '&search=' + encodeURIComponent(filter_searchanywhere);
		url += '&filter_searchanywhere=' + encodeURIComponent(filter_searchanywhere);
	}

	location = url;
});
//--></script>