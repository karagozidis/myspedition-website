<?php echo $header; ?>
<?php if ($success) { ?>
<div class="success"><?php echo $success; ?></div>
<?php } ?>
<?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content"><?php echo $content_top; ?>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <h1><?php echo $heading_title; ?></h1>
 
  
    <script type="text/javascript">
        $(document).ready(function(){

               <?php if( isset($search) ) 
               echo" $('.slidingDiv').show(); ";
                     ?>

            $('.show_hide').click(function(){
            $(".slidingDiv").slideToggle();
            });

        });
    </script>
  
    <?php if($displayUpgrade) { ?>
    <h2> Become a Premium User Now </h2>
    <div style="font-weight: normal;" class="content">
        
            <div class="show_hide"  style="border: 1px solid #EEEEEE;background: #E6E6E6;cursor: pointer;">
                <?php echo html_entity_decode($upgradeText['text']); ?>
            </div>
            
        <div class="slidingDiv" style="display: none;" >
                <table align="center" valign="top" > 
                  <tr  align="center" valign="top">
                   <?php  foreach($available_customer_groups as $customer_group) { ?>
                   <td  align="center" valign="top" style="padding: 15px;">
                     <table align="center" valign="top" >
                         <tr>
                             <td>    
                                <h2> <?php echo $customer_group['name'];  ?>  </h2>
                             </td>
                         </tr><tr>
                             <td>
                                 <?php echo html_entity_decode($customer_group['description']);  ?>  
                             </td>
                         </tr>

                      </table> 
                     </td>
                    <?php } ?> 
                  </tr>
                </table>

       
            <form action="<?php echo $upgradeAction; ?>" method="post" enctype="multipart/form-data">
                <table class="form1">
                  <tr>
                      <td>
                          <b>Choose your Package:</b> &nbsp;&nbsp;&nbsp; 
                      </td>
                      <td>
                         <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">  
                         <select name="customer_group" >
                          <?php foreach( $customer_groups as $customer_group ) { ?>
                              <option value="<?php echo $customer_group['customer_group_id']; ?>">
                                  <?php echo $customer_group['name']; ?>
                              </option>
                          <?php } ?>
                        </select>
                      </td>
                      <td><input type="submit" value="Upgrade now" class="button" /></td>
                   </tr> 
                    <tr>  
                        <td colspan="3">
                          <a href="?route=information/information&information_id=10" target="_black">
                             See Users and prices in detail from Here  <img src="image/zoom.png" width="16">
                          </a>
                        </td>
                    </tr>
                </table> 
            </form>
      </div>         
    </div>  
   <?php } ?>
  
    <h2><?php echo $manage_freights_trucks_text; ?></h2>
  <div class="content">
  
        <table>
            <tr>
                <td>
                      <a href="index.php?route=catalog/freight" style="font-size: 200%;text-decoration: none;"> 
                        <img src="image/list.png" width="50" height="50">
                      </a>
                </td>
                <td>
                    <a href="index.php?route=catalog/freight" style="font-size: 200%;text-decoration: none;">                        
                           <?php echo $my_freight_list_text; ?> 
                   </a>
                    &nbsp;&nbsp;&nbsp;&nbsp;   
               </td>
               <td>
                    <a href="index.php?route=catalog/freight/insert" style="font-size: 200%;text-decoration: none;">    
                        <img src="image/addload.png" width="50" height="50">
                    </a>
               </td>
                <td>
                    <a href="index.php?route=catalog/freight/insert" style="font-size: 200%;text-decoration: none;">                           
                          <?php echo $add_freight_text; ?>
                    </a>
                </td>
                <td>
                    <a href="index.php?route=catalog/freightOffer/receivedList" style="font-size: 200%;text-decoration: none;">    
                        <img src="image/offersReceived.png" width="35" >
                    </a>
               </td>
                <td>
                    <a href="index.php?route=catalog/freightOffer/receivedList" style="font-size: 100%;text-decoration: none;">                           
                        <?php if ( $freight_offers_new > 0 ) { ?>  
                          <div style="color: red;">
                             <?php echo $freight_offers_new; ?> New quotes
                          </div>
                        <?php } ?>
                        Quotes received for my freights 
                         [<?php echo $freight_offers_total; ?>]
                    </a>
                </td>
                <td>
                    <a href="index.php?route=catalog/freightOffer" style="font-size: 200%;text-decoration: none;">    
                        <img src="image/offersDone.png" width="35" >
                    </a>
               </td>
                <td>
                    <a href="index.php?route=catalog/freightOffer" style="font-size: 100%;text-decoration: none;">                           
                          My quotes for other freights
                          [<?php echo $freight_offers_done_total; ?>]
                    </a>
                </td>
                
             </tr>
             <tr>
                 <td>
                     <a href="index.php?route=catalog/truck" style="font-size: 200%;text-decoration: none;"> 
                       <img src="image/list.png" width="50" height="50">
                     </a>
                 </td>
                <td>
                    <a href="index.php?route=catalog/truck" style="font-size: 200%;text-decoration: none;">                          
                           <?php echo $my_truck_list_text; ?>
                    </a>
                </td>
                <td>
                    <a href="index.php?route=catalog/truck/insert" style="font-size: 200%;text-decoration: none;">        
                      <img src="image/addtruck.png" width="50" height="50">
                    </a>
                </td>
                <td>
                    <a href="index.php?route=catalog/truck/insert" style="font-size: 200%;text-decoration: none;">                           
                          <?php echo $add_truck_text; ?>
                   </a> 
               </td>
            </tr>
            
            
              <tr>
                  <td>
                      <a href="index.php?route=catalog/ship" style="font-size: 200%;text-decoration: none;"> 
                        <img src="image/list.png" width="50" height="50">
                      </a>
                </td>
                <td>
                    <a href="index.php?route=catalog/ship" style="font-size: 200%;text-decoration: none;">                        
                         My Ship routes List
                   </a>
                    &nbsp;&nbsp;&nbsp;&nbsp;   
               </td>
               <td>
                    <a href="index.php?route=catalog/ship/insert" style="font-size: 200%;text-decoration: none;">    
                        <img src="image/ship.png" width="50" height="50">
                    </a>
               </td>
                <td>
                    <a href="index.php?route=catalog/ship/insert" style="font-size: 200%;text-decoration: none;">                           
                         Add Ship route
                    </a>
                </td>
            </tr>
            
             <!-- <tr>
                  <td>
                      <a href="index.php?route=catalog/shipFreight" style="font-size: 200%;text-decoration: none;"> 
                        <img src="image/list.png" width="50" height="50">
                      </a>
                </td>
                <td>
                    <a href="index.php?route=catalog/shipFreight" style="font-size: 200%;text-decoration: none;">                        
                         My Ship freights List
                   </a>
                    &nbsp;&nbsp;&nbsp;&nbsp;   
               </td>
               <td>
                    <a href="index.php?route=catalog/shipFreight/insert" style="font-size: 200%;text-decoration: none;">    
                        <img src="image/shipFreight.png" width="50" height="50">
                    </a>
               </td>
                <td>
                    <a href="index.php?route=catalog/shipFreight/insert" style="font-size: 200%;text-decoration: none;">                           
                         Add Ship Freight
                    </a>
                </td>
            </tr>-->
            
            
            <tr>
                  <td>
                      <a href="index.php?route=account/warehouse" style="font-size: 200%;text-decoration: none;"> 
                        <img src="image/list.png" width="50" height="50">
                      </a>
                </td>
                <td>
                    <a href="index.php?route=account/warehouse" style="font-size: 200%;text-decoration: none;">                        
                         My Warehouse List
                   </a>
                    &nbsp;&nbsp;&nbsp;&nbsp;   
               </td>
               <td>
                    <a href="index.php?route=account/warehouse/insert" style="font-size: 200%;text-decoration: none;">    
                        <img src="image/warehouse.png" width="50" height="50">
                    </a>
               </td>
                <td>
                    <a href="index.php?route=account/warehouse/insert" style="font-size: 200%;text-decoration: none;">                           
                         Add Warehouse
                    </a>
                </td>
            </tr>
        </table>
       
  </div>
  
        <h2>Add products to the e-shop</h2>
  <div class="content">
      
        <table>
            <tr>
                <td>
                      <a href="index.php?route=catalog/product" style="font-size: 200%;text-decoration: none;"> 
                        <img src="image/list.png" width="50" height="50">
                      </a>
                </td>
                <td>
                    <a href="index.php?route=catalog/product" style="font-size: 200%;text-decoration: none;">                        
                           Products list
                   </a>
                    &nbsp;&nbsp;&nbsp;&nbsp;   
               </td>
               <td>
                    <a href="index.php?route=catalog/product/insert" style="font-size: 200%;text-decoration: none;">    
                        <img src="image/product.png" width="50" height="50">
                    </a>
               </td>
                <td>
                    <a href="index.php?route=catalog/product/insert" style="font-size: 200%;text-decoration: none;">                           
                          Add Product to sell
                    </a>
                </td>
             </tr>
             <tr>
                <td>
                      <a href="index.php?route=catalog/product" style="font-size: 200%;text-decoration: none;"> 
                        <img src="image/list.png" width="50" height="50">
                      </a>
                </td>
                <td>
                    <a href="index.php?route=catalog/productRequest" style="font-size: 200%;text-decoration: none;">                        
                           Products requests list
                   </a>
                    &nbsp;&nbsp;&nbsp;&nbsp;   
               </td>
               <td>
                    <a href="index.php?route=catalog/productRequest/insert" style="font-size: 200%;text-decoration: none;">    
                        <img src="image/productRequest.png" width="50" height="50">
                    </a>
               </td>
                <td>
                    <a href="index.php?route=catalog/productRequest/insert" style="font-size: 200%;text-decoration: none;">                           
                          Add Product request
                    </a>
                </td>
             </tr>
        </table>
       
  </div>
  
  <h2>My Verification</h2>
  <div class="content">
      <table >
           <tr>
              <td>
                  <a href="index.php?route=account/verify">
                   <img src="image/getverified.png" width="50" height="50">
                  </a>
              </td>
              <td>
                <a href="index.php?route=account/verify" style="text-decoration: none;font-size: 150%;">                  
                       Verify your company now
                </a>
              </td>
              <td>
                   &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
               <a href="index.php?route=account/verify/viewlist" style="text-decoration: none;font-size: 150%;"> 
                    <img src="image/list.png" width="50" height="50">
               </a>
              </td>
              <td>
              <a href="index.php?route=account/verify/viewlist" style="text-decoration: none;font-size: 150%;">   
                    My Verification Requests
              </a>
              </td>
         </tr>
     </table>
  </div>
    
  <h2><?php echo $text_my_account; ?></h2>
  <div class="content">
      <table>
          <tr>
              <td>
                  <a href="<?php echo $calendar; ?>">
                   <img src="image/calendar.png" width="50" >
                  </a>
              </td>
              <td>
                <a href="<?php echo $calendar; ?>" style="text-decoration: none;">                 
                       Calendar
                </a>
              </td>
         </tr> 
         <tr>
              <td>
                  <a href="<?php echo $favoritecompanies; ?>">
                   <img src="image/favoritecompany.png" width="50" >
                  </a>
              </td>
              <td>
                <a href="<?php echo $favoritecompanies; ?>" style="text-decoration: none;">                 
                       My favorite companies
                </a>
              </td>
         </tr> 
         
          <tr>
              <td>
                  <a href="<?php echo $interestCountries; ?>">
                   <img src="image/countries.jpg" width="50" >
                  </a>
              </td>
              <td>
                <a href="<?php echo $interestCountries; ?>" style="text-decoration: none;">                 
                       My countries of interest
                </a>
              </td>
         </tr>
        
          <tr>
              <td>
                  <a href="<?php echo $edit; ?>">
                   <img src="image/edit.png" width="30" height="30">
                  </a>
              </td>
              <td>
                <a href="<?php echo $edit; ?>" style="text-decoration: none;">                 
                        <?php echo $text_edit; ?>
                </a>
              </td>
         </tr>
         <tr>
              <td>
                   <a href="<?php echo $password; ?>">
                     <img src="image/edit.png" width="30" height="30">
                   </a>
              </td>
              <td>   
                <a href="<?php echo $password; ?>" style="text-decoration: none;" ><?php echo $text_password; ?></a>
              </td>
        </tr>      
        <tr>
           <td>
                   <a href="<?php echo $address; ?>">
                     <img src="image/edit.png" width="30" height="30">
                   </a>
           </td> 
            <td> 
                <a href="<?php echo $address; ?>" style="text-decoration: none;"><?php echo $text_address; ?></a>
            </td>
        </tr>
      <tr>
          <td>
                   <a href="<?php echo $wishlist; ?>">
                     <img src="image/edit.png" width="30" height="30">
                   </a>
           </td> 
            <td> 
                <a href="<?php echo $wishlist; ?>" style="text-decoration: none;"><?php echo $text_wishlist; ?></a>
            </td>
      </tr>
      </table>   
  </div>
  
  
  <h2><?php echo $text_my_orders; ?></h2>
  <div class="content">                                      
       <table>
          <tr>
              <td>
                  <a href="<?php echo $order; ?>">
                   <img src="image/edit.png" width="30" height="30">
                  </a>
              </td>
              <td>
                <a href="<?php echo $order; ?>" style="text-decoration: none;font-size: 150%;">                  
                        <?php echo $text_order; ?>
                </a>
              </td>
         </tr>                         
         <tr>
              <td>
                   <a href="<?php echo $download; ?>">
                     <img src="image/edit.png" width="30" height="30">
                   </a>
              </td>
              <td>   
                <a href="<?php echo $download; ?>" style="text-decoration: none;"><?php echo $text_download; ?></a>
              </td>
        </tr>      
        <tr>                                            
           <td>
                   <a href="<?php echo $reward; ?>">
                     <img src="image/edit.png" width="30" height="30">
                   </a>
           </td> 
            <td> 
                <a href="<?php echo $reward; ?>" style="text-decoration: none;"><?php echo $text_reward; ?></a>
            </td>
        </tr>
        
      <tr>
          <td>
                   <a href="<?php echo $return; ?>">
                     <img src="image/edit.png" width="30" height="30">
                   </a>
           </td> 
            <td> 
                <a href="<?php echo $return; ?>" style="text-decoration: none;" ><?php echo $text_return; ?></a>
            </td>
      </tr>
      <tr>
          <td>
                   <a href="<?php echo $transaction; ?>">
                     <img src="image/edit.png" width="30" height="30">
                   </a>
           </td> 
            <td> 
                <a href="<?php echo $transaction; ?>" style="text-decoration: none;" ><?php echo $text_transaction; ?></a>
            </td>
      </tr>
      </table>                                            
  </div>
  
  
  <h2><?php echo $text_my_newsletter; ?></h2>
  <div class="content">
       <table>
          <tr>
              <td>
                  <a href="<?php echo $newsletter; ?>">
                   <img src="image/newsletter.png" width="50" >
                  </a>
              </td>
              <td>
                <a href="<?php echo $newsletter; ?>" style="text-decoration: none;font-size: 150%;">                  
                        <?php echo $text_newsletter; ?>
                </a>
              </td>
         </tr>                               
      </table>                    
  </div>
  


  <?php echo $content_bottom; ?></div>
<?php echo $footer; ?> 