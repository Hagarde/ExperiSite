<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210504112733 extends AbstractMigration
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
        $this->addSql('ALTER TABLE resume ADD acc TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE etat_exp CHANGE test11 test11 DOUBLE PRECISION DEFAULT NULL, CHANGE test12 test12 DOUBLE PRECISION DEFAULT NULL, CHANGE test21 test21 DOUBLE PRECISION DEFAULT NULL, CHANGE test22 test22 DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE resume DROP acc');
    }
}
