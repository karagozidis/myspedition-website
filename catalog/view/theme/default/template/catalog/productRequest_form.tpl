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
  <?php if ($success) { ?>
  <div class="success"><?php echo $success; ?></div>
  <?php } ?>
  
  <div class="box">
    <div class="heading">
      <h1><img src="image/productRequest.png" width="25" alt="" /> ProductRequest</h1>
      <div class="buttons">
          <a class="button submitProductRequest">Save</a>
          <a href="<?php echo $cancel; ?>" class="button">Cancel</a>
      </div>
    </div>
      
 <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">        

    <script>
        function myFunction(value)
                {
                //alert(value);
                $('#type').val(value);
                }
    </script>
      
    
    <h3><?php echo $entry_description; ?></h3>
    <div class="content">
        
        <input type="hidden" name="productRequest_store[]" value="0"> 
        <input type="hidden" name="customer_id" value="<?php echo $this->customer->getId() ?>">
        
        <div style="width:10px;" class="PopupContainer">
                   <div style="width: 10px;" id="popUp1">
                       <img src="image/info.png" width="25" id="_popUp1_" >
                   </div>
        </div>
            
          
          <div id="languages" class="htabs">
            <?php foreach ($languages as $language) { ?>
            <a href="#language<?php echo $language['language_id']; ?>"><img src="image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></a>
            <?php } ?>
          </div>
          <?php $count = 0 ; ?>
          <?php foreach ($languages as $language) { ?>
          
          <div id="language<?php echo $language['language_id']; ?>">
            <table class="form">
              <tr>
                <td>
                    <span class="required">*</span> <?php echo $entry_name; ?>
                </td>
                <td> 
                  <input type="text" id="description_title<?php echo $language['language_id']; ?>" name="productRequest_description[<?php echo $language['language_id']; ?>][name]" size="100" value="<?php echo isset($productRequest_description[$language['language_id']]) ? $productRequest_description[$language['language_id']]['name'] : ''; ?>" />
                  <?php if (isset($error_name[$language['language_id']])) { ?>
                  <span class="error"><?php echo $error_name[$language['language_id']]; ?></span>
                  <?php } ?>
                </td>
                    <?php if ($count == 0 ) { ?>
                       <td>

                       </td>
                    <?php } ?>
              </tr>
              <tr>
                <td><?php echo $entry_description; ?></td>
                <td>
                    <textarea rows="20" cols="73" name="productRequest_description[<?php echo $language['language_id']; ?>][description]" id="description<?php echo $language['language_id']; ?>">
                            <?php echo isset($productRequest_description[$language['language_id']]) ? $productRequest_description[$language['language_id']]['description'] : ''; ?>
                    </textarea>
                </td> 
              </tr>
            </table>
          </div>
          <?php $count++ ; ?>
          <?php } ?>  
     </div>
    
    <h3>Category-Area:</h3>
    <div class="content">
        <table>
            <tr>
                 <td>
                    Category:
                </td>
                <td colspan="2">
                    
                    
                     <table>
                <tr>
                    <td>
                        <input type="text" id="categoryName"  value="<?php echo $strPathVisible; ?>" style="width: 450px; color: green;" readonly/>
                    </td>
                </tr>
                <tr>
                  <td style="border: 1px solid #EEEEEE;background: #E6E6E6;cursor: pointer; width:600px;">
                      <input type="hidden" name="product_category" value="<?php echo $sCategory['category_id']; ?>"  />
                  </td>
               </tr>   
             </table>
                <script src="catalog/view/javascript/jquery/jquery.optionTree.js" type="text/javascript"></script> 
                <script type="text/javascript">
                 var option_tree = {
                     <?php echo $treeStr; ?>
                    };

                    var options = {
                            show_multiple: 10, // if true - will set the size to show all options
                            choose: '',
                            preselect: {'product_category': <?php echo $strPath; ?>},
                            preselect_only_once: true,
                        };
        
                   var displayParents = function() {
                        var labels = []; // initialize array
                        $(this).siblings('select') // find all select
                                       .find(':selected') // and their current options
                                         .each(function() { labels.push($(this).text()); }); // and add option text to array
                       // alert(labels.join(' - '));  // and display the labels
                        $('#categoryName').val(labels.join(' / '));
                        }

                     $('input[name=product_category]').optionTree(option_tree,options).change(displayParents);
                </script> 
                </td>
            </tr>
            
            <tr>
                <td>
                Country
                </td>
                <td>
                    <select name="country_id">  
                      <?php foreach($countries as $country) { ?>
                            <?php if( $country['country_id'] == $country_id ) { ?> 
                            <option value="<?php echo $country['country_id']; ?>" selected><?php echo $country['name']; ?></option>
                            <?php } else { ?>
                             <option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
                            <?php } ?>
                      <?php } ?>    
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                Area
                </td>
                <td>
                    <select name="zone_id">
                    </select>
                </td>
            </tr>
            <tr>
              <td><?php echo $entry_location; ?></td>
              <td><input type="text" name="location" value="<?php echo $location; ?>" /></td>
            </tr>
         </table>
    </div>
   
    <h3><?php echo $entry_image; ?></h3>  
    <div class="content">
       <table>                 
           <tr>
              <td><?php echo $entry_image; ?>&nbsp;&nbsp;&nbsp;</td>
              <td><div class="image"><img src="<?php echo $thumb; ?>" alt="" id="thumb" /><br />
                  <input type="hidden" name="image" value="<?php echo $image; ?>" id="image" />
                  <a onclick="image_upload('image', 'thumb');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#thumb').attr('src', '<?php echo $no_image; ?>'); $('#image').attr('value', '');"><?php echo $text_clear; ?></a></div></td>
            </tr> 
        </table>
       <br>
        <table id="images" class="list">
            <thead>
              <tr>
                <td ><?php echo $entry_image; ?></td>
                <td ><?php echo $entry_sort_order; ?></td>
                <td></td>
              </tr>
            </thead>
            <?php $image_row = 0; ?>
            <?php foreach ($productRequest_images as $productRequest_image) { ?>
            <tbody id="image-row<?php echo $image_row; ?>">
              <tr>
                <td ><div class="image"><img src="<?php echo $productRequest_image['thumb']; ?>" alt="" id="thumb<?php echo $image_row; ?>" />
                    <input type="hidden" name="productRequest_image[<?php echo $image_row; ?>][image]" value="<?php echo $productRequest_image['image']; ?>" id="image<?php echo $image_row; ?>" />
                    <br />
                    <a onclick="image_upload('image<?php echo $image_row; ?>', 'thumb<?php echo $image_row; ?>');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#thumb<?php echo $image_row; ?>').attr('src', '<?php echo $no_image; ?>'); $('#image<?php echo $image_row; ?>').attr('value', '');"><?php echo $text_clear; ?></a></div></td>
                <td ><input type="text" name="productRequest_image[<?php echo $image_row; ?>][sort_order]" value="<?php echo $productRequest_image['sort_order']; ?>" size="2" /></td>
                <td ><a onclick="$('#image-row<?php echo $image_row; ?>').remove();" class="button"><?php echo $button_remove; ?></a></td>
              </tr>
            </tbody>
            <?php $image_row++; ?>
            <?php } ?>
            <tfoot>
              <tr>
                <td colspan="2"></td>
                <td ><a onclick="addImage();" class="button"><?php echo $button_add_image; ?></a></td>
              </tr>
            </tfoot>
        </table>   
    </div>
      
    
       <h3><?php echo $entry_model; ?></h3>                        
    <div class="content">
       <table class="form">
            <tr>
              <td><?php echo $entry_price; ?></td>
              <td><input type="text" name="price" value="<?php echo $price; ?>" /></td>
            </tr>
            <tr>
              <td> <?php echo $entry_model; ?></td>
              <td><input type="text" name="model" value="<?php echo $model; ?>" />
                <?php if ($error_model) { ?>
                <span class="error"><?php echo $error_model; ?></span>
                <?php } ?></td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="show_hide"  style="cursor: pointer; width:100px;" >
                        <img src="image/more.png" width="90">
                    </div>
                </td>
            </tr>
       </table> 
       <div class="slidingDiv" style="display: none;" > 
            <table>
                 <tr>
                   <td><?php echo $entry_upc; ?></td>
                   <td><input type="text" name="upc" value="<?php echo $upc; ?>" /></td>
                 </tr>
                 <tr>
                   <td><?php echo $entry_isbn; ?></td>
                   <td><input type="text" name="isbn" value="<?php echo $isbn; ?>" /></td>
                 </tr>

                 <tr>
                   <td><?php echo $entry_tax_class; ?></td>
                   <td><select name="tax_class_id">
                       <option value="0"><?php echo $text_none; ?></option>
                       <?php foreach ($tax_classes as $tax_class) { ?>
                       <?php if ($tax_class['tax_class_id'] == $tax_class_id) { ?>
                       <option value="<?php echo $tax_class['tax_class_id']; ?>" selected="selected"><?php echo $tax_class['title']; ?></option>
                       <?php } else { ?>
                       <option value="<?php echo $tax_class['tax_class_id']; ?>"><?php echo $tax_class['title']; ?></option>
                       <?php } ?>
                       <?php } ?>
                     </select></td>
                 </tr>
                 <tr>
                   <td><?php echo $entry_quantity; ?></td>
                   <td><input type="text" name="quantity" value="<?php echo $quantity; ?>" size="2" /></td>
                 </tr>
                 <tr>
                   <td><?php echo $entry_minimum; ?></td>
                   <td><input type="text" name="minimum" value="<?php echo $minimum; ?>" size="2" /></td>
                 </tr>
                 <!--<tr>
                   <td><?php echo $entry_subtract; ?></td>
                   <td><select name="subtract">
                       <?php if ($subtract) { ?>
                       <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                       <option value="0"><?php echo $text_no; ?></option>
                       <?php } else { ?>
                       <option value="1"><?php echo $text_yes; ?></option>
                       <option value="0" selected="selected"><?php echo $text_no; ?></option>
                       <?php } ?>
                     </select></td>
                 </tr>-->
                <!-- <tr>
                   <td><?php echo $entry_stock_status; ?></td>
                   <td><select name="stock_status_id">
                       <?php foreach ($stock_statuses as $stock_status) { ?>
                       <?php if ($stock_status['stock_status_id'] == $stock_status_id) { ?>
                       <option value="<?php echo $stock_status['stock_status_id']; ?>" selected="selected"><?php echo $stock_status['name']; ?></option>
                       <?php } else { ?>
                       <option value="<?php echo $stock_status['stock_status_id']; ?>"><?php echo $stock_status['name']; ?></option>
                       <?php } ?>
                       <?php } ?>
                     </select></td>
                 </tr>-->
                 <tr>
                   <td><?php echo $entry_shipping; ?></td>
                   <td><?php if ($shipping) { ?>
                     <input type="radio" name="shipping" value="1" checked="checked" />
                     <?php echo $text_yes; ?>
                     <input type="radio" name="shipping" value="0" />
                     <?php echo $text_no; ?>
                     <?php } else { ?>
                     <input type="radio" name="shipping" value="1" />
                     <?php echo $text_yes; ?>
                     <input type="radio" name="shipping" value="0" checked="checked" />
                     <?php echo $text_no; ?>
                     <?php } ?></td>
                 </tr>
                 <input type="hidden" name="keyword" value="" />
                 <input type="hidden" name="date_available" value="<?php echo $date_available; ?>" size="12" class="date" />
                 <!--<tr>
                   <td><?php echo $entry_date_available; ?></td>
                   <td><input type="text" name="date_available" value="<?php echo $date_available; ?>" size="12" class="date" /></td>
                 </tr>-->
                 <tr>
                   <td><?php echo $entry_dimension; ?></td>
                   <td><input type="text" name="length" value="<?php echo $length; ?>" size="4" />
                     <input type="text" name="width" value="<?php echo $width; ?>" size="4" />
                     <input type="text" name="height" value="<?php echo $height; ?>" size="4" /></td>
                 </tr>
                 <tr>
                   <td><?php echo $entry_length; ?></td>
                   <td><select name="length_class_id">
                       <?php foreach ($length_classes as $length_class) { ?>
                       <?php if ($length_class['length_class_id'] == $length_class_id) { ?>
                       <option value="<?php echo $length_class['length_class_id']; ?>" selected="selected"><?php echo $length_class['title']; ?></option>
                       <?php } else { ?>
                       <option value="<?php echo $length_class['length_class_id']; ?>"><?php echo $length_class['title']; ?></option>
                       <?php } ?>
                       <?php } ?>
                     </select></td>
                 </tr>
                 <tr>
                   <td><?php echo $entry_weight; ?></td>
                   <td><input type="text" name="weight" value="<?php echo $weight; ?>" /></td>
                 </tr>
                 <tr>
                   <td><?php echo $entry_weight_class; ?></td>
                   <td><select name="weight_class_id">
                       <?php foreach ($weight_classes as $weight_class) { ?>
                       <?php if ($weight_class['weight_class_id'] == $weight_class_id) { ?>
                       <option value="<?php echo $weight_class['weight_class_id']; ?>" selected="selected"><?php echo $weight_class['title']; ?></option>
                       <?php } else { ?>
                       <option value="<?php echo $weight_class['weight_class_id']; ?>"><?php echo $weight_class['title']; ?></option>
                       <?php } ?>
                       <?php } ?>
                     </select></td>
                 </tr>
                <input type="hidden" name="sort_order" value="" />
             </table>
        </div>  
    </div>
    
    
     <div class="buttons content">
          <a class="button submitProductRequest">Save</a>
          <a href="<?php echo $cancel; ?>" class="button">Cancel</a>
     </div>                       
   
                         
  </div>
