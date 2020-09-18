<div class="box">
  <div class="box-heading" style="text-align: center; color: #38B0E3;" ><?php echo $heading_title; ?></div>
  <div class="box-content">
    <ul class="box-category">
      <?php foreach ($customers as $customer) { ?>
      <li style="text-align: center;">
        
        <a href="?route=customer/customer/update&customer_id=<?php echo $customer['customer_id']; ?>"><?php echo $customer['company']; ?></a>
        
       <!-- <?php if ($category['children']) { ?>
        <ul>
          <?php foreach ($category['children'] as $child) { ?>
          <li>
            <?php if ($child['category_id'] == $child_id) { ?>
            <a href="<?php echo $child['href']; ?>" class="active"> - <?php echo $child['name']; ?></a>
            <?php } else { ?>
            <a href="<?php echo $child['href']; ?>"> - <?php echo $child['name']; ?></a>
            <?php } ?>
          </li>
          <?php } ?>
        </ul>
        <?php } ?>-->
      </li>
      <?php } ?>
    </ul>
  </div>
</div>
