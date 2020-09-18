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
  <div class="box1">
    <div class="heading">
        <h1><img src="image/ship.png" width="25" alt="" /> <?php echo $heading_title; ?></h1>
      
      <div class="buttons1">
          <a onclick="$('#form').submit();" class="button"><?php echo $save_text; ?></a>
          <a href="<?php echo $cancel; ?>" class="button"><?php echo $cancel_text; ?></a>
          
      </div>
      
    </div>
    <div class="content1">
        
      <div id="tabs" class="htabs">
          <a href="#tab-data">[1] <?php echo $location_and_date_text; ?></a>
          <!--<a href="#freight_parameters">[2] <?php echo $truck_parameters_text; ?></a>-->
          <a href="#tab-general">[2] <?php echo $tab_general; ?></a>         
           <a href="#tab-image">[3] <?php echo $tab_image; ?></a>         
      </div>
        
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
          
        <input type="hidden" name="customer_id" value="<?php echo $this->customer->getId() ?>">
         
        <div id="tab-general">
          <div id="languages" class="htabs">
            <?php foreach ($languages as $language) { ?>
            <a href="#language<?php echo $language['language_id']; ?>">
                <img src="image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> 
                <!--<?php echo $language['name']; ?>-->
            </a>
            <?php } ?>
          </div>
          <?php foreach ($languages as $language) { ?>
          <div id="language<?php echo $language['language_id']; ?>">
            <table class="form">
              <tr>
                 <td colspan="2">
                  <b>
                  <?php echo $language['name']; ?>
                  </b>
                 </td>
              </tr>
              <!--
              <tr>
                <td><?php echo $entry_name; ?></td>
                <td><input type="text" name="product_description[<?php echo $language['language_id']; ?>][name]" size="100" value="<?php echo isset($product_description[$language['language_id']]) ? $product_description[$language['language_id']]['name'] : ''; ?>" />
                  <?php if (isset($error_name[$language['language_id']])) { ?>
                  <span class="error"><?php echo $error_name[$language['language_id']]; ?></span>
                  <?php } ?></td>
              </tr>
              -->
              <tr>
                <td><?php echo $entry_description; ?></td>
                <td>
                    <textarea rows="10" cols="80" name="product_description[<?php echo $language['language_id']; ?>][description]" id="description<?php echo $language['language_id']; ?>">
                        <?php echo isset($product_description[$language['language_id']]) ? $product_description[$language['language_id']]['description'] : ''; ?>
                    </textarea>
                </td>
              </tr>            
            </table>
          </div>
          <?php } ?>
        </div>
        <div id="tab-data">
          <table class="form">
             
           <tr class="bottomline">
              <td><?php echo $frequency_text; ?></td>
              <td>
                <input id="freq_single" type="radio" name="frequency" value="0" <?php if ($frequency == 0) echo 'checked'; ?>  >Single&nbsp;&nbsp;&nbsp;
                <input id="freq_regular" type="radio" name="frequency" value="1" <?php if ($frequency == 1) echo 'checked' ?>  >Regular 
              </td>
              <td> 
                      
              </td>

            </tr>         
          <tr>             
              <td><b><?php echo $loading_area_text; ?></b></td>             
         </tr>    
                                                      
            <tr>             
              <td> <span class="required">*</span><?php echo $loading_country_text; ?></td>
              <td>                   
                <select name="loading_country_id">
                    <option value="" > --- </option>   
                     <?php foreach ($coutries_total as $country) { ?>
                        <?php if( $country['country_id'] == $loading_country_id ) { ?>
                            <option value="<?php echo $country['country_id'] ?>" selected > <?php echo $country['name']?> </option>   
                        <?php } else { ?>
                            <option value="<?php echo $country['country_id']?>"><?php echo $country['name']?></option>   
                        <?php } ?>  
                     <?php } ?>
                </select>    
                  <?php if ($error_loading_country) { ?>
                       <span class="error"><?php echo $error_loading_country; ?></span>
                  <?php } ?>
             </td>            
            </tr>
                
            <tr>             
              <td> <?php echo $loading_region_state_text; ?></td>
              <td>                   
                <select name="loading_zone_id">                   
                </select>                                                           
             </td>            
            </tr> 
                    
            <tr>
              <td> <span class="required">*</span> <?php echo $loading_city_text; ?></td>
              <td>
                  <input type="text" name="loading_city" value="<?php echo $loading_city; ?>" />
                    <?php if ($error_loading_city) { ?>
                     <span class="error"><?php echo $error_loading_city; ?></span>
                    <?php } ?>
              </td>
            </tr>
            <tr class="bottomline">
              <td><?php echo $zip_code_text; ?></td>
              <td><input type="text" name="loading_zip" value="<?php echo $loading_zip; ?>" /></td>
            </tr>

          <tr>             
              <td><b><?php echo $offloading_area_text; ?></b></td>             
         </tr>    
         
            <tr>
              <td> <span class="required">*</span> <?php echo $offloading_country_text; ?></td>
              <td>
               <select name="offloading_country_id">
                     <option value="" > --- </option>  
                     <?php foreach ($coutries_total as $country) { ?>
                        <?php if( $country['country_id'] == $offloading_country_id ) { ?>
                            <option value="<?php echo $country['country_id'] ?>" selected > <?php echo $country['name']?> </option>   
                        <?php } else { ?>
                            <option value="<?php echo $country['country_id']?>"><?php echo $country['name']?></option>   
                        <?php } ?>  
                     <?php } ?>
                </select> 
                  <?php if ($error_offloading_country) { ?>
                       <span class="error"><?php echo $error_offloading_country; ?></span>
                  <?php } ?>
              </td>
            </tr>
            
            <tr>
              <td> <?php echo $offloading_region_state_text; ?></td>
              <td>
                  <select name="offloading_zone_id">
                  </select>               
              </td>
            </tr> 
            
            <tr>              
              <td> <span class="required">*</span> <?php echo $offloading_city_text; ?></td>
              <td>
                  <input type="text" name="offloading_city" value="<?php echo $offloading_city; ?>" />
                    <?php if ($error_offloading_city) { ?>
                     <span class="error"><?php echo $error_offloading_city; ?></span>
                    <?php } ?>
              </td>
            </tr>
            
            <tr class="bottomline">
              <td><?php echo $zip_code_text; ?></td>
              <td><input type="text" name="offloading_zip" value="<?php echo $offloading_zip; ?>" /></td>
            </tr>
            
         <tr id="date_text" >             
              <td><b><?php echo $date_text; ?></b></td>             
         </tr> 
            
            <tr id="loading_date" >                     
              <td> <span class="required">*</span> <?php echo $loading_date_text; ?></td>
              <td>
                  <input type="text" name="loading_date" value="<?php echo $loading_date; ?>" size="12" class="date" readonly/>
                  <?php if ($error_loading_date) { ?>
                     <span class="error"><?php echo $error_loading_date; ?></span>
                  <?php } ?>
              </td>
            </tr>
            <tr id="est_date" class="bottomline" >
              <td><?php echo $estimation_date_text; ?></td>
              <td> 
                  <select name="est_date">
                    <?php for ($i = 0; $i <= 20; $i++){ ?> 
                     <?php if ( $est_date == $i ){ ?> 
                        <option value="<?php echo $i ?>" selected>+-<?php echo $i.' days'?> </option>
                     <?php } else { ?> 
                        <option value="<?php echo $i ?>">+-<?php echo $i.' days'?> </option>
                     <?php }?> 
                  <?php }?> 
                </select>                                                                
              </td>
            </tr>                     
    
            <tr id="offloading_date" >                     
              <td><?php echo $offloading_date_text; ?></td>
              <td><input type="text" name="offloading_date" value="<?php echo $offloading_date; ?>" size="12" class="date" readonly /></td>
            </tr>
            
  
            
          <!-- <tr class="bottomline">
        
            <td colspan="2"></td>
              <td>
                  <?php if ($adr == 1) {  ?>
                    <input type="checkbox" name="adr" value="1" checked>ADR
                  <?php } else { ?>
                    <input type="checkbox" name="adr" value="1">ADR               
                  <?php } ?>
              </td>
              <td>
                  <?php if ($tir == 1) {  ?>
                  <input type="checkbox" name="tir" value="1" checked>TIR
                  <?php } else { ?>
                   <input type="checkbox" name="tir" value="1">TIR
                  <?php } ?>
              </td>
                          
              <td>
                  <?php if ($cmr == 1) {  ?>
                  <input type="checkbox" name="cmr" value="1" checked>CMR
                   <?php } else { ?>
                  <input type="checkbox" name="cmr" value="1">CMR
                  <?php } ?>
              </td>
              <td>
                  <?php if ($cemt == 1) {  ?>
                  <input type="checkbox" name="cemt" value="1" checked>CEMT
                  <?php } else { ?>
                  <input type="checkbox" name="cemt" value="1">CEMT
                  <?php } ?>
              </td>
          
            </tr> -->
           
                                             
            <tr>                
              <td>Freight params</td>              
              <td>          
                  <input type="radio" name="freight_params" value="0" class="ftl-ltl" <?php if( $freight_params == 0 ) { ?> checked="checked" <?php } ?>  >Fcl
                    <input type="radio" name="freight_params" value="1" class="ftl-ltl"  <?php if( $freight_params == 1 ) { ?> checked="checked" <?php } ?>  >Lcl&nbsp;&nbsp;
                   <!-- <input type="text" name="freight_number" value="<?php echo $freight_number ?>" class="freight_number" size="4"> -->
              </td>
            </tr>
            <tr>              
              <td><?php echo $weight_tons_text; ?></td>
              <td>
                  <input type="text" name="weight_tons" value="<?php echo $weight_tons; ?>" />
                    <!--<?php if ($error_weight_tons) { ?>
                     <span class="error"><?php echo $error_weight_tons; ?></span>
                    <?php } ?> -->
              </td>
            </tr>
            <tr>              
              <td><?php echo $pallets_no_text; ?></td>
              <td>
                  <input type="text" name="pallets_no" value="<?php echo $pallets_no; ?>" /> 
              </td>
            </tr>
            <tr>              
              <td> <?php echo $volume_unit_text; ?></td>
              <td>
                  <input type="text" name="volume_unit" value="<?php echo $volume_unit; ?>" />            
              </td>
            </tr>  
             
          </table>
        </div>
        
       <!-- <div id="freight_parameters">
            <table class="form">
                                           
             <tr>
              <td> <span class="required">*</span> <?php echo $trailer_type_text; ?></td>
              <td>
               <select name="trailer_type_id">
                     <?php foreach ($treiler_total as $treiler) { ?>
                        <?php if( $treiler['trailer_type_id'] == $trailer_type_id ) { ?>
                            <option value="<?php echo $treiler['treiler_type_id'] ?>" selected > <?php echo $treiler['name']?> </option>   
                        <?php } else { ?>
                            <option value="<?php echo $treiler['treiler_type_id'] ?>"><?php echo $treiler['name']?></option>   
                        <?php } ?>  
                     <?php } ?>
                </select>                     
              </td>
              <td>
                <?php if ($lift == 1) {  ?>
                 <input type="checkbox" name="lift" value="1" checked><?php echo $lift_text; ?>
                <?php } else {  ?>
                 <input type="checkbox" name="lift" value="1"><?php echo $lift_text; ?>
                <?php } ?>            
              </td>
                <td>
                  <?php if ($manipulator == 1) {  ?>
                   <input type="checkbox" name="manipulator" value="1" checked><?php echo $manipulator_text; ?>
                  <?php } else {  ?>
                   <input type="checkbox" name="manipulator" value="1"><?php echo $manipulator_text; ?>
                  <?php } ?> 
              </td>
            </tr>
            
           <tr class="bottomline">
        
            <td colspan="2"></td>
              <td>
                  <?php if ($adr == 1) {  ?>
                    <input type="checkbox" name="adr" value="1" checked>ADR
                  <?php } else { ?>
                    <input type="checkbox" name="adr" value="1">ADR               
                  <?php } ?>
              </td>
              <td>
                  <?php if ($tir == 1) {  ?>
                  <input type="checkbox" name="tir" value="1" checked>TIR
                  <?php } else { ?>
                   <input type="checkbox" name="tir" value="1">TIR
                  <?php } ?>
              </td>
                          
              <td>
                  <?php if ($cmr == 1) {  ?>
                  <input type="checkbox" name="cmr" value="1" checked>CMR
                   <?php } else { ?>
                  <input type="checkbox" name="cmr" value="1">CMR
                  <?php } ?>
              </td>
              <td>
                  <?php if ($cemt == 1) {  ?>
                  <input type="checkbox" name="cemt" value="1" checked>CEMT
                  <?php } else { ?>
                  <input type="checkbox" name="cemt" value="1">CEMT
                  <?php } ?>
              </td>
          
            </tr>
           
                                             
            <tr>                
              <td>Freight params</td>              
              <td>          
                  <input type="radio" name="freight_params" value="0" class="ftl-ltl" <?php if( $freight_params == 0 ) { ?> checked="checked" <?php } ?>  >Fcl
                    <input type="radio" name="freight_params" value="1" class="ftl-ltl"  <?php if( $freight_params == 1 ) { ?> checked="checked" <?php } ?>  >Lcl&nbsp;&nbsp;               
              </td>
            </tr>
            <tr>              
              <td> <span class="required">*</span> <?php echo $weight_tons_text; ?></td>
              <td>
                  <input type="text" name="weight_tons" value="<?php echo $weight_tons; ?>" />
                    <?php if ($error_weight_tons) { ?>
                     <span class="error"><?php echo $error_weight_tons; ?></span>
                    <?php } ?>
              </td>
            </tr>
            <tr>              
              <td><?php echo $pallets_no_text; ?></td>
              <td>
                  <input type="text" name="pallets_no" value="<?php echo $pallets_no; ?>" /> 
              </td>
            </tr>
            
            <tr>
              <td><?php echo $exchangeable_text; ?></td>
              <td>
               <select name="exchangeable">                  
                            <option value="1" <?php if ($exchangeable == 1) echo 'selected' ?> > <?php echo $exchangeable_text; ?> </option>                           
                            <option value="0" <?php if ($exchangeable == 0) echo 'selected' ?> ><?php echo $non_exchangeable_text; ?></option>   
                </select>                     
              </td>
            </tr>
            
           <tr>
              <td><?php echo $stackable_text; ?></td>
              <td>
               <select name="stackable">
                            <option value="1" <?php if ($stackable == 1) echo 'selected' ?> > <?php echo $stackable_text; ?> </option>                           
                            <option value="0" <?php if ($stackable == 0) echo 'selected' ?>  ><?php echo $non_stackable_text; ?></option>   
                </select>                     
              </td>
            </tr>
            <tr>              
              <td> <?php echo $volume_unit_text; ?>t</td>
              <td>
                  <input type="text" name="volume_unit" value="<?php echo $volume_unit; ?>" />            
              </td>
            </tr>  
                                                                              
         </table>
        </div> -->
  
        <div id="tab-image">
          <table id="images" class="list">
            <thead>
              <tr>
                <td class="left"><?php echo $entry_image; ?></td>
                <td class="right"><?php echo $entry_sort_order; ?></td>
                <td></td>
              </tr>
            </thead>
            <?php $image_row = 0; ?>
            <?php foreach ($product_images as $product_image) { ?>
            <tbody id="image-row<?php echo $image_row; ?>">
              <tr>
                <td class="left"><div class="image"><img src="<?php echo $product_image['thumb']; ?>" alt="" id="thumb<?php echo $image_row; ?>" />
                    <input type="hidden" name="product_image[<?php echo $image_row; ?>][image]" value="<?php echo $product_image['image']; ?>" id="image<?php echo $image_row; ?>" />
                    <br />
                    <a onclick="image_upload('image<?php echo $image_row; ?>', 'thumb<?php echo $image_row; ?>');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#thumb<?php echo $image_row; ?>').attr('src', '<?php echo $no_image; ?>'); $('#image<?php echo $image_row; ?>').attr('value', '');"><?php echo $text_clear; ?></a></div></td>
                <td class="right"><input type="text" name="product_image[<?php echo $image_row; ?>][sort_order]" value="<?php echo $product_image['sort_order']; ?>" size="2" /></td>
                <td class="left"><a onclick="$('#image-row<?php echo $image_row; ?>').remove();" class="button"><?php echo $button_remove; ?></a></td>
              </tr>
            </tbody>
            <?php $image_row++; ?>
            <?php } ?>
            <tfoot>
              <tr>
                <td colspan="2"></td>
                <td class="left"><a onclick="addImage();" class="button"><?php echo $button_add_image; ?></a></td>
              </tr>
            </tfoot>
          </table>
        </div>   
      </form>
    </div>
  </div>
