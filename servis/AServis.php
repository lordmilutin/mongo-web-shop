<?php
	/**
	* Sve ostale klase servisa nasleduju ovu
	*/
	abstract class AServis 
	{
		/**
		* konekcija za bazu
		*/
		protected $db;

		/**
		* Default vrednosti za limitiranje query-ja (paginacija).
		*/
		protected $limit = 9;
		protected $strana = 0;

		/**
		* Instancira konekciju ka bazi
		*/
		function __construct()
		{
			$mongo = new MongoClient();
		    $this->db = $mongo->bazepicerija;
		}

		/**
		* Metoda za parsovanje argumenata iz zahteva
		*/
		public function parsujArgumente()
		{
			if (isset($_REQUEST["limit"])) 
				$this->limit = $_REQUEST["limit"];
			if (isset($_REQUEST["strana"])) 
				$this->strana = $_REQUEST["strana"];
		}

		/**
		* Konkretna metoda servisa koju mora implementirati svaka izvedena klasa
		*/
		abstract public function akcija();
	}
?>