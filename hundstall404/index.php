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
		$html_chunk = $this->_curl($this->base_url.$this->data_url);
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
	
	private function _curl($url = null, $ttl = 86400){ # TODO: fix ttl
		if($url){
			$tmp_file = $this->tmp_path.DIRECTORY_SEPARATOR.md5($url);
			if(file_exists($tmp_file)){
				return file_get_contents($tmp_file);
			}else{
				$ch = curl_init();
				$options = array(
					CURLOPT_URL => $url,
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_CONNECTTIMEOUT => 10,
					CURLOPT_TIMEOUT => 10
				);
				curl_setopt_array($ch, $options);
				$data = curl_exec($ch);
				$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
				curl_close($ch);
				if($http_code === 200){
					#file_put_contents($tmp_file, $data);
					return $data;
				}else{
					return $result;
				}
				return false;
			}
		}
	}
}
$hundstall404 = new Hundstall404;

add_filter('404_template', function(){
	return dirname(__FILE__).DIRECTORY_SEPARATOR.'render'.DIRECTORY_SEPARATOR.'index.php';
});