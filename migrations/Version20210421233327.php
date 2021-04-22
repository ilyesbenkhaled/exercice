<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210421233327 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE help (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pointage ADD matricule_utilisateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pointage ADD CONSTRAINT FK_7591B20C100C192 FOREIGN KEY (matricule_utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_7591B20C100C192 ON pointage (matricule_utilisateur_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE help');
        $this->addSql('ALTER TABLE pointage DROP FOREIGN KEY FK_7591B20C100C192');
        $this->addSql('DROP INDEX IDX_7591B20C100C192 ON pointage');
        $this->addSql('ALTER TABLE pointage DROP matricule_utilisateur_id');
    }
}