</div>

</form>

<script type="text/javascript">
$(document).ready(function(){
 
       <?php if( isset($search) ) 
       echo" $('.slidingDiv').show(); ";
             ?>
 
    $('.show_hide').click(function(){
        $(".slidingDiv").slideToggle();
    });
 
});
</script>

<script type="text/javascript" src="catalog/view/javascript/ckeditor/ckeditor.js"></script> 
<script type="text/javascript"><!--
<?php foreach ($languages as $language) { ?>
CKEDITOR.replace( 'description<?php echo $language['language_id']; ?>' );
<?php } ?>
//--></script> 

<script src="catalog/view/javascript/jquery.BubblePopup-1.1.min.js" type="text/javascript"></script> 
<script type="text/javascript">
<!--
$(document).ready(function() {	
$('#popUp1').SetBubblePopup({
			     innerHtml: '<h1>ProductRequest descriptions </h1><p>You are obliged to fill the default (English) language. <br />All the other languages, if they remain empty <br /> they will display the default (English) language.</p>'
			    });
});
//-->
</script>
 <script type="text/javascript">    
               var description_title_ids = [];
               var description_ids = [];
               var count_ids =0 ;
               
                <?php foreach ($languages as $language) { ?>
                    description_title_ids[count_ids] = "#description_title<?php echo $language['language_id']; ?>";
                    description_ids[count_ids] = "#description<?php echo $language['language_id']; ?>";
                    count_ids++;
                <?php } ?>
            
            
              
            $('.submitProductRequest').click(function()
                {     
                fillValues(); 
                $('#form').submit();
                });
            
            $('#copy-descriptions').click(function()
                {                
                fillValues();          
                });
                  
             function fillValues(){
                 
                 var desc = $(description_title_ids[0]).val();
                 for(i=0; i<count_ids; i++)
                      { 
                      if( $(description_title_ids[i]).val() == "" )
                          {
                           $(description_title_ids[i]).val(desc);
                          }
                      } 
                      
                 var tmpData = "";
                <?php $lCount = 0; ?>
                <?php foreach ($languages as $language) { ?>
                
                    <?php if($lCount == 0) { ?>
                        var data = CKEDITOR.instances.description<?php echo $language['language_id']; ?>.getData();
                        <?php $lCount++; ?>
                    <?php } else { ?>
                        tmpData = CKEDITOR.instances.description<?php echo $language['language_id']; ?>.getData();
                        
                        if( tmpData == "" )
                            {
                            CKEDITOR.instances.description<?php echo $language['language_id']; ?>.setData(data);
                            }
                            
                    <?php } ?>

                <?php } ?>
            
             }
                  
                  
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
		$('#productRequest-category' + ui.item.value).remove();
		
		$('#productRequest-category').append('<div id="productRequest-category' + ui.item.value + '">' + ui.item.label + '<img src="view/image/delete.png" alt="" /><input type="hidden" name="productRequest_category[]" value="' + ui.item.value + '" /></div>');

		$('#productRequest-category div:odd').attr('class', 'odd');
		$('#productRequest-category div:even').attr('class', 'even');
				
		return false;
	},
	focus: function(event, ui) {
      return false;
   }
});

