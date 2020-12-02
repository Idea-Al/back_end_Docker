<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201125171654 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE complaint DROP FOREIGN KEY FK_5F2732B54B322924');
        $this->addSql('DROP INDEX IDX_5F2732B54B322924 ON complaint');
        $this->addSql('ALTER TABLE complaint DROP user_report_id, CHANGE reason name LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE user_report ADD reason_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_report ADD CONSTRAINT FK_A17D6CB959BB1592 FOREIGN KEY (reason_id) REFERENCES complaint (id)');
        $this->addSql('CREATE INDEX IDX_A17D6CB959BB1592 ON user_report (reason_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE complaint ADD user_report_id INT DEFAULT NULL, CHANGE name reason LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE complaint ADD CONSTRAINT FK_5F2732B54B322924 FOREIGN KEY (user_report_id) REFERENCES user_report (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_5F2732B54B322924 ON complaint (user_report_id)');
        $this->addSql('ALTER TABLE user_report DROP FOREIGN KEY FK_A17D6CB959BB1592');
        $this->addSql('DROP INDEX IDX_A17D6CB959BB1592 ON user_report');
        $this->addSql('ALTER TABLE user_report DROP reason_id');
    }
}
