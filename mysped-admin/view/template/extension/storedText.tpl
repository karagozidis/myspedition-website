<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
    
 <?php if (isset($success) ) { ?>
  <div class="success"><?php echo $success; ?></div>
  <?php } ?>
  
  <div class="box">
    <div class="heading">
        <h1><img src="image/doc.png" alt="" width="22" /> Stored Multilanguage texts </h1>
    </div>
    <div class="content">
  
          
     <h1><?php echo $title; ?></h1>   
     <div id="languages" class="htabs">
            <?php foreach ($languages as $language) { ?>
            <a href="#language<?php echo $language['language_id']; ?>"><img src="image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></a>
            <?php } ?>
     </div>  
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
          
       <?php foreach ($languages as $language) { ?>
          <div id="language<?php echo $language['language_id']; ?>">
            <table class="form">
              <tr>
                <!--<td>Mail</td>-->
                <td>
                    <textarea name="description[<?php echo $language['language_id']; ?>][description]" id="description<?php echo $language['language_id']; ?>">
                        <?php if( isset($texts[  $language['language_id']  ]) ) { ?>
                        <?php echo $texts[ $language['language_id']  ]['text']; ?>
                        <?php } ?>
                    </textarea>
                </td>
              </tr>
            </table>
          </div>
          <?php } ?>
         
           <a onclick="$('#form').submit();" class="button">Save</a>
       </form>
    </div>
  </div>
</div>

   
        
        
    </div>
  </div>
</div>

<!--[if IE]>
<script type="text/javascript" src="view/javascript/jquery/flot/excanvas.js"></script>
<![endif]--> 


<script type="text/javascript" src="view/javascript/ckeditor/ckeditor.js"></script> 



<script type="text/javascript"><!--
<?php foreach ($languages as $language) { ?>
CKEDITOR.replace('description<?php echo $language['language_id']; ?>', {
	filebrowserBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserImageUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>'
});
<?php } ?>
//--></script>

<script type="text/javascript" src="view/javascript/jquery/flot/jquery.flot.js"></script> 
<script type="text/javascript"><!--
function getSalesChart(range) {
	$.ajax({
		type: 'get',
		url: 'index.php?route=common/home/chart&token=<?php echo $token; ?>&range=' + range,
		dataType: 'json',
		async: false,
		success: function(json) {
			var option = {	
				shadowSize: 0,
				lines: { 
					show: true,
					fill: true,
					lineWidth: 1
				},
				grid: {
					backgroundColor: '#FFFFFF'
				},	
				xaxis: {
            		ticks: json.xaxis
				}
			}

			$.plot($('#report'), [json.order, json.customer], option);
		}
	});
}

getSalesChart($('#range').val());
//--></script> 

<script type="text/javascript"><!--
$('#tabs a').tabs(); 
$('#languages a').tabs(); 
$('#products_languages a').tabs(); 
$('#freights_languages a').tabs(); 
$('#trucks_languages a').tabs(); 
$('#shipRoutes_languages a').tabs(); 
$('#vtab-option a').tabs();
//--></script> 


<?php echo $footer; ?>