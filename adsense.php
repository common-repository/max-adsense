<?php

/*
	Plugin Name: Max Adsense
	Plugin URI: http://www.turboindir.org
	Description: Easily add Google Adsense ads to your site.
	Version: 1.0
	Author: Orçun Tuna
	Author URI: http://www.orcuntuna.com.tr
	Licence: GPL2
*/


class maxadsense extends WP_Widget{

 	function __construct(){
 	$widget_option =  array('classname'=>'maxadsense','description'=>'Easily add Google Adsense ads to your site.');
 	parent::WP_Widget('maxadsense','Max Adsense',$_widget_options);
 	}

 	function widget($arg,$instance){
 		extract($arg,EXTR_SKIP);
 		$sahip = ($instance['sahip']) ? $instance['sahip'] : 'adsense publisher id';
 		$boyut = ($instance['boyut']) ? $instance['boyut'] : 'adsense banner size';
 		$reklam = ($instance['reklam']) ? $instance['reklam'] : 'adsense banner id';

 		$boyutlar  = $boyut;
		$ayikla = explode("x", $boyutlar);
		$genislik = $ayikla[0];
		$yukseklik = $ayikla[1];

 		
 		?>

 		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<!-- <?php echo $genislik . "x" .$yukseklik . " banner (maxadsense)"; ?> -->
		<ins class="adsbygoogle"
		     style="display:inline-block;width:<?php echo $genislik; ?>;height:<?php echo $yukseklik; ?>"
		     data-ad-client="<?php echo $sahip; ?>"
		     data-ad-slot="<?php echo $reklam; ?>"></ins>
		<script>
		(adsbygoogle = window.adsbygoogle || []).push({});
		</script>

 		<?php

 	}

 	function form($instance){
 		$default = array('sahip'=>'',''=>'boyut','reklam'=>'');
 		$instance = wp_parse_args((array) $instance,$default);
 		$sahip = $instance['sahip'];
 		$boyut = $instance['boyut'];
 		$reklam = $instance['reklam'];

 		?>

 		<p><b>Adsense Publisher ID:</b></p>
 		<p><input type="text" name="<?php echo $this->get_field_name('sahip'); ?>" value="<?php echo esc_attr($sahip); ?>" /></p>
 		<p><b>Adsense Banner ID:</b></p>
 		<p><input type="text" name="<?php echo $this->get_field_name('reklam'); ?>" value="<?php echo esc_attr($reklam); ?>" /></p>
		<p><b>Adsense Banner Size:</b></p>
		<p>
			<select name="<?php echo $this->get_field_name('boyut'); ?>" value="<?php echo esc_attr($boyut); ?>">
				<option value="300x250">300x250</option>
				<option value="336x280">336x280</option>
				<option value="728x90">728x90</option>
				<option value="300x600">300x600</option>
				<option value="320x100">320x100</option>
				<option value="468x60">468x60</option>
				<option value="120x600">120x600</option>
				<option value="970x250">970x250</option>
			</select>
		</p>
 		
 		<?php
 	}

 	function update($new_instance, $old_instance){
 		$instance = $old_instance;
 		$instance['sahip'] = strip_tags($new_instance['sahip']);
 		$instance['boyut'] = strip_tags($new_instance['boyut']);
 		$instance['reklam'] = strip_tags($new_instance['reklam']);
 		return $instance;
 	}

}

	function widget_ekle(){
		register_widget('maxadsense');
	}

	add_action('widgets_init','widget_ekle');

?>
