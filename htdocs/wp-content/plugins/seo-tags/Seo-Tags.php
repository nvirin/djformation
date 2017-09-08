<?php
/*
Plugin Name: Seo Tags
Plugin URI: http://pctricks.ir
Description: Add Widget For Show Most Popular Tag in Google.
Version: 1.0
Author: <a href="http://pctricks.ir">Mostafa Shiraali</a>
Author URI: http://pctricks.ir
License: Cammercial
Text Domain: SeoTags
Domain Path: /languages
*/
 function seowidget_active()
 {
 add_option('seotag_engine',"google");
 add_option('seotag_count',"normal");
 add_option('seotag_theme',"3D");
 add_option('seotag_3D_option','freezeActive: false,
freezeDecel: false,
activeCursor: \'pointer\',
pulsateTo: 1,
pulsateTime: 3,
reverse: false,
depth: 0.5,
maxSpeed: 0.05,
minSpeed: 0,
decel: 0.95,
interval: 20,
minBrightness: 0.1,
maxBrightness: 1,
outlineColour: \'#ffff99\',
outlineThickness: 2,
outlineOffset: 5,
outlineMethod: \'outline\',
outlineRadius: 0,
textColour: \'#ff99ff\',
textHeight: 15,
textFont: \'Helvetica, Arial, sans-serif\',
shadow: \'#000\',
shadowBlur: 0,
shadowOffset: [0,0],
initial: null,
hideTags: true,
zoom: 1,
weight: false,
weightMode: \'size\',
weightFrom: null,
weightSize: 1,
weightSizeMin: null,
weightSizeMax: null,
weightGradient: {0:\'#f00\', 0.33:\'#ff0\', 0.66:\'#0f0\', 1:\'#00f\'},
txtOpt: true,
txtScale: 2,
frontSelect: false,
wheelZoom: true,
zoomMin: 0.3,
zoomMax: 3,
zoomStep: 0.05,
shape: \'sphere\',
lock: null,
tooltip: null,
tooltipDelay: 300,
tooltipClass: \'tctooltip\',
radiusX: 1,
radiusY: 1,
radiusZ: 1,
stretchX: 1,
stretchY: 1,
offsetX: 0,
offsetY: 0,
shuffleTags: false,
noSelect: false,
noMouse: false,
imageScale: 1,
paused: false,
dragControl: false,
dragThreshold: 4,
splitWidth: 0,
animTiming: \'Smooth\',
clickToFront: false,
fadeIn: 0,
padding: 0,
bgColour: null,
bgRadius: 0,
bgOutline: null,
bgOutlineThickness: 0,
outlineIncrease: 4,
textAlign: \'centre\',
textVAlign: \'middle\',
imageMode: null,
imagePosition: null,
imagePadding: 2,
imageAlign: \'centre\',
imageVAlign: \'middle\',
noTagsMessage: true');
 }
 function seowidget_init()
 {
 register_setting('seotag_opt','seotag_engine');
 register_setting('seotag_opt','seotag_count');
 register_setting('seotag_opt','seotag_theme');
 register_setting('seotag_opt','seotag_3D_option');
 }
  function seowidget_deactivate()
  {
  	delete_option('seotag_engine');
	delete_option('seotag_count');
	delete_option('seotag_theme');
	delete_option('seotag_3D_option');
  }
 if ( ! function_exists( 'seowidget_lang_init' ) ) {
 function seowidget_lang_init()
 {
   load_plugin_textdomain( 'SeoTags', false,dirname( plugin_basename( __FILE__ ) ) .'/languages/' );
 }
 }
 function seotags_menu() {
	add_options_page(__("Seo Tags","SeoTags"), __("Seo Tags Widget","SeoTags"), 10, __FILE__,"seowidget_display_options");
}
function seowidget_display_options()
{
?>
	<div class="wrap">
	<h2><?php _e("Seo Tags Option","SeoTags")?></h2>        
	<form method="post" action="options.php">
	<?php settings_fields('seotag_opt'); ?>
	<table class="form-table">
	    <tr valign="top">
        <th scope="row"><label><?php _e("Keywords Engine","SeoTags");?></label></th>
		<td><span class="description"><?php _e("Select Keywords Engine(If Select Both Loading time is more)","SeoTags")?></span></td>
		<td>
		<select name="seotag_engine">
		<option value="google" <?php if ( get_option('seotag_engine') == "google" ) echo 'selected="selected"'; ?>><?php _e("Google.com","SeoTags");?></option>
		<option value="bing" <?php if ( get_option('seotag_engine') == "bing" ) echo 'selected="selected"'; ?>><?php _e("Bing.com","SeoTags");?></option>
		<option value="both" <?php if ( get_option('seotag_engine') == "both" ) echo 'selected="selected"'; ?>><?php _e("Both","SeoTags");?></option>
		</select>
		</td>
        </tr>	
		<tr valign="top">
        <th scope="row"><label><?php _e("Number of Keyword","SeoTags");?></label></th>
		<td><span class="description"><?php _e("Select Number of Keyword,I recommend you choose Normal.(If Select alot Loading time is more)","SeoTags")?></span></td>
		<td>
		<select name="seotag_count">
		<option value="normal" <?php if ( get_option('seotag_count') == "normal" ) echo 'selected="selected"'; ?>><?php _e("normal","SeoTags");?></option>
		<option value="high" <?php if ( get_option('seotag_count') == "high" ) echo 'selected="selected"'; ?>><?php _e("High","SeoTags");?></option>
		</select>
		</td>
        </tr>
		<tr valign="top">
        <th scope="row"><label><?php _e("Keywords Theme","SeoTags");?></label></th>
		<td><span class="description"><?php _e("Select Keywords theme","SeoTags")?></span></td>
		<td>
		<select name="seotag_theme">
		<option value="defualt" <?php if ( get_option('seotag_theme') == "defualt" ) echo 'selected="selected"'; ?>>defualt</option>
		<option value="3D" <?php if ( get_option('seotag_theme') == "3D" ) echo 'selected="selected"'; ?>>3D Tag Cloud</option>
		</select>
		</td>
        </tr>
		<tr valign="top">
        <th scope="row"><label><?php _e("3D Tag Cloud","SeoTags");?></label></th>
		<td><span class="description"><?php _e("You Can Change 3D Tag Cloud Theme Option From Here(<a href=\"http://www.goat1000.com/tagcanvas-options.php\" target=\"_blank\">Option Description</a>)","SeoTags")?></span></td>
		<td>
		<textarea name="seotag_3D_option" style="width: 700px; height: 400px;"><?php echo get_option('seotag_3D_option'); ?></textarea>
		</td>
        </tr>		
	</table>
	<p class="submit">
	<center><input type="submit" name="Submit" value="Save" style="cursor: pointer;width: 250px; height: 40px; background: none repeat scroll 0% 0% rgb(117, 195, 69); color: rgb(0, 0, 0); border-radius: 10px; box-shadow: 1px 1px 1px 1px rgb(0, 0, 0);" /></center>
	</p>
		</form>
	</div>
<?php
}
function GoogleKeywordSuggestions($keyword) {
    $keywords = array();
	$curl_handle=curl_init();
	curl_setopt($curl_handle,CURLOPT_URL,'http://suggestqueries.google.com/complete/search?output=firefox&client=firefox&hl=en-US&q='.urlencode($keyword));
	curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,180);
	curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
	$data = curl_exec($curl_handle);
	curl_close($curl_handle);
    if (($data = json_decode($data, true)) !== null) {
        $keywords = $data[1];
    }
return $keywords;
}
function BingKeywordSuggestions($keyword) {
    $keywords = array();
	$curl_handle=curl_init();
	curl_setopt($curl_handle,CURLOPT_URL,'http://api.bing.com/osjson.aspx?query='.urlencode($keyword));
	curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,180);
	curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
	$data = curl_exec($curl_handle);
	curl_close($curl_handle);
    if (($data = json_decode($data, true)) !== null) {
        $keywords = $data[1];
    }

    return $keywords;
}
function get_rand_tags() {
global $wpdb;
$tag = $wpdb->get_var("SELECT $wpdb->terms.name
									FROM $wpdb->terms
									INNER JOIN $wpdb->term_taxonomy
									WHERE $wpdb->term_taxonomy.term_id=$wpdb->terms.term_id AND $wpdb->term_taxonomy.taxonomy = 'post_tag'
									ORDER BY RAND() LIMIT 1");

	return $tag;
}
function seowidget_content()
{
$options = get_option('seowidget_widget');
$seotag_engine=get_option('seotag_engine');
$seotag_count=get_option('seotag_count');
$seotag_theme=get_option('seotag_theme');
$seo_tags='';
$tag = get_rand_tags();
if($seotag_engine="google")//Check If engine is Google
{
if($seotag_count=="normal")
{
$suggests=GoogleKeywordSuggestions($tag);
}
else if($seotag_count=="high")
{
$suggests=GoogleKeywordSuggestions($tag);
		for($i=0;$i<count($suggests);$i++)
		{
		$google=GoogleKeywordSuggestions($suggests[$i]);
		$suggests =array_merge($suggests,$google);
		}
}
}
else if($seotag_engine="bing")//Check If engine is Bing
{

if($seotag_count=="normal")
{
$suggests=BingKeywordSuggestions($tag);
}
else if($seotag_count=="high")
{
$suggests=BingKeywordSuggestions($tag);
		for($i=0;$i<count($suggests);$i++)
		{
		$google=BingKeywordSuggestions($suggests[$i]);
		$suggests =array_merge($suggests,$google);
		}
}
}
else if($seotag_engine="both")//Check If engine is Bing
{
if($seotag_count=="normal")
{
$google=GoogleKeywordSuggestions($tag);
$bing=BingKeywordSuggestions($tag);
$suggests =array_merge($google,$bing);
}
else if($seotag_count=="high")
{
$google=GoogleKeywordSuggestions($tag);
$bing=BingKeywordSuggestions($tag);
$suggests =array_merge($google,$bing);
		for($i=0;$i<count($suggests);$i++)
		{
		$google=GoogleKeywordSuggestions($suggests[$i]);
		$bing=BingKeywordSuggestions($suggests[$i]);
		$suggests =array_merge($google,$bing);
		}
}

}
	if($seotag_theme=="defualt")
	{
	foreach($suggests as $tags)
	{
	$seo_tags .= '<a href="'.get_search_link($tags).'" title="'.$tags.' Tag"  rel="follow" class="seotags">'.$tags.'</a>&nbsp;&nbsp;';
	}
	}
	else if($seotag_theme=="3D")
	{
	$seo_tags .='<div id="myCanvasContainer">
 <canvas width="300" height="300" id="myCanvas">
  <p>Anything in here will be replaced on browsers that support the canvas element</p>
  <ul>';
	foreach($suggests as $tags)
	{
	$seo_tags .= '<li><a href="'.get_search_link($tags).'" title="'.$tags.' Tag"  rel="follow">'.$tags.'</a></li>';
	}
	$seo_tags .='</ul></canvas></div>
	 <script type="text/javascript">
(function($){
   $(\'#myCanvas\').tagcanvas({
   '.get_option('seotag_3D_option').'
  });
    })(jQuery);
 </script>';
	}

echo $seo_tags;
}
function widget_seowidget_init()
{
	function seowidget_widget($args)
	{
		extract($args);
		$options = get_option('seowidget_widget');
		$title = $options['title'];
		echo $before_widget;
		echo $before_title . $title . $after_title;
		seowidget_content();
		echo $after_widget;
	}
	function seowidget_widget_control()
	{
			$options = get_option('seowidget_widget');
		if ( !is_array($options) )
			$options = array('title'=>'');
		if ($_POST['seowidget_title_submit']) {
			$options['title'] = strip_tags(stripslashes($_POST['seowidget_title']));
			update_option('seowidget_widget', $options);
		}
		if ($_POST['seowidget_ctags_submit']) {
			$options['CountTags'] = strip_tags(stripslashes($_POST['seowidget_ctags']));
			update_option('seowidget_widget', $options);
		}
		$title = htmlspecialchars($options['title'], ENT_QUOTES);
		
		?>
		<p style="text-align:right; direction:rtl"><label for="seowidget_title"><?php _e("Title :","SeoTags");?><input style="width: 200px;" id="seowidget_title" name="seowidget_title" type="text" value="<?php echo $title; ?>" /></label></p>
		<input type="hidden" id="seowidget_title_submit" name="seowidget_title_submit" value="1" />

		<?php
		}
	wp_register_sidebar_widget(21021,__("Seo Tags Widget","SeoTags"),'seowidget_widget');
	wp_register_widget_control(21021,__("Seo Tags Widget","SeoTags"), 'seowidget_widget_control');		
}

function seotags_script()
{
$seotag_theme=get_option('seotag_theme');
	if($seotag_theme=="3D")
	{
	wp_enqueue_script('jquery');
	wp_enqueue_script('SEOTags-3D', plugins_url( 'lib/jquery.tagcanvas.min.js', __FILE__ ));
	}
}
add_action('admin_init', 'seowidget_init' );
add_action('init', 'seowidget_lang_init');
add_action('admin_menu', 'seotags_menu');
add_action('widgets_init', 'widget_seowidget_init');
add_action('admin_init', 'seowidget_lang_init');
add_action( 'wp_enqueue_scripts', 'seotags_script' );
register_activation_hook( __FILE__, 'seowidget_active' );
register_deactivation_hook( __FILE__, 'seowidget_deactivate' );

?>