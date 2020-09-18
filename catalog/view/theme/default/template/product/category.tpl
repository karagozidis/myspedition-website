<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content"><?php echo $content_top; ?>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <h1><?php echo $heading_title; ?></h1>
  <?php if ($long_thumb || $description) { ?>
  <div class="category-info">
    <?php if ($long_thumb) { ?>
    <div class="image"><img src="<?php echo $long_thumb; ?>" alt="<?php echo $heading_title; ?>" /></div>
    <?php } ?>
    <?php if ($description) { ?>
    <?php echo $description; ?>
    <?php } ?>
  </div>
  <?php } ?>
  <?php if ($categories) { ?>
  <h2><?php echo $text_refine; ?></h2>
  <div class="category-list">
    <?php if (count($categories) <= 500) { ?>
    <li style="list-style-type: none;">
      <?php foreach ($categories as $category) { ?>
      <ul style="width: 10%;">
          <table>
              <tr>
                  <td>
                       <a href="<?php echo $category['href']; ?>">
                            <img src="<?php echo $category['thumb']; ?>">
                       </a>
                  </td>
              </tr>
              <tr>
                  <td align=center>
                      <b>
                          <a href="<?php echo $category['href']; ?>">
                              <?php echo $category['name']; ?>
                          </a>
                      </b>
                  </td>
              </tr>
          </table>
      </ul>
      <?php } ?>
    </li>
    <?php } else { ?>
    <?php for ($i = 0; $i < count($categories);) { ?>
    <ul>
      <?php $j = $i + ceil(count($categories) / 4); ?>
      <?php for (; $i < $j; $i++) { ?>
      <?php if (isset($categories[$i])) { ?>
      <li><a href="<?php echo $categories[$i]['href']; ?>"><?php echo $categories[$i]['name']; ?></a></li>
      <?php } ?>
      <?php } ?>
    </ul>
    <?php } ?>
    <?php } ?>
  </div>
  <?php } ?>
  
  <!--<div class="content">
      <table>
          <tr>
              <td>  <img src="image/product.png" width="30">  </td>
              <td>   <h2>Product Offers</h2>  </td>
          </tr>
      </table>   
  </div> -->
  
  <?php if ($products) { ?>
  <img src="image/catalogLogo2.png" width="780" >
  <div class="product-filter">
    <div class="display"><b><?php echo $text_display; ?></b> <?php echo $text_list; ?> <b>/</b> <a onclick="display('grid');"><?php echo $text_grid; ?></a></div>
    <div class="limit"><b><?php echo $text_limit; ?></b>
      <select onchange="location = this.value;">
        <?php foreach ($limits as $limits) { ?>
        <?php if ($limits['value'] == $limit) { ?>
        <option value="<?php echo $limits['href']; ?>" selected="selected"><?php echo $limits['text']; ?></option>
        <?php } else { ?>
        <option value="<?php echo $limits['href']; ?>"><?php echo $limits['text']; ?></option>
        <?php } ?>
        <?php } ?>
      </select>
    </div>
    <div class="sort"><b><?php echo $text_sort; ?></b>
      <select onchange="location = this.value;">
        <?php foreach ($sorts as $sorts) { ?>
        <?php if ($sorts['value'] == $sort . '-' . $order) { ?>
        <option value="<?php echo $sorts['href']; ?>" selected="selected"><?php echo $sorts['text']; ?></option>
        <?php } else { ?>
        <option value="<?php echo $sorts['href']; ?>"><?php echo $sorts['text']; ?></option>
        <?php } ?>
        <?php } ?>
      </select>
    </div>
  </div>
  <div class="product-compare">
            <a href="<?php echo $compare; ?>" id="compare-total">
                <?php echo $text_compare; ?>
            </a>
  </div>
  <div class="product-list">
    <?php foreach ($products as $product) { ?>
    <div>
      <?php if ($product['thumb']) { ?>
      <div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" title="<?php echo $product['name']; ?>" alt="<?php echo $product['name']; ?>" /></a></div>
      <?php } ?>
      <div class="name">
          <a href="<?php echo $product['href']; ?>">
              <?php echo $product['name']; ?>
          </a>
      </div>
      <div class="description"><?php echo $product['description']; ?></div>
      <?php if ($product['price']) { ?>
      <div class="price">
        <?php if (!$product['special']) { ?>
        <?php echo $product['price']; ?>
        <?php } else { ?>
        <span class="price-old"><?php echo $product['price']; ?></span> <span class="price-new"><?php echo $product['special']; ?></span>
        <?php } ?>
        <!--
        <?php if ($product['tax']) { ?>
        <br />
        <span class="price-tax"><?php echo $text_tax; ?> <?php echo $product['tax']; ?></span>
        <?php } ?>
        -->
      </div>
      <?php } ?>
      <?php if ($product['rating']) { ?>
      <div class="rating"><img src="catalog/view/theme/default/image/stars-<?php echo $product['rating']; ?>.png" alt="<?php echo $product['reviews']; ?>" /></div>
      <?php } ?>
      <div class="cart">
          <a href="<?php echo $product['href']; ?>" class="button">
              View
          </a>
        <!--<input type="button" value="<?php echo $button_cart; ?>" onclick="addToCart('<?php echo $product['product_id']; ?>');" class="button" />-->
      </div>
      <div class="wishlist"><a onclick="addToWishList('<?php echo $product['product_id']; ?>');"><?php echo $button_wishlist; ?></a></div>
     
      <div class="compare">
          <a onclick="addToCompare('<?php echo $product['product_id']; ?>');">
              <?php echo $button_compare; ?>
          </a>
      </div>   
    </div>
    <?php } ?>
  </div>
 
  <div class="pagination"><?php echo $pagination; ?></div>
  <?php } ?>
  
  
  
  
  <!--<div class="content">
      <table>
          <tr>
              <td>  <img src="image/productRequest.png" width="30">  </td>
              <td>   <h2>Product Requests</h2>  </td>
          </tr>
      </table>   
  </div> -->
  
  
  <?php if ($productRequests) { ?>
  <br><br><br><br><br>
  <img src="image/catalogLogo.png" width="780" >
  
  <div class="product-filter">
    <div class="display"><b><?php echo $text_display; ?></b> 
        <?php echo $text_list; ?> <b>/</b> <a onclick="display('grid');"><?php echo $text_grid; ?></a>
    </div>
    <div class="limit">
        <b><?php echo $text_limit; ?></b>
      <select onchange="location = this.value;">
        <?php foreach ($limitsRequest as $limitsRequest) { ?>
        <?php if ($limitsRequest['value'] == $limitRequest) { ?>
        <option value="<?php echo $limitsRequest['href']; ?>" selected="selected"><?php echo $limitsRequest['text']; ?></option>
        <?php } else { ?>
        <option value="<?php echo $limitsRequest['href']; ?>"><?php echo $limitsRequest['text']; ?></option>
        <?php } ?>
        <?php } ?>
      </select>
    </div>
    <div class="sort"><b><?php echo $text_sort; ?></b>
      <select onchange="location = this.value;">
        <?php foreach ($sortsRequest as $sortsRequest) { ?>
        <?php if ($sortsRequest['value'] == $sortRequest . '-' . $order) { ?>
        <option value="<?php echo $sortsRequest['href']; ?>" selected="selected"><?php echo $sortsRequest['text']; ?></option>
        <?php } else { ?>
        <option value="<?php echo $sortsRequest['href']; ?>"><?php echo $sortsRequest['text']; ?></option>
        <?php } ?>
        <?php } ?>
      </select>
    </div>
  </div>
  <div class="product-compare">
            <a href="<?php echo $compare; ?>" id="compare-total">
                <?php echo $text_compare; ?>
            </a>
  </div>
  <div class="product-list">
    <?php foreach ($productRequests as $product) { ?>
    <div>
      <?php if ($product['thumb']) { ?>
      <div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" title="<?php echo $product['name']; ?>" alt="<?php echo $product['name']; ?>" /></a></div>
      <?php } ?>
      <div class="name">
          <a href="<?php echo $product['href']; ?>">
              <?php echo $product['name']; ?>
          </a>
      </div>
      <div class="description"><?php echo $product['description']; ?></div>
      <?php if ($product['price']) { ?>
      <div class="price">
        <?php if (!$product['special']) { ?>
        <?php echo $product['price']; ?>
        <?php } else { ?>
        <span class="price-old"><?php echo $product['price']; ?></span> <span class="price-new"><?php echo $product['special']; ?></span>
        <?php } ?>
       <!-- 
       <?php if ($product['tax']) { ?>
        <br />
        <span class="price-tax"><?php echo $text_tax; ?> <?php echo $product['tax']; ?></span>
        <?php } ?>
       -->
      </div>
      <?php } ?>
      <?php if ($product['rating']) { ?>
      <div class="rating"><img src="catalog/view/theme/default/image/stars-<?php echo $product['rating']; ?>.png" alt="<?php echo $product['reviews']; ?>" /></div>
      <?php } ?>
      <div class="cart">
          <a href="<?php echo $product['href']; ?>" class="button">
              View
          </a>
        <!--<input type="button" value="<?php echo $button_cart; ?>" onclick="addToCart('<?php echo $product['product_id']; ?>');" class="button" />-->
      </div>
      <div class="wishlist">
          <!--<a onclick="addToWishList('<?php echo $product['productRequest_id']; ?>');"><?php echo $button_wishlist; ?></a>-->
      </div>
     
      <div class="compare">
         <!-- <a onclick="addToCompare('<?php echo $product['productRequest_id']; ?>');">
              <?php echo $button_compare; ?>
          </a>-->
      </div>   
    </div>
    <?php } ?>
  </div>
 
  <div class="pagination"><?php echo $pagination; ?></div>
  <?php } ?>
  
  
  
  
  
  
  
  
  
  <?php if (!$categories && !$products) { ?>
  <div class="content"><?php echo $text_empty; ?></div>
  <!--<div class="buttons">
    <div class="right"><a href="<?php echo $continue; ?>" class="button"><?php echo $button_continue; ?></a></div>
  </div>-->
  <?php } ?>
  <div class="buttons">
    <div class="right">
        <a href="<?php echo $addProduct; ?>" class="button">Add your products to sell</a>
         <a href="<?php echo $addProductRequest; ?>" class="button">Add your product requests</a>
    </div>
  </div>
  
  <?php echo $content_bottom; ?></div>
