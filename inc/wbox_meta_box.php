<?php
/*
 *给文章发布自定义一个上传表单
 *使用方法： require get_template_directory() . '/wbox_meta_box.php';
 */
if ( is_admin() ) wp_enqueue_script('metabox_up', get_template_directory_uri(). '/js/wb_meta_box.js');

function wb_cover_pic() {
  add_meta_box(
    'wb_cover_pic',
    '自定义顶部封面图片',
    'wb_cover_pic_meta_box',
    'post',
    'side',
    'default'
    );

}

add_action( 'add_meta_boxes', 'wb_cover_pic' );

function wb_cover_pic_meta_box($post) {
    // 创建临时隐藏表单，为了安全
  wp_nonce_field( 'wb_cover_pic_meta_box', 'wb_cover_pic_meta_box_nonce' );
    // 获取之前存储的值
  $value = get_post_meta( $post->ID, '_wb_cover_pic', true );
  echo '<p>这里如果不设置，将自动调用特色图片作为顶部封面图。</p>';
  echo '<input class="wb_upload_input" type="text" size="25" value="'.$value.'" name="wb_cover_pic"/>';
  echo '<input type="button" value="上传" class="wb_upload_bottom"/>';
  echo '<style>#wb_cover_pic_img img {max-width:100%; height:auto;}</style>';
  echo '<div id="wb_cover_pic_img">';
  if($value != ''){
    echo '<img src='.$value.' alt="" />';
  }
  echo '</div>';
}

add_action( 'save_post', 'wb_cover_pic_save_meta_box' );

function wb_cover_pic_save_meta_box($post_id){
    // 安全检查
    // 检查是否发送了一次性隐藏表单内容（判断是否为第三者模拟提交）
  if ( ! isset( $_POST['wb_cover_pic_meta_box_nonce'] ) ) {
    return;
  }

    // 判断隐藏表单的值与之前是否相同
  if ( ! wp_verify_nonce( $_POST['wb_cover_pic_meta_box_nonce'], 'wb_cover_pic_meta_box' ) ) {
    return;
  }

    // 判断该用户是否有权限
  if ( ! current_user_can( 'edit_post', $post_id ) ) {
    return;
  }
    // 判断 Meta Box 是否为空
  if ( ! isset( $_POST['wb_cover_pic'] ) ) {
    return;
  }
  $wb_cover_pic = sanitize_text_field( $_POST['wb_cover_pic'] );
  update_post_meta( $post_id, '_wb_cover_pic', $wb_cover_pic );
}