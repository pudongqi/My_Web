    <footer class="site-footer clearfix ">
    	<?php echo wb_option('wb_footer_txt'); ?>
    	<?php $wb_beian = wb_option('wb_beian'); echo '<section><a href="http://www.miitbeian.gov.cn/">'. $wb_beian .'</a></section>'; ?>
        
    </footer>
    <script type="text/javascript">
    var fontcss = '<?php echo T_P; ?>css/font.min.css',fontjs = '<?php echo T_P; ?>js/webfont.js',wechatimg = '<?php echo wb_option('wb_wechatimg'); ?>',alipayimg = '<?php echo wb_option('wb_alipayimg'); ?>';
    </script>
    <script type="text/javascript" src="<?php echo T_P; ?>js/jquery-2.0.3.min.js"></script>
    <script type="text/javascript" src="<?php echo T_P; ?>js/all.min.js"></script>
    <?php $wb_zdyjs = wb_option('wb_zdyjs',0);
    if($wb_zdyjs) echo '<script type="text/javascript">
    	'.$wb_zdyjs.'
</script>';
wp_footer();
?>
</body>
</html>