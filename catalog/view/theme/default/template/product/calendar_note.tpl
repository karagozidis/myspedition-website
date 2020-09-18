<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content">
  <div class="top">
    <div class="left"></div>
    <div class="right"></div>
    <div class="center">
      <h1>
          <img src="image/note.png" width="30">
          <?php echo $heading_title ?> <?php echo $date_refers; ?>
      </h1>
    </div>
  </div>
  <div class="middle">

    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="black_list">
        
      <div class="buttons">
        <table width=100%>
          <tr>
            <td align="right">
                <a  onclick="$('#black_list').submit();" class="button">Save</a>
                <a href="<?php echo $cancel; ?>" class="button">Cancel</a>
            </td>
          </tr>
        </table>
      </div>
     
        <input type="hidden" name="calendar_node_id" value="<?php echo $calendar_node_id; ?>">
        <input type="hidden" name="month" value="<?php echo $month; ?>">
        <input type="hidden" name="year" value="<?php echo $year; ?>">
        
       <div class="content">
        <table width="100%">
          <tr>
            <td>
                Date <br>
                <input type="text" name="date_refers" value="<?php echo $date_refers; ?>" size = 50 class="date" readonly />
            </td>
          </tr>
          <tr>
            <td>
                <?php echo $entry_title ?><br />
              <input type="text" name="title" value="<?php echo $title; ?>" size = 90 />
              <?php if ($error_title) { ?>
              <span class="error"><?php echo $error_title; ?></span>
              <?php } ?>
            </td>
          </tr>
          <tr>
            <td><?php echo $entry_enquiry ?><span class="required">*</span><br />
              <textarea name="description" style="width: 99%;" rows="10"><?php echo $description; ?></textarea><br />

              <?php if ($error_enquiry) { ?>
              <span class="error"><?php echo $error_enquiry; ?></span>
              <?php } ?></td>
          </tr>
        </table>
       </div>
       
       
      <div class="buttons">
        <table width=100%>
          <tr>
            <td align="right">
                <a  onclick="$('#black_list').submit();" class="button">Save</a>
                <a href="<?php echo $cancel; ?>" class="button">Cancel</a>
            </td>
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

<script type="text/javascript" src="catalog/view/javascript/ckeditor/ckeditor.js"></script> 
<script type="text/javascript"><!--
CKEDITOR.replace( 'description' );
//--></script> 

<script type="text/javascript"><!--
$('.date').datepicker({dateFormat: 'yy-mm-dd'});
$('.datetime').datetimepicker({
	dateFormat: 'yy-mm-dd',
	timeFormat: 'h:m'
});
$('.time').timepicker({timeFormat: 'h:m'});
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