</div>

<script type="text/javascript" src="catalog/view/javascript/ckeditor/ckeditor.js"></script> 
<script type="text/javascript"><!--
<?php foreach ($languages as $language) { ?>
CKEDITOR.replace( 'description<?php echo $language['language_id']; ?>' );
<?php } ?>
//--></script> 


<script type="text/javascript">
    
<?php if ($frequency == 1) { ?>
    $("#loading_date").css("display", "none");   
    $("#offloading_date").css("display", "none");  
    $("#est_date").css("display", "none"); 
    $("#date_text").css("display", "none"); 
<?php } ?>
    
    
$("#freq_single").click(function() {   
    $("#loading_date").css("display", "");   
    $("#offloading_date").css("display", "");  
    $("#est_date").css("display", "");  
    $("#date_text").css("display", "");  
});
$("#freq_regular").click(function() {   
    $("#loading_date").css("display", "none");   
    $("#offloading_date").css("display", "none");  
    $("#est_date").css("display", "none"); 
    $("#date_text").css("display", "none"); 
});
</script> 
<script type="text/javascript"><!--
$.widget('custom.catcomplete', $.ui.autocomplete, {
	_renderMenu: function(ul, items) {
		var self = this, currentCategory = '';
		
		$.each(items, function(index, item) {
			if (item.category != currentCategory) {
				ul.append('<li class="ui-autocomplete-category">' + item.category + '</li>');
				
				currentCategory = item.category;
			}
			
			self._renderItem(ul, item);
		});
	}
});

