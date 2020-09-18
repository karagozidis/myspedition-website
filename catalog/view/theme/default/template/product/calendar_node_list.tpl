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
  
  <h1><img src="image/calendar.png" width="30" /> <?php echo $heading_title; ?></h1>
    <div class="buttons">
        <a href="<?php echo $calendarLink; ?>" class="button">Back to Calendar</a>  
    </div>
  <div class="box1">
    <div class="heading">
        <h1> <img src="image/note.png" width="25" alt="" /> Notes</h1>
    </div>
      <div class="content1" style="min-height: 0px;">
      <form action="" method="post" enctype="multipart/form-data" id="form">
        <table class="list">
          <thead>
            <tr> 
               <td class="left">
                    Date
               </td>
               <td class="left">
                    Title
               </td>
              <!-- <td>
                    Text
               </td>-->
               <td></td>
            </tr>
          </thead>
          <tbody>
          
            <?php if ($customers) { ?>
            <?php foreach ($customers as $customer) { ?>
            <tr>  
              <td>
                  <?php echo $customer['date_refers']; ?>
              </td>
               <td>
                  <?php echo $customer['title']; ?>
              </td>
               <!--<td>
                  <?php echo $customer['description']; ?>
              </td> -->
              <td  style="text-align: right;">
                  <a href="<?php echo $customer['action']['href']; ?>" class="button" >Edit</a>
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
      <!--<div class="pagination"><?php echo $pagination; ?></div>-->
    </div>
  </div>
  
  
  
  
  
   <div class="box1">
    <div class="heading">
        <h1><img src="image/freight.png" width="25" alt="" /> Freights</h1>
    </div>
    <div class="content1" style="min-height: 0px;">
      <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="list1">
          <thead>
            <tr>          
              <td class="center"></td>
              <td class="left"><?php if ($sort == 'pd.name') { ?>
                <a href="<?php echo $sort_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $loading_date_text; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_name; ?>"><?php echo $loading_date_text; ?></a>
                <?php } ?></td>
              <td>Est</td>
               <td>
                 <?php echo $trailer_text; ?> 
              </td>
              <td>
                  NO of trucks
              </td>
              <td class="left"><?php if ($sort == 'p.model') { ?>
                <a href="<?php echo $sort_model; ?>" class="<?php echo strtolower($order); ?>"><?php echo $loading_country_text; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_model; ?>"><?php echo $loading_country_text; ?></a>
                <?php } ?></td>
               <td class="left">
                <a href="#"><?php echo $region_state_text; ?></a>
                </td>
              <td class="left"><?php if ($sort == 'p.price') { ?>
                <a href="<?php echo $sort_price; ?>" class="<?php echo strtolower($order); ?>"><?php echo $city_area_text; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_price; ?>"><?php echo $city_area_text; ?></a>
                <?php } ?></td>
                <td class="right"><?php if ($sort == 'p.quantity') { ?>
                <a href="<?php echo $sort_quantity; ?>" class="<?php echo strtolower($order); ?>"><?php echo $offloading_country_text; ?> </a>
                <?php } else { ?>
                <a href="<?php echo $sort_quantity; ?>"><?php echo $offloading_country_text; ?> </a>
                <?php } ?>
                </td>
                <td class="left">
                <a href="#"><?php echo $region_state_text; ?></a>
                </td>
              <td class="left"><?php if ($sort == 'p.status') { ?>
                <a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $city_area_text; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_status; ?>"><?php echo $city_area_text; ?></a>
                <?php } ?>
              </td>
              <td class="right"></td>
            </tr>
          </thead>
          <tbody>
            <?php if ($freights) { ?>
            <?php foreach ($freights as $product) { ?>
            <tr>
              <td class="center"><img src="image/freight.png" width="25" height="25" alt="<?php echo $product['name']; ?>" style="padding: 1px; border: 1px solid #DDDDDD;" /></td>
              <td class="left">
                  <?php echo $product['loading_date']; ?>
              </td>
              <td>
                   <i> +-<?php echo $product['est_date']; ?></i>
              </td>
              <td><?php  echo $product['trailer']['name'];  ?></td>
              <td><?php  echo $product['number_of_trucks'];  ?></td>
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

              <td class="right"><?php foreach ($product['action'] as $action) { ?>
                  <a class="button" href="<?php echo $action['href']; ?>">Edit</a> 
                <?php } ?></td>
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
      <!--<div class="pagination"><?php echo $pagination; ?></div> -->
    </div>
  </div>
  
  
  
  
  
    <div class="box1">
    <div class="heading">
        <h1><img src="image/truck.png" width="25" alt="" /> Trucks</h1>
    </div>
    <div class="content1" style="min-height: 0px;">
      <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="list1">
          <thead>
            <tr>
              <td class="center"></td>
              <td class="left"><?php if ($sort == 'pd.name') { ?>
                <a href="<?php echo $sort_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $loading_date_text; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_name; ?>"><?php echo $loading_date_text; ?></a>
                <?php } ?></td>
               <td>Est</td>
               <td>
                 <?php echo $trailer_text; ?> 
              </td>
              <td>
                  NO of trucks
              </td>
              <td class="left"><?php if ($sort == 'p.model') { ?>
                <a href="<?php echo $sort_model; ?>" class="<?php echo strtolower($order); ?>"><?php echo $loading_country_text; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_model; ?>"><?php echo $loading_country_text; ?></a>
                <?php } ?></td>
                <td class="left">
                <a href="#"><?php echo $region_state_text; ?></a>
                </td>
              <td class="left"><?php if ($sort == 'p.price') { ?>
                <a href="<?php echo $sort_price; ?>" class="<?php echo strtolower($order); ?>"><?php echo $city_area_text; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_price; ?>"><?php echo $city_area_text; ?></a>
                <?php } ?></td>
              <td class="right"><?php if ($sort == 'p.quantity') { ?>
                <a href="<?php echo $sort_quantity; ?>" class="<?php echo strtolower($order); ?>"><?php echo $offloading_country_text; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_quantity; ?>"><?php echo $offloading_country_text; ?></a>
                <?php } ?></td>
                <td class="left">
                <a href="#"><?php echo $region_state_text; ?></a>
                </td>
              <td class="left"><?php if ($sort == 'p.status') { ?>
                <a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $city_area_text; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_status; ?>"><?php echo $city_area_text; ?></a>
                <?php } ?></td>
              <td class="right"></td>
            </tr>
          </thead>
          <tbody>
   
            <?php if ($trucks) { ?>
            <?php foreach ($trucks as $product) { ?>
            <tr>
              <td class="center"><img src="image/truck.png" width="25" height="25" alt="<?php echo $product['name']; ?>" style="padding: 1px; border: 1px solid #DDDDDD;" /></td>
              <td class="left"><?php echo $product['loading_date']; ?></td>
              <td>
                   <i> +-<?php echo $product['est_date']; ?></i>
              </td>
              <td><?php  echo $product['trailer']['name'];  ?></td>
              <td><?php  echo $product['number_of_trucks'];  ?></td>
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
              <td class="right"><?php foreach ($product['action'] as $action) { ?>
                 <a class="button" href="<?php echo $action['href']; ?>">Edit</a> 
                <?php } ?></td>
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
      <!--<div class="pagination"><?php echo $pagination; ?></div>-->
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