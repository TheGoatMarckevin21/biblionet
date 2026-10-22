<?php
class User {
    public static function findByEmail(string $email): ?array {
        $pdo = Database::getConnection();
        
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        
        $user = $stmt->fetch();
        return $user ?: null; // 
    }
}