<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content"><?php echo $content_top; ?>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <h1>
      <img src="image/calendar.png" width=30 height=30>
      <!--<?php echo $heading_title; ?>-->
      Calendar 
  </h1>

  
  <!--<div class="product-compare">
      <div style="font-size:150%"> <?php echo $welcome; ?> </div> <br><br>
  <?php echo $description; ?>
  </div>-->
<div class="box1">  
    
    <div class="heading">  
        <h1>
              <a href="<?php echo $prev_url; ?>">
                 <table>
                    <tr>
                      <td>
                         <img width="20" src="image/arrow_prev.png">
                      </td>
                      <td>
                         Previous
                      </td>
                    </tr>  
                 </table>
              </a> 
        </h1>
        <h1 style="float:right; text-align: right;">
              <a href='<?php echo $next_url; ?>' class="right">
                  <table>
                    <tr>
                      <td>
                         Next
                      </td>
                      <td>
                         <img width="20" src="image/arrow_next.png">
                      </td>
                    </tr>
                  </table>
              </a>  
        </h1>
        <h1 style="float: center; text-align: center;">
              <?php echo $monthNames[$cMonth-1].' '.$cYear; ?> 
        </h1>
        <!--<h1>
           <b>
           <?php if ($keywords) { ?>
             <?php foreach($keywords as $kwd) { ?>  
                 <a href="<?php echo $kwd['href']; ?>" style="text-decoration:none;">
                     <?php echo $kwd['keyword']. " "; ?>
                 </a>
             <?php } ?>
           <?php } ?>
           </b>
        </h1> -->
    </div>
    
    <style>
    .cdate
        {

        //background: url(http://localhost/myspedition/image/corner.png) no-repeat;
        }
        
    .cdate:hover
        {
        background-color:#F3F3F3;
        }
    </style>
    
    <div class="content1">
        <table width="100%" style='min-height: 800px;' border="0" cellpadding="2" cellspacing="2">
           <!-- <tr align="center">
                <td colspan="7" bgcolor="#999999" style="color:#FFFFFF">
                    <strong><?php echo $monthNames[$cMonth-1].' '.$cYear; ?></strong>
                </td>
            </tr> -->
            <tr style="border-bottom: 1px dotted #CCCCCC;">
                <td align="center" height='20' width='140'  style="border-bottom: 1px dotted #CCCCCC;"><strong>Sunday</strong></td>
                <td align="center" height='20' width='140' style="border-bottom: 1px dotted #CCCCCC;"><strong>Monday</strong></td>
                <td align="center" height='20' width='140' style="border-bottom: 1px dotted #CCCCCC;"><strong>Tuesday</strong></td>
                <td align="center" height='20' width='140' style="border-bottom: 1px dotted #CCCCCC;"><strong>Wednesday</strong></td>
                <td align="center" height='20' width='140' style="border-bottom: 1px dotted #CCCCCC;"><strong>Thursday</strong></td>
                <td align="center" height='20' width='140' style="border-bottom: 1px dotted #CCCCCC;"><strong>Friday</strong></td>
                <td align="center" height='20' width='140' style="border-bottom: 1px dotted #CCCCCC;"><strong>Saturday</strong></td>
            </tr>

            <?php 
            $timestamp = mktime(0,0,0,$cMonth,1,$cYear);
            $maxday = date("t",$timestamp);
            $thismonth = getdate ($timestamp);
            $startday = $thismonth['wday'];
            
            for ($i=0; $i<($maxday+$startday); $i++) 
                {
                
                if(($i % 7) == 0 )
                    {
                    echo "<tr style='height: 150px;'>";
                    }
                    
                if($i < $startday) 
                    {
                    echo "<td></td>";
                    }   
                else 
                    {
                    $day = ($i - $startday + 1);
                    echo "<td style='position:relative;border: 1px solid #DFEECD;' class='cdate' align='left' valign='top'>&nbsp;". $day ."<br>";
                    
                    foreach ($nodes as $node)
                        {
                        if( $day == $node['day_refers'] )
                            {
                            echo "<div style='border: 1px solid #C7C5FF;padding: 2px;margin:1px;' class='node_".$node['calendar_node_id']."'>";
                                                       
                            echo "<img src='image/delete.png' style='cursor: pointer;' onclick='deleteNode(".$node['calendar_node_id'].")' >";                            
                            echo "<a href='?route=product/calendar/node&note_id=".$node['calendar_node_id']."'>";
                                echo "<img src='image/note.png' width='16'>";
                                echo $node['title'];
                            echo "</a>";
                            
                            echo "</div>";
                            }
                        }
                    
                    
                   if(isset( $freights[$day] ))
                      {
                      foreach ($freights[$day] as $freight)
                        {
                        echo "<div style='border: 1px solid #BBDF8D;margin-top: 1px;' class='freight_".$freight['product_id']."'>";
                            echo "<img src='image/delete.png' style='cursor: pointer;' onclick='deleteFreight(".$freight['product_id'].")' >";  
                            echo "<a href='".$freight['action']."' >  ";
                            echo "<img src='image/freight.png' width='20'>  ";
                            echo "<b style='font-size: 130%;'>".$freight['trailer']['name']. "</b><br>";


                            echo "<img src='image/arrow_left.png' width='16'>  ";
                            echo "<img src='image/flags/".strToLower($freight['loading_country']['iso_code_2']).".png'>  ";
                            echo $freight['loading_city'];

                            echo "<br><img src='image/arrow_right.png' width='16'>  ";
                            echo "<img src='image/flags/".strToLower($freight['offloading_country']['iso_code_2']).".png'>  ";
                            echo $freight['offloading_city'];
                            echo "</a>";
                        echo "</div>";
                        }
                      }     
                      
                      if(isset( $trucks[$day] ))
                      {
                      foreach ($trucks[$day] as $truck)
                        {
                        echo "<div style='border: 1px solid #80BDFF;margin-top: 1px;' class='truck_".$truck['product_id']."'>";
                            echo "<img src='image/delete.png' style='cursor: pointer;' onclick='deleteTruck(".$truck['product_id'].")' >";  
                            echo "<a href='".$truck['action']."' >  ";
                            echo "<img src='image/truck.png' width='20'>  ";
                            echo "<b style='font-size: 130%;'>".$truck['trailer']['name']. "</b><br>";


                            echo "<img src='image/arrow_left.png' width='16'>  ";
                            echo "<img src='image/flags/".strToLower($truck['loading_country']['iso_code_2']).".png'>  ";
                            echo $truck['loading_city'];

                            echo "<br><img src='image/arrow_right.png' width='16'>  ";
                            echo "<img src='image/flags/".strToLower($truck['offloading_country']['iso_code_2']).".png'>  ";
                            echo $truck['offloading_city'];
                            echo "</a>";
                        echo "</div>";
                        }
                      }     
                        
                 
                   
                  ?>
                  <div style="position:absolute;bottom:0;">
                      
                 <table> 
                  <tr>
                      <td title="Add a node" style='background-color: #E0E0E0;border: 1px solid #BBDF8D;-webkit-border-radius: 5px 5px 5px 5px;'>
                     <a href='?route=product/calendar/node&year=<?php echo $cYear; ?>&month=<?php echo $cMonth; ?>&day=<?php echo $day; ?>'>
                       <img src='image/note.png' width='16'>
                     </a>
                   </td>
                   <td title="Add a Freight" style='background-color: #E0E0E0;border: 1px solid #BBDF8D;-webkit-border-radius: 5px 5px 5px 5px;'>    
                     <a href='?route=catalog/freight/insert&year=<?php echo $cYear; ?>&month=<?php echo $cMonth; ?>&day=<?php echo $day; ?>'> 
                         <img src='image/freight.png' width='20'>
                     </a>
                   </td>
                   <td title="Add a Truck" style='background-color: #E0E0E0;border: 1px solid #BBDF8D;-webkit-border-radius: 5px 5px 5px 5px;'>     
                     <a href='?route=catalog/truck/insert&year=<?php echo $cYear; ?>&month=<?php echo $cMonth; ?>&day=<?php echo $day; ?>'>
                        <img src='image/truck.png' width='20'>
                     </a>
                   </td>
                   <td title="View this day" style='background-color: #E0E0E0;border: 1px solid #BBDF8D;-webkit-border-radius: 5px 5px 5px 5px;'>     
                     <a href='?route=product/calendar/nodelist&year=<?php echo $cYear; ?>&month=<?php echo $cMonth; ?>&day=<?php echo $day; ?>'>
                        <img src='image/zoom.png' width='16'>
                     </a>
                   </td>
                  </tr>
                 </table>
                   </div>
                  
                   </td>
                   
                   <?php    
                   
                    }
                
                if(($i % 7) == 6 )
                    {
                    echo "</tr>";
                    }
                    
                }
                
            ?>

        </table>
              
    <?php echo $content_bottom; ?>
    </div>
    
