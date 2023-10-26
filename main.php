<?php

abstract class Personnage{
    protected string $nom;
    protected int $vie;
    protected int $degats;
    protected $pouvoir = array();

    protected function __construct($nom,$vie,$degats){
        $this->nom = $nom;
        $this->vie = $vie;
        $this->degats = $degats;
        $this->pouvoir = ["Coup de poing"];
    }

    // protected function attaquer();
}

class Gentil extends Personnage{
    private int $niveau;
    private int $experience;
    private $pouvoirsDebloquer = array("Kamehaha","Genkidama");

    public function __construct($nom,$vie,$degats){
        parent::__construct($nom,$vie,$degats);
        $this->niveau = 1;
        $this->experience = 0;
    }

    // GETTERS
    public function getNom(){
        return $this->nom;
    }
    public function getVie(){
        return $this->vie;
    }
    public function getDegats(){
        return $this->degats;
    }
    public function getPouvoir(){
        return $this->pouvoir;
    }
    public function getNiveau(){
        return $this->niveau;
    }
    public function getExperience(){
        return $this->experience;
    }

    // METHODS
    public function choisirAttaque(){
        $listePouvoirs = count($this->getPouvoir());
        switch ($listePouvoirs) {
            case 1:
                $choix = (int)readline("Quelle attaque?\n1. Coup de poing");
                while($choix !== 1){
                    $choix = (int)readline("Quelle attaque?\n1. Coup de poing");
                }
                return $choix;
            case 2:
                $choix = (int)readline("Quelle attaque?\n1. Coup de poing \n2. Kamehaha");
                while($choix !== 1 or $choix !== 2){
                    $choix = (int)readline("Quelle attaque?\n1. Coup de poing \n2. Kamehaha");
                }
                return $choix;
            case 3:
                $choix = (int)readline("Quelle attaque?\n1. Coup de poing \n2. Kamehaha \n3. Genkidama");
                while($choix !== 1 or $choix !== 2 or $choix !== 3){
                    $choix = (int)readline("Quelle attaque?\n1. Coup de poing \n2. Kamehaha \n3. Genkidama");
                }
                return $choix;
        } 
    }

    public function attaquer($pouvoirChoisi){
        switch ($pouvoirChoisi) {
            case 1:
                // COUP DE POING MULTIPLIE LES DEGATS INFLIGES PAR 1
                return 1 * $this->getDegats();
            case 2:
                // KAMEHAHA MULTIPLIE LES DEGATS INFLIGES PAR 2 ETC
                return 2 * $this->getDegats();
            case 3:
                // GENKIDAMA MULTIPLIE LES DEGATS INFLIGES PAR 2 ETC
                return 3 * $this->getDegats();
    } 
}}


class Mechant extends Personnage{
    public function __construct($nom,$vie,$degats){
        parent::__construct($nom,$vie,$degats);
    }

    // GETTERS
    public function getNom(){
        return $this->nom;
    }
    public function getVie(){
        return $this->vie;
    }
    public function getDegats(){
        return $this->degats;
    }
}

// RUN

$goku = new Gentil("Goku", 10, 3);
echo "il a tapé " . $goku->attaquer($goku->choisirAttaque());

?>