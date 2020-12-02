<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201120133150 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE fav_project (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, project_id INT NOT NULL, INDEX IDX_50A3D67CA76ED395 (user_id), INDEX IDX_50A3D67C166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fav_project ADD CONSTRAINT FK_50A3D67CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE fav_project ADD CONSTRAINT FK_50A3D67C166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE project ADD description_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EED9F966B FOREIGN KEY (description_id) REFERENCES project_description (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2FB3D0EED9F966B ON project (description_id)');
        $this->addSql('ALTER TABLE project_description ADD project_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE project_description ADD CONSTRAINT FK_A52BB7DD166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A52BB7DD166D1F9C ON project_description (project_id)');
        $this->addSql('ALTER TABLE user ADD description_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649D9F966B FOREIGN KEY (description_id) REFERENCES user_description (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649D9F966B ON user (description_id)');
        $this->addSql('ALTER TABLE user_description ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_description ADD CONSTRAINT FK_C4FF89B3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C4FF89B3A76ED395 ON user_description (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE fav_project');
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EED9F966B');
        $this->addSql('DROP INDEX UNIQ_2FB3D0EED9F966B ON project');
        $this->addSql('ALTER TABLE project DROP description_id');
        $this->addSql('ALTER TABLE project_description DROP FOREIGN KEY FK_A52BB7DD166D1F9C');
        $this->addSql('DROP INDEX UNIQ_A52BB7DD166D1F9C ON project_description');
        $this->addSql('ALTER TABLE project_description DROP project_id');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649D9F966B');
        $this->addSql('DROP INDEX UNIQ_8D93D649D9F966B ON user');
        $this->addSql('ALTER TABLE user DROP description_id');
        $this->addSql('ALTER TABLE user_description DROP FOREIGN KEY FK_C4FF89B3A76ED395');
        $this->addSql('DROP INDEX UNIQ_C4FF89B3A76ED395 ON user_description');
        $this->addSql('ALTER TABLE user_description DROP user_id');
    }
}
