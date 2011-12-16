<?php
/**
 * @package Hundstall404
 * @version 1.0
 */
/*
Plugin Name: Hundstall404
Plugin URI: http://earthpeople.se/
Description: We love dogs. This plugin shows a random homeless dog on your 404. Why waste the space?
Author: Peder Fjällström
Version: 1.0
Author URI: http://earthpeople.se/
*/
class Hundstall404{
	
	var $base_url = 'http://www.hundstallet.se';
	var $data_url = '/index.php/varahundar/hundarforomplacering';
	var $tmp_path = 'tmp';
	var $dogs = array();
	var $limit = 1;

	function __construct(){
		$this->get_dogs();
	}

	private function get_dogs(){
		$html_chunk = $this->_curl($this->base_url.$this->data_url, 86400);
		if($rows = explode("\n", $html_chunk)){
			foreach($rows as $row){
				preg_match_all('|<h3><img src="(.*?)" border="0" />(.*?)</h3>(.*?)|', $row, $matches);
				if(!empty($matches[1]) && !empty($matches[2]) && !empty($matches[3])){
					$dog->image = $this->base_url.(string)$matches[1][0];
					$dog->name = (string)$matches[2][0];
					$this->dogs[] = $dog;
					unset($dog);
				}
			}
		}
		shuffle($this->dogs);
		$this->dogs = array_slice($this->dogs, 0, $this->limit);
	}
	
	private function _curl($url = null, $ttl = 600){
		if($url){
			$option_name = 'hundstall_cache_'.md5($url);
			$data = get_option($option_name);
			if(isset($data['cached_at']) && (time() - $data['cached_at'] <= $ttl)){
				#echo "serve cache";
			}else{
				#echo "get new";
				$ch = curl_init();
				$options = array(
					CURLOPT_URL => $url,
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_CONNECTTIMEOUT => 10,
					CURLOPT_TIMEOUT => 10
				);
				curl_setopt_array($ch, $options);
				$data['chunk'] = curl_exec($ch);
				$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
				curl_close($ch);
				if($http_code === 200){
					$data['cached_at'] = time();
					update_option($option_name, $data);
				}
			}
			return $data['chunk'];

		}
	}
	
}
$hundstall404 = new Hundstall404;

add_filter('404_template', function(){
	return dirname(__FILE__).DIRECTORY_SEPARATOR.'render'.DIRECTORY_SEPARATOR.'index.php';
});