<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210808121300 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE attributes (id INT AUTO_INCREMENT NOT NULL, attribute VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE flower_attribute (id INT AUTO_INCREMENT NOT NULL, flower_id INT NOT NULL, attribute_id INT NOT NULL, value VARCHAR(255) NOT NULL, INDEX IDX_DEBDD4882C09D409 (flower_id), INDEX IDX_DEBDD488B6E62EFA (attribute_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE flower_attribute ADD CONSTRAINT FK_DEBDD4882C09D409 FOREIGN KEY (flower_id) REFERENCES flowers (id)');
        $this->addSql('ALTER TABLE flower_attribute ADD CONSTRAINT FK_DEBDD488B6E62EFA FOREIGN KEY (attribute_id) REFERENCES attributes (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE flower_attribute DROP FOREIGN KEY FK_DEBDD488B6E62EFA');
        $this->addSql('DROP TABLE attributes');
        $this->addSql('DROP TABLE flower_attribute');
    }
}
