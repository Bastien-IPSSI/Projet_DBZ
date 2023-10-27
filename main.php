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
                while($choix != 1){
                    $choix = (int)readline("Quelle attaque?\n1. Coup de poing");
                }
                return $choix;
            case 2:
                $choix = (int)readline("Quelle attaque?\n1. Coup de poing \n2. Kamehaha");
                while($choix < 1 || $choix > 2){
                    $choix = (int)readline("Quelle attaque?\n1. Coup de poing \n2. Kamehaha");
                }
                return $choix;
            case 3:
                $choix = (int)readline("Quelle attaque?\n1. Coup de poing \n2. Kamehaha \n3. Genkidama");
                while($choix < 1 || $choix > 3){
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
            $this->finDeJeu();
            exit;
        }else {
            echo $this->getNom() . " a encore " . $this->getVie() . " points de vie \n";
        }
    }

    public function gagnerExperience($experienceGagnee){
        $this->setExperience($this->getExperience() + $experienceGagnee);
        echo $this->getNom() . " a " . $this->getExperience() . " points d'expérience\n";
        $this->gagnerNiveau();
    }

    public function gagnerNiveau(){
        switch ($this->getNiveau()) {
            case 1:
                if ($this->getExperience() >= 10) {
                    echo "Vous avez gagné un niveau\n";
                    echo "Vous êtes niveau 2\n";
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
                    if ($this->getExperience() >= 20) {
                        echo "Vous avez gagné un niveau\n";
                        echo "Vous êtes niveau 3\n";
                        $this->setNiveau($this->getNiveau() + 1);
                        $this->setExperience($this->getExperience() - 20);
                        $this->setVie($this->getVie() * 2);
                        $this->setDegats($this->getDegats() + 5);
                        // DEBLOQUER NOUVEAU POUVOIR AU NIVEAU 3
                        array_push($this->pouvoirs, $this->pouvoirsDebloquer[0]);
                    }
                    break;
                    case 3:
                        if ($this->getExperience() >= 30) {
                            echo "Vous avez gagné un niveau\n";
                            echo "Vous êtes niveau 4\n";
                    $this->setNiveau($this->getNiveau() + 1);
                    $this->setExperience($this->getExperience() - 30);
                    $this->setVie($this->getVie() * 2);
                    $this->setDegats($this->getDegats() + 5);
                    
                }
                break;
                case 4:
                    if ($this->getExperience() >= 40) {
                        echo "Vous avez gagné un niveau\n";
                        echo "Vous êtes niveau 5\n";
                        $this->setNiveau($this->getNiveau() + 1);
                        $this->setExperience($this->getExperience() - 40);
                        $this->setVie($this->getVie() * 2);
                        $this->setDegats($this->getDegats() + 5);
                        // DEBLOQUER NOUVEAU POUVOIR AU NIVEAU 5
                        array_push($this->pouvoirs, $this->pouvoirsDebloquer[1]);
                    }
                break;
            case 5:
                if ($this->getExperience() >= 50) {
                    echo "Vous avez gagné un niveau\n";
                    echo "Vous êtes niveau 6\n";
                    $this->setNiveau($this->getNiveau() + 1);
                    $this->setExperience($this->getExperience() - 50);
                    $this->setVie($this->getVie() * 2);
                    $this->setDegats($this->getDegats() + 5);
                }
                break;
            default:
                break;
        }
    }

    public function afficherInfos(){
        echo "Statistiques: \n";
        echo "Nom: " . $this->getNom() . "\n";
        echo "Vie: " . $this->getVie() . "\n";
        echo "Niveau: " . $this->getNiveau() . "\n";
        echo "Dégâts: " . $this->getDegats() . "\n";
        echo "Pouvoirs: \n";
        for ($i=0; $i < count($this->getPouvoirs()); $i++) {
            echo "- " . $this->getPouvoirs()[$i] . "\n";
        }
    }

    public function finDeJeu(){
        echo "JEU FINI";
        exit;
    }
}


class Mechant extends Personnage{
    private $pouvoirs = array();
    private int $experience;
    protected bool $estMort;