// Manufacturer
$('input[name=\'manufacturer\']').autocomplete({
	delay: 500,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/manufacturer/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item.name,
						value: item.manufacturer_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		$('input[name=\'manufacturer\']').attr('value', ui.item.label);
		$('input[name=\'manufacturer_id\']').attr('value', ui.item.value);
	
		return false;
	},
	focus: function(event, ui) {
      return false;
   }
});

// Category
$('input[name=\'category\']').autocomplete({
	delay: 500,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/category/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item.name,
						value: item.category_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		$('#product-category' + ui.item.value).remove();
		
		$('#product-category').append('<div id="product-category' + ui.item.value + '">' + ui.item.label + '<img src="view/image/delete.png" alt="" /><input type="hidden" name="product_category[]" value="' + ui.item.value + '" /></div>');

		$('#product-category div:odd').attr('class', 'odd');
		$('#product-category div:even').attr('class', 'even');
				
		return false;
	},
	focus: function(event, ui) {
      return false;
   }
});

$('#product-category div img').live('click', function() {
	$(this).parent().remove();
	
	$('#product-category div:odd').attr('class', 'odd');
	$('#product-category div:even').attr('class', 'even');	
});

// Filter
$('input[name=\'filter\']').autocomplete({
	delay: 500,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/filter/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item.name,
						value: item.filter_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		$('#product-filter' + ui.item.value).remove();
		
		$('#product-filter').append('<div id="product-filter' + ui.item.value + '">' + ui.item.label + '<img src="image/delete.png" alt="" /><input type="hidden" name="product_filter[]" value="' + ui.item.value + '" /></div>');

		$('#product-filter div:odd').attr('class', 'odd');
		$('#product-filter div:even').attr('class', 'even');
				
		return false;
	},
	focus: function(event, ui) {
      return false;
   }
});

