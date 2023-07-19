<!DOCTYPE html>
<html>
	<head>
		<?php wp_head(); ?>
	</head>
	<body>
		<div id="notfooter">
			<div id="accountbuttons">
				<?php if (is_user_logged_in()): ?>
					
					<a id="logoutbutton" href="<?php echo wp_logout_url(); ?>">
						Log Out
					</a>
				<?php else: ?>
					<a class="loggedoutbuttons" href="<?php echo wp_login_url(); ?>">Log In</a>
					<a class="loggedoutbuttons" href="<?php echo wp_registration_url(); ?>">Sign Up</a>
				<?php endif; ?>
			</div>
			<h1 id="sitetitle"><a href="<?php echo get_home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
			<?php get_search_form(); ?>
			<h3><?php bloginfo('description'); ?></h3>
			<?php if (!is_404()):
				if (is_post_type_archive('activity') or get_post_type() == 'activity'): ?>
					<nav id="topmenu">
						<ul>
							<div class="menu-top-menu-container">
								<ul id="menu-top-menu" class="menu">
									<?php $menu = wp_get_nav_menu_items('Top Menu');
									foreach ($menu as $item): ?>
										<li <?php if ($item->title == 'Activities') echo 'class="current-menu-item"' ?>>
											<a href="<?php echo $item->url; ?>">
												<?php echo $item->title; ?>
											</a>
										</li>
									<?php endforeach; ?>
								</ul>
							</div>
						</ul>
					</nav>
				<?php else: ?>
					<nav id="topmenu" <?php if (is_search()) echo 'class="search"' ?>><ul>
						<?php wp_nav_menu(array(
							'theme_location' => 'topMenu'
						)); ?>
					</ul></nav>
				<?php endif;
			endif; ?>