<?php
    function getConnection() {
        $instance = "mysql:host=localhost;dbname=bd_doceria;charset=utf-8";
        $user = "root";
        $password = "0000";

        try{
            $pdo = new PDO($instance, $user, $password);
            return $pdo;
        } catch (PDOException $e) {
            echo "<script>alert('Incapaz de executar o sistema! Falha na conexão. Log do erro: " . $e->getMessage() . "');</script>";
        }
    }
