<?php

namespace App;

use PDO;

class Db
{
    private static ?PDO $pdo = null;

    public static function getConnection(): PDO
    {
        if (self::$pdo === null) {

            // Host do MySQL do Windows
            $host = 'host.docker.internal';
            $user = 'root';             // Usuário do MySQL do Windows
            $pass = 'root';  // Coloque a senha correta
            $dbname = 'cinema';         // Banco que você quer usar
            $port = 3306;               // Porta padrão do MySQL

            try {
                self::$pdo = new PDO(
                    "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8",
                    $user,
                    $pass
                );
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (\PDOException $e) {
                die("Erro ao conectar no MySQL do Windows: " . $e->getMessage());
            }
        }

        return self::$pdo;
    }
}