$('#product-filter div img').live('click', function() {
	$(this).parent().remove();
	
	$('#product-filter div:odd').attr('class', 'odd');
	$('#product-filter div:even').attr('class', 'even');	
});

// Downloads
$('input[name=\'download\']').autocomplete({
	delay: 500,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/download/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item.name,
						value: item.download_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		$('#product-download' + ui.item.value).remove();
		
		$('#product-download').append('<div id="product-download' + ui.item.value + '">' + ui.item.label + '<img src="image/delete.png" alt="" /><input type="hidden" name="product_download[]" value="' + ui.item.value + '" /></div>');

		$('#product-download div:odd').attr('class', 'odd');
		$('#product-download div:even').attr('class', 'even');
				
		return false;
	},
	focus: function(event, ui) {
      return false;
   }
});

$('#product-download div img').live('click', function() {
	$(this).parent().remove();
	
	$('#product-download div:odd').attr('class', 'odd');
	$('#product-download div:even').attr('class', 'even');	
});

// Related
$('input[name=\'related\']').autocomplete({
	delay: 500,
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
		$('#product-related' + ui.item.value).remove();
		
		$('#product-related').append('<div id="product-related' + ui.item.value + '">' + ui.item.label + '<img src="image/delete.png" alt="" /><input type="hidden" name="product_related[]" value="' + ui.item.value + '" /></div>');

		$('#product-related div:odd').attr('class', 'odd');
		$('#product-related div:even').attr('class', 'even');
				
		return false;
	},
	focus: function(event, ui) {
      return false;
   }
});

