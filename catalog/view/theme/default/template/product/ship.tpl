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
      <h1><img src="catalog/view/image/product.png" alt="" /> <?php echo $heading_title; ?></h1>    
      <?php if($isLogged) { ?>  
       <div class="addthis_default_style" style="padding-top: 12px;float: right;">
          <a class="addthis_button_compact">Share</a> 
          <a class="addthis_button_email"></a>
          <a class="addthis_button_print"></a> 
          <a class="addthis_button_facebook"></a> 
          <a class="addthis_button_twitter"></a>
      </div>
      <script type="text/javascript" src="//s7.addthis.com/js/250/addthis_widget.js"></script>   
     <?php } ?>
    </div>
    
      
      
    <div class="content1">
     <?php if($isLogged) { ?> 
        <table>
            <tr>
                <td>
                    <a href="?route=customer/customer/update&customer_id=<?php echo $customer['customer_id']; ?>" target="_blank" >
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
                                    <b>Company:</b>
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
                                <input type="text" value="<?php 
                                       if ( isset($isLogged) ) 
                                            { 
                                            echo $customer['firstname'];   
                                            echo $customer['lastname']; 
                                            } 
                                        else echo '****'; 
                                            ?>" readonly>       
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
                                <input type="text" value=" <?php 
                                       if ( isset($isLogged) ) 
                                            {
                                            echo $customer['skype']; 
                                            } 
                                       else  echo '****';       
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
                <td>
                    <?php if($customer['verified'] == "3") { ?>
                    
                        <a href="?route=customer/customer/update&customer_id=<?php echo $customer['customer_id']; ?>" target="_blank" >
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <img src="image/verified.png" width="120">
                        </a>

                    <?php } ?>
                </td> 
                
            </tr>      
        </table>    
      <?php } else { ?>
            <?php echo html_entity_decode($companyViewLargeText['text']); ?>
      <?php } ?>
        
      <div id="tabs" class="htabs">
          <a href="#tab-data"><?php echo $tab_freight_parameters_text; ?></a>
          <a href="#tab-general"><?php echo $tab_general; ?></a>         
          <a href="#tab-image"><?php echo $tab_image; ?></a>
          <a href="#tab-Map" onclick="window.setTimeout(resizeMap,1000);">Map</a>
      </div>
        
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
          
        <input type="hidden" name="customer_id" value="<?php echo $this->customer->getId() ?>">
         
        <div id="tab-general">
            
         <?php if ( !isset($isLogged) ) { ?>
         <br>
         <table class="form">
         <tr align="center" style="border-style:ridge;border-color:#98bf21;" height="200">
            
             <td colspan="2"  >  
                   <a href="?route=account/login" style="font-size:450%;color:#3366CC;text-decoration: none;" > 
                     <?php echo $register_login_text; ?> 
                   </a>
             </td>
            
         </tr>   
         </table>
         <?php } else {   ?> 
         
          <div id="languages" class="htabs">
            <?php  $availDescs = 0; ?>
            <?php foreach ($languages as $language) { ?>            
             <?php if (isset($product_description[$language['language_id']]) )
                if ( $product_description[$language['language_id']]['description'] != '' ) { ?>
                  <?php $availDescs += 1; ?>
             <a href="#language<?php echo $language['language_id']; ?>">
                 <img src="image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> 
             </a>
             <?php }  ?>
             
            <?php } ?>
          </div>
          <?php foreach ($languages as $language) { ?>
           <?php if (isset($product_description[$language['language_id']]) )
                if ( $product_description[$language['language_id']]['description'] != '' ) { ?>
          <div id="language<?php echo $language['language_id']; ?>">
            <table class="form">
              <!--<tr>
                <td><?php echo $entry_name; ?></td>
                <td><input type="text" name="product_description[<?php echo $language['language_id']; ?>][name]" size="100" value="<?php echo isset($product_description[$language['language_id']]) ? $product_description[$language['language_id']]['name'] : ''; ?>" readonly />
                 </td>
              </tr>-->
              <tr>
               <!-- <td><?php echo $entry_description; ?></td>-->
                <td>
                     <?php echo html_entity_decode(  $product_description[$language['language_id']]['description']  );  ?>                
                </td>
              </tr>
             
            </table>
          </div>
           <?php }?>
           <?php } ?>
           
          <?php if ($availDescs == 0) {  ?>
          <div style="text-align: center;font-size: 200%;"> <?php echo $no_descriptions_text; ?></div>
          <?php } ?>
          
           <?php } ?>
          
          
        </div>
        <div id="tab-data">
          <table class="form">
                     
          <tr>       
              <td><b><?php echo $loading_area_text; ?></b></td>             
         </tr>    
         
         <?php if ( !isset($isLogged) ) { ?>
         <br>  
         <tr align="center" style="border-style:ridge;border-color:#98bf21;" height="200">  
             <td colspan="2"  >  
                   <a href="?route=account/login" style="font-size:450%;color:#3366CC;text-decoration: none;" > 
                     <?php echo $register_login_text; ?>
                   </a>
             </td>      
         </tr>   
         <?php } else {   ?> 
         
            <tr>             
              <td><?php echo $loading_country_text; ?></td>
              <td>   
                  <img src="image/flags/<?php echo strtolower($loading_country['iso_code_2']); ?>.png">
                 <input type="text" name="loading_coutry_name" value="<?php echo $loading_country['name']; ?>" readonly />                                                                                 
             </td>            
            </tr>
                
            <tr>             
              <td><?php echo $loading_region_state_text; ?></td>
              <td>                   
                 <input type="text" name="loading_zone_name" value="<?php if (isset($loading_zone['name']))echo $loading_zone['name']; ?>" readonly />                                                          
             </td>            
            </tr>
                    
            <tr>
              <td><?php echo $loading_city_text; ?></td>
              <td><input type="text" name="loading_city" value="<?php echo $loading_city; ?>" readonly /></td>
            </tr>
            
            <tr class="bottomline">
              <td><?php echo $zip_code_text; ?></td>
              <td><input type="text" name="loading_zip" value="<?php echo $loading_zip; ?>" readonly /></td>
            </tr>
            <?php } ?>
            
          <tr>             
              <td><b><?php echo $offloading_area_text; ?></b></td>             
         </tr>    
         
         <?php if ( !isset($isLogged) ) { ?>
         <br>  
         <tr align="center" style="border-style:ridge;border-color:#98bf21;" height="200">
            
             <td colspan="2"  >  
                   <a href="?route=account/login" style="font-size:450%;color:#3366CC;text-decoration: none;" > 
                    <?php echo $register_login_text; ?> 
                   </a>
             </td>
            
         </tr>   
         <?php } else {   ?> 
         
            <tr>
              <td><?php echo $offloading_country_text; ?></td>
              <td>
                  <img src="image/flags/<?php echo strtolower($offloading_country['iso_code_2']); ?>.png">
                 <input type="text" name="offloading_coutry_name" value="<?php echo $offloading_country['name']; ?>" readonly />     
              </td>
            </tr>
            
            <tr>
              <td><?php echo $offloading_region_state_text; ?></td>
              <td>
                    <input type="text" name="offloading_coutry_name" value="<?php if (isset($offloading_zone['name'])) echo $offloading_zone['name']; ?>" readonly />                 
              </td>
            </tr>
            
            <tr>              
              <td><?php echo $offloading_city_text; ?></td>
              <td><input type="text" name="offloading_city" value="<?php echo $offloading_city; ?>" readonly /></td>
            </tr>
            
            <tr class="bottomline">
              <td><?php echo $zip_code_text; ?></td>
              <td><input type="text" name="offloading_zip" value="<?php echo $offloading_zip; ?>" readonly /></td>
            </tr>
            
            <?php } ?>
            
                <tr>             
                     <td><b><?php echo $date_text; ?></b></td>             
                </tr> 
         
         <?php if ( !isset($isLogged) ) { ?>
         <br>  
         <tr align="center" style="border-style:ridge;border-color:#98bf21;" height="200">
            
             <td colspan="2"  >  
                   <a href="?route=account/login" style="font-size:450%;color:#3366CC;text-decoration: none;" > 
                     <?php echo $register_login_text; ?>
                   </a>
             </td>
            
         </tr>   
         <?php } else {   ?> 
             <?php if($frequency == 0) { ?>
                <tr>                     
                  <td><?php echo $loading_date_text; ?></td>
                  <td><input type="text" name="loading_date" value="<?php echo $loading_date; ?>" size="12" readonly /></td>
                </tr>
                <tr class="bottomline" >
                  <td><?php echo $estimation_date_text; ?></td>
                  <td> 
                      <input type="text" name="est_date" value="<?php echo $est_date.' days'; ?>" size="12"  readonly />                                                                                       
                  </td>
                </tr>                     
                <tr class="bottomline">                     
                  <td><?php echo $offloading_date_text; ?></td>
                  <td><input type="text" name="offloading_date" value="<?php echo $offloading_date; ?>" size="12" readonly /></td>
                </tr>
              <?php } else { ?>
                  <tr>                     
                      <td colspan="3"><?php echo $regular_freight_text; ?></td>                
                  </tr>
              <?php } ?>
          <?php } ?>
          
          
           
         <?php if ( !isset($isLogged) ) { ?>
         <br>  
         <tr align="center" style="border-style:ridge;border-color:#98bf21;"  height="200">
            
             <td colspan="2"  >  
                   <a href="?route=account/login" style="font-size:450%;color:#3366CC;text-decoration: none;" > 
                     <?php echo $register_login_text; ?> 
                   </a>
             </td>
            
         </tr>   
         <?php } else {   ?> 
                
            <!-- <tr  class="bottomline" >
              <td><?php echo $trailer_type_text; ?></td>
              <td>
                <input type="text" name="treiler_type" value="<?php echo $treiler_type['name']; ?>" readonly />                     
              </td>
              
              <td>
                <?php if ($lift == 1) {  ?>
                <img src="image/yes.png" width="20"><?php echo $lift_text; ?>
                <?php } else {  ?>
                 <img src="image/no.png" width="20"><?php echo $lift_text; ?>
                <?php } ?>            
              </td>
                <td>
                  <?php if ($manipulator == 1) {  ?>
                  <img src="image/yes.png" width="20"><?php echo $manipulator_text; ?>
                  <?php } else {  ?>
                  <img src="image/no.png" width="20"><?php echo $manipulator_text; ?>
                  <?php } ?> 
              </td>
              <td>
                  <?php if ($adr == 1) {  ?>
                  <img src="image/yes.png" width="20">ADR
                  <?php } else { ?>
                  <img src="image/no.png" width="20">ADR               
                  <?php } ?>
              </td>
              <td>
                  <?php if ($tir == 1) {  ?>
                  <img src="image/yes.png" width="20">TIR
                  <?php } else { ?>
                  <img src="image/no.png" width="20">TIR
                  <?php } ?>
              </td>
                          
              <td>
                  <?php if ($cmr == 1) {  ?>
                   <img src="image/yes.png" width="20">CMR
                   <?php } else { ?>
                  <img src="image/no.png" width="20">CMR
                  <?php } ?>
              </td>
              <td>
                  <?php if ($cemt == 1) {  ?>
                  <img src="image/yes.png" width="20">CEMT
                  <?php } else { ?>
                 <img src="image/no.png" width="20">CEMT
                  <?php } ?>
              </td>
              
            </tr> -->
                                                         
            <tr>                
              <td><?php echo $freight_parameters_text; ?></td>              
              <td>                   
                    <?php if( $freight_params == 0 ) { ?> 
                        <img src="image/yes.png" width="20"> Ftl
                        <img src="image/no.png" width="20"> Ltl              
                    <?php } else { ?> 
                        <img src="image/no.png" width="20"> Ftl
                        <img src="image/yes.png" width="20"> Ltl  
                    <?php } ?>                
              </td>
            </tr>
            <tr>              
              <td><?php echo $weight_tons_text; ?></td>
              <td><input type="text" name="weight_tons" value="<?php echo $weight_tons; ?>"  readonly /></td>
            </tr>
            <tr>              
              <td><?php echo $pallets_no_text; ?></td>
              <td><input type="text" name="pallets_no" value="<?php echo $pallets_no; ?>" readonly /></td>
            </tr>
            
            <tr>
              <td><?php echo $exchangeable_text; ?></td>
              <td>   
                   <input type="text" name="exchangeable" value=" <?php if ($exchangeable == 1) echo 'exchangeable'; else echo 'Non exchangeable'; ?>" readonly />                  
              </td>
            </tr>
            
           <tr>
              <td><?php echo $stackable_text; ?></td>
              <td>
                 <input type="text" name="Stackable" value=" <?php if ($stackable == 1) echo 'Stackable'; else echo 'Non stackable'; ?>" readonly />                    
              </td>
            </tr>
            <tr class="bottomline">              
              <td><?php echo $volume_unit_text; ?></td>
              <td><input type="text" name="volume_unit" value="<?php echo $volume_unit; ?>" readonly /></td>
            </tr>  
             
            <?php } ?>         
         </table>
            
            
        </div>
        
  
        <div id="tab-image">
            
            
        <?php if ( !isset($isLogged) ) { ?>
         <br> 
         <table class="form">
         <tr align="center" style="border-style:ridge;border-color:#98bf21;" height="200">
            
             <td colspan="2"  >  
                   <a href="?route=account/login" style="font-size:450%;color:#3366CC;text-decoration: none;" > 
                    <?php echo $register_login_text; ?>
                   </a>
             </td>
            
         </tr>   
         </table>
         <?php } else {   ?> 
         
<!-- <?php if ($thumb) { ?>
      <div class="image"><a href="<?php echo $popup; ?>" title="<?php echo $heading_title; ?>" class="colorbox"><img src="<?php echo $thumb; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" id="image" /></a></div>
      <?php } else { ?>
      <div class="image"> <img src="image/noimage.jpg" width="230" height="250"> </div>
      <?php } ?>  -->
         
            <?php if ($images) { ?>
            <div class="image-additional">
              <?php foreach ($images as $image) { ?>
              <a style="padding: 10px;" href="<?php echo $image['popup']; ?>" title="<?php echo $heading_title; ?>" rel="lightbox[plants]" ><img src="<?php echo $image['thumb']; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" /></a>
              <?php } ?>
            </div>
            <?php } ?>            
        <link rel="stylesheet" href="catalog/view/theme/default/javascript/lightbox/css/lightbox.css" type="text/css" media="screen" />
        <script src="catalog/view/theme/default/javascript/lightbox/js/lightbox.js"></script>          
      <?php } ?>
        </div>
        
        <div id="tab-Map">
           <table class="form"> 
               
         <?php if ( !isset($isLogged) ) { ?>
         <br>       
         <tr align="center" style="border-style:ridge;border-color:#98bf21;" height="200">
            
             <td colspan="2"  >  
                   <a href="?route=account/login" style="font-size:450%;color:#3366CC;text-decoration: none;" > 
                    <?php echo $register_login_text; ?>
                   </a>
             </td>
            
         </tr>   
         <?php } else {   ?> 
         
           <tr> 
                <td> 
                    <?php echo $from_text; ?>
                    <input type="text" id="fromArea" value="<?php echo $loading_country['name']; ?>,<?php if ( isset($loading_zone['name']) ) echo $loading_zone['name']; ?>,<?php echo $loading_city; ?>">              
                </td>
                <td> 
                <?php echo $weather_text; ?>
                <input type="checkbox" checked name="weather"  onclick="showweather(this)">&nbsp;&nbsp;
                <?php echo $clouds_text; ?>
                <input type="checkbox" name="clouds"  onclick="showclouds(this)"> 
                </td>
                <td></td> 
                <td></td>
                <td></td>
            </tr>
            <tr>              
                <td>  <?php echo $to_text; ?><input type="text" id="toArea" value="<?php echo $offloading_country['name']; ?>,<?php if ( isset($offloading_zone['name']) ) echo $offloading_zone['name']; ?>,<?php echo $offloading_city; ?>"> </td>
                <td>
                  <input type="button" value="Show" onclick="showDirections()"> 
                </td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            
             <tr>
            <td>Via:</td>
            <td colspan="4"></td>
            </tr>          
           <tr> 
                <td> 
                    1.<input type="text" id="waypoint0" value="">              
                </td>
                <td> 
                    2.<input type="text" id="waypoint1" value="">   
                </td>
                <td>
                    3. <input type="text" id="waypoint2" value="">   
                </td> 
                <td>
                    4. <input type="text" id="waypoint3" value="">   
                </td>
                <td>
                    5. <input type="text" id="waypoint4" value="">   
                </td>
            </tr>
            <tr> 
                <td> 
                    6.<input type="text" id="waypoint5" value="">              
                </td>
                <td> 
                   7.<input type="text" id="waypoint6" value="">   
                </td>
                <td>
                    8.<input type="text" id="waypoint7" value="">   
                </td> 
                <td>
                    9.<input type="text" id="waypoint8" value="">   
                </td>
                <td>
                     10.<input type="text" id="waypoint9" value="">   
                </td>
            </tr>
            <tr>
                <td>Distance:</td>
                <td><div id="distance"> </div> </td>
                <td colspan="3"></td>
            </tr>
             <tr>
                <td>Duration:</td>
                <td><div id="duration"> </div> </td>
                <td colspan="3"></td>
            </tr>
            
            <tr>
                <td colspan="5" align="top" valign="top">
                    <div id="map" onload="showDirections()" style="width: 950px; height: 500px; float: left;"></div>
                </td>  
            </tr>
            
            <?php } ?>
            </table>
        </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript" src="catalog/view/javascript/ckeditor/ckeditor.js"></script> 
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
		
		$('#product-filter').append('<div id="product-filter' + ui.item.value + '">' + ui.item.label + '<img src="view/image/delete.png" alt="" /><input type="hidden" name="product_filter[]" value="' + ui.item.value + '" /></div>');

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
		
		$('#product-download').append('<div id="product-download' + ui.item.value + '">' + ui.item.label + '<img src="view/image/delete.png" alt="" /><input type="hidden" name="product_download[]" value="' + ui.item.value + '" /></div>');

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
		
		$('#product-related').append('<div id="product-related' + ui.item.value + '">' + ui.item.label + '<img src="view/image/delete.png" alt="" /><input type="hidden" name="product_related[]" value="' + ui.item.value + '" /></div>');

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
$('select[name=\'country_id\']').bind('change', function() {
	$.ajax({
		url: 'index.php?route=account/address/country&country_id=' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('select[name=\'country_id\']').after('<span class="wait">&nbsp;<img src="catalog/view/theme/default/image/loading.gif" alt="" /></span>');
		},		
		complete: function() {
			$('.wait').remove();
		},			
		success: function(json) {
			if (json['postcode_required'] == '1') {
				$('#postcode-required').show();
			} else {
				$('#postcode-required').hide();
			}
			
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
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script src='http://maps.googleapis.com/maps/api/js?libraries=weather&amp;sensor=false' type='text/javascript'></script>
<script type="text/javascript" src="catalog/view/javascript/gmap/gMapRoot.js"></script>
<?php echo $footer; ?>