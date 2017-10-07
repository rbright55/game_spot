<?php
class GoogleAuth
{
	protected $db;
	protected $client;

	public function __construct(DB $db = null, Google_Client $googleClient = null)
	{
		$this->db = $db;
		$this->client = $googleClient;

		if($this->client)
		{
			$this->client->setClientId('client_id');
			$this->client->setClientSecret('client_secret');
			$this->client->setRedirectUri('home_page_link');
			$this->client->setScopes('email');
		}
	}
	public function isLoggedIn()
	{
		return isset($_SESSION['access_token']);
	}
	public function getAuthUrl()
	{
		return $this->client->createAuthUrl();
	}
	public function checkRedirectCode()
	{
		if(isset($_GET['code'])){
			$this->client->authenticate($_GET['code']);

			$this->setToken($this->client->getAccessToken());

			$this->storeUser($this->getPayload());

			return true;
		}
		return false;
	}
	public function setToken($token)
	{
		$_SESSION['access_token'] = $token;
		$this->client->setAccessToken($token);
	}
	public function logout()
	{
		unset($_SESSION['access_token']);
	}
	public function userinfo()
	{
		if($this->client->getAccessToken()){
			$user = $this->userinfo->get();
		}
	}
	public function getPayload()
	{
		$payload = $this->client->verifyIdToken()->getAttributes()['payload'];
		return $payload;
	}
	public function storeUser($payload)
	{
		$_SESSION['google_id']=$payload['sub'];
		$username = explode('@',$payload['email'])[0];
		$sql= "INSERT INTO `google_users` (`user_id`, `google_id`, `email`, `username`) VALUES (NULL, '{$payload['sub']}','{$payload['email']}','{$username}')";
		$this->db->query($sql);
	}
}
