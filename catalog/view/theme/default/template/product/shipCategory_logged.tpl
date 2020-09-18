<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content"><?php echo $content_top; ?>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <h1>
        <img src="image/ship.png" width=30 height=30>
      <?php echo $heading_title; ?>
  </h1>

   
  
  
    <div class="product-filter">
        <input type="button" value="<?php echo $search_filters_text; ?>" style="background-color: #EFEFEF; font-weight:bold; font-size: 150%;color:  #0073FF; border: 1px solid #DDDDDD;padding: 5px;cursor:pointer;" class="show_hide" />
        <!--<input type="button" value="<?php echo $text_compare; ?>" style="background-color: #EFEFEF; border: 1px solid #DDDDDD;padding: 5px;"/>-->     
        <input type="button" onclick="window.location = '?route=product/compareTruck'" value="<?php echo $compare_text; ?>" id="compare-total" style="background-color: #EFEFEF; border: 1px solid #DDDDDD;padding: 5px; cursor:pointer;"/>
        
         <div class="slidingDiv" style=" padding-bottom:4px; border:1px solid #DDDDDD; background: #FFFFFF; display: none; "  >    
               <form action="?route=product/shipCategory" method="get" enctype="multipart/form-data" id="form">
                <input type="hidden" name="route" value="product/shipCategory">                                        
                   
               <table class="form">
              
                <tr>
                    <td><?php echo $loading_country_text; ?></td>
                    <td>
                        <select name="search_loading_country" style="width:180px;">
                            <option value="-1"><?php echo $na_text; ?></option>
                            <?php foreach($countries as $country ) { ?>
                            <option value="<?php echo $country['country_id']; ?>" 
                                    <?php  if( $country['country_id'] == $search_loading_country ) echo " selected = 'true' "; ?> >
                                    <?php echo $country['name']; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </td>
                    <td><?php echo $region_state_text; ?></td>
                    <td>
                        <select name="search_loading_zone"> 
                            <option value="-1"><?php echo $na_text; ?></option>
                        </select> 
                    </td>
                    
                    <td> <?php echo $city_area_text; ?></td>
                    <td>
                        <input type="text" name="search_loading_city" value="<?php echo $search_loading_city?>">
                    </td>
                </tr>
                 <tr>
                    <td> <?php echo $offloading_country_text; ?></td>
                    <td>
                      <select name="search_offloading_country" style="width:180px;">
                           <option value="-1"><?php echo $na_text; ?></option>
                            <?php foreach($countries as $country ) { ?>
                            <option value="<?php echo $country['country_id']; ?>"
                                     <?php  if( $country['country_id'] == $search_offloading_country ) echo " selected = 'true' "; ?> >
                                     <?php echo $country['name']; ?>
                            </option>
                            <?php } ?>
                      </select>
                    </td>
                    <td><?php echo $region_state_text; ?></td>
                    <td>
                        <select name="search_offloading_zone">
                            <option value="-1"><?php echo $na_text; ?></option>
                        </select>
                    </td>
                    <td> <?php echo $city_area_text; ?> </td>
                    <td>
                        <input type="text" name="search_offloading_city"  value="<?php echo $search_offloading_city ?>" >
                    </td>
                </tr>              
                <tr class="bottomline" >
                    <td>
                      <?php echo $loading_date_at_text; ?>
                    </td>
                    <td>
                        <input type="text" name="search_loading_date_from" value="<?php echo $search_loading_date_from ?>" class="date" readonly>
                    </td>
                    <td>
                       <?php echo $date_to_text; ?>
                    </td>
                    <td>
                        <input type="text" name="search_loading_date_to" value="<?php echo $search_loading_date_to ?>" class="date" readonly>
                    </td>  
                <!--<input type="hidden" name="search" value="true">-->
                </tr>
                
                
            </table>
           <!-- 
           <table class="form">
                 <tr>
                    <td>
                        <img src="image/trailers/7.5t50m3.jpg"> <br>
                        <input name="search_trailer_type" value="1" type="checkbox" <?php echo  $search_trailer_type; ?>> <7.5t, 50m3
                    </td>
                    <td>
                        <img src="image/trailers/Tent.jpg"> <br>
                        <input name="search_trailer_type2" value="10" type="checkbox" <?php echo  $search_trailer_type2; ?> > Tent 13.6
                    </td>
                     <td>
                        <img src="image/trailers/Autotrain.jpg"> <br>
                        <input name="search_trailer_type3" value="11" type="checkbox" <?php echo  $search_trailer_type3; ?>> Autotrain 120m3
                    </td>
                    <td>
                        <img src="image/trailers/Mega.jpg"> <br>
                        <input name="search_trailer_type4" value="12" type="checkbox" <?php echo  $search_trailer_type4; ?> > Mega 100m3
                    </td>
                    <td>
                        <img src="image/trailers/Refrigerator.jpg"> <br>
                        <input name="search_trailer_type5" value="9" type="checkbox" <?php echo  $search_trailer_type5; ?> > Refrigerator
                    </td>
                    <td>
                        <img src="image/trailers/Tank.jpg"> <br>
                        <input name="search_trailer_type6" value="5" type="checkbox" <?php echo  $search_trailer_type6; ?> > Tank
                    </td> 
                  </tr>
                  <tr class="bottomline" >
                    <td>
                        <img src="image/trailers/Autocart.jpg"> <br>
                        <input name="search_trailer_type7" value="6" type="checkbox" <?php echo  $search_trailer_type7; ?> > Autocart
                    </td>                   
                    <td>
                        <img src="image/trailers/Container.jpg"> <br>
                        <input name="search_trailer_type8" value="2" type="checkbox" <?php echo  $search_trailer_type8; ?> > Container
                    </td>
                    <td>
                        <img src="image/trailers/Oversized.jpg"> <br>
                        <input name="search_trailer_type9" value="4" type="checkbox" <?php echo  $search_trailer_type9; ?> > Oversized
                    </td>
                   <td>
                        <img src="image/trailers/Other.jpg"> <br>
                        <input name="search_trailer_type10" value="8" type="checkbox" <?php echo  $search_trailer_type10; ?> > <?php echo $other_text; ?>
                    </td>
                    <td>
                        <img src="image/trailers/OpenPlatform.jpg"> <br>
                        <input name="search_trailer_type11" value="3" type="checkbox" <?php echo  $search_trailer_type11; ?> > Open Platform
	
                    </td> 
                    <td>
                        <img src="image/trailers/Frigio.jpg"> <br>
                        <input name="search_trailer_type12" value="7" type="checkbox" <?php echo  $search_trailer_type12; ?> > Frigio	
                    </td> 
                </tr>

            </table> 
           -->
            
            <table class="form">
                <tr>
                    <td>
                         <input type="button" onclick="$('#form').submit();" value="<?php echo $search_text; ?>" class="button" />
                    </td>
                    <td>     
                        <a href="?route=product/truckCategory">
                       <input type="button" value="<?php echo $clear_text; ?>" class="button" />
                       </a>
                    </td>
                </tr>            
            </table>
                                     
                                                                       
          </form>
        </div>
        
  </div>
  
  
  
  <?php if ( isset($suggestions) ) { ?>
  <div class="content" style="border: 1px solid #EEEEEE;background: #E6E6E6;">
      <table>
        <tr valign = center>
            <td>
                <img src="image/exclamation.png" width="30">
            </td>
            <td  valign='center' style="font-size:16px" >
                <?php echo $text_empty; ?> &nbsp;
                <b style=" color: green;">View Myspedition suggestions below.</b> 
            </td>
       </tr>
     </table> 
  </div>
  <?php } ?>  
  
  <?php if ($products) { ?>
 
   <div class="product-compare"></div>
  
  
  <table class="list1">
          <thead>
            <tr>
              <td class="center"></td>
              <td class="left">
                    <a href="<?php echo $sort_loading_date; ?>">
                        <?php echo $loading_date_text; ?>
                         <img src="<?php echo $filterImage ?>" width="15">
                    </a>            
             </td>
              <!-- <td>
                      <?php echo $trailer_text; ?>          
              </td> -->
              <td class="left">                            
                        <?php echo $loading_country_text; ?>
              </td>
              <!--<td class="left">
                    <?php echo $region_state_text; ?>               
              </td>-->
              <td class="left">           
                     <?php echo $city_area_text; ?>      
              </td>
              <td class="right">              
                        <?php echo $offloading_country_text; ?>
                    
              </td>
              <!--<td class="left">
                    <?php echo $region_state_text; ?>
              </td>-->
              <td class="left">                 
                         <?php echo $city_area_text; ?>
              </td>
              <td>                
                  <?php echo $company_text; ?>
              </td>  
              <td></td>
            </tr>
          </thead>
          <tbody>
            
            <?php if ($products) { ?>
            <?php foreach ($products as $product) { ?>
                                 
            <tr style="cursor:pointer">

              <td class="center" onclick="parent.location='<?php echo $product['href']; ?>'" >
                  <img src="image/ship.png" width="25" height="25" alt="<?php echo $product['name']; ?>" style="padding: 1px; border: 1px solid #DDDDDD;" />
              </td>
              <td class="left" onclick="parent.location='<?php echo $product['href']; ?>'" >
                  <?php echo $product['loading_date']; ?>
              </td>
             <!-- <td onclick="parent.location='<?php echo $product['href']; ?>'" >
                  <?php  echo $product['trailer']['name']  ?>
              </td> -->
              <td class="left" onclick="parent.location='<?php echo $product['href']; ?>'" 
                  title="<?php echo $product['loading_zone']['name']; ?>">            
                  <?php  if ($product['loading_country'] != null ) { ?>
                  <img src="image/flags/<?php echo strtolower($product['loading_country']['iso_code_2']); ?>.png">
                  <?php  echo $product['loading_country']['name']; ?>
                  <?php } ?>
              </td>
              <!--<td class="left" onclick="parent.location='<?php echo $product['href']; ?>'" >
                  <?php 
                  if ( isset($product['loading_zone']['name']) ) 
                        echo $product['loading_zone']['name']; 
                  else
                         echo '---';
                  ?>
              </td>-->
              <td class="left" onclick="parent.location='<?php echo $product['href']; ?>'" >
                  <?php echo $product['loading_city']; ?>
              </td>
              <td class="left" onclick="parent.location='<?php echo $product['href']; ?>'" 
                  title="<?php echo $product['offloading_zone']['name']; ?>">
                   <?php  if ($product['offloading_country'] != null ) { ?>
                  <img src="image/flags/<?php echo strtolower($product['offloading_country']['iso_code_2']); ?>.png">
                  <?php  echo $product['offloading_country']['name']; ?>
                  <?php } ?>                                 
              </td>
              <!--<td class="left" onclick="parent.location='<?php echo $product['href']; ?>'" >
                   <?php 
                   if ( isset($product['offloading_zone']['name']) ) 
                                echo $product['offloading_zone']['name']; 
                   else  echo '---';                    
                   ?>
              </td>-->
              <td class="left" onclick="parent.location='<?php echo $product['href']; ?>'" >
                  <?php echo $product['offloading_city']; ?>
              </td>
              <td  style="text-align: center;" >
                  <a href="?route=customer/customer/update&customer_id=<?php echo $product['owner']['customer_id']; ?>" target="_blank">
                    
                     <?php if($product['owner']['verified'] == 3) { ?>
                       <img src="image/verified.png" width=25>
                     <?php } ?>
                    
                      <?php echo $product['owner']['company']; ?>
                  </a>
                 
              </td>
              <td>
                  <a id="compare-total" onclick="addToCompareTruck('<?php echo $product['product_id']; ?>');">
                       <img src="image/plus.png" width="20">
                  </a>
              </td>
            </tr>
            <?php } ?>
            <?php } else { ?>
            <tr>
              <td class="center" colspan="8"><?php echo $text_no_results; ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
  
  <div class="pagination"><?php echo $pagination; ?></div>
  <?php } ?>
  <?php if (!$products) { ?>
  <div class="content"><?php echo $text_empty; ?></div>
  <div class="buttons">
    <div class="right"><a href="<?php echo $continue; ?>" class="button"><?php echo $button_continue; ?></a></div>
  </div>
  <?php } ?>
  <?php echo $content_bottom; ?>
</div>

<script type="text/javascript"><!--
$('select[name=\'search_loading_country\']').bind('change', function() {
if(this.value != -1)
	$.ajax({
		url: 'index.php?route=account/register/country&country_id=' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('select[name=\'search_loading_country\']').after('<span class="wait">&nbsp;<img src="catalog/view/theme/default/image/loading.gif" alt="" /></span>');
		},
		complete: function() {
			$('.wait').remove();
		},			
		success: function(json) {
			
			html = '<option value="-1"><?php echo $na_text; ?></option>';
			
			if (json['zone'] != '') {
				for (i = 0; i < json['zone'].length; i++) {
        			html += '<option value="' + json['zone'][i]['zone_id'] + '"';
	    			
					if (json['zone'][i]['zone_id'] == '<?php echo $search_loading_zone; ?>') {
                                        html += ' selected="selected"';
                                        }
	
	    			html += '>' + json['zone'][i]['name'] + '</option>';
				}
			}// else {
			//	html += '<option value="0" selected="selected">N/A</option>';
			//}
			
			$('select[name=\'search_loading_zone\']').html(html);
		},
		error: function(xhr, ajaxOptions, thrownError) {
		//	alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('select[name=\'search_loading_country\']').trigger('change');
//--></script> 

<script type="text/javascript"><!--
$('select[name=\'search_offloading_country\']').bind('change', function() {
if(this.value != -1)
	$.ajax({
		url: 'index.php?route=account/register/country&country_id=' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('select[name=\'search_offloading_country\']').after('<span class="wait">&nbsp;<img src="catalog/view/theme/default/image/loading.gif" alt="" /></span>');
		},
		complete: function() {
			$('.wait').remove();
		},			
		success: function(json) {
			html = '<option value="-1"><?php echo $na_text; ?></option>';
			
			if (json['zone'] != '') {
				for (i = 0; i < json['zone'].length; i++) {
        			html += '<option value="' + json['zone'][i]['zone_id'] + '"';
	    			
					if (json['zone'][i]['zone_id'] == '<?php echo $search_offloading_zone; ?>') {
	      				html += ' selected="selected"';
                                        }
	
	    			html += '>' + json['zone'][i]['name'] + '</option>';
				}
			}// else {
		//		html += '<option value="0" selected="selected">N/A</option>';
		//	}
			
			$('select[name=\'search_offloading_zone\']').html(html);
		},
		error: function(xhr, ajaxOptions, thrownError) {
		//	alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('select[name=\'search_offloading_country\']').trigger('change');
//--></script> 


<script type="text/javascript"><!--
function display(view) {
	if (view == 'list') {
		$('.product-grid').attr('class', 'product-list');
		
		$('.product-list > div').each(function(index, element) {
			html  = '<div class="right">';
			html += '  <div class="cart">' + $(element).find('.cart').html() + '</div>';
			html += '  <div class="wishlist">' + $(element).find('.wishlist').html() + '</div>';
			html += '  <div class="compare">' + $(element).find('.compare').html() + '</div>';
			html += '</div>';			
			
			html += '<div class="left">';
			
			var image = $(element).find('.image').html();
			
			if (image != null) { 
				html += '<div class="image">' + image + '</div>';
			}
			
			var price = $(element).find('.price').html();
			
			if (price != null) {
				html += '<div class="price">' + price  + '</div>';
			}
					
			html += '  <div class="name">' + $(element).find('.name').html() + '</div>';
			html += '  <div class="description">' + $(element).find('.description').html() + '</div>';
			
			var rating = $(element).find('.rating').html();
			
			if (rating != null) {
				html += '<div class="rating">' + rating + '</div>';
			}
				
			html += '</div>';
						
			$(element).html(html);
		});		
		
		$('.display').html('<b><?php echo $text_display; ?></b> <?php echo $text_list; ?> <b>/</b> <a onclick="display(\'grid\');"><?php echo $text_grid; ?></a>');
		
		$.totalStorage('display', 'list'); 
	} else {
		$('.product-list').attr('class', 'product-grid');
		
		$('.product-grid > div').each(function(index, element) {
			html = '';
			
			var image = $(element).find('.image').html();
			
			if (image != null) {
				html += '<div class="image">' + image + '</div>';
			}
			
			html += '<div class="name">' + $(element).find('.name').html() + '</div>';
			html += '<div class="description">' + $(element).find('.description').html() + '</div>';
			/*html += '  <div class="description">' + 
                            'From: <?php echo $product["loading_date"]; ?>' +  
                            'Place: <img src="image/flags/<?php echo $product["loading_country"]["iso_code_2"]; ?>.png">' +
                            '</div>';*/
			var price = $(element).find('.price').html();
			
			if (price != null) {
				html += '<div class="price">' + price  + '</div>';
			}
			
			var rating = $(element).find('.rating').html();
			
			if (rating != null) {
				html += '<div class="rating">' + rating + '</div>';
			}
						
			html += '<div class="cart">' + $(element).find('.cart').html() + '</div>';
			html += '<div class="wishlist">' + $(element).find('.wishlist').html() + '</div>';
			html += '<div class="compare">' + $(element).find('.compare').html() + '</div>';
			
			$(element).html(html);
		});	
					
		$('.display').html('<b><?php echo $text_display; ?></b> <a onclick="display(\'list\');"><?php echo $text_list; ?></a> <b>/</b> <?php echo $text_grid; ?>');
		
		$.totalStorage('display', 'grid');
	}
}

view = $.totalStorage('display');

if (view) {
	display(view);
} else {
	display('list');
}
//--></script> 



<script type="text/javascript">
 
$(document).ready(function(){
        
       <?php if( isset($search) ) 
       echo" $('.slidingDiv').show(); ";
       ?>
 
      //  $(".slidingDiv").hide();
      //  $(".show_hide").show();
 
    $('.show_hide').click(function(){
    $(".slidingDiv").slideToggle();
    });
 
});
 
</script>

<script type="text/javascript"><!--
$('.date').datepicker({dateFormat: 'yy-mm-dd'});
$('.datetime').datetimepicker({
	dateFormat: 'yy-mm-dd',
	timeFormat: 'h:m'
});
$('.time').timepicker({timeFormat: 'h:m'});
//--></script> 
<?php echo $footer; ?>