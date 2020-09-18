<?php echo $header; ?>
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=false"></script>
<script type="text/javascript" src="catalog/view/javascript/gmap/gMapMarkers.js"></script>
<div id="content">
  <div class="box1">
    <div class="heading">
      <h1><img  src="image/company.png" width="25" /><?php echo $companies_by_country_text; ?></h1>
         
      <div class="buttons1">
       <form action="?route=customer/warehouse/" method="get" enctype="multipart/form-data" id="form">
           <input type="hidden" name="route" value="customer/warehouse">
           <select name="country_id" >
               <option value=""> --- </option> 
                <?php foreach($countries as $country) { ?>
                  <option value="<?php echo $country['country_id']; ?>"> <?php echo $country['name']; ?> </option> 
                <?php } ?>
           </select>
          <input type="button" onclick="$('#form').submit();" value="<?php echo $view_all_companies_text; ?>" class="button" />
        <!--  <a href="?route=customer/warehouse" class="button">
             <?php echo $view_all_companies_text; ?>
          </a>  -->
       </form>
      </div>       
    </div>
    <div class="content1" style="padding: 0px 0px 0px 0px" >    
      <div id="googleMap" style="width:978px;height:552px;"></div>
      <!--<form action="" method="post" enctype="multipart/form-data" id="form"></form>-->
    </div>
  </div>
</div>
<script type="text/javascript">
    
    <?php foreach($warehouses as $warehouse) { ?> 
        loadMarker("<?php echo $warehouse['lat']; ?>","<?php echo $warehouse['lng']; ?>","<?php echo $warehouse['href']; ?>");
    <?php } ?>
</script>

<script type="text/javascript"><!--
function filter() {
	url = 'index.php?route=sale/customer&token=<?php echo $token; ?>';
	
	var filter_name = $('input[name=\'filter_name\']').attr('value');
	
	if (filter_name) {
		url += '&filter_name=' + encodeURIComponent(filter_name);
	}
	
	var filter_email = $('input[name=\'filter_email\']').attr('value');
	
	if (filter_email) {
		url += '&filter_email=' + encodeURIComponent(filter_email);
	}
	
	var filter_customer_group_id = $('select[name=\'filter_customer_group_id\']').attr('value');
	
	if (filter_customer_group_id != '*') {
		url += '&filter_customer_group_id=' + encodeURIComponent(filter_customer_group_id);
	}	
	
	var filter_status = $('select[name=\'filter_status\']').attr('value');
	
	if (filter_status != '*') {
		url += '&filter_status=' + encodeURIComponent(filter_status); 
	}	
	
	var filter_approved = $('select[name=\'filter_approved\']').attr('value');
	
	if (filter_approved != '*') {
		url += '&filter_approved=' + encodeURIComponent(filter_approved);
	}	
	
	var filter_ip = $('input[name=\'filter_ip\']').attr('value');
	
	if (filter_ip) {
		url += '&filter_ip=' + encodeURIComponent(filter_ip);
	}
		
	var filter_date_added = $('input[name=\'filter_date_added\']').attr('value');
	
	if (filter_date_added) {
		url += '&filter_date_added=' + encodeURIComponent(filter_date_added);
	}
	
	location = url;
}
//--></script>
<script type="text/javascript"><!--
$(document).ready(function() {
	$('#date').datepicker({dateFormat: 'yy-mm-dd'});
});
//--></script>
<?php echo $footer; ?> 