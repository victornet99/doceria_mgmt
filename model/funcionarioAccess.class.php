<?php

require_once '../connector/db-connector.php';
require_once '../mapping/funcionario.class.php';
require_once '../mapping/tipoFuncionario.class.php';

class funcionarioAccess
{

    public function salvarFuncionario(Funcionario $funcionario)
    {
        try {
            $connect = getConnection();

            $statement = $connect->prepare("INSERT INTO funcionario VALUES (null, :nome, :cpf, :rg, :ctps, 
            'ATIVO', current_date(),null, :tel, :login, :senha, :functype)");

            $statement->bindValue(':nome', $funcionario->getNome(), PDO::PARAM_STR);
            $statement->bindValue(':cpf', $funcionario->getCpf(), PDO::PARAM_STR);
            $statement->bindValue(':rg', $funcionario->getRg(), PDO::PARAM_STR);
            $statement->bindValue(':ctps', $funcionario->getCtps(), PDO::PARAM_STR);
            $statement->bindValue(':tel', $funcionario->getNrtelefone(), PDO::PARAM_STR);
            $statement->bindValue(':login', $funcionario->getLogin(), PDO::PARAM_STR);
            $statement->bindValue(':senha', $funcionario->getSenha(), PDO::PARAM_STR);
            $statement->bindValue(':functype', $funcionario->getFktipofuncionario(), PDO::PARAM_INT);

            $statement->execute();
            if ($statement->rowCount() > 0) {
                return true;
            }
            return false;
        } catch (PDOException $exception) {
            echo "<script>alert('O sistema gerou o seguinte erro: " . $exception->getMessage() . "');</script>";
        }
    }

    public function listFuncionarios(Funcionario $funcionario, tipoFuncionario $tipoFuncionario)
    {
        try {
            $connect = getConnection();
            if ($funcionario->getIdfuncionario() == null) {
                $statement = $connect->query("SELECT * FROM funcionario JOIN tipo_funcionario ON 
                    fk_tipo_funcionario = id_tipofuncionario");

                return $statement;
            } else {
                $statement = $connect->query("SELECT * FROM funcionario JOIN tipo_funcionario ON 
                    fk_tipo_funcionario = id_tipofuncionario WHERE id_funcionario = " . $funcionario->getIdfuncionario() .
                    ";");

                $resultados = $statement->fetch(PDO::FETCH_ASSOC);
                $funcionario->setIdfuncionario($resultados['id_funcionario']);
                $funcionario->setNome($resultados['nome']);
                $funcionario->setCpf($resultados['cpf']);
                $funcionario->setRg($resultados['rg']);
                $funcionario->setCtps($resultados['ctps']);
                $funcionario->setStatus($resultados['status']);
                $funcionario->setDataadmissao($resultados['data_admissao']);
                $funcionario->setDatademissao($resultados['data_demissao']);
                $funcionario->setNrtelefone($resultados['nr_telefone']);
                $funcionario->setLogin($resultados['login']);
                $funcionario->setSenha($resultados['senha']);
                $funcionario->setFktipofuncionario($resultados['fk_tipo_funcionario']);
                $tipoFuncionario->setIdtipofuncionario($resultados['id_tipofuncionario']);
                $tipoFuncionario->setDesctipofuncionario($resultados['desc_tipofuncionario']);

            }
            return null;

        } catch (PDOException $exception) {
            echo "<script>alert('O sistema gerou o seguinte erro: " . $exception->getMessage() . "');</script>";
        }
    }

    public function demitirFuncionario(Funcionario $funcionario)
    {
        try {
            $connect = getConnection();
            $statement = $connect->prepare("UPDATE funcionario SET data_demissao = CURRENT_DATE(), 
                status = 'DESLIGADO' WHERE id_funcionario = :id");

            $statement->bindValue(':id', $funcionario->getIdfuncionario(), PDO::PARAM_INT);
            $statement->execute();

            if ($statement->rowCount() > 0) {
                return true;
            }

            return false;

        } catch (PDOException $exception) {
            echo "<script>alert('O sistema gerou o seguinte erro: " . $exception->getMessage() . "');</script>";
        } finally {
            unset($connect);
        }
    }

    public function readmitirFuncionario(Funcionario $funcionario)
    {
        try {
            $connect = getConnection();
            $statement = $connect->prepare("UPDATE funcionario SET data_admissao = CURRENT_DATE(), 
                data_demissao = null, status = 'ATIVO' WHERE id_funcionario = :id");

            $statement->bindValue(':id', $funcionario->getIdfuncionario(), PDO::PARAM_INT);
            $statement->execute();

            if ($statement->rowCount() > 0) {
                return true;
            }

            return false;

        } catch (PDOException $exception) {
            echo "<script>alert('O sistema gerou o seguinte erro: " . $exception->getMessage() . "');</script>";
        } finally {
            unset($connect);
        }
    }

    public function atualizarCadastro(Funcionario $funcionario)
    {
        try {
            $connect = getConnection();
            $sql = "update funcionario set nome = :nome, cpf = :cpf, rg = :rg, ctps = :ctps, nr_telefone = :tel, 
            login = :login, senha = :senha, fk_tipo_funcionario = :functype where id_funcionario = :id";

            $statement = $connect->prepare($sql);

            $statement->bindValue(':nome', $funcionario->getNome(), PDO::PARAM_STR);
            $statement->bindValue(':cpf', $funcionario->getCpf(), PDO::PARAM_STR);
            $statement->bindValue(':rg', $funcionario->getRg(), PDO::PARAM_STR);
            $statement->bindValue(':ctps', $funcionario->getCtps(), PDO::PARAM_STR);
            $statement->bindValue(':tel', $funcionario->getNrtelefone(), PDO::PARAM_STR);
            $statement->bindValue(':login', $funcionario->getLogin(), PDO::PARAM_STR);
            $statement->bindValue(':senha', $funcionario->getSenha(), PDO::PARAM_STR);
            $statement->bindValue(':functype', $funcionario->getFktipofuncionario(), PDO::PARAM_INT);
            $statement->bindValue(':id', $funcionario->getIdfuncionario(), PDO::PARAM_INT);

            $statement->execute();

            if($statement->rowCount() > 0){
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
