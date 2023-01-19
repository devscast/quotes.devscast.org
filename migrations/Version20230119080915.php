<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230119080915 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Création de l\entitté Citation';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE citation ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE authors_id authors_id INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE citation DROP created_at, CHANGE authors_id authors_id INT DEFAULT NULL');
    }
}
