<?php

class Order
{
	private $event_id;
	private $event_date;
	private $equal_price;
	private $ticket_adult_price;
	private $ticket_adult_quantity;
	private $barcode;
	private $ticket_kid_price;
	private $ticket_kid_quantity;
	private $created;
	public function __construct($Event_id,$Event_date,$Ticket_adult_price,$Ticket_adult_quantity,$Ticket_kid_price,$Ticket_kid_quantity)
	{
		$this->event_id=$Event_id;
		$this->event_date=$Event_date;
		$this->ticket_adult_price=$Ticket_adult_price;
		$this->ticket_adult_quantity=$Ticket_adult_quantity;
		$this->ticket_kid_price=$Ticket_kid_price;
		$this->ticket_kid_quantity=$Ticket_kid_quantity;
	}
	private function generateBarcode()
	{
		$ret=0;
		
		for($i=1;$i<=8;$i++)
		{
			$ret=($ret*10)+rand(1,9);
		}
		return $ret;
	}
	private function bookOrder()
	{
		RETURN;//mock
	}
	private function confirmOrder()
	{
		RETURN; //mock
	}
	private function getEqualPrice()
	{
		$result=($this->ticket_kid_quantity*$this->ticket_kid_price)+($this->ticket_adult_quantity*$this->ticket_adult_price);
		return $result;
	}
	private function getCreatedData()
	{
		return date_create()->format('Y-m-d');
	}
	private function saveInDatabase()  
	{
		$data=[
		'event_id'=>$this->event_id,
		'ticket_adult_price'=>$this->ticket_adult_price,
		'ticket_adult_quantity'=>$this->ticket_adult_quantity,
		'ticket_kid_price'=>$this->ticket_kid_price,
		'ticket_kid_quantity'=>$this->ticket_kid_quantity,
		'barcode'=>$this->barcode,
		'equal_price'=>$this->equal_price,
		'created'=>$this->created,
		'event_date'=>$this->event_date
		];
		
		try
		{
			$conn=new PDO("mysql:host=localhost;dbname=myDB","user","password");
			$result=$conn->prepare("INSERT INTO `orders` (event_id,ticket_adult_price,ticket_adult_quantity,ticket_kid_price,ticket_kid_quantity,barcode,equal_price,created,event_date)VALUES (:event_id,:ticket_adult_price,:ticket_adult_quantity,:ticket_kid_price,:ticket_kid_quantity,:barcode,:equal_price,:created,:event_date)");
			$result->execute($data);
		}
		catch(PDOException $e)
		{
			throw new Exception($e);
		}
		
	}
	function addTicketsToDB()
	{
		$this->equal_price=getEqualPrice();
		$this->current_date=getCreatedData();
		
		$this->event_date=date_create($this->event_date)->format('Y-m-d');
		
		to:$this->barcode=generateBarcode();
		
		$resultOrder=bookOrder();
		if($resultOrder['error']=='barcode already exists')
			goto to;
		$resultConfirm=confirmOrder();
		if($resultConfirm['message']=='order sucessfukky approved')
			saveInDatabase();
	}


}
$order=new Order(123,date_create("2011-10-10")->format('Y-m-d'),50,11,12,12);

?>