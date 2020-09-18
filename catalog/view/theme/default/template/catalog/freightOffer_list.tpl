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
  <div class="box1">
    <div class="heading">
        <h1>
            <img src="image/offersDone.png" width="25" alt="" /> 
            My quotes for other freighs
        </h1>
      
      <div class="buttons1">
         <!-- <a href="<?php echo $insert; ?>" class="button"><?php echo $insert_text; ?></a>
          <a onclick="$('#form').attr('action', '<?php echo $copy; ?>'); $('#form').submit();" class="button"><?php echo $copy_text; ?></a>
          <a onclick="$('form').submit();" class="button"><?php echo $delete_text; ?></a>
         -->
        <!-- <select>
             <option>a</option>
             <option>b</option>
             <option>c</option>
         </select>-->
         
      </div>
      
    </div>
    <div class="content1">
      <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="list1">
          <thead>
            <tr>
              <td width="1" style="text-align: center;">Quote date</td>
              <td>PRICE</td>
             <!-- <td>
                  Freight Id
              </td> -->
              <td class="left">
                 <?php echo $loading_date_text; ?>
              </td>
               <td>
                 <?php echo $trailer_text; ?> 
              </td>
              <td class="left">
                 <?php echo $loading_country_text; ?> 
              </td>
               <td class="left">
                    <?php echo $region_state_text; ?>
                </td>
              <td class="left">
                    <?php echo $city_area_text; ?>
              </td>
              <td class="right">
                    <?php echo $offloading_country_text; ?>
              </td>
              <td class="left">
                      <?php echo $region_state_text; ?>
              </td>
              <td class="left">
                 <?php echo $city_area_text; ?>
              </td>
              <td>
                  <?php echo $company_text; ?> 
              </td>
              <td class="right">
                  <?php echo $column_action; ?>
              </td>
            </tr>
          </thead>
          <tbody>
            <?php if ($products) { ?>
            <?php foreach ($products as $product) { ?>
            <tr>
              <td style="text-align: center;background-color: #78CDFD;">
                  <?php echo $product['fo_date']; ?>
              </td>
              <td style="text-align: center;background-color: #78CDFD;">
                 <?php echo $product['price']; ?>
              </td>
             <!-- <td>
                 <?php echo $product['freight_id']; ?>
              </td> -->
              <td class="left">
                  <?php echo $product['loading_date']; ?>
              </td>
              <td>
                  <?php  echo $product['trailer']['name']  ?>
              </td>
              <td class="left">            
                  <?php  if ($product['loading_country'] != null ) { ?>
                  <img src="image/flags/<?php echo strtolower($product['loading_country']['iso_code_2']); ?>.png">
                  <?php  echo $product['loading_country']['name']; ?>
                  <?php } ?>
              </td>
              <td class="left">
                  <?php 
                  if ( isset($product['loading_zone']['name']) ) 
                        echo $product['loading_zone']['name']; 
                  else
                         echo '---';
                  ?>
              </td>
              <td class="left"><?php echo $product['loading_city']; ?></td>
              <td class="left">
                   <?php  if ($product['offloading_country'] != null ) { ?>
                  <img src="image/flags/<?php echo strtolower($product['offloading_country']['iso_code_2']); ?>.png">
                  <?php  echo $product['offloading_country']['name']; ?>
                  <?php } ?>                                 
              </td>
              <td class="left">
                   <?php 
                   if ( isset($product['offloading_zone']['name']) ) 
                                echo $product['offloading_zone']['name']; 
                   else  echo '---';                    
                   ?>
               </td>
              <td class="left"><?php echo $product['offloading_city']; ?></td>
              <td>
                  <?php echo $product['owner']['company']; ?>
              </td>
              <td class="right"><?php foreach ($product['action'] as $action) { ?>
                 <a class="button" href="<?php echo $action['href']; ?>" target="_blank" >View</a> 
                <?php } ?></td>
            </tr>
            <?php } ?>
            <?php } else { ?>
            <tr>
              <td class="center" colspan="12"><?php echo $text_no_results; ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </form>
      <div class="pagination"><?php echo $pagination; ?></div>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
function filter() {
	url = 'index.php?route=catalog/product&token=<?php echo $token; ?>';
	
	var filter_name = $('input[name=\'filter_name\']').attr('value');
	
	if (filter_name) {
		url += '&filter_name=' + encodeURIComponent(filter_name);
	}
	
	var filter_model = $('input[name=\'filter_model\']').attr('value');
	
	if (filter_model) {
		url += '&filter_model=' + encodeURIComponent(filter_model);
	}
	
	var filter_price = $('input[name=\'filter_price\']').attr('value');
	
	if (filter_price) {
		url += '&filter_price=' + encodeURIComponent(filter_price);
	}
	
	var filter_quantity = $('input[name=\'filter_quantity\']').attr('value');
	
	if (filter_quantity) {
		url += '&filter_quantity=' + encodeURIComponent(filter_quantity);
	}
	
	var filter_status = $('select[name=\'filter_status\']').attr('value');
	
	if (filter_status != '*') {
		url += '&filter_status=' + encodeURIComponent(filter_status);
	}	

	location = url;
}
//--></script> 
<script type="text/javascript"><!--
$('#form input').keydown(function(e) {
	if (e.keyCode == 13) {
		filter();
	}
});
//--></script> 
<script type="text/javascript"><!--
$('input[name=\'filter_name\']').autocomplete({
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
		$('input[name=\'filter_name\']').val(ui.item.label);
						
		return false;
	},
	focus: function(event, ui) {
      	return false;
   	}
});

$('input[name=\'filter_model\']').autocomplete({
	delay: 500,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_model=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item.model,
						value: item.product_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		$('input[name=\'filter_model\']').val(ui.item.label);
						
		return false;
	},
	focus: function(event, ui) {
      	return false;
   	}
});
//--></script> 
<?php echo $footer; ?>