$('#product-related div img').live('click', function() {
	$(this).parent().remove();
	
	$('#product-related div:odd').attr('class', 'odd');
	$('#product-related div:even').attr('class', 'even');	
});
//--></script> 
<script type="text/javascript"><!--
var attribute_row = <?php echo $attribute_row; ?>;

function addAttribute() {
	html  = '<tbody id="attribute-row' + attribute_row + '">';
    html += '  <tr>';
	html += '    <td class="left"><input type="text" name="product_attribute[' + attribute_row + '][name]" value="" /><input type="hidden" name="product_attribute[' + attribute_row + '][attribute_id]" value="" /></td>';
	html += '    <td class="left">';
	<?php foreach ($languages as $language) { ?>
	html += '<textarea name="product_attribute[' + attribute_row + '][product_attribute_description][<?php echo $language['language_id']; ?>][text]" cols="40" rows="5"></textarea><img src="image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" align="top" /><br />';
    <?php } ?>
	html += '    </td>';
	html += '    <td class="left"><a onclick="$(\'#attribute-row' + attribute_row + '\').remove();" class="button"><?php echo $button_remove; ?></a></td>';
    html += '  </tr>';	
    html += '</tbody>';
	
	$('#attribute tfoot').before(html);
	
	attributeautocomplete(attribute_row);
	
	attribute_row++;
}

function attributeautocomplete(attribute_row) {
	$('input[name=\'product_attribute[' + attribute_row + '][name]\']').catcomplete({
		delay: 500,
		source: function(request, response) {
			$.ajax({
				url: 'index.php?route=catalog/attribute/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
				dataType: 'json',
				success: function(json) {	
					response($.map(json, function(item) {
						return {
							category: item.attribute_group,
							label: item.name,
							value: item.attribute_id
						}
					}));
				}
			});
		}, 
		select: function(event, ui) {
			$('input[name=\'product_attribute[' + attribute_row + '][name]\']').attr('value', ui.item.label);
			$('input[name=\'product_attribute[' + attribute_row + '][attribute_id]\']').attr('value', ui.item.value);
			
			return false;
		},
		focus: function(event, ui) {
      		return false;
   		}
	});
}

$('#attribute tbody').each(function(index, element) {
	attributeautocomplete(index);
});
//--></script> 
<script type="text/javascript"><!--	
var option_row = <?php echo $option_row; ?>;

