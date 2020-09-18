<?php echo $header; ?>

<script type="text/javascript" src="catalog/view/javascript/jquery/ajaxupload.js"></script>

<?php if ($error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?>
<?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content"><?php echo $content_top; ?>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <h1><?php echo $heading_title; ?></h1>
  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
   
    <h2>Upload your Documents</h2>
    <div class="content">
        <input type="hidden" name="customer_id" value="customer_id" >    

        <a id="upload" class="button" >
           Upload
        </a>  
        <span id="uploadLoading"></span>
        <br><br>
        <table id="images" class="list">
                 <thead>
                   <tr>
                     <td style=" width: 10px;"></td>
                     <td >Documents</td>
                     <td style=" width: 10px;"></td>
                   </tr>
                 </thead>
                 <tbody>
                   <!--  <?php foreach($docs as $doc) { ?>
                     <tr>
                         <td>
                             <img src="image/doc.png" width="15">
                         </td>
                         <td>
                             <?php echo $doc['document_id'];  ?>
                             <input type="hidden" name="docs[]" value="<?php echo $doc['document_id'];  ?>">
                         </td>
                         <td></td>
                     </tr>
                     <?php } ?> -->
                 </tbody>
                 <tfoot>
                     <tr>
                         <td colspan="3" style="height:5px;"></td>
                     </tr>
                 </tfoot>
        </table>    
    </div>
      
    <h2>
        Leave a message (Optional)
        <!--<?php echo $text_your_details; ?>-->
    </h2>
    <div class="content">
    <table class="form">
   <!--   <tr>
          <td colspan="3" style="color: blue; font-size: 150%;">
              
             <?php  if ( $verification_status == 0 || $verification_status == 1 || $verification_status == 2  ) { ?>
                <div class="attention" >
             <?php } else { ?>
                <div class="success" >
             <?php } ?>
              <?php echo $verification_status_msg; ?> 
            </div>
          </td>
      </tr> -->
      <tr>
          <td>
             Leave a Message
          </td>
          <td colspan="2">
            <textarea rows="10" cols="70" name="description"></textarea>
          </td>  
      </tr>    
     </table>     
    </div>
             
    <div class="buttons">
      <div class="left"><a href="<?php echo $back; ?>" class="button"><?php echo $button_back; ?></a></div>
      <div class="right">
        <input type="submit" value="Request verification" class="button" />
       <!-- <input type="submit" value="<?php echo $button_continue; ?>" class="button" /> -->
      </div>
    </div>
  </form>
  <?php echo $content_bottom; ?></div>


    
    
 
    
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
 
    
 
    
    
    
<script type="text/javascript"><!--

    	new AjaxUpload('#upload', {
		action: 'index.php?route=account/verify/upload',
		name: 'image',
		autoSubmit: false,
		responseType: 'json',
		onChange: function(file, extension) {
			//var tree = $.tree.focused();
			
			//if (tree.selected) {
			//	this.setData({'directory': $(tree.selected).attr('directory')});
			//} else {
				this.setData({'directory': ''});
			//}
			
			this.submit();
		},
		onSubmit: function(file, extension) {
			$('#uploadLoading').append('<img src="catalog/view/image/loading.gif" class="loading" style="padding-left: 5px;" />');
		},
		onComplete: function(file, json) {
			if (json.success) {
				//var tree = $.tree.focused();
					
				//tree.select_branch(tree.selected);
				addImage(json.success);
			//	alert(json.success);
			}
			
			if (json.error) {
				alert(json.error);
			}
			$('.loading').remove();	
			//$('.loading').remove();	
                      //  alert('onCoplete');
		}
	});
    
    
    
    
    
    
    
    
function image_upload(field, thumb) {
	$('#dialog').remove();
	
	$('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="index.php?route=common/docmanager/&field=' + encodeURIComponent(field) + '" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
	
	$('#dialog').dialog({
		title: 'Upload your documents',
		close: function (event, ui) {
			if ($('#' + field).attr('value')) {
				$.ajax({
					url: 'index.php?route=common/docmanager/image&&image=' + encodeURIComponent($('#' + field).attr('value')),
					dataType: 'text',
					success: function(text) {
						$('#' + thumb).replaceWith('<img src="' + text + '" alt="" id="' + thumb + '" />');
					}
				});
			}
		},	
		bgiframe: false,
		width: 800,
		height: 400,
		resizable: false,
		modal: false
	});
};
//--></script> 


<?php echo $footer; ?>