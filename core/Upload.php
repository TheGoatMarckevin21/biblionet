<?php
class Upload {
    private const MAX_SIZE = 2 * 1024 * 1024; // 2 Mo
    private const TYPES = [
        'image/jpeg' => 'jpg',
        'image/png'  => 'png',
        'image/webp' => 'webp',
    ];

    /**
     * Enregistre une image envoyée et retourne son chemin relatif (ex. "livres/ab12.jpg").
     * Retourne null si aucun fichier n'a été envoyé. Lève RuntimeException si invalide.
     */
    public static function image(array $file, string $subDir = 'livres'): ?string {
        if (!isset($file['error']) || $file['error'] === UPLOAD_ERR_NO_FILE) {
            return null;
        }
        if ($file['error'] !== UPLOAD_ERR_OK) {
            throw new RuntimeException("Échec de l'envoi de l'image (code {$file['error']}).");
        }
        if ($file['size'] > self::MAX_SIZE) {
            throw new RuntimeException("L'image dépasse 2 Mo.");
        }

        $mime = (new finfo(FILEINFO_MIME_TYPE))->file($file['tmp_name']);
        if (!isset(self::TYPES[$mime]) || @getimagesize($file['tmp_name']) === false) {
            throw new RuntimeException("Format invalide : JPG, PNG ou WebP uniquement.");
        }

        $dir = self::baseDir() . '/' . $subDir;
        if (!is_dir($dir) && !mkdir($dir, 0755, true)) {
            throw new RuntimeException("Impossible de créer le dossier d'upload.");
        }

        $name = bin2hex(random_bytes(16)) . '.' . self::TYPES[$mime];
        if (!move_uploaded_file($file['tmp_name'], "$dir/$name")) {
            throw new RuntimeException("Impossible d'enregistrer l'image.");
        }
        return "$subDir/$name";
    }

    public static function remove(?string $path): void {
        if (!$path) return;
        $full = realpath(self::baseDir() . '/' . $path);
        $base = realpath(self::baseDir());
        if ($full && $base && str_starts_with($full, $base) && is_file($full)) {
            @unlink($full);
        }
    }

    private static function baseDir(): string {
        return dirname(__DIR__) . '/public/uploads';
    }
}
