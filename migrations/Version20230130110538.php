<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230130110538 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creation de la relation entre les citations et les auteurs';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE citation ADD author_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE citation ADD CONSTRAINT FK_FABD9C7EF675F31B FOREIGN KEY (author_id) REFERENCES author (id)');
        $this->addSql('CREATE INDEX IDX_FABD9C7EF675F31B ON citation (author_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE citation DROP FOREIGN KEY FK_FABD9C7EF675F31B');
        $this->addSql('DROP INDEX IDX_FABD9C7EF675F31B ON citation');
        $this->addSql('ALTER TABLE citation DROP author_id');
    }
}
