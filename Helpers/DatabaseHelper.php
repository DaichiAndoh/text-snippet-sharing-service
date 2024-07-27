<?php

namespace Helpers;

use Database\MySQLWrapper;
use DateTime;
use Exception;

class DatabaseHelper {
    public static function createSnippet(string $content, string $urlKey, string $language, DateTime $expirationTime): void {
        $db = new MySQLWrapper();
        $formated = $expirationTime->format('Y-m-d H:i:s');

        $stmt = $db->prepare("INSERT INTO snippets (content, url_key, language, expiration_time) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('ssss', $content, $urlKey, $language, $formated);
        $stmt->execute();
    }

    public static function getSnippet(string $urlKey): array | null {
        $db = new MySQLWrapper();

        $stmt = $db->prepare("SELECT * FROM snippets WHERE url_key = ? LIMIT 1");
        $stmt->bind_param('s', $urlKey);
        $stmt->execute();

        $result = $stmt->get_result();
        $snippet = $result->fetch_assoc();

        if (!$snippet) return null;
        return $snippet;
    }
}
