<?php
	class Centre{
		
			// attributs
			private $idcentre, $nom, $adress, $cp, $ville, $lng, $lat;
			
			// constructeurs
			public function __construct(){
				$this->idcentre = 0;
				$this->ville = "";
				$this->nom = "";
				$this->adress = "";
				$this->cp = "";
				$this->lng = 0;
				$this->lat = 0;
			}
			
			//methodes
			public function renseigner($tab){
				$this->idcentre = $tab['idcentre'];
				$this->nom = $tab['nom'];
				$this->adress = $tab['adress'];
				$this->ville = $tab['ville'];
				$this->cp = $tab['cp'];
				$this->lng = $tab['lng'];
				$this->lat = $tab['lat'];
			}
			
			public function serialiser(){
				$tab = array();
				$tab['idcentre'] = $this->idcentre;
				$tab['ville'] = $this->ville;
				$tab['nom'] = $this->nom;
				$tab['adress'] = $this->adress; 
				$tab['cp'] = $this->cp;
				$tab['lng'] = $this->lng;
				$tab['lat'] = $this->lat;
				return $tab;
			}
			
			public function afficher(){
				$aff = "Le centre :".$this->nom."<br/>Numéro : ".$this->idcentre."<br/>".$this->adress."<br/>ville : ".$this->ville."<br/>cp : ".$this->cp
				."<br/>longitude : ".$this->lng."<br/>latitude : ".$this->lat;
				return $aff;
			}
			
			//getters et setters
			
			public function getNumero(){
				return $this->idcentre;
			}
			public function getSolde(){
				return $this->ville;
			}
			public function getNom(){
				return $this->nom;
			}
			public function getPrenom(){
				return $this->adress;
			}
			
			public function setNumero($idcentre){
				$this->idcentre = $idcentre;
			}
			public function setSolde($ville){
				$this->ville = $ville;
			}
			public function setNom($nom){
				$this->nom = $nom;
			}
			public function setPrenom($adress){
				$this->adress = $adress;
			}
	}
?>