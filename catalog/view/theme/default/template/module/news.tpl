<div class="box">
    <div class="box-heading"><?php echo $heading_title; ?> - <a style="text-decoration: none;" href="<?php echo $newslink; ?>"><?php echo $text_headlines; ?></a></div>
    
   <div class="box-content">
   
       <?php foreach ($news as $news_story) { ?>
      <div>
	  <h3><a href="<?php echo $news_story['href']; ?>"><?php echo $news_story['title']; ?></a></h3>
      
      <?php if ($thumb) { ?>
        <a href="<?php echo $news_story['href']; ?>" title="<?php echo $heading_title; ?>">
        <img  src="<?php echo $thumb; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" id="image" >
        </a>
      <?php } ?>
      
      <span style="color: #444; font-size: 12px;"><?php echo $news_story['short_description2']; ?>...</span> <a class="button" href="<?php echo $news_story['href']; ?>"><span><?php echo $text_read_more; ?></span></a> <br />
	  <?php if ($news_story['acom']) { ?>
	  <span style="font-style: italic; color: #777;"><?php echo $news_story['total_comments']; ?> <?php echo $text_comments; ?></span>
      <?php } ?></div>
    <?php } ?>
	
	</div>
</div>

