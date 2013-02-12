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
    	<?php print $breadcrumb; ?>
			<?php if ($page['highlighted']): ?><div id="highlighted"><?php print render($page['highlighted']); ?></div><?php endif; ?>
      <a id="main-content"></a>
      <?php if ($tabs): ?><div id="tabs-wrapper" class="clearfix"><?php endif; ?>
      <?php print render($title_prefix); ?>
      <?php if ($title): ?>
        <h1<?php print $tabs ? ' class="with-tabs"' : '' ?>><?php print $title ?></h1>
      <?php endif; ?>
      <?php print render($title_suffix); ?>
      <?php if ($tabs): ?><?php print render($tabs); ?></div><?php endif; ?>
      <?php print render($tabs2); ?>
      <?php print $messages; ?>
      <?php print render($page['help']); ?>
      <?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>
      <div class="clearfix">
        <?php print render($page['content']); ?>
      </div>
      <?php print $feed_icons ?>
      <?php print render($page['footer']); ?>
    </div>
    
  </div><!-- /info -->
</div>

    <?php 
		if ($md_construction_analytics):
			print $md_construction_analytics;
    endif; ?>