<script type="text/javascript">
function deleteNode(calendar_node_id)
{
var result = confirm('Delete! Are you sure?');
if (result == false) return;

	$.ajax({
		url: 'index.php?route=product/calendar/deleteNode&calendar_node_id=' + calendar_node_id,
		dataType: 'json',
		beforeSend: function() {
		
		},
		complete: function() {
		
		},			
		success: function(json) {
                        $( ".node_"+calendar_node_id ).fadeOut('slow');
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	}); 

}
</script> 

<script type="text/javascript">
function deleteFreight(freight_id)
{
var result = confirm('Delete! Are you sure?');
if (result == false) return;

	$.ajax({
		url: 'index.php?route=product/calendar/deleteFreight&freight_id=' + freight_id,
		dataType: 'json',
		beforeSend: function() {
		},
		complete: function() {
		},			
		success: function(json) {
                        $( ".freight_"+freight_id ).fadeOut('slow');
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	}); 

}
</script> 

<script type="text/javascript">
function deleteTruck(truck_id)
{
var result = confirm('Delete! Are you sure?');
if (result == false) return;
	$.ajax({
		url: 'index.php?route=product/calendar/deleteTruck&truck_id=' + truck_id,
		dataType: 'json',
		beforeSend: function() {	
		},
		complete: function() {	
		},			
		success: function(json) {
                        $( ".truck_"+truck_id ).fadeOut('slow');  
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	}); 
}
</script> 




<script type="text/javascript"><!--
$('select[name=\'loading_country_id\']').bind('change', function() {
if(this.value != -1)
	$.ajax({
		url: 'index.php?route=account/register/country&country_id=' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('select[name=\'loading_country_id\']').after('<span class="wait">&nbsp;<img src="catalog/view/theme/default/image/loading.gif" alt="" /></span>');
		},
		complete: function() {
			$('.wait').remove();
		},			
		success: function(json) {
			
			html = '<option value="-1"> <?php echo $na_text; ?></option>';
			
			if (json['zone'] != '') {
				for (i = 0; i < json['zone'].length; i++) {
        			html += '<option value="' + json['zone'][i]['zone_id'] + '"';
	    			
					if (json['zone'][i]['zone_id'] == '<?php echo $loading_zone_id; ?>') {
                                        html += ' selected="selected"';
                                        }
	
	    			html += '>' + json['zone'][i]['name'] + '</option>';
				}
			}// else {
			//	html += '<option value="0" selected="selected">N/A</option>';
			//}
			
			$('select[name=\'loading_zone_id\']').html(html);
		},
		error: function(xhr, ajaxOptions, thrownError) {
		//	alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('select[name=\'loading_country_id\']').trigger('change');
//--></script> 

<script type="text/javascript"><!--
$('select[name=\'offloading_country_id\']').bind('change', function() {
if(this.value != -1)
	$.ajax({
		url: 'index.php?route=account/register/country&country_id=' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('select[name=\'offloading_country_id\']').after('<span class="wait">&nbsp;<img src="catalog/view/theme/default/image/loading.gif" alt="" /></span>');
		},
		complete: function() {
			$('.wait').remove();
		},			
		success: function(json) {
			html = '<option value="-1"><?php echo $na_text; ?></option>';
			
			if (json['zone'] != '') {
				for (i = 0; i < json['zone'].length; i++) {
        			html += '<option value="' + json['zone'][i]['zone_id'] + '"';
	    			
					if (json['zone'][i]['zone_id'] == '<?php echo $offloading_zone_id; ?>') {
	      				html += ' selected="selected"';
                                        }
	
	    			html += '>' + json['zone'][i]['name'] + '</option>';
				}
			}// else {
		//		html += '<option value="0" selected="selected">N/A</option>';
		//	}
			
			$('select[name=\'offloading_zone_id\']').html(html);
		},
		error: function(xhr, ajaxOptions, thrownError) {
		//	alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('select[name=\'offloading_country_id\']').trigger('change');
//--></script> 


<script type="text/javascript"><!--
function display(view) {
	if (view == 'list') {
		$('.product-grid').attr('class', 'product-list');
		
		$('.product-list > div').each(function(index, element) {
			html  = '<div class="right">';
			html += '  <div class="cart">' + $(element).find('.cart').html() + '</div>';
			html += '  <div class="wishlist">' + $(element).find('.wishlist').html() + '</div>';
			html += '  <div class="compare">' + $(element).find('.compare').html() + '</div>';
			html += '</div>';			
			
			html += '<div class="left">';
			
			var image = $(element).find('.image').html();
			
			if (image != null) { 
				html += '<div class="image">' + image + '</div>';
			}
			
			var price = $(element).find('.price').html();
			
			if (price != null) {
				html += '<div class="price">' + price  + '</div>';
			}
					
			html += '  <div class="name">' + $(element).find('.name').html() + '</div>';
			html += '  <div class="description">' + $(element).find('.description').html() + '</div>';
			
			var rating = $(element).find('.rating').html();
			
			if (rating != null) {
				html += '<div class="rating">' + rating + '</div>';
			}
				
			html += '</div>';
						
			$(element).html(html);
		});		
		
		$('.display').html('<b><?php echo $text_display; ?></b> <?php echo $text_list; ?> <b>/</b> <a onclick="display(\'grid\');"><?php echo $text_grid; ?></a>');
		
		$.totalStorage('display', 'list'); 
	} else {
		$('.product-list').attr('class', 'product-grid');
		
		$('.product-grid > div').each(function(index, element) {
			html = '';
			
			var image = $(element).find('.image').html();
			
			if (image != null) {
				html += '<div class="image">' + image + '</div>';
			}
			
			html += '<div class="name">' + $(element).find('.name').html() + '</div>';
			html += '<div class="description">' + $(element).find('.description').html() + '</div>';
			/*html += '  <div class="description">' + 
                            'From: <?php echo $product["loading_date"]; ?>' +  
                            'Place: <img src="image/flags/<?php echo $product["loading_country"]["iso_code_2"]; ?>.png">' +
                            '</div>';*/
			var price = $(element).find('.price').html();
			
			if (price != null) {
				html += '<div class="price">' + price  + '</div>';
			}
			
			var rating = $(element).find('.rating').html();
			
			if (rating != null) {
				html += '<div class="rating">' + rating + '</div>';
			}
						
			html += '<div class="cart">' + $(element).find('.cart').html() + '</div>';
			html += '<div class="wishlist">' + $(element).find('.wishlist').html() + '</div>';
			html += '<div class="compare">' + $(element).find('.compare').html() + '</div>';
			
			$(element).html(html);
		});	
					
		$('.display').html('<b><?php echo $text_display; ?></b> <a onclick="display(\'list\');"><?php echo $text_list; ?></a> <b>/</b> <?php echo $text_grid; ?>');
		
		$.totalStorage('display', 'grid');
	}
}

view = $.totalStorage('display');

if (view) {
	display(view);
} else {
	display('list');
}
//--></script> 

<script type="text/javascript">
 
$(document).ready(function(){
 
       <?php if( !isset($search) ) 
       echo" $('.slidingDiv').hide(); ";
             ?>
 
    $('.show_hide').click(function(){
    $(".slidingDiv").slideToggle();
    });
 
});
 
</script>

<script type="text/javascript"><!--
$('.date').datepicker({dateFormat: 'yy-mm-dd'});
$('.datetime').datetimepicker({
	dateFormat: 'yy-mm-dd',
	timeFormat: 'h:m'
});
$('.time').timepicker({timeFormat: 'h:m'});
//--></script> 

<?php echo $footer; ?>