<script type="text/javascript"><!--
function display(view) {
	if (view == 'list') {
		$('.product-grid').attr('class', 'product-list');
		
		$('.product-list > div').each(function(index, element) {
			html  = '<div class="right">';
			html += '  <div class="cart">' + $(element).find('.cart').html() + '</div>';
			html += '  <div class="wishlist">' + $(element).find('.wishlist').html() + '</div>';
			html += '  <div class="compare">' + $(element).find('.compare').html() + '</div>';
			html += '</div>';			
			
			html += '<div class="left">';
			
			var image = $(element).find('.image').html();
			
			if (image != null) { 
				html += '<div class="image">' + image + '</div>';
			}
			
			var price = $(element).find('.price').html();
			
			if (price != null) {
				html += '<div class="price">' + price  + '</div>';
			}
					
			html += '  <div class="name">' + $(element).find('.name').html() + '</div>';
			html += '  <div class="description">' + $(element).find('.description').html() + '</div>';
			
			var rating = $(element).find('.rating').html();
			
			if (rating != null) {
				html += '<div class="rating">' + rating + '</div>';
			}
				
			html += '</div>';
						
			$(element).html(html);
		});		
		
		$('.display').html('<b><?php echo $text_display; ?></b> <?php echo $text_list; ?> <b>/</b> <a onclick="display(\'grid\');"><?php echo $text_grid; ?></a>');
		
		$.totalStorage('display', 'list'); 
	} else {
		$('.product-list').attr('class', 'product-grid');
		
		$('.product-grid > div').each(function(index, element) {
			html = '';
			
			var image = $(element).find('.image').html();
			
			if (image != null) {
				html += '<div class="image">' + image + '</div>';
			}
			
			html += '<div class="name">' + $(element).find('.name').html() + '</div>';
			html += '<div class="description">' + $(element).find('.description').html() + '</div>';
			
			var price = $(element).find('.price').html();
			
			if (price != null) {
				html += '<div class="price">' + price  + '</div>';
			}
			
			var rating = $(element).find('.rating').html();
			
			if (rating != null) {
				html += '<div class="rating">' + rating + '</div>';
			}
						
			html += '<div class="cart">' + $(element).find('.cart').html() + '</div>';
			html += '<div class="wishlist">' + $(element).find('.wishlist').html() + '</div>';
			html += '<div class="compare">' + $(element).find('.compare').html() + '</div>';
			
			$(element).html(html);
		});	
					
		$('.display').html('<b><?php echo $text_display; ?></b> <a onclick="display(\'list\');"><?php echo $text_list; ?></a> <b>/</b> <?php echo $text_grid; ?>');
		
		$.totalStorage('display', 'grid');
	}
}

view = $.totalStorage('display');

if (view) {
	display(view);
} else {
	display('list');
}
//--></script> 
<?php echo $footer; ?>