<?php 
	/**
	* vraca sve postojece kategorije hrane
	*/
	class GetKategorije extends AServis
	{

		public function __construct() 
		{
			parent::__construct();
			parent::parsujArgumente();
		}

		/**
		* izvresnje funkcije servisa
		*/
		public function akcija() 
		{

			//sami rezultati
 			$cursor = $this->db->hrana->distinct("kategorija");

			$res = array();
			foreach ($cursor as $doc) {
			    array_push($res, $doc);
			}

			echo json_encode($res);
		}
	}
?>