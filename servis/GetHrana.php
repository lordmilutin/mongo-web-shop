<?php 
	/**
	* vraca postojece proizvode iz shopa
	*/
	class GetHrana extends AServis
	{
		/**
		* PARAMETRI METODE GetHrana
		* string $kategorija - iz koje kategorije prikazati proizvode
		* string $pretraga - termin za pretragu
		*/
		private $kategorija;
		private $pretraga;

		public function __construct() 
		{
			parent::__construct();

			$this->kategorija = new MongoRegex("//");
			$this->pretraga = new MongoRegex("//");
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
			if (isset($_GET["kat"]))
			{
				$k = $_GET["kat"];
				$this->kategorija = new MongoRegex("/".$k."/i");
			}
			if (isset($_GET["pretraga"]))
			{
				$p = $_GET["pretraga"];
				$this->pretraga = new MongoRegex("/".$p."/i");
			}
		}

		/**
		* izvresnje funkcije servisa
		*/
		public function akcija() 
		{
			//ukupan broj rezultata, neograniceno limitom (koristimo za izracunavanje ukupnog broja strana)
			$totalNr = $cursor = $this->db->hrana
				->find(array("kategorija" => $this->kategorija,
							 "naziv" 	  => $this->pretraga))->count();

			//sami rezultati
			$cursor = $this->db->hrana
				->find(array("kategorija" => $this->kategorija,
							 "naziv" 	  => $this->pretraga))
				->limit($this->limit)
				->skip($this->strana * $this->limit);

			$res = array();
			foreach ($cursor as $doc) {
			    array_push($res, $doc);
			}

			/*$res = iterator_to_array($cursor);*/
			array_push($res, $totalNr);
			echo json_encode($res);
		}
	}
?>