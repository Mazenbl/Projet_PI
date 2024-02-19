<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240219021343 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495569853F45');
        $this->addSql('DROP INDEX IDX_42C8495569853F45 ON reservation');
        $this->addSql('ALTER TABLE reservation ADD patient_nom_et_prenom VARCHAR(255) NOT NULL, CHANGE id_hopital_id hopital_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955CC0FBF92 FOREIGN KEY (hopital_id) REFERENCES hopital (id)');
        $this->addSql('CREATE INDEX IDX_42C84955CC0FBF92 ON reservation (hopital_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955CC0FBF92');
        $this->addSql('DROP INDEX IDX_42C84955CC0FBF92 ON reservation');
        $this->addSql('ALTER TABLE reservation DROP patient_nom_et_prenom, CHANGE hopital_id id_hopital_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495569853F45 FOREIGN KEY (id_hopital_id) REFERENCES hopital (id)');
        $this->addSql('CREATE INDEX IDX_42C8495569853F45 ON reservation (id_hopital_id)');
    }
}
