<?php
/*
Plugin Name: TEXT2SPEECH
Plugin URI: http://www.genweb.es
Description: TEXT2SPEECH
Version: 0.1
Author: Juanma Rodríguez
Author URI: http://www.genweb.es
*/

/*
Copyright (C) 2015 Juanma Rodríguez
Contact me at http://www.genweb.es

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see <http://www.gnu.org/licenses/>.
*/

//tell wordpress to register the demolistposts shortcode
add_shortcode("text2speech_shortcode", "text2speech_process_shortcode");

function text2speech_process_shortcode( $attributes, $content = null ) {
	extract( shortcode_atts( array(
		'class' => '',
		'lang' => '',
		'autoplay' => ''
	), $attributes ) );

	$file = md5($lang."?".urlencode($content));	
	
	$upload_dir = wp_upload_dir();
	$rutabase=$upload_dir['baseurl'];
	if ($autoplay==1) $autoplayPrint='autoplay="true"';
	$rutabasecheck=$upload_dir['basedir'];
	$filecheck = "$rutabasecheck/audio/" . $file . ".mp3";
	
	if (!file_exists($filecheck)) $sleepnow=1;
	
	genera_mp3($content,$lang);
	
	//sleeps 1 seconds only first time mp3 is generated
	if ($sleepnow==1) sleep(1);

	return '<audio '.$autoplayPrint.' id="id12" controls="controls" onended="func12();" src="'.$rutabase.'/audio/'.$file.'.mp3" class="pullquote '.$class.'">'.$content.'</audio>';	
}



function file_get_contents_curl($url) {
    $ch = curl_init();    
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Set curl to return the data instead of printing it to the browser.
    curl_setopt($ch, CURLOPT_URL, $url);    
    $data = curl_exec($ch);
    curl_close($ch);    
    return $data;
}



function genera_mp3($string,$lang){
	$text = $string;
	
    // Name of the MP3 file generated using the MD5 hash
    $file = md5($lang."?".urlencode($text));

	$upload_dir = wp_upload_dir();
	$rutabase=$upload_dir['basedir'];
	
    // Save the MP3 file
     $file = "$rutabase/audio/" . $file . ".mp3";

    // Verify if folder exists, if it doesn't, create it, if exists, verify CHMOD
    if (!is_dir("$rutabase/audio/"))
        mkdir("$rutabase/audio/");
    else
        if (substr(sprintf('%o', fileperms("$rutabase/audio/")), -4) != "0777")
            chmod("$rutabase/audio/", 0777);
	
	
    // If the MP3 file exists, do not create a new request
    if (!file_exists($file))
    {
        // Download the content
        $mp3 = file_get_contents_curl('http://translate.google.com/translate_tts?ie=UTF-8&q='. urlencode($text) .'&tl='. $lang .'&total=1&idx=0&textlen=5&prev=input');
		//echo "<hr>";
		//echo 'http://translate.google.com/translate_tts?ie=UTF-8&q='. urlencode($text) .'&tl='. $lang .'&total=1&idx=0&textlen=5&prev=input';
		//echo "<hr>";
		file_put_contents($file, $mp3);
    }
}
?>