$('#productRequest-category div img').live('click', function() {
	$(this).parent().remove();
	
	$('#productRequest-category div:odd').attr('class', 'odd');
	$('#productRequest-category div:even').attr('class', 'even');	
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
		$('#productRequest-filter' + ui.item.value).remove();
		
		$('#productRequest-filter').append('<div id="productRequest-filter' + ui.item.value + '">' + ui.item.label + '<img src="image/delete.png" alt="" /><input type="hidden" name="productRequest_filter[]" value="' + ui.item.value + '" /></div>');

		$('#productRequest-filter div:odd').attr('class', 'odd');
		$('#productRequest-filter div:even').attr('class', 'even');
				
		return false;
	},
	focus: function(event, ui) {
      return false;
   }
});

$('#productRequest-filter div img').live('click', function() {
	$(this).parent().remove();
	
	$('#productRequest-filter div:odd').attr('class', 'odd');
	$('#productRequest-filter div:even').attr('class', 'even');	
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
		$('#productRequest-download' + ui.item.value).remove();
		
		$('#productRequest-download').append('<div id="productRequest-download' + ui.item.value + '">' + ui.item.label + '<img src="image/delete.png" alt="" /><input type="hidden" name="productRequest_download[]" value="' + ui.item.value + '" /></div>');

		$('#productRequest-download div:odd').attr('class', 'odd');
		$('#productRequest-download div:even').attr('class', 'even');
				
		return false;
	},
	focus: function(event, ui) {
      return false;
   }
});

