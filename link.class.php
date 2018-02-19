<?php
	
	namespace Volkan\LinkShortener;

	class API
	{

		protected $api;
		protected $apiKey;
		protected $uid;
		protected $url;

		protected $apiLinks = [
			'bc.vc' => 'http://bc.vc/api.php?key={apiKey}&uid={uid}&url={url}',
			'link.tl' => 'http://link.tl/api.php?key=no-key&uid={uid}&adtype=int&url={url}'
		];

		public function __construct($uid, $api = 'bc.vc', $apiKey = null){
			$this->uid = $uid;
			$this->api = $api;
			$this->apiKey = $apiKey;
		}

		public function short($link){
			$this->url = $link;

			$l = preg_replace_callback('/\{(.*?)\}/', function ($match){
				return urlencode($this->{ $match[1] });
			}, $this->apiLinks[$this->api]);

			return $this->req($l);
		}

		public function req($link, $data = null){

	        $ch = curl_init();

	        curl_setopt_array($ch, [
		        CURLOPT_URL => $link,
		        CURLOPT_RETURNTRANSFER => 1,
		        CURLOPT_SSL_VERIFYPEER => 0,
		        CURLOPT_HEADER => 0
	        ]);

	        $e = curl_exec($ch);
	        curl_close($ch);

	        return $e;
		}


	}