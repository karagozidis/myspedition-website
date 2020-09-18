<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content"><?php echo $content_top; ?>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <h1>
      <img src="image/market.png" width=30 height=30>
      <?php echo $heading_title; ?>
  </h1>

  
  <div class="product-compare">
      <div style="font-size:150%"> <?php echo $welcome; ?> </div> <br><br>
  <?php echo $description; ?>
  </div>
    
    
<div class="box1">  
    
    <div class="heading">    
        <h1>
           <b>
           <?php if ($keywords) { ?>
             <?php foreach($keywords as $kwd) { ?>  
                 <a href="<?php echo $kwd['href']; ?>" style="text-decoration:none;">
                     <?php echo $kwd['keyword']. " "; ?>
                 </a>
             <?php } ?>
           <?php } ?>
           </b>
        </h1>
    </div>
    <div class="content1">
        <table>
            <tr>
                <td valign="top" >
                    <b>Term</b> <br>
                     <?php if ($terms) { ?>
                       <?php foreach($terms as $term) { ?>  
                          <a href="<?php echo $term['href']; ?>" style="text-decoration:none;">
                              <?php echo $term['name']. "<br>"; ?>
                          </a>
                       <?php } ?>
                     <?php } ?>
                </td>
                <td valign="top" >
                   <b> Explanation </b>
                    <textarea cols="100" rows="20" readonly>
                     <?php echo $selected_term['description'];?>
                    </textarea>
                </td>
            </tr>
        </table>
    <div>
  
</div>
  <?php echo $content_bottom; ?></div>

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