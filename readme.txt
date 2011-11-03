=== Plugin Name ===
Contributors: Kayo
Donate link: 
Tags: light, slide, lightslide, images, photos, gallery, slideshow, jquery slideshow
Requires at least: 3.0.4
Tested up to: 3.2.1
Version: 0.9

为了实现一款简洁，轻量又不失功能的幻灯，特制这款 Wordpress 插件(A simple and light but useful slide)


== Description ==

默认用户交互效果

1.幻灯图片每3秒自动循环播放

2.鼠标悬停在幻灯上幻灯停止播放

3.点击向右（向左）按钮自动播放下（上）一张图片

4.点击图片下面的导航点马上切换到相应的图片


用户可设置

1.幻灯图片的数量

2.图片的高度、宽度

3.幻灯边框的大小、颜色

4.导航是否显示，导航的颜色

5.是否显示图片的配对文字，配对文字的内容

6.是否显示上（下）一张图片按钮

7.图片的超链接

8.是否加载jQuery库


== Installation ==

1.下载Lightslide插件，博客发布页 http://kayosite.com/the-plugin-lightslide.html

2.在后台上传插件到插件目录并启用插件

3.在需要调用幻灯的地方添加如下代码
<?php if(function_exists('get_lightslide')) { get_lightslide(); } ?>


== Upgrade Notice ==

重新上传插件到插件目录覆盖即可


== Changelog ==

= 0.9 =
* 在插件选项中添加勾选加载jQuery库的选项
* 美化后台设置面板

= 0.8 =

* 修正后台设置面板中的小Bug
* 优化jQuery代码，把高亮显示导航的代码写成函数，大大缩短代码量


== Frequently Asked Questions ==

若调用<code><?php if(function_exists('get_lightslide')) { get_lightslide(); } ?></code>后无法看到效果，请检查是否已经加载jQuery库，如没有加载可以在插件后台中启用jQuery库。

如果还有疑问，可以到我的博客插件发布页http://kayosite.com/the-plugin-lightslide.html留言
