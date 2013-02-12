<?php
?><div id="wrap">
  <div id="screenshot">
  	<?php if ($md_construction_image_url): ?>
  	<img src="<?php print $md_construction_image_url; ?>" />
  	<?php endif; ?>
  </div>
  <div id="info">
    <div id="logo">
    	<a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home">
        <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>"/>
      </a>
    </div>
    <div class="text">
    	<?php if ($md_construction_headtitle): ?>
      <h1><?php print $md_construction_headtitle; ?></h1>
      <?php endif; ?>
      <?php if ($md_construction_desc): ?>
      <div><?php print $md_construction_desc; ?></div>
      <?php endif; ?>
    </div>
    <div class="subs">
    	<?php if ($md_construction_feedburner): ?>
      	<div id="home-subscribe">
          <form action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php print $md_construction_feedburner; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
            <input type="text" class="textinput" name="email" value="your email for subscription" onfocus="if(this.value=='your email for subscription') { this.value = '' }" onblur="if(this.value=='') { this.value = 'your email for subscription' }">
            <input type="hidden" value="bloqro" name="uri">
            <input type="hidden" name="loc" value="en_US">
            <input type="submit" class="button" value="Sign up">
          </form>
        </div>
      <?php endif; ?>
      <?php if ($md_construction_facebook): ?>
      <a href="http://facebook.com/<?php print $md_construction_facebook; ?>" class="social-fb" title="Become a fan on Facebook">Facebook</a>
       <?php endif; ?>
      <?php if ($md_construction_twitter): ?>
      <a href="http://twitter.com/<?php print $md_construction_twitter; ?>" class="social-tw" title="Follow me on Twitter">Twitter</a>
       <?php endif; ?>
    </div>
  </div><!-- /info -->
</div>

    <?php 
		if ($md_construction_analytics):
			print $md_construction_analytics;
    endif; ?>