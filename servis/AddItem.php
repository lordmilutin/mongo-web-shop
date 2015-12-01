<?php 
	/**
	* dodaje novi item u bazu
	*/
	class AddItem extends AServis
	{
		/**
		* PARAMETRI METODE AddItem
		* string $item["naziv"] 
		* string $item["naziv"] 
		* int $item["cena"]
		* array $item["sastojci"]
		* string $item["slika"] 
		*/
		private $id;
		private $item = array();

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
			$this->item["naziv"] 		= $_POST["naziv"];
			$this->item["kategorija"] = $_POST["kategorija"];
			$this->item["cena"] 		= $_POST["cena"];
			$this->item["sastojci"] = array();

			for($i=1; $i < 6; $i++){
				if( $_POST["sastojak$i"] != "") 
					array_push($this->item , $_POST["sastojak$i"]);
			}
			$this->item["slika"] 		= $_POST["slika"];
			$this->item["porcija"]	= $_POST["porcija"];		
		}

		/**
		* izvresnje funkcije servisa
		*/
		public function akcija() 
		{
			$this->db->hrana->insert( $this->item );
		}
	}
?>