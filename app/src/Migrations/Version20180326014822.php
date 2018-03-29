<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180326014822 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE beer (beer_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', style_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', glass_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', beer_name VARCHAR(500) NOT NULL, beer_abv INT NOT NULL, beer_ibu INT NOT NULL, beer_organic TINYINT(1) NOT NULL, beer_year VARCHAR(4) NOT NULL, beer_price DOUBLE PRECISION NOT NULL, beer_addeddate DATETIME NOT NULL, beer_addedby VARCHAR(36) NOT NULL, beer_modifieddate DATETIME NOT NULL, beer_modifiedby VARCHAR(36) NOT NULL, beer_active TINYINT(1) NOT NULL, beer_apiid VARCHAR(255) NOT NULL, INDEX IDX_58F666ADBACD6074 (style_id), INDEX IDX_58F666AD6E4A05EA (glass_id), UNIQUE INDEX beer_unique (beer_name), PRIMARY KEY(beer_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE beer_list (beer_list_id INT NOT NULL, tap_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', customer_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', beer_list_name VARCHAR(500) NOT NULL, beer_list_startdate DATETIME NOT NULL, beer_list_enddate DATETIME NOT NULL, beer_list_addedby VARCHAR(36) NOT NULL, beer_list_addeddate DATETIME NOT NULL, beer_list_modifiedby VARCHAR(36) NOT NULL, beer_list_modifieddate DATETIME NOT NULL, beer_list_active TINYINT(1) NOT NULL, INDEX IDX_4C3CA3C5771C0C37 (tap_id), INDEX IDX_4C3CA3C59395C3F3 (customer_id), UNIQUE INDEX beer_list_unique (beer_list_name, customer_id), PRIMARY KEY(beer_list_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE beer_list_beer (beer_list_beer_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', glass_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', beer_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', beer_list_id INT DEFAULT NULL, beer_list_beer_price DOUBLE PRECISION NOT NULL, beer_list_beer_addedby VARCHAR(36) NOT NULL, beer_list_beer_addeddate DATETIME NOT NULL, beer_list_beer_modifiedby VARCHAR(36) NOT NULL, beer_list_beer_modifieddate DATETIME NOT NULL, beer_list_beer_active TINYINT(1) NOT NULL, INDEX IDX_A45DB0B6E4A05EA (glass_id), INDEX IDX_A45DB0BD0989053 (beer_id), INDEX IDX_A45DB0B5B60027A (beer_list_id), UNIQUE INDEX beer_list_beer_unique (beer_id, beer_list_id), PRIMARY KEY(beer_list_beer_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (contact_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', user_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', contact_firstname VARCHAR(255) NOT NULL, contact_lastname VARCHAR(255) NOT NULL, contact_nickname VARCHAR(255) NOT NULL, contact_phone INT NOT NULL, contact_email VARCHAR(255) NOT NULL, contact_address VARCHAR(1000) NOT NULL, contact_address2 VARCHAR(1000) NOT NULL, contact_city VARCHAR(255) NOT NULL, contact_state VARCHAR(36) NOT NULL, contact_zip INT NOT NULL, contact_addedby VARCHAR(36) NOT NULL, contact_addeddate DATETIME NOT NULL, contact_modifiedby VARCHAR(36) NOT NULL, contact_modifieddate DATETIME NOT NULL, contact_active TINYINT(1) NOT NULL, UNIQUE INDEX contact_unique (user_id), PRIMARY KEY(contact_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer (customer_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', customer_name VARCHAR(255) NOT NULL, customer_startdate DATETIME NOT NULL, customer_addeddate DATETIME NOT NULL, customer_addedby VARCHAR(36) NOT NULL, customer_modifieddate DATETIME NOT NULL, customer_modifiedby VARCHAR(36) NOT NULL, customer_active TINYINT(1) NOT NULL, customer_type_id INT NOT NULL, UNIQUE INDEX customer_unique (customer_name), PRIMARY KEY(customer_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer_user_role (customer_user_role_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', user_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', customer_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', customer_user_role_type_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', customer_user_role_addeddate DATETIME NOT NULL, customer_user_role_addedby VARCHAR(36) NOT NULL, customer_user_role_modifieddate DATETIME NOT NULL, customer_user_role_modifiedby VARCHAR(36) NOT NULL, customer_user_role_active TINYINT(1) NOT NULL, INDEX IDX_86153EB9A76ED395 (user_id), INDEX IDX_86153EB99395C3F3 (customer_id), INDEX IDX_86153EB9ED5CA877 (customer_user_role_type_id), UNIQUE INDEX customer_user_role_unique (customer_id, user_id, customer_user_role_type_id), PRIMARY KEY(customer_user_role_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer_user_role_type (customer_user_role_type_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', customer_user_role_type_constant VARCHAR(50) NOT NULL, customer_user_role_type_addeddate DATETIME NOT NULL, customer_user_role_type_addedby VARCHAR(36) NOT NULL, customer_user_role_type_modifiedby VARCHAR(36) NOT NULL, customer_user_role_type_modifieddate DATETIME NOT NULL, customer_user_role_type_active TINYINT(1) NOT NULL, UNIQUE INDEX customer_user_role_type_unique (customer_user_role_type_constant), PRIMARY KEY(customer_user_role_type_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE glass (glass_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', glass_name VARCHAR(500) NOT NULL, glass_imgurl VARCHAR(500) NOT NULL, glass_addedby VARCHAR(36) NOT NULL, glass_addeddate DATETIME NOT NULL, glass_modifiedby VARCHAR(36) NOT NULL, glass_modifieddate DATETIME NOT NULL, glass_active TINYINT(1) NOT NULL, glass_apiid VARCHAR(255) NOT NULL, UNIQUE INDEX glass_unique (glass_name), PRIMARY KEY(glass_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE location (location_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', customer_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', location_name VARCHAR(500) NOT NULL, location_address VARCHAR(1000) NOT NULL, location_address2 VARCHAR(1000) NOT NULL, location_city VARCHAR(255) NOT NULL, location_state VARCHAR(255) NOT NULL, location_zip INT NOT NULL, location_phone INT NOT NULL, location_addeddate DATETIME NOT NULL, location_addedby VARCHAR(36) NOT NULL, location_modifieddate DATETIME NOT NULL, location_modifedby VARCHAR(36) NOT NULL, location_active TINYINT(1) NOT NULL, INDEX IDX_5E9E89CB9395C3F3 (customer_id), UNIQUE INDEX location_unique (location_name, customer_id), PRIMARY KEY(location_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE style (style_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', style_name VARCHAR(500) NOT NULL, style_description VARCHAR(2000) NOT NULL, style_category VARCHAR(500) NOT NULL, style_ibumin INT NOT NULL, style_ibumax INT NOT NULL, style_abvmin INT NOT NULL, style_abvmax INT NOT NULL, style_srmmin INT NOT NULL, style_srmmax INT NOT NULL, style_ogmin INT NOT NULL, style_ogmax INT NOT NULL, style_fgmin INT NOT NULL, style_fgmax INT NOT NULL, style_addedby VARCHAR(36) NOT NULL, style_addeddate DATETIME NOT NULL, style_modifiedby VARCHAR(36) NOT NULL, style_modifieddate DATETIME NOT NULL, style_active TINYINT(1) NOT NULL, style_apiid VARCHAR(255) NOT NULL, UNIQUE INDEX style_unique (style_name), PRIMARY KEY(style_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tap (tap_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', customer_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', location_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', tap_name VARCHAR(500) NOT NULL, tap_addeddate DATETIME NOT NULL, tap_addedby VARCHAR(36) NOT NULL, tap_modifieddate DATETIME NOT NULL, tap_modifiedby VARCHAR(36) NOT NULL, tap_active TINYINT(1) NOT NULL, INDEX IDX_805A32449395C3F3 (customer_id), INDEX IDX_805A324464D218E (location_id), PRIMARY KEY(tap_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (user_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', user_username VARCHAR(64) NOT NULL, user_password VARCHAR(255) NOT NULL, user_addedby VARCHAR(36) NOT NULL, user_addeddate DATETIME NOT NULL, user_modifieddate DATETIME NOT NULL, user_modifiedby VARCHAR(36) NOT NULL, user_active TINYINT(1) NOT NULL, UNIQUE INDEX user_unique (user_username), PRIMARY KEY(user_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE beer ADD CONSTRAINT FK_58F666ADBACD6074 FOREIGN KEY (style_id) REFERENCES style (style_id)');
        $this->addSql('ALTER TABLE beer ADD CONSTRAINT FK_58F666AD6E4A05EA FOREIGN KEY (glass_id) REFERENCES glass (glass_id)');
        $this->addSql('ALTER TABLE beer_list ADD CONSTRAINT FK_4C3CA3C5771C0C37 FOREIGN KEY (tap_id) REFERENCES tap (tap_id)');
        $this->addSql('ALTER TABLE beer_list ADD CONSTRAINT FK_4C3CA3C59395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (customer_id)');
        $this->addSql('ALTER TABLE beer_list_beer ADD CONSTRAINT FK_A45DB0B6E4A05EA FOREIGN KEY (glass_id) REFERENCES glass (glass_id)');
        $this->addSql('ALTER TABLE beer_list_beer ADD CONSTRAINT FK_A45DB0BD0989053 FOREIGN KEY (beer_id) REFERENCES beer (beer_id)');
        $this->addSql('ALTER TABLE beer_list_beer ADD CONSTRAINT FK_A45DB0B5B60027A FOREIGN KEY (beer_list_id) REFERENCES beer_list (beer_list_id)');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638A76ED395 FOREIGN KEY (user_id) REFERENCES user (user_id)');
        $this->addSql('ALTER TABLE customer_user_role ADD CONSTRAINT FK_86153EB9A76ED395 FOREIGN KEY (user_id) REFERENCES user (user_id)');
        $this->addSql('ALTER TABLE customer_user_role ADD CONSTRAINT FK_86153EB99395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (customer_id)');
        $this->addSql('ALTER TABLE customer_user_role ADD CONSTRAINT FK_86153EB9ED5CA877 FOREIGN KEY (customer_user_role_type_id) REFERENCES customer_user_role_type (customer_user_role_type_id)');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CB9395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (customer_id)');
        $this->addSql('ALTER TABLE tap ADD CONSTRAINT FK_805A32449395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (customer_id)');
        $this->addSql('ALTER TABLE tap ADD CONSTRAINT FK_805A324464D218E FOREIGN KEY (location_id) REFERENCES location (location_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE beer_list_beer DROP FOREIGN KEY FK_A45DB0BD0989053');
        $this->addSql('ALTER TABLE beer_list_beer DROP FOREIGN KEY FK_A45DB0B5B60027A');
        $this->addSql('ALTER TABLE beer_list DROP FOREIGN KEY FK_4C3CA3C59395C3F3');
        $this->addSql('ALTER TABLE customer_user_role DROP FOREIGN KEY FK_86153EB99395C3F3');
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CB9395C3F3');
        $this->addSql('ALTER TABLE tap DROP FOREIGN KEY FK_805A32449395C3F3');
        $this->addSql('ALTER TABLE customer_user_role DROP FOREIGN KEY FK_86153EB9ED5CA877');
        $this->addSql('ALTER TABLE beer DROP FOREIGN KEY FK_58F666AD6E4A05EA');
        $this->addSql('ALTER TABLE beer_list_beer DROP FOREIGN KEY FK_A45DB0B6E4A05EA');
        $this->addSql('ALTER TABLE tap DROP FOREIGN KEY FK_805A324464D218E');
        $this->addSql('ALTER TABLE beer DROP FOREIGN KEY FK_58F666ADBACD6074');
        $this->addSql('ALTER TABLE beer_list DROP FOREIGN KEY FK_4C3CA3C5771C0C37');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E638A76ED395');
        $this->addSql('ALTER TABLE customer_user_role DROP FOREIGN KEY FK_86153EB9A76ED395');
        $this->addSql('DROP TABLE beer');
        $this->addSql('DROP TABLE beer_list');
        $this->addSql('DROP TABLE beer_list_beer');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE customer_user_role');
        $this->addSql('DROP TABLE customer_user_role_type');
        $this->addSql('DROP TABLE glass');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE style');
        $this->addSql('DROP TABLE tap');
        $this->addSql('DROP TABLE user');
    }
}