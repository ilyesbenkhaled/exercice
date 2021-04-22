<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210421233628 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pointage ADD chantier_pointage_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pointage ADD CONSTRAINT FK_7591B20FA2520DF FOREIGN KEY (chantier_pointage_id) REFERENCES chantier (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7591B20FA2520DF ON pointage (chantier_pointage_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pointage DROP FOREIGN KEY FK_7591B20FA2520DF');
        $this->addSql('DROP INDEX UNIQ_7591B20FA2520DF ON pointage');
        $this->addSql('ALTER TABLE pointage DROP chantier_pointage_id');
    }
}
