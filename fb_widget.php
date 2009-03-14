<?php
/*
Plugin Name: Random FishBase
Plugin URI: http://projects.darkcutter.com/prettybase
Description: Links to random FishBase entry
Author: Paul Yoon
Version: 0.5
Author URI: http://bla.darkcutter.com
*/

function randomfb()
{
$fishtxt = 'http://fb.darkcutter.com/randomfishbase.txt';
$ch = curl_init();
$timeout = 5; // set to zero for no timeout
curl_setopt ($ch, CURLOPT_URL, $fishtxt);
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

ob_start();
curl_exec($ch);
curl_close($ch);
$fishtxt_contents = ob_get_contents();
ob_end_clean();

$fisharr = explode("\n", $fishtxt_contents);
$fbid = $fisharr[3];
$sciname = $fisharr[4];

echo "\n\n<!-- Daily FishBase | ".$fisharr[0]." | ".$fisharr[1]." -->\n<ul>\n	<li><a href=\"http://www.fishbase.us/Summary/SpeciesSummary.php?id=".$fbid."\">".$sciname."</a></li>\n</ul>\n\n";

}

function widget_myrandomfb($args) {
  extract($args);
  echo $before_widget;
  echo $before_title;?>Daily FishBase<?php echo $after_title;
  randomfb();
  echo $after_widget;
}

function myfishbase_init()
{
  register_sidebar_widget(__('FishBase'), 'widget_myrandomfb');
}
add_action("plugins_loaded", "myfishbase_init");

?>