    public function __construct($nom,$vie,$degats,$pouvoirs,$experience){
        parent::__construct($nom,$vie,$degats);
        $this->pouvoirs = $pouvoirs;
        $this->experience = $experience;
        $this->estMort = false;
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
    public function getExperience(){
        return $this->experience;
    }
    public function getEstMort(){
        return $this->estMort;
    }

    // SETTERS
    public function setVie($nouveauVie){
        $this->vie = $nouveauVie;
    }
    public function setEstMort(){
        $this->estMort = true;
    }

    // METHODS
    public function choisirAttaque(){
        $choix = rand(0,count($this->getPouvoirs())-1);
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
                // COUP DE BIDON ATTACK MULTIPLIE LES DEGATS INFLIGES PAR 2 ETC
                return 2 * $this->getDegats();
            case 3:
                // BIG BANG ATTACK MULTIPLIE LES DEGATS INFLIGES PAR 3 ETC
                return 3 * $this->getDegats();
            case 4:
                // CRUSH CANNON MULTIPLIE LES DEGATS INFLIGES PAR 4 ETC
                return 4 * $this->getDegats();
        }
    }

    public function recevoirDegats($degats){
        $this->setVie($this->getVie()-$degats);
        if ($this->vie < 1) {
            echo $this->getNom() . " est mort \n";
            $this->setEstMort();
        }else {
            echo $this->getNom() . " a encore " . $this->getVie() . " points de vie \n";
        }
    }
}

function combat(Gentil $personnage, $listeEnnemis){
    echo "Le combat commence\n";
    while ($personnage->getVie() > 0 || count($listeEnnemis) < 1) {
        if (count($listeEnnemis) == 1) {
            // Tour du joueur
            $choix = (int)readline("1. Attaquer 2. Voir statistiques\n");
            // VERIF
            while ($choix < 1 || $choix > 2) {
                $choix = (int)readline("1. Attaquer 2. Voir statistiques\n");
            }
            switch ($choix) {
                case 1:
                    $choixAttaque = $personnage->choisirAttaque();
                    $degatsInfliges = $personnage->attaquer(($choixAttaque));
                    $listeEnnemis[0]->recevoirDegats($degatsInfliges);
                    // $listeEnnemis[0]->recevoirDegats($personnage->attaquer($personnage->choisirAttaque()));
                    if ($listeEnnemis[0]->getEstMort() == true) {
                        $personnage->gagnerExperience($listeEnnemis[0]->getExperience());
                        unset($listeEnnemis[0]);
                        echo "Le combat est fini\n";
                        return;
                    }
                    // Tour de l'ennemi
                    $choixAttaqueEnnemi = $listeEnnemis[0]->choisirAttaque();
                    echo $listeEnnemis[0]->getNom() . " choisi l'attaque " . $listeEnnemis[0]->getPouvoirs()[$choixAttaqueEnnemi] . "\n";
                    $degatsInfligesEnnemi = $listeEnnemis[0]->attaquer($choixAttaqueEnnemi);
                    $personnage->recevoirDegats($degatsInfligesEnnemi);
                    break;
                case 2:
                    $personnage->afficherInfos();
                    break;
                default:
                    break;
            }
        }else {
            // Tour du joueur
            $choix = (int)readline("1. Attaquer 2. Voir statistiques\n");
            // VERIF
            while ($choix < 1 || $choix > 2) {
                $choix = (int)readline("1. Attaquer 2. Voir statistiques\n");
            }
            switch ($choix) {
                // Tour d'attaque
                case 1:
                    echo "Voici la liste des ennemis:\n";
                    for ($i=0; $i < count($listeEnnemis); $i++) {
                        echo $i+1 . ". " . $listeEnnemis[$i]->getNom() . "(" . $listeEnnemis[$i]->getVie() . " pv)\n";
                    }
                    $choixEnnemi = (int)readline("Quel ennemi?\n") -1;
                    $choixAttaque = $personnage->choisirAttaque();
                    $degatsInfliges = $personnage->attaquer(($choixAttaque));
                    $listeEnnemis[$choixEnnemi]->recevoirDegats($degatsInfliges);
                    if ($listeEnnemis[$choixEnnemi]->getEstMort() == true) {
                        $personnage->gagnerExperience($listeEnnemis[$choixEnnemi]->getExperience());
                        unset($listeEnnemis[$choixEnnemi]);
                        $listeEnnemis = array_values($listeEnnemis);
                    }
                    // Tour de l'ennemi
                    echo "Un des ennemis attaque\n";
                    $rand = rand(0,count($listeEnnemis)-1);
                    $choixAttaqueEnnemi = $listeEnnemis[$rand]->choisirAttaque();
                    echo $listeEnnemis[$rand]->getNom() . " choisi l'attaque " . $listeEnnemis[$rand]->getPouvoirs()[$choixAttaqueEnnemi] . "\n";
                    $degatsInfligesEnnemi = $listeEnnemis[$rand]->attaquer($choixAttaqueEnnemi);
                    $personnage->recevoirDegats($degatsInfligesEnnemi);
                    break;
                case 2:
                    $personnage->afficherInfos();
            }
        }
    }
    // echo "Fin de combat\n";
}