$('input[name=\'option\']').catcomplete({
	delay: 500,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/option/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						category: item.category,
						label: item.name,
						value: item.option_id,
						type: item.type,
						option_value: item.option_value
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		html  = '<div id="tab-option-' + option_row + '" class="vtabs-content">';
		html += '	<input type="hidden" name="product_option[' + option_row + '][product_option_id]" value="" />';
		html += '	<input type="hidden" name="product_option[' + option_row + '][name]" value="' + ui.item.label + '" />';
		html += '	<input type="hidden" name="product_option[' + option_row + '][option_id]" value="' + ui.item.value + '" />';
		html += '	<input type="hidden" name="product_option[' + option_row + '][type]" value="' + ui.item.type + '" />';
		html += '	<table class="form">';
		html += '	  <tr>';
		html += '		<td><?php echo $entry_required; ?></td>';
		html += '       <td><select name="product_option[' + option_row + '][required]">';
		html += '	      <option value="1"><?php echo $text_yes; ?></option>';
		html += '	      <option value="0"><?php echo $text_no; ?></option>';
		html += '	    </select></td>';
		html += '     </tr>';
		
		if (ui.item.type == 'text') {
			html += '     <tr>';
			html += '       <td><?php echo $entry_option_value; ?></td>';
			html += '       <td><input type="text" name="product_option[' + option_row + '][option_value]" value="" /></td>';
			html += '     </tr>';
		}
		
		if (ui.item.type == 'textarea') {
			html += '     <tr>';
			html += '       <td><?php echo $entry_option_value; ?></td>';
			html += '       <td><textarea name="product_option[' + option_row + '][option_value]" cols="40" rows="5"></textarea></td>';
			html += '     </tr>';						
		}
		 
		if (ui.item.type == 'file') {
			html += '     <tr style="display: none;">';
			html += '       <td><?php echo $entry_option_value; ?></td>';
			html += '       <td><input type="text" name="product_option[' + option_row + '][option_value]" value="" /></td>';
			html += '     </tr>';			
		}
						
		if (ui.item.type == 'date') {
			html += '     <tr>';
			html += '       <td><?php echo $entry_option_value; ?></td>';
			html += '       <td><input type="text" name="product_option[' + option_row + '][option_value]" value="" class="date" /></td>';
			html += '     </tr>';			
		}
		
		if (ui.item.type == 'datetime') {
			html += '     <tr>';
			html += '       <td><?php echo $entry_option_value; ?></td>';
			html += '       <td><input type="text" name="product_option[' + option_row + '][option_value]" value="" class="datetime" /></td>';
			html += '     </tr>';			
		}
		
		if (ui.item.type == 'time') {
			html += '     <tr>';
			html += '       <td><?php echo $entry_option_value; ?></td>';
			html += '       <td><input type="text" name="product_option[' + option_row + '][option_value]" value="" class="time" /></td>';
			html += '     </tr>';			
		}
		
		html += '  </table>';
			
		if (ui.item.type == 'select' || ui.item.type == 'radio' || ui.item.type == 'checkbox' || ui.item.type == 'image') {
			html += '  <table id="option-value' + option_row + '" class="list">';
			html += '  	 <thead>'; 
			html += '      <tr>';
			html += '        <td class="left"><?php echo $entry_option_value; ?></td>';
			html += '        <td class="right"><?php echo $entry_quantity; ?></td>';
			html += '        <td class="left"><?php echo $entry_subtract; ?></td>';
			html += '        <td class="right"><?php echo $entry_price; ?></td>';
			html += '        <td class="right"><?php echo $entry_option_points; ?></td>';
			html += '        <td class="right"><?php echo $entry_weight; ?></td>';
			html += '        <td></td>';
			html += '      </tr>';
			html += '  	 </thead>';
			html += '    <tfoot>';
			html += '      <tr>';
			html += '        <td colspan="6"></td>';
			html += '        <td class="left"><a onclick="addOptionValue(' + option_row + ');" class="button"><?php echo $button_add_option_value; ?></a></td>';
			html += '      </tr>';
			html += '    </tfoot>';
			html += '  </table>';
            html += '  <select id="option-values' + option_row + '" style="display: none;">';
			
            for (i = 0; i < ui.item.option_value.length; i++) {
				html += '  <option value="' + ui.item.option_value[i]['option_value_id'] + '">' + ui.item.option_value[i]['name'] + '</option>';
            }

            html += '  </select>';			
			html += '</div>';	
		}
		
		$('#tab-option').append(html);
		
		
                $('#option-add').before('<a href="#tab-option-' + option_row + '" id="option-' + option_row + '">' + ui.item.label + '&nbsp;<img src="view/image/delete.png" alt="" onclick="$(\'#option-' + option_row + '\').remove(); $(\'#tab-option-' + option_row + '\').remove(); $(\'#vtab-option a:first\').trigger(\'click\'); return false;" /></a>');
		
		$('#vtab-option a').tabs();
		
		$('#option-' + option_row).trigger('click');		
		
		$('.date').datepicker({dateFormat: 'yy-mm-dd'});
		$('.datetime').datetimepicker({
			dateFormat: 'yy-mm-dd',
			timeFormat: 'h:m'
		});	
			
		$('.time').timepicker({timeFormat: 'h:m'});	
				
		option_row++;
		
		return false;
	},
	focus: function(event, ui) {
      return false;
   }
});
//--></script> 
<script type="text/javascript"><!--		
var option_value_row = <?php echo $option_value_row; ?>;

