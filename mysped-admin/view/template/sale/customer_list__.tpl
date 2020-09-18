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
      <h1><img src="view/image/customer.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons">
      <?php if($opc == false) { ?>  
          <a onclick="$('form').attr('action', '<?php echo $approve; ?>'); $('form').submit();" class="button">
              <?php echo $button_approve; ?>
          </a> 
          <a href="<?php echo $insert; ?>" class="button">
              <?php echo $button_insert; ?>
          </a>
          <a onclick="$('form').attr('action', '<?php echo $delete; ?>'); $('form').submit();" class="button">
              <?php echo $button_delete; ?>
          </a>
      <?php } ?>
      </div>
    </div>
    <div class="content">
      <form action="" method="post" enctype="multipart/form-data" id="form">
        <table class="list">
          <thead>
            <tr>
              <td class="right"><?php echo $column_action; ?></td>
              
              <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
              <td>
                    Owner
              </td>
              <td>
              <?php if ($sort == 'company') { ?>
                <a href="<?php echo $sort_company; ?>" class="<?php echo strtolower($order); ?>">Company</a>
                <?php } else { ?>
                <a href="<?php echo $sort_company; ?>">Company</a>
                <?php } ?>  
              </td>
              
              <td class="left">
                  <?php if ($sort == 'name') { ?>
                <a href="<?php echo $sort_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_name; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_name; ?>"><?php echo $column_name; ?></a>
                <?php } ?>
              </td>
              <td class="left"><?php if ($sort == 'c.email') { ?>
                <a href="<?php echo $sort_email; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_email; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_email; ?>"><?php echo $column_email; ?></a>
                <?php } ?>
              </td>
              <td class="left"><?php if ($sort == 'customer_group') { ?>
                <a href="<?php echo $sort_customer_group; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_customer_group; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_customer_group; ?>"><?php echo $column_customer_group; ?></a>
                <?php } ?>
              </td>
              <td class="left"><?php if ($sort == 'c.status') { ?>
                <a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_status; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_status; ?>"><?php echo $column_status; ?></a>
                <?php } ?>
              </td>
              <td class="left"><?php if ($sort == 'c.approved') { ?>
                <a href="<?php echo $sort_approved; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_approved; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_approved; ?>"><?php echo $column_approved; ?></a>
                <?php } ?>
              </td>
              <td class="left">
                  Lg
                  <!--<?php echo $column_login; ?>-->
              </td>
              <td class="left"><?php if ($sort == 'c.ip') { ?>
                <a href="<?php echo $sort_ip; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_ip; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_ip; ?>"><?php echo $column_ip; ?></a>
                <?php } ?>
              </td>
              <td class="left">
               <?php if ($sort == 'c.date_added') { ?>
                <a href="<?php echo $sort_date_added; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_date_added; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_date_added; ?>"><?php echo $column_date_added; ?></a>
                <?php } ?>
              </td>

              <td>Payment status</td>
              <td>Req group</td>      
            </tr>
          </thead>
          <tbody>
            <tr class="filter">
              <td align="right">
                  <a onclick="filter();" class="button"><?php echo $button_filter; ?></a>
              </td>
              <td></td>
              <td>
                
                <?php if($opc == false) { ?>  
                    <select style="width:70px;" name="filter_user"> 
                        <option value="*"></option>
                        <option value="0">Only null</option> 
                          <?php foreach($users as $user) { ?>
                          <?php if($user['user_id'] == $filter_user) { ?>
                               <option value="<?php echo $user['user_id']; ?>" selected>
                                      <?php echo $user['username']?>
                               </option>
                          <?php } else { ?>
                               <option value="<?php echo $user['user_id']; ?>">
                                      <?php echo $user['username']?>
                               </option>
                          <?php } ?>

                          <?php } ?>
                      </select>  
                  <?php } ?>
                  
              </td>
              <td>
                  <input type="text" name="filter_company" value="<?php echo $filter_company; ?>" />
              </td>
              <td>
                  <input type="text" name="filter_name" value="<?php echo $filter_name; ?>" />
              </td>
              <td>
                  <input type="text" name="filter_email" value="<?php echo $filter_email; ?>" />
              </td>
              <td>
                  <select name="filter_customer_group_id">
                  <option value="*"></option>
                  <?php foreach ($customer_groups as $customer_group) { ?>
                  <?php if ($customer_group['customer_group_id'] == $filter_customer_group_id) { ?>
                  <option value="<?php echo $customer_group['customer_group_id']; ?>" selected="selected"><?php echo $customer_group['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $customer_group['customer_group_id']; ?>"><?php echo $customer_group['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select></td>
              <td>
                  <select name="filter_status">
                  <option value="*"></option>
                  <?php if ($filter_status) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <?php } ?>
                  <?php if (!is_null($filter_status) && !$filter_status) { ?>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select>
              </td>
              <td>
                  <select name="filter_approved">
                    <option value="*"></option>
                    <?php if ($filter_approved) { ?>
                    <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                    <?php } else { ?>
                    <option value="1"><?php echo $text_yes; ?></option>
                    <?php } ?>
                    <?php if (!is_null($filter_approved) && !$filter_approved) { ?>
                    <option value="0" selected="selected"><?php echo $text_no; ?></option>
                    <?php } else { ?>
                    <option value="0"><?php echo $text_no; ?></option>
                    <?php } ?>
                  </select>
              </td>
              <td></td>
              <td><input type="text" name="filter_ip" value="<?php echo $filter_ip; ?>" /></td>
              <td><input type="text" name="filter_date_added" value="<?php echo $filter_date_added; ?>" size="12" id="date" /></td>
              
              <td>
                  <select name="filter_payment_status">
                    <option value="*" selected="selected"></option>   
                    <option value="0" <?php if($filter_payment_status == 0) { ?> selected="selected" <?php } ?> >Not required</option>
                    <option value="1" <?php if($filter_payment_status == 1) { ?> selected="selected" <?php } ?> >Pending</option>
                    <option value="2" <?php if($filter_payment_status == 2) { ?> selected="selected" <?php } ?> >Paid</option>
                    <option value="3" <?php if($filter_payment_status == 3) { ?> selected="selected" <?php } ?> >Expiring or expired</option>
                  </select>
              </td>
              <td></td>
            </tr>
            <?php if ($customers) { ?>
            <?php foreach ($customers as $customer) { ?>
            <tr>
              <td class="right">
                <?php foreach ($customer['action'] as $action) { ?>
                [ <a href="<?php echo $action['href']; ?>"><?php echo $action['text']; ?></a> ]
                <?php } ?>
              </td>
              <td style="text-align: center;"><?php if ($customer['selected']) { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $customer['customer_id']; ?>" checked="checked" />
                <?php } else { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $customer['customer_id']; ?>" />
                <?php } ?>
              </td>
              <td>
                  <?php echo $customer['owner']; ?>
              </td>
              <td> <?php echo $customer['company']; ?>  </td>
              <td class="left"><?php echo $customer['name']; ?></td>
              <td class="left"><?php echo $customer['email']; ?></td>
              <td class="left"><?php echo $customer['customer_group']; ?></td>
              <td class="left"><?php echo $customer['status']; ?></td>
              <td class="left"><?php echo $customer['approved']; ?></td>
              <td class="left">
                  <select style="width: 20px;" onchange="((this.value !== '') ? window.open('index.php?route=sale/customer/login&token=<?php echo $token; ?>&customer_id=<?php echo $customer['customer_id']; ?>&store_id=' + this.value) : null); this.value = '';">
                  <option value=""><?php echo $text_select; ?></option>
                  <option value="0"><?php echo $text_default; ?></option>
                  <?php foreach ($stores as $store) { ?>
                  <option value="<?php echo $store['store_id']; ?>"><?php echo $store['name']; ?></option>
                  <?php } ?>
                </select>
              </td>
              <td class="left"><?php echo $customer['ip']; ?></td>
              <td class="left"><?php echo $customer['date_added']; ?></td>

                <td>
                    
                    <?php
                    if (isset($customer['requested_customer_group']['duration']) && $customer['requested_customer_group']['duration'] != 0 ) 
                    {
                        $daysRemaining = $customer['requested_customer_group']['duration'] - $customer['daysPassed']; 
                        if ($daysRemaining <= 3 && $daysRemaining > 0 ) {
                                $customer['payment_status']=3;
                        } else if ($daysRemaining <= 0 ) {
                                $customer['payment_status']=4;
                        }  
                    }
                    
                    ?>
                    
                    <?php if ($customer['payment_status'] == 0) { ?> 
                    <div style="color:gray;"> Not required </div>
                    <?php } else if ($customer['payment_status'] == 1) { ?>
                    <div style="color:red;" > Pending </div>
                    <?php } else if ($customer['payment_status'] == 2) { ?>
                    <div style="color:green;" > Paid </div>
                    <?php } else if ($customer['payment_status'] == 3) { ?>
                    <div style="color:red;" > Expiring in <?php echo $daysRemaining ?> </div>
                    <?php } else if ($customer['payment_status'] == 4) { ?>
                    <div style="color:red;" > Expired </div>
                    <?php } ?>
                </td>
                <td>
                    <?php if ( isset($customer['requested_customer_group']['name']) ) echo $customer['requested_customer_group']['name'];  ?>
                </td>
            </tr>
            <?php } ?>
            <?php } else { ?>
            <tr>
              <td class="center" colspan="14"><?php echo $text_no_results; ?></td>
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
	url = 'index.php?route=sale/customer&token=<?php echo $token; ?>';
	
	var filter_name = $('input[name=\'filter_name\']').attr('value');
	
	if (filter_name) {
		url += '&filter_name=' + encodeURIComponent(filter_name);
	}
	
     	var filter_user = $('select[name=\'filter_user\']').attr('value');
	
	if (filter_user != '*') {
		url += '&filter_user=' + encodeURIComponent(filter_user);
	}
        
        var filter_company = $('input[name=\'filter_company\']').attr('value');
	
	if (filter_company) {
		url += '&filter_company=' + encodeURIComponent(filter_company);
	}
        
	var filter_email = $('input[name=\'filter_email\']').attr('value');
	
	if (filter_email) {
		url += '&filter_email=' + encodeURIComponent(filter_email);
	}
	
	var filter_customer_group_id = $('select[name=\'filter_customer_group_id\']').attr('value');
	
	if (filter_customer_group_id != '*') {
		url += '&filter_customer_group_id=' + encodeURIComponent(filter_customer_group_id);
	}	
	
	var filter_status = $('select[name=\'filter_status\']').attr('value');
	
	if (filter_status != '*') {
		url += '&filter_status=' + encodeURIComponent(filter_status); 
	}	
	
	var filter_approved = $('select[name=\'filter_approved\']').attr('value');
	
	if (filter_approved != '*') {
		url += '&filter_approved=' + encodeURIComponent(filter_approved);
	}	
	
	var filter_ip = $('input[name=\'filter_ip\']').attr('value');
	
	if (filter_ip) {
		url += '&filter_ip=' + encodeURIComponent(filter_ip);
	}
		
	var filter_date_added = $('input[name=\'filter_date_added\']').attr('value');
	
	if (filter_date_added) {
		url += '&filter_date_added=' + encodeURIComponent(filter_date_added);
	}
	
        
        var filter_payment_status = $('select[name=\'filter_payment_status\']').attr('value');
	
	if (filter_payment_status != '*') {
		url += '&filter_payment_status=' + encodeURIComponent(filter_payment_status);
	}
        
	location = url;
}
//--></script>
<script type="text/javascript"><!--
$(document).ready(function() {
	$('#date').datepicker({dateFormat: 'yy-mm-dd'});
});
//--></script>
<?php echo $footer; ?> 