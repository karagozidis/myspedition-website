<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <?php if ($success) { ?>
  <div class="success">
  You have modified productRequests, wait for admin aproval
  </div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="image/productRequest.png" width="25" alt="" /> ProductRequest</h1>
      <div class="buttons"><a href="<?php echo $insert; ?>" class="button">Insert</a><a onclick="$('#form').attr('action', '<?php echo $copy; ?>'); $('#form').submit();" class="button">Copy</a><a onclick="$('form').submit();" class="button"><?php echo $button_delete; ?></a></div>
    </div>
    <div class="content1">
      <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="list1">
          <thead>
            <tr>
              <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
              <td class="center"><?php echo $column_image; ?></td>
              <td class="left"><?php if ($sort == 'pd.name') { ?>
                <a href="<?php echo $sort_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_name; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_name; ?>"><?php echo $column_name; ?></a>
                <?php } ?>
              </td>
             <!-- <td class="left"><?php if ($sort == 'p.model') { ?>
                <a href="<?php echo $sort_model; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_model; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_model; ?>"><?php echo $column_model; ?></a>
                <?php } ?>
              </td> -->
              <td class="left"><?php if ($sort == 'p.price') { ?>
                <a href="<?php echo $sort_price; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_price; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_price; ?>"><?php echo $column_price; ?></a>
                <?php } ?>
              </td>
              <td class="right"><?php if ($sort == 'p.quantity') { ?>
                <a href="<?php echo $sort_quantity; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_quantity; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_quantity; ?>"><?php echo $column_quantity; ?></a>
                <?php } ?>
              </td>
              <td class="left"><?php if ($sort == 'p.status') { ?>
                <a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_status; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_status; ?>"><?php echo $column_status; ?></a>
                <?php } ?>
              </td>
              <td class="right"><?php echo $column_action; ?></td>
            </tr>
          </thead>
          <tbody>
            <tr class="filter">
              <td></td>
              <td></td>
              <td><input type="text" name="filter_name" value="<?php echo $filter_name; ?>" /></td>
             <!-- <td><input type="text" name="filter_model" value="<?php echo $filter_model; ?>" /></td> -->
              <td align="left"><input type="text" name="filter_price" value="<?php echo $filter_price; ?>" size="8"/></td>
              <td align="right"><input type="text" name="filter_quantity" value="<?php echo $filter_quantity; ?>" style="text-align: right;" /></td>
              <td>
                <select name="filter_status">
                  <option value="*"></option>
                  <?php if ($filter_status) { ?>
                  <option value="1" selected="selected">
                      <div style="color:greenyellow;" >
                         <?php echo $text_enabled; ?>
                      </div>
                  </option>
                  <?php } else { ?>
                  <option value="1">
                   
                      <?php echo $text_enabled; ?>
                  
                  </option>
                  <?php } ?>
                  <?php if (!is_null($filter_status) && !$filter_status) { ?>
                  <option value="0" selected="selected">
                 
                      <?php echo $text_disabled; ?>
                    
                  </option>
                  <?php } else { ?>
                  <option value="0">
                     <div style="color:red;"> 
                      <?php echo $text_disabled; ?>
                     </div> 
                  </option>
                  <?php } ?>
                </select>
              </td>
              <td align="right"><a onclick="filter();" class="button"><?php echo $button_filter; ?></a></td>
            </tr>
            <?php if ($productRequests) { ?>
            <?php foreach ($productRequests as $productRequest) { ?>
            <tr>
              <td style="text-align: center;"><?php if ($productRequest['selected']) { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $productRequest['productRequest_id']; ?>" checked="checked" />
                <?php } else { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $productRequest['productRequest_id']; ?>" />
                <?php } ?></td>
              <td class="center"><img src="<?php echo $productRequest['image']; ?>" alt="<?php echo $productRequest['name']; ?>" style="padding: 1px; border: 1px solid #DDDDDD;" /></td>
              <td class="left"><?php echo $productRequest['name']; ?></td>
              <!--<td class="left"><?php echo $productRequest['model']; ?></td>-->
              <td class="left"><?php if ($productRequest['special']) { ?>
                <span style="text-decoration: line-through;"><?php echo $productRequest['price']; ?></span><br/>
                <span style="color: #b00;"><?php echo $productRequest['special']; ?></span>
                <?php } else { ?>
                <?php echo $productRequest['price']; ?>
                <?php } ?></td>
              <td class="right"><?php if ($productRequest['quantity'] <= 0) { ?>
                <span style="color: #FF0000;"><?php echo $productRequest['quantity']; ?></span>
                <?php } elseif ($productRequest['quantity'] <= 5) { ?>
                <span style="color: #FFA500;"><?php echo $productRequest['quantity']; ?></span>
                <?php } else { ?>
                <span style="color: #008000;"><?php echo $productRequest['quantity']; ?></span>
                <?php } ?></td>
              
              <?php if($productRequest['status'] == $text_disabled) { ?>
              <td class="left" style="color:red;" >
                  <?php echo $productRequest['status']; ?>
              </td>
              <?php } else { ?> 
              <td class="left"  style="color: graytext;">
                  <?php echo $productRequest['status']; ?>
              </td>
              <?php } ?> 
             
              <td class="right"><?php foreach ($productRequest['action'] as $action) { ?>
                  <a href="<?php echo $action['href']; ?>" class="button">Edit</a> 
                <?php } ?>
              </td>
            </tr>
            <?php } ?>
            <?php } else { ?>
            <tr>
              <td class="center" colspan="8"><?php echo $text_no_results; ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </form>
      <div class="pagination"><?php echo $pagination; ?></div>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
function filter() {
	url = 'index.php?route=catalog/productRequest&token=<?php echo $token; ?>';
	
	var filter_name = $('input[name=\'filter_name\']').attr('value');
	
	if (filter_name) {
		url += '&filter_name=' + encodeURIComponent(filter_name);
	}
	
	var filter_model = $('input[name=\'filter_model\']').attr('value');
	
	if (filter_model) {
		url += '&filter_model=' + encodeURIComponent(filter_model);
	}
	
	var filter_price = $('input[name=\'filter_price\']').attr('value');
	
	if (filter_price) {
		url += '&filter_price=' + encodeURIComponent(filter_price);
	}
	
	var filter_quantity = $('input[name=\'filter_quantity\']').attr('value');
	
	if (filter_quantity) {
		url += '&filter_quantity=' + encodeURIComponent(filter_quantity);
	}
	
	var filter_status = $('select[name=\'filter_status\']').attr('value');
	
	if (filter_status != '*') {
		url += '&filter_status=' + encodeURIComponent(filter_status);
	}	

	location = url;
}
//--></script> 
<script type="text/javascript"><!--
$('#form input').keydown(function(e) {
	if (e.keyCode == 13) {
		filter();
	}
});
//--></script> 
<script type="text/javascript"><!--
$('input[name=\'filter_name\']').autocomplete({
	delay: 500,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/productRequest/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item.name,
						value: item.productRequest_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		$('input[name=\'filter_name\']').val(ui.item.label);
						
		return false;
	},
	focus: function(event, ui) {
      	return false;
   	}
});

$('input[name=\'filter_model\']').autocomplete({
	delay: 500,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/productRequest/autocomplete&token=<?php echo $token; ?>&filter_model=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item.model,
						value: item.productRequest_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		$('input[name=\'filter_model\']').val(ui.item.label);
						
		return false;
	},
	focus: function(event, ui) {
      	return false;
   	}
});
//--></script> 
<?php echo $footer; ?>