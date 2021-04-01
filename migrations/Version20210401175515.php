<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210401175515 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE result ADD s1 DOUBLE PRECISION NOT NULL, ADD u1 DOUBLE PRECISION NOT NULL, ADD p1 DOUBLE PRECISION NOT NULL, ADD ru1 DOUBLE PRECISION NOT NULL, ADD rp1 DOUBLE PRECISION NOT NULL, ADD s2 DOUBLE PRECISION NOT NULL, ADD u2 DOUBLE PRECISION NOT NULL, ADD rp2 DOUBLE PRECISION NOT NULL, ADD ru2 DOUBLE PRECISION NOT NULL, ADD s3 DOUBLE PRECISION NOT NULL, ADD u3 DOUBLE PRECISION NOT NULL, ADD p3 DOUBLE PRECISION NOT NULL, ADD p2 DOUBLE PRECISION NOT NULL, ADD ru3 DOUBLE PRECISION NOT NULL, ADD rp3 DOUBLE PRECISION NOT NULL, ADD s4 DOUBLE PRECISION NOT NULL, ADD u4 DOUBLE PRECISION NOT NULL, ADD p4 DOUBLE PRECISION NOT NULL, ADD ru4 DOUBLE PRECISION NOT NULL, ADD rp4 DOUBLE PRECISION NOT NULL, DROP s, DROP u, DROP p, DROP ru, DROP rp, DROP idexperience_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE result ADD s DOUBLE PRECISION NOT NULL, ADD u DOUBLE PRECISION NOT NULL, ADD p DOUBLE PRECISION NOT NULL, ADD ru DOUBLE PRECISION NOT NULL, ADD rp DOUBLE PRECISION NOT NULL, ADD idexperience_id INT NOT NULL, DROP s1, DROP u1, DROP p1, DROP ru1, DROP rp1, DROP s2, DROP u2, DROP rp2, DROP ru2, DROP s3, DROP u3, DROP p3, DROP p2, DROP ru3, DROP rp3, DROP s4, DROP u4, DROP p4, DROP ru4, DROP rp4');
    }
}
