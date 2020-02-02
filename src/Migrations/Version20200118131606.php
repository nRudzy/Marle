<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200118131606 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE taxonomie_id_taxonomie_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE reprographie_id_reprographie_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE docsat_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE satellite_id_satellite_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE document_id_document_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE contient_doc_id_contientDocs_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE taxonomie (id_taxonomie INT NOT NULL, codeTaxonomie VARCHAR(10) NOT NULL, libelle VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id_taxonomie))');
        $this->addSql('CREATE TABLE reprographie (id_reprographie INT NOT NULL, id_taxonomie INT DEFAULT NULL, nni VARCHAR(10) DEFAULT NULL, nni_valideur_doc VARCHAR(10) DEFAULT NULL, titre VARCHAR(255) NOT NULL, numeroReprographie VARCHAR(100) NOT NULL, typeDocument VARCHAR(255) NOT NULL, dateDemande TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deadline TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deadline_old TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, moment_journee VARCHAR(100) DEFAULT NULL, est_urgence BOOLEAN NOT NULL, lieu_reception VARCHAR(100) NOT NULL, lieu_traitement VARCHAR(100) DEFAULT NULL, lieu_renvoie VARCHAR(100) DEFAULT NULL, service_demandeur VARCHAR(10) NOT NULL, motif_annulation TEXT DEFAULT NULL, observations TEXT DEFAULT NULL, filigrane VARCHAR(255) DEFAULT NULL, date_mise_en_place TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id_reprographie))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BB45C0C3B276A60A ON reprographie (numeroReprographie)');
        $this->addSql('CREATE INDEX IDX_BB45C0C37DB88A85 ON reprographie (id_taxonomie)');
        $this->addSql('CREATE INDEX IDX_BB45C0C37218A0ED ON reprographie (nni)');
        $this->addSql('CREATE INDEX IDX_BB45C0C388CE9873 ON reprographie (nni_valideur_doc)');
        $this->addSql('CREATE TABLE docsat (id INT NOT NULL, id_document INT DEFAULT NULL, id_satellite INT DEFAULT NULL, origine VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6D6F6D5488B266E3 ON docsat (id_document)');
        $this->addSql('CREATE INDEX IDX_6D6F6D54EFF29610 ON docsat (id_satellite)');
        $this->addSql('CREATE TABLE satellite (id_satellite INT NOT NULL, codeSatellite VARCHAR(10) NOT NULL, PRIMARY KEY(id_satellite))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6FC72A373A7795DF ON satellite (codeSatellite)');
        $this->addSql('CREATE TABLE utilisateur (nni VARCHAR(10) NOT NULL, nom VARCHAR(100) NOT NULL, prenom VARCHAR(100) NOT NULL, role VARCHAR(100) NOT NULL, PRIMARY KEY(nni))');
        $this->addSql('CREATE TABLE document (id_document INT NOT NULL, nomDocument VARCHAR(255) DEFAULT NULL, refDocument VARCHAR(255) NOT NULL, typeDocument VARCHAR(255) NOT NULL, id_contientDocs INT DEFAULT NULL, PRIMARY KEY(id_document))');
        $this->addSql('CREATE INDEX IDX_D8698A765E326263 ON document (id_contientDocs)');
        $this->addSql('CREATE TABLE contient_doc (id_reprographie INT DEFAULT NULL, id_contientDocs INT NOT NULL, nomDocument VARCHAR(255) DEFAULT NULL, refDocument VARCHAR(255) NOT NULL, indice VARCHAR(10) NOT NULL, typeDocument VARCHAR(255) NOT NULL, tampon VARCHAR(100) DEFAULT NULL, nb_exemplaire_a3 INT NOT NULL, nb_exemplaire_a4 INT NOT NULL, nb_exemplaire_a5 INT NOT NULL, nb_exemplaire_a0 INT NOT NULL, recto_verso VARCHAR(50) NOT NULL, support VARCHAR(50) NOT NULL, nb_trous VARCHAR(255) DEFAULT NULL, reliement VARCHAR(50) DEFAULT NULL, agrafes VARCHAR(255) DEFAULT NULL, pliure BOOLEAN NOT NULL, massicotage BOOLEAN NOT NULL, plastification BOOLEAN NOT NULL, couleur BOOLEAN NOT NULL, PRIMARY KEY(id_contientDocs))');
        $this->addSql('CREATE INDEX IDX_47BC77069884B5B1 ON contient_doc (id_reprographie)');
        $this->addSql('ALTER TABLE reprographie ADD CONSTRAINT FK_BB45C0C37DB88A85 FOREIGN KEY (id_taxonomie) REFERENCES taxonomie (id_taxonomie) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reprographie ADD CONSTRAINT FK_BB45C0C37218A0ED FOREIGN KEY (nni) REFERENCES utilisateur (nni) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reprographie ADD CONSTRAINT FK_BB45C0C388CE9873 FOREIGN KEY (nni_valideur_doc) REFERENCES utilisateur (nni) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE docsat ADD CONSTRAINT FK_6D6F6D5488B266E3 FOREIGN KEY (id_document) REFERENCES document (id_document) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE docsat ADD CONSTRAINT FK_6D6F6D54EFF29610 FOREIGN KEY (id_satellite) REFERENCES satellite (id_satellite) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A765E326263 FOREIGN KEY (id_contientDocs) REFERENCES contient_doc (id_contientDocs) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE contient_doc ADD CONSTRAINT FK_47BC77069884B5B1 FOREIGN KEY (id_reprographie) REFERENCES reprographie (id_reprographie) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE reprographie DROP CONSTRAINT FK_BB45C0C37DB88A85');
        $this->addSql('ALTER TABLE contient_doc DROP CONSTRAINT FK_47BC77069884B5B1');
        $this->addSql('ALTER TABLE docsat DROP CONSTRAINT FK_6D6F6D54EFF29610');
        $this->addSql('ALTER TABLE reprographie DROP CONSTRAINT FK_BB45C0C37218A0ED');
        $this->addSql('ALTER TABLE reprographie DROP CONSTRAINT FK_BB45C0C388CE9873');
        $this->addSql('ALTER TABLE docsat DROP CONSTRAINT FK_6D6F6D5488B266E3');
        $this->addSql('ALTER TABLE document DROP CONSTRAINT FK_D8698A765E326263');
        $this->addSql('DROP SEQUENCE taxonomie_id_taxonomie_seq CASCADE');
        $this->addSql('DROP SEQUENCE reprographie_id_reprographie_seq CASCADE');
        $this->addSql('DROP SEQUENCE docsat_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE satellite_id_satellite_seq CASCADE');
        $this->addSql('DROP SEQUENCE document_id_document_seq CASCADE');
        $this->addSql('DROP SEQUENCE contient_doc_id_contientDocs_seq CASCADE');
        $this->addSql('DROP TABLE taxonomie');
        $this->addSql('DROP TABLE reprographie');
        $this->addSql('DROP TABLE docsat');
        $this->addSql('DROP TABLE satellite');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE document');
        $this->addSql('DROP TABLE contient_doc');
    }
}
