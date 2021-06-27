<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210627092853 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE journal (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(120) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE publisher (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(80) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE publication ADD city_id INT DEFAULT NULL, ADD publisher_id INT DEFAULT NULL, ADD pages INT DEFAULT NULL');
        $this->addSql('ALTER TABLE publication ADD CONSTRAINT FK_AF3C67798BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE publication ADD CONSTRAINT FK_AF3C677940C86FCE FOREIGN KEY (publisher_id) REFERENCES publisher (id)');
        $this->addSql('CREATE INDEX IDX_AF3C67798BAC62AF ON publication (city_id)');
        $this->addSql('CREATE INDEX IDX_AF3C677940C86FCE ON publication (publisher_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE publication DROP FOREIGN KEY FK_AF3C67798BAC62AF');
        $this->addSql('ALTER TABLE publication DROP FOREIGN KEY FK_AF3C677940C86FCE');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE journal');
        $this->addSql('DROP TABLE publisher');
        $this->addSql('DROP INDEX IDX_AF3C67798BAC62AF ON publication');
        $this->addSql('DROP INDEX IDX_AF3C677940C86FCE ON publication');
        $this->addSql('ALTER TABLE publication DROP city_id, DROP publisher_id, DROP pages');
    }
}
