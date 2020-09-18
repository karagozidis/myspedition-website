<?php echo $header; ?>
<?php echo $column_left; ?>
<?php echo $column_right; ?>

<div class="wrap">

  <!--breadcrumb
  ==============================================================-->
  <div class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
        <?php } ?>
  </div>
  
  <?php echo $content_top; ?>
  
  <!--title
  ==============================================================-->
  <h1 class="category-title"><?php echo $heading_title; ?></h1>
    
  <?php if ($thumb || $description) { ?>
  <div class="category-info">
  
    <?php if ($thumb) { ?>
    <div class="image"><img src="<?php echo $thumb; ?>" alt="<?php echo $heading_title; ?>" /></div>
    <?php } ?>
    
    <div class="right-part-2">
    
    <?php if ($description) { ?>
    <?php echo $description; ?>
    <?php } ?>
    
  </div>
  <?php } ?>
  
  
  <div class="clearfix"></div>


   <?php if ($ncategories) { ?>
        <div class="refine">
            <h2 class="refine-search"><?php echo $text_refine; ?></h2>
            <div class="category-list">
            <?php if (count($ncategories) <= 5) { ?>
            
              <?php foreach ($ncategories as $ncategory) { ?>
              <div><a href="<?php echo $ncategory['href']; ?>"><?php echo $ncategory['name']; ?></a></div>
              <?php } ?>
            
            <?php } else { ?>
            <?php for ($i = 0; $i < count($ncategories);) { ?>
            
              <?php $j = $i + ceil(count($ncategories) / 4); ?>
              <?php for (; $i < $j; $i++) { ?>
              <?php if (isset($ncategories[$i])) { ?>
              <div><a href="<?php echo $ncategories[$i]['href']; ?>"><?php echo $ncategories[$i]['name']; ?></a></div>
              <?php } ?>
              <?php } ?>
            
            <?php } ?>
            <?php } ?>
            </div>
        </div>
    <?php } ?>
  
  </div><!--/right-part-->
  
  <br /><br /><div class="clearfix"></div>
  
  <?php if ($article) { ?>
  <div class="product-list">
    <?php foreach ($article as $articles) { ?>
    <div>
	<?php if ($articles['thumb']) { ?>
      <div class="image"><a href="<?php echo $articles['href']; ?>"><img src="<?php echo $articles['thumb']; ?>" title="<?php echo $articles['name']; ?>" alt="<?php echo $articles['name']; ?>" /></a></div>
      <?php } ?>
      <div class="name"><a href="<?php echo $articles['href']; ?>"><?php echo $articles['name']; ?></a> <span style="color: #777;">- <?php echo $articles['date_added']; ?></span></div>
      <div class="description"><?php echo $articles['description']; ?></div>
	  <?php if ($articles['acom']) { ?>
	  <span style="font-style: italic; color: #777;"><?php echo $articles['total_comments']; ?> <?php echo $text_comments; ?></span>
	  <?php } ?>
	  <div style="float: right"><a class="button" href="<?php echo $articles['href']; ?>" style="margin-right:20px;"><span><?php echo $button_more; ?></span></a></div>
    </div>
    <?php } ?>
  </div>
  <div class="pagination"><?php echo $pagination; ?></div>
  <?php } ?>
  
  
  <?php if (!$ncategories && !$article) { ?>
  <div class="content"><?php echo $text_empty; ?></div>
  <div class="buttons">
    <div class="right"><a href="<?php echo $continue; ?>" class="button"><span><?php echo $button_continue; ?></span></a></div>
  </div>
  <?php } ?>
  
  
  <?php echo $content_bottom; ?></div>

<?php echo $footer; ?>