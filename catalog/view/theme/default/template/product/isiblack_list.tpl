<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content">
  <div class="top">
    <div class="left"></div>
    <div class="right"></div>
    <div class="center">
      <h1><?php echo $heading_title ?></h1>
    </div>
  </div>
  <div class="middle">
  	
    <div class="content">
        <table> 
            <tr>
                <td>
                    <img src="image/exclamation.png" width="40">
                </td>
                <td>
                    <?php echo $text_conditions ?>
                </td>
            </tr>
        </table>
    </div>
  
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="black_list">
        
        

        <h2>Search company</h2>
        <div class="content">
        <table width="100%">
          <tr>
            <td>
             <b> Company Name </b>&nbsp;&nbsp;
              
             <input type="text" name="company_name1" style="width:300px;">
              <br><br>
                <div class="content" style="height: 200px;">
                      <table id="images" class="list">
                         <thead>
                           <tr>
                             <td style=" width: 2px;"></td> 
                             <td >Company</td>
                             <td >Manager Name</td>
                             <td >Country</td>
                           </tr>
                         </thead>
                         <tbody>

                         </tbody>
                         <tfoot>
                             <tr>
                                 <td colspan="4" style="height:5px;"></td>
                             </tr>
                         </tfoot>
                      </table>  
                  </div>
              
              <br>
            </td>
          </tr>
        </table>
       </div>

        
       <h2>Write your complain</h2> 
       <div class="content">
        <table width="100%">
         <!-- <tr>
            <td>
              Company
              <br />
              <input type="text" name="company_name1">
              
              <table id="images" class="list">
                 <thead>
                   <tr>
                     <td style=" width: 10px;"></td>
                     <td >Documents</td>
                     <td style=" width: 10px;"></td>
                   </tr>
                 </thead>
                 <tbody>

                 </tbody>
                 <tfoot>
                     <tr>
                         <td colspan="3" style="height:5px;"></td>
                     </tr>
                 </tfoot>
              </table>  
              
              <br>
            </td>
          </tr> -->
          
          <tr>
            <td><?php echo $entry_title ?><br />
              <input type="text" name="title" value="<?php echo $title; ?>" size = 90 />
              <?php if ($error_title) { ?>
              <span class="error"><?php echo $error_title; ?></span>
              <?php } ?></td>
          </tr>
          <tr>
            <td><?php echo $entry_enquiry ?><span class="required">*</span><br />
              <textarea name="description" style="width: 99%;" rows="10"><?php echo $description; ?></textarea><br />

              <?php if ($error_enquiry) { ?>
              <span class="error"><?php echo $error_enquiry; ?></span>
              <?php } ?></td>
          </tr>
         <!-- <tr>
            <td><?php echo $entry_name ?><br />
              <input type="text" name="name" value="<?php echo $name; ?>" />
              <?php if ($error_name) { ?>
              <span class="error"><?php echo $error_name; ?></span>
              <?php } ?>
            </td>
          </tr>
          <tr>
             <td>
                 <?php echo $entry_city ?><br />
		 <input type="text" name="city" value="<?php echo $city; ?>" />
            </td>
          </tr>
          <tr>
            <td>
		  <?php echo $entry_email ?><br />
              <input type="text" name="email" value="<?php echo $email; ?>" />
              <?php if ($error_email) { ?>
              <span class="error"><?php echo $error_email; ?></span>
              <?php } ?>
            </td>
          </tr>
          <tr>
            <td><br><?php echo $entry_rating; ?> &nbsp;&nbsp;&nbsp; <span><?php echo $entry_bad; ?></span>&nbsp;
        		<input type="radio" name="rating" value="1" style="margin: 0;" <?php if ( $rating == 1 ) echo 'checked="checked"';?> />
        		&nbsp;
        		<input type="radio" name="rating" value="2" style="margin: 0;" <?php if ( $rating == 2 ) echo 'checked="checked"';?> />
        		&nbsp;
        		<input type="radio" name="rating" value="3" style="margin: 0;" <?php if ( $rating == 3 ) echo 'checked="checked"';?> />
        		&nbsp;
        		<input type="radio" name="rating" value="4" style="margin: 0;" <?php if ( $rating == 4 ) echo 'checked="checked"';?> />
        		&nbsp;
        		<input type="radio" name="rating" value="5" style="margin: 0;" <?php if ( $rating == 5 ) echo 'checked="checked"';?> />
        		&nbsp; <span><?php echo $entry_good; ?></span><br /><br>

          	</td>
          </tr> -->
        </table>
       </div>
       
       
       
       
       <h2>Captcha</h2>
       <div class="content">
        <table>
          <tr>
            <td>
              <?php if ($error_captcha) { ?>
              <span class="error"><?php echo $error_captcha; ?></span>
              <?php } ?>
              
              <img src="index.php?route=information/contact/captcha" /> <br>
		<?php echo $entry_captcha; ?><span class="required">*</span> <br>

              <input type="text" name="captcha" value="<?php echo $captcha; ?>" /><br>
            </td>
          </tr>
        </table>
       </div>
       
       

       
      <div class="buttons">
        <table width=100%>
          <tr>
            <td align="right"><a  onclick="$('#black_list').submit();" class="button"><span><?php echo $button_continue; ?></span></a></td>
		<!--<td align="right"><a class="button" href="<?php echo $showall_url;?>"><span><?php echo $show_all; ?></span></a>
		</td> -->
          </tr>
        </table>

      </div>
    </form>
  </div>
  <div class="bottom">
    <div class="left"></div>
    <div class="right"></div>
    <div class="center"></div>
  </div>
