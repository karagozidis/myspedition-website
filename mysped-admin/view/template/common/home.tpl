<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_install) { ?>
  <div class="warning"><?php echo $error_install; ?></div>
  <?php } ?>
  <?php if ($error_image) { ?>
  <div class="warning"><?php echo $error_image; ?></div>
  <?php } ?>
  <?php if ($error_image_cache) { ?>
  <div class="warning"><?php echo $error_image_cache; ?></div>
  <?php } ?>
  <?php if ($error_cache) { ?>
  <div class="warning"><?php echo $error_cache; ?></div>
  <?php } ?>
  <?php if ($error_download) { ?>
  <div class="warning"><?php echo $error_download; ?></div>
  <?php } ?>
  <?php if ($error_logs) { ?>
  <div class="warning"><?php echo $error_logs; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/home.png" alt="" /> <?php echo $heading_title; ?></h1>
    </div>
    <div class="content">
      
   <table>
    <tr >
     <td style="padding: 10px;" valign="top">     
        
      <div class="dashboard-heading">
          <a href="<?php echo $freightListUrl; ?>" style="text-decoration: none" > Latest 20 Freighs </a>
      </div>  
         <table style="text-align:center;" class="dashboard-content">
          <thead>
            <tr style="font-weight:bold;">            
              <td class="left">
                Loading date
              </td>
               <td>
                 Trailer 
              </td>
              <td>
                Loading country
              </td>
              <td>
                Offloading country
              </td>
            </tr>
          </thead>
          <tbody>
            <?php if ($freights) { ?>
            <?php foreach ($freights as $product) { ?>
            <tr>
              <!--<td class="center"><img src="image/freight.png" width="25" height="25" alt="<?php echo $product['name']; ?>" style="padding: 1px; border: 1px solid #DDDDDD;" /></td>-->
              <td class="left">
                  <?php echo $product['loading_date']; ?>
              </td>
              <td>
                  <?php  echo $product['trailer']['name']  ?></td>
              <td class="left">            
                  <?php  if ($product['loading_country'] != null ) { ?>
                  <img src="image/flags/<?php echo strtolower($product['loading_country']['iso_code_2']); ?>.png">
                  <?php  echo $product['loading_country']['name']; ?>
                  <?php } ?>
              </td>
              <td class="left">
                   <?php  if ($product['offloading_country'] != null ) { ?>
                  <img src="image/flags/<?php echo strtolower($product['offloading_country']['iso_code_2']); ?>.png">
                  <?php  echo $product['offloading_country']['name']; ?>
                  <?php } ?>                                 
              </td>
              <td class="right">
                  <a class="button" style="padding: 0px 5px 0px 5px;" href="?route=catalog/freight/update&product_id=<?php echo $product['product_id']; ?>&customer_id=<?php echo $customer_id; ?>&token=<?php echo $token; ?>">Edit</a> 
                </td>
            </tr>
            <?php } ?>
            <?php } else { ?>
            <tr>
              <td class="center" colspan="11"><?php echo $text_no_results; ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table> 
        
      </td>
      <td style="padding: 10px;" valign="top" > 
        
      <div class="dashboard-heading">
          <a href="<?php echo $truckListUrl; ?>" style="text-decoration: none" > Latest 20 trucks </a>
      </div>  
      
         <table style="text-align:center;" class="dashboard-content">
          <thead>
            <tr style="font-weight:bold;">            
              <td class="left">
                Loading date
              </td>
               <td>
                 Trailer 
              </td>
              <td>
                Loading country
              </td>
              <td>
                Offloading country
              </td>
            </tr>
          </thead>
          <tbody>
            <?php if ($trucks) { ?>
            <?php foreach ($trucks as $product) { ?>
            <tr>
              <!--<td class="center"><img src="image/freight.png" width="25" height="25" alt="<?php echo $product['name']; ?>" style="padding: 1px; border: 1px solid #DDDDDD;" /></td>-->
              <td class="left">
                  <?php echo $product['loading_date']; ?>
              </td>
              <td>
                  <?php  echo $product['trailer']['name']  ?></td>
              <td class="left">            
                  <?php  if ($product['loading_country'] != null ) { ?>
                  <img src="image/flags/<?php echo strtolower($product['loading_country']['iso_code_2']); ?>.png">
                  <?php  echo $product['loading_country']['name']; ?>
                  <?php } ?>
              </td>
              <td class="left">
                   <?php  if ($product['offloading_country'] != null ) { ?>
                  <img src="image/flags/<?php echo strtolower($product['offloading_country']['iso_code_2']); ?>.png">
                  <?php  echo $product['offloading_country']['name']; ?>
                  <?php } ?>                                 
              </td>
              <td class="right">
                  <a class="button" style="padding: 0px 5px 0px 5px;" href="?route=catalog/freight/update&product_id=<?php echo $product['product_id']; ?>&customer_id=<?php echo $customer_id; ?>&token=<?php echo $token; ?>">Edit</a> 
                </td>
            </tr>
            <?php } ?>
            <?php } else { ?>
            <tr>
              <td class="center" colspan="11"><?php echo $text_no_results; ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>  
       
      </td>
      <td style="padding: 10px;" valign="top" >
      
      <div class="dashboard-heading">
          <a href="<?php echo $productsListUrl; ?>" style="text-decoration: none" >  Latest 18 Products </a>
      </div>  
        <table style="text-align:center;" class="dashboard-content">
          <thead>
            <tr  style="font-weight:bold;" >
              <td class="center">Image</td>
              <td class="left">
                Name
              </td>
            <!--  <td class="left">
              Price
              </td>
              <td class="right">
              Quantity
              </td>-->
              <td class="left">
               Status
              </td>
              <td>
              Customer
              </td>
              <td>
              Date added
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
              <td class="center"><img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" style="padding: 1px; border: 1px solid #DDDDDD;" /></td>
              <td class="left"><?php echo $product['name']; ?></td>
            <!--  <td class="left"><?php if ($product['special']) { ?>
                <span style="text-decoration: line-through;"><?php echo $product['price']; ?></span><br/>
                <span style="color: #b00;"><?php echo $product['special']; ?></span>
                <?php } else { ?>
                <?php echo $product['price']; ?>
                <?php } ?></td>
              <td class="right"><?php if ($product['quantity'] <= 0) { ?>
                <span style="color: #FF0000;"><?php echo $product['quantity']; ?></span>
                <?php } elseif ($product['quantity'] <= 5) { ?>
                <span style="color: #FFA500;"><?php echo $product['quantity']; ?></span>
                <?php } else { ?>
                <span style="color: #008000;"><?php echo $product['quantity']; ?></span>
                <?php } ?></td>  -->
              <td class="left">
                  <?php echo $product['status']; ?>
              </td>
                <td>
                    <a href="<?php echo $product['customer_url']; ?>" target="_blank" >
                        <?php echo $product['customer_name']; ?>
                    </a>
                </td>
                <td>
                    <?php echo $product['date_added']; ?>
                </td>
              <td class="right">
                <?php foreach ($product['action'] as $action) { ?>
                <a class="button" style="padding: 0px 2px 0px 2px;" href="<?php echo $action['href']; ?>"><?php echo $action['text']; ?></a> 
                <?php } ?>
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
          
          
      </td>
      
     </tr>
     </table>
        
     
        
     <div style="clear:both;">
        <div class="dashboard-heading" style="cursor:pointer;" title="Latest Customers">
         <a href="<?php echo $customersListUrl; ?>" style="text-decoration: none" >  Latest Customers <a/>
        </div>
        <div class="dashboard-content">
          <table class="list">
            <thead>
              <tr>
                <td>Company</td>
                <td class="left"><?php echo $this->language->get('column_name'); ?></td>
                <td class="left"><?php echo $this->language->get('column_email'); ?></td>
		<td class="left"><?php echo $this->language->get('column_customer_group'); ?></td>
                <td class="left"><?php echo $this->language->get('column_status'); ?></td>
                <td class="left"><?php echo $this->language->get('column_approved'); ?></td>
                <td class="left"><?php echo $this->language->get('column_date_added'); ?></td>
		<td class="left"><?php echo $this->language->get('column_action'); ?></td>
              </tr>
            </thead>
			<?php if ($this->user->hasPermission('access', 'sale/customer')) { ?>
            <tbody>
              <?php if ($customers) { ?>
              <?php foreach ($customers as $customer) { ?>
              <tr>
                <td class="left"><?php echo $customer['company']; ?></td>
                <td class="left"><?php echo $customer['name']; ?></td>
                <td class="left"><?php echo $customer['email']; ?></td>
		<td class="left">
                    <?php echo $customer['customer_group']; ?>
                </td> 
                <td class="left">
                    <?php if ( $customer['status'] == 1 ) { echo 'Yes'; ?>
                    <?php } else { echo 'No'; } ?>
                </td>
                <td class="left">
                    <?php if ( $customer['approved'] == 1 ) { echo 'Yes'; ?>
                    <?php } else { echo 'No'; } ?>
                </td>
                <td class="left">
                    <span style="cursor:help;" title="<?php echo date($this->language->get('date_format_long'), strtotime($customer['date_added'])); ?>"><?php echo date($this->language->get('date_format_short'), strtotime($customer['date_added'])); ?></span> <span style="color:#7b7b7b"><?php echo date($this->language->get('time_format'), strtotime($customer['date_added'])); ?></span>
                </td>
				<?php if ($this->user->hasPermission('modify', 'sale/customer')) { ?>
                                <td class="left"> <a class="button" style="padding: 0px 2px 0px 2px;" href="<?php echo $this->url->link('sale/customer/update', 'token=' . $this->session->data['token'] . '&customer_id=' . $customer['customer_id'], 'SSL'); ?>"><?php echo $this->language->get('text_edit'); ?></a> </td>
				<?php } else { ?>
				<td class="left"><div class="warning" title="<?php echo $this->language->get('error_permission'); ?>" style="margin:0;">[ <?php echo $this->language->get('text_edit'); ?> ]</div></td>
				<?php } ?>
              </tr>
              <?php } ?>
              <?php } ?>
            </tbody>
			<?php } else { ?>
			<?php $this->load->language('error/permission'); ?>
			<tbody>
			  <tr>
			    <td class="left" colspan="8"><div class="warning"><?php echo $this->language->get('text_permission'); ?></div></td>
			  </tr>
			</tbody>
			<?php } ?>
          </table>
        </div>
     </div>  
     <br> 
        
        
        
     <!-- <div class="overview">
        <div class="dashboard-heading"><?php echo $text_overview; ?></div>
        <div class="dashboard-content">
          <table>
            <tr>
              <td><?php echo $text_total_sale; ?></td>
              <td><?php echo $total_sale; ?></td>
            </tr>
            <tr>
              <td><?php echo $text_total_sale_year; ?></td>
              <td><?php echo $total_sale_year; ?></td>
            </tr>
            <tr>
              <td><?php echo $text_total_order; ?></td>
              <td><?php echo $total_order; ?></td>
            </tr>
            <tr>
              <td><?php echo $text_total_customer; ?></td>
              <td><?php echo $total_customer; ?></td>
            </tr>
            <tr>
              <td><?php echo $text_total_customer_approval; ?></td>
              <td><?php echo $total_customer_approval; ?></td>
            </tr>
            <tr>
              <td><?php echo $text_total_review_approval; ?></td>
              <td><?php echo $total_review_approval; ?></td>
            </tr>
            <tr>
              <td><?php echo $text_total_affiliate; ?></td>
              <td><?php echo $total_affiliate; ?></td>
            </tr>
            <tr>
              <td><?php echo $text_total_affiliate_approval; ?></td>
              <td><?php echo $total_affiliate_approval; ?></td>
            </tr>
          </table>
        </div>
      </div> -->
     <!-- <div class="statistic">
        <div class="range"><?php echo $entry_range; ?>
          <select id="range" onchange="getSalesChart(this.value)">
            <option value="day"><?php echo $text_day; ?></option>
            <option value="week"><?php echo $text_week; ?></option>
            <option value="month"><?php echo $text_month; ?></option>
            <option value="year"><?php echo $text_year; ?></option>
          </select>
        </div>
        <div class="dashboard-heading"><?php echo $text_statistics; ?></div>
        <div class="dashboard-content">
          <div id="report" style="width: 390px; height: 170px; margin: auto;"></div>
        </div>
      </div> -->
     <!-- <div class="latest">
        <div class="dashboard-heading"><?php echo $text_latest_10_orders; ?></div>
        <div class="dashboard-content">
          <table class="list">
            <thead>
              <tr>
                <td class="right"><?php echo $column_order; ?></td>
                <td class="left"><?php echo $column_customer; ?></td>
                <td class="left"><?php echo $column_status; ?></td>
                <td class="left"><?php echo $column_date_added; ?></td>
                <td class="right"><?php echo $column_total; ?></td>
                <td class="right"><?php echo $column_action; ?></td>
              </tr>
            </thead>
            <tbody>
              <?php if ($orders) { ?>
              <?php foreach ($orders as $order) { ?>
              <tr>
                <td class="right"><?php echo $order['order_id']; ?></td>
                <td class="left"><?php echo $order['customer']; ?></td>
                <td class="left"><?php echo $order['status']; ?></td>
                <td class="left"><?php echo $order['date_added']; ?></td>
                <td class="right"><?php echo $order['total']; ?></td>
                <td class="right"><?php foreach ($order['action'] as $action) { ?>
                  [ <a href="<?php echo $action['href']; ?>"><?php echo $action['text']; ?></a> ]
                  <?php } ?></td>
              </tr>
              <?php } ?>
              <?php } else { ?>
              <tr>
                <td class="center" colspan="6"><?php echo $text_no_results; ?></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div> -->
    </div>
  </div>
</div>
<!--[if IE]>
<script type="text/javascript" src="view/javascript/jquery/flot/excanvas.js"></script>
<![endif]--> 
<script type="text/javascript" src="view/javascript/jquery/flot/jquery.flot.js"></script> 
<script type="text/javascript"><!--
function getSalesChart(range) {
	$.ajax({
		type: 'get',
		url: 'index.php?route=common/home/chart&token=<?php echo $token; ?>&range=' + range,
		dataType: 'json',
		async: false,
		success: function(json) {
			var option = {	
				shadowSize: 0,
				lines: { 
					show: true,
					fill: true,
					lineWidth: 1
				},
				grid: {
					backgroundColor: '#FFFFFF'
				},	
				xaxis: {
            		ticks: json.xaxis
				}
			}

			$.plot($('#report'), [json.order, json.customer], option);
		}
	});
}

getSalesChart($('#range').val());
//--></script> 
<?php echo $footer; ?>