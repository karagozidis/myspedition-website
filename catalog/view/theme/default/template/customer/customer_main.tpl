<?php echo $header; ?>
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=false"></script>
<script type="text/javascript" src="catalog/view/javascript/gmap/gMapScript.js"></script>

<div id="content">
    <div class="content">     
        <form method="get" enctype="multipart/form-data" action="">         
            <input type="hidden" name="route" value="<?php echo $searchByNameAction; ?>">          
            <?php if( isset($country_id) ) { ?>      
            <?php } ?>            
            <table style="margin: 10px;">              
                <tr>                 
                    <td style="font-size: 130%;color: #F16100;">         
                        Company Name:   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                    
                    </td>                    
                    <td>                       
                        <input type="text" name="filter_company" size="70" value="">  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;               
                    </td>                  
                    <td>                       
                        <input type="submit" value="Search" class="button">                  
                    </td>               
                </tr>           
            </table>      
        </form>  
    </div>
    
    <div id="content">  
    <div class="box1">    
        <div class="heading">     
            <h1><img  src="image/company.png" width="25" /><?php echo $companies_by_country_text; ?></h1> 
            <div class="buttons1">        
                <a href="?route=customer/customer" class="button">          
                    <?php echo $view_all_companies_text; ?>          
                </a>            
            </div>         
        </div>    
        <div class="content1" style="padding: 0px 0px 0px 0px" >     
            <div id="googleMap" style="width:978px;height:552px;"></div>      <!--<form action="" method="post" enctype="multipart/form-data" id="form"></form>-->   
        </div> 
    </div>
 </div>
 </div>
 <script type="text/javascript"><!--
 function filter() {	
    url = 'index.php?route=sale/customer&token=<?php echo $token; ?>';	
    var filter_name = $('input[name=\'filter_name\']').attr('value');	
    
    if (filter_name) 
       {	
        url += '&filter_name=' + encodeURIComponent(filter_name);	
       }
    var filter_email = $('input[name=\'filter_email\']').attr('value');		
    if (filter_email) 
       {		
        url += '&filter_email=' + encodeURIComponent(filter_email);	
       }	
    var filter_customer_group_id = $('select[name=\'filter_customer_group_id\']').attr('value');	
    if (filter_customer_group_id != '*') 
       {		
           url += '&filter_customer_group_id=' + encodeURIComponent(filter_customer_group_id);	
       }	
    var filter_status = $('select[name=\'filter_status\']').attr('value');		
    if (filter_status != '*') 
       {
        url += '&filter_status=' + encodeURIComponent(filter_status); 	
       }		
    var filter_approved = $('select[name=\'filter_approved\']').attr('value');		
    if (filter_approved != '*') 
       {	
        url += '&filter_approved=' + encodeURIComponent(filter_approved);	
       }	
    var filter_ip = $('input[name=\'filter_ip\']').attr('value');	

    if (filter_ip) 
       {
        url += '&filter_ip=' + encodeURIComponent(filter_ip);	
       }			
    var filter_date_added = $('input[name=\'filter_date_added\']').attr('value');	
    if (filter_date_added) 
       {		
           url += '&filter_date_added=' + encodeURIComponent(filter_date_added);	
       }	
    location = url;
 }//-->
 </script>
 
 <script type="text/javascript"><!--
     $(document).ready(function() 
        {	
            $('#date').datepicker({dateFormat: 'yy-mm-dd'});
        });//-->
</script>
<?php echo $footer; ?> 

