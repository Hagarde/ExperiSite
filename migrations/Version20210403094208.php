<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210403094208 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE detail_exp ADD identifiantexp_id INT NOT NULL');
        $this->addSql('ALTER TABLE detail_exp ADD CONSTRAINT FK_3101808FAFECABEA FOREIGN KEY (identifiantexp_id) REFERENCES resume_experience (id)');
        $this->addSql('CREATE INDEX IDX_3101808FAFECABEA ON detail_exp (identifiantexp_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE detail_exp DROP FOREIGN KEY FK_3101808FAFECABEA');
        $this->addSql('DROP INDEX IDX_3101808FAFECABEA ON detail_exp');
        $this->addSql('ALTER TABLE detail_exp DROP identifiantexp_id');
    }
}
