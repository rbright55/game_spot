<?php
class DB
{
	protected $pdo;
	public function __construct()
	{
		
		$this->pdo = new PDO('mysql:host=localhost;port=3306;dbname=mis','root','root');
	}
	public function query($sql)
	{
		return $this->pdo->query($sql);
	}
	
}
