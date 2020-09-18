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
      <h1><img src="view/image/product.png" alt="" /> <?php echo $heading_title; ?></h1>
      
      <div class="buttons">
          <a href="<?php echo $insert; ?>" class="button">Insert</a>
          <a onclick="$('#form').attr('action', '<?php echo $copy; ?>'); $('#form').submit();" class="button">Copy</a>
          <a onclick="$('form').submit();" class="button">Delete</a>
      </div>
      
    </div>
    <div class="content">
      <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="list">
          <thead>
            <tr>
              <td width="1" style="text-align: center;">
                  <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
              </td>  
              <td>
                 Date added 
              </td>
              <td class="left">
                <?php if ($sort == 'pd.name') { ?>
                <a href="<?php echo $sort_name; ?>" class="<?php echo strtolower($order); ?>">Loading date</a>
                <?php } else { ?>
                <a href="<?php echo $sort_name; ?>">Loading date</a>
                <?php } ?>
              </td>
              <td>
                 Trailer 
              </td>
              <td class="left"><?php if ($sort == 'p.model') { ?>
                <a href="<?php echo $sort_model; ?>" class="<?php echo strtolower($order); ?>">Loading country</a>
                <?php } else { ?>
                <a href="<?php echo $sort_model; ?>">Loading country</a>
                <?php } ?>
              </td>
               <td class="left">
                <a href="#">Region / State</a>
               </td>
              <td class="left"><?php if ($sort == 'p.price') { ?>
                <a href="<?php echo $sort_price; ?>" class="<?php echo strtolower($order); ?>">City / area</a>
                <?php } else { ?>
                <a href="<?php echo $sort_price; ?>">City / area</a>
                <?php } ?>
              </td>
              <td class="right">
                <?php if ($sort == 'p.quantity') { ?>
                <a href="<?php echo $sort_quantity; ?>" class="<?php echo strtolower($order); ?>">Offloading country</a>
                <?php } else { ?>
                <a href="<?php echo $sort_quantity; ?>">Offloading country </a>
                <?php } ?>
              </td>
              <td class="left">
                <a href="#">region state</a>
              </td>
              <td class="left">
                <?php if ($sort == 'p.status') { ?>
                <a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>">City area</a>
                <?php } else { ?>
                <a href="<?php echo $sort_status; ?>">City area</a>
                <?php } ?>
              </td>
              <td>
                  Company
              </td>
              <td>
                  Email
              </td>
              <td class="right"><?php echo $column_action; ?></td>
            </tr>
          </thead>
          <tbody>
              
          <tr class="filter">
              <td></td>
              <td width="1" style="text-align: center;">
                  <input type="text" name="filter_date_added" value="<?php echo $filter_date_added; ?>" size="12" id="date" />
                 <!-- Customer -->
              </td> 
              <td>
                 <input type="text" name="filter_loading_date" value="<?php echo $filter_loading_date; ?>" size="12" id="date" />
              </td>
              <td width="1" style="text-align: center;">
                 <!-- <input type="text" name="filter_email" value="<?php echo $filter_email; ?>" />-->
              </td> 
              <td>
                  
                  <select name="filter_loading_country" style="width: 100px;" >
                       <option value="*">  </option>
                 <?php  foreach($countries as $country) { ?>
                    <?php if($filter_loading_country == $country['country_id'] ) { ?>
                        <option value="<?php echo $country['country_id']; ?>" selected>
                            <?php echo $country['name']; ?>
                        </option>
                    <?php } else { ?>
                        <option value="<?php echo $country['country_id']; ?>">
                            <?php echo $country['name']; ?>
                        </option>
                    <?php } ?>
                 <?php } ?>
                 </select>
                 <!-- Cur C.G. -->
              </td>
              <td>
                <!-- Req C.G. -->
              </td>
              <td>
                  <!--Success -->
              </td>
              <td>
                 <select name="filter_offloading_country" style="width: 100px;" >
                       <option value="*">  </option>
                 <?php  foreach($countries as $country) { ?>
                 
                   <?php if($filter_offloading_country == $country['country_id'] ) { ?>
                        <option value="<?php echo $country['country_id']; ?>" selected>
                            <?php echo $country['name']; ?>
                        </option>
                    <?php } else { ?>  
                        <option value="<?php echo $country['country_id']; ?>">
                            <?php echo $country['name']; ?>
                        </option>
                    <?php } ?>
                    
                 <?php } ?>
                 </select>
              </td>
              <td>
                 <!-- Ipn -->
              </td>
              <td>
                <!--  Price -->
              </td>
              <td class="left">               
              </td>
              <td>
                  <input type="text" name="filter_email" value="<?php echo $filter_email; ?>" />
              </td>
              <td class="right"> 
                  <a onclick="filter();" class="button"><?php echo $button_filter; ?></a> 
              </td>      
            </tr>  
              
              
            <?php if ($products) { ?>
            <?php foreach ($products as $product) { ?>
            <tr>
              <td style="text-align: center;"><?php if ($product['selected']) { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $product['product_id']; ?>" checked="checked" />
                <?php } else { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $product['product_id']; ?>" />
                <?php } ?>
              </td> 
              <td class="left">
                  <?php echo $product['date_added']; ?>
              </td>
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
              <td class="left">
                  <?php echo $product['loading_city']; ?>
              </td>
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
              <td class="left">
                  <?php echo $product['offloading_city']; ?>
              </td>
              <td>
                  <a href="?route=sale/customer/update&token=ec6b700cfe10b072579d2c53481ee426&customer_id=<?php echo $product['owner']['customer_id']; ?>" target="_blank">
                    <?php echo $product['owner']['company']; ?>
                  </a>
              </td>
              <td>
                  <a href="?route=sale/customer/update&token=ec6b700cfe10b072579d2c53481ee426&customer_id=<?php echo $product['owner']['customer_id']; ?>" target="_blank">
                    <?php echo $product['owner']['email']; ?>
                  </a>
              </td>
              <td class="right">
                  <?php foreach ($product['action'] as $action) { ?>
                [ <a href="<?php echo $action['href']; ?>">Edit</a> ]
                <?php } ?>
              </td>
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
$(document).ready(function() {
	$('#date').datepicker({dateFormat: 'yy-mm-dd'});
});
//--></script>

<script type="text/javascript"><!--
function filter() {
	url = 'index.php?route=catalog/freight&token=<?php echo $token; ?>';
	
	var filter_email = $('input[name=\'filter_email\']').attr('value');
	if (filter_email) {
		url += '&filter_email=' + encodeURIComponent(filter_email);
	}
	
        var filter_loading_country = $('select[name=\'filter_loading_country\']').attr('value');
	if (filter_loading_country != '*') {
		url += '&filter_loading_country=' + encodeURIComponent(filter_loading_country); 
	}  

        var filter_offloading_country = $('select[name=\'filter_offloading_country\']').attr('value');
	if (filter_offloading_country != '*') {
		url += '&filter_offloading_country=' + encodeURIComponent(filter_offloading_country); 
	}  
 
	var filter_date_added = $('input[name=\'filter_date_added\']').attr('value');
	if (filter_date_added) {
		url += '&filter_date_added=' + encodeURIComponent(filter_date_added);
	}

        var filter_loading_date = $('input[name=\'filter_loading_date\']').attr('value');
	if (filter_loading_date) {
		url += '&filter_loading_date=' + encodeURIComponent(filter_loading_date);
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