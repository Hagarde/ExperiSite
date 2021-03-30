<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210330161119 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE result (id INT AUTO_INCREMENT NOT NULL, beta DOUBLE PRECISION DEFAULT NULL, pi DOUBLE PRECISION DEFAULT NULL, mu DOUBLE PRECISION DEFAULT NULL, s DOUBLE PRECISION DEFAULT NULL, u DOUBLE PRECISION DEFAULT NULL, p DOUBLE PRECISION DEFAULT NULL, ru DOUBLE PRECISION DEFAULT NULL, rp DOUBLE PRECISION DEFAULT NULL, repartititon1 DOUBLE PRECISION DEFAULT NULL, repartition2 DOUBLE PRECISION DEFAULT NULL, repartition3 DOUBLE PRECISION DEFAULT NULL, repartition4 DOUBLE PRECISION DEFAULT NULL, temps INT DEFAULT NULL, proportioninitiale DOUBLE PRECISION DEFAULT NULL, idutilisateur INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE result');
    }
}
