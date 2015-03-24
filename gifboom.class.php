<?php
/*
	GifBoom PHP Class
	Written by http://github.com/Pilfer
	Twitter: @CodesStuff
*/

class GifBoom{
	
	//static info for emulating the client
	public $api_url = "http://api.gifboom.com/v1";
	public $client_version = "2.0.2.3530";
	public $useragent = "GifBoom (Android)";

	public $proxy;

	//stuff we need - the bare minimums
	public $id;
	public $authentication_token;
	public $device_id;
	
	//useless stuff, but we're saving it regardless
	public $gender;
	public $is_admin;
	public $is_official;
	public $items_count;
	public $location;
	public $username;
	public $website;
	public $avatar;
	public $public_pm;
	public $can_message;
	public $bio;
	public $is_followed_by_me;
	public $is_following_me;
	public $followings_count;
	public $followers_count;
	public $relationship;
	public $age;
	
	//constructor
	public function __construct($proxy=''){
		if(isset($proxy)){
			$this->proxy = $proxy;
		}
		$this->device_id = "9774d56d682e549c";//$device_id;
	}
	
	public function create_account($params){
		$mypath = getcwd();
		$mypath = preg_replace('/\\\\/', '/', $mypath); 
		
		$headers = array(
			'Accept: application/json',
			'X-DEVICE-ID: ' . $this->device_id,
			'X-CLIENT-VERSION: ' . $this->client_version,
			'Accept-Language: '. 'en'
		);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->api_url . "/users/");
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
		curl_setopt($ch, CURLOPT_USERAGENT, $this->useragent);

		curl_setopt($ch, CURLOPT_INTERFACE, "198.136.30.188");
		
		if(isset($this->proxy)){
			//curl_setopt($ch, CURLOPT_PROXY, $this->proxy);
		}
		
		if(!empty($params)){
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
		}
		$result = curl_exec($ch);
		curl_close($ch);
		
