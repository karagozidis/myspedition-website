<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>  
<div id="content">
  <div class="top">
    <div class="left"></div>
    <div class="right"></div>
    <div class="center">
      <h1><?php echo $heading_title; ?></h1>
    </div>
  </div>
    <div class="content" style="width: 750px;">
      <form method="get" enctype="multipart/form-data" action="<?php echo $searchByNameAction; ?>">
          <input type="hidden" name="route" value="product/black_list">
          <?php if( isset($country_id) ) { ?>
                <input type="hidden" name="country_id" value="<?php echo $country_id; ?>">
          <?php } ?>
            <table style="margin: 10px;">
                <tr>
                    <td style="font-size: 130%;color: #F16100;">
                        Company Name:
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </td>
                    <td>
                        <input type="text" name="filter_company" size="70" value="<?php echo $filter_company; ?>">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </td>
                </tr>
                <tr>
                    <td>
                        Country
                    </td>  
                    <td>
                    <select name="filter_country_id">
                     <option value="*"> --- </option>
                     <?php foreach ($countries as $country) { ?>
                     
                           <?php if ($filter_country_id == $country['country_id']) { ?>
                                <option value="<?php echo $country['country_id']; ?>" selected>  <?php echo $country['name']; ?>  </option>
                           <?php } else { ?> 
                                <option value="<?php echo $country['country_id']; ?>">  <?php echo $country['name']; ?>  </option>
                           <?php } ?>
                     <?php } ?>
                    </select>
                    </td>
                </tr>
                <tr>
                    <td>
                    </td>  
                    <td>
                         <input type="submit" value="Search" class="button">
                    </td>
                </tr>
            </table>
      </form>
  </div>  
    
   <?php if (!$black_lists) { ?>
        <div class="content">
            <br>
            <h1><?php echo $text_error; ?></h1>
        </div>
   <?php } ?>
    
  <div class="buttons" align="right"><a class="button" href="<?php echo $write_url;?>" title="<?php echo $write;?>"><span><?php echo $write;?></span></a></div> 
    
  <div class="middle">
    <?php if ($black_lists) { ?>
    
      <?php foreach ($black_lists as $black_list) { ?>
      <table class="content" width="100%" border=0>
      <tr>
         <td valign="top" colspan="2" style="border-bottom: 1px dotted #CCCCCC;">
             <table>
                 <tr>
                     <td>
                         <img src="image/exclamation.png" width="40">
                     </td>
                     <td>
                         
                          Company:
                          <a  style="font-size: 150%" href="<?php echo $black_list['to_customer']['url']; ?>" target="_blank">
                                  <?php echo $black_list['to_customer']['company']; ?>
                          </a>  
                          <br>          
                          Country: 
                          <a href="<?php echo $black_list['to_customer']['url']; ?>" target="_blank"> 
                              <img src="image/flags/<?php echo strToLower($black_list['to_customer']['country']['iso_code_2']); ?>.png">
                              <?php echo $black_list['to_customer']['country']['name']; ?>
                          </a>
                         <br>
                          Owner: 
                          <a href="<?php echo $black_list['to_customer']['url']; ?>" target="_blank">         
                                  <?php echo $black_list['to_customer']['firstname']; ?>
                                 <?php echo $black_list['to_customer']['lastname']; ?> 
                          </a>
                     </td>
                </tr>
            </table> 
         </td>
      </tr> 
      <tr>
         <td valign="top" style="text-align:left;" colspan="2"><h2><?php echo $black_list['title']; ?></h2></td>
      </tr>       
      <tr>
      	<td colspan="2" style="text-align:left;">
                <?php echo $black_list['description']; ?>
            </td>
      </tr>    

     <tr>
            <td style="font-size: 0.9em; text-align: right;">
                <?php if ($black_list['rating']) { ?>
                <?php echo $text_average; ?><br>
                  <img src="catalog/view/theme/default/image/black_lists/stars-<?php echo $black_list['rating'] . '.png'; ?>" style="margin-top: 2px;" />
                  <?php } ?><br>
                <i>
                    By
                    <a href="<?php echo $black_list['from_customer']['url']; ?>" target="_blank">
                    <?php echo $black_list['from_customer']['firstname'].' '. $black_list['from_customer']['lastname'].' - '. $black_list['from_customer']['company']; ?>
                    </a>
                    
                    <?php echo ' / '.$black_list['date_added']; ?>
                </i>
             </td>
        </td>
      </tr>

	</table>
      <?php } ?>

    	<?php if ( isset($pagination)) { ?>
    		<div class="pagination"><?php echo $pagination;?></div>
    		<div class="buttons" align="right"><a class="button" href="<?php echo $write_url;?>" title="<?php echo $write;?>"><span><?php echo $write;?></span></a></div>
    	<?php }?>

    	<?php if (isset($showall_url)) { ?>
    		<div class="buttons" align="right">
                    <a class="button" href="<?php echo $write_url;?>" title="<?php echo $write;?>">
                        <span><?php echo $write;?></span>
                    </a> &nbsp;
                    <a class="button" href="<?php echo $showall_url;?>" title="<?php echo $showall;?>">
                        <span><?php echo $showall;?></span>
                    </a>
                </div>
    	<?php }?>
    <?php } ?>
  </div>
  <div class="bottom">
    <div class="left"></div>
    <div class="right"></div>
    <div class="center"></div>
  </div>
</div>
<?php echo $footer; ?> 