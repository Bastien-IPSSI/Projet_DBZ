<?php

abstract class Personnage{
    protected string $nom;
    protected int $vie;
    protected int $degats;

    protected function __construct($nom,$vie,$degats){
        $this->nom = $nom;
        $this->vie = $vie;
        $this->degats = $degats;
    }

    // protected function attaquer();
}

class Gentil extends Personnage{
    private int $niveau;
    private int $experience;
    private $pouvoirs = array();
    private $pouvoirsDebloquer = array();

    public function __construct($nom,$vie,$degats){
        parent::__construct($nom,$vie,$degats);
        $this->niveau = 1;
        $this->experience = 0;
        $this->pouvoirsDebloquer = ["Kamehaha","Genkidama"];
        $this->pouvoirs = ["Coup de poing"];
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
    public function getPouvoirs(){
        return $this->pouvoirs;
    }
    public function getNiveau(){
        return $this->niveau;
    }
    public function getExperience(){
        return $this->experience;
    }

    // SETTERS
    public function setVie($nouveauVie){
        $this->vie = $nouveauVie;
    }
    public function setExperience($nouveauExperience){
        $this->experience = $nouveauExperience;
    }
    public function setNiveau($nouveauNiveau){
        $this->niveau = $nouveauNiveau;
    }
    public function setDegats($nouveauDegats){
        $this->degats = $nouveauDegats;
    }

    // METHODS
    public function choisirAttaque(){
        $listePouvoirs = count($this->getPouvoirs());
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
                // GENKIDAMA MULTIPLIE LES DEGATS INFLIGES PAR 3 ETC
                return 3 * $this->getDegats();
    }
}

    public function recevoirDegats($degats){
        $this->setVie($this->getVie()-$degats);
        if ($this->vie < 1) {
            echo "Perdu\n";
        }else {
            echo $this->getNom() . " a encore " . $this->getVie() . " points de vie \n";
        }
    }

    public function gagnerExperience($experienceGagnee){
        $this->setExperience($this->getExperience() + $experienceGagnee);
        echo $this->getNom() . " a " . $this->getExperience() . " points d'expérience\n";
    }

    public function gagnerNiveau(){
        switch ($this->getNiveau()) {
            case 1:
                if ($this->getExperience() > 10) {
                    // GAGNER UN NIVEAU
                    $this->setNiveau($this->getNiveau() + 1);
                    // RESET L'EXPERIENCE
                    $this->setExperience($this->getExperience() - 10);
                    // MODIFIER STATS
                    $this->setVie($this->getVie() * 2);
                    $this->setDegats($this->getDegats() + 5);

                }
                break;
            case 2:
                if ($this->getExperience() > 20) {
                    $this->setNiveau($this->getNiveau() + 1);
                    $this->setExperience($this->getExperience() - 20);
                    $this->setVie($this->getVie() * 2);
                    $this->setDegats($this->getDegats() + 5);
                }
                break;
            case 3:
                if ($this->getExperience() > 30) {
                    $this->setNiveau($this->getNiveau() + 1);
                    $this->setExperience($this->getExperience() - 30);
                    $this->setVie($this->getVie() * 2);
                    $this->setDegats($this->getDegats() + 5);
                    // DEBLOQUER NOUVEAU POUVOIR AU NIVEAU 3
                    array_push($this->pouvoirs, $this->pouvoirsDebloquer[0]);
                }
                break;
            case 4:
                if ($this->getExperience() > 40) {
                    $this->setNiveau($this->getNiveau() + 1);
                    $this->setExperience($this->getExperience() - 40);
                    $this->setVie($this->getVie() * 2);
                    $this->setDegats($this->getDegats() + 5);
                }
                break;
            case 5:
                if ($this->getExperience() > 50) {
                    $this->setNiveau($this->getNiveau() + 1);
                    $this->setExperience($this->getExperience() - 50);
                    $this->setVie($this->getVie() * 2);
                    $this->setDegats($this->getDegats() + 5);
                    // DEBLOQUER NOUVEAU POUVOIR AU NIVEAU 5
                    array_push($this->pouvoirs, $this->pouvoirsDebloquer[1]);
                }
                break;
            default:
                break;
        }
    }
}


class Mechant extends Personnage{
    private $pouvoirs = array();
    private int $experience;

    public function __construct($nom,$vie,$degats,$pouvoirs,$experience){
        parent::__construct($nom,$vie,$degats);
        $this->pouvoirs = $pouvoirs;
        $this->experience = $experience;
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
        return $this->pouvoirs;
    }

    // SETTERS
    public function setVie($nouveauVie){
        $this->vie = $nouveauVie;
    }

    // METHODS
    public function choisirAttaque(){
        $choix = rand(0,count($this->getPouvoir())-1);
        return $choix;
    }

    public function attaquer($pouvoirChoisi){
        switch ($pouvoirChoisi) {
            case 0:
                // COUP DE POING MULTIPLIE LES DEGATS INFLIGES PAR 1
                return 1 * $this->getDegats();
            case 1:
                // COUP DE PIED MULTIPLIE LES DEGATS INFLIGES PAR 2 ETC
                return 2 * $this->getDegats();
            case 2:
                // BIG BANG ATTACK MULTIPLIE LES DEGATS INFLIGES PAR 3 ETC
                return 3 * $this->getDegats();
            case 3:
                // CRUSH CANNON MULTIPLIE LES DEGATS INFLIGES PAR 4 ETC
                return 4 * $this->getDegats();
        }
    }

    public function recevoirDegats($degats){
        $this->setVie($this->getVie()-$degats);
        if ($this->vie < 1) {
            echo $this->getNom() . " est mort \n";
        }else {
            echo $this->getNom() . " a encore " . $this->getVie() . " points de vie \n";
        }
    }
}

$pouvoirMechants = array("Coup de poing","Coup de pied","Big Bang Attack","Crush Cannon");

// RUN

// $goku = new Gentil("Goku", 10, 3);
// echo "il a tapé " . $goku->attaquer($goku->choisirAttaque());
$saibaman = new Mechant("Saibaman", 5, 1, ["Coup de poing", "Coup de pied"], 5);
echo "il a tapé " . $saibaman->attaquer($saibaman->choisirAttaque());

?>