$('#productRequest-download div img').live('click', function() {
	$(this).parent().remove();
	
	$('#productRequest-download div:odd').attr('class', 'odd');
	$('#productRequest-download div:even').attr('class', 'even');	
});

// Related
$('input[name=\'related\']').autocomplete({
	delay: 500,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/productRequest/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item.name,
						value: item.productRequest_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		$('#productRequest-related' + ui.item.value).remove();
		
		$('#productRequest-related').append('<div id="productRequest-related' + ui.item.value + '">' + ui.item.label + '<img src="image/delete.png" alt="" /><input type="hidden" name="productRequest_related[]" value="' + ui.item.value + '" /></div>');

		$('#productRequest-related div:odd').attr('class', 'odd');
		$('#productRequest-related div:even').attr('class', 'even');
				
		return false;
	},
	focus: function(event, ui) {
      return false;
   }
});

$('#productRequest-related div img').live('click', function() {
	$(this).parent().remove();
	
	$('#productRequest-related div:odd').attr('class', 'odd');
	$('#productRequest-related div:even').attr('class', 'even');	
});
//--></script> 
<script type="text/javascript"><!--
var attribute_row = <?php echo $attribute_row; ?>;

function addAttribute() {
	html  = '<tbody id="attribute-row' + attribute_row + '">';
    html += '  <tr>';
	html += '    <td ><input type="text" name="productRequest_attribute[' + attribute_row + '][name]" value="" /><input type="hidden" name="productRequest_attribute[' + attribute_row + '][attribute_id]" value="" /></td>';
	html += '    <td >';
	<?php foreach ($languages as $language) { ?>
	html += '<textarea name="productRequest_attribute[' + attribute_row + '][productRequest_attribute_description][<?php echo $language['language_id']; ?>][text]" cols="40" rows="5"></textarea><img src="image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" align="top" /><br />';
    <?php } ?>
	html += '    </td>';
	html += '    <td ><a onclick="$(\'#attribute-row' + attribute_row + '\').remove();" class="button"><?php echo $button_remove; ?></a></td>';
    html += '  </tr>';	
    html += '</tbody>';
	
	$('#attribute tfoot').before(html);
	
	attributeautocomplete(attribute_row);
	
	attribute_row++;
}

