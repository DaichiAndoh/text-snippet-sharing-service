<?php

namespace Database\Migrations;

use Database\Migrator\SchemaMigration;

class UpdateTextSnippetsTable implements SchemaMigration {
    public function up(): array {
        // マイグレーションロジックをここに追加
        return [
            "ALTER TABLE text_snippets CHANGE COLUMN url url_key VARCHAR(30) NOT NULL UNIQUE",
            "ALTER TABLE text_snippets CHANGE COLUMN language language VARCHAR(100) NOT NULL",
            "ALTER TABLE text_snippets RENAME TO snippets",
        ];
    }

    public function down(): array {
        // ロールバックロジックを追加
        return [
            "ALTER TABLE snippets CHANGE COLUMN url_key url VARCHAR(100) NOT NULL UNIQUE",
            "ALTER TABLE snippets CHANGE COLUMN language language VARCHAR(30) NOT NULL",
            "ALTER TABLE snippets RENAME TO text_snippets",
        ];
    }
}
