<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260424093120 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__priority AS SELECT id, importance, name FROM priority');
        $this->addSql('DROP TABLE priority');
        $this->addSql('CREATE TABLE priority (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, importance INTEGER NOT NULL, name VARCHAR(255) NOT NULL, priority_id INTEGER NOT NULL, CONSTRAINT FK_62A6DC27497B19F9 FOREIGN KEY (priority_id) REFERENCES priority (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO priority (id, importance, name) SELECT id, importance, name FROM __temp__priority');
        $this->addSql('DROP TABLE __temp__priority');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_62A6DC275E237E06 ON priority (name)');
        $this->addSql('CREATE INDEX IDX_62A6DC27497B19F9 ON priority (priority_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__task AS SELECT id, title, is_pinned, status FROM task');
        $this->addSql('DROP TABLE task');
        $this->addSql('CREATE TABLE task (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, is_pinned BOOLEAN NOT NULL, status VARCHAR(255) NOT NULL, owner_id INTEGER NOT NULL, folder_id INTEGER DEFAULT NULL, CONSTRAINT FK_527EDB257E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_527EDB25162CB942 FOREIGN KEY (folder_id) REFERENCES folder (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO task (id, title, is_pinned, status) SELECT id, title, is_pinned, status FROM __temp__task');
        $this->addSql('DROP TABLE __temp__task');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_527EDB252B36786B ON task (title)');
        $this->addSql('CREATE INDEX IDX_527EDB257E3C61F9 ON task (owner_id)');
        $this->addSql('CREATE INDEX IDX_527EDB25162CB942 ON task (folder_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__priority AS SELECT id, importance, name FROM priority');
        $this->addSql('DROP TABLE priority');
        $this->addSql('CREATE TABLE priority (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, importance INTEGER NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO priority (id, importance, name) SELECT id, importance, name FROM __temp__priority');
        $this->addSql('DROP TABLE __temp__priority');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_62A6DC275E237E06 ON priority (name)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__task AS SELECT id, title, is_pinned, status FROM task');
        $this->addSql('DROP TABLE task');
        $this->addSql('CREATE TABLE task (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, is_pinned BOOLEAN NOT NULL, status VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO task (id, title, is_pinned, status) SELECT id, title, is_pinned, status FROM __temp__task');
        $this->addSql('DROP TABLE __temp__task');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_527EDB252B36786B ON task (title)');
    }
}
