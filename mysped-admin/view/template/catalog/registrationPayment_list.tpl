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
      <h1><img src="view/image/product.png" alt="" /> Registration payments</h1>
      
      <div class="buttons">
        <!--  <a href="<?php echo $insert; ?>" class="button">Insert</a>
          <a onclick="$('#form').attr('action', '<?php echo $copy; ?>'); $('#form').submit();" class="button">Copy</a>-->
          <a onclick="$('form').submit();" class="button">Delete</a>
      </div>
      
    </div>
    <div class="content">
      <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="list">
          <thead>
            <tr>
              <td></td>
              <td width="1" style="text-align: center;">
                  Customer
              </td> 
              <td width="1" style="text-align: center;">
                  email
              </td> 
              <td>
                 Cur C.G.
              </td>
              <td>
                 Req C.G.
              </td>
              <td>
                  Success
              </td>
              <td>
                  Cancel
              </td>
              <td>
                  Ipn
              </td>
              <td>
                  Price
              </td>
              <td class="left">
                  Date added
              </td>
              <td>
                  Status
              </td>
              <td></td>
           </tr>
          </thead>
          <tbody>
            <tr class="filter">
              <td></td>
              <td width="1" style="text-align: center;">
                 <!-- Customer -->
              </td> 
              <td width="1" style="text-align: center;">
                  <input type="text" name="filter_email" value="<?php echo $filter_email; ?>" />
              </td> 
              <td>
                 <!-- Cur C.G. -->
              </td>
              <td>
                <!-- Req C.G. -->
              </td>
              <td>
                  <!--Success -->
              </td>
              <td>
                 <!-- Cancel -->
              </td>
              <td>
                 <!-- Ipn -->
              </td>
              <td>
                <!--  Price -->
              </td>
              <td class="left">
                 <input type="text" name="filter_date_added" value="<?php echo $filter_date_added; ?>" size="12" id="date" />
              </td>
              <td>
                  <select name="filter_status">
 
                      <option value="*"></option>
                      
                      <?php if ($filter_status == 1 ) { ?>
                            <option value="1" selected>Payed</option>
                      <?php } else { ?>
                            <option value="1">Payed</option>
                      <?php } ?>
                      
                      <?php if ($filter_status == 0 ) { ?>
                            <option value="0" selected>Not Payed</option>
                      <?php } else { ?>
                            <option value="0">Not Payed</option>
                      <?php } ?>
                      
                     
                      
                  </select> 
              </td>
              <td class="right"> 
                  <a onclick="filter();" class="button"><?php echo $button_filter; ?></a>
              </td>      
            </tr>
            <?php if (isset($customer_group_payments) ) { ?>
            <?php foreach ($customer_group_payments as $customer_group_payment) { ?>
            <tr>
              <td>
                  <input type="checkbox" name="selected[]" value="<?php echo $customer_group_payment['customer_group_payment_id']; ?>" />
              </td>
              <td class="left">
                  <a href="<?php echo $customer_group_payment['customer']['url']; ?>" target="_blank">
                        <?php echo $customer_group_payment['customer']['company']; ?>
                  </a>
              </td>
              <td class="left">
                  <a href="<?php echo $customer_group_payment['customer']['url']; ?>" target="_blank">
                        <?php echo $customer_group_payment['customer']['email']; ?>
                  </a>
              </td>
              <td class="left">
                  <a href="<?php echo $customer_group_payment['customer']['url']; ?>" target="_blank">
                        <?php echo $customer_group_payment['customer_group']['name']; ?>
                  </a>
              </td>
              <td>
             <?php echo $customer_group_payment['req_customer_group']['name'];  ?>
              </td>
              <td>
                  <div style=" color: green;">
                  <?php echo $customer_group_payment['date_success']; ?>
                  </div>
              </td>
              
              <td>
                  <div style=" color: blue;">
                  <?php echo $customer_group_payment['date_cancel']; ?>
                  </div>
              </td>
              <td>
                  <div style=" color: green;">
                  <?php echo $customer_group_payment['date_ipn']; ?>
                  </div>
              </td>
              <td>
                  <?php echo $customer_group_payment['price']; ?>
              </td>
              
              <td>
                  <?php  echo $customer_group_payment['date_inserted'];  ?>
              </td>
         
              <td>
                  
                  <?php  if ( $customer_group_payment['status'] == 0 ) { ?>
                  <div style=" color: red;">
                  Not Payed
                  </div>
                  <?php } else { ?>
                  <div style=" color: green;">
                  Payed
                  </div>
                  <?php } ?>
              </td>
              
              <td class="right">
                  <?php foreach ($customer_group_payment['action'] as $action) { ?>
                      <a class="button" href="<?php echo $action['href']; ?>">View</a> 
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
function filter() {
	url = 'index.php?route=catalog/registrationPayment&token=<?php echo $token; ?>';
	
	var filter_email = $('input[name=\'filter_email\']').attr('value');
	
	if (filter_email) {
		url += '&filter_email=' + encodeURIComponent(filter_email);
	}
	
	//var filter_status = $('input[name=\'filter_status\']').attr('value');
	
	//if (filter_status) {
	//	url += '&filter_status=' + encodeURIComponent(filter_status);
	//}
        
	var filter_status = $('select[name=\'filter_status\']').attr('value');
        
	if (filter_status != '*') {
		url += '&filter_status=' + encodeURIComponent(filter_status); 
	}
	
	var filter_date_added = $('input[name=\'filter_date_added\']').attr('value');
	
	if (filter_date_added) {
		url += '&filter_date_added=' + encodeURIComponent(filter_date_added);
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
<script type="text/javascript"><!--
$(document).ready(function() {
	$('#date').datepicker({dateFormat: 'yy-mm-dd'});
});
//--></script>
<?php echo $footer; ?>