<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200617232521 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE comments_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE topic_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE comments (id INT NOT NULL, user_comment_id INT NOT NULL, ticket_comment_id INT NOT NULL, text_comment TEXT NOT NULL, date_comment TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5F9E962A5F0EBBFF ON comments (user_comment_id)');
        $this->addSql('CREATE INDEX IDX_5F9E962A6EFAEF47 ON comments (ticket_comment_id)');
        $this->addSql('CREATE TABLE topic (id INT NOT NULL, user_topic_id INT NOT NULL, title_topic VARCHAR(100) NOT NULL, text_topic TEXT NOT NULL, date_create_topic TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, section_topic VARCHAR(100) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9D40DE1BFFD8C43D ON topic (user_topic_id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A5F0EBBFF FOREIGN KEY (user_comment_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A6EFAEF47 FOREIGN KEY (ticket_comment_id) REFERENCES topic (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE topic ADD CONSTRAINT FK_9D40DE1BFFD8C43D FOREIGN KEY (user_topic_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ALTER name_user TYPE VARCHAR(150)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE comments DROP CONSTRAINT FK_5F9E962A6EFAEF47');
        $this->addSql('DROP SEQUENCE comments_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE topic_id_seq CASCADE');
        $this->addSql('DROP TABLE comments');
        $this->addSql('DROP TABLE topic');
        $this->addSql('ALTER TABLE "user" ALTER name_user TYPE VARCHAR(100)');
    }
}
