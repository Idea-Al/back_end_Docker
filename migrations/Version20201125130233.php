<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201125130233 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EED9F966B');
        $this->addSql('DROP INDEX UNIQ_2FB3D0EED9F966B ON project');
        $this->addSql('ALTER TABLE project DROP description_id');
        $this->addSql('ALTER TABLE project_description CHANGE project_id project_id INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project ADD description_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EED9F966B FOREIGN KEY (description_id) REFERENCES project_description (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2FB3D0EED9F966B ON project (description_id)');
        $this->addSql('ALTER TABLE project_description CHANGE project_id project_id INT DEFAULT NULL');
    }
}
