<?php echo $column_left; ?>
<?php echo $column_right; ?>
<div id="content">
  

  <div class="tblHeader"> <?php echo $last_entered_freights_text; ?></div>
  <?php if (isset($freights)) { ?>
  <table class="list1">
          <thead>
            <tr>
              <td class="center"></td>
              <td class="left"><b><?php echo $loading_date_text; ?></b></td>
              <!--<td><b>Trailer</b></td>-->
              <td>Est</td>
              <td>
                 <?php echo $trailer_text; ?> 
              </td>
              <td style="font-size: 10px;">
                  NO of trucks
              </td>
              <td class="left"><b><?php echo $loading_country_text; ?></b></td>
              <!--<td class="left"><b><?php echo $region_state_text; ?></b></td>-->
              <td class="left"><b><?php echo $city_area_text; ?></b></td>
              <td class="right"><b><?php echo $offloading_country_text; ?> </b></td>
              <!--<td class="right"><b><?php echo $region_state_text; ?></b></td> -->         
              <td class="left"><b><?php echo $city_area_text; ?></b></td>
              <td><b><?php echo $company_text; ?></b></td>         
            </tr>
          </thead>
          <tbody>
            
            <?php if ($freights) { ?>
            <?php foreach ($freights as $product) { ?>
            <tr style="cursor:pointer">

              <td class="center" onclick="parent.location='<?php echo $product['href']; ?>'" >
                  <img src="image/freight.png" width="25" height="25" alt="<?php echo $product['name']; ?>" style="padding: 1px; border: 1px solid #DDDDDD;" />
              </td>
              
              <td class="left" onclick="parent.location='<?php echo $product['href']; ?>'" >
                  <?php echo $product['loading_date']; ?>
              </td>
              <td onclick="parent.location='<?php echo $product['href']; ?>'">
                <?php if($product['est_date'] != 0){ ?>   
                    <i> +-<?php echo $product['est_date']; ?></i>
                <?php } ?>
              </td>
              <td onclick="parent.location='<?php echo $product['href']; ?>'" >
                  <?php  echo $product['trailer']['name'];  ?>
              </td>
              <td onclick="parent.location='<?php echo $product['href']; ?>'">
                  <?php  echo $product['number_of_trucks'];  ?>
              </td>
              <td class="left" onclick="parent.location='<?php echo $product['href']; ?>'" 
                  title="<?php  echo $product['loading_zone']['name'];  ?>">            
                  <?php  if ($product['loading_country'] != null ) { ?>
                  <img src="image/flags/<?php echo strtolower($product['loading_country']['iso_code_2']); ?>.png" >
                  <?php  echo $product['loading_country']['name']; ?>
                  <?php } ?>
              </td>
             <!-- <td class="left" onclick="parent.location='<?php echo $product['href']; ?>'" >
                  <?php 
                  if ( isset($product['loading_zone']['name']) ) 
                        echo $product['loading_zone']['name']; 
                  else
                         echo '---';
                  ?>
              </td>-->
              <td class="left" onclick="parent.location='<?php echo $product['href']; ?>'" >
                  <?php echo $product['loading_city']; ?>
              </td>
              <td class="left" onclick="parent.location='<?php echo $product['href']; ?>'" 
                  title="<?php echo $product['offloading_zone']['name']; ?>" >
                  <?php  if ($product['offloading_country'] != null ) { ?>
                  <img src="image/flags/<?php echo strtolower($product['offloading_country']['iso_code_2']); ?>.png" >
                  <?php  echo $product['offloading_country']['name']; ?>
                  <?php } ?>                                 
              </td>
              <!-- <td class="left" onclick="parent.location='<?php echo $product['href']; ?>'" >
                   <?php 
                   if ( isset($product['offloading_zone']['name']) ) 
                                echo $product['offloading_zone']['name']; 
                   else  echo '---';                    
                   ?>
               </td>-->
              <td class="left" onclick="parent.location='<?php echo $product['href']; ?>'" >
                  <?php echo $product['offloading_city']; ?>
              </td>
              <td class="center"> 
                  <?php echo html_entity_decode($companyViewText['text']); ?>
                 
                 <!-- <a href="?route=customer/customer/update&customer_id=<?php echo $product['owner']['customer_id']; ?>" target="_blank">
                      <?php echo $product['owner']['company']; ?>
                      <?php if($product['owner']['cg_image'] != "") { ?>
                        <img src="<?php echo $product['owner']['cg_image']; ?>" width=20>
                      <?php } ?>
                      <?php if($product['owner']['verified'] == 3) { ?>
                        <img src="image/verified.png" width=25>
                      <?php } ?>
                  </a>-->
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
  <?php } else { ?>
  <table class="list1">
      <tr>
      <td>Empty list!</td>
      </tr>
  </table>
  <?php } ?>
     
  
  
  
  <div class="tblHeader"> <?php echo $last_entered_trucks_text; ?></div>
  <?php if ( isset($trucks) ) { ?>  
  <table class="list1">
      
          <thead>
            <tr>
              <td class="center"></td>
              <td class="left"><b><?php echo $loading_date_text; ?></b></td>
              <!--<td><b><?php echo $trailer_text; ?></b></td>-->
               <td>Est</td>
               <td>
                   <b> <?php echo $trailer_text; ?> <b>
              </td>
              <td style="font-size: 10px;">
                  NO of trucks
              </td>
              <td class="left"><b><?php echo $loading_country_text; ?></b></td>
              <!--<td class="left"><b><?php echo $region_state_text; ?></b></td>-->
              <td class="left"><b><?php echo $city_area_text; ?></b></td>
              <td class="right"><b><?php echo $offloading_country_text; ?> </b></td>
              <!--<td class="left"><b><?php echo $region_state_text; ?></b></td>-->
              <td class="left"><b><?php echo $city_area_text; ?></b></td>
              <td><b><?php echo $company_text; ?></b></td>        
            </tr>
          </thead>
     
          <tbody>
            
            <?php if ($trucks) { ?>
            <?php foreach ($trucks as $product) { ?>
            <tr style="cursor:pointer" >

              <td class="center" onclick="parent.location='<?php echo $product['href']; ?>'" >
                  <img src="image/truck.png" width="25" height="25" alt="<?php echo $product['name']; ?>" style="padding: 1px; border: 1px solid #DDDDDD;" />
              </td>
              <td class="left" onclick="parent.location='<?php echo $product['href']; ?>'" >
                  <?php echo $product['loading_date']; ?>
              </td>
              <!--<td onclick="parent.location='<?php echo $product['href']; ?>'" >
                  <?php  echo $product['trailer']['name']  ?>
              </td>-->
              <td onclick="parent.location='<?php echo $product['href']; ?>'">
                <?php if($product['est_date'] != 0){ ?>   
                    <i> +-<?php echo $product['est_date']; ?></i>
                <?php } ?>
              </td>
              <td onclick="parent.location='<?php echo $product['href']; ?>'" >
                  <?php  echo $product['trailer']['name'];  ?>
              </td>
              <td onclick="parent.location='<?php echo $product['href']; ?>'">
                  <?php  echo $product['number_of_trucks'];  ?>
              </td>
              <td class="left" onclick="parent.location='<?php echo $product['href']; ?>'"  
                  title="<?php echo $product['loading_zone']['name']; ?>">            
                  <?php  if ($product['loading_country'] != null ) { ?>
                  <img src="image/flags/<?php echo strtolower($product['loading_country']['iso_code_2']); ?>.png">
                  <?php  echo $product['loading_country']['name']; ?>
                  <?php } ?>
              </td>
              <!--<td class="left" onclick="parent.location='<?php echo $product['href']; ?>'" >
                  <?php 
                  if ( isset($product['loading_zone']['name']) ) 
                        echo $product['loading_zone']['name']; 
                  else
                         echo '---';
                  ?>
              </td>-->
              <td class="left" onclick="parent.location='<?php echo $product['href']; ?>'" >
                  <?php echo $product['loading_city']; ?>
              </td>
              <td class="left" onclick="parent.location='<?php echo $product['href']; ?>'"
                  title="<?php echo $product['offloading_zone']['name'];  ?>">
                   <?php  if ($product['offloading_country'] != null ) { ?>
                  <img src="image/flags/<?php echo strtolower($product['offloading_country']['iso_code_2']); ?>.png" >
                  <?php  echo $product['offloading_country']['name']; ?>
                  <?php } ?>                                 
              </td>
               <!--<td class="left" onclick="parent.location='<?php echo $product['href']; ?>'" >
                   <?php 
                   if ( isset($product['offloading_zone']['name']) ) 
                                echo $product['offloading_zone']['name']; 
                   else  echo '---';                    
                   ?>
               </td>-->
              <td class="left" onclick="parent.location='<?php echo $product['href']; ?>'" >
                  <?php echo $product['offloading_city']; ?>
              </td>
              <td class="center">  <a href="?route=account/login" style="text-decoration: none;">
                    <?php echo html_entity_decode($companyViewText['text']); ?>
                  </a>
               <!--    <a href="?route=customer/customer/update&customer_id=<?php echo $product['owner']['customer_id']; ?>" target="_blank" >
                      <?php echo $product['owner']['company']; ?>
                      <?php if($product['owner']['cg_image'] != "") { ?>
                        <img src="<?php echo $product['owner']['cg_image']; ?>" width=20>
                      <?php } ?>
                      <?php if($product['owner']['verified'] == 3) { ?>
                        <img src="image/verified.png" width=25>
                      <?php } ?>
                  </a>-->
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
  
    <?php } else { ?>
    <table class="list1">
        <tr>
        <td>Empty list!</td>
        </tr>
    </table>
   <?php } ?>
      
  
  
  
  
 
  

    
  
  
  
  </div>

