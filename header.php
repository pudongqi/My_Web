<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php 
	$t = trim(wp_title('', false)); 
	if($t) echo $t.' | '; 
	else ''; bloginfo('name'); 
	if ($paged > 1) echo ' | 第 ', $paged, ' 页';
	if (is_home ()) echo ' | '.get_option('blogdescription'); 
?></title>
<?php
		wp_head();
		$wb_favicon = wb_option('wb_favicon');
		if( $wb_favicon ) echo "<link href=\"$wb_favicon\" rel=\"shortcut icon\" />\n";
		$wb_appleico = wb_option('wb_appleico');
		if( $wb_appleico ) echo "<link href=\"$wb_appleico\" rel=\"apple-touch-icon\" />\n";
		$wb_appleico76 = wb_option('wb_appleico76');
		if( $wb_appleico76 ) echo "<link href=\"$wb_appleico76\" rel=\"apple-touch-icon\" sizes=\"76x76\" />\n";
		$wb_appleico120 = wb_option('wb_appleico120');
		if( $wb_appleico120 ) echo "<link href=\"$wb_appleico120\" rel=\"apple-touch-icon\" sizes=\"120x120\" />\n";
		$wb_appleico152 = wb_option('wb_appleico152');
		if( $wb_appleico152 ) echo "<link href=\"$wb_appleico152\" rel=\"apple-touch-icon\" sizes=\"152x152\" />\n";
?>
<link rel="stylesheet" href="<?php echo T_P; ?>style.css">
<?php
$wb_zdycss = wb_option('wb_zdycss',0);
if($wb_zdycss) echo '<style type="text/css">
	'.$wb_zdycss.'
</style>';
?>
</head>
