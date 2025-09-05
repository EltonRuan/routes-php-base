<?php

class UsuarioModel {
    private $pdo;

    public function __construct() {

        $host = 'mysql';
        $db   = 'meu_banco';
        $user = 'user';
        $pass = 'senha';
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        try {
            $this->pdo = new PDO($dsn, $user, $pass, $options);
        } catch (\PDOException $e) {
            die("Erro na conexão: " . $e->getMessage());
        }

    }

    public function create($nome, $email) {
        $stmt = $this->pdo->prepare("INSERT INTO usuarios (nome, email) VALUES (:nome, :email)");
        $stmt->execute(['nome' => $nome, 'email' => $email]);
        return $this->pdo->lastInsertId();
    }

    public function get($id = null) {
        if ($id) {
            $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
            $stmt->execute(['id' => $id]);
            return $stmt->fetch();
        } else {
            $stmt = $this->pdo->query("SELECT * FROM usuarios");
            return $stmt->fetchAll();
        }
    }

    public function update($id, $nome, $email) {
        $stmt = $this->pdo->prepare("UPDATE usuarios SET nome = :nome, email = :email WHERE id = :id");
        return $stmt->execute(['nome' => $nome, 'email' => $email, 'id' => $id]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM usuarios WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
