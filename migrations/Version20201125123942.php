<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201125123942 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE project_job (project_id INT NOT NULL, job_id INT NOT NULL, INDEX IDX_69A33A1B166D1F9C (project_id), INDEX IDX_69A33A1BBE04EA9 (job_id), PRIMARY KEY(project_id, job_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project_fav (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, project_id INT NOT NULL, INDEX IDX_E4E03A8CA76ED395 (user_id), INDEX IDX_E4E03A8C166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_fav (id INT AUTO_INCREMENT NOT NULL, user_liked_id INT NOT NULL, user_like_id INT NOT NULL, INDEX IDX_9D8D81E4260FC79 (user_liked_id), INDEX IDX_9D8D81E4DD96E438 (user_like_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE project_job ADD CONSTRAINT FK_69A33A1B166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project_job ADD CONSTRAINT FK_69A33A1BBE04EA9 FOREIGN KEY (job_id) REFERENCES job (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project_fav ADD CONSTRAINT FK_E4E03A8CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE project_fav ADD CONSTRAINT FK_E4E03A8C166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE user_fav ADD CONSTRAINT FK_9D8D81E4260FC79 FOREIGN KEY (user_liked_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_fav ADD CONSTRAINT FK_9D8D81E4DD96E438 FOREIGN KEY (user_like_id) REFERENCES user (id)');
        $this->addSql('DROP TABLE fav_project');
        $this->addSql('ALTER TABLE logbook ADD project_id INT DEFAULT NULL, ADD user_id INT DEFAULT NULL, CHANGE task task LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE logbook ADD CONSTRAINT FK_E96B9310166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE logbook ADD CONSTRAINT FK_E96B9310A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_E96B9310166D1F9C ON logbook (project_id)');
        $this->addSql('CREATE INDEX IDX_E96B9310A76ED395 ON logbook (user_id)');
        $this->addSql('ALTER TABLE message ADD project_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('CREATE INDEX IDX_B6BD307F166D1F9C ON message (project_id)');
        $this->addSql('ALTER TABLE project DROP owner_participes');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649D9F966B');
        $this->addSql('DROP INDEX UNIQ_8D93D649D9F966B ON user');
        $this->addSql('ALTER TABLE user DROP description_id');
        $this->addSql('ALTER TABLE user_description CHANGE user_id user_id INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE fav_project (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, project_id INT NOT NULL, INDEX IDX_50A3D67C166D1F9C (project_id), INDEX IDX_50A3D67CA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE fav_project ADD CONSTRAINT FK_50A3D67C166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE fav_project ADD CONSTRAINT FK_50A3D67CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('DROP TABLE project_job');
        $this->addSql('DROP TABLE project_fav');
        $this->addSql('DROP TABLE user_fav');
        $this->addSql('ALTER TABLE logbook DROP FOREIGN KEY FK_E96B9310166D1F9C');
        $this->addSql('ALTER TABLE logbook DROP FOREIGN KEY FK_E96B9310A76ED395');
        $this->addSql('DROP INDEX IDX_E96B9310166D1F9C ON logbook');
        $this->addSql('DROP INDEX IDX_E96B9310A76ED395 ON logbook');
        $this->addSql('ALTER TABLE logbook DROP project_id, DROP user_id, CHANGE task task VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F166D1F9C');
        $this->addSql('DROP INDEX IDX_B6BD307F166D1F9C ON message');
        $this->addSql('ALTER TABLE message DROP project_id');
        $this->addSql('ALTER TABLE project ADD owner_participes TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE user ADD description_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649D9F966B FOREIGN KEY (description_id) REFERENCES user_description (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649D9F966B ON user (description_id)');
        $this->addSql('ALTER TABLE user_description CHANGE user_id user_id INT DEFAULT NULL');
    }
}
