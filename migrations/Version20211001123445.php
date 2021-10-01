<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211001123445 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE etat_exp CHANGE test11 test11 DOUBLE PRECISION NOT NULL, CHANGE test12 test12 DOUBLE PRECISION NOT NULL, CHANGE test21 test21 DOUBLE PRECISION NOT NULL, CHANGE test22 test22 DOUBLE PRECISION NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE `etat_exp` CHANGE `test11` `test11` DOUBLE NULL, CHANGE `test12` `test12` DOUBLE NULL, CHANGE `test21` `test21` DOUBLE NULL, CHANGE `test22` `test22` DOUBLE NULL;');
    }
}
