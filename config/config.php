<?php

$envFile = dirname(__DIR__) . '/.env';
if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        list($name, $value) = explode('=', $line, 2);
        $_ENV[trim($name)] = trim($value);
    }
}

define('APP_ENV', $_ENV['APP_ENV'] ?? 'local');
define('APP_URL', rtrim($_ENV['APP_URL'] ?? 'http://localhost/biblionet/public', '/'));
define('DB_HOST', $_ENV['DB_HOST'] ?? 'localhost');
define('DB_NAME', $_ENV['DB_NAME'] ?? 'biblionet');
define('DB_USER', $_ENV['DB_USER'] ?? 'root');
define('DB_PASS', $_ENV['DB_PASS'] ?? '');


if (APP_ENV === 'production') {
    ini_set('display_errors', '0');
    error_reporting(0);
} else {
    ini_set('display_errors', '1');
    error_reporting(E_ALL);
}

function e(?string $string): string {
    return htmlspecialchars($string ?? '', ENT_QUOTES, 'UTF-8');
}

function book_image(?string $image, ?string $title = null, ?string $category = null): string {
    if ($image) {
        return APP_URL . '/uploads/' . $image;
    }

    if ($title !== null && $title !== '') {
        $palette = [
            ['#17324d', '#2f6f73'],
            ['#3b1f4a', '#9b4d78'],
            ['#3e2b1d', '#b06b3b'],
            ['#193b35', '#4f8b68'],
            ['#29264a', '#6c63a8'],
        ];
        $colors = $palette[hexdec(substr(hash('crc32b', $category ?? ''), 0, 2)) % count($palette)];
        $lines = [];
        $line = '';
        foreach (preg_split('/\s+/u', trim($title)) as $word) {
            if ($line !== '' && strlen($line . ' ' . $word) > 22) {
                $lines[] = $line;
                $line = '';
            }
            $line = $line === '' ? $word : $line . ' ' . $word;
        }
        if ($line !== '') {
            $lines[] = $line;
        }

        $titleSvg = '';
        foreach (array_slice($lines, 0, 4) as $index => $titleLine) {
            $y = 205 + ($index * 30);
            $titleSvg .= '<text x="34" y="' . $y . '" fill="#ffffff" font-family="Arial,sans-serif" font-size="22" font-weight="700">'
                . htmlspecialchars($titleLine, ENT_QUOTES | ENT_XML1, 'UTF-8') . '</text>';
        }

        $label = htmlspecialchars($category ?? 'Livre', ENT_QUOTES | ENT_XML1, 'UTF-8');
        $svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 300 400">'
            . '<defs><linearGradient id="bg" x2="1" y2="1"><stop stop-color="' . $colors[0] . '"/><stop offset="1" stop-color="' . $colors[1] . '"/></linearGradient></defs>'
            . '<rect width="300" height="400" fill="url(#bg)"/>'
            . '<path d="M0 0h22v400H0z" fill="#000" opacity=".18"/>'
            . '<circle cx="255" cy="70" r="90" fill="#fff" opacity=".08"/>'
            . '<path d="M34 148h64" stroke="#fff" stroke-width="3" opacity=".7"/>'
            . '<text x="34" y="128" fill="#fff" font-family="Arial,sans-serif" font-size="12" letter-spacing="2" opacity=".8">' . $label . '</text>'
            . $titleSvg
            . '<path d="M34 340h232" stroke="#fff" stroke-width="1" opacity=".35"/>'
            . '<text x="34" y="368" fill="#fff" font-family="Arial,sans-serif" font-size="12" letter-spacing="2" opacity=".8">BIBLIONET</text>'
            . '</svg>';

        return 'data:image/svg+xml;base64,' . base64_encode($svg);
    }

    return APP_URL . '/assets/img/no-cover.svg';
}