$pouvoirsMechants = array("Coup de poing","Coup de pied", "Coup de bidon", "Big Bang Attack","Crush Cannon");

$listeMechantsNiveau1 = array(new Mechant("Saibaman", rand(1,3), rand(1,3), ["Coup de poing", "Coup de pied"], 5),
new Mechant("Raditz", rand(3,5), rand(3,5), ["Coup de poing", "Coup de pied"], 5),
new Mechant("Nappa", rand(3,5), rand(3,5), ["Coup de poing", "Coup de pied"], 5),
new Mechant("Reacum", rand(3,5), rand(3,5), ["Coup de poing", "Coup de pied", "Coup de bidon"], 5),
);

$listeMechantsNiveau2 = array(new Mechant("C17", rand(1,3), rand(1,3), ["Coup de poing", "Coup de pied"], 5),
new Mechant("C18", rand(3,5), rand(3,5), ["Coup de poing", "Coup de pied"], 5),
new Mechant("Freezer", rand(3,5), rand(3,5), ["Coup de poing", "Coup de pied", "Big Bang Attack"], 5),
new Mechant("Vegeta", rand(3,5), rand(3,5), ["Coup de poing", "Coup de pied", "Big Bang Attack"], 5),
);

function ennemiAleatoire($nombreEnnemis){
    $listeIndexEnnemi = array();
    switch ($nombreEnnemis) {
        case 1:
            $ennemi = rand(0,3);
            array_push($listeIndexEnnemi, $ennemi);
            return $listeIndexEnnemi;
        case 2 :
            $ennemi1 = rand(0,3);
            $ennemi2 = rand(0,3);
            // NE PAS GENERER DEUX FOIS LE MEME ENNEMI
            while ($ennemi2 == $ennemi1) {
                $ennemi2 = rand(0,3);
            }
            array_push($listeIndexEnnemi, $ennemi1, $ennemi2);
            return $listeIndexEnnemi;
    }
}

function jeu($heros){

    $cmptVictoires = 1;
    while ($cmptVictoires < 11) {
        echo "Le combat numéro " . $cmptVictoires . " commence\n";
        $listeMechantsNiveau1 = array(new Mechant("Saibaman", rand(1,3), rand(1,3), ["Coup de poing", "Coup de pied"], 5),
new Mechant("Raditz", rand(3,5), rand(3,5), ["Coup de poing", "Coup de pied"], 5),
new Mechant("Nappa", rand(3,5), rand(3,5), ["Coup de poing", "Coup de pied"], 5),
new Mechant("Reacum", rand(3,5), rand(3,5), ["Coup de poing", "Coup de pied", "Coup de bidon"], 5),
);

$listeMechantsNiveau2 = array(new Mechant("C17", rand(1,3), rand(1,3), ["Coup de poing", "Coup de pied"], 5),
new Mechant("C18", rand(3,5), rand(3,5), ["Coup de poing", "Coup de pied"], 5),
new Mechant("Freezer", rand(3,5), rand(3,5), ["Coup de poing", "Coup de pied", "Big Bang Attack"], 5),
new Mechant("Vegeta", rand(3,5), rand(3,5), ["Coup de poing", "Coup de pied", "Big Bang Attack"], 5),
);
        switch ($cmptVictoires) {
            case $cmptVictoires < 5:
                $listeIndexEnnemi = ennemiAleatoire(1);
                combat($heros, array($listeMechantsNiveau1[$listeIndexEnnemi[0]]));
                $cmptVictoires++;
                break;
            case $cmptVictoires >= 5:
                $listeIndexEnnemi = ennemiAleatoire(2);
                combat($heros, array($listeMechantsNiveau2[$listeIndexEnnemi[0]], $listeMechantsNiveau2[$listeIndexEnnemi[1]]));
                $cmptVictoires++;
                break;
        }
    }
}

// RUN

$goku = new Gentil("Goku", 1000, 100);

jeu($goku, $listeMechantsNiveau1, $listeMechantsNiveau2);

?>