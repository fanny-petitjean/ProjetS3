<?php
require_once(File::build_path(array("fpdf183", "fpdf.php")));

class AdoptionPDF extends FPDF
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

    function corpsGrasSouligne($corps)
    {
        $this->SetFont('Arial', 'bu', 12);
        $this->MultiCell(0, 5, iconv('UTF-8', 'windows-1252', $corps), 0, 'C');
        $this->Ln();

    }

    function corpsCentre($corps)
    {
        $this->SetFont('Arial', '', 12);
        $this->MultiCell(0, 5, iconv('UTF-8', 'windows-1252', $corps), 0, 'C');
        $this->Ln();

    }

    function corpsImportant($corps)
    {
        $this->SetFont('Arial', 'bi', 12);
        $this->SetTextColor(255, 0, 0);
        $this->MultiCell(0, 5, iconv('UTF-8', 'windows-1252', $corps), 0, 'C');
        $this->SetTextColor(0);

        $this->Ln();


    }

    function checkBox($corps)
    {
        $this->SetFont('Arial', '', 12);
        $this->Cell(3.5, 3.5, '', 1);
        $this->Cell(10);
        $this->MultiCell(0, 5, iconv('UTF-8', 'windows-1252', $corps));
        $this->Ln(2);

    }

    function info($fichier)
    {
        $this->Ln(15);
        $txt = file_get_contents($fichier);
        $this->SetFont('Arial', '', 9);
        $this->SetTextColor(0);
        $this->MultiCell(0, 5, iconv('UTF-8', 'windows-1252', $txt));
        $this->Ln();
    }

    // Informations récupérées du formulaire
    function familleForm($civilite, $nomFamilleAccueil, $prenomFamilleAccueil, $adresseFamilleAccueil, $codePostalFamilleAccueil,
                         $villeFamilleAccueil, $paysFamilleAccueil, $mail, $telephone, $numDocId)
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
        $this->Cell($w, 15, iconv('UTF-8', 'windows-1252', "Tel : $telephone"));
        $this->Cell($w, 15, iconv('UTF-8', 'windows-1252', "Numéro document d'identité : $numDocId"));
        $this->Ln();
    }

    function chienForm1($nomChien, $race, $dateNaissance, $sexe, $robe, $sterilisation, $numPuce)
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
    }

    function chienForm2($nomChien, $race, $dateNaissance, $sexe, $numPuce)
    {
        $this->SetFont('Arial', '', 12);

        $w = 100;

        $this->Cell($w, 15, iconv('UTF-8', 'windows-1252', "Nom complet : $nomChien"));
        $this->Cell($w, 15, iconv('UTF-8', 'windows-1252', "Race : $race"));
        $this->Ln();
        $this->Cell($w, 15, iconv('UTF-8', 'windows-1252', "Date de naissance : $dateNaissance"));
        $this->Cell($w, 15, iconv('UTF-8', 'windows-1252', "Sexe : $sexe"));
        $this->Ln();
        $this->Cell($w, 15, iconv('UTF-8', 'windows-1252', "Numéro de tatouage/puce électronique : $numPuce"));
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

    function carteMembre($nomFamilleAccueil, $prenomFamilleAccueil, $dateForm)
    {
        $this->SetFont('Times', '', 12);

        $this->SetXY(95, 65);
        $this->Cell(0, 15, iconv('UTF-8', 'windows-1252', "Nom prénom : $nomFamilleAccueil $prenomFamilleAccueil"));
        $this->Ln();
        $this->SetXY(113, 80);
        $this->Cell(0, 15, iconv('UTF-8', 'windows-1252', $dateForm));
        $this->Ln();
    }

    public static function generateAdoptionPDF()
    {
        if (isset($_POST['submit'])) {
            // famille
            $civilite = $_POST['civilite'];
            $nomFamilleAccueil = $_POST['nomFamilleAccueil'];
            $prenomFamilleAccueil = $_POST['prenomFamilleAccueil'];
            $mail = $_POST['mail'];
            $telephone = $_POST['telephone'];
            $adresseFamilleAccueil = $_POST['adresseFamilleAccueil'];
            $codePostalFamilleAccueil = $_POST['codePostalFamilleAccueil'];
            $villeFamilleAccueil = $_POST['villeFamilleAccueil'];
            $paysFamilleAccueil = $_POST['paysFamilleAccueil'];
            $numDocId = $_POST['numDocId'];
            $lieu = $_POST['lieu'];
            $dateForm = $_POST['dateForm'];


            // chien
            $nomChien = $_POST['nomChien'];
            $race = $_POST['race'];
            $dateNaissance = $_POST['dateNaissance'];
            $sexe = $_POST['sexe'];
            $robe = $_POST['robe'];
            $sterilisation = $_POST['sterilisation'];
            $numPuce = $_POST['numPuce'];

            // ajouter data chien accueilli

            //si pas d'erreur continuer
            if (!isset($error)) {

                ob_end_clean();
                ob_start();
                $pdf = new AdoptionPDF();
                $pdf->AliasNbPages();
                $pdf->AddPage();
                $pdf->titreTexte("CONTRAT D'ADOPTION");
                $pdf->corpsTexte(
                    "Il est convenu ce qui suit entre : Bull's Friends Association dont l'objet est de regrouper toutes personnes physiques ou morales, bénévoles, aidant au replacement de chiens de race ou de type molossoïde maltraités, abandonnés, menacés d'abandon ou d'euthanasie selon les conditions fixées dansles statuts et le règlement intérieur de l'association."
                );
                $pdf->corpsTexte("Et : ");

                $pdf->familleForm($civilite, $nomFamilleAccueil, $prenomFamilleAccueil, $adresseFamilleAccueil, $codePostalFamilleAccueil,
                    $villeFamilleAccueil, $paysFamilleAccueil, $mail, $telephone, $numDocId);
                $pdf->titreTexte("IDENTITÉ DU CHIEN ADOPTÉ :");
                $pdf->chienForm1($nomChien, $race, $dateNaissance, $sexe, $robe, $sterilisation, $numPuce);
                $pdf->corpsTexte("Conformément à nos statuts, cette adoption ne prendra effet qu'après l'approbation du comité. Les statuts sont visibles sur le site de l'association.");
                $pdf->AddPage();

                $pdf->titreTexte("STÉRILISATION OBLIGATOIRE DU CHIEN");
                $pdf->corpsCentre("(condition obligatoire à l'adoption)");
                $pdf->corpsTexte("Le chien est stérilisé : $sterilisation");
                $pdf->corpsCentre("(Voir attestation de stérilisation en dernière page)");
                $pdf->corpsTexte(
                    "Une caution de 400 euros est demandée à l'adoptant. Cette caution, par chèque EXCLUSIVEMENT, sera rendue dès réception par Bull's Friends d'une attestation de stérilisation ou de contre-indication établie par le vétérinaire au choix de l'adoptant.
L'adoptant s'engage à faire stériliser le chien dans un délai maximum de 3 mois Il adressera un certificat de stérilisation à Bull's Friends."
                );
                $pdf->titreTexte("INOBSERVATION DE CETTE CLAUSE");
                $pdf->corpsTexte(
                    "L'attention de l'adoptant est attirée sur le fait que si cette clause n'est pas remplie, le contrat est rompu de facto au terme des 3 mois accordés à partir du jour de la date de signature du contrat. Le chien sera alors repris par l'association. Les frais engagés par l'adoptant entre le jour de la
date de signature et la rupture du contrat resteront à sa charge. L'adoptant ne pourra prétendre à un quelconque remboursement y compris cotisation de membre."
                );
                $pdf->corpsGrasSouligne(
                    "Nota :"
                );
                $pdf->corpsTexte(
                    "Les chiens âgés de plus de 6 ans ou dont la santé est incompatible avec cette intervention, ne sont pas concernés par l'obligation de stérilisation. S'il s'agit d'une raison médicale, une attestation sera alors établie par le vétérinaire et transmise à l'association."
                );
                $pdf->corpsImportant(
                    "DANS LE CAS D'UNE IMPOSSIBILITE MÉDICALE POUR LA STÉRILISATION DU CHIEN, LE NOUVEAU PROPRIÉTAIRE S'ENGAGE À NE PAS FAIRE PRATIQUER DE SAILLIE OU NE PAS FAIRE SAILLIR LE CHIEN OU LA CHIENNE."
                );
                $pdf->titreTexte("ENGAGEMENTS DE L'ADOPTANT");
                $pdf->corpsTexte(
                    "Le chien est adopté à la demande de l'adoptant. Ce dernier ne pourra se retourner ni contre l'ancien propriétaire, ni contre l'association Bull's Friends, en cas de problème rencontré dans la vie ou la santé du chien suite à l'adoption, il en fera son affaire exclusive. L'adoptant s'engage à restituer le chien si la stérilisation n'est pas pratiquée dans les 3 mois suivant l'adoption. L'adoptant s'engage à déclarer son animal auprès de sa compagnie d'assurance si nécessaire."
                );
                $pdf->AddPage();

                $pdf->titreTexte("LE CARACTÈRE ET L'INTÉGRATION DU CHIEN DANS SON NOUVEAU FOYER");
                $pdf->corpsContrat(File::build_path(array("ressources", "caractIntegr.txt")));
                $pdf->titreTexte("IMPORTANT");
                $pdf->corpsContrat(File::build_path(array("ressources", "important.txt")));


                $pdf->titreTexte("DOCUMENTS FOURNIS PAR L'ANCIEN PROPRIÉTAIRE");
                $pdf->checkBox("Carnet de Vaccination");
                $pdf->checkBox("Carte d’Identification");
                $pdf->checkBox("Certificat de bonne santé");
                $pdf->checkBox("Autres");
                $pdf->AddPage();

                $pdf->titreTexte("IDENTIFICATION AVEC TRANSFERT DE PROPRIÉTÉ EFFECTUÉ SUR :");
                $pdf->checkBox("Carte de tatouage (si le chien est tatoué, l'adoptant est tenu de vérifier le tatouage)");
                $pdf->checkBox("Carte d’identification SCC");
                $pdf->checkBox("Puce électronique");
                $pdf->checkBox("Certificat de naissance");
                $pdf->checkBox("Pedigree");
                $pdf->checkBox("Autres");

                $pdf->titreTexte("DOCUMENTS À JOINDRE EN RETOUR À L'ASSOCIATION");
                $pdf->checkBox("Le présent contrat");
                $pdf->checkBox("Une copie d'une pièce d'identité");
                $pdf->checkBox("Un justificatif de domicile datant de moins de 3 mois");
                $pdf->checkBox("Un chèque de cotisation membre à l'ordre de Bull's Friends Association d’un montant de : 250€");
                $pdf->checkBox("Un chèque de caution de 400€ (en attente de la stérilisation) à l'ordre de Bull's Friends Association et qui sera encaissé si le délai n'est pas respecté");
                $pdf->checkBox("La carte d'identification du chien (original) qui sera retourné à l'adoptant par l'association Bull’s Friends (au cas où la carte aurait été remise à l'adoptant par le cédant), en garder une copie pour le vétérinaire");
                $pdf->checkBox("Le pedigree du chien (document original). Faire une copie pour information");
                $pdf->info(File::build_path(array("ressources", "info.txt")));
                $pdf->AddPage();


                $pdf->corpsImportant("ATTENTION : Dans le cas où il manquerait des pièces justificatives, l'association BULL'S
FRIENDS se réserve le droit d'annuler l'adoption.");
                $pdf->Ln(15);
                $pdf->corpsGras("Le présent contrat est établi en 2 exemplaires dont un est à retourner à");
                $pdf->SetTextColor(14, 78, 116);
                $pdf->Ln(15);
                $pdf->corpsGras(
                    "Bull's Friends Association
Karine DUPIRE
48, rue des Dahlias
62000 Arras"
                );
                $pdf->Ln(15);
                $pdf->corpsTexte("Dater, signer et écrire « bon pour acceptation des termes du contrat et des engagements pris
entre l'adoptant et BULL'S FRIENDS Association »");
                $pdf->SetX(40);
                $pdf->dateLieu($lieu, $dateForm);
                $pdf->SetX(40);
                $pdf->corpsTexte("L'adoptant :");
                $pdf->MultiCell(200, 20, '');
                $pdf->SetX(40);
                $pdf->corpsTexte("Visa du délégué ou membre du Bureau pour Bull's Friends Association");
                $pdf->SetX(40);
                $pdf->Cell(135, 5, iconv('UTF-8', 'windows-1252', "Réfèrent :"));
                $pdf->AddPage();

                $pdf->titreTexte("ATTESTATION DE STERILISATION");
                $pdf->Ln(-10);
                $pdf->titreTexte("IDENTITÉ DU PROPRIÉTAIRE");
                $pdf->familleForm($civilite, $nomFamilleAccueil, $prenomFamilleAccueil, $adresseFamilleAccueil, $codePostalFamilleAccueil,
                    $villeFamilleAccueil, $paysFamilleAccueil, $mail, $telephone, $numDocId);
                $pdf->titreTexte("IDENTITÉ DU CHIEN");
                $pdf->chienForm2($nomChien, $race, $dateNaissance, $sexe, $numPuce);
                $pdf->corpsTexte("Attestons par la présente et certifions sur l'honneur avoir effectué la stérilisation chirurgicale");
                $pdf->corpsTexte("et définitive du chien susnommé, le ________________________________");
                $pdf->corpsTexte("Identité du vétérinaire");
                $pdf->corpsTexte("Nom : ");
                $pdf->corpsTexte("Adresse complète : ");
                $pdf->corpsTexte("Téléphone : ");
                $pdf->corpsTexte("Cachet et signature :");
                $pdf->AddPage();

                $pdf->Image('image/carteMembre.png', 10, 50, 190);
                $pdf->carteMembre($nomFamilleAccueil, $prenomFamilleAccueil, $dateForm);

                $pdf->Output();
                ob_end_flush();
            }
        }
    }
}

?>


