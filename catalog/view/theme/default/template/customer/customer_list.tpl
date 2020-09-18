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
  
  <h1><img src="image/company.png" width="25" /> <?php echo $heading_title; ?></h1>
  <div class="content">
      <form method="get" enctype="multipart/form-data" action="<?php echo $searchByNameAction; ?>">
          <input type="hidden" name="route" value="<?php echo $route; ?>">
          <?php if( isset($country_id) ) { ?>
                <input type="hidden" name="country_id" value="<?php echo $country_id; ?>">
          <?php } ?>
            <table style="margin: 10px;">
                <tr>
                    <td style="font-size: 130%;color: #F16100;">
                        Company Name:
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </td>
                    <td>
                        <input type="text" name="filter_company" size="70" value="<?php echo $filter_company; ?>">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </td>
                    <td>
                        <input type="submit" value="Search" class="button">
                    </td>
                </tr>
            </table>
      </form>
  </div>
  <div class="box1">
    <div class="heading">
       <!-- <h2> Randomly selected companies </h2> -->
      <?php if ( isset($country['name']) ) { ?>
        <div class="buttons1">
             <?php echo $country_selected_text; ?> <img src="image/flags/<?php echo strToLower($country['iso_code_2']); ?>.png" >
             <?php echo $country['name'] ?>  
             <a href="?route=customer/customer/main" class="button">
                   <?php echo $back_to_map_text; ?>
             </a>     
        </div>
      <?php } else { ?>
        <div class="buttons1">
             <a href="?route=customer/customer/main" class="button">
                   <?php echo $back_to_map_text; ?>
             </a>  
        </div>
      <?php } ?>
      
    </div>
    <div class="content1">
        
      <?php if ($customers) { ?>  
        <h3 style="padding-left: 20px;"> Randomly selected companies... </h3>
      <?php } ?>
      
      <form action="" method="post" enctype="multipart/form-data" id="form">
        <table class="list">
          <thead>
            <tr> 
               <td></td>
               <td style="text-align: center;"></td>
               <td class="left">
                    <?php echo $country_text; ?> 
               </td>
               <td class="left">
                    <?php echo $company_name_text; ?>
               </td>
              <td>
              Type
              </td>
              <td class="left">
                    <?php echo $manager_name_text; ?>
              </td>
              <!--<td class="left">
                  
                    <?php echo $description_text; ?>                         
              </td>  -->     
              <td class="left">                    
              </td>
            </tr>
          </thead>
          <tbody>
          
            <?php if ($customers) { ?>
            <?php foreach ($customers as $customer) { ?>
            <tr>  
              <td>
                   <img src="<?php echo $customer['cg_image']; ?>" width="40">
              </td>
              <td style="text-align: center;">
                  <?php if( $customer['thumb'] != NULL ) { ?>
                        <img src="<?php echo $customer['thumb']; ?>">
                  <?php } ?>
              </td>
              <td class="left">
                  <img src="image/flags/<?php echo strtolower( $customer['country']['iso_code_2'] ); ?>.png">  
                  <?php echo $customer['country']['name']; ?>
              </td>       
              <td>
                  <?php if( $customer['verified'] == 3 ) { ?>
                  <img src="image/getverified.png" width="20">
                  <?php } ?>
                  <?php echo $customer['company']; ?>
                   
                <!--  <?php if( $customer['customer_group']['registration_price'] != 0 ) { ?>
                  <img src="image/premium.png" width="17">
                  <?php } ?>-->
              </td>
              <td>
                  <?php echo $customer['company_type']['name']; ?>
              </td>
              <td class="left"><?php echo $customer['name']; ?></td>
              <!--<td class="left">                
                  <?php echo substr($customer['description'], 0, 100) . " ......";    ?>
              </td>   -->          
              <td class="right">
                  <?php foreach ($customer['action'] as $action) { ?>
                    <a href="<?php echo $action['href']; ?>" class="button"><?php echo $view_text; ?></a> 
                  <?php } ?>
              </td>
            </tr>
            <?php } ?>
            <?php } else { ?>
            <tr>
              <td class="center" colspan="10"><?php echo $text_no_results; ?></td>
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
	
	location = url;
}
//--></script>
<script type="text/javascript"><!--
$(document).ready(function() {
	$('#date').datepicker({dateFormat: 'yy-mm-dd'});
});
//--></script>
<?php echo $footer; ?> 