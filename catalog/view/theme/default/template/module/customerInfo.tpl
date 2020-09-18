<div class="box">
  <div class="box-heading" style="text-align: center; color: #38B0E3;" >
     <!-- <?php echo $heading_title; ?> -->
     <a href="<?php echo $edit; ?>">
        <img src="image/edit.png" width="20">
     </a>
     Company
    
  </div>
  <div class="box-content">
      <ul class="box-category" style="text-align: center;"> 

       <?php if (!$logged) { ?>           
           <li>  
                   Logged out!!<br>
                   Loggin to view this area
           </li>
       <?php } else { ?>    
           <li> 
               <a href="<?php echo $edit; ?>">
                    <?php echo $customer['company']; ?>
               </a>
           </li>
           <li>    
               <a href="<?php echo $edit; ?>">
                   <?php echo $customer['firstname']. ' ' . $customer['lastname']; ?>
               </a>
           </li>   
           <li> 
               <a href="<?php echo $edit; ?>">
               <?php if( $customer['company_logo'] == '' ) { ?>
               <img src="image/companyLogo.png" width="120">  
               <?php } else { ?>
               <img src="image/<?php echo $customer['company_logo']; ?>" width="120"> 
               <?php } ?>
               </a>
           </li>
           
        <?php } ?>
        </ul>
  </div>
</div>
