<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230719063128 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE agent (id INT AUTO_INCREMENT NOT NULL, structure_id INT DEFAULT NULL, matricule VARCHAR(10) NOT NULL, nom VARCHAR(35) NOT NULL, prenoms VARCHAR(100) NOT NULL, sexe VARCHAR(5) NOT NULL, datedenaissance DATE NOT NULL, grade VARCHAR(4) NOT NULL, emploi VARCHAR(100) NOT NULL, civilite VARCHAR(10) NOT NULL, premiereprisedeservice DATE NOT NULL, email VARCHAR(100) NOT NULL, telephone VARCHAR(10) NOT NULL, telephone1 VARCHAR(10) DEFAULT NULL, INDEX IDX_268B9C9D2534008B (structure_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE decision (id INT AUTO_INCREMENT NOT NULL, parentstructureratache_id INT DEFAULT NULL, numero VARCHAR(100) NOT NULL, type VARCHAR(20) NOT NULL, date DATE NOT NULL, INDEX IDX_84ACBE48DC4DA027 (parentstructureratache_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE structure (id INT AUTO_INCREMENT NOT NULL, codestructure INT NOT NULL, libele_structure VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE structureratache (id INT AUTO_INCREMENT NOT NULL, parentstructure_id INT DEFAULT NULL, codestructureratache VARCHAR(30) NOT NULL, libele VARCHAR(30) NOT NULL, INDEX IDX_901C154210A5A005 (parentstructure_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, agent_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(30) NOT NULL, prenoms VARCHAR(100) NOT NULL, ville VARCHAR(100) NOT NULL, telephone VARCHAR(100) NOT NULL, datedenaissance DATE NOT NULL, UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), INDEX IDX_1483A5E93414710B (agent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE agent ADD CONSTRAINT FK_268B9C9D2534008B FOREIGN KEY (structure_id) REFERENCES structure (id)');
        $this->addSql('ALTER TABLE decision ADD CONSTRAINT FK_84ACBE48DC4DA027 FOREIGN KEY (parentstructureratache_id) REFERENCES structureratache (id)');
        $this->addSql('ALTER TABLE structureratache ADD CONSTRAINT FK_901C154210A5A005 FOREIGN KEY (parentstructure_id) REFERENCES structure (id)');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E93414710B FOREIGN KEY (agent_id) REFERENCES agent (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agent DROP FOREIGN KEY FK_268B9C9D2534008B');
        $this->addSql('ALTER TABLE decision DROP FOREIGN KEY FK_84ACBE48DC4DA027');
        $this->addSql('ALTER TABLE structureratache DROP FOREIGN KEY FK_901C154210A5A005');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E93414710B');
        $this->addSql('DROP TABLE agent');
        $this->addSql('DROP TABLE decision');
        $this->addSql('DROP TABLE structure');
        $this->addSql('DROP TABLE structureratache');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