</div>

<script type="text/javascript"><!--

var waitIconExists = false;

$('[name="company_name1"]').bind( "keyup", function() {
 
         if (this.value == '' || this.value.length < 3  )
             {
             $('#images tbody').remove();
             return;
             }
 
	$.ajax({
		url: 'index.php?route=product/isiblack_list/company&company_name=' + this.value,
		dataType: 'json',
		beforeSend: function() {
		//alert('ddd');
                if ( waitIconExists == false )
                    {
                    $('[name="company_name1"]').after('<span class="wait">&nbsp;<img src="catalog/view/theme/default/image/loading.gif" alt="" /></span>');
                    waitIconExists = true;
                    }
		},
		complete: function() {
		$('.wait').remove();
                waitIconExists = false;
		},			
		success: function(json) {
	
			
			//html = '<option value=""><?php echo $text_select; ?></option>';
			html = '';
                        $('#images tbody').remove();
                        //$('#image-row').remove();
			if (json['companies'] != '') {
				for (i = 0; i < json['companies'].length; i++) {
        			
                                //html += '' + json['companies'][i]['customer_id'] + ' - ';
	    			//html += '' + json['companies'][i]['company'] + '<br>';
                                
                                    html += '<tbody id="image-row">';
                                    html += '  <tr>';
                                    html += '    <td><input type="radio" name="customer_id" value="'+ json['companies'][i]['customer_id'] +'"> </td>';
                                    html += '    <td>'+ json['companies'][i]['company'] +' <input type="hidden" name="docs[]" value="'+  json['companies'][i]['customer_id'] +'"> </td>';
                                    html += '    <td>'+ json['companies'][i]['name'] +'</td>';
                                    html += '    <td>'+'<img src="image/flags/'+json['companies'][i]['country']['iso_code_2']+'.png">'+ json['companies'][i]['country']['name'] +'</td>';
                                    html += '  </tr>';
                                    html += '</tbody>';


				}
			} 
                        
			$('#images tfoot').before(html);
			//$('select[name=\'selected_companies\']').html(html);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});


   // alert( "User clicked on 'foo.'" );
});


//--></script> 

<script type="text/javascript"><!--
var doc_row = 0;

function addImage(doc) {
    html  = '<tbody id="image-row' + doc_row + '">';
	html += '  <tr>';
	html += '    <td><img src="image/doc.png" width="15"></td>';
	html += '    <td>'+ doc +' <input type="hidden" name="docs[]" value="'+ doc +'"> </td>';
	html += '    <td ><a onclick="$(\'#image-row' + doc_row  + '\').remove();" class="button">remove</a></td>';
	html += '  </tr>';
	html += '</tbody>';
	
	$('#images tfoot').before(html);
	
	doc_row++;
}
//-->
 </script> 
 
<?php echo $footer; ?> 