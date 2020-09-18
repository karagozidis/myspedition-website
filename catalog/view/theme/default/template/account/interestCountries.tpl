<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content"><?php echo $content_top; ?>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <h1>
      <!--<?php echo $heading_title; ?>-->
      Your countries of Interest
  </h1>
  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
   
  <h2>
        Edit your countries of interest
        <!--<?php echo $text_password; ?>-->
  </h2>    
      
  <div class="buttons">
      <div class="left"><a href="<?php echo $back; ?>" class="button"><?php echo $button_back; ?></a></div>
      <div class="right"><input type="submit" value="<?php echo $button_continue; ?>" class="button" /></div>
  </div>    
      

    

    <div class="content">
      <table class="form">
               <tr>
                   <?php $count=1; ?>
                   <?php $prevLetter=''; ?>
                   <!--<?php $letter= substr($countries[0]['name'],0, 1); ?>-->
                   <?php $letter=''; ?>
                   <?php foreach($countries as $country){ ?>
                
                
                  <?php $prevLetter = $letter; ?>
                  <?php $letter = substr($country['name'],0, 1);  ?>
                    
                  <?php if($prevLetter != $letter) { ?>
                        <?php $count = 1; ?>
                </tr>
                <tr><td colspan="3"></td></tr>
                <tr>
                 <td style="padding: 0px; width:40px;border-bottom: 1px dotted #CCCCCC;font-weight:bold;">
                        <?php echo $letter; ?>
                 </td>
                 <td colspan="2" style="border-bottom: 1px dotted #CCCCCC;"></td>
                </tr>
                <tr>
                    <td colspan="3">
                    </td>
                </tr><tr>
                  <?php } ?>
                
                
                <td style="padding: 0px; width:40px;">
                    <?php $checked = ''; ?>
                    <?php foreach($interestCountries as $interestCountry) { ?>
                        <?php if($interestCountry['country_id'] == $country['country_id'] ) { ?>
                            <?php $checked = 'checked'; ?>
                            <?php break; ?>
                        <?php }  ?>
                    <?php } ?>
                    
                    <input type="checkbox" name="countries[]" value="<?php echo $country['country_id']; ?>" <?php echo $checked; ?> >
                    <img src="image/flags/<?php echo strToLower( $country['iso_code_2'] ); ?>.png">
                    <?php echo $country['name']; ?> 
                 </td>

                  <?php if ($count == 3) { ?>
                    </tr><tr>
                    <?php $count = 0; ?>
                  <?php } ?>
                  
                  <?php $count++; ?>
                <?php } ?>
            
            
        </tr>  
          
        <!--<tr>
          <td><span class="required">*</span> <?php echo $entry_password; ?></td>
          <td><input type="password" name="password" value="<?php echo $password; ?>" />
            <?php if ($error_password) { ?>
            <span class="error"><?php echo $error_password; ?></span>
            <?php } ?></td>
        </tr>
        <tr>
          <td><span class="required">*</span> <?php echo $entry_confirm; ?></td>
          <td><input type="password" name="confirm" value="<?php echo $confirm; ?>" />
            <?php if ($error_confirm) { ?>
            <span class="error"><?php echo $error_confirm; ?></span>
            <?php } ?></td>
        </tr> -->
      </table>
    </div>
    <div class="buttons">
      <div class="left"><a href="<?php echo $back; ?>" class="button"><?php echo $button_back; ?></a></div>
      <div class="right"><input type="submit" value="<?php echo $button_continue; ?>" class="button" /></div>
    </div>
  </form>
  <?php echo $content_bottom; ?></div>
<?php echo $footer; ?>