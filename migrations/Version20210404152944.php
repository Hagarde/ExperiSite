<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210404152944 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        $this->addSql('ALTER TABLE `etat_exp` CHANGE `test11` `test11` DOUBLE NULL');
        $this->addSql('ALTER TABLE `etat_exp` CHANGE `test12` `test12` DOUBLE NULL');
        $this->addSql('ALTER TABLE `etat_exp` CHANGE `test21` `test21` DOUBLE NULL');
        $this->addSql('ALTER TABLE `etat_exp` CHANGE `test22` `test22` DOUBLE NULL');
        $this->addSql('ALTER TABLE resume ADD influence12 DOUBLE PRECISION NOT NULL, ADD influence13 DOUBLE PRECISION NOT NULL, ADD influence14 DOUBLE PRECISION NOT NULL, ADD influence23 DOUBLE PRECISION NOT NULL, ADD influence24 DOUBLE PRECISION NOT NULL, ADD influence34 DOUBLE PRECISION NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE resume DROP influence12, DROP influence13, DROP influence14, DROP influence23, DROP influence24, DROP influence34');
    }
}