function attributeautocomplete(attribute_row) {
	$('input[name=\'productRequest_attribute[' + attribute_row + '][name]\']').catcomplete({
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
			$('input[name=\'productRequest_attribute[' + attribute_row + '][name]\']').attr('value', ui.item.label);
			$('input[name=\'productRequest_attribute[' + attribute_row + '][attribute_id]\']').attr('value', ui.item.value);
			
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
		html += '	<input type="hidden" name="productRequest_option[' + option_row + '][productRequest_option_id]" value="" />';
		html += '	<input type="hidden" name="productRequest_option[' + option_row + '][name]" value="' + ui.item.label + '" />';
		html += '	<input type="hidden" name="productRequest_option[' + option_row + '][option_id]" value="' + ui.item.value + '" />';
		html += '	<input type="hidden" name="productRequest_option[' + option_row + '][type]" value="' + ui.item.type + '" />';
		html += '	<table class="form">';
		html += '	  <tr>';
		html += '		<td><?php echo $entry_required; ?></td>';
		html += '       <td><select name="productRequest_option[' + option_row + '][required]">';
		html += '	      <option value="1"><?php echo $text_yes; ?></option>';
		html += '	      <option value="0"><?php echo $text_no; ?></option>';
		html += '	    </select></td>';
		html += '     </tr>';
		
		if (ui.item.type == 'text') {
			html += '     <tr>';
			html += '       <td><?php echo $entry_option_value; ?></td>';
			html += '       <td><input type="text" name="productRequest_option[' + option_row + '][option_value]" value="" /></td>';
			html += '     </tr>';
		}
		
		if (ui.item.type == 'textarea') {
			html += '     <tr>';
			html += '       <td><?php echo $entry_option_value; ?></td>';
			html += '       <td><textarea name="productRequest_option[' + option_row + '][option_value]" cols="40" rows="5"></textarea></td>';
			html += '     </tr>';						
		}
		 
		if (ui.item.type == 'file') {
			html += '     <tr style="display: none;">';
			html += '       <td><?php echo $entry_option_value; ?></td>';
			html += '       <td><input type="text" name="productRequest_option[' + option_row + '][option_value]" value="" /></td>';
			html += '     </tr>';			
		}
						
		if (ui.item.type == 'date') {
			html += '     <tr>';
			html += '       <td><?php echo $entry_option_value; ?></td>';
			html += '       <td><input type="text" name="productRequest_option[' + option_row + '][option_value]" value="" class="date" /></td>';
			html += '     </tr>';			
		}
		
		if (ui.item.type == 'datetime') {
			html += '     <tr>';
			html += '       <td><?php echo $entry_option_value; ?></td>';
			html += '       <td><input type="text" name="productRequest_option[' + option_row + '][option_value]" value="" class="datetime" /></td>';
			html += '     </tr>';			
		}
		
		if (ui.item.type == 'time') {
			html += '     <tr>';
			html += '       <td><?php echo $entry_option_value; ?></td>';
			html += '       <td><input type="text" name="productRequest_option[' + option_row + '][option_value]" value="" class="time" /></td>';
			html += '     </tr>';			
		}
		
		html += '  </table>';
			
		if (ui.item.type == 'select' || ui.item.type == 'radio' || ui.item.type == 'checkbox' || ui.item.type == 'image') {
			html += '  <table id="option-value' + option_row + '" class="list">';
			html += '  	 <thead>'; 
			html += '      <tr>';
			html += '        <td ><?php echo $entry_option_value; ?></td>';
			html += '        <td ><?php echo $entry_quantity; ?></td>';
			html += '        <td ><?php echo $entry_subtract; ?></td>';
			html += '        <td ><?php echo $entry_price; ?></td>';
			html += '        <td ><?php echo $entry_option_points; ?></td>';
			html += '        <td ><?php echo $entry_weight; ?></td>';
			html += '        <td></td>';
			html += '      </tr>';
			html += '  	 </thead>';
			html += '    <tfoot>';
			html += '      <tr>';
			html += '        <td colspan="6"></td>';
			html += '        <td ><a onclick="addOptionValue(' + option_row + ');" class="button"><?php echo $button_add_option_value; ?></a></td>';
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
	html += '    <td ><select name="productRequest_option[' + option_row + '][productRequest_option_value][' + option_value_row + '][option_value_id]">';
	html += $('#option-values' + option_row).html();
	html += '    </select><input type="hidden" name="productRequest_option[' + option_row + '][productRequest_option_value][' + option_value_row + '][productRequest_option_value_id]" value="" /></td>';
	html += '    <td ><input type="text" name="productRequest_option[' + option_row + '][productRequest_option_value][' + option_value_row + '][quantity]" value="" size="3" /></td>'; 
	html += '    <td ><select name="productRequest_option[' + option_row + '][productRequest_option_value][' + option_value_row + '][subtract]">';
	html += '      <option value="1"><?php echo $text_yes; ?></option>';
	html += '      <option value="0"><?php echo $text_no; ?></option>';
	html += '    </select></td>';
	html += '    <td ><select name="productRequest_option[' + option_row + '][productRequest_option_value][' + option_value_row + '][price_prefix]">';
	html += '      <option value="+">+</option>';
	html += '      <option value="-">-</option>';
	html += '    </select>';
	html += '    <input type="text" name="productRequest_option[' + option_row + '][productRequest_option_value][' + option_value_row + '][price]" value="" size="5" /></td>';
	html += '    <td ><select name="productRequest_option[' + option_row + '][productRequest_option_value][' + option_value_row + '][points_prefix]">';
	html += '      <option value="+">+</option>';
	html += '      <option value="-">-</option>';
	html += '    </select>';
	html += '    <input type="text" name="productRequest_option[' + option_row + '][productRequest_option_value][' + option_value_row + '][points]" value="" size="5" /></td>';	
	html += '    <td ><select name="productRequest_option[' + option_row + '][productRequest_option_value][' + option_value_row + '][weight_prefix]">';
	html += '      <option value="+">+</option>';
	html += '      <option value="-">-</option>';
	html += '    </select>';
	html += '    <input type="text" name="productRequest_option[' + option_row + '][productRequest_option_value][' + option_value_row + '][weight]" value="" size="5" /></td>';
	html += '    <td ><a onclick="$(\'#option-value-row' + option_value_row + '\').remove();" class="button"><?php echo $button_remove; ?></a></td>';
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
    html += '    <td ><select name="productRequest_discount[' + discount_row + '][customer_group_id]">';
    <?php foreach ($customer_groups as $customer_group) { ?>
    html += '      <option value="<?php echo $customer_group['customer_group_id']; ?>"><?php echo $customer_group['name']; ?></option>';
    <?php } ?>
    html += '    </select></td>';		
    html += '    <td ><input type="text" name="productRequest_discount[' + discount_row + '][quantity]" value="" size="2" /></td>';
    html += '    <td ><input type="text" name="productRequest_discount[' + discount_row + '][priority]" value="" size="2" /></td>';
	html += '    <td ><input type="text" name="productRequest_discount[' + discount_row + '][price]" value="" /></td>';
    html += '    <td ><input type="text" name="productRequest_discount[' + discount_row + '][date_start]" value="" class="date" /></td>';
	html += '    <td ><input type="text" name="productRequest_discount[' + discount_row + '][date_end]" value="" class="date" /></td>';
	html += '    <td ><a onclick="$(\'#discount-row' + discount_row + '\').remove();" class="button"><?php echo $button_remove; ?></a></td>';
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
    html += '    <td ><select name="productRequest_special[' + special_row + '][customer_group_id]">';
    <?php foreach ($customer_groups as $customer_group) { ?>
    html += '      <option value="<?php echo $customer_group['customer_group_id']; ?>"><?php echo $customer_group['name']; ?></option>';
    <?php } ?>
    html += '    </select></td>';		
    html += '    <td ><input type="text" name="productRequest_special[' + special_row + '][priority]" value="" size="2" /></td>';
	html += '    <td ><input type="text" name="productRequest_special[' + special_row + '][price]" value="" /></td>';
    html += '    <td ><input type="text" name="productRequest_special[' + special_row + '][date_start]" value="" class="date" /></td>';
	html += '    <td ><input type="text" name="productRequest_special[' + special_row + '][date_end]" value="" class="date" /></td>';
	html += '    <td ><a onclick="$(\'#special-row' + special_row + '\').remove();" class="button"><?php echo $button_remove; ?></a></td>';
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
	
	$('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="index.php?route=common/filemanager&field=' + encodeURIComponent(field) + '" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
	
	$('#dialog').dialog({
		title: '<?php echo $text_image_manager; ?>',
		close: function (event, ui) {
			if ($('#' + field).attr('value')) {
				$.ajax({
					url: 'index.php?route=common/filemanager/image&image=' + encodeURIComponent($('#' + field).attr('value')),
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
	html += '    <td ><div class="image"><img src="<?php echo $no_image; ?>" alt="" id="thumb' + image_row + '" /><input type="hidden" name="productRequest_image[' + image_row + '][image]" value="" id="image' + image_row + '" /><br /><a onclick="image_upload(\'image' + image_row + '\', \'thumb' + image_row + '\');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$(\'#thumb' + image_row + '\').attr(\'src\', \'<?php echo $no_image; ?>\'); $(\'#image' + image_row + '\').attr(\'value\', \'\');"><?php echo $text_clear; ?></a></div></td>';
	html += '    <td ><input type="text" name="productRequest_image[' + image_row + '][sort_order]" value="" size="2" /></td>';
	html += '    <td ><a onclick="$(\'#image-row' + image_row  + '\').remove();" class="button"><?php echo $button_remove; ?></a></td>';
	html += '  </tr>';
	html += '</tbody>';
	
	$('#images tfoot').before(html);
	
	image_row++;
}
//--></script> 
<script type="text/javascript" src="catalog/view/javascript/jquery/ui/jquery-ui-timepicker-addon.js"></script> 
<script type="text/javascript" src="catalog/view/javascript/jquery/ui/tabs.js"></script> 
<script type="text/javascript"><!--
$('select[name=\'country_id\']').bind('change', function() {
	$.ajax({
		url: 'index.php?route=account/register/country&country_id=' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('select[name=\'country_id\']').after('<span class="wait">&nbsp;<img src="catalog/view/theme/default/image/loading.gif" alt="" /></span>');
		},
		complete: function() {
			$('.wait').remove();
		},			
		success: function(json) {
			
			html = '<option value=""><?php echo $text_select; ?></option>';
			
			if (json['zone'] != '') {
				for (i = 0; i < json['zone'].length; i++) {
        			html += '<option value="' + json['zone'][i]['zone_id'] + '"';
	    			
					if (json['zone'][i]['zone_id'] == '<?php echo $zone_id; ?>') {
	      				html += ' selected="selected"';
                                        }
	
	    			html += '>' + json['zone'][i]['name'] + '</option>';
				}
			} else {
				html += '<option value="0" selected="selected"><?php echo $text_none; ?></option>';
			}
			
			$('select[name=\'zone_id\']').html(html);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('select[name=\'country_id\']').trigger('change');
//--></script> 
<script type="text/javascript"><!--
$('select[name=\'offloading_country_id\']').bind('change', function() {
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
$(document).ready(function() {
	$('.colorbox').colorbox({
		width: 640,
		height: 480
	});
});
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
$('#topTabs a').tabs();
$('#languages a').tabs(); 
$('#vtab-option a').tabs(); 
//--></script> 
<?php echo $footer; ?>