function addOptionValue(option_row) {	
	html  = '<tbody id="option-value-row' + option_value_row + '">';
	html += '  <tr>';
	html += '    <td class="left"><select name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][option_value_id]">';
	html += $('#option-values' + option_row).html();
	html += '    </select><input type="hidden" name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][product_option_value_id]" value="" /></td>';
	html += '    <td class="right"><input type="text" name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][quantity]" value="" size="3" /></td>'; 
	html += '    <td class="left"><select name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][subtract]">';
	html += '      <option value="1"><?php echo $text_yes; ?></option>';
	html += '      <option value="0"><?php echo $text_no; ?></option>';
	html += '    </select></td>';
	html += '    <td class="right"><select name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][price_prefix]">';
	html += '      <option value="+">+</option>';
	html += '      <option value="-">-</option>';
	html += '    </select>';
	html += '    <input type="text" name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][price]" value="" size="5" /></td>';
	html += '    <td class="right"><select name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][points_prefix]">';
	html += '      <option value="+">+</option>';
	html += '      <option value="-">-</option>';
	html += '    </select>';
	html += '    <input type="text" name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][points]" value="" size="5" /></td>';	
	html += '    <td class="right"><select name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][weight_prefix]">';
	html += '      <option value="+">+</option>';
	html += '      <option value="-">-</option>';
	html += '    </select>';
	html += '    <input type="text" name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][weight]" value="" size="5" /></td>';
	html += '    <td class="left"><a onclick="$(\'#option-value-row' + option_value_row + '\').remove();" class="button"><?php echo $button_remove; ?></a></td>';
	html += '  </tr>';
	html += '</tbody>';
	
	$('#option-value' + option_row + ' tfoot').before(html);

	option_value_row++;
}
//--></script> 
<script type="text/javascript"><!--
var discount_row = <?php echo $discount_row; ?>;

function addDiscount() {
	html  = '<tbody id="discount-row' + discount_row + '">';
	html += '  <tr>'; 
    html += '    <td class="left"><select name="product_discount[' + discount_row + '][customer_group_id]">';
    <?php foreach ($customer_groups as $customer_group) { ?>
    html += '      <option value="<?php echo $customer_group['customer_group_id']; ?>"><?php echo $customer_group['name']; ?></option>';
    <?php } ?>
    html += '    </select></td>';		
    html += '    <td class="right"><input type="text" name="product_discount[' + discount_row + '][quantity]" value="" size="2" /></td>';
    html += '    <td class="right"><input type="text" name="product_discount[' + discount_row + '][priority]" value="" size="2" /></td>';
	html += '    <td class="right"><input type="text" name="product_discount[' + discount_row + '][price]" value="" /></td>';
    html += '    <td class="left"><input type="text" name="product_discount[' + discount_row + '][date_start]" value="" class="date" /></td>';
	html += '    <td class="left"><input type="text" name="product_discount[' + discount_row + '][date_end]" value="" class="date" /></td>';
	html += '    <td class="left"><a onclick="$(\'#discount-row' + discount_row + '\').remove();" class="button"><?php echo $button_remove; ?></a></td>';
	html += '  </tr>';	
    html += '</tbody>';
	
	$('#discount tfoot').before(html);
		
	$('#discount-row' + discount_row + ' .date').datepicker({dateFormat: 'yy-mm-dd'});
	
	discount_row++;
}
//--></script> 
<script type="text/javascript"><!--
var special_row = <?php echo $special_row; ?>;

function addSpecial() {
	html  = '<tbody id="special-row' + special_row + '">';
	html += '  <tr>'; 
    html += '    <td class="left"><select name="product_special[' + special_row + '][customer_group_id]">';
    <?php foreach ($customer_groups as $customer_group) { ?>
    html += '      <option value="<?php echo $customer_group['customer_group_id']; ?>"><?php echo $customer_group['name']; ?></option>';
    <?php } ?>
    html += '    </select></td>';		
    html += '    <td class="right"><input type="text" name="product_special[' + special_row + '][priority]" value="" size="2" /></td>';
	html += '    <td class="right"><input type="text" name="product_special[' + special_row + '][price]" value="" /></td>';
    html += '    <td class="left"><input type="text" name="product_special[' + special_row + '][date_start]" value="" class="date" /></td>';
	html += '    <td class="left"><input type="text" name="product_special[' + special_row + '][date_end]" value="" class="date" /></td>';
	html += '    <td class="left"><a onclick="$(\'#special-row' + special_row + '\').remove();" class="button"><?php echo $button_remove; ?></a></td>';
	html += '  </tr>';
    html += '</tbody>';
	
	$('#special tfoot').before(html);
 
	$('#special-row' + special_row + ' .date').datepicker({dateFormat: 'yy-mm-dd'});
	
	special_row++;
}
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
<script type="text/javascript"><!--
var image_row = <?php echo $image_row; ?>;

