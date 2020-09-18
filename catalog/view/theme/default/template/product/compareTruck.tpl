<?php echo $header; ?>
<?php if ($success) { ?>
<div class="success"><?php echo $success; ?><img src="catalog/view/theme/default/image/close.png" alt="" class="close" /></div>
<?php } ?>
<?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content"><?php echo $content_top; ?>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <h1><?php echo $heading_title; ?></h1>
  <?php if ($products) { ?>
  <table class="compare-info">
    <thead>
      <tr>
        <td class="compare-product" colspan="<?php echo count($products) + 1; ?>"><?php echo $text_product; ?></td>
      </tr>
    </thead>
    <tbody>
        
      <tr>
        <td>Loading country</td>
        <?php foreach ($products as $product) { ?>
        <td class="name">              
                <img src="image/flags/<?php echo strtolower($products[$product['product_id']]['loading_country']['iso_code_2']); ?>.png">
                <?php echo $products[$product['product_id']]['loading_country']['name']; ?>
        </td>
        <?php } ?>
      </tr>  
      <tr>
        <td>Loading region / state</td>
        <?php foreach ($products as $product) { ?>
        <td>             
            <?php if(isset($products[$product['product_id']]['loading_zone']['name'])) { ?>
                <?php echo $products[$product['product_id']]['loading_zone']['name']; ?>
            <?php } else { ?>
              ---
            <?php } ?>
        </td>
        <?php } ?>
      </tr>
      <tr>
        <td>Loading City / Area</td>
        <?php foreach ($products as $product) { ?>
        <td >                      
                <?php echo $products[$product['product_id']]['loading_city']; ?>
        </td>
        <?php } ?>
      </tr>
       
      <tr>
        <td>Offloading country</td>
        <?php foreach ($products as $product) { ?>
        <td class="name">                    
                <img src="image/flags/<?php echo strtolower($products[$product['product_id']]['offloading_country']['iso_code_2']); ?>.png">
                <?php echo $products[$product['product_id']]['offloading_country']['name']; ?>
        </td>
        <?php } ?>
      </tr>     
      <tr>
        <td>OffLoading region / state</td>
        <?php foreach ($products as $product) { ?>
        <td>    
            <?php if(isset($products[$product['product_id']]['offloading_zone']['name'])) { ?>
                <?php echo $products[$product['product_id']]['offloading_zone']['name']; ?>
            <?php } else { ?>
              ---
            <?php } ?>
        </td>
        <?php } ?>
      </tr>   
      <tr>
        <td>OffLoading City / Area</td>
        <?php foreach ($products as $product) { ?>
        <td >                      
                <?php echo $products[$product['product_id']]['offloading_city']; ?>
        </td>
        <?php } ?>
      </tr>
      
      <tr>
        <td>Loading date</td>
        <?php foreach ($products as $product) { ?>
        <td>         
            <?php if( isset($products[$product['product_id']]['loading_date'] ) ) ?>
                <?php echo $products[$product['product_id']]['loading_date']; ?>
        </td>
        <?php } ?>
      </tr>
      
      <tr>
        <td>Trailer type</td>
        <?php foreach ($products as $product) { ?>
        <td>         
                <?php echo $products[$product['product_id']]['trailer']['name']; ?>
        </td>
        <?php } ?>
      </tr>
              
      <tr>
        <td>Lift</td>
        <?php foreach ($products as $product) { ?>
        <td>         
            <?php if( $products[$product['product_id']]['lift']== 0 ) { ?>
                <img width="20" src="image/no.png">
            <?php } else { ?>
                <img width="20" src="image/yes.png">
            <?php } ?>              
        </td>
        <?php } ?>
      </tr>
      
      <tr>
        <td>Manipulator</td>
        <?php foreach ($products as $product) { ?>
        <td>         
            <?php if( $products[$product['product_id']]['manipulator']== 0 ) { ?>
                <img width="20" src="image/no.png">
            <?php } else { ?>
                <img width="20" src="image/yes.png">
            <?php } ?>              
        </td>
        <?php } ?>
      </tr>
      
            <tr>
        <td>ADR</td>
        <?php foreach ($products as $product) { ?>
        <td>    
            <?php if( $products[$product['product_id']]['adr']== 0 ) { ?>
                <img width="20" src="image/no.png">
            <?php } else { ?>
                <img width="20" src="image/yes.png">
            <?php } ?>                
        </td>
        <?php } ?>
      </tr>
      
     <tr>
        <td>TIR</td>
        <?php foreach ($products as $product) { ?>
        <td>         
            <?php if( $products[$product['product_id']]['tir']== 0 ) { ?>
                <img width="20" src="image/no.png">
            <?php } else { ?>
                <img width="20" src="image/yes.png">
            <?php } ?>              
        </td>
        <?php } ?>
      </tr>
      
      <tr>
        <td>CMR</td>
        <?php foreach ($products as $product) { ?>
        <td>         
            <?php if( $products[$product['product_id']]['cmr']== 0 ) { ?>
                <img width="20" src="image/no.png">
            <?php } else { ?>
                <img width="20" src="image/yes.png">
            <?php } ?>              
        </td>
        <?php } ?>
      </tr>
      
     <tr>
        <td>CEMT</td>
        <?php foreach ($products as $product) { ?>
        <td>         
            <?php if( $products[$product['product_id']]['cemt']== 0 ) { ?>
                <img width="20" src="image/no.png">
            <?php } else { ?>
                <img width="20" src="image/yes.png">
            <?php } ?>              
        </td>
        <?php } ?>
      </tr>
      
      <tr>
        <td>Parameters</td>
        <?php foreach ($products as $product) { ?>
        <td>         
            <?php if( $products[$product['product_id']]['freight_params'] == 0 ) { ?>
                <img width="20" src="image/yes.png"> Ftl
                <img width="20" src="image/no.png"> Ltl
            <?php } else { ?>
                <img width="20" src="image/no.png"> Ftl
                <img width="20" src="image/yes.png"> Ltl
            <?php } ?>              
        </td>
        <?php } ?>
      </tr>
      
      <tr>
        <td>Weight tons</td>
        <?php foreach ($products as $product) { ?>
        <td >                      
                <?php echo $products[$product['product_id']]['weight_tons']; ?>
        </td>
        <?php } ?>
      </tr>
      
     <tr>
        <td>Pallets no</td>
        <?php foreach ($products as $product) { ?>
        <td >                      
                <?php echo $products[$product['product_id']]['pallets_no']; ?>
        </td>
        <?php } ?>
      </tr>
      
      <tr>
        <td>Exchangeable</td>
        <?php foreach ($products as $product) { ?>
        <td >        
                <?php if($products[$product['product_id']]['exchangeable'] == 0 ) { ?> 
                Exchangeable
                <?php } else { ?>
                Non Exchangeable
                <?php } ?>
        </td>
        <?php } ?>
      </tr>
      
     <tr>
        <td>Stackable</td>
        <?php foreach ($products as $product) { ?>
        <td>     
                <?php if($products[$product['product_id']]['stackable'] == 0 ) { ?> 
                Stackable
                <?php } else { ?>
                Non Stackable
                <?php } ?>  
        </td>
        <?php } ?>
      </tr>
      
      <tr>
        <td>Volume & unit</td>
        <?php foreach ($products as $product) { ?>
        <td>        
                <?php echo $products[$product['product_id']]['volume_unit']; ?>
        </td>
        <?php } ?>
      </tr>
      
       <tr>
        <td>Images</td>
        <?php foreach ($products as $product) { ?>
        <td>      
        <?php foreach ($products[$product['product_id']]['images'] as $image) { ?>      
           <a style="padding: 10px;" href="<?php echo $image['popup']; ?>" title="<?php echo $heading_title; ?>" rel="lightbox[plants]" ><img src="<?php echo $image['thumb']; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" /></a>
        <?php }  ?>    
        </td>
        <?php } ?>
      </tr>
      
  
    </tbody>
    <?php foreach ($attribute_groups as $attribute_group) { ?>
    <thead>
      <tr>
        <td class="compare-attribute" colspan="<?php echo count($products) + 1; ?>"><?php echo $attribute_group['name']; ?></td>
      </tr>
    </thead>
    <?php foreach ($attribute_group['attribute'] as $key => $attribute) { ?>
    <tbody>
      <tr>
        <td><?php echo $attribute['name']; ?></td>
        <?php foreach ($products as $product) { ?>
        <?php if (isset($products[$product['product_id']]['attribute'][$key])) { ?>
        <td><?php echo $products[$product['product_id']]['attribute'][$key]; ?></td>
        <?php } else { ?>
        <td></td>
        <?php } ?>
        <?php } ?>
      </tr>
    </tbody>
    <?php } ?>
    <?php } ?>
    
    <!--<tr>
      <td></td>
      <?php foreach ($products as $product) { ?>
      <td><input type="button" value="<?php echo $button_cart; ?>" onclick="addToCart('<?php echo $product['product_id']; ?>');" class="button" /></td>
      <?php } ?>
    </tr> -->
    
    <tr>
      <td></td>
      <?php foreach ($products as $product) { ?>
      <td class="remove">
          <a href="<?php echo $product['remove']; ?>" class="button">
              <?php echo $button_remove; ?>
          </a>
      </td>
      <?php } ?>
    </tr>
    
    <tr>
      <td></td>
      <?php foreach ($products as $product) { ?>
      <td class="details">
          <a href="<?php echo $product['details']; ?>" class="button" target="_black" >
              Details
          </a>
      </td>
      <?php } ?>
    </tr>
    
  </table>
  <div class="buttons">
    <div class="right"><a href="<?php echo $continue; ?>" class="button"><?php echo $button_continue; ?></a></div>
  </div>
  <?php } else { ?>
  <div class="content"><?php echo $text_empty; ?></div>
  <div class="buttons">
    <div class="right"><a href="<?php echo $continue; ?>" class="button"><?php echo $button_continue; ?></a></div>
  </div>
  <?php } ?>
  <?php echo $content_bottom; ?></div>
<?php echo $footer; ?>