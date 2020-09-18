<div id="carousel<?php echo $module; ?>" class="jcarousel-skin-opencart" >
  <ul>
    <?php foreach ($banners as $banner) { ?>
    <li>
        <table>
            <tr>
                <td width=110 style="border: 1px solid #E6E6E6;background: #FFFFFF;" >
                  <a href="<?php echo $banner['link']; ?>" target="_blank">
                        <img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" title="<?php echo $banner['title']; ?>"  /> 
                  </a>
                </td>
            </tr>
            <tr>
                <td width=110 style="border: 1px solid #EEEEEE;background: #E6E6E6;">
                  <a href="<?php echo $banner['link']; ?>" target="_blank">                        
                       <?php echo $banner['title']; ?>
                  </a>
                </td>
            </tr>
        </table>
       
    </li>
    <?php } ?>

  </ul>
</div>
<?php if($duration == "")$duration = 500 ;?>
<script type="text/javascript"><!--
$('#carousel<?php echo $module; ?> ul').jcarousel({
	vertical: false,
	visible: <?php echo $limit; ?>,
	scroll: <?php echo $scroll; ?>,
	visible: 5,
	circular: true,
	auto: 2,
  wrap: 'last',		
});
//--></script>