function addImage() {
    html  = '<tbody id="image-row' + image_row + '">';
	html += '  <tr>';
	html += '    <td class="left"><div class="image"><img src="<?php echo $no_image; ?>" alt="" id="thumb' + image_row + '" /><input type="hidden" name="product_image[' + image_row + '][image]" value="" id="image' + image_row + '" /><br /><a onclick="image_upload(\'image' + image_row + '\', \'thumb' + image_row + '\');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$(\'#thumb' + image_row + '\').attr(\'src\', \'<?php echo $no_image; ?>\'); $(\'#image' + image_row + '\').attr(\'value\', \'\');"><?php echo $text_clear; ?></a></div></td>';
	html += '    <td class="right"><input type="text" name="product_image[' + image_row + '][sort_order]" value="" size="2" /></td>';
	html += '    <td class="left"><a onclick="$(\'#image-row' + image_row  + '\').remove();" class="button"><?php echo $button_remove; ?></a></td>';
	html += '  </tr>';
	html += '</tbody>';
	
	$('#images tfoot').before(html);
	
	image_row++;
}
//--></script> 
<script type="text/javascript" src="catalog/view/javascript/jquery/ui/jquery-ui-timepicker-addon.js"></script> 
<script type="text/javascript" src="catalog/view/javascript/jquery/ui/tabs.js"></script> 

<script type="text/javascript"><!--
$('select[name=\'loading_country_id\']').bind('change', function() {
	if(this.value == '')return;
        $.ajax({
		url: 'index.php?route=account/register/country&country_id=' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('select[name=\'loading_country_id\']').after('<span class="wait">&nbsp;<img src="catalog/view/theme/default/image/loading.gif" alt="" /></span>');
		},
		complete: function() {
			$('.wait').remove();
		},			
		success: function(json) {
			/*if (json['postcode_required'] == '1') {
				$('#postcode-required').show();
			} else {
				$('#postcode-required').hide();
			}*/
			
			html = '<option value=""><?php echo $text_select; ?></option>';
			
			if (json['zone'] != '') {
				for (i = 0; i < json['zone'].length; i++) {
        			html += '<option value="' + json['zone'][i]['zone_id'] + '"';
	    			
					if (json['zone'][i]['zone_id'] == '<?php echo $loading_zone_id; ?>') {
	      				html += ' selected="selected"';
                                        }
	
	    			html += '>' + json['zone'][i]['name'] + '</option>';
				}
			} else {
				html += '<option value="0" selected="selected"><?php echo $text_none; ?></option>';
			}
			
			$('select[name=\'loading_zone_id\']').html(html);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('select[name=\'loading_country_id\']').trigger('change');
//--></script> 

<script type="text/javascript"><!--
$('select[name=\'offloading_country_id\']').bind('change', function() {
	if(this.value == '')return;
        $.ajax({
		url: 'index.php?route=account/register/country&country_id=' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('select[name=\'offloading_country_id\']').after('<span class="wait">&nbsp;<img src="catalog/view/theme/default/image/loading.gif" alt="" /></span>');
		},
		complete: function() {
			$('.wait').remove();
		},			
		success: function(json) {
			/*if (json['postcode_required'] == '1') {
				$('#postcode-required').show();
			} else {
				$('#postcode-required').hide();
			}*/
			
			html = '<option value=""><?php echo $text_select; ?></option>';
			
			if (json['zone'] != '') {
				for (i = 0; i < json['zone'].length; i++) {
        			html += '<option value="' + json['zone'][i]['zone_id'] + '"';
	    			
					if (json['zone'][i]['zone_id'] == '<?php echo $offloading_zone_id; ?>') {
	      				html += ' selected="selected"';
	    			}
	
	    			html += '>' + json['zone'][i]['name'] + '</option>';
				}
			} else {
				html += '<option value="0" selected="selected"><?php echo $text_none; ?></option>';
			}
			
			$('select[name=\'offloading_zone_id\']').html(html);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('select[name=\'offloading_country_id\']').trigger('change');
//--></script> 

<script type="text/javascript"><!--
$('.date').datepicker({dateFormat: 'yy-mm-dd'});
$('.datetime').datetimepicker({
	dateFormat: 'yy-mm-dd',
	timeFormat: 'h:m'
});
$('.time').timepicker({timeFormat: 'h:m'});
//--></script> 

<script type="text/javascript"><!--
$('#tabs a').tabs(); 
$('#languages a').tabs(); 
$('#vtab-option a').tabs();
//--></script> 
<?php echo $footer; ?>