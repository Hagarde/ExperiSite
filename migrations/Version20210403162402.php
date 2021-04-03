<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210403162402 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE etat_exp (id INT AUTO_INCREMENT NOT NULL, s1 DOUBLE PRECISION NOT NULL, s2 DOUBLE PRECISION NOT NULL, s3 DOUBLE PRECISION NOT NULL, s4 DOUBLE PRECISION NOT NULL, p1 DOUBLE PRECISION NOT NULL, p2 DOUBLE PRECISION NOT NULL, p3 DOUBLE PRECISION NOT NULL, p4 DOUBLE PRECISION NOT NULL, u1 DOUBLE PRECISION NOT NULL, u2 DOUBLE PRECISION NOT NULL, u3 DOUBLE PRECISION NOT NULL, u4 DOUBLE PRECISION NOT NULL, rp1 DOUBLE PRECISION NOT NULL, rp2 DOUBLE PRECISION NOT NULL, rp3 DOUBLE PRECISION NOT NULL, rp4 DOUBLE PRECISION NOT NULL, ru1 DOUBLE PRECISION NOT NULL, ru2 DOUBLE PRECISION NOT NULL, ru3 DOUBLE PRECISION NOT NULL, ru4 DOUBLE PRECISION NOT NULL, test11 DOUBLE PRECISION NOT NULL, test12 DOUBLE PRECISION NOT NULL, test21 DOUBLE PRECISION NOT NULL, test22 DOUBLE PRECISION NOT NULL, t INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE resume (id INT AUTO_INCREMENT NOT NULL, r0 DOUBLE PRECISION NOT NULL, pi DOUBLE PRECISION NOT NULL, mu DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE detail_exp (id INT AUTO_INCREMENT NOT NULL, identifiantexp_id INT NOT NULL, idexp INT DEFAULT NULL, s1 DOUBLE PRECISION NOT NULL, s2 DOUBLE PRECISION NOT NULL, s3 DOUBLE PRECISION NOT NULL, s4 DOUBLE PRECISION NOT NULL, u1 DOUBLE PRECISION NOT NULL, u2 DOUBLE PRECISION NOT NULL, u3 DOUBLE PRECISION NOT NULL, u4 DOUBLE PRECISION NOT NULL, p1 DOUBLE PRECISION NOT NULL, p2 DOUBLE PRECISION NOT NULL, p3 DOUBLE PRECISION NOT NULL, p4 DOUBLE PRECISION NOT NULL, ru1 DOUBLE PRECISION NOT NULL, ru2 DOUBLE PRECISION NOT NULL, ru3 DOUBLE PRECISION NOT NULL, ru4 DOUBLE PRECISION NOT NULL, rp1 DOUBLE PRECISION NOT NULL, rp2 DOUBLE PRECISION NOT NULL, rp3 DOUBLE PRECISION NOT NULL, rp4 DOUBLE PRECISION NOT NULL, t INT NOT NULL, repartition1 DOUBLE PRECISION NOT NULL, repartition2 DOUBLE PRECISION NOT NULL, repartition3 DOUBLE PRECISION NOT NULL, repartition4 DOUBLE PRECISION NOT NULL, INDEX IDX_3101808FAFECABEA (identifiantexp_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE resume_experience (id INT AUTO_INCREMENT NOT NULL, r0 DOUBLE PRECISION NOT NULL, pi DOUBLE PRECISION NOT NULL, mu DOUBLE PRECISION NOT NULL, i0 DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE detail_exp ADD CONSTRAINT FK_3101808FAFECABEA FOREIGN KEY (identifiantexp_id) REFERENCES resume_experience (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('DROP TABLE etat_exp');
        $this->addSql('DROP TABLE resume');
    }
}
