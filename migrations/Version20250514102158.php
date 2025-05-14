<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250514102158 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE talks DROP CONSTRAINT fk_usertalk
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE users_talk (id SERIAL NOT NULL, name VARCHAR(32) NOT NULL, last_name VARCHAR(32) NOT NULL, email VARCHAR(100) NOT NULL, token VARCHAR(100) NOT NULL, roles JSON NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE userstalk
        SQL);
        $this->addSql(<<<'SQL'
            CREATE SEQUENCE rooms_id_seq
        SQL);
        $this->addSql(<<<'SQL'
            SELECT setval('rooms_id_seq', (SELECT MAX(id) FROM rooms))
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rooms ALTER id SET DEFAULT nextval('rooms_id_seq')
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rooms ALTER room_number SET NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rooms ALTER number_places SET NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            CREATE SEQUENCE talks_id_seq
        SQL);
        $this->addSql(<<<'SQL'
            SELECT setval('talks_id_seq', (SELECT MAX(id) FROM talks))
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE talks ALTER id SET DEFAULT nextval('talks_id_seq')
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE talks ALTER title SET NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE talks ALTER content SET NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE talks ALTER day SET NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE talks ALTER moment SET NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE talks ALTER state SET NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE talks RENAME COLUMN user_id TO user_talk_id
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE talks ADD CONSTRAINT FK_472281DA370B1FDF FOREIGN KEY (user_talk_id) REFERENCES users_talk (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_472281DA370B1FDF ON talks (user_talk_id)
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
            CREATE TABLE userstalk (id INT NOT NULL, name VARCHAR(32) DEFAULT NULL, last_name VARCHAR(32) DEFAULT NULL, email VARCHAR(100) DEFAULT NULL, token VARCHAR(100) DEFAULT NULL, roles JSON DEFAULT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE users_talk
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_472281DA370B1FDF
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE talks ALTER id DROP DEFAULT
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE talks ALTER title DROP NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE talks ALTER content DROP NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE talks ALTER day DROP NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE talks ALTER moment DROP NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE talks ALTER state DROP NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE talks RENAME COLUMN user_talk_id TO user_id
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE talks ADD CONSTRAINT fk_usertalk FOREIGN KEY (user_id) REFERENCES userstalk (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_472281DAA76ED395 ON talks (user_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rooms ALTER id DROP DEFAULT
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rooms ALTER room_number DROP NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rooms ALTER number_places DROP NOT NULL
        SQL);
    }
}
