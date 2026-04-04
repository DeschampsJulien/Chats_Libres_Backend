<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260404213555 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fiche_chat ADD latitude DOUBLE PRECISION NOT NULL, ADD longitude DOUBLE PRECISION NOT NULL, ADD dossier_numero VARCHAR(255) DEFAULT NULL, ADD trappage_date VARCHAR(255) DEFAULT NULL, ADD trappage_heure VARCHAR(255) DEFAULT NULL, ADD adresse_precise VARCHAR(255) DEFAULT NULL, ADD commune VARCHAR(255) DEFAULT NULL, ADD type_lieu VARCHAR(255) DEFAULT NULL, ADD autre_type_lieu VARCHAR(255) DEFAULT NULL, ADD nom_entreprise_particulier VARCHAR(255) DEFAULT NULL, ADD trappage_telephone VARCHAR(255) DEFAULT NULL, ADD colonie_site VARCHAR(255) DEFAULT NULL, ADD signalement_nom VARCHAR(255) DEFAULT NULL, ADD signalement_telephone VARCHAR(255) DEFAULT NULL, ADD signalement_email VARCHAR(255) DEFAULT NULL, ADD statut_chat VARCHAR(255) DEFAULT NULL, ADD proprietaire_nom VARCHAR(255) DEFAULT NULL, ADD proprietaire_adresse VARCHAR(255) DEFAULT NULL, ADD proprietaire_telephone VARCHAR(255) DEFAULT NULL, ADD chat_nourri VARCHAR(255) DEFAULT NULL, ADD nourrissage_type VARCHAR(255) DEFAULT NULL, ADD nourrisseur_nom VARCHAR(255) DEFAULT NULL, ADD nourrisseur_telephone VARCHAR(255) DEFAULT NULL, ADD sterilise VARCHAR(255) DEFAULT NULL, ADD date_sterilisation VARCHAR(255) DEFAULT NULL, ADD identification_type VARCHAR(255) DEFAULT NULL, ADD identification_numero VARCHAR(255) DEFAULT NULL, ADD veterinaire_nom VARCHAR(255) DEFAULT NULL, ADD clinique VARCHAR(255) DEFAULT NULL, ADD financement_type VARCHAR(255) DEFAULT NULL, ADD financement_autre VARCHAR(255) DEFAULT NULL, ADD nom_attribue VARCHAR(255) DEFAULT NULL, ADD sexe VARCHAR(255) DEFAULT NULL, ADD age_approx VARCHAR(255) DEFAULT NULL, ADD couleur_robe VARCHAR(255) DEFAULT NULL, ADD type_pelage VARCHAR(255) DEFAULT NULL, ADD couleur_yeux VARCHAR(255) DEFAULT NULL, ADD signes_particuliers LONGTEXT DEFAULT NULL, ADD photo VARCHAR(255) DEFAULT NULL, ADD photo_reference VARCHAR(255) DEFAULT NULL, ADD etat_general VARCHAR(255) DEFAULT NULL, ADD comportement VARCHAR(255) DEFAULT NULL, ADD observations LONGTEXT DEFAULT NULL, ADD orientation VARCHAR(255) DEFAULT NULL, ADD lieu_relachement VARCHAR(255) DEFAULT NULL, ADD date_relachement VARCHAR(255) DEFAULT NULL, ADD etat_avancement JSON NOT NULL, ADD nom_trappeur VARCHAR(255) DEFAULT NULL, ADD association_collectif VARCHAR(255) DEFAULT NULL, ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE fiche_maison ADD nom VARCHAR(255) NOT NULL, ADD adresse VARCHAR(255) DEFAULT NULL, ADD commentaire LONGTEXT DEFAULT NULL, ADD latitude DOUBLE PRECISION NOT NULL, ADD longitude DOUBLE PRECISION NOT NULL, ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fiche_chat DROP latitude, DROP longitude, DROP dossier_numero, DROP trappage_date, DROP trappage_heure, DROP adresse_precise, DROP commune, DROP type_lieu, DROP autre_type_lieu, DROP nom_entreprise_particulier, DROP trappage_telephone, DROP colonie_site, DROP signalement_nom, DROP signalement_telephone, DROP signalement_email, DROP statut_chat, DROP proprietaire_nom, DROP proprietaire_adresse, DROP proprietaire_telephone, DROP chat_nourri, DROP nourrissage_type, DROP nourrisseur_nom, DROP nourrisseur_telephone, DROP sterilise, DROP date_sterilisation, DROP identification_type, DROP identification_numero, DROP veterinaire_nom, DROP clinique, DROP financement_type, DROP financement_autre, DROP nom_attribue, DROP sexe, DROP age_approx, DROP couleur_robe, DROP type_pelage, DROP couleur_yeux, DROP signes_particuliers, DROP photo, DROP photo_reference, DROP etat_general, DROP comportement, DROP observations, DROP orientation, DROP lieu_relachement, DROP date_relachement, DROP etat_avancement, DROP nom_trappeur, DROP association_collectif, DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE fiche_maison DROP nom, DROP adresse, DROP commentaire, DROP latitude, DROP longitude, DROP created_at, DROP updated_at');
    }
}
