<?php
	class BDD{
		
		private $table, $id;
		private $unPdo;
		
		public function __construct($server, $bdd, $user, $mdp){
			try{
				$this->unPdo = new PDO("mysql:host=".$server.";dbname=".$bdd, $user, $mdp);
			}
			catch(Exception $exp){
				echo "Erreur de connexion BDD ".$bdd; 
			}
		}
		
		public function renseigner ($table, $id){
			
			$this->table = $table;
			$this->id = $id;
		}
		
		public function selectAll(){
			$requete = "select * from ".$this->table.";";
			$select = $this->unPdo->prepare($requete);
			$select->execute();
			$resultats = $select->fetchAll();
			return $resultats;
		}
		
		public function selectLngLat(){
			$requete = "select lng, lat from ".$this->table.";";
			$select = $this->unPdo->prepare($requete);
			$select->execute();
			$resultats = $select->fetchAll();
			return $resultats;
		}
		
		public function selectNom(){
			$requete = "select nom from ".$this->table.";";
			$select = $this->unPdo->prepare($requete);
			$select->execute();
			$resultats = $select->fetchAll();
			return $resultats;
		}
		
		public function insert ($tab){
			
			$listeChamps = array();
			$listeValeurs = array();
			$donnees = array();
			foreach ($tab as $line=>$valeur){
				$listeChamps[] = $line;
				$listeValeurs[] = ":".$line;
				$donnees[":".$line] = $valeur; 
			}
			$champs = implode(',', $listeChamps);
			$valeurs = implode(',', $listeValeurs);
			$requete = "insert into ".$this->table."(".$champs.") values (".$valeurs.");";
			$select = $this->unPdo->prepare($requete);
			$select->execute($donnees);	
		}
	}
?>