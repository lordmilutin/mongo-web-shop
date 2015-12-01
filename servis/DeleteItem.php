<?php 
	/**
	* brise navedene iteme iz baze
	*/
	class DeleteItem extends AServis
	{
		/**
		* PARAMETRI METODE DeleteItem
		* string $id - Id-evi dokumenata, odvojeni zarezom
		*/
		private $id;

		public function __construct() 
		{
			parent::__construct();
			$this->parsujArgumente();
		}

		/**
		* izvlacenje argumenata iz zahteva
		*/
		public function parsujArgumente() 
		{
			//uzmi limit ukoliko je naveden
			parent::parsujArgumente();

			//uzmi dodatne parametre ukoliko su navedeni
			if (isset($_GET["id"]))
			{
				$k = $_GET["id"];
				$ids = explode(",", $k);
				$this->id = array();

				foreach ($ids as $sid) {
					array_push($this->id, new MongoID($sid));
				}
			}
		}

		/**
		* izvresnje funkcije servisa
		*/
		public function akcija() 
		{

			if (count($this->id) == 0)
				return;

			//sami rezultati
			$cursor = $this->db->hrana->remove(array("_id" => array( '$in' => $this->id)));

			$res = array();
			foreach ($cursor as $doc) {
			    array_push($res, $doc);
			}

			/*$res = iterator_to_array($cursor);*/
			//array_push($res, $totalNr);
			echo json_encode($res);
		}
	}
?>