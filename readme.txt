=== Plugin Name ===
Contributors: genweb
Donate link: http://www.genweb.es
Tags: text2speech, voice, audio, text to audio, Google translate, Google voice, speech, text to speech
Requires at least: 4.0.1
Tested up to: 4.1.1
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Text 2 Speech shortcode plugin allows you to automatically transform any text to a HTML5 mp3 player where Google voice will read it

== Description ==

Text 2 Speech shortcode plugin allows you to automatically transform any text between shortcodes to a HTML5 mp3 player where Google voice will read your text.

Text 2 Speech supports multiple languages, autoplay and it also downloads every mp3 file to your wp-content folder, so you will reduce translation requests.




* Plugin just calls Google services once for each sentence, downloading the mp3 to a "audio" folder in wp-content/ uploads / for future calls.
* The shortcode support multiple languages using a parameter "lang".
* The shortcode accepts autoplay using the "autoplay" parameter.
* To show the player, <audio> HTML5 label is used. It requires a browser with support for this label.
* The service  does not support long texts, the plugin will work well for texts under 100 characters.
* Plugin requires the PHP cURL library installed on your server to work properly.

Usage example:

[text2speech_shortcode lang=”en”]This is the most amazing plugin in the world[/text2speech_shortcode]

[text2speech_shortcode lang=”es” autoplay="1"]Este plugin es la caña de España[/text2speech_shortcode]

Demo and support (Spanish and English):
http://www.genweb.es/plugin-text-2-speech-para-wordpress/

== Installation ==

1. Download & Activate the plugin through the 'Plugins' menu in WordPress
2. Use shortcode anywhere in your site:

Shortcode examples:

[text2speech_shortcode lang=”en”]This is the most amazing plugin in the world[/text2speech_shortcode]

[text2speech_shortcode lang=”es” autoplay="1"]Este plugin es la caña de España[/text2speech_shortcode]


== Frequently Asked Questions ==

= Will this plugin make my site slower? =

No, mp3 files generated are usually below 20kb each. Google translation requests are just done one time per sentence.


== Changelog ==

= 0.1 =
* First stable version.
* Used cURL as a better way of downloading mp3 files.

= 0.09 =
* BETA version.