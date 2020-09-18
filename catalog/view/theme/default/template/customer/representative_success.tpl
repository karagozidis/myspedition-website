<?php echo $header; ?>

<div id="content1" style="background: #FFFFFF;" >

  <div class="box1">
    <div class="heading">
      <h1>
          <img  src="image/company.png" width="25" /><?php echo $companies_by_country_text; ?>
      </h1>
         
      <!--<div class="buttons1">
          <a href="?route=customer/customer" class="button">
             <?php echo $view_all_companies_text; ?>
          </a>        
      </div>-->       
    </div>

    <div class="content1" style="padding: 0px 0px 0px 0px" >
      <div id="googleMap" style="width:978px;height:300px;"></div>
      <!--<form action="" method="post" enctype="multipart/form-data" id="form"></form>-->
    </div>
  </div>
    
        
      
    <div style="background-color: FFFFFF; padding: 20px 20px 20px 20px;">
      
       
       <h1>Success, Your request have been sent.</h1><br>
       
        <h3>
        Success, Your request have been sent to our administrator! <br>
        Thank you for choosing myspedition to be your partneron toye business activities<br>
        We will contact with you over the next 2 days!!
        </h3>
       
   </div>

    
    
</div>

<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=false"></script>
<script type="text/javascript" src="catalog/view/javascript/gmap/gMapRepresentative.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery/ui/tabs.js"></script> 

<script type="text/javascript"><!--
$('#tabs a').tabs(); 
$('#languages a').tabs(); 
$('#vtab-option a').tabs();
//--></script> 

<?php echo $footer; ?> 