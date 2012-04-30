<?php
/*
Plugin Name: Lightslide
Plugin URI: http://kayosite.com/the-plugin-lightslide.html
Description: 为了实现一款简洁，轻量又不失功能的幻灯，特制这款 Wordpress 插件
Version: 1.0
Author: Kayo
Author URI: http://kayosite.com
*/

/*  Copyright 2011  Kayo  (email : 330956999@qq.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
?>
<?php
define('LIGHTSLIDE_URL',get_option('siteurl').'/wp-content/plugins/lightslide/');

// 默认值
global $slsettings_defaults;
$slsettings_defaults=array(
'image_width'=>696,
'image_height'=>241,
'image_border'=>10,
'border_color'=>'#ddd',
'nav_color'=>'#ddd',
'image_number'=>3,
'current_nav_color'=>'#999',
'show_nav'=>'true',
'show_button'=>'true',
'show_text'=>'true',
'show_ls_jquery'=>'true',
'slide_image1'=>LIGHTSLIDE_URL.'images/img1.jpg',
'slide_imagelink1'=>'http://kayosite.com/the-plugin-lightslide.html',
'slide_imagetext1'=>'The First Image',
'slide_image2'=>LIGHTSLIDE_URL.'images/img2.jpg',
'slide_imagelink2'=>'http://kayosite.com/the-plugin-lightslide.html',
'slide_imagetext2'=>'The Second Image',
'slide_image3'=>LIGHTSLIDE_URL.'images/img3.jpg',
'slide_imagelink3'=>'http://kayosite.com/the-plugin-lightslide.html',
'slide_imagetext3'=>'It\'s the last'
);
register_deactivation_hook(__FILE__, 'wpls_ls_deactivate' );
register_activation_hook(__FILE__, 'wpls_ls_activate'); 
function wpls_ls_deactivate()
{
//	delete_option('wpls_options');
}
function wpls_ls_activate(){
	global $slsettings_defaults,$values;
	$default_settings = get_option('wpls_options');
	$default_settings= wp_parse_args($default_settings, $slsettings_defaults);
	add_option('wpls_options',$default_settings);
}

// 更新
update_lightslide_options();

// 后台设置选项
function wp_lightslide_options_admin(){
	add_options_page("Lightslide 选项", "Lightslide", 5,  __FILE__, 'wp_lightslide_options');
}
add_action('admin_menu', 'wp_lightslide_options_admin');

function wp_lightslide_options(){
  $options = get_option('wpls_options'); 
?>
    <div class="wrap">
        <div id="options-general"><br/></div>
			<h2>Lightslide 选项</h2>
        <form method="post" action="">
			<input type="hidden" name="update_lightslide_options" value="true" />
			<p><?php _e("幻灯宽度", 'get_lightslide'); ?>:<input type="text" name="wpls_options[image_width]" value="<?php echo $options['image_width'] ?>" size="3" />px&nbsp;&nbsp;<?php _e("幻灯高度", 'get_lightslide'); ?>:<input type="text" name="wpls_options[image_height]" value="<?php echo $options['image_height'] ?>" size="3" />px</p>
			<p><?php _e("边框大小", 'get_lightslide'); ?>:<input type="text" name="wpls_options[image_border]" value="<?php echo $options['image_border'] ?>" size="3" />px&nbsp;&nbsp;&nbsp;&nbsp;<?php _e("边框颜色", 'get_lightslide'); ?>:<input type="text" name="wpls_options[border_color]" value="<?php echo $options['border_color'] ?>" size="9" />E:#DDD</p>
			<p><?php _e("导航颜色", 'get_lightslide'); ?>:<input type="text" name="wpls_options[nav_color]" value="<?php echo $options['nav_color'] ?>" size="9" />&nbsp;&nbsp;&nbsp;&nbsp;<?php _e("图片数量", 'get_lightslide'); ?>:<input type="text" name="wpls_options[image_number]" value="<?php echo $options['image_number'] ?>" size="3" /></p>
			<p><?php _e("当前导航颜色", 'get_lightslide'); ?>:<input type="text" name="wpls_options[current_nav_color]" value="<?php echo $options['current_nav_color'] ?>" size="9" />&nbsp;&nbsp;<?php _e("是否显示导航", 'get_lightslide'); ?>?&nbsp;<select name="wpls_options[show_nav]"><option value="true" <?php selected('true', $options['show_nav']); ?>>显示</option><option value="false" <?php selected('false', $options['show_nav']); ?>>不显示</option></select></p>
			<p><?php _e("是否显示下（上）一张按钮", 'get_lightslide'); ?>?&nbsp;<select name="wpls_options[show_button]"><option value="true" <?php selected('true', $options['show_button']); ?>>显示</option><option value="false" <?php selected('false', $options['show_button']); ?>>不显示</option></select>&nbsp;<?php _e("是否显示配图文字", 'get_lightslide'); ?>?&nbsp;<select name="wpls_options[show_text]"><option value="true" <?php selected('true', $options['show_text']); ?>>显示</option><option value="false" <?php selected('false', $options['show_text']); ?>>不显示</option></select></p>
			<p><?php _e("是否加载jQuery库", 'get_lightslide'); ?>?&nbsp;<select name="wpls_options[show_ls_jquery]"><option value="true" <?php selected('true', $options['show_ls_jquery']); ?>>加载</option><option value="false" <?php selected('false', $options['show_ls_jquery']); ?>>不加载</option></select>&nbsp;</p>
						
			<?php		
				for($i=1;$i<=$options['image_number'];$i++)
				{
				?>
				<h4>图片 <?php echo $i;?></h4>
				<table cellspacing="0" cellpadding="0" border="0">
				<tr><td width="160">
				<?php _e("图片地址", 'get_lightslide'); ?></td><td>
				<input type="text" name="wpls_options[slide_image<?php echo $i;?>]" value="<?php echo $options['slide_image'.$i] ?>" size="75" /></td></tr>
				<tr><td width="160"><?php _e("图片链接", 'get_lightslide'); ?></td><td>
				<input type="text" name="wpls_options[slide_imagelink<?php echo $i;?>]" value="<?php echo $options['slide_imagelink'.$i] ?>" size="75" /></td></tr><tr>
				</tr><tr><td width="160"><?php _e("配图文字", 'get_lightslide'); ?></td><td>
				<textarea name="wpls_options[slide_imagetext<?php echo $i;?>]" cols="70" rows="4"><?php echo stripslashes($options['slide_imagetext'.$i]); ?></textarea></td></tr>
				</table>
				<?php
				}
			?>
         <p><input type="submit" value="保存设置" class="button button-primary" /></p>
        </form>
    </div>
<?php
}

// 选项更新
function update_lightslide_options(){
	if(isset($_POST['wpls_options'])){
		unset($_POST['update']);
		update_option('wpls_options', $_POST['wpls_options']);
	}
}

add_action('wp_head', 'wpls_lightslide_header');
function wpls_lightslide_header() { 
$options_css = get_option('wpls_options');
if($options_css['show_ls_jquery'] == 'true') { ?>
   <script type="text/javascript" src="<?php echo get_option('home'); ?>/wp-content/plugins/lightslide/js/jquery.min.js"></script>
<?php	} ?>
<script type="text/javascript" src="<?php echo get_option('home'); ?>/wp-content/plugins/lightslide/js/lightslide.js"></script>
<style type="text/css" media="screen">
#slide {height: <?php echo $options_css['image_height']+2*$options_css['image_border']+25 ?>px; width: <?php echo $options_css['image_width']+2*$options_css['image_border'] ?>px; }
#slideshow {position: relative; height: <?php echo $options_css['image_height'] ?>px; width: <?php echo $options_css['image_width'] ?>px; border: <?php echo $options_css['image_border'] ?>px solid <?php echo $options_css['border_color'] ?>;}
#slideshow .leftImg {display: block; height: 34px; margin-top: -17px; position: absolute; top: 50%; left: 0; z-index: 11; }
#slideshow .rightImg {display: block; height: 34px; margin-top: -17px; position: absolute; top: 50%; right: 0; z-index: 11; }
#slideshow div {position: absolute; top: 0; left: 0; z-index: 8; opacity: 0.0; height: <?php echo $options_css['image_height'] ?>px; width: <?php echo $options_css['image_width'] ?>px; overflow: hidden; background-color: #fff;}
#slideshow div.current {z-index: 10;}
#slideshow div.prev {z-index: 9;}
#slideshow div img {display: block; border: 0; height: <?php echo $options_css['image_height'] ?>px; width: <?php echo $options_css['image_width'] ?>px; }
#slideshow div span {display: none; position: absolute; bottom: 0; left: 0; height: 50px; line-height: 50px; background: #000; color: #fff; width: 100%; font-size: 12pt; }
#slideshow div.current span {display: block; padding-left: 10px; }
#slidenav {width: 100%; height: 25px; text-align: center; }
.slidenavcon {height: 100%; margin: 0 auto; }
#slidenav span {float: left; display: block; width: 10px; margin-right: 5px; font-size: 20pt; color: <?php echo $options_css['nav_color'] ?>; text-decoration: none; cursor: pointer; }
#slidenav .cur {color: <?php echo $options_css['current_nav_color'] ?>; }
</style>
<?php	}

// 幻灯输出
function get_lightslide(){
  $options_get = get_option('wpls_options'); 
?>
	<div id="slide">
	<div id="slideshow">

	<?php if($options_get['show_button'] == 'true') { ?>
		<a class="leftImg" href="#" ><img src="<?php echo get_option('siteurl'); ?>/wp-content/plugins/lightslide/images/leftImg.png"/></a>
		<a class="rightImg" href="#" ><img src="<?php echo get_option('siteurl'); ?>/wp-content/plugins/lightslide/images/rightImg.png"/></a>
	<?php } ?>

	<?php
		for($j=1;$j<=$options_get['image_number'];$j++){
			echo '<div>';
				if($options_get['slide_imagelink'.$j]!=''){
			?>
				<a href="<?php echo $options_get['slide_imagelink'.$j]; ?>" title="<?php echo $options_get['slide_imagetext'.$j];?>">
			<?php } ?>
				<img src="<?php echo $options_get['slide_image'.$j]; ?>" alt="<?php echo $options_get['slide_image'.$j];?>"  />
        <?php 
				if($options_get['slide_imagelink'.$j]!=''){
			?>
        		</a>
			<?php }

			if($options_get['show_text'] == 'true') { ?>
			<?php
				$options_get['slide_imagetext'.$j]=stripslashes($options_get['slide_imagetext'.$j]);
			?>
        		<span><?php echo $options_get['slide_imagetext'.$j];?></span>
		<?php
			}
		echo '</div>';	
	}			
	echo '</div>';

	if($options_get['show_nav'] == 'true') {
		echo '<div id="slidenav"><div class="slidenavcon"></div></div>';
	}

	echo '</div>' ;
}
?>