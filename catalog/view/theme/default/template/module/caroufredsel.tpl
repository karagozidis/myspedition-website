<div id="caroufredsel<?php echo $module; ?>" style="height: 100px; width: 1000px;">
  <ul class="jcaroufredsel-skin-mazaholic" style="height: 100px;width: 1000px;">
    <?php foreach ($banners as $banner) { ?>
    <li>
        <a href="<?php echo $banner['link']; ?>">
            <img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" title="<?php echo $banner['title']; ?>" />
        </a>
    </li>
    <?php } ?>

  </ul>
</div>
<?php if($duration == "")$duration = 500 ;?>
<script type="text/javascript"><!--
$('#caroufredsel<?php echo $module; ?> ul').carouFredSel({
	scroll:{
		items :<?php echo $scroll;?>,
		duration:<?php echo $duration;?>,
		pauseOnHover:true
	},
	direction : "<?php echo $direction;?>",
	items:<?php echo $limit;?>,
        visible: <?php echo $limit; ?>,
        vertical: false
});
//--></script>