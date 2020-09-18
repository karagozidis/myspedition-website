<!--  DIY Module Builder By HostJars http://opencart.hostjars.com -->
<style>
  li.jcarousel-item{
  width: 145px !important;
}
</style>
<br>
<div class="tblHeader" style="width: 165px;border-radius: 7px 7px 7px 7px;" >Latest Products</div>
<br>
<div id="carousel<?php echo $module; ?>" class="jcarousel-skin-opencart">
  <!--<div class="box-heading"><?php echo $heading_title; ?></div>-->
  <div class="box-content">
    <ul class="jcarousel-container box-product">
      <?php foreach ($products as $product) { ?>
        <li class="box-content">
        <div>
            <?php if ($product['thumb']) { ?>
              <div class="image">
                  <a href="<?php echo $product['href']; ?>" target="_blank">
                      <img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" />
                  </a>
              </div>
            <?php } ?>
            <div class="name">
                <a href="<?php echo $product['href']; ?>" target="_blank">
                    <?php echo $product['name']; ?>
                </a>
            </div>
            <?php if ($product['price'] && $product['price'] > 0 ) { ?>
              <div class="price">
              <?php if (!$product['special']) { ?>
                <?php echo $product['price']; ?>
              <?php } else { ?>
                <span class="price-old"><?php echo $product['price']; ?></span> <span class="price-new"><?php echo $product['special']; ?></span>
              <?php } ?>
              </div>
            <?php } ?>
            <?php if ($product['rating']) { ?>
              <div class="rating"><img src="catalog/view/theme/default/image/stars-<?php echo $product['rating']; ?>.png" alt="<?php echo $product['reviews']; ?>" /></div>
            <?php } ?>
            <div class="cart">
                <a href="<?php echo $product['href']; ?>" class="button" target="_blank">
                    <?php echo $view; ?>
               </a>
                <!--<input type="button" value="<?php echo $button_cart; ?>" onclick="addToCart('<?php echo $product['product_id']; ?>');" class="button" />-->
            </div>
          </div>
      </li>
      <?php } ?>
    </ul>
  </div>
</div>
<br>
<script type="text/javascript"><!--
$('#carousel<?php echo $module; ?> ul').jcarousel({
	vertical: false,
	visible: <?php echo $limit; ?>,
	scroll: <?php echo $scroll; ?>,
	visible: 5,
	circular: true,
	auto: 2,
  wrap: 'last',		
});
//--></script>
