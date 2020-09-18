<div class="box">
  <div class="box-heading" style="text-align: center; color: #38B0E3;" ><?php echo $heading_title; ?></div>
  <div class="box-content">
    <ul class="box-category">
      <?php foreach ($customers as $customer) { ?>
      <li style="text-align: center;">
        
        <a href="?route=customer/customer/update&customer_id=<?php echo $customer['customer_id']; ?>">
            <img src="image/flags/<?php echo strtolower( $customer['country']['iso_code_2'] ); ?>.png">
            <?php echo $customer['company']; ?>
        </a>
        
      </li>
      <?php } ?>
    </ul>
  </div>
</div>
