<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201201132921 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE complaint (id INT AUTO_INCREMENT NOT NULL, name LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE learning (id INT AUTO_INCREMENT NOT NULL, techno_id INT NOT NULL, user_id INT NOT NULL, level_id INT NOT NULL, INDEX IDX_CF05A4C251F3C1BC (techno_id), INDEX IDX_CF05A4C2A76ED395 (user_id), INDEX IDX_CF05A4C25FB14BA7 (level_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE level (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE logbook (id INT AUTO_INCREMENT NOT NULL, project_id INT DEFAULT NULL, user_id INT DEFAULT NULL, task LONGTEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_E96B9310166D1F9C (project_id), INDEX IDX_E96B9310A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, sender_id INT NOT NULL, receiver_id INT NOT NULL, project_id INT DEFAULT NULL, text LONGTEXT NOT NULL, INDEX IDX_B6BD307FF624B39D (sender_id), INDEX IDX_B6BD307FCD53EDB6 (receiver_id), INDEX IDX_B6BD307F166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, resume LONGTEXT NOT NULL, max_participant INT NOT NULL, is_moderated TINYINT(1) NOT NULL, picture VARCHAR(255) DEFAULT NULL, link VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, is_completed TINYINT(1) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project_techno (project_id INT NOT NULL, techno_id INT NOT NULL, INDEX IDX_2E230596166D1F9C (project_id), INDEX IDX_2E23059651F3C1BC (techno_id), PRIMARY KEY(project_id, techno_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project_job (project_id INT NOT NULL, job_id INT NOT NULL, INDEX IDX_69A33A1B166D1F9C (project_id), INDEX IDX_69A33A1BBE04EA9 (job_id), PRIMARY KEY(project_id, job_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project_description (id INT AUTO_INCREMENT NOT NULL, project_id INT NOT NULL, purpose LONGTEXT NOT NULL, target LONGTEXT NOT NULL, learning_skill LONGTEXT NOT NULL, UNIQUE INDEX UNIQ_A52BB7DD166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project_fav (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, project_id INT NOT NULL, INDEX IDX_E4E03A8CA76ED395 (user_id), INDEX IDX_E4E03A8C166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE realization (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, screen VARCHAR(255) NOT NULL, screen2 VARCHAR(255) DEFAULT NULL, repo_link VARCHAR(255) DEFAULT NULL, website_link VARCHAR(255) DEFAULT NULL, INDEX IDX_CDAA30C6A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE realization_techno (realization_id INT NOT NULL, techno_id INT NOT NULL, INDEX IDX_D5B315AF1A26530A (realization_id), INDEX IDX_D5B315AF51F3C1BC (techno_id), PRIMARY KEY(realization_id, techno_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rhythm (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE techno (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, logo VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, role_id INT NOT NULL, job_id INT NOT NULL, rhythm_id INT DEFAULT NULL, username VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, avatar VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, school VARCHAR(255) DEFAULT NULL, status TINYINT(1) NOT NULL, is_active TINYINT(1) NOT NULL, is_banned TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, slug VARCHAR(255) NOT NULL, INDEX IDX_8D93D649D60322AC (role_id), INDEX IDX_8D93D649BE04EA9 (job_id), INDEX IDX_8D93D6492B1F91AC (rhythm_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_description (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, journey VARCHAR(255) NOT NULL, purpose LONGTEXT NOT NULL, about_me LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_C4FF89B3A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_fav (id INT AUTO_INCREMENT NOT NULL, user_liked_id INT NOT NULL, user_like_id INT NOT NULL, INDEX IDX_9D8D81E4260FC79 (user_liked_id), INDEX IDX_9D8D81E4DD96E438 (user_like_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_friend (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, friend_id INT DEFAULT NULL, is_answered TINYINT(1) NOT NULL, is_accepted TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_30BCB75CA76ED395 (user_id), INDEX IDX_30BCB75C6A5458E8 (friend_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_report (id INT AUTO_INCREMENT NOT NULL, reporter_id INT NOT NULL, reportee_id INT NOT NULL, reason_id INT DEFAULT NULL, custom_reason LONGTEXT DEFAULT NULL, screen VARCHAR(255) DEFAULT NULL, screen2 VARCHAR(255) DEFAULT NULL, is_confirmed TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_A17D6CB9E1CFE6F5 (reporter_id), INDEX IDX_A17D6CB92C0189D3 (reportee_id), INDEX IDX_A17D6CB959BB1592 (reason_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE learning ADD CONSTRAINT FK_CF05A4C251F3C1BC FOREIGN KEY (techno_id) REFERENCES techno (id)');
        $this->addSql('ALTER TABLE learning ADD CONSTRAINT FK_CF05A4C2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE learning ADD CONSTRAINT FK_CF05A4C25FB14BA7 FOREIGN KEY (level_id) REFERENCES level (id)');
        $this->addSql('ALTER TABLE logbook ADD CONSTRAINT FK_E96B9310166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE logbook ADD CONSTRAINT FK_E96B9310A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FF624B39D FOREIGN KEY (sender_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FCD53EDB6 FOREIGN KEY (receiver_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE project_techno ADD CONSTRAINT FK_2E230596166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project_techno ADD CONSTRAINT FK_2E23059651F3C1BC FOREIGN KEY (techno_id) REFERENCES techno (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project_job ADD CONSTRAINT FK_69A33A1B166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project_job ADD CONSTRAINT FK_69A33A1BBE04EA9 FOREIGN KEY (job_id) REFERENCES job (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project_description ADD CONSTRAINT FK_A52BB7DD166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE project_fav ADD CONSTRAINT FK_E4E03A8CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE project_fav ADD CONSTRAINT FK_E4E03A8C166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE realization ADD CONSTRAINT FK_CDAA30C6A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE realization_techno ADD CONSTRAINT FK_D5B315AF1A26530A FOREIGN KEY (realization_id) REFERENCES realization (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE realization_techno ADD CONSTRAINT FK_D5B315AF51F3C1BC FOREIGN KEY (techno_id) REFERENCES techno (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649D60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649BE04EA9 FOREIGN KEY (job_id) REFERENCES job (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6492B1F91AC FOREIGN KEY (rhythm_id) REFERENCES rhythm (id)');
        $this->addSql('ALTER TABLE user_description ADD CONSTRAINT FK_C4FF89B3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_fav ADD CONSTRAINT FK_9D8D81E4260FC79 FOREIGN KEY (user_liked_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_fav ADD CONSTRAINT FK_9D8D81E4DD96E438 FOREIGN KEY (user_like_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_friend ADD CONSTRAINT FK_30BCB75CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_friend ADD CONSTRAINT FK_30BCB75C6A5458E8 FOREIGN KEY (friend_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_report ADD CONSTRAINT FK_A17D6CB9E1CFE6F5 FOREIGN KEY (reporter_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_report ADD CONSTRAINT FK_A17D6CB92C0189D3 FOREIGN KEY (reportee_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_report ADD CONSTRAINT FK_A17D6CB959BB1592 FOREIGN KEY (reason_id) REFERENCES complaint (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_report DROP FOREIGN KEY FK_A17D6CB959BB1592');
        $this->addSql('ALTER TABLE project_job DROP FOREIGN KEY FK_69A33A1BBE04EA9');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649BE04EA9');
        $this->addSql('ALTER TABLE learning DROP FOREIGN KEY FK_CF05A4C25FB14BA7');
        $this->addSql('ALTER TABLE logbook DROP FOREIGN KEY FK_E96B9310166D1F9C');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F166D1F9C');
        $this->addSql('ALTER TABLE project_techno DROP FOREIGN KEY FK_2E230596166D1F9C');
        $this->addSql('ALTER TABLE project_job DROP FOREIGN KEY FK_69A33A1B166D1F9C');
        $this->addSql('ALTER TABLE project_description DROP FOREIGN KEY FK_A52BB7DD166D1F9C');
        $this->addSql('ALTER TABLE project_fav DROP FOREIGN KEY FK_E4E03A8C166D1F9C');
        $this->addSql('ALTER TABLE realization_techno DROP FOREIGN KEY FK_D5B315AF1A26530A');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6492B1F91AC');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649D60322AC');
        $this->addSql('ALTER TABLE learning DROP FOREIGN KEY FK_CF05A4C251F3C1BC');
        $this->addSql('ALTER TABLE project_techno DROP FOREIGN KEY FK_2E23059651F3C1BC');
        $this->addSql('ALTER TABLE realization_techno DROP FOREIGN KEY FK_D5B315AF51F3C1BC');
        $this->addSql('ALTER TABLE learning DROP FOREIGN KEY FK_CF05A4C2A76ED395');
        $this->addSql('ALTER TABLE logbook DROP FOREIGN KEY FK_E96B9310A76ED395');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FF624B39D');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FCD53EDB6');
        $this->addSql('ALTER TABLE project_fav DROP FOREIGN KEY FK_E4E03A8CA76ED395');
        $this->addSql('ALTER TABLE realization DROP FOREIGN KEY FK_CDAA30C6A76ED395');
        $this->addSql('ALTER TABLE user_description DROP FOREIGN KEY FK_C4FF89B3A76ED395');
        $this->addSql('ALTER TABLE user_fav DROP FOREIGN KEY FK_9D8D81E4260FC79');
        $this->addSql('ALTER TABLE user_fav DROP FOREIGN KEY FK_9D8D81E4DD96E438');
        $this->addSql('ALTER TABLE user_friend DROP FOREIGN KEY FK_30BCB75CA76ED395');
        $this->addSql('ALTER TABLE user_friend DROP FOREIGN KEY FK_30BCB75C6A5458E8');
        $this->addSql('ALTER TABLE user_report DROP FOREIGN KEY FK_A17D6CB9E1CFE6F5');
        $this->addSql('ALTER TABLE user_report DROP FOREIGN KEY FK_A17D6CB92C0189D3');
        $this->addSql('DROP TABLE complaint');
        $this->addSql('DROP TABLE job');
        $this->addSql('DROP TABLE learning');
        $this->addSql('DROP TABLE level');
        $this->addSql('DROP TABLE logbook');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE project_techno');
        $this->addSql('DROP TABLE project_job');
        $this->addSql('DROP TABLE project_description');
        $this->addSql('DROP TABLE project_fav');
        $this->addSql('DROP TABLE realization');
        $this->addSql('DROP TABLE realization_techno');
        $this->addSql('DROP TABLE rhythm');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE techno');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_description');
        $this->addSql('DROP TABLE user_fav');
        $this->addSql('DROP TABLE user_friend');
        $this->addSql('DROP TABLE user_report');
    }
}
