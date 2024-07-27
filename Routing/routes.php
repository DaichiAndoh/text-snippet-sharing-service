<?php

use Response\HTTPRenderer;
use Response\Render\HTMLRenderer;
use Response\Render\JSONRenderer;
use Helpers\DatabaseHelper;
use Helpers\ValidationHelper;
use Helpers\DateTimeHelper;

return [
    '/' => function(string $path): HTTPRenderer {
        return new HTMLRenderer('form', []);
    },
    '/create' => function(string $path): HTTPRenderer {
        $raw = file_get_contents('php://input');
        $data = json_decode($raw, true);

        $urlKey = uniqid(bin2hex(random_bytes(1)));
        $content = $data['content'];
        $language = $data['language'];
        $expiration = $data['expiration'];
        $expirationTime = null;

        $content = ValidationHelper::string($content, 1, 1000);
        if ($content === false) {
            return new JSONRenderer(['error' => 'スニペットは1文字以上1000文字以下で設定してください。']);
        }
        $language = ValidationHelper::string($language, 1, 30);
        if ($language === false) {
            return new JSONRenderer(['error' => 'テキストタイプは1文字以上100文字以下で設定してください。']);
        }

        if ($expiration === '1day') {
            $expirationTime = DateTimeHelper::addDays(1);
        } else if ($expiration === '1hour') {
            $expirationTime = DateTimeHelper::addHours(1);
        } else {
            $expirationTime = DateTimeHelper::addMinutes(10);
        }

        DatabaseHelper::createSnippet($content, $urlKey, $language, $expirationTime);

        return new JSONRenderer(['urlKey' => $urlKey]);
    },
    '/share' => function(string $path): HTTPRenderer{
        $urlKey = str_replace('/share/', '', $path);
        $snippet = DatabaseHelper::getSnippet($urlKey);

        if (!$snippet) return new HTMLRenderer('invalid', []);

        $isExpired = DateTimeHelper::isExpired(new DateTime(), new DateTime($snippet['expiration_time']));
        if ($isExpired) return new HTMLRenderer('invalid', []);

        return new HTMLRenderer('share', ['snippet' => $snippet]);
    },
];
