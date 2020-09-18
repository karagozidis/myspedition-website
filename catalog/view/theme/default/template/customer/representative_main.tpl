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
    
        
    <div id="tabs" class="htabs">
          <a href="#tab-benefits">Your Benefits</a>
          <a href="#tab-general">Fill this Form</a>         
    </div>
      
    <div style="background-color: FFFFFF; padding: 20px 20px 20px 20px;" id="tab-benefits">
      
       <p>
       <h1>Benefits for the Business Partners of MySpedition</h1><br>
       
        <h3>Immediate initiation of cooperation with direct payments</h3>
        We provide all the infrastructure and information you need to start providing  our services and gain profits from the first day of our cooperation. All payments are made directly twice a month , every 15 days!
        <h3> Preferential prices </h3>
         As a partner receive privileged discounts or rates depending on your country and our commercial agreement.
        <h3> Reliable services </h3>
        Our services are tested and work perfectly. Our technical team constantly upgrades and optimizes our systems and you and your customers immediately receive all our upgrades.
        <h3> Competitive pricing and rewards policy </h3>
        Σαν μεταπωλητής των υπηρεσιών μας, προσφέρετε στους πελάτες σας μια σειρά από πλεονεκτήματα και δωρεάν παροχές αλλά και δώρα χωρίς κλήρωση «Gift member program» που έχουν σαν αποτέλεσμα την εύκολη και χωρίς ρίσκο εγγραφή τους.As a reseller of our services, you offer to your customers a number of advantages and free benefits and gifts without drawing «Gift member program» which results in their easy and risk-free registration to myspedition.
        <h3> Full clarity in our online environment </h3>
        Your customers have direct access to our services and full account management with analytical data and their registration process usually takes less than 20 minutes!
        <h3> Free Support 24/7 </h3>
        We are next to you by e-mail 24 hours a day for any technical question  and assistance. we also provide direct telephone support and on line chat support every day, on working hours and days.
        <h3> Safety </h3>
        The myspedition platform uses for your payments the required safety certificates, to feel You and your customers fully protected.
        <h3> Program of credits pre-purchasement without deadlines </h3>
        You can optionally increase  your profits significantly  with the  pre-purchasement credits program which do not expire and you can be used from your customers whenever you want.
        <h3> Online access and detailed statistical and financial information </h3>
        You can manage our services from any computer connected to the internet. View detail your commissions in real time.
        You can see the effectiveness of your project as well as sales conditions at a glance.
       </p>
   </div>
   <div id="tab-general">
       <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
           <table class="form">
               <tr>
                   <td>
                       Name of company
                   </td>
                   <td>
                       <input name="company_name" type="text">
                   </td>
               </tr>
               <tr>
                   <td>
                      Company Activity
                   </td>
                   <td>
                      <input name="company_field" type="text">
                   </td>
               </tr>
               <tr>
                   <td>
                       Company id
                   </td>
                   <td>
                       <input name="company_id" type="text">
                   </td>
               </tr>
               <tr>
                   <td>
                       Legal Form
                   </td>
                   <td>
                        <input name="legal_form" type="text">
                   </td>
               </tr>
               <tr>
                   <td>
                       Year of Establishment
                   </td>
                   <td>
                        <input name="establisment_day" type="text">
                   </td>
               </tr>
               <tr>
                   <td>
                       Legal Representative
                   </td>
                   <td>
                        <input name="representative" type="text">
                   </td>
               </tr>      
               <tr>
                   <td>
                       Number of Employees
                   </td>
                   <td>
                       <input name="employees_number" type="text">
                   </td>
               </tr>
               <tr>
                   <td>
                       Number of customers (approximatelly) 
                   </td>
                   <td>
                       <input name="customers_number" type="text">
                   </td>
               </tr>
               <tr>
                   <td>
                       Address
                   </td>
                   <td>
                        <input name="address" type="text">
                   </td>
               </tr>
               <tr>
                   <td>
                       Phone number
                   </td>
                   <td>
                        <input name="telephone" type="text">
                   </td>
               </tr>
               <tr>
                   <td>
                       Web site
                   </td>
                   <td>
                        <input name="website" type="text">
                   </td>
               </tr>
               <tr>
                   <td>
                       Communications manager
                   </td>
                   <td>
                        <input name="communications_manager" type="text">
                   </td>
               </tr>
               <tr>
                   <td>
                       Position in company
                   </td>
                   <td>
                       <input name="position" type="text">
                   </td>
               </tr>
               <tr>
                   <td>
                       Email
                   </td>
                   <td>
                       <input name="email" type="text">
                   </td>
               </tr>
               <tr>
                   <td>
                       Comments on cooperation
                   </td>
                   <td>
                       <textarea name="comments" rows="5" cols="60"></textarea>
                   </td>
               </tr>
               <tr>
                   <td>
                      What are the main reasons for seeking cooperation with us?
                   </td>
                   <td>
                       <textarea name="reasons" rows="15" cols="100"></textarea>
                   </td>
               </tr>                
               <tr>
                   <td>
                      How did you learn about us? 
                   </td>
                   <td>
                        <textarea name="informed_ways" rows="5" cols="60"></textarea>
                   </td>
               </tr>
               <tr>
                   <td>
                       Remarks
                   </td>
                   <td>
                       <textarea name="notes" rows="5" cols="60"></textarea>
                   </td>
               </tr>  
           </table>
           <div style="padding: 30px 30px 30px 30px;" >
                <input type="submit" class="button" >
           </div>
       </form>
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