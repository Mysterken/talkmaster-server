<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250515120606 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE rooms (id SERIAL NOT NULL, room_number INT NOT NULL, number_places INT NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE talks (id SERIAL NOT NULL, user_talk_id INT DEFAULT NULL, room_id INT DEFAULT NULL, title VARCHAR(50) NOT NULL, content TEXT NOT NULL, day INT NOT NULL, moment INT NOT NULL, state VARCHAR(50) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_472281DA370B1FDF ON talks (user_talk_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_472281DA54177093 ON talks (room_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE users_talk (id SERIAL NOT NULL, name VARCHAR(32) NOT NULL, last_name VARCHAR(32) NOT NULL, email VARCHAR(100) NOT NULL, token VARCHAR(100) NOT NULL, roles JSON NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_50AD9BB5E7927C74 ON users_talk (email)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE talks ADD CONSTRAINT FK_472281DA370B1FDF FOREIGN KEY (user_talk_id) REFERENCES users_talk (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE talks ADD CONSTRAINT FK_472281DA54177093 FOREIGN KEY (room_id) REFERENCES rooms (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE talks DROP CONSTRAINT FK_472281DA370B1FDF
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE talks DROP CONSTRAINT FK_472281DA54177093
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE rooms
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE talks
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE users_talk
        SQL);
    }
}
