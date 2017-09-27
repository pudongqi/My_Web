<?php
//分页处理
function par_pagenavi(){
  global $paged, $wp_query;
  if ( !$max_page) $max_page = $wp_query->max_num_pages;
  if($max_page > 1){
    if(!$paged) $paged = 1;
    echo '<nav class="pagination" role="navigation">';
    previous_posts_link('<span aria-hidden="true">&larr;</span> Newer Posts');
    echo '<span class="page-number">Page '.$paged.' of '.$max_page.'</span>';
    next_posts_link('Older Posts <span aria-hidden="true">&rarr;</span>');
    echo '</nav>';
  }
};

//获取图片
function wb_get_cover_pic($post_id,$imgtype = true){
  if($imgtype) $full_image_url = get_post_meta($post_id, '_wb_cover_pic', true);
  if(empty($full_image_url)){
   if(has_post_thumbnail($post_id)){
    $full_image_url_arr = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'full');
    $full_image_url = $full_image_url_arr[0];
  }else{
    $full_image_url = get_template_directory_uri().'/images/yasuko.jpg';
  }
}
return $full_image_url;
}


//自定义作者信息
/**
 * 自定义用户个人资料信息
 * https://www.wpdaxue.com/add-remove-display-wordpress-user-profile-fields.html
 */
add_filter( 'user_contactmethods', 'wpdaxue_add_contact_fields' );
function wpdaxue_add_contact_fields( $contactmethods ) {
  $contactmethods['city'] = '城市<code>Shanghai「上海」</code>';
  $contactmethods['sina_weibo'] = '新浪微博';
  $contactmethods['twitter'] = 'Twitter';
  $contactmethods['instagram'] = 'Instagram';
  $contactmethods['github'] = 'Github';
  $contactmethods['zhihu'] = '知乎';
  unset( $contactmethods['yim'] );
  unset( $contactmethods['aim'] );
  unset( $contactmethods['jabber'] );
  return $contactmethods;
}

//禁用图片响应式代码
function disable_srcset( $sources ) {
  return false;
}
add_filter( 'wp_calculate_image_srcset', 'disable_srcset' );
//内容图片延迟加载
add_filter ('the_content', 'lazyload');
function lazyload($content) {    
    if(!is_feed()||!is_robots) {
        $content=preg_replace('/<img(.+)src=[\'"]([^\'"]+)[\'"](.*)\/>/i',"<img class=\"lazy full-img\" data-url=\"\$2\" alt=\"fullimg\" />\n<noscript>\$0</noscript>",$content);
    }
    return $content;
}

//增加编辑器
function add_editor_buttons($buttons) { 
 $buttons[] = 'fontselect'; 
 $buttons[] = 'fontsizeselect'; 
 $buttons[] = 'outdent'; 
 $buttons[] = 'indent'; 
 $buttons[] = 'copy'; 
 $buttons[] = 'paste'; 
 $buttons[] = 'cut'; 
 $buttons[] = 'backcolor'; 
 return $buttons; 
} 
add_filter("mce_buttons_3", "add_editor_buttons");

//链接格式变更
function r_comments($outer){
 global $wpdb;
 $sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type,comment_author_url,comment_author_email, SUBSTRING(comment_content,1,16) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_approved = '1' AND comment_type = '' AND post_password = '' AND user_id='0' AND comment_author != '".$outer."' ORDER BY comment_date_gmt DESC LIMIT 5";
 $comments = $wpdb->get_results($sql);
 $output = $pre_HTML;
 foreach ($comments as $comment) {$output .= "\n<li>".get_avatar( $comment, 32,'',$comment->comment_author)." <a href=\"" . get_permalink($comment->ID) ."#comment-" . $comment->comment_ID . "\" title=\"发表在： " .$comment->post_title . "\">" .strip_tags($comment->comment_author).":<br/>". strip_tags($comment->com_excerpt)."</a><br /></li>";}
 $output .= $post_HTML;
 echo $output;
}

//优化项目
function wpbeginner_remove_version() { 
  return ; 
} 
add_filter('the_generator', 'wpbeginner_remove_version');//wordpress的版本号 
remove_action('wp_head', 'index_rel_link');//当前文章的索引 
remove_action('wp_head', 'feed_links_extra', 3);// 额外的feed,例如category, tag页 
remove_action('wp_head', 'start_post_rel_link', 10, 0);// 开始篇 
remove_action('wp_head', 'parent_post_rel_link', 10, 0);// 父篇 
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // 上、下篇. 
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );//rel=pre
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 );//rel=shortlink 
remove_action('wp_head', 'rel_canonical' ); 
wp_deregister_script('l10n');

/**
 * 删除emoji表情代码。
 */
function disable_wp_emojicons() {
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
  add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
}

add_action( 'init', 'disable_wp_emojicons' );
function disable_emojicons_tinymce( $plugins ) {
  if ( is_array( $plugins ) ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
  } else {
    return array();
  }
}
add_filter( 'emoji_svg_url', '__return_false' );

 /* 
 * 添加一个返回一首页的菜单 
 * 自行修改 'title' 和 'href' 的值 
 */  
 function custom_adminbar_menu( $meta = TRUE ) {  
  global $wp_admin_bar;  
  if ( !is_user_logged_in() ) { return; }  
        //if ( !is_super_admin() || !is_admin_bar_showing() ) { return; }  
  $wp_admin_bar->add_menu( array(  
    'id' => 'custom_menu',  
    'title' => __( '<b>返回首页</b>' ),  
    'href' => '/',  
    'meta'  => array( target => '_blank' ) )  
  );  
}  
add_action( 'admin_bar_menu', 'custom_adminbar_menu', 100 );  
/* add_action # 后面的数字表示位置： 
10 = 在 Logo 的前面 
15 = 在 logo 和 网站名之间 
25 = 在网站名后面 
100 = 在菜单的最后面
*/

//自动改图片文件名称
function huilang_wp_handle_upload_prefilter($file){
  $time=date("Y-m-d H:i:s");
  $file['name'] = $time."".mt_rand(1,100).".".pathinfo($file['name'] , PATHINFO_EXTENSION);
  return $file;
}
add_filter('wp_handle_upload_prefilter', 'huilang_wp_handle_upload_prefilter');

//隐藏前台顶部工具条
//add_filter('show_admin_bar', '__return_false');

add_filter( 'gettext_with_context', 'wpdx_disable_open_sans', 888, 4 );
function wpdx_disable_open_sans( $translations, $text, $context, $domain ) {
  if ( 'Open Sans font: on or off' == $context && 'on' == $text ) {
    $translations = 'off';
  }
  return $translations;
}

function get_ssl_avatar($avatar) {
 $avatar = preg_replace('/.*\/avatar\/(.*)\?s=([\d]+)&.*/','<img src="http://cn.gravatar.com/avatar/$1?s=$2" class="avatar avatar-$2" height="$2" width="$2">',$avatar);
 return $avatar;
}
add_filter('get_avatar', 'get_ssl_avatar');