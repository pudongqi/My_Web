/*WBOX 自定义字段图片上传处理*/
jQuery(document).ready(function() {
	jQuery('input.wb_upload_bottom').click(function() {
		custom_editor = true;
		targetfield = jQuery(this).prev('input');
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
		window.original_send_to_editor = window.send_to_editor;
		window.send_to_editor = function(html) {
			if (custom_editor) {
				imgurl = jQuery('img',html).attr('src');
				jQuery(targetfield).val(imgurl).focus();
				custom_editor = false;
				tb_remove();
			}else{
				window.original_send_to_editor(html);
			}
		}
		return false;
	});
//图片实时预览wb_upload_input为图片url文本框的class属性
jQuery('input.wb_upload_input').each(function()
{
	jQuery(this).bind('change focus blur', function()
	{
//获取改文本框的name属性后面
$select = '#' + jQuery(this).attr('name') + '_img';
console.log($select);
$value = jQuery(this).val();
$image = '<img src ="'+$value+'" />';
var $image = jQuery($select).html('').append($image).find('img');
//set timeout because of safari
window.setTimeout(function()
{
	if(parseInt($image.attr('width')) < 20)
	{
		jQuery($select).html('');
	}
},500);
});
});
});