		echo "<textarea>" .$result . "</textarea>";
		if(!empty($result)){
			$json = json_decode($result);
			if(isset($json->message)){
				return false;
			}else{
				//set the vars
				$this->id = $json->_id;
				$this->authentication_token = $json->authentication_token;
				
				//useless stuff, but we're saving it regardless
				$this->gender = $json->gender;
				$this->is_admin = $json->is_admin;
				$this->is_official = $json->is_official;
				$this->items_count = $json->items_count;
				$this->location = $json->location;
				$this->username = $json->username;
				$this->website = $json->website;
				$this->avatar = $json->avatar;
				$this->public_pm = $json->public_pm;
				$this->can_message = $json->can_message;
				$this->bio = $json->bio;
				$this->is_followed_by_me = $json->is_followed_by_me;
				$this->is_following_me = $json->is_following_me;
				$this->followings_count = $json->followings_count;
				$this->followers_count = $json->followers_count;
				$this->relationship = $json->relationship;
				$this->age = $json->age;
				return true;
			}
		}else{
			return false;
		}
	}
	
	public function login($params){
		$mypath = getcwd();
		$mypath = preg_replace('/\\\\/', '/', $mypath); 
		
		$headers = array(
			'Accept: application/json',
			'X-DEVICE-ID: ' . $this->device_id,
			'X-CLIENT-VERSION: ' . $this->client_version,
			'Accept-Language: '. 'en'
		);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->api_url . "/login");
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_COOKIEJAR,"$mypath/cookies.txt");
		curl_setopt($ch, CURLOPT_COOKIEFILE,"$mypath/cookies.txt");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
		curl_setopt($ch, CURLOPT_USERAGENT, $this->useragent);

		curl_setopt($ch, CURLOPT_INTERFACE, "198.136.30.188");
		
		if(isset($this->proxy)){
			//curl_setopt($ch, CURLOPT_PROXY, $this->proxy);
		}
		
		if(!empty($params)){
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
		}
		$result = curl_exec($ch);
		curl_close($ch);

		if(!empty($result)){
			$json = json_decode($result);
			if(isset($json->message)){
				echo $json->message;
				return false;
			}else{
				//set the vars we'll need
				$this->id = $json->_id;
				$this->authentication_token = $json->authentication_token;
				
				//useless stuff, but we're saving it regardless
				$this->gender = $json->gender;
				$this->is_admin = $json->is_admin;
				$this->is_official = $json->is_official;
				$this->items_count = $json->items_count;
				$this->location = $json->location;
				$this->username = $json->username;
				$this->website = $json->website;
				$this->avatar = $json->avatar;
				$this->public_pm = $json->public_pm;
				$this->can_message = $json->can_message;
				$this->bio = $json->bio;
				$this->is_followed_by_me = $json->is_followed_by_me;
				$this->is_following_me = $json->is_following_me;
				$this->followings_count = $json->followings_count;
				$this->followers_count = $json->followers_count;
				$this->relationship = $json->relationship;
				$this->age = $json->age;
				return true;
			}
		}else{
			return false;
		}
	}
	
	public function follow($target){
		$mypath = getcwd();
		$mypath = preg_replace('/\\\\/', '/', $mypath);
		$headz = array(
			'Accept: application/json',
			'Accept-Language: en',	
			'Content-Type: application/x-www-form-urlencoded',
			'Host: api.gifboom.com',
			'Connection: Keep-Alive',
			'X-USER-AUTHENTICATION-TOKEN: '. $this->authentication_token,
			'X-CLIENT-VERSION: '. $this->client_version,
			'X-DEVICE-ID: ' .  $this->device_id,
			'User-Agent: ' . $this->useragent,
			'Content-Length: 0'
		);		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->api_url . "/users/".$target."/follow");	
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headz);
		
		curl_setopt($ch, CURLOPT_INTERFACE, "198.136.30.188");
		
		if(isset($this->proxy)){
			//curl_setopt($ch, CURLOPT_PROXY, $this->proxy);
		}		
		
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,"");
		curl_setopt($ch, CURLINFO_HEADER_OUT, true);
		$result = curl_exec($ch);
		curl_close($ch);	
		if(!empty($result)){
			$json = json_decode($result);
			if(isset($json->message)){
				echo $json->message;
				return false;
			}else{
				if($json->is_followed_by_me == true){
					return true;
				}else{
					return false;
				}
			}
		}else{
			return false;
		}
	}
 
	public function comment($target,$text){
		$mypath = getcwd();
		$mypath = preg_replace('/\\\\/', '/', $mypath);
		
		$post_data = array("comment_body" => $text);
		
		$headz = array(
			'Accept: application/json',
			'Accept-Language: en',	
			'Content-Type: application/x-www-form-urlencoded',
			'Host: api.gifboom.com',
			'Connection: Keep-Alive',
			'X-USER-AUTHENTICATION-TOKEN: '. $this->authentication_token,
			'X-CLIENT-VERSION: '. $this->client_version,
			'X-DEVICE-ID: ' .  $this->device_id,
			'User-Agent: ' . $this->useragent,
			'Content-Length: 0'
		);		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->api_url . "/items/".$target."/comments");	
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headz);
		
		curl_setopt($ch, CURLOPT_INTERFACE, "198.136.30.188");
		
		if(isset($this->proxy)){
			//curl_setopt($ch, CURLOPT_PROXY, $this->proxy);
		}		
		
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$post_data);
		curl_setopt($ch, CURLINFO_HEADER_OUT, true);
		$result = curl_exec($ch);
		curl_close($ch);	
		if(!empty($result)){
			$json = json_decode($result);
			if(isset($json->message)){
				echo $json->message;
				return false;
			}else{
				if($json->is_followed_by_me == true){
					return true;
				}else{
					return false;
				}
			}
		}else{
			return false;
		}
	}	
	
	//I still have to debug this function a little - don't use it
	public function like($postid){
		$mypath = getcwd();
		$mypath = preg_replace('/\\\\/', '/', $mypath);
		$headz = array(
			'Accept: application/json',
			'Accept-Language: en',	
			'Content-Type: application/x-www-form-urlencoded',
			'Host: api.gifboom.com',
			'Connection: Keep-Alive',
			'X-USER-AUTHENTICATION-TOKEN: '. $this->authentication_token,
			'X-CLIENT-VERSION: '. $this->client_version,
			'X-DEVICE-ID: ' .  $this->device_id,
			'User-Agent: ' . $this->useragent,
			'Content-Length: 0'
		);		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->api_url . "/items/".$postid."/likes");	
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headz);
		
		curl_setopt($ch, CURLOPT_INTERFACE, "198.136.30.188");
		
		if(isset($this->proxy)){
			//curl_setopt($ch, CURLOPT_PROXY, $this->proxy);
		}		
		
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,"");
		curl_setopt($ch, CURLINFO_HEADER_OUT, true);
		$result = curl_exec($ch);
		curl_close($ch);	
		if(!empty($result)){
			echo "<textarea>".$result."</textarea>";
			return true;
			/*
			$json = json_decode($result);
			if(isset($json->message)){
				echo $json->message;
				return false;
			}else{
				if($json->is_followed_by_me == true){
					return true;
				}else{
					return false;
				}
			}
			*/
		}else{
			return false;
		}
	}
	
	public function unfollow($target){
		$mypath = getcwd();
		$mypath = preg_replace('/\\\\/', '/', $mypath);
		$headz = array(
			'Accept: application/json',
			'Accept-Language: en',	
			'Content-Type: application/x-www-form-urlencoded',
			'Host: api.gifboom.com',
			'Connection: Keep-Alive',
			'X-USER-AUTHENTICATION-TOKEN: '. $this->authentication_token,
			'X-CLIENT-VERSION: '. $this->client_version,
			'X-DEVICE-ID: ' .  $this->device_id,
			'User-Agent: ' . $this->useragent,
			'Content-Length: 0'
		);		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->api_url . "/users/".$target."/unfollow");	
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headz);
		
		curl_setopt($ch, CURLOPT_INTERFACE, "198.136.30.188");
		if(isset($this->proxy)){
			//curl_setopt($ch, CURLOPT_PROXY, $this->proxy);
		}		
		
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,"");
		curl_setopt($ch, CURLINFO_HEADER_OUT, true);
		$result = curl_exec($ch);		
		curl_close($ch);	
		if(!empty($result)){
			$json = json_decode($result);
			if(isset($json->message)){
				echo $json->message;
				return false;
			}else{
				if($json->is_followed_by_me == false){
					return true;
				}else{
					return false;
				}
			}
		}else{
			return false;
		}
	}
	
	public function change_profile_pic($img){
		
		$mypath = getcwd();
		$file_path = str_replace("\\","\\\\",$mypath);
		$mypath = preg_replace('/\\\\/', '/', $mypath);
		$post_data = array("user[avatar]" => "@" . $mypath . "\\\\".$img);
		
		$headz = array(
			'Accept: application/json',
			'Accept-Language: en',	
			'Host: api.gifboom.com',
			'Connection: Keep-Alive',
			'X-USER-AUTHENTICATION-TOKEN: '. $this->authentication_token,
			'X-CLIENT-VERSION: '. $this->client_version,
			'X-DEVICE-ID: ' .  $this->device_id,
			'User-Agent: ' . $this->useragent
		);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->api_url . "/users/".$this->id);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headz);

		curl_setopt($ch, CURLOPT_INTERFACE, "198.136.30.188");
		if(isset($this->proxy)){
			//curl_setopt($ch, CURLOPT_PROXY, $this->proxy);
		}		
		
		//for PUT
		curl_setopt($ch, CURLOPT_POSTFIELDS,$post_data);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
		
		$result = curl_exec($ch);		
		curl_close($ch);
		if(!empty($result)){
			$json = json_decode($result);
			if($json){
				if($json->avatar != $this->avatar){
					$this->avatar = $json->avatar;
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	
	public function edit_profile($params){
		$mypath = getcwd();
		$file_path = str_replace("\\","\\\\",$mypath);
		$mypath = preg_replace('/\\\\/', '/', $mypath);
		
		$headz = array(
			'Accept: application/json',
			'Accept-Language: en',	
			'Host: api.gifboom.com',
			'Connection: Keep-Alive',
			'X-USER-AUTHENTICATION-TOKEN: '. $this->authentication_token,
			'X-CLIENT-VERSION: '. $this->client_version,
			'X-DEVICE-ID: ' .  $this->device_id,
			'User-Agent: ' . $this->useragent
		);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->api_url . "/users/".$this->id);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headz);

		curl_setopt($ch, CURLOPT_INTERFACE, "198.136.30.188");
		if(isset($this->proxy)){
			//curl_setopt($ch, CURLOPT_PROXY, $this->proxy);
		}
		
		//for PUT
		curl_setopt($ch, CURLOPT_POSTFIELDS,$params);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
		
		$result = curl_exec($ch);		
		curl_close($ch);
		if(!empty($result)){
			$json = json_decode($result);
			if(isset($json->message)){
				echo $json->message;
				return false;
			}else{
				//set the vars we'll need
				$this->id = $json->_id;
			
				//useless stuff, but we're saving it regardless
				$this->gender = $json->gender;
				$this->is_official = $json->is_official;
				$this->items_count = $json->items_count;
				$this->location = $json->location;
				$this->username = $json->username;
				$this->website = $json->website;
				$this->avatar = $json->avatar;
				$this->public_pm = $json->public_pm;
				$this->can_message = $json->can_message;
				$this->bio = $json->bio;
				$this->is_followed_by_me = $json->is_followed_by_me;
				$this->is_following_me = $json->is_following_me;
				$this->followings_count = $json->followings_count;
				$this->followers_count = $json->followers_count;
				$this->relationship = $json->relationship;
				$this->age = $json->age;
				return true;
			}
		}else{
			return false;
		}
	}
	
	//Returns the JSON for the popular page. There was an encoding issue cuz unicode, but utf8_encode() fixed that.
	function get_popular(){
		$mypath = getcwd();
		$mypath = preg_replace('/\\\\/', '/', $mypath);
		$headz = array(
			'Accept: application/json',
			'Accept-Language: en',	
			'Host: api.gifboom.com',
			'Connection: Keep-Alive',
			'X-USER-AUTHENTICATION-TOKEN: '. $this->authentication_token,
			'X-CLIENT-VERSION: '. $this->client_version,
			'X-DEVICE-ID: ' .  $this->device_id,
			'User-Agent: ' . $this->useragent,
			'Content-Length: 0'
		);		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->api_url . "/feed/popular");	
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headz);

		curl_setopt($ch, CURLOPT_INTERFACE, "198.136.30.188");
		if(isset($this->proxy)){
			//curl_setopt($ch, CURLOPT_PROXY, $this->proxy);
		}		
		
		$result = curl_exec($ch);
		curl_close($ch);
		
		if(!empty($result)){
			$json = json_decode(utf8_encode($result));
			if($json){
				return $json;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	public function get_item($itemid){
		$mypath = getcwd();
		$mypath = preg_replace('/\\\\/', '/', $mypath);
		$headz = array(
			'Accept: application/json',
			'Accept-Language: en',	
			'Host: api.gifboom.com',
			'Connection: Keep-Alive',
			'X-USER-AUTHENTICATION-TOKEN: '. $this->authentication_token,
			'X-CLIENT-VERSION: '. $this->client_version,
			'X-DEVICE-ID: ' .  $this->device_id,
			'User-Agent: ' . $this->useragent,
			'Content-Length: 0'
		);		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->api_url . "/items/".$itemid);	
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headz);
		curl_setopt($ch, CURLOPT_INTERFACE, "198.136.30.188");
		
		if(isset($this->proxy)){
			//curl_setopt($ch, CURLOPT_PROXY, $this->proxy);
		}		
		
		$result = curl_exec($ch);
		curl_close($ch);

		if(!empty($result)){
			$json = json_decode(utf8_encode($result));
			if($json){
				return $json;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	
	public function get_followers_from_user($target,$page=1){
		$mypath = getcwd();
		$mypath = preg_replace('/\\\\/', '/', $mypath);
		$headz = array(
			'Accept: application/json',
			'Accept-Language: en',	
			'Host: api.gifboom.com',
			'Connection: Keep-Alive',
			'X-USER-AUTHENTICATION-TOKEN: '. $this->authentication_token,
			'X-CLIENT-VERSION: '. $this->client_version,
			'X-DEVICE-ID: ' .  $this->device_id,
			'User-Agent: ' . $this->useragent,
			'Content-Length: 0'
		);		
		$ch = curl_init();
		if($page == 1){
			curl_setopt($ch, CURLOPT_URL, $this->api_url . "/users/".$target."/followers?page=1");
		}else{
			curl_setopt($ch, CURLOPT_URL, $this->api_url . "/users/".$target."/followers?page=".$page);
		}
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headz);
		
		curl_setopt($ch, CURLOPT_INTERFACE, "198.136.30.188");
		
		if(isset($this->proxy)){
			//curl_setopt($ch, CURLOPT_PROXY, $this->proxy);
		}		
		
		$result = curl_exec($ch);
		curl_close($ch);

		if(!empty($result)){
			$json = json_decode(utf8_encode($result));
			if($json){
				return $json;
			}else{
				return false;
			}
		}else{
			return false;
		}	
	}
}
?>
