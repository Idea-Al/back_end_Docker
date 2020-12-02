<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201120143741 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE learning ADD level_id INT NOT NULL');
        $this->addSql('ALTER TABLE learning ADD CONSTRAINT FK_CF05A4C25FB14BA7 FOREIGN KEY (level_id) REFERENCES level (id)');
        $this->addSql('CREATE INDEX IDX_CF05A4C25FB14BA7 ON learning (level_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE learning DROP FOREIGN KEY FK_CF05A4C25FB14BA7');
        $this->addSql('DROP INDEX IDX_CF05A4C25FB14BA7 ON learning');
        $this->addSql('ALTER TABLE learning DROP level_id');
    }
}
