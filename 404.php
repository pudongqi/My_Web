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
			<div class="home-info-container" style="margin-top: 10rem;">

				<a href="<?php bloginfo('url'); ?>"><h2>The page not found</h2></a>
				<h4>这个页面走丢了</h4>
				<a href="<?php bloginfo('url'); ?>" class="back-home404">返回首页</a>
				
			</div>			
		</div>
	</header>
	<style type="text/css">
	.site-footer { margin-top:0 !important;}
	</style>
<?php get_footer(); ?>