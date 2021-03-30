<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210330215548 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE result ADD repartition1 DOUBLE PRECISION NOT NULL, DROP repartititon1, CHANGE beta beta DOUBLE PRECISION NOT NULL, CHANGE pi pi DOUBLE PRECISION NOT NULL, CHANGE mu mu DOUBLE PRECISION NOT NULL, CHANGE s s DOUBLE PRECISION NOT NULL, CHANGE u u DOUBLE PRECISION NOT NULL, CHANGE p p DOUBLE PRECISION NOT NULL, CHANGE ru ru DOUBLE PRECISION NOT NULL, CHANGE rp rp DOUBLE PRECISION NOT NULL, CHANGE repartition2 repartition2 DOUBLE PRECISION NOT NULL, CHANGE repartition3 repartition3 DOUBLE PRECISION NOT NULL, CHANGE repartition4 repartition4 DOUBLE PRECISION NOT NULL, CHANGE temps temps INT NOT NULL, CHANGE proportioninitiale proportioninitiale DOUBLE PRECISION NOT NULL, CHANGE idutilisateur idutilisateur INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE result ADD repartititon1 DOUBLE PRECISION DEFAULT NULL, DROP repartition1, CHANGE beta beta DOUBLE PRECISION DEFAULT NULL, CHANGE pi pi DOUBLE PRECISION DEFAULT NULL, CHANGE mu mu DOUBLE PRECISION DEFAULT NULL, CHANGE s s DOUBLE PRECISION DEFAULT NULL, CHANGE u u DOUBLE PRECISION DEFAULT NULL, CHANGE p p DOUBLE PRECISION DEFAULT NULL, CHANGE ru ru DOUBLE PRECISION DEFAULT NULL, CHANGE rp rp DOUBLE PRECISION DEFAULT NULL, CHANGE repartition2 repartition2 DOUBLE PRECISION DEFAULT NULL, CHANGE repartition3 repartition3 DOUBLE PRECISION DEFAULT NULL, CHANGE repartition4 repartition4 DOUBLE PRECISION DEFAULT NULL, CHANGE temps temps INT DEFAULT NULL, CHANGE proportioninitiale proportioninitiale DOUBLE PRECISION DEFAULT NULL, CHANGE idutilisateur idutilisateur INT DEFAULT NULL');
    }
}
