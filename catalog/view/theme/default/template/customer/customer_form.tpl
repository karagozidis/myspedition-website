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
  <div class="box">
    <div class="heading">
        <h1>
            <img src="image/company.png" width="26" height="26" alt="" /> <?php echo $company; ?>
        </h1>
        
     <!-- <div class="buttons">
          <a onclick="$('#form').submit();" class="button">
              <?php echo $button_save; ?>
          </a>
          <a href="<?php echo $cancel; ?>" class="button">
              <?php echo $button_cancel; ?>
          </a>
      </div>-->
      
    </div>
      
      
      
      <div class="content center" style="padding: 0px; padding-left: 10px;padding-right: 10px;" >
         <!-- <span id="divOnline" class="right" style="width: 80px; display: none;  padding: 10px; color: green;">
              online <img width="10" src="image/online.png">
          </span>
          <span id="divOffline" class="right" style="width: 80px;display: none;  padding: 10px; color: red;">
              offline <img width="10" src="image/offline.png">
          </span>
          <span id="divSearcing" class="right" style=" width: 80px; padding: 10px; color: gray;">
              Searching <img width="10" src="image/loading.gif">
          </span>
          <span class="right" style=" width: 20px; padding: 10px;">Status</span>-->
          
          <div id=""></div>
                <?php if($isFavorite) { ?>
                <div id="divRem" style="font-size: 150%;">
                   <table>
                      <tr> 
                         <td>
                            <a href="<?php echo $myfavorites; ?>" target="_blank">
                                <img src="image/favoritecompany.png" width="30">
                            </a>
                         </td>
                          <td>
                             <a href="<?php echo $myfavorites; ?>" target="_blank">
                                 [My Favorite Companies]
                             </a>
                          </td>
                          <td>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a onclick="addToInterestCompany('<?php echo $customer_id; ?>');">
                                <img id="myfavorite" src="image/remFavorite.png" width="30"> 
                            </a>
                          </td>
                          <td>
                              <a onclick="addToInterestCompany('<?php echo $customer_id; ?>');">
                                Remove
                              </a>
                          </td>
                      </tr>
                    </table> 
                </div>
                <div id="divAdd" style="display: none; font-size: 150;">
                  <table>
                        <tr> 
                             <td>  
                                 <a href="<?php echo $myfavorites; ?>" target="_blank">
                                     <img src="image/favoritecompany.png" width="30">
                                 </a>   
                             </td>
                             <td>
                                  <a href="<?php echo $myfavorites; ?>" target="_blank">
                                     [My Favorite Companies]
                                  </a>
                             </td>
                              <td>
                                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  <a onclick="addToInterestCompany('<?php echo $customer_id; ?>');">
                                    <img id="myfavorite" src="image/addFavorite.png" width="30"> 
                                  </a>
                              <td>
                              <td>
                                  <a onclick="addToInterestCompany('<?php echo $customer_id; ?>');">
                                     Add to favorites 
                                  </a>
                            </td>  
                     </tr>
                  </table>
                </div>
                <?php } else { ?>
                <div id="divRem" style="display: none; font-size: 150%;" >
                   <table>
                     <tr> 
                           <td>
                              <a href="<?php echo $myfavorites; ?>" target="_blank"> 
                                   <img src="image/favoritecompany.png" width="30">
                              </a>
                           </td>
                            <td>
                                <a href="<?php echo $myfavorites; ?>" target="_blank">
                                   [My Favorite Companies]
                                </a>
                            </td>
                             <td>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <a onclick="addToInterestCompany('<?php echo $customer_id; ?>');">
                                    <img id="myfavorite" src="image/remFavorite.png" width="30"> 
                                </a>
                              <td>
                              <td> 
                                <a onclick="addToInterestCompany('<?php echo $customer_id; ?>');">
                                    Remove
                                </a>
                              </td>  
                     </tr>
                   </table>
                </div>
                <div id="divAdd" style="font-size: 150%;">
                   <table>
                     <tr> 
                        <td>
                            <a href="<?php echo $myfavorites; ?>" target="_blank"> 
                                <img src="image/favoritecompany.png" width="30">
                            </a>
                        </td>
                        <td>
                            <a href="<?php echo $myfavorites; ?>" target="_blank">
                                [My Favorite Companies]
                            </a>
                        </td>
                        <td>
                             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a onclick="addToInterestCompany('<?php echo $customer_id; ?>');">
                                <img id="myfavorite" src="image/addFavorite.png" width="30"> 
                            </a>
                         <td>
                         <td>
                            <a onclick="addToInterestCompany('<?php echo $customer_id; ?>');">
                                Add to favorites 
                            </a>
                        </td> 
                      </tr>
                   </table>
                </div>
                <?php } ?>
          
     </div>  
      
      <div id="htabs" class="htabs">
        <a href="#tab-general">
            <?php echo $general_text; ?>        
        </a>
        <a href="#tab-freights">
            <?php echo $freights_text; ?>             
        </a>
        <a href="#tab-trucks">
            <?php echo $trucks_text; ?>            
        </a>  
        <a href="#tab-warehouses">
            Warehouses            
        </a>  
        <a href="#tab-products">
            Products
        </a>  
      </div>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        
          
          
   <?php if ( !isset($isLogged) ) { ?>     
   <table class="list" style="background-color: white;">
        <tr align="center" style="border-style:ridge;border-color:#98bf21;" height="200">  
            <td colspan="2"  >  
                  <a href="?route=account/login" style="font-size:450%;color:#3366CC;text-decoration: none;" > 
                    <?php echo $register_login_text; ?>
                  </a>
            </td>      
        </tr>
     </table>
     <?php } else {   ?>     
 
      <div id="tab-products"   style="background: #FFFFFF;">
          <br>
       <?php if ($products) { ?>   
         <table class="list1">
          <thead>
            <tr>
              <td width="1" style="text-align: center;">
              </td>
              <td class="center">
                  Image
              </td>
              <td class="left">
                 Name
              </td>
              <td class="left">
                 Price
              </td>
              <td class="right">
                 Quantity
              </td>

              <td class="right">
              </td>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($products as $product) { ?>
            <tr>
              <td style="text-align: center;"><?php if ($product['selected']) { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $product['product_id']; ?>" checked="checked" />
                <?php } else { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $product['product_id']; ?>" />
                <?php } ?></td>
              <td class="center"><img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" style="padding: 1px; border: 1px solid #DDDDDD;" /></td>
              <td class="left"><?php echo $product['name']; ?></td>
              <!--<td class="left"><?php echo $product['model']; ?></td>-->
              <td class="left">
                  
               <?php if ($product['price'] == 0)$product['price'] = '----';  ?>  
               
               <?php if ($product['special']) { ?>
                <span style="text-decoration: line-through;"><?php echo $product['price']; ?></span><br/>
                <span style="color: #b00;"><?php echo $product['special']; ?></span>
                <?php } else { ?>
                <?php echo $product['price']; ?>
                <?php } ?>
              </td>
              <td class="right"><?php if ($product['quantity'] <= 0) { ?>
                <span style="color: #FF0000;"><?php echo $product['quantity']; ?></span>
                <?php } elseif ($product['quantity'] <= 5) { ?>
                <span style="color: #FFA500;"><?php echo $product['quantity']; ?></span>
                <?php } else { ?>
                <span style="color: #008000;"><?php echo $product['quantity']; ?></span>
                <?php } ?>
              </td>

              <td class="right">    
               <a href="?route=product/product&path=20_27&product_id=<?php echo $product['product_id']; ?>" style="text-decoration: none;" target="_blank" class="button">
                  See Details
               </a>  
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
       <?php } else { ?>
       <br><br><br><br><br><br>
       <?php } ?>
      </div>
  
   <?php } ?>       
          
          
          
          
          
          
          
      <div id="tab-warehouses" style="background: #FFFFFF;">
          
           
            
         <?php if ( !isset($isLogged) ) { ?>     
         <table class="list">
            <tr align="center" style="border-style:ridge;border-color:#98bf21;" height="200">  
                <td colspan="2"  >  
                      <a href="?route=account/login" style="font-size:450%;color:#3366CC;text-decoration: none;" > 
                        <?php echo $register_login_text; ?>
                      </a>
                </td>      
            </tr>
         </table>
         <?php } else {   ?> 
              
         <?php if ( $warehouses ) { ?>     
                <br>
                 <table class="list">
                 <thead>
                   <tr>
                     <td class="center"></td>
                     <td class="left">Manager Name</td>
                     <td>
                        Warehouse
                     </td>
                     <td class="left">
                        Warehouse Id
                     </td>
                     <td>
                        Country
                     </td>
                     <td class="right">
                        Region / State
                     </td>
                     <td class="left">
                        Address 1
                     </td>
                     <td class="right">
                        City
                     </td>
                     <td class="left">
                        Telephone
                     </td>
                     <td class="left">
                        Post Code
                     </td>
                     <td></td>
                   </tr>
                 </thead>
                 <tbody>

                   <?php if ( $warehouses ) { ?>
                   <?php foreach ($warehouses as $warehouse) { ?>
                   <tr>
                     <td class="center">
                     <img src="image/warehouse.png" width="25" height="25" style="padding: 1px; border: 1px solid #DDDDDD;" />
                     </td>
                     <td class="left">
                        <?php echo $warehouse['firstname']. ' ' . $warehouse['lastname']; ?>
                     </td>
                      <td>
                        <?php echo $warehouse['company'];  ?>
                     </td>
                     <td class="left">
                     <?php echo $warehouse['company_id'];  ?>
                     </td>
                     
                     <td>
                        <img src="image/flags/<?php echo strToLower($warehouse['iso_code_2']);?>.png"> 
                        <?php echo $warehouse['country'];  ?>
                     </td>
                     <td class="right">
                         <?php echo $warehouse['zone'];  ?>
                     </td>
                     
                     <td class="left">
                        <?php echo $warehouse['address_1'];  ?>
                       </td>
                     <td class="right">
                       <?php echo $warehouse['city'];  ?>
                     </td>
                     <td class="left">
                        <?php echo $warehouse['telephone'];  ?>
                     </td>
                     <td class="left">
                        <?php echo $warehouse['postcode'];  ?>
                     </td>
                     <td>
                        <a class="button" href="?route=customer/warehouse/view&address_id=<?php echo $warehouse['address_id']; ?>" target="_blank" >
                            View
                        </a>
                     </td>
                   </tr>
                   <?php } ?>
                   <?php } else { ?>
                   <tr>
                     <td class="center" colspan="16">No results</td>
                   </tr>
                   <?php } ?>
                 </tbody>
               </table>
               <?php } else { ?>      
               <br><br>
               <?php } ?>
         <?php } ?>
     </div>
          
          
          
          
      <div id="tab-trucks" style="background: #FFFFFF;">
            
         <?php if ( !isset($isLogged) ) { ?>     
         <table class="list">
            <tr align="center" style="border-style:ridge;border-color:#98bf21;" height="200">  
                <td colspan="2"  >  
                      <a href="?route=account/login" style="font-size:450%;color:#3366CC;text-decoration: none;" > 
                        <?php echo $register_login_text; ?>
                      </a>
                </td>      
            </tr>
         </table>
         <?php } else {   ?> 
              
                <?php if ( isset($trucks) ) { ?>     
                <br>
                 <table class="list">
                 <thead>
                   <tr>
                     <td class="center"></td>
                     <td class="left"><?php echo $loading_date_text; ?></td>
                      <td>
                        <?php echo $trailer_text; ?> 
                     </td>
                     <td class="left"><?php echo $loading_country_text; ?></td>
                     <td class="left">
                        <?php echo $region_state_text; ?>
                       </td>
                     <td class="left">
                      <?php echo $city_area_text; ?>
                     </td>
                     <td class="right"><?php echo $offloading_country_text; ?> </td>
                       <td class="left">
                      <?php echo $region_state_text; ?>
                       </td>
                     <td class="left"><?php echo $city_area_text; ?></td>
                     <td>
                        <?php echo $company_text; ?>
                     </td>
                     <td class="right"></td>
                   </tr>
                 </thead>
                 <tbody>

                   <?php if ($trucks) { ?>
                   <?php foreach ($trucks as $product) { ?>
                   <tr>

                     <td class="center"><img src="image/truck.png" width="25" height="25" alt="<?php echo $product['name']; ?>" style="padding: 1px; border: 1px solid #DDDDDD;" /></td>
                     <td class="left"><?php echo $product['loading_date']; ?></td>
                     <td><?php  echo $product['trailer']['name']  ?></td>
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
                     <td>
                         <?php echo $product['owner']['company']; ?>
                     </td>
                     <td class="center">

                          <a href="<?php echo $product['href']; ?>">
                               <input type="button" value="See details" class="button" />
                          </a>                    

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
               <br><br><br><br><br>
               <?php } ?>
         <?php } ?>
        </div>
      
          
          
          
    <div id="tab-freights" style="background: #FFFFFF;">
        
        <?php if ( !isset($isLogged) ) { ?>     
         <table class="list">
            <tr align="center" style="border-style:ridge;border-color:#98bf21;" height="200">  
                <td colspan="2"  >  
                      <a href="?route=account/login" style="font-size:450%;color:#3366CC;text-decoration: none;" > 
                        <?php echo $register_login_text; ?>
                      </a>
                </td>      
            </tr>
         </table>
         <?php } else {   ?>           
                                                               
              
                <?php if ( isset($freights) ) { ?>
                <br>
                   <table class="list1">
                           <thead>
                             <tr>
                               <td class="center"></td>
                               <td class="left"><?php echo $loading_date_text; ?></td>
                               <td>
                                  <?php echo $trailer_text; ?>
                               </td> 
                               <td><?php echo $loading_country_text; ?></td>
                                 <td class="left">
                                    <?php echo $region_state_text; ?>
                                 </td>
                               <td class="left"><?php echo $city_area_text; ?></td>
                               <td class="right"><?php echo $offloading_country_text; ?> 
                               </td>
                                 <td class="right">
                                 <?php echo $region_state_text; ?>
                                 </td>          
                               <td class="left"><?php echo $city_area_text; ?></td>
                               <td>
                                   <?php echo $company_text; ?>
                               </td>
                               <td class="right"></td>
                             </tr>
                           </thead>
                           <tbody>

                           <?php if ($freights) { ?>
                           <?php foreach ($freights as $product) { ?>
                             <tr>

                               <td class="center"><img src="image/freight.png" width="25" height="25" alt="<?php echo $product['name']; ?>" style="padding: 1px; border: 1px solid #DDDDDD;" /></td>
                               <td class="left"><?php echo $product['loading_date']; ?></td>
                               <td><?php  echo $product['trailer']['name']  ?></td>
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
                               <td>
                                   <?php echo $product['owner']['company']; ?>
                               </td>
                               <td class="center">

                                    <a href="<?php echo $product['href']; ?>">
                                         <input type="button" value="See details" onclick="addToCart('<?php echo $product['product_id']; ?>');" class="button" />
                                    </a>                   

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
                      <br><br><br><br><br>
               <?php } ?>
               
        <?php } ?>                                                  
    </div>
          
    <div id="tab-general" style="background: #FFFFFF;">
        <?php if ( !isset($isLogged) ) { ?>     
         <table class="list">
            <tr align="center" style="border-style:ridge;border-color:#98bf21;" height="200">  
                <td colspan="2"  >  
                      <a href="?route=account/login" style="font-size:450%;color:#3366CC;text-decoration: none;" > 
                        <?php echo $register_login_text; ?>
                      </a>
                </td>      
            </tr>
         </table>
        <?php } else {   ?>   
         
             <div id="vtabs" class="vtabs">
                  <a href="#tab-customer">
                      <?php echo $owner_text; ?>                
                  </a>
                <?php $address_row = 1; ?>
                <?php foreach ($addresses as $address) { ?>
                <a href="#tab-address-<?php echo $address_row; ?>" id="address-<?php echo $address_row; ?>">
                   <?php echo $company_address_text; ?><?php echo $address_row; ?>
                </a>
                <?php $address_row++; ?>
                <?php } ?>         
              </div>
              <div id="tab-customer" class="vtabs-content">
                <table class="form">
                    
                  <tr>
                    <td><?php echo $company_name_text; ?></td>
                    <td>
                         <input type="text" name="" value="<?php echo $company; ?>" size="40" readonly/>               
                    </td>    
                    <td rowspan=5  align="left" valign="top" >
                        <br>
                        <image width="180"  src="image/<?php echo $company_logo ?>" />
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </td>
                  </tr>
                  <tr>
                    <td><?php echo $type_text; ?></td>
                    <td>
                         <input type="text" name="" value="<?php echo $company_type['name']; ?>" size="40" readonly/>                                 
                    </td>                          
                  </tr>
                  <tr>
                    <td><?php echo $country_text; ?></td>
                    <td> 
                        <table>
                            <tr>
                                <td style="width:5px;padding:0px;">
                                  <img src="image/flags/<?php echo strToLower($country['iso_code_2']); ?>.png">
                                </td>
                                <td>
                                   <input type="text" name="" value="<?php echo $country['name']; ?>" size="35" readonly/>                               
                                </td>       
                            </tr>  
                        </table>
                    </td>
                  </tr> 
                  <tr>
                    <td>Interest Countries</td>
                    <td> 
                        <?php foreach($interestCountries as $interestCountry) { ?>
                        <img src="image/flags/<?php echo strToLower($interestCountry['iso_code_2']); ?>.png" title="<?php echo $interestCountry['name']; ?>">
                        <?php } ?>                     
                    </td>                          
                  </tr>    
                  <tr>
                    <td> <?php echo $entry_firstname; ?></td>
                    <td><input type="text" name="firstname" value="<?php echo $firstname; ?>" size="40" readonly  />
                    </td>
                  </tr>
                  <tr>
                    <td> 
                        <?php echo $entry_lastname; ?>
                    </td>
                    <td>
                        <input type="text" name="lastname" value="<?php echo $lastname; ?>" size="40" readonly/>
                    </td>
                    <td rowspan="3" style="padding: 0px;" >
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                             <?php if($cg_image != "") { ?>
                             <a href="?route=information/information&information_id=10">
                                <image width="130" height="130" src="<?php echo $cg_image; ?>" />
                             </a>
                             <?php } ?>
                    </td>
                  </tr>
                  <tr>
                    <td>
                        <?php echo $entry_email; ?>
                    </td>
                    <td>
                        <?php if($view_mail == true) { ?>
                        <input type="text" name="email" value="<?php echo $email; ?>" size="40" readonly/>
                        <?php } else {  ?>
                           <div style="font-weight: normal;border: 1px solid #EEEEEE;background: #E6E6E6;cursor: pointer;">
                                  <a href="<?php echo $upgradeUrl; ?>">
                                            <?php echo html_entity_decode($upgradeSmallText['text']); ?>
                                  </a>   
                            </div> 
                        <?php } ?>
                    </td>
                  </tr>

                  <tr>
                    <td>
                            <?php echo $entry_telephone; ?>
                    </td>
                    <td>
                         <?php if($view_telephone == true) { ?> 
                            <input type="text" name="telephone" value="<?php echo $telephone; ?>" size="40" readonly/>
                         <?php } else {  ?>
                           <div class="show_hide"  style="font-weight: normal;border: 1px solid #EEEEEE;background: #E6E6E6;cursor: pointer;">
                               <a href="<?php echo $upgradeUrl; ?>">
                                    <?php echo html_entity_decode($upgradeSmallText['text']); ?>
                               </a>   
                            </div> 
                        <?php } ?>
                    </td>
                  </tr>
                  <tr>
                    <td>
                        <?php echo $entry_fax; ?>
                    </td>
                    <td>
                         <?php if($view_fax == true) { ?> 
                           <input type="text" name="fax" value="<?php echo $fax; ?>" size="40" readonly/>
                         <?php } else {  ?>
                           <div class="show_hide"  style="font-weight: normal;border: 1px solid #EEEEEE;background: #E6E6E6;cursor: pointer;">
                                  <a href="<?php echo $upgradeUrl; ?>">
                                                    <?php echo html_entity_decode($upgradeSmallText['text']); ?>
                                  </a>   
                           </div> 
                        <?php } ?>
                    </td>
                    <td rowspan="4" style="padding: 0px;" >
                        <?php if($verified == 3) { ?>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                             <image width="130" height="130" src="image/verified.png" />
                        <?php } ?>
                    </td>
                  </tr>     
                  <tr>
                    <td>
                        Skype
                    </td>
                    <td>
                         <?php if($view_skype == true) { ?> 
                           <input type="text" name="skype" value="<?php echo $skype; ?>" size="40" readonly/>
                         <?php } else {  ?>
                           <div style="font-weight: normal;border: 1px solid #EEEEEE;background: #E6E6E6;cursor: pointer;">
                                 <a href="<?php echo $upgradeUrl; ?>">
                                        <?php echo html_entity_decode($upgradeSmallText['text']); ?>
                                 </a>
                           </div> 
                        <?php } ?>
                        
                    </td>
                  </tr>   
                  <tr>
                    <td>
                        Icq
                    </td>
                    <td>
                         <?php if($view_icq == true) { ?> 
                          <input type="text" name="icq" value="<?php echo $icq; ?>" size="40" readonly/>
                         <?php } else {  ?>
                          <div style="font-weight: normal;border: 1px solid #EEEEEE;background: #E6E6E6;cursor: pointer;">
                                 <a href="<?php echo $upgradeUrl; ?>">
                                      <?php echo html_entity_decode($upgradeSmallText['text']); ?>
                                 </a>   
                          </div> 
                        <?php } ?>
                    </td>
                  </tr> 
                  <tr>
                    <td>
                        WebSite
                    </td>
                    <td>
                         <?php if($view_website == true) { ?> 
                           <input type="text" name="website" value="<?php echo $website; ?>" size="40" readonly/>
                         <?php } else {  ?>
                           <div class="show_hide"  style="font-weight: normal;border: 1px solid #EEEEEE;background: #E6E6E6;cursor: pointer;">
                                  <a href="<?php echo $upgradeUrl; ?>">
                                       <?php echo html_entity_decode($upgradeSmallText['text']); ?>
                                  </a>   
                            </div> 
                        <?php } ?>
                    </td>
                  </tr> 


                 <tr>
                    <td colspan="3">
                            <?php echo $description; ?>
                    </td>                          
                  </tr>
                </table>
              </div>
              <?php $address_row = 1; ?>
              <?php foreach ($addresses as $address) { ?>
              <div id="tab-address-<?php echo $address_row; ?>" class="vtabs-content">
                <input type="hidden" name="address[<?php echo $address_row; ?>][address_id]" value="<?php echo $address['address_id']; ?>" />
                <table class="form">

                  <tr>
                    <td>
                        <?php echo $entry_firstname; ?>
                    </td>
                    <td>
                        <input type="text" name="address[<?php echo $address_row; ?>][firstname]" value="<?php echo $address['firstname']; ?>" size="40" readonly />               
                    </td>
                  </tr>

                  <tr>
                    <td>
                        <?php echo $entry_lastname; ?>
                    </td>
                    <td>
                        <input type="text" name="address[<?php echo $address_row; ?>][lastname]" value="<?php echo $address['lastname']; ?>" size="40" readonly />                 
                    </td>
                  </tr>

                  <tr>
                    <td>
                        <?php echo $entry_company; ?>
                    </td>
                    <td>
                        <input type="text" name="address[<?php echo $address_row; ?>][company]" value="<?php echo $address['company']; ?>" size="40" readonly />
                    </td>
                  </tr>

                  <tr class="company-id-display">
                    <td>
                        <?php echo $entry_company_id; ?>
                    </td>
                    <td>
                        <input type="text" name="address[<?php echo $address_row; ?>][company_id]" value="<?php echo $address['company_id']; ?>" size="40" readonly />
                    </td>
                  </tr>            

                  <tr>
                    <td>
                        <?php echo $entry_address_1; ?>
                    </td>
                    <td>
                        <input type="text" name="address[<?php echo $address_row; ?>][address_1]" value="<?php echo $address['address_1']; ?>" size="40" readonly />
                    </td>
                  </tr>

                  <tr>
                    <td><?php echo $entry_address_2; ?></td>
                    <td>
                        <input type="text" name="address[<?php echo $address_row; ?>][address_2]" value="<?php echo $address['address_2']; ?>" size="40" readonly />
                    </td>
                  </tr>

                  <tr>
                    <td>
                        <?php echo $entry_city; ?>
                    </td>
                    <td>
                        <input type="text" name="address[<?php echo $address_row; ?>][city]" value="<?php echo $address['city']; ?>" size="40" readonly />
                    </td>
                  </tr>

                  <tr>
                    <td>
                        <?php echo $entry_postcode; ?>
                    </td>
                    <td>
                        <input type="text" name="address[<?php echo $address_row; ?>][postcode]" value="<?php echo $address['postcode']; ?>" size="40" readonly />
                    </td>
                  </tr>

                  <tr>
                    <td>
                        <?php echo $entry_country; ?>
                    </td>
                    <td>
                        <?php foreach ($countries as $country) { ?>
                        <?php if ($country['country_id'] == $address['country_id']) { ?>
                        <input type="text" name="" value="<?php echo $country['name']; ?>"  size="40" readonly/>
                        <?php } ?>
                        <?php } ?>                                                 
                    </td>
                  </tr>
                  <tr>
                    <td>
                        <?php echo $entry_zone; ?>
                    </td>
                    <td>
                        <?php if( isset($address['zone']) ) {  ?>
                        <input type="text" value="<?php echo $address['zone']; ?>">
                        <?php } else  { ?>
                        <input type="text" value="">
                        <?php } ?>

                    </td>
                  </tr>
                </table>
              </div>
              <?php $address_row++; ?>
              <?php } ?>
         <?php } ?>
    </div>
          
          
          
          
        <?php if ($customer_id) { ?>
        <?php } ?>
      </form>
  </div>
</div>

<script type="text/javascript"><!--

setInterval(function(){
isOnline(<?php echo $customer_id; ?>);
},3000);
</script> 

<script type="text/javascript"><!--
$('select[name=\'customer_group_id\']').live('change', function() {
	var customer_group = [];
	
<?php foreach ($customer_groups as $customer_group) { ?>
	customer_group[<?php echo $customer_group['customer_group_id']; ?>] = [];
	customer_group[<?php echo $customer_group['customer_group_id']; ?>]['company_id_display'] = '<?php echo $customer_group['company_id_display']; ?>';
	customer_group[<?php echo $customer_group['customer_group_id']; ?>]['tax_id_display'] = '<?php echo $customer_group['tax_id_display']; ?>';
<?php } ?>	

	if (customer_group[this.value]) {
		if (customer_group[this.value]['company_id_display'] == '1') {
			$('.company-id-display').show();
		} else {
			$('.company-id-display').hide();
		}
		
		if (customer_group[this.value]['tax_id_display'] == '1') {
			$('.tax-id-display').show();
		} else {
			$('.tax-id-display').hide();
		}
	}
});

$('select[name=\'customer_group_id\']').trigger('change');
//--></script> 
<script type="text/javascript"><!--
function country(element, index, zone_id) {
  if (element.value != '') {
		$.ajax({
			url: 'index.php?route=sale/customer/country&country_id=' + element.value,
			dataType: 'json',
			beforeSend: function() {
				$('select[name=\'address[' + index + '][country_id]\']').after('<span class="wait">&nbsp;<img src="view/image/loading.gif" alt="" /></span>');
			},
			complete: function() {
				$('.wait').remove();
			},			
			success: function(json) {
				if (json['postcode_required'] == '1') {
					$('#postcode-required' + index).show();
				} else {
					$('#postcode-required' + index).hide();
				}
				
				html = '<option value=""><?php echo $text_select; ?></option>';
				
				if (json['zone'] != '') {
					for (i = 0; i < json['zone'].length; i++) {
						html += '<option value="' + json['zone'][i]['zone_id'] + '"';
						
						if (json['zone'][i]['zone_id'] == zone_id) {
							html += ' selected="selected"';
						}
		
						html += '>' + json['zone'][i]['name'] + '</option>';
					}
				} else {
					html += '<option value="0"><?php echo $text_none; ?></option>';
				}
				
				$('select[name=\'address[' + index + '][zone_id]\']').html(html);
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	}
}

$('select[name$=\'[country_id]\']').trigger('change');
//--></script> 
<script type="text/javascript"><!--
$('#history .pagination a').live('click', function() {
	$('#history').load(this.href);
	
	return false;
});			

$('#history').load('index.php?route=sale/customer/history&token=<?php echo $token; ?>&customer_id=<?php echo $customer_id; ?>');

$('#button-history').bind('click', function() {
	$.ajax({
		url: 'index.php?route=sale/customer/history&token=<?php echo $token; ?>&customer_id=<?php echo $customer_id; ?>',
		type: 'post',
		dataType: 'html',
		data: 'comment=' + encodeURIComponent($('#tab-history textarea[name=\'comment\']').val()),
		beforeSend: function() {
			$('.success, .warning').remove();
			$('#button-history').attr('disabled', true);
			$('#history').before('<div class="attention"><img src="view/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');
		},
		complete: function() {
			$('#button-history').attr('disabled', false);
			$('.attention').remove();
      		$('#tab-history textarea[name=\'comment\']').val('');
		},
		success: function(html) {
			$('#history').html(html);
			
			$('#tab-history input[name=\'comment\']').val('');
		}
	});
});
//--></script> 
<script type="text/javascript"><!--
$('#transaction .pagination a').live('click', function() {
	$('#transaction').load(this.href);
	
	return false;
});			

$('#transaction').load('index.php?route=sale/customer/transaction&token=<?php echo $token; ?>&customer_id=<?php echo $customer_id; ?>');

$('#button-transaction').bind('click', function() {
	$.ajax({
		url: 'index.php?route=sale/customer/transaction&token=<?php echo $token; ?>&customer_id=<?php echo $customer_id; ?>',
		type: 'post',
		dataType: 'html',
		data: 'description=' + encodeURIComponent($('#tab-transaction input[name=\'description\']').val()) + '&amount=' + encodeURIComponent($('#tab-transaction input[name=\'amount\']').val()),
		beforeSend: function() {
			$('.success, .warning').remove();
			$('#button-transaction').attr('disabled', true);
			$('#transaction').before('<div class="attention"><img src="view/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');
		},
		complete: function() {
			$('#button-transaction').attr('disabled', false);
			$('.attention').remove();
		},
		success: function(html) {
			$('#transaction').html(html);
			
			$('#tab-transaction input[name=\'amount\']').val('');
			$('#tab-transaction input[name=\'description\']').val('');
		}
	});
});
//--></script> 
<script type="text/javascript"><!--
$('#reward .pagination a').live('click', function() {
	$('#reward').load(this.href);
	
	return false;
});			

$('#reward').load('index.php?route=sale/customer/reward&token=<?php echo $token; ?>&customer_id=<?php echo $customer_id; ?>');

function addRewardPoints() {
	$.ajax({
		url: 'index.php?route=sale/customer/reward&token=<?php echo $token; ?>&customer_id=<?php echo $customer_id; ?>',
		type: 'post',
		dataType: 'html',
		data: 'description=' + encodeURIComponent($('#tab-reward input[name=\'description\']').val()) + '&points=' + encodeURIComponent($('#tab-reward input[name=\'points\']').val()),
		beforeSend: function() {
			$('.success, .warning').remove();
			$('#button-reward').attr('disabled', true);
			$('#reward').before('<div class="attention"><img src="view/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');
		},
		complete: function() {
			$('#button-reward').attr('disabled', false);
			$('.attention').remove();
		},
		success: function(html) {
			$('#reward').html(html);
								
			$('#tab-reward input[name=\'points\']').val('');
			$('#tab-reward input[name=\'description\']').val('');
		}
	});
}

function addBanIP(ip) {
	var id = ip.replace(/\./g, '-');
	
	$.ajax({
		url: 'index.php?route=sale/customer/addbanip&token=<?php echo $token; ?>',
		type: 'post',
		dataType: 'json',
		data: 'ip=' + encodeURIComponent(ip),
		beforeSend: function() {
			$('.success, .warning').remove();
			
			$('.box').before('<div class="attention"><img src="view/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');		
		},
		complete: function() {
			
		},			
		success: function(json) {
			$('.attention').remove();
			
			if (json['error']) {
				 $('.box').before('<div class="warning" style="display: none;">' + json['error'] + '</div>');
				
				$('.warning').fadeIn('slow');
			}
						
			if (json['success']) {
                $('.box').before('<div class="success" style="display: none;">' + json['success'] + '</div>');
				
				$('.success').fadeIn('slow');
				
				$('#' + id).replaceWith('<a id="' + id + '" onclick="removeBanIP(\'' + ip + '\');"><?php echo $text_remove_ban_ip; ?></a>');
			}
		}
	});	
}

function removeBanIP(ip) {
	var id = ip.replace(/\./g, '-');
	
	$.ajax({
		url: 'index.php?route=sale/customer/removebanip&token=<?php echo $token; ?>',
		type: 'post',
		dataType: 'json',
		data: 'ip=' + encodeURIComponent(ip),
		beforeSend: function() {
			$('.success, .warning').remove();
			
			$('.box').before('<div class="attention"><img src="view/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');					
		},	
		success: function(json) {
			$('.attention').remove();
			
			if (json['error']) {
				 $('.box').before('<div class="warning" style="display: none;">' + json['error'] + '</div>');
				
				$('.warning').fadeIn('slow');
			}
			
			if (json['success']) {
				 $('.box').before('<div class="success" style="display: none;">' + json['success'] + '</div>');
				
				$('.success').fadeIn('slow');
				
				$('#' + id).replaceWith('<a id="' + id + '" onclick="addBanIP(\'' + ip + '\');"><?php echo $text_add_ban_ip; ?></a>');
			}
		}
	});	
};
//--></script> 

<script type="text/javascript" src="catalog/view/javascript/jquery/ui/jquery-ui-timepicker-addon.js"></script> 
<script type="text/javascript" src="catalog/view/javascript/jquery/ui/tabs.js"></script> 
<script type="text/javascript"><!--
$('.htabs a').tabs();
$('.vtabs a').tabs();
//--></script> 

<?php echo $footer; ?>