<?php get_header(); ?>
<body class="home-template nav-closed">
	<header id="header" data-url="<?php echo wb_option('wb_highlight_img',T_P.'images/yasuko.jpg'); ?>" class="home-header blog-background banner-mask lazy no-cover">
		<div class="nav-header-container">
			<a href="<?php bloginfo('url'); ?>" class="svg-logo">
				<span class="svg-logo" >
					<img src="<?php echo wb_option('wb_logo',T_P.'images/logo.png'); ?>" alt="<?php bloginfo('name'); ?>" id="svg-luolei" />
					<title><?php bloginfo('name'); ?><?php bloginfo('description'); ?></title>
				</span>
			</a>
		</div>
		<div class="header-wrap">
			<div class="home-info-container">
				<a href="<?php bloginfo('url'); ?>"><h2><?php echo wb_option('wb_highlight_txt','Dashboard - theme settings page  - edit'); ?></h2></a>
				<h4><?php echo wb_option('wb_highlight_subtxt','请到后台主题设置页编辑'); ?></h4>
			</div>
			<div class="arrow_down" data-offset="-45">
				<a href="javascript:;"></a>
			</div>
		</div>
	</header>
	<main id="main" class="content homepage" role="main">
<?php
			$wb_list_img = wb_option('wb_list_img');
			if( $wb_list_img ) echo '<img src="'. $wb_list_img .'" class="wechat-only">';
			
			if ( have_posts() ) : 
			while ( have_posts() ) : the_post();

			get_template_part( 'post', 'list' ); 

			endwhile; 
			endif; 
			par_pagenavi();
			?>

	</main>
<?php get_footer(); ?>