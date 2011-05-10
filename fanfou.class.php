<?php
/**
 * Fanfou PHP library
 * Based on php-twitter http://code.google.com/p/php-twitter/
 * @author shawjia <shawjia@gmail.com>
 * @version 0.1
 * @package php-fanfou
 */

class Fanfou
{
	var $_source;
	var $_user;
	var $_pass;
	var $responseInfo;

	function __construct($user, $pass, $source=NULL)
	{
		$this->_source = $source;
		$this->_user   = $user;
		$this->_pass   = $pass;
	}

	/**
	 * get method
	 */

	function verify()
	{
		$url = 'http://api.fanfou.com/account/verify_credentials.json';
		return $this->_request($url);
	}

	function getHome($count = NULL, $page = NULL, $since_id = NULL, $max_id = NULL, $format = 'html')
	{
		$args = array();
		if ($count) {
			$args['count'] = $count;
		}
		if ($page) {
			$args['page'] = $page;
		}
		if ($since_id) {
			$args['since_id'] = $since_id;
		}
		if ($max_id) {
			$args['max_id'] = $max_id;
		}
		if ($format) {
			$args['format'] = $format;
		}

		$qs = '';
		if (!empty($args)) {
			$qs = $this->_glue($args);
		}

		$url = 'http://api.fanfou.com/statuses/friends_timeline.json' . $qs;
		return $this->_request($url);
	}

	function getMentions($count = NULL, $page = NULL, $since_id = NULL, $max_id = NULL, $format = 'html')
	{
		$args = array();
		if ($count) {
			$args['count'] = $count;
		}
		if ($page) {
			$args['page'] = $page;
		}
		if ($since_id) {
			$args['since_id'] = $since_id;
		}
		if ($max_id) {
			$args['max_id'] = $max_id;
		}
		if ($format) {
			$args['format'] = $format;
		}

		$qs = '';
		if (!empty($args)) {
			$qs = $this->_glue($args);
		}

		$url = 'http://api.fanfou.com/statuses/mentions.json' . $qs;
		return $this->_request($url);
	}

	function getInDMs($count = NULL, $page = NULL, $since_id = NULL, $max_id = NULL)
	{
		$args = array();
		if ($count) {
			$args['count'] = $count;
		}
		if ($page) {
			$args['page'] = $page;
		}
		if ($since_id) {
			$args['since_id'] = $since_id;
		}
		if ($max_id) {
			$args['max_id'] = $max_id;
		}

		$qs = '';
		if (!empty($args)) {
			$qs = $this->_glue($args);
		}

		$url = 'http://api.fanfou.com/direct_messages.json' . $qs;
		return $this->_request($url);
	}

	function getOutDMs($count = NULL, $page = NULL, $since_id = NULL, $max_id = NULL)
	{
		$args = array();
		if ($count) {
			$args['count'] = $count;
		}
		if ($page) {
			$args['page'] = $page;
		}
		if ($since_id) {
			$args['since_id'] = $since_id;
		}
		if ($max_id) {
			$args['max_id'] = $max_id;
		}
		if ($format) {
			$args['format'] = $format;
		}

		$qs = '';
		if (!empty($args)) {
			$qs = $this->_glue($args);
		}

		$url = 'http://api.fanfou.com/direct_messages/sent.json' . $qs;
		return $this->_request($url);
	}

	function getUserInfo($id=NULL)
	{
		$args = array();
		if ($id) {
			$args['id'] = $id;
		}
		$qs = '';
		if (!empty($args)) {
			$qs = $this->_glue($args);
		}

		$url = 'http://api.fanfou.com/users/show.json' . $qs;
		return $this->_request($url);
	}

	function getUserTimeline($id = NULL, $count = NULL, $page = NULL, $since_id = NULL, $max_id = NULL, $format = 'html')
	{
		$args = array();
		if ($id) {          // the user_id
			$args['id'] = $id;
		}
		if ($count) {
			$args['count'] = $count;
		}
		if ($page) {
			$args['page'] = $page;
		}
		if ($since_id) {
			$args['since_id'] = $since_id;
		}
		if ($max_id) {
			$args['max_id'] = $max_id;
		}
		if ($format) {
			$args['format'] = $format;
		}

		$qs = '';
		if (!empty($args)) {
			$qs = $this->_glue($args);
		}

		$url = 'http://api.fanfou.com/statuses/user_timeline.json' . $qs;
		return $this->_request($url);
	}

	function getStatus($status_id, $format='html')
	{
		$url = 'http://api.fanfou.com/statuses/show.json?id=' . $status_id;
		if ($format) {
			$url .= '&format=html';
		}
		return $this->_request($url);
	}


	/**
	 * post method
	 */

	function update($status, $in_reply_to_status_id=NULL, $repost_status_id=NULL, $location=NULL)
	{
		$postargs = array('status' => ' ' . $status);

		if ($in_reply_to_status_id) {
			$postargs['in_reply_to_status_id'] = $in_reply_to_status_id;
		}
		if ($location) {
			$postargs['location'] = $location;
		}
		if ($repost_status_id) {
			$postargs['repost_status_id'] = $repost_status_id;
		}

		$url = 'http://api.fanfou.com/statuses/update.json?format=html';

		return $this->_request($url, $postargs);
	}

	function delete($status_id)
	{
		$postargs = array('id' => $status_id);
		$url = 'http://api.fanfou.com/statuses/destroy.json';
		return $this->_request($url, $postargs);
	}

	function fav($status_id)
	{
		$url = 'http://api.fanfou.com/favorites/create/id.json';
		$postargs = array('id' => $status_id);
		return $this->_request($url, $postargs);
	}

	function unfav($status_id)
	{
		$url = 'http://api.fanfou.com/favorites/destroy/id.json';
		$postargs = array('id' => $status_id);
		return $this->_request($url, $postargs);
	}

	function sentDM($user, $text, $in_reply_to_id=NULL)
	{
		$url = 'http://api.fanfou.com/direct_messages/new.json';

		$postargs = array('user' => $user, 'text' => $text);

		if ($in_reply_to_id) {
			$postargs['in_reply_to_id'] = $in_reply_to_id;
		}

		$url = 'http://api.fanfou.com/direct_messages/new.json';

		return $this->_request($url, $postargs);
		
	}

	function deleteDM($dm_id)
	{
		$url = 'http://api.fanfou.com/direct_messages/destroy/id.json';
		$postargs = array('id' => $dm_id);
		return $this->_request($url, $postargs);
	}

	function _request($url, $postargs=FALSE)
	{
		$ch = curl_init($url);

		if ($postargs)
		{
			$postargs['source'] = $this->_source;
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postargs);
		}

		curl_setopt($ch, CURLOPT_USERPWD, $this->_user . ':' . $this->_pass);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$result = curl_exec($ch);

		$this->responseInfo = curl_getinfo($ch);

		curl_close($ch);

		if (intval($this->responseInfo['http_code']) == 200)
		{
			return json_decode($result, TRUE);
		}
		else
		{
			return FALSE;
		}
	}

	function _glue($array)
	{
		$query_string = '';
		foreach ($array as $k => $v) {
			$query_string .= $k . '=' . rawurlencode($v) . '&';
		}

		return '?' . substr($query_string, 0, strlen($query_string) - 1);
	}
}
