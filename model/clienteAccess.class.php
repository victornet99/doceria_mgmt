<?php

    include_once '../connector/db-connector.php';
    include_once '../mapping/cliente.class.php';
    include_once '../mapping/endereco.class.php';

    class clienteAccess {

        public function salvarCliente (Endereco $endereco, Cliente $cliente) {
            try {
                $connect = getConnection();
                $sql = "call salvar_cliente(:rua, :cep, :num, :bairro, :comp, :nome, :tel, :login, :senha, 'ATIVO', :mail)";
                $statement = $connect->prepare($sql);

                $statement->bindValue(':rua', $endereco->getRua(), PDO::PARAM_STR);
                $statement->bindValue(':cep', $endereco->getCep(), PDO::PARAM_INT);
                $statement->bindValue(':num', $endereco->getNumero(), PDO::PARAM_INT);
                $statement->bindValue(':bairro', $endereco->getBairro(), PDO::PARAM_STR);
                $statement->bindValue(':comp', $endereco->getComplemento(), PDO::PARAM_STR);
                $statement->bindValue(':nome', $cliente->getNome(), PDO::PARAM_STR);
                $statement->bindValue(':tel', $cliente->getTelefone(), PDO::PARAM_INT);
                $statement->bindValue(':login', $cliente->getLogin(), PDO::PARAM_STR);
                $statement->bindValue(':senha', $cliente->getSenha(), PDO::PARAM_STR);
                $statement->bindValue(':mail', $cliente->getEmail(), PDO::PARAM_STR);

                $statement->execute();

                if($statement->rowCount() > 0) {
                    return true;
                }

                return false;
            } catch (PDOException $exception) {
                echo "<script>alert('O sistema gerou o seguinte erro: " . $exception->getMessage() . "');</script>";
            } finally {
                unset($connect);
            }
        }

        public function listarClientes (Cliente $cliente, Endereco $endereco) {
            try {
                $connect = getConnection();
                if($cliente->getIdcliente() == null){
                    $statement = $connect->query("select * from cliente inner join endereco on fk_endereco = 
                    id_endereco");
                    return $statement;
                } else {
                    $statement = $connect->query("select * from cliente inner join endereco on fk_endereco = 
                    id_endereco where id_cliente = " . $cliente->getIdcliente() . ";");

                    $resultados = $statement->fetch(PDO::FETCH_ASSOC);

                    $cliente->setIdcliente($resultados['id_cliente']);
                    $cliente->setNome($resultados['nome']);
                    $cliente->setTelefone($resultados['n_telefone']);
                    $cliente->setLogin($resultados['login_usuario']);
                    $cliente->setSenha($resultados['senha_usuario']);
                    $cliente->setStatus($resultados['statuscli']);
                    $cliente->setEmail($resultados['email']);
                    $cliente->setFkendereco($resultados['fk_endereco']);
                    $endereco->setIdendereco($resultados['id_endereco']);
                    $endereco->setRua($resultados['rua']);
                    $endereco->setCep($resultados['cep']);
                    $endereco->setNumero($resultados['numero']);
                    $endereco->setBairro($resultados['bairro']);
                    $endereco->setComplemento($resultados['complemento']);

                }

                return null;
            } catch (PDOException $exception) {
                echo "<script>alert('O sistema gerou o seguinte erro: " . $exception->getMessage() . "');</script>";
            } finally {
                unset($connect);
            }
        }

        public function alterarCliente (Cliente $cliente, Endereco $endereco) {
            try {
                $connect = getConnection();
                $sql = "UPDATE cliente LEFT JOIN endereco on fk_endereco = id_endereco set nome = :nome, n_telefone = :tel,
                login_usuario = :login, senha_usuario = :senha, email = :email, rua = :rua, cep = :cep, numero = :num, 
                bairro = :bairro, complemento = :comp WHERE id_cliente = :id";

                $statement = $connect->prepare($sql);

                $statement->bindValue(':nome', $cliente->getNome(), PDO::PARAM_STR);
                $statement->bindValue(':tel', $cliente->getTelefone(), PDO::PARAM_INT);
                $statement->bindValue(':login', $cliente->getLogin(), PDO::PARAM_STR);
                $statement->bindValue(':senha', $cliente->getSenha(), PDO::PARAM_STR);
                $statement->bindValue(':email', $cliente->getEmail(), PDO::PARAM_STR);
                $statement->bindValue(':rua', $endereco->getRua(), PDO::PARAM_STR);
                $statement->bindValue(':cep', $endereco->getCep(), PDO::PARAM_INT);
                $statement->bindValue(':num', $endereco->getNumero(), PDO::PARAM_INT);
                $statement->bindValue(':bairro', $endereco->getBairro(), PDO::PARAM_STR);
                $statement->bindValue(':comp', $endereco->getComplemento(), PDO::PARAM_STR);
                $statement->bindValue(':id', $cliente->getIdcliente(), PDO::PARAM_INT);

                $statement->execute();

                if($statement->rowCount() > 0) {
                    return true;
                }

                return false;
            } catch (PDOException $exception) {
                echo "<script>alert('O sistema gerou o seguinte erro: " . $exception->getMessage() . "');</script>";
            } finally {
                unset($connect);
            }
        }

        public function deletarCliente (Cliente $cliente) {
            try {
                $connect = getConnection();
                $sql = "CALL deletar_cliente(:id)";
                $statement = $connect->prepare($sql);

                $statement->bindValue(':id', $cliente->getIdcliente(), PDO::PARAM_INT);
                $statement->execute();

                if($statement->rowCount() > 0) {
                    return true;
                }

                return false;
            } catch (PDOException $exception) {
                echo "<script>alert('O sistema gerou o seguinte erro: " . $exception->getMessage() . "');</script>";
            } finally {
                unset($connect);
            }
        }

        public function desativarCliente (Cliente $cliente) {
            try {
                $connect = getConnection();
                $sql = "UPDATE cliente SET statuscli = 'INATIVO' WHERE id_cliente = :id";
                $statement = $connect->prepare($sql);

                $statement->bindValue(':id', $cliente->getIdcliente(), PDO::PARAM_INT);
                $statement->execute();

                if($statement->rowCount() > 0) {
                    return true;
                }

                return false;
            } catch (PDOException $exception) {
                echo "<script>alert('O sistema gerou o seguinte erro: " . $exception->getMessage() . "');</script>";
            } finally {
                unset($connect);
            }
        }

        public function ativarCliente (Cliente $cliente) {
            try {
                $connect = getConnection();
                $sql = "UPDATE cliente SET statuscli = 'ATIVO' WHERE id_cliente = :id";
                $statement = $connect->prepare($sql);

                $statement->bindValue(':id', $cliente->getIdcliente(), PDO::PARAM_INT);
                $statement->execute();

                if($statement->rowCount() > 0) {
                    return true;
                }

                return false;
            } catch (PDOException $exception) {
                echo "<script>alert('O sistema gerou o seguinte erro: " . $exception->getMessage() . "');</script>";
            } finally {
                unset($connect);
            }
        }

    }
