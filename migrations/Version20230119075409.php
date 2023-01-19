<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230119075409 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Relation entre Citation et Author';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE citation ADD authors_id INT NULL');
        $this->addSql('ALTER TABLE citation ADD CONSTRAINT FK_FABD9C7E6DE2013A FOREIGN KEY (authors_id) REFERENCES author (id)');
        $this->addSql('CREATE INDEX IDX_FABD9C7E6DE2013A ON citation (authors_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE citation DROP FOREIGN KEY FK_FABD9C7E6DE2013A');
        $this->addSql('DROP INDEX IDX_FABD9C7E6DE2013A ON citation');
        $this->addSql('ALTER TABLE citation DROP authors_id');
    }
}
