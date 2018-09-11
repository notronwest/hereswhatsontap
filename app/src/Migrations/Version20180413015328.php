<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180413015328 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE customer_beer (customer_beer_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', customer_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', location_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', tap_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', beer_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', glass_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', customer_beer_price DOUBLE PRECISION DEFAULT NULL, customer_beer_tapdate DATETIME NOT NULL, customer_beer_addeddate DATETIME NOT NULL, customer_beer_addedby VARCHAR(36) NOT NULL, customer_beer_addedbyname VARCHAR(255) NOT NULL, customer_beer_modifieddate DATETIME NOT NULL, customer_beer_modifiedby VARCHAR(36) NOT NULL, customer_beer_modifiedbyname VARCHAR(255) NOT NULL, customer_beer_active TINYINT(1) NOT NULL, INDEX IDX_C67C2DA9395C3F3 (customer_id), INDEX IDX_C67C2DA64D218E (location_id), INDEX IDX_C67C2DA771C0C37 (tap_id), INDEX IDX_C67C2DAD0989053 (beer_id), INDEX IDX_C67C2DA6E4A05EA (glass_id), UNIQUE INDEX customer_beer_unique (customer_id, beer_id), PRIMARY KEY(customer_beer_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE customer_beer ADD CONSTRAINT FK_C67C2DA9395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (customer_id)');
        $this->addSql('ALTER TABLE customer_beer ADD CONSTRAINT FK_C67C2DA64D218E FOREIGN KEY (location_id) REFERENCES location (location_id)');
        $this->addSql('ALTER TABLE customer_beer ADD CONSTRAINT FK_C67C2DA771C0C37 FOREIGN KEY (tap_id) REFERENCES tap (tap_id)');
        $this->addSql('ALTER TABLE customer_beer ADD CONSTRAINT FK_C67C2DAD0989053 FOREIGN KEY (beer_id) REFERENCES beer (beer_id)');
        $this->addSql('ALTER TABLE customer_beer ADD CONSTRAINT FK_C67C2DA6E4A05EA FOREIGN KEY (glass_id) REFERENCES glass (glass_id)');
        $this->addSql('ALTER TABLE beer CHANGE beer_images beer_images VARCHAR(2000) DEFAULT NULL');
        $this->addSql('ALTER TABLE sessions CHANGE sess_id sess_id VARCHAR(128) NOT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE customer_beer');
        $this->addSql('ALTER TABLE beer CHANGE beer_images beer_images VARCHAR(2000) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE sessions CHANGE sess_id sess_id VARCHAR(128) NOT NULL COLLATE utf8_unicode_ci');
    }
}
