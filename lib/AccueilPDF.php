<?php
require_once(File::build_path(array("fpdf183", "fpdf.php")));
require_once(File::build_path(array("model", "ModelFamille.php")));

class AccueilPDF extends FPDF
{

    // En-tête
    function Header()
    {
        // Logo
        $this->Image('image/logo.png', 10, 6, 30);
        // Police Arial gras 15
        $this->SetFont('Arial', 'B', 15);
        $this->SetTextColor(14, 78, 116);
        // Décalage à droite
        $this->Cell(50);
        // Titre
        $this->Cell(90, 20, 'Bull\'s Friends Association', 0, 0, 'C');
        $this->SetTextColor(0);
        // Saut de ligne
        $this->Ln(26);
    }

    // Pied de page
    function Footer()
    {
        $this->SetY(-15);

        // Police Arial italique 8
        $this->SetFont('Arial', 'I', 8);
        // Numéro de page
        $this->Cell(0, 5, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
        $this->Ln();

        // Positionnement à 1,5 cm du bas
        $this->SetX(25);

        $this->SetFont('Arial', 'B', 9);
        $this->SetTextColor(14, 78, 116);
        $this->Cell(42, 6, iconv('UTF-8', 'windows-1252', 'Bull\'s Friends Association'));
        $this->SetFont('Arial', '', 8);
        $this->SetTextColor(0);
        $this->Cell(80, 6, iconv('UTF-8', 'windows-1252', '- Jean-Clément Aubrun - Bâtiment F16 - 28 rue de Savrigny - FR-91390 Morsang sur Orge'));


    }

    function titreTexte($titre)
    {
        // Police Arial 13
        $this->SetFont('Arial', 'B', 13);
        $this->SetTextColor(14, 78, 116);

        // Décalage à droite
        $this->Cell(45);
        // Titre
        $this->Cell(100, 20, iconv('UTF-8', 'windows-1252', $titre), 0, 0, 'C');
        $this->SetTextColor(0);
        // Saut de ligne
        $this->Ln(20);
    }

    function corpsTexte($corps)
    {
        // Arial 12
        $this->SetFont('Arial', '', 12);
        $this->SetTextColor(0);
        // Sortie du texte justifié
        $this->MultiCell(0, 5, iconv('UTF-8', 'windows-1252', $corps));
        // Saut de ligne
        $this->Ln();
    }


    function corpsContrat($fichier)
    {
        // Lecture du fichier texte
        $txt = file_get_contents($fichier);
        // Arial 12
        $this->SetFont('Arial', '', 12);
        $this->SetTextColor(0);

        // Sortie du texte justifié
        $this->MultiCell(0, 5, iconv('UTF-8', 'windows-1252', $txt));
        // Saut de ligne
        $this->Ln();

    }

    function corpsGras($corps)
    {
        $this->SetFont('Arial', 'b', 12);
        $this->MultiCell(0, 5, iconv('UTF-8', 'windows-1252', $corps), 0, 'C');
        $this->Ln();

    }

    function remarques()
    {
        $this->MultiCell(200, 20, '');
        $this->SetFont('Arial', '', 12);
        $this->SetTextColor(14, 78, 116);
        $this->SetDrawColor(14, 78, 116);
        $this->Cell(10);
        $this->MultiCell(50, 2, iconv('UTF-8', 'windows-1252', '   Remarques :'));
        $this->Line(20, 50, 190, 50);
        $this->Line(20, 90, 190, 90);
        $this->Line(20, 50, 20, 90);
        $this->Line(190, 50, 190, 90);
        $this->SetTextColor(0);
        $this->Ln(50);

    }

    // Informations récupérées du formulaire
    function familleForm($civilite, $nomFamilleAccueil, $prenomFamilleAccueil, $adresseFamilleAccueil, $codePostalFamilleAccueil,
                         $villeFamilleAccueil, $paysFamilleAccueil, $mail, $telephoneFixe, $telephoneMobile)
    {
        $this->SetFont('Arial', '', 12);

        // Largeurs des colonnes
        $w = 100;

        // Données
        $this->Cell($w, 15, iconv('UTF-8', 'windows-1252', "Civilité : $civilite"));
        $this->Cell($w, 15, iconv('UTF-8', 'windows-1252', "Nom Prénom : $nomFamilleAccueil $prenomFamilleAccueil"));
        $this->Ln();
        $this->Cell($w, 15, iconv('UTF-8', 'windows-1252', "Adresse : $adresseFamilleAccueil"));
        $this->Ln();
        $this->Cell($w, 15, iconv('UTF-8', 'windows-1252', "Code postal : $codePostalFamilleAccueil"));
        $this->Cell($w, 15, iconv('UTF-8', 'windows-1252', "Ville : $villeFamilleAccueil"));
        $this->Ln();
        $this->Cell($w, 15, iconv('UTF-8', 'windows-1252', "Pays : $paysFamilleAccueil"));
        $this->Cell($w, 15, iconv('UTF-8', 'windows-1252', "E-mail : $mail"));
        $this->Ln();
        $this->Cell($w, 15, iconv('UTF-8', 'windows-1252', "Tel. Fixe : $telephoneFixe"));
        $this->Cell($w, 15, iconv('UTF-8', 'windows-1252', "Tel. Mobile : $telephoneMobile"));
        $this->Ln();
    }

    function chienForm($nomChien, $race, $dateNaissance, $sexe, $robe, $sterilisation, $numPuce, $dateAccueil)
    {
        $this->SetFont('Arial', '', 12);

        $w = 100;

        $this->Cell($w, 15, iconv('UTF-8', 'windows-1252', "Nom complet : $nomChien"));
        $this->Cell($w, 15, iconv('UTF-8', 'windows-1252', "Race : $race"));
        $this->Ln();
        $this->Cell($w, 15, iconv('UTF-8', 'windows-1252', "Date de naissance : $dateNaissance"));
        $this->Cell($w, 15, iconv('UTF-8', 'windows-1252', "Sexe : $sexe"));
        $this->Ln();
        $this->Cell($w, 15, iconv('UTF-8', 'windows-1252', "Robe : $robe"));
        $this->Cell($w, 15, iconv('UTF-8', 'windows-1252', "Carnet de vaccination à jour : $sterilisation"));
        $this->Ln();
        $this->Cell($w, 15, iconv('UTF-8', 'windows-1252', "Numéro de tatouage/puce électronique : $numPuce"));
        $this->Ln();
        $this->Cell($w, 15, iconv('UTF-8', 'windows-1252', "Date de début de l'accueil : $dateAccueil"));
        $this->Ln();
    }

    function dateLieu($lieu, $dateForm)
    {
        $this->SetFont('Arial', '', 12);
        $this->SetTextColor(0);

        $w = 100;

        $this->Cell($w, 15, iconv('UTF-8', 'windows-1252', "Fait à : $lieu"));
        $this->Cell($w, 15, iconv('UTF-8', 'windows-1252', "Le $dateForm"));
        $this->Ln();
    }

    public static function generateAccueilPDF($famille)
    {

        // famille
        $f = ModelFamille::getFamilleByNom($famille['mail']);
        $civilite = $f->getCivilite();
        $nomFamilleAccueil = $f->getNomFamille();
        $prenomFamilleAccueil = $f->getPrenomFamille();
        $mail = $f->getMail();
        $telephoneFixe = $f->getNumTelephoneFixe();
        $telephoneMobile = $f->getNumTelephone();
        $adresseFamilleAccueil = $f->getAdresse();
        $codePostalFamilleAccueil = $f->getCodePostal();
        $villeFamilleAccueil = $f->getVille();
        $paysFamilleAccueil = $f->getPays();
        $lieu = $famille['lieu'];
        $dateForm = $famille['dateForm'];

        // chien
        $numPuce = $_POST['numPuce'];
        $nomChien = $_POST['nomChien'];
        $race = $_POST['race'];
        $dateNaissance = $_POST['dateNaissance'];
        $sexe = $_POST['sexe'];
        $robe = $_POST['robe'];
        $sterilisation = $_POST['sterilisation'];
        $dateAccueil = $_POST['dateAccueil'];

        // ajouter data chien accueilli


        //si pas d'erreur continuer
        if (!isset($error)) {

            ob_end_clean();
            ob_start();
            $pdf = new AccueilPDF();
            $pdf->AliasNbPages();
            $pdf->AddPage();
            $pdf->titreTexte("CONTRAT D'ACCUEIL BÉNÉVOLE");
            $pdf->corpsTexte("Les conditions d'accueil indiquées ci-dessous devront être celles effectivement réservées à
l'animal, celles-ci étant en rapport avec son caractère et les motivations de notre œuvre.");
            $pdf->corpsTexte("Le non-respect de ces conditions entraîne l'annulation du contrat et autorise BULL'S FRIENDS à
reprendre l'animal sans préavis.");

            $pdf->titreTexte("BULL'S FRIENDS ASSOCIATION CONFIE EN ACCUEIL À :");
            $pdf->familleForm($civilite, $nomFamilleAccueil, $prenomFamilleAccueil, $adresseFamilleAccueil, $codePostalFamilleAccueil,
                $villeFamilleAccueil, $paysFamilleAccueil, $mail, $telephoneFixe, $telephoneMobile);
            $pdf->titreTexte("BULL'S FRIENDS ASSOCIATION CONFIE EN ACCUEIL L'ANIMAL CI-APRÈS DÉSIGNÉ :");
            $pdf->chienForm($nomChien, $race, $dateNaissance, $sexe, $robe, $sterilisation, $numPuce, $dateAccueil);
            $pdf->AddPage();
            $pdf->titreTexte("L'ACCUEILLANT S'ENGAGE ENVERS BULL'S FRIENDS ASSOCIATION :");
            $pdf->corpsContrat(File::build_path(array("ressources", "clausesContrat.txt")));
            $pdf->AddPage();
            $pdf->remarques();
            $pdf->corpsGras("Le présent contrat est établi en 2 exemplaires dont un est à retourner à");
            $pdf->SetTextColor(14, 78, 116);
            $pdf->corpsGras("Bull's Friends Association");
            $pdf->corpsGras(
                "Monsieur Jean-Clément Aubrun
Bâtiment F16
28 rue de Savigny
FR-91390 Morsang sur Orge
France"
            );
            $pdf->SetXY(40, 180);
            $pdf->dateLieu($lieu, $dateForm);
            $pdf->SetX(40);

            $pdf->corpsTexte("L'accueillant (signature précédée de la mention « lu et approuvé »)");
            $pdf->MultiCell(200, 20, '');
            $pdf->SetX(40);
            $pdf->corpsTexte("Visa du délégué ou membre du Bureau pour Bull's Friends Association");
            $pdf->SetX(40);
            $pdf->Cell(135, 5, iconv('UTF-8', 'windows-1252', "Réfèrent : L.O"), 0, 0, 'R');


            $pdf->Output();
            ob_end_flush();
        }

    }
}

?>


