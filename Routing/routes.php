<?php

use Response\HTTPRenderer;
use Response\Render\HTMLRenderer;

return [
    '/' => function(): HTTPRenderer {
        return new HTMLRenderer('form', []);
    },
    '/share' => function(): HTTPRenderer{
        return new HTMLRenderer('share', []);
    },
];
