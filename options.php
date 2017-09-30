<?php
//后台设置项调用文件

/*
重命名设置项名称,避免重复调用
 */
function optionsframework_option_name() {

	// 从样式表获取主题名称
	$themename = wp_get_theme();
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

function optionsframework_options() {
//初始化数据

//文本编辑框样式
	$wp_editor_settings = array(
		'wpautop' => true, // 默认
		'textarea_rows' => 2,
		'tinymce' => array( 'plugins' => 'wordpress' )
		);

	$options = array();


	$options[] = array(
		'name' => '基本',
		'type' => 'heading');

	$options[] = array(
		'name' => '网站Logo',
		'desc' => '初始Logo，请上传PNG格式图片,大小为:225*55',
		'id' => 'wb_logo',
		'std' => T_P.'images/logo.png',
		'type' => 'upload');
	

	$options[] = array(
		'name' => '网站Favicon图标',
		'desc' => '请上传64*64 PNG格式图标',
		'id' => 'wb_favicon',
		'type' => 'upload');

	$options[] = array(
		'name' => 'apple-touch-icon图标',
		'desc' => '请上传60*60 PNG格式图标',
		'id' => 'wb_appleico',
		'type' => 'upload');

	$options[] = array(
		'desc' => '请上传76*76 PNG格式图标',
		'id' => 'wb_appleico76',
		'type' => 'upload');

	$options[] = array(
		'desc' => '请上传120*120 PNG格式图标',
		'id' => 'wb_appleico120',
		'type' => 'upload');

	$options[] = array(
		'desc' => '请上传152*152 PNG格式图标',
		'id' => 'wb_appleico152',
		'type' => 'upload');	


	$options[] = array(
		'name' => '首页及标签页',
		'type' => 'heading');

	$options[] = array(
		'name' => '默认顶部背景图',
		'desc' => '请上传首页顶部背景图，建议大小1920*1000',
		'id' => 'wb_highlight_img',
		'std' => T_P.'images/yasuko.jpg',
		'type' => 'upload');

	$options[] = array(
		'name' =>'首页顶部高亮文本',
		'desc' => '请输入首页顶部高亮文本英文部分，请注意控制字数',
		'id' => 'wb_highlight_txt',
		'type' => 'text'
		);

	$options[] = array(
		'desc' => '请输入首页顶部高亮文本中文部分，请注意控制字数',
		'id' => 'wb_highlight_subtxt',
		'type' => 'text'
		);	

	$options[] = array(
		'name' => '默认首页及列表页SEO图片设置',
		'desc' => '这个具体我也不大清楚有什么用，大概理解的意思是首页和列表的图片采用了延迟加载，所以搜索引擎会把这张图片作为列表页的图片处理',
		'id' => 'wb_list_img',
		'type' => 'upload');



	$options[] = array(
		'name' => '文章内页',
		'type' => 'heading');

	$options[] = array(
		'name' => '打赏功能',
		'desc' => '打赏功能开关,选中为开启,取消选中为关闭',
		'id' => 'wb_shang_off',
		'std' => '1',
		'type' => 'checkbox');

	$options[] = array(
		'desc' => '微信二维码上传,推荐大小200*200',
		'id' => 'wb_wechatimg',
		'type' => 'upload');

	$options[] = array(
		'desc' => '支付宝二维码上传,推荐大小200*200',
		'id' => 'wb_alipayimg',
		'type' => 'upload');

	$options[] = array(
		'desc' =>'请输入打赏按钮下文本内容',
		'id' => 'wb_shang_b_txt',
		'std' => '若你觉得我的文章对你有帮助,欢迎点击上方按钮对我打赏',
		'type' => 'text'
		);

	$options[] = array(
		'name' => '二维码分享功能',
		'desc' => '二维码分享功能开关,选中为开启,取消选中为关闭',
		'id' => 'wb_qrcode_off',
		'std' => '1',
		'type' => 'checkbox');

	$options[] = array(
		'desc' =>'请输入二维码分享下文本内容',
		'id' => 'wb_qrcode_b_txt',
		'std' => '扫描二维码,分享此文章',
		'type' => 'text'
		);

	$options[] = array(
		'name' => '作者信息显示开关',
		'desc' => '选中为开启,取消选中为关闭',
		'id' => 'wb_author_off',
		'std' => '1',
		'type' => 'checkbox');
	
	
	$options[] = array(
		'name' => '网站页脚',
		'type' => 'heading');	
	

	$options[] = array(
		'name' =>'网站底部文本信息',
		'desc' => '请输入网站底部文本信息',
		'id' => 'wb_footer_txt',
		'std' => '<section class="copyright "><a href="http://aesow.com ">丁亦然的独立博客</a> © 2016 </section>
<section><a href="https://github.com/foru17/Yasuko">Theme Aesow </a><a class="github-repo" href="https://github.com/foru17/Aeosw"><span class="gadget-github"></span>
star</a> Designed by <a href="http://weibo.com/dyr0825">@丁亦然</a></section>
<section class="poweredby ">Powered by <a href="http://wordpress.org ">Wordpress</a></section>
<section class="poweredby ">本博客托管于<a href="https://www.aliyun.com/ ">阿里云中国</a> CDN加速 by <a href="http://www.qiniu.com/ ">Qiniu七牛云</a><section>',
		'type' => 'textarea'
		);

	$options[] = array(
		'name' =>'网站备案号',
		'desc' => '请输入网站备案号',
		'id' => 'wb_beian',
		'std' => '京备字 20161228号',
		'type' => 'textarea'
		);

	$options[] = array(
		'name' =>'自定义CSS代码',
		'desc' => '请输入自定义的CSS代码,前后不要加&lt;style&gt;标签',
		'id' => 'wb_zdycss',
		'type' => 'textarea'
		);
	$options[] = array(
		'name' =>'自定义JS代码',
		'desc' => '请输入自定义的JS代码,前后不要加&lt;javascript&gt;标签',
		'id' => 'wb_zdyjs',
		'type' => 'textarea'
		);

	return $options;
}