<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20241004133045 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE media_category (media_id INT NOT NULL, category_id INT NOT NULL, PRIMARY KEY(media_id, category_id))');
        $this->addSql('CREATE INDEX IDX_92D3773EA9FDD75 ON media_category (media_id)');
        $this->addSql('CREATE INDEX IDX_92D377312469DE2 ON media_category (category_id)');
        $this->addSql('CREATE TABLE media_media (media_source INT NOT NULL, media_target INT NOT NULL, PRIMARY KEY(media_source, media_target))');
        $this->addSql('CREATE INDEX IDX_753565BDE3F3E5AD ON media_media (media_source)');
        $this->addSql('CREATE INDEX IDX_753565BDFA16B522 ON media_media (media_target)');
        $this->addSql('ALTER TABLE media_category ADD CONSTRAINT FK_92D3773EA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE media_category ADD CONSTRAINT FK_92D377312469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE media_media ADD CONSTRAINT FK_753565BDE3F3E5AD FOREIGN KEY (media_source) REFERENCES media (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE media_media ADD CONSTRAINT FK_753565BDFA16B522 FOREIGN KEY (media_target) REFERENCES media (id) ON DELETE CASCADE');
        $this->addSql('CREATE TABLE media_language (media_id INT NOT NULL, language_id INT NOT NULL, PRIMARY KEY(media_id, language_id))');
        $this->addSql('CREATE INDEX IDX_MEDIA_LANGUAGE_MEDIA_ID ON media_language (media_id)');
        $this->addSql('CREATE INDEX IDX_MEDIA_LANGUAGE_LANGUAGE_ID ON media_language (language_id)');
        $this->addSql('ALTER TABLE media_language ADD CONSTRAINT FK_MEDIA_LANGUAGE_MEDIA_ID FOREIGN KEY (media_id) REFERENCES media (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE media_language ADD CONSTRAINT FK_MEDIA_LANGUAGE_LANGUAGE_ID FOREIGN KEY (language_id) REFERENCES language (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE media_category DROP CONSTRAINT FK_92D3773EA9FDD75');
        $this->addSql('ALTER TABLE media_category DROP CONSTRAINT FK_92D377312469DE2');
        $this->addSql('ALTER TABLE media_media DROP CONSTRAINT FK_753565BDE3F3E5AD');
        $this->addSql('ALTER TABLE media_media DROP CONSTRAINT FK_753565BDFA16B522');
        $this->addSql('ALTER TABLE media_language DROP CONSTRAINT FK_MEDIA_LANGUAGE_MEDIA_ID');
        $this->addSql('ALTER TABLE media_language DROP CONSTRAINT FK_MEDIA_LANGUAGE_LANGUAGE_ID');
        $this->addSql('DROP TABLE media_category');
        $this->addSql('DROP TABLE media_media');
        $this->addSql('DROP TABLE media_language');
    }
}
