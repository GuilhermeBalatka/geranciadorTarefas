<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231019231131 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE anexo (id INT AUTO_INCREMENT NOT NULL, tarefa_id INT DEFAULT NULL, nome VARCHAR(255) DEFAULT NULL, arquivo VARCHAR(255) DEFAULT NULL, INDEX IDX_CD7EAF2C78217710 (tarefa_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tarefas (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(255) DEFAULT NULL, descricao LONGTEXT DEFAULT NULL, prazo DATE DEFAULT NULL, prioridade VARCHAR(255) DEFAULT NULL, concluida TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE anexo ADD CONSTRAINT FK_CD7EAF2C78217710 FOREIGN KEY (tarefa_id) REFERENCES tarefas (id)');
        $this->addSql('ALTER TABLE pedidos DROP FOREIGN KEY pedidos_ibfk_1');
        $this->addSql('ALTER TABLE pedidos DROP FOREIGN KEY pedidos_ibfk_2');
        $this->addSql('DROP TABLE clientes');
        $this->addSql('DROP TABLE pedidos');
        $this->addSql('DROP TABLE produtos');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE clientes (id_clientes INT AUTO_INCREMENT NOT NULL, nome VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, endereco VARCHAR(200) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, telefone VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, PRIMARY KEY(id_clientes)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE pedidos (id_pedidos INT AUTO_INCREMENT NOT NULL, id_clientes INT DEFAULT NULL, id_produtos INT DEFAULT NULL, quantidade INT DEFAULT NULL, data_pedido DATE DEFAULT NULL, INDEX id_clientes (id_clientes), INDEX id_produtos (id_produtos), PRIMARY KEY(id_pedidos)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE produtos (id_produtos INT AUTO_INCREMENT NOT NULL, nome_produto VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, preco DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id_produtos)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE pedidos ADD CONSTRAINT pedidos_ibfk_1 FOREIGN KEY (id_clientes) REFERENCES clientes (id_clientes) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE pedidos ADD CONSTRAINT pedidos_ibfk_2 FOREIGN KEY (id_produtos) REFERENCES produtos (id_produtos) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE anexo DROP FOREIGN KEY FK_CD7EAF2C78217710');
        $this->addSql('DROP TABLE anexo');
        $this->addSql('DROP TABLE tarefas');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
