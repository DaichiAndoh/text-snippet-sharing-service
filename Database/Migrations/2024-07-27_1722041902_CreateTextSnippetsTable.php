<?php

namespace Database\Migrations;

use Database\Migrator\SchemaMigration;

class CreateTextSnippetsTable implements SchemaMigration {
    public function up(): array {
        // マイグレーションロジックをここに追加
        return [
            "CREATE TABLE text_snippets (
                id BIGINT PRIMARY KEY AUTO_INCREMENT,
                content VARCHAR(1000) NOT NULL,
                url VARCHAR(100) NOT NULL UNIQUE,
                language VARCHAR(30) NOT NULL,
                send_time DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                expiration_time DATETIME NOT NULL
            )"
        ];
    }

    public function down(): array {
        // ロールバックロジックを追加
        return [
            "DROP TABLE text_snippets"
        ];
    }
}
