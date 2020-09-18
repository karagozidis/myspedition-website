<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content"><?php echo $content_top; ?>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <h1><?php echo $heading_title; ?></h1>
  <div class="product-info">
    <?php if ($thumb || $images) { ?>
    <div class="left">
      <?php if ($thumb) { ?>
      <div class="image"><a href="<?php echo $popup; ?>" title="<?php echo $heading_title; ?>" class="colorbox"><img src="<?php echo $thumb; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" id="image" /></a></div>
      <?php } ?>
      <?php if ($images) { ?>
      <div class="image-additional">
        <?php foreach ($images as $image) { ?>
        <a href="<?php echo $image['popup']; ?>" title="<?php echo $heading_title; ?>" class="colorbox"><img src="<?php echo $image['thumb']; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" /></a>
        <?php } ?>
      </div>
      <?php } ?>
    </div>
    <?php } ?>
    <div class="right">
      <div class="description">
        <?php if ($manufacturer) { ?>
        <span><?php echo $text_manufacturer; ?></span> <a href="<?php echo $manufacturers; ?>"><?php echo $manufacturer; ?></a><br />
        <?php } ?>
        <span><?php echo $text_model; ?></span> <?php echo $model; ?><br />
        <?php if ($reward) { ?>
        <span><?php echo $text_reward; ?></span> <?php echo $reward; ?><br />
        <?php } ?>
        <span><?php echo $text_stock; ?></span> <?php echo $stock; ?>
      </div>
      
        
      <?php if($isLogged) { ?>
                 <?php if($customer_available) { ?>
                  <div style="font-size: 200%;" > Owner </div> 
                     <table>
                         <tr>
                             <td>
                                 <a  href="?route=customer/customer/update&customer_id=<?php echo $customer['customer_id']; ?>" target="_blank" >
                                 <?php if($customer['company_logo'] == "") { ?>
                                     <img src="image/companyLogo.png" width="120">
                                 <?php } else { ?>
                                     <img src="image/<?php echo $customer['company_logo'] ?>" width="120">
                                 <?php } ?>
                                 &nbsp;&nbsp;&nbsp;
                                 </a>
                             </td> 
                             <td>

                                 <table>
                                     <tr>                             
                                         <td>
                                             <a style="text-decoration: none;" href="?route=customer/customer/update&customer_id=<?php echo $customer['customer_id']; ?>" target="_blank" >
                                                 <b>General Company Name:</b>
                                             </a>
                                         </td>
                                         <td>
                                             <a href="?route=customer/customer/update&customer_id=<?php echo $customer['customer_id']; ?>" target="_blank" >
                                                 <input type="text" value="<?php echo $customer['company']; ?>" readonly>            
                                            </a>
                                         </td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <a style="text-decoration: none;" href="?route=customer/customer/update&customer_id=<?php echo $customer['customer_id']; ?>" target="_blank" >
                                             <b>Owner:</b>
                                            </a>
                                        </td>
                                         <td>
                                            <a  href="?route=customer/customer/update&customer_id=<?php echo $customer['customer_id']; ?>" target="_blank" >
                                             <input type="text" value="<?php echo $customer['firstname']; ?> <?php echo $customer['lastname']; ?>" readonly>       
                                            </a>
                                         </td> 
                                     </tr>
                                     <tr>

                                         <td>
                                           <a style="text-decoration: none;" href="?route=customer/customer/update&customer_id=<?php echo $customer['customer_id']; ?>" target="_blank" >
                                             <b>Telephone:</b>
                                           </a>       
                                        </td>
                                        <td>
                                        <?php if($view_telephone == true) { ?>  
                                          <a href="?route=customer/customer/update&customer_id=<?php echo $customer['customer_id']; ?>" target="_blank" >
                                           <input type="text" value="<?php 
                                                  if ( isset($isLogged) ) 
                                                    { 
                                                    echo $customer['telephone'];
                                                    } 
                                                 else echo '****'; 
                                                 ?>" readonly>                          
                                          </a>
                                        <?php } else {  ?>
                                           <div style="font-weight: normal;border: 1px solid #EEEEEE;background: #E6E6E6;cursor: pointer;">
                                                         <a href="<?php echo $upgradeUrl; ?>">
                                                            <?php echo html_entity_decode($upgradeSmallText['text']); ?>
                                                         </a> 
                                           </div> 
                                        <?php } ?>     
                                        </td>
                                     </tr>
                                     <tr>
                                         <td>
                                           <a style="text-decoration: none;" href="?route=customer/customer/update&customer_id=<?php echo $customer['customer_id']; ?>" target="_blank" >
                                             <b>Skype:</b>
                                           </a>
                                         </td>
                                         <td>
                                         <?php if($view_skype == true) { ?>  
                                          <a href="?route=customer/customer/update&customer_id=<?php echo $customer['customer_id']; ?>" target="_blank" >
                                           <input type="text" value="<?php 
                                                  if ( isset($isLogged) ) 
                                                    { 
                                                    echo $customer['skype'];
                                                    } 
                                                 else echo '****'; 
                                                 ?>" readonly>                          
                                          </a>
                                         <?php } else {  ?>
                                           <div style="font-weight: normal;border: 1px solid #EEEEEE;background: #E6E6E6;cursor: pointer;">
                                                         <a href="<?php echo $upgradeUrl; ?>">
                                                            <?php echo html_entity_decode($upgradeSmallText['text']); ?>
                                                         </a> 
                                           </div> 
                                        <?php } ?>     
                                        </td>
                                     </tr>

                                 </table>

                             </td>
                         </tr>      
                     </table>  
                  <?php } ?>
      <?php } else { ?>
      <div class="description" >
          <a href="?route=account/login">
          <div style="font-size: 200%; color: red;" > Owner </div> 
          <div style="font-size: 150%; color: red;" > Login or register to view contact info </div>
          </a>
       </div>
      <?php } ?>
        
        
        
        
        
      
      <div class="description" >
        <div style="font-size: 200%;" > Area </div> 
        <?php if($country) { ?>
          <span> Country: </span> <img src="image/flags/<?php echo strToLower($country['iso_code_2']); ?>.png"> <?php echo $country['name']; ?> <br>
        <?php } ?>
        <?php if($zone) { ?>
          <span> Area: </span> <?php echo $zone['name']; ?> <br>
        <?php } ?>
          <span> Location: </span> <?php echo $location; ?> <br>         
      </div>
 
      
      <?php if ($price) { ?>
      <div class="price"><?php echo $text_price; ?>
        <?php if (!$special) { ?>
        <?php echo $price; ?>
        <?php } else { ?>
        <span class="price-old"><?php echo $price; ?></span> <span class="price-new"><?php echo $special; ?></span>
        <?php } ?>
        <br />
        <!--
        <?php if ($tax) { ?>
        <span class="price-tax"><?php echo $text_tax; ?> <?php echo $tax; ?></span><br />
        <?php } ?>
        -->
        <?php if ($points) { ?>
        <span class="reward"><small><?php echo $text_points; ?> <?php echo $points; ?></small></span><br />
        <?php } ?>
        <?php if ($discounts) { ?>
        <br />
        <div class="discount">
          <?php foreach ($discounts as $discount) { ?>
          <?php echo sprintf($text_discount, $discount['quantity'], $discount['price']); ?><br />
          <?php } ?>
        </div>
        <?php } ?>
      </div>
      <?php } ?>
      <?php if ($options) { ?>
      <div class="options">
        <h2><?php echo $text_option; ?></h2>
        <br />
        <?php foreach ($options as $option) { ?>
        <?php if ($option['type'] == 'select') { ?>
        <div id="option-<?php echo $option['productRequest_option_id']; ?>" class="option">
          <?php if ($option['required']) { ?>
          <span class="required">*</span>
          <?php } ?>
          <b><?php echo $option['name']; ?>:</b><br />
          <select name="option[<?php echo $option['productRequest_option_id']; ?>]">
            <option value=""><?php echo $text_select; ?></option>
            <?php foreach ($option['option_value'] as $option_value) { ?>
            <option value="<?php echo $option_value['productRequest_option_value_id']; ?>"><?php echo $option_value['name']; ?>
            <?php if ($option_value['price']) { ?>
            (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
            <?php } ?>
            </option>
            <?php } ?>
          </select>
        </div>
        <br />
        <?php } ?>
        <?php if ($option['type'] == 'radio') { ?>
        <div id="option-<?php echo $option['productRequest_option_id']; ?>" class="option">
          <?php if ($option['required']) { ?>
          <span class="required">*</span>
          <?php } ?>
          <b><?php echo $option['name']; ?>:</b><br />
          <?php foreach ($option['option_value'] as $option_value) { ?>
          <input type="radio" name="option[<?php echo $option['productRequest_option_id']; ?>]" value="<?php echo $option_value['productRequest_option_value_id']; ?>" id="option-value-<?php echo $option_value['productRequest_option_value_id']; ?>" />
          <label for="option-value-<?php echo $option_value['productRequest_option_value_id']; ?>"><?php echo $option_value['name']; ?>
            <?php if ($option_value['price']) { ?>
            (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
            <?php } ?>
          </label>
          <br />
          <?php } ?>
        </div>
        <br />
        <?php } ?>
        <?php if ($option['type'] == 'checkbox') { ?>
        <div id="option-<?php echo $option['productRequest_option_id']; ?>" class="option">
          <?php if ($option['required']) { ?>
          <span class="required">*</span>
          <?php } ?>
          <b><?php echo $option['name']; ?>:</b><br />
          <?php foreach ($option['option_value'] as $option_value) { ?>
          <input type="checkbox" name="option[<?php echo $option['productRequest_option_id']; ?>][]" value="<?php echo $option_value['productRequest_option_value_id']; ?>" id="option-value-<?php echo $option_value['productRequest_option_value_id']; ?>" />
          <label for="option-value-<?php echo $option_value['productRequest_option_value_id']; ?>"><?php echo $option_value['name']; ?>
            <?php if ($option_value['price']) { ?>
            (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
            <?php } ?>
          </label>
          <br />
          <?php } ?>
        </div>
        <br />
        <?php } ?>
        <?php if ($option['type'] == 'image') { ?>
        <div id="option-<?php echo $option['productRequest_option_id']; ?>" class="option">
          <?php if ($option['required']) { ?>
          <span class="required">*</span>
          <?php } ?>
          <b><?php echo $option['name']; ?>:</b><br />
          <table class="option-image">
            <?php foreach ($option['option_value'] as $option_value) { ?>
            <tr>
              <td style="width: 1px;"><input type="radio" name="option[<?php echo $option['productRequest_option_id']; ?>]" value="<?php echo $option_value['productRequest_option_value_id']; ?>" id="option-value-<?php echo $option_value['productRequest_option_value_id']; ?>" /></td>
              <td><label for="option-value-<?php echo $option_value['productRequest_option_value_id']; ?>"><img src="<?php echo $option_value['image']; ?>" alt="<?php echo $option_value['name'] . ($option_value['price'] ? ' ' . $option_value['price_prefix'] . $option_value['price'] : ''); ?>" /></label></td>
              <td><label for="option-value-<?php echo $option_value['productRequest_option_value_id']; ?>"><?php echo $option_value['name']; ?>
                  <?php if ($option_value['price']) { ?>
                  (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                  <?php } ?>
                </label></td>
            </tr>
            <?php } ?>
          </table>
        </div>
        <br />
        <?php } ?>
        <?php if ($option['type'] == 'text') { ?>
        <div id="option-<?php echo $option['productRequest_option_id']; ?>" class="option">
          <?php if ($option['required']) { ?>
          <span class="required">*</span>
          <?php } ?>
          <b><?php echo $option['name']; ?>:</b><br />
          <input type="text" name="option[<?php echo $option['productRequest_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" />
        </div>
        <br />
        <?php } ?>
        <?php if ($option['type'] == 'textarea') { ?>
        <div id="option-<?php echo $option['productRequest_option_id']; ?>" class="option">
          <?php if ($option['required']) { ?>
          <span class="required">*</span>
          <?php } ?>
          <b><?php echo $option['name']; ?>:</b><br />
          <textarea name="option[<?php echo $option['productRequest_option_id']; ?>]" cols="40" rows="5"><?php echo $option['option_value']; ?></textarea>
        </div>
        <br />
        <?php } ?>
        <?php if ($option['type'] == 'file') { ?>
        <div id="option-<?php echo $option['productRequest_option_id']; ?>" class="option">
          <?php if ($option['required']) { ?>
          <span class="required">*</span>
          <?php } ?>
          <b><?php echo $option['name']; ?>:</b><br />
          <input type="button" value="<?php echo $button_upload; ?>" id="button-option-<?php echo $option['productRequest_option_id']; ?>" class="button">
          <input type="hidden" name="option[<?php echo $option['productRequest_option_id']; ?>]" value="" />
        </div>
        <br />
        <?php } ?>
        <?php if ($option['type'] == 'date') { ?>
        <div id="option-<?php echo $option['productRequest_option_id']; ?>" class="option">
          <?php if ($option['required']) { ?>
          <span class="required">*</span>
          <?php } ?>
          <b><?php echo $option['name']; ?>:</b><br />
          <input type="text" name="option[<?php echo $option['productRequest_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" class="date" />
        </div>
        <br />
        <?php } ?>
        <?php if ($option['type'] == 'datetime') { ?>
        <div id="option-<?php echo $option['productRequest_option_id']; ?>" class="option">
          <?php if ($option['required']) { ?>
          <span class="required">*</span>
          <?php } ?>
          <b><?php echo $option['name']; ?>:</b><br />
          <input type="text" name="option[<?php echo $option['productRequest_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" class="datetime" />
        </div>
        <br />
        <?php } ?>
        <?php if ($option['type'] == 'time') { ?>
        <div id="option-<?php echo $option['productRequest_option_id']; ?>" class="option">
          <?php if ($option['required']) { ?>
          <span class="required">*</span>
          <?php } ?>
          <b><?php echo $option['name']; ?>:</b><br />
          <input type="text" name="option[<?php echo $option['productRequest_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" class="time" />
        </div>
        <br />
        <?php } ?>
        <?php } ?>
      </div>
      <?php } ?>
      <div class="cart">
        <div>
          <!--<?php echo $text_qty; ?>
          <input type="text" name="quantity" size="2" value="<?php echo $minimum; ?>" />
          <input type="hidden" name="productRequest_id" size="2" value="<?php echo $productRequest_id; ?>" />
          &nbsp;
          <input type="button" value="<?php echo $button_cart; ?>" id="button-cart" class="button" />-->
          <?php if($isLogged) { ?>
          <a href="?route=customer/customer/update&customer_id=<?php echo $customer['customer_id']; ?>" class="button" target="_blank" >View Owner</a>
          <?php } else { ?> 
           <a href="?route=account/login" class="button" target="_blank" >Login to View Owner</a>
          <?php } ?> 
          <span>&nbsp;&nbsp;<?php echo $text_or; ?>&nbsp;&nbsp;</span>
          <a href="skype:elena.myspedition?call" class="button" >Contact Us Via skype </a>
          
                    <span style="width:10px;" class="PopupContainer">
                               <span style="width: 10px;" id="popUp1">
                                   <img src="image/info.png" width="20" id="_popUp1_" >
                               </span>
                    </span>
          
          <span>&nbsp;&nbsp;<?php echo $text_or; ?>&nbsp;&nbsp;</span>
          <span class="links"><a onclick="addToWishList('<?php echo $productRequest_id; ?>');"><?php echo $button_wishlist; ?></a><br />
            <a onclick="addToCompare('<?php echo $productRequest_id; ?>');"><?php echo $button_compare; ?></a></span>
        </div>
        <?php if ($minimum > 1) { ?>
        <div class="minimum"><?php echo $text_minimum; ?></div>
        <?php } ?>
      </div>
      <?php if ($review_status) { ?>
      <div class="review">
        <div><img src="catalog/view/theme/default/image/stars-<?php echo $rating; ?>.png" alt="<?php echo $reviews; ?>" />&nbsp;&nbsp;<a onclick="$('a[href=\'#tab-review\']').trigger('click');"><?php echo $reviews; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('a[href=\'#tab-review\']').trigger('click');"><?php echo $text_write; ?></a></div>
        <div class="share"><!-- AddThis Button BEGIN -->
          <div class="addthis_default_style"><a class="addthis_button_compact"><?php echo $text_share; ?></a> <a class="addthis_button_email"></a><a class="addthis_button_print"></a> <a class="addthis_button_facebook"></a> <a class="addthis_button_twitter"></a></div>
          <script type="text/javascript" src="//s7.addthis.com/js/250/addthis_widget.js"></script> 
          <!-- AddThis Button END --> 
        </div>
      </div>
      <?php } ?>
    </div>
  </div>
  <div id="tabs" class="htabs"><a href="#tab-description"><?php echo $tab_description; ?></a>
    <?php if ($attribute_groups) { ?>
    <a href="#tab-attribute"><?php echo $tab_attribute; ?></a>
    <?php } ?>
    <?php if ($review_status) { ?>
    <a href="#tab-review"><?php echo $tab_review; ?></a>
    <?php } ?>
    <?php if ($productRequests) { ?>
    <a href="#tab-related"><?php echo $tab_related; ?> (<?php echo count($productRequests); ?>)</a>
    <?php } ?>
  </div>
  <div id="tab-description" class="tab-content"><?php echo $description; ?></div>
  <?php if ($attribute_groups) { ?>
  <div id="tab-attribute" class="tab-content">
    <table class="attribute">
      <?php foreach ($attribute_groups as $attribute_group) { ?>
      <thead>
        <tr>
          <td colspan="2"><?php echo $attribute_group['name']; ?></td>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($attribute_group['attribute'] as $attribute) { ?>
        <tr>
          <td><?php echo $attribute['name']; ?></td>
          <td><?php echo $attribute['text']; ?></td>
        </tr>
        <?php } ?>
      </tbody>
      <?php } ?>
    </table>
  </div>
  <?php } ?>
  <?php if ($review_status) { ?>
  <div id="tab-review" class="tab-content">
    <div id="review"></div>
    <h2 id="review-title"><?php echo $text_write; ?></h2>
    <b><?php echo $entry_name; ?></b><br />
    <input type="text" name="name" value="" />
    <br />
    <br />
    <b><?php echo $entry_review; ?></b>
    <textarea name="text" cols="40" rows="8" style="width: 98%;"></textarea>
    <span style="font-size: 11px;"><?php echo $text_note; ?></span><br />
    <br />
    <b><?php echo $entry_rating; ?></b> <span><?php echo $entry_bad; ?></span>&nbsp;
    <input type="radio" name="rating" value="1" />
    &nbsp;
    <input type="radio" name="rating" value="2" />
    &nbsp;
    <input type="radio" name="rating" value="3" />
    &nbsp;
    <input type="radio" name="rating" value="4" />
    &nbsp;
    <input type="radio" name="rating" value="5" />
    &nbsp;<span><?php echo $entry_good; ?></span><br />
    <br />
    <b><?php echo $entry_captcha; ?></b><br />
    <input type="text" name="captcha" value="" />
    <br />
    <img src="index.php?route=productRequest/productRequest/captcha" alt="" id="captcha" /><br />
    <br />
    <div class="buttons">
      <div class="right"><a id="button-review" class="button"><?php echo $button_continue; ?></a></div>
    </div>
  </div>
  <?php } ?>
  <?php if ($productRequests) { ?>
  <div id="tab-related" class="tab-content">
    <div class="box-productRequest">
      <?php foreach ($productRequests as $productRequest) { ?>
      <div>
        <?php if ($productRequest['thumb']) { ?>
        <div class="image"><a href="<?php echo $productRequest['href']; ?>"><img src="<?php echo $productRequest['thumb']; ?>" alt="<?php echo $productRequest['name']; ?>" /></a></div>
        <?php } ?>
        <div class="name"><a href="<?php echo $productRequest['href']; ?>"><?php echo $productRequest['name']; ?></a></div>
        <?php if ($productRequest['price']) { ?>
        <div class="price">
          <?php if (!$productRequest['special']) { ?>
          <?php echo $productRequest['price']; ?>
          <?php } else { ?>
          <span class="price-old"><?php echo $productRequest['price']; ?></span> <span class="price-new"><?php echo $productRequest['special']; ?></span>
          <?php } ?>
        </div>
        <?php } ?>
        <?php if ($productRequest['rating']) { ?>
        <div class="rating"><img src="catalog/view/theme/default/image/stars-<?php echo $productRequest['rating']; ?>.png" alt="<?php echo $productRequest['reviews']; ?>" /></div>
        <?php } ?>
        <!--<a onclick="addToCart('<?php echo $productRequest['productRequest_id']; ?>');" class="button"><?php echo $button_cart; ?></a>-->
      </div>
      <?php } ?>
    </div>
  </div>
  <?php } ?>
  <?php if ($tags) { ?>
  <div class="tags"><b><?php echo $text_tags; ?></b>
    <?php for ($i = 0; $i < count($tags); $i++) { ?>
    <?php if ($i < (count($tags) - 1)) { ?>
    <a href="<?php echo $tags[$i]['href']; ?>"><?php echo $tags[$i]['tag']; ?></a>,
    <?php } else { ?>
    <a href="<?php echo $tags[$i]['href']; ?>"><?php echo $tags[$i]['tag']; ?></a>
    <?php } ?>
    <?php } ?>
  </div>
  <?php } ?>
  <?php echo $content_bottom; ?></div>

<script src="catalog/view/javascript/jquery.BubblePopup-1.1.min.js" type="text/javascript"></script> 
<script type="text/javascript">
<!--
$(document).ready(function() {	
$('#popUp1').SetBubblePopup({
			     innerHtml: '<h2>You are interested about this productRequest</h2><p>Contuct with a Myspedition manager via skype <br> to learn more and order this productRequest.'
			    });
});
//-->
</script>

<script type="text/javascript"><!--
$(document).ready(function() {
	$('.colorbox').colorbox({
		overlayClose: true,
		opacity: 0.5,
		rel: "colorbox"
	});
});
//--></script> 
<script type="text/javascript"><!--
$('#button-cart').bind('click', function() {
	$.ajax({
		url: 'index.php?route=checkout/cart/add',
		type: 'post',
		data: $('.productRequest-info input[type=\'text\'], .productRequest-info input[type=\'hidden\'], .productRequest-info input[type=\'radio\']:checked, .productRequest-info input[type=\'checkbox\']:checked, .productRequest-info select, .productRequest-info textarea'),
		dataType: 'json',
		success: function(json) {
			$('.success, .warning, .attention, information, .error').remove();
			
			if (json['error']) {
				if (json['error']['option']) {
					for (i in json['error']['option']) {
						$('#option-' + i).after('<span class="error">' + json['error']['option'][i] + '</span>');
					}
				}
			} 
			
			if (json['success']) {
				$('#notification').html('<div class="success" style="display: none;">' + json['success'] + '<img src="catalog/view/theme/default/image/close.png" alt="" class="close" /></div>');
					
				$('.success').fadeIn('slow');
					
				$('#cart-total').html(json['total']);
				
				$('html, body').animate({ scrollTop: 0 }, 'slow'); 
			}	
		}
	});
});
//--></script>
<?php if ($options) { ?>
<script type="text/javascript" src="catalog/view/javascript/jquery/ajaxupload.js"></script>
<?php foreach ($options as $option) { ?>
<?php if ($option['type'] == 'file') { ?>
<script type="text/javascript"><!--
new AjaxUpload('#button-option-<?php echo $option['productRequest_option_id']; ?>', {
	action: 'index.php?route=productRequest/productRequest/upload',
	name: 'file',
	autoSubmit: true,
	responseType: 'json',
	onSubmit: function(file, extension) {
		$('#button-option-<?php echo $option['productRequest_option_id']; ?>').after('<img src="catalog/view/theme/default/image/loading.gif" class="loading" style="padding-left: 5px;" />');
		$('#button-option-<?php echo $option['productRequest_option_id']; ?>').attr('disabled', true);
	},
	onComplete: function(file, json) {
		$('#button-option-<?php echo $option['productRequest_option_id']; ?>').attr('disabled', false);
		
		$('.error').remove();
		
		if (json['success']) {
			alert(json['success']);
			
			$('input[name=\'option[<?php echo $option['productRequest_option_id']; ?>]\']').attr('value', json['file']);
		}
		
		if (json['error']) {
			$('#option-<?php echo $option['productRequest_option_id']; ?>').after('<span class="error">' + json['error'] + '</span>');
		}
		
		$('.loading').remove();	
	}
});
//--></script>
<?php } ?>
<?php } ?>
<?php } ?>
<script type="text/javascript"><!--
$('#review .pagination a').live('click', function() {
	$('#review').fadeOut('slow');
		
	$('#review').load(this.href);
	
	$('#review').fadeIn('slow');
	
	return false;
});			

$('#review').load('index.php?route=productRequest/productRequest/review&productRequest_id=<?php echo $productRequest_id; ?>');

$('#button-review').bind('click', function() {
	$.ajax({
		url: 'index.php?route=productRequest/productRequest/write&productRequest_id=<?php echo $productRequest_id; ?>',
		type: 'post',
		dataType: 'json',
		data: 'name=' + encodeURIComponent($('input[name=\'name\']').val()) + '&text=' + encodeURIComponent($('textarea[name=\'text\']').val()) + '&rating=' + encodeURIComponent($('input[name=\'rating\']:checked').val() ? $('input[name=\'rating\']:checked').val() : '') + '&captcha=' + encodeURIComponent($('input[name=\'captcha\']').val()),
		beforeSend: function() {
			$('.success, .warning').remove();
			$('#button-review').attr('disabled', true);
			$('#review-title').after('<div class="attention"><img src="catalog/view/theme/default/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');
		},
		complete: function() {
			$('#button-review').attr('disabled', false);
			$('.attention').remove();
		},
		success: function(data) {
			if (data['error']) {
				$('#review-title').after('<div class="warning">' + data['error'] + '</div>');
			}
			
			if (data['success']) {
				$('#review-title').after('<div class="success">' + data['success'] + '</div>');
								
				$('input[name=\'name\']').val('');
				$('textarea[name=\'text\']').val('');
				$('input[name=\'rating\']:checked').attr('checked', '');
				$('input[name=\'captcha\']').val('');
			}
		}
	});
});
//--></script> 
<script type="text/javascript"><!--
$('#tabs a').tabs();
//--></script> 
<script type="text/javascript" src="catalog/view/javascript/jquery/ui/jquery-ui-timepicker-addon.js"></script> 
<script type="text/javascript"><!--
$(document).ready(function() {
	if ($.browser.msie && $.browser.version == 6) {
		$('.date, .datetime, .time').bgIframe();
	}

	$('.date').datepicker({dateFormat: 'yy-mm-dd'});
	$('.datetime').datetimepicker({
		dateFormat: 'yy-mm-dd',
		timeFormat: 'h:m'
	});
	$('.time').timepicker({timeFormat: 'h:m'});
});
//--></script> 
<?php echo $footer; ?>