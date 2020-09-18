<div class="box">
    <div class="box-heading"><?php echo $heading_title; ?><span class="heading-shadow"></span></div>
    <div class="box-content">
      <?php foreach ($news as $news_story) { ?>
      <div class="postSide">

          <?php if ($news_story['thumb']) { ?>
          <div class="image newSideImg">
              <a href="<?php echo $news_story['href']; ?>">
              	<img src="<?php echo $news_story['thumb']; ?>" title="<?php echo $news_story['title']; ?>" alt="<?php echo $news_story['title']; ?>" />
              </a>
          </div>
          <?php } ?>
          
          <a class="newsTitle" href="<?php echo $news_story['href']; ?>"><?php echo $news_story['title']; ?></a><br />
          
          <span><?php echo $news_story['short_description']; ?>...</span><b> 
          <a href="<?php echo $news_story['href']; ?>"><?php echo $text_read_more; ?></a></b> <br />
	  	  
          <?php if ($news_story['acom']) { ?>
            <span style="font-style: italic; color: #777;"><?php echo $news_story['total_comments']; ?> <?php echo $text_comments; ?></span>
          <?php } ?>
       
	  </div>
      <?php } ?>
	  
      <a class="button" href="<?php echo $newslink; ?>"><span><?php echo $text_headlines; ?></span></a>
   </div>
</div>

