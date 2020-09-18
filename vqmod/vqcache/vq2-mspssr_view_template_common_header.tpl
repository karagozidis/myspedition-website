<!DOCTYPE html>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<head>
<meta charset="UTF-8" />
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; ?>" />
<?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content="<?php echo $keywords; ?>" />
<?php } ?>
<?php foreach ($links as $link) { ?>
<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
<?php } ?>
<link rel="stylesheet" type="text/css" href="view/stylesheet/stylesheet.css" />
<?php foreach ($styles as $style) { ?>
<link rel="<?php echo $style['rel']; ?>" type="text/css" href="<?php echo $style['href']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>
<script type="text/javascript" src="view/javascript/jquery/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="view/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>
<link type="text/css" href="view/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
<script type="text/javascript" src="view/javascript/jquery/tabs.js"></script>
<script type="text/javascript" src="view/javascript/jquery/superfish/js/superfish.js"></script>
<script type="text/javascript" src="view/javascript/common.js"></script>
<?php foreach ($scripts as $script) { ?>
<script type="text/javascript" src="<?php echo $script; ?>"></script>
<?php } ?>
<script type="text/javascript">
//-----------------------------------------
// Confirm Actions (delete, uninstall)
//-----------------------------------------
$(document).ready(function(){
    // Confirm Delete
    $('#form').submit(function(){
        if ($(this).attr('action').indexOf('delete',1) != -1) {
            if (!confirm('<?php echo $text_confirm; ?>')) {
                return false;
            }
        }
    });
    	
    // Confirm Uninstall
    $('a').click(function(){
        if ($(this).attr('href') != null && $(this).attr('href').indexOf('uninstall', 1) != -1) {
            if (!confirm('<?php echo $text_confirm; ?>')) {
                return false;
            }
        }
    });
});
</script>
</head>
<body>
<div id="container">
<div id="header">
  <div class="div1">
    <div class="div2"><img src="view/image/logo.png" title="<?php echo $heading_title; ?>" onclick="location = '<?php echo $home; ?>'" /></div>
    <?php if ($logged) { ?>
    <div class="div3"><img src="view/image/lock.png" alt="" style="position: relative; top: 3px;" />&nbsp;<?php echo $logged; ?></div>
    <?php } ?>
  </div>
  <?php if ($logged) { ?>
  <div id="menu">
    <ul class="left" style="display: none;">
      <li id="dashboard"><a href="<?php echo $home; ?>" class="top"><?php echo $text_dashboard; ?></a></li>
      
      <?php if($this->user->hasPermission('access','catalog/category') || 
      $this->user->hasPermission('access','catalog/product') ||
      $this->user->hasPermission('access','catalog/productRequest') || 
      $this->user->hasPermission('access','catalog/truck') ||
      $this->user->hasPermission('access','catalog/freight') ||
      $this->user->hasPermission('access','catalog/freightOffer') ||
      $this->user->hasPermission('access','catalog/filter') ||
      $this->user->hasPermission('access','catalog/attribute') || 
      $this->user->hasPermission('access','catalog/attribute_group') ||
      $this->user->hasPermission('access','catalog/option') ||
      $this->user->hasPermission('access','catalog/manufacturer') ||
      $this->user->hasPermission('access','catalog/download') ||
      $this->user->hasPermission('access','catalog/review') ||
      $this->user->hasPermission('access','catalog/information')
      ) { ?>
        <li id="catalog"> 
            <a class="top"><?php echo $text_catalog; ?></a>
          <ul>
            <?php if($this->user->hasPermission('access','catalog/category')) { ?>
              <li>
                  <a href="<?php echo $category; ?>"><?php echo $text_category; ?></a>
              </li>
            <?php } ?>
            <?php if($this->user->hasPermission('access','catalog/product')) { ?>
              <li>
                <a href="<?php echo $product; ?>"><?php echo $text_product; ?></a>
              </li>
            <?php } ?>
            <?php if($this->user->hasPermission('access','catalog/productRequest')) { ?>
              <li>
                  <a href="<?php echo $productRequest; ?>">Product Request</a>
              </li>
            <?php } ?>
            <?php if($this->user->hasPermission('access','catalog/truck')) { ?>
              <li>
                  <a href="<?php echo $catalog_truck; ?>">Trucks</a>       
              </li> 
            <?php } ?>
            <?php if($this->user->hasPermission('access','catalog/freight')) { ?>
              <li>
                  <a href="<?php echo $catalog_freight; ?>">Freights</a>
              </li> 
            <?php } ?>
            <?php if($this->user->hasPermission('access','catalog/freightOffer')) { ?>
              <li>
                  <a href="<?php echo $catalog_freight_offer; ?>">Freights Offers</a>
              </li> 
            <?php } ?>
            <?php if($this->user->hasPermission('access','catalog/black_list')) { ?>
              <li>
                  <a href="<?php echo $catalog_black_list; ?>">Black list</a>
              </li> 
            <?php } ?>
            <?php if($this->user->hasPermission('access','catalog/filter')) { ?>
              <li>   
                  <a href="<?php echo $filter; ?>"><?php echo $text_filter; ?></a>
              </li>
             <?php } ?>
            <?php if($this->user->hasPermission('access','catalog/attribute') || 
            $this->user->hasPermission('access','catalog/attribute_group') ) { ?>
              <li>
                  <a class="parent"><?php echo $text_attribute; ?></a>
                      <ul>
                        <?php if($this->user->hasPermission('access','catalog/attribute')) { ?>
                          <li>
                              <a href="<?php echo $attribute; ?>"><?php echo $text_attribute; ?></a>
                          </li>
                         <?php } ?>  
                         <?php if($this->user->hasPermission('access','catalog/attribute_group')) { ?>
                          <li>
                              <a href="<?php echo $attribute_group; ?>"><?php echo $text_attribute_group; ?></a>
                          </li>
                         <?php } ?>
                      </ul>     
              </li>
            <?php } ?>  
            <?php if($this->user->hasPermission('access','catalog/option')) { ?>
              <li><a href="<?php echo $option; ?>"><?php echo $text_option; ?></a></li>
            <?php } ?>
            <?php if($this->user->hasPermission('access','catalog/manufacturer')) { ?>
              <li><a href="<?php echo $manufacturer; ?>"><?php echo $text_manufacturer; ?></a></li>
            <?php } ?>
            <?php if($this->user->hasPermission('access','catalog/download')) { ?>
              <li><a href="<?php echo $download; ?>"><?php echo $text_download; ?></a></li>
            <?php } ?>
            <?php if($this->user->hasPermission('access','catalog/review')) { ?>
              <li><a href="<?php echo $review; ?>"><?php echo $text_review; ?></a></li>
            <?php } ?>
            <?php if($this->user->hasPermission('access','catalog/information')) { ?>
            <li><a href="<?php echo $information; ?>"><?php echo $text_information; ?></a></li>
        <li><a href="<?php echo $testimonial; ?>"><?php echo $text_testimonial; ?></a></li>
            <?php } ?>
          </ul>
        </li>
      <?php } ?>
      <?php if(
        $this->user->hasPermission('access','extension/module') ||
        $this->user->hasPermission('access','extension/excel') || 
        $this->user->hasPermission('access','extension/freightsMailText') || 
        $this->user->hasPermission('access','extension/trucksMailText')  || 
        $this->user->hasPermission('access','extension/warehousesMailText') || 
        $this->user->hasPermission('access','extension/productsMailText') ||  
        $this->user->hasPermission('access','extension/upgradeText') ||
        $this->user->hasPermission('access','extension/upgradeSmallText') ||
        $this->user->hasPermission('access','extension/upgradeLargeText') ||
        $this->user->hasPermission('access','extension/accountUpgradeText') ||
        
        $this->user->hasPermission('access','extension/keywordsText') ||
        $this->user->hasPermission('access','extension/mainDescriptionText') ||
        
        $this->user->hasPermission('access','extension/companyViewText') ||
        $this->user->hasPermission('access','extension/companyViewLargeText') ||
        $this->user->hasPermission('access','extension/shipping') || 
        $this->user->hasPermission('access','extension/payment') ||
        $this->user->hasPermission('access','extension/total') ||
        $this->user->hasPermission('access','extension/feed')
        ) { ?>  
      <li id="extension"><a class="top"><?php echo $text_extension; ?></a>
        <ul>
          <?php if($this->user->hasPermission('access','extension/module')) { ?>  
            <li><a href="<?php echo $module; ?>"><?php echo $text_module; ?></a></li>
          <?php } ?>
          
          <?php if($this->user->hasPermission('access','extension/excel')) { ?>  
            <li><a href="<?php echo $excelExports; ?>">Excel exports</a></li>
          <?php } ?> 
        <?php if($this->user->hasPermission('access','extension/freightsMailText') || 
        $this->user->hasPermission('access','extension/trucksMailText')  || 
        $this->user->hasPermission('access','extension/warehousesMailText') || 
        $this->user->hasPermission('access','extension/productsMailText' ) || 
        $this->user->hasPermission('access','extension/upgradeLargeText' ) || 
        $this->user->hasPermission('access','extension/accountUpgradeText' ) || 
        
        $this->user->hasPermission('access','extension/keywordsText' ) || 
        $this->user->hasPermission('access','extension/mainDescriptionText' ) || 
        
        $this->user->hasPermission('access','extension/upgradeSmallText' ) || 
        $this->user->hasPermission('access','extension/companyViewText') ||
        $this->user->hasPermission('access','extension/companyViewLargeText') ||
        $this->user->hasPermission('access','extension/upgradeText') ) 
        { ?>  
          <li id="system"><a class="parent">Stored Texts</a>
              <ul>
                <?php if($this->user->hasPermission('access','extension/freightsMailText')) { ?>  
                    <li><a href="<?php echo $freightsMailText; ?>">Freights Mail Text</a></li>
                <?php } ?>
                <?php if($this->user->hasPermission('access','extension/trucksMailText')) { ?> 
                    <li><a href="<?php echo $trucksMailText; ?>">Trucks Mail Text</a></li>
                <?php } ?>
                <?php if($this->user->hasPermission('access','extension/warehousesMailText')) { ?> 
                    <li><a href="<?php echo $warehousesMailText; ?>">Warehouses Mail Text</a></li>
                <?php } ?>
                <?php if($this->user->hasPermission('access','extension/productsMailText')) { ?> 
                <li><a href="<?php echo $productsMailText; ?>">Products Mail Text</a></li>
                <?php } ?>
                <?php if($this->user->hasPermission('access','extension/upgradeText')) { ?> 
                <li><a href="<?php echo $upgradeText; ?>">Upgrade Text</a></li>
                <?php } ?>
                <?php if($this->user->hasPermission('access','extension/upgradeSmallText')) { ?> 
                <li><a href="<?php echo $upgradeSmallText; ?>">Upgrade Small Text</a></li>
                <?php } ?>
                <?php if($this->user->hasPermission('access','extension/upgradeLargeText')) { ?> 
                <li><a href="<?php echo $upgradeLargeText; ?>">Upgrade Large Text</a></li>
                <?php } ?>
                <?php if($this->user->hasPermission('access','extension/accountUpgradeText')) { ?> 
                <li><a href="<?php echo $accountUpgradeText; ?>">Account/Upgrade Text</a></li>
                <?php } ?>
                
                <?php if($this->user->hasPermission('access','extension/keywordsText')) { ?> 
                <li><a href="<?php echo $keywordsText; ?>">Meta Keywords</a></li>
                <?php } ?>
                
                <?php if($this->user->hasPermission('access','extension/mainDescriptionText')) { ?> 
                <li><a href="<?php echo $mainDescriptionText; ?>">Meta Description</a></li>
                <?php } ?>
                
                <?php if($this->user->hasPermission('access','extension/companyViewText')) { ?> 
                <li><a href="<?php echo $companyViewText; ?>">Company View Text</a></li>
                <?php } ?>
                <?php if($this->user->hasPermission('access','extension/companyViewLargeText')) { ?> 
                <li><a href="<?php echo $companyViewLargeText; ?>">Company View Large Text</a></li>
                <?php } ?>
                
              </ul>
          </li>
          <?php } ?>
          <?php if($this->user->hasPermission('access','extension/shipping')) { ?> 
            <li><a href="<?php echo $shipping; ?>"><?php echo $text_shipping; ?></a></li>
          <?php } ?>
          <?php if($this->user->hasPermission('access','extension/payment')) { ?> 
            <li><a href="<?php echo $payment; ?>"><?php echo $text_payment; ?></a></li>
          <?php } ?> 
          <?php if($this->user->hasPermission('access','extension/total')) { ?> 
            <li><a href="<?php echo $total; ?>"><?php echo $text_total; ?></a></li>
          <?php } ?> 
          <?php if($this->user->hasPermission('access','extension/feed')) { ?> 
            <li><a href="<?php echo $feed; ?>"><?php echo $text_feed; ?></a></li>
          <?php } ?> 
        </ul>
      </li>
      <?php } ?>
      
        <?php if(
        $this->user->hasPermission('access','sale/order') || 
        $this->user->hasPermission('access','sale/return') || 
        $this->user->hasPermission('access','sale/customer') || 
        $this->user->hasPermission('access','sale/customer_group') ||
        $this->user->hasPermission('access','sale/customer_ban_ip') ||
        $this->user->hasPermission('access','catalog/registrationPayment') ||
        $this->user->hasPermission('access','catalog/verification') || 
        $this->user->hasPermission('access','sale/affiliate') || 
        $this->user->hasPermission('access','sale/coupon') || 
        $this->user->hasPermission('access','sale/voucher') || 
        $this->user->hasPermission('access','sale/voucher_theme') || 
        $this->user->hasPermission('access','sale/contact') 
        ) { ?> 
      <li id="sale"><a class="top"><?php echo $text_sale; ?></a>
        <ul>
          <?php if($this->user->hasPermission('access','sale/order')) { ?> 
          <li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li>
          <?php } ?> 
          <?php if($this->user->hasPermission('access','sale/return')) { ?> 
          <li><a href="<?php echo $return; ?>"><?php echo $text_return; ?></a></li>
         <?php } ?> 
         <?php if($this->user->hasPermission('access','sale/customer') || 
         $this->user->hasPermission('access','sale/customer_group') ||
         $this->user->hasPermission('access','sale/customer_ban_ip') ||
         $this->user->hasPermission('access','catalog/registrationPayment') ||
         $this->user->hasPermission('access','catalog/verification')
         ) { ?>   
          <li><a class="parent"><?php echo $text_customer; ?></a>
            <ul>
              <?php if($this->user->hasPermission('access','sale/customer')) { ?>   
                <li><a href="<?php echo $customer; ?>"><?php echo $text_customer; ?></a></li>
              <?php } ?>
                 
                <li><a href="<?php echo $customer_group; ?>"><?php echo $text_customer_group; ?></a></li>
             
              <?php if($this->user->hasPermission('access','sale/customer_ban_ip')) { ?>   
                <li><a href="<?php echo $customer_ban_ip; ?>"><?php echo $text_customer_ban_ip; ?></a></li>
              <?php } ?>
              <?php if($this->user->hasPermission('access','catalog/registrationPayment')) { ?>  
              <li><a href="<?php echo $catalog_registrationPayment; ?>">Registration payments</a></li>  
              <?php } ?>
              <?php if($this->user->hasPermission('access','catalog/verification')) { ?>  
              <li><a href="<?php echo $catalog_verification; ?>">Verification Requests</a></li>  
              <?php } ?>
            </ul>
          </li>
          <?php } ?>
          <?php if($this->user->hasPermission('access','sale/affiliate')) { ?>  
            <li><a href="<?php echo $affiliate; ?>"><?php echo $text_affiliate; ?></a></li>
          <?php } ?>
          <?php if($this->user->hasPermission('access','sale/coupon')) { ?> 
            <li><a href="<?php echo $coupon; ?>"><?php echo $text_coupon; ?></a></li>
          <?php } ?>
          <?php if($this->user->hasPermission('access','sale/voucher') || 
            $this->user->hasPermission('access','sale/voucher_theme')
          ) { ?> 
            <li><a class="parent"><?php echo $text_voucher; ?></a>
              <ul>
                <?php if($this->user->hasPermission('access','sale/voucher')) { ?> 
                  <li><a href="<?php echo $voucher; ?>"><?php echo $text_voucher; ?></a></li>
                <?php } ?>
                <?php if($this->user->hasPermission('access','sale/voucher_theme')) { ?> 
                <li><a href="<?php echo $voucher_theme; ?>"><?php echo $text_voucher_theme; ?></a></li>
                <?php } ?>
              </ul>
            </li>
          <?php } ?>
          <?php if($this->user->hasPermission('access','sale/contact')) { ?> 
            <li><a href="<?php echo $contact; ?>"><?php echo $text_contact; ?></a></li>
          <?php } ?>
        </ul>
      </li>
      <?php } ?>
      
      <?php if(
       $this->user->hasPermission('access','setting/store') ||
       $this->user->hasPermission('access','design/layout') ||
       $this->user->hasPermission('access','design/banner') ||
       $this->user->hasPermission('access','user/user') || 
       $this->user->hasPermission('access','user/user_permission') ||
       $this->user->hasPermission('access','localisation/language') || 
       $this->user->hasPermission('access','localisation/currency') || 
       $this->user->hasPermission('access','localisation/stock_status') ||
       $this->user->hasPermission('access','localisation/order_status') ||
       $this->user->hasPermission('access','localisation/return_status') || 
       $this->user->hasPermission('access','localisation/return_action') ||
       $this->user->hasPermission('access','localisation/return_reason') || 
       $this->user->hasPermission('access','localisation/country') ||
       $this->user->hasPermission('access','localisation/zone') ||
       $this->user->hasPermission('access','localisation/geo_zone') ||
       $this->user->hasPermission('access','localisation/tax_class') ||  
       $this->user->hasPermission('access','localisation/tax_rate') ||
       $this->user->hasPermission('access','localisation/length_class') ||
       $this->user->hasPermission('access','localisation/weight_class') ||
       $this->user->hasPermission('access','tool/error_log') ||
       $this->user->hasPermission('access','tool/backup')
      ) { ?>  
      <li id="system"><a class="top"><?php echo $text_system; ?></a>
        <ul>
          <?php if($this->user->hasPermission('access','setting/store')) { ?>   
            <li><a href="<?php echo $setting; ?>"><?php echo $text_setting; ?></a></li>
          <?php } ?>
          <?php if($this->user->hasPermission('access','design/layout') ||
          $this->user->hasPermission('access','design/banner') ) { ?>  
            <li><a class="parent"><?php echo $text_design; ?></a>
              <ul>
                <?php if($this->user->hasPermission('access','design/layout')) { ?>   
                  <li><a href="<?php echo $layout; ?>"><?php echo $text_layout; ?></a></li>
                <?php } ?>
                <?php if($this->user->hasPermission('access','design/banner')) { ?>   
                  <li><a href="<?php echo $banner; ?>"><?php echo $text_banner; ?></a></li>
                <?php } ?>
              </ul>
            </li>
          <?php } ?>
          <?php if($this->user->hasPermission('access','user/user') || 
          $this->user->hasPermission('access','user/user_permission') ) { ?>   
            <li><a class="parent"><?php echo $text_users; ?></a>
              <ul>
                <?php if($this->user->hasPermission('access','user/user')) { ?>    
                  <li><a href="<?php echo $user; ?>"><?php echo $text_user; ?></a></li>
                <?php } ?>
                <?php if($this->user->hasPermission('access','user/user_permission')) { ?> 
                  <li><a href="<?php echo $user_group; ?>"><?php echo $text_user_group; ?></a></li>
                <?php } ?>
              </ul>
            </li>
          <?php } ?>
          
          <?php if($this->user->hasPermission('access','localisation/language') || 
           $this->user->hasPermission('access','localisation/currency') || 
           $this->user->hasPermission('access','localisation/stock_status') ||
           $this->user->hasPermission('access','localisation/order_status') ||
           $this->user->hasPermission('access','localisation/return_status') || 
           $this->user->hasPermission('access','localisation/return_action')   ||
           $this->user->hasPermission('access','localisation/return_reason') || 
           $this->user->hasPermission('access','localisation/country') ||
           $this->user->hasPermission('access','localisation/zone') ||
           $this->user->hasPermission('access','localisation/geo_zone') ||
           $this->user->hasPermission('access','localisation/tax_class') ||  
           $this->user->hasPermission('access','localisation/tax_rate') ||
           $this->user->hasPermission('access','localisation/length_class') ||
           $this->user->hasPermission('access','localisation/weight_class')
           ) { ?>  
           
                <li><a class="parent"><?php echo $text_localisation; ?></a>
                  <ul>
                    <?php if($this->user->hasPermission('access','localisation/language')) { ?>   
                      <li><a href="<?php echo $language; ?>"><?php echo $text_language; ?></a></li>
                    <?php } ?>
                    <?php if($this->user->hasPermission('access','localisation/currency')) { ?>   
                      <li><a href="<?php echo $currency; ?>"><?php echo $text_currency; ?></a></li>
                    <?php } ?>
                    <?php if($this->user->hasPermission('access','localisation/stock_status')) { ?> 
                      <li><a href="<?php echo $stock_status; ?>"><?php echo $text_stock_status; ?></a></li>
                    <?php } ?>
                    <?php if($this->user->hasPermission('access','localisation/order_status')) { ?> 
                      <li><a href="<?php echo $order_status; ?>"><?php echo $text_order_status; ?></a></li>
                    <?php } ?>
                    <?php if($this->user->hasPermission('access','localisation/return_status') || 
                        $this->user->hasPermission('access','localisation/return_action')   ||
                        $this->user->hasPermission('access','localisation/return_reason')   ) { ?>
                      <li><a class="parent"><?php echo $text_return; ?></a>
                        <ul>
                          <?php if($this->user->hasPermission('access','localisation/return_status')) { ?>   
                          <li><a href="<?php echo $return_status; ?>"><?php echo $text_return_status; ?></a></li>
                          <?php } ?>
                          <?php if($this->user->hasPermission('access','localisation/return_action')) { ?> 
                          <li><a href="<?php echo $return_action; ?>"><?php echo $text_return_action; ?></a></li>
                          <?php } ?>
                          <?php if($this->user->hasPermission('access','localisation/return_reason')) { ?> 
                          <li><a href="<?php echo $return_reason; ?>"><?php echo $text_return_reason; ?></a></li>
                          <?php } ?>
                        </ul>
                      </li>
                    <?php } ?>
                    <?php if($this->user->hasPermission('access','localisation/country')) { ?> 
                      <li><a href="<?php echo $country; ?>"><?php echo $text_country; ?></a></li>
                    <?php } ?>
                    <?php if($this->user->hasPermission('access','localisation/zone')) { ?> 
                      <li><a href="<?php echo $zone; ?>"><?php echo $text_zone; ?></a></li>
                    <?php } ?>
                    <?php if($this->user->hasPermission('access','localisation/geo_zone')) { ?> 
                      <li><a href="<?php echo $geo_zone; ?>"><?php echo $text_geo_zone; ?></a></li>
                    <?php } ?>
                    <?php if(  $this->user->hasPermission('access','localisation/tax_class') ||  
                               $this->user->hasPermission('access','localisation/tax_rate')  ) { ?> 
                      <li><a class="parent"><?php echo $text_tax; ?></a>
                        <ul>
                          <?php if($this->user->hasPermission('access','localisation/tax_class')) { ?> 
                          <li><a href="<?php echo $tax_class; ?>"><?php echo $text_tax_class; ?></a></li>
                          <?php } ?>
                          <?php if($this->user->hasPermission('access','localisation/tax_rate')) { ?> 
                          <li><a href="<?php echo $tax_rate; ?>"><?php echo $text_tax_rate; ?></a></li>
                          <?php } ?>
                        </ul>
                      </li>
                    <?php } ?>
                    <?php if($this->user->hasPermission('access','localisation/length_class')) { ?> 
                    <li><a href="<?php echo $length_class; ?>"><?php echo $text_length_class; ?></a></li>
                    <?php } ?>
                    <?php if($this->user->hasPermission('access','localisation/weight_class')) { ?> 
                    <li><a href="<?php echo $weight_class; ?>"><?php echo $text_weight_class; ?></a></li>
                    <?php } ?>
                  </ul>
                </li>
           <?php } ?>
    
          <?php if($this->user->hasPermission('access','tool/error_log')) { ?> 
            <li><a href="<?php echo $error_log; ?>"><?php echo $text_error_log; ?></a></li>
          <?php } ?>
          <?php if($this->user->hasPermission('access','tool/backup')) { ?>
            <li><a href="<?php echo $backup; ?>"><?php echo $text_backup; ?></a></li>
          <?php } ?>
        </ul>
      </li>
      <?php } ?>
      
      <?php if(
          $this->user->hasPermission('access','report/sale_order')  || 
          $this->user->hasPermission('access','report/sale_tax') || 
          $this->user->hasPermission('access','report/sale_shipping') || 
          $this->user->hasPermission('access','report/sale_return') || 
          $this->user->hasPermission('access','report/sale_coupon') || 
          $this->user->hasPermission('access','report/product_viewed') || 
          $this->user->hasPermission('access','report/product_purchased') || 
          $this->user->hasPermission('access','report/customer_online') || 
          $this->user->hasPermission('access','report/customer_order') || 
          $this->user->hasPermission('access','report/customer_reward') || 
          $this->user->hasPermission('access','report/customer_credit') || 
          $this->user->hasPermission('access','report/affiliate_commission')
      ) { ?>  
      <li id="reports"><a class="top"><?php echo $text_reports; ?></a>
        <ul>
          <?php if($this->user->hasPermission('access','report/sale_order')  || 
          $this->user->hasPermission('access','report/sale_tax') || 
          $this->user->hasPermission('access','report/sale_shipping') || 
          $this->user->hasPermission('access','report/sale_return')  || 
          $this->user->hasPermission('access','report/sale_coupon')
          ) { ?>  
          <li><a class="parent"><?php echo $text_sale; ?></a>
            <ul>
              <?php if($this->user->hasPermission('access','report/sale_order')) { ?>  
              <li><a href="<?php echo $report_sale_order; ?>"><?php echo $text_report_sale_order; ?></a></li>
              <?php } ?>
              <?php if($this->user->hasPermission('access','report/sale_tax')) { ?>  
              <li><a href="<?php echo $report_sale_tax; ?>"><?php echo $text_report_sale_tax; ?></a></li>
              <?php } ?>
              <?php if($this->user->hasPermission('access','report/sale_shipping')) { ?> 
              <li><a href="<?php echo $report_sale_shipping; ?>"><?php echo $text_report_sale_shipping; ?></a></li>
              <?php } ?>
              <?php if($this->user->hasPermission('access','report/sale_return')) { ?> 
              <li><a href="<?php echo $report_sale_return; ?>"><?php echo $text_report_sale_return; ?></a></li>
              <?php } ?>
              <?php if($this->user->hasPermission('access','report/sale_coupon')) { ?> 
              <li><a href="<?php echo $report_sale_coupon; ?>"><?php echo $text_report_sale_coupon; ?></a></li>
              <?php } ?>
            </ul>
          </li>
          <?php } ?>
          
          <?php if($this->user->hasPermission('access','report/product_viewed') || 
          $this->user->hasPermission('access','report/product_purchased') ) { ?> 
          <li><a class="parent"><?php echo $text_product; ?></a>
            <ul>
              <?php if($this->user->hasPermission('access','report/product_viewed')) { ?> 
              <li><a href="<?php echo $report_product_viewed; ?>"><?php echo $text_report_product_viewed; ?></a></li>
              <?php } ?>
              <?php if($this->user->hasPermission('access','report/product_purchased')) { ?>
              <li><a href="<?php echo $report_product_purchased; ?>"><?php echo $text_report_product_purchased; ?></a></li>
              <?php } ?>
            </ul>
          </li>
          <?php } ?>
          
          <?php if($this->user->hasPermission('access','report/customer_online') ||
          $this->user->hasPermission('access','report/customer_order') ||
          $this->user->hasPermission('access','report/customer_reward') ||
          $this->user->hasPermission('access','report/customer_credit')
          ) { ?>
            <li><a class="parent"><?php echo $text_customer; ?></a>
              <ul>
                <?php if($this->user->hasPermission('access','report/customer_online')) { ?>
                <li><a href="<?php echo $report_customer_online; ?>"><?php echo $text_report_customer_online; ?></a></li>
                <?php } ?>
                <?php if($this->user->hasPermission('access','report/customer_order')) { ?>
                <li><a href="<?php echo $report_customer_order; ?>"><?php echo $text_report_customer_order; ?></a></li>
                <?php } ?>
                <?php if($this->user->hasPermission('access','report/customer_reward')) { ?>
                <li><a href="<?php echo $report_customer_reward; ?>"><?php echo $text_report_customer_reward; ?></a></li>
                <?php } ?>
                <?php if($this->user->hasPermission('access','report/customer_credit')) { ?>
                <li><a href="<?php echo $report_customer_credit; ?>"><?php echo $text_report_customer_credit; ?></a></li>
                <?php } ?>
              </ul>
            </li>
          <?php } ?>
          
          <?php if($this->user->hasPermission('access','report/affiliate_commission')) { ?>
          <li><a class="parent"><?php echo $text_affiliate; ?></a>
            <ul>
                <li><a href="<?php echo $report_affiliate_commission; ?>"><?php echo $text_report_affiliate_commission; ?></a></li>
            </ul>
           <?php } ?>    
          </li>
        </ul>
      </li>
      <?php } ?>
      
      <li id="help"><a class="top"><?php echo $text_help; ?></a>
        <!--  <ul>
        <li><a href="http://www.opencart.com" target="_blank"><?php echo $text_opencart; ?></a></li>
          <li><a href="http://www.opencart.com/index.php?route=documentation/introduction" target="_blank"><?php echo $text_documentation; ?></a></li>
          <li><a href="http://forum.opencart.com" target="_blank"><?php echo $text_support; ?></a></li>
        </ul>-->
      </li>
    </ul>
    <ul class="right" style="display: none;">
      <li id="store"><a href="<?php echo $store; ?>" target="_blank" class="top"><?php echo $text_front; ?></a>
        <ul>
          <?php foreach ($stores as $stores) { ?>
          <li><a href="<?php echo $stores['href']; ?>" target="_blank"><?php echo $stores['name']; ?></a></li>
          <?php } ?>
        </ul>
      </li>
      <li><a class="top" href="<?php echo $logout; ?>"><?php echo $text_logout; ?></a></li>
    </ul>
  </div>
  <?php } ?>
</div>
