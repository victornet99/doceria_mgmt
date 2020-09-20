<?php

    include_once '../connector/db-connector.php';
    include_once '../mapping/produto.class.php';

    class produtoAccess {

        public function salvarProduto (Produto $produto) {
            try {
                $connect = getConnection();
                $sql = "INSERT INTO produto VALUES (null, :descprod, :valor, :observ, 'ATIVO')";
                $statement = $connect->prepare($sql);

                $statement->bindValue(':descprod', $produto->getDescricao(), PDO::PARAM_STR);
                $statement->bindValue(':valor', $produto->getValor(), PDO::PARAM_INT);
                $statement->bindValue(':observ', $produto->getObservacoes(), PDO::PARAM_STR);

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

        public function listarProdutos (Produto $produto) {
            try {
                $connect = getConnection();
                if($produto->getIdproduto() == null) {
                    $statement = $connect->query("SELECT * FROM produto");
                    return $statement;
                } else {
                    $statement = $connect->query("SELECT * FROM produto WHERE id_produto = " . $produto->getIdproduto());
                    $resultados = $statement->fetch(PDO::FETCH_ASSOC);

                    $produto->setIdproduto($resultados['id_produto']);
                    $produto->setDescricao($resultados['descricao_produto']);
                    $produto->setValor($resultados['valor']);
                    $produto->setObservacoes($resultados['observacoes']);
                    $produto->setProdativo($resultados['prodativo']);

                }
                return null;
            } catch (PDOException $exception) {
                echo "<script>alert('O sistema gerou o seguinte erro: " . $exception->getMessage() . "');</script>";
            } finally {
                unset($connect);
            }
        }

        public function alterarProduto (Produto $produto) {
            try {
                $connect = getConnection();
                $sql = "UPDATE produto SET descricao_produto = :desc, valor = :val, observacoes = :obs WHERE id_produto = :id";
                $statement = $connect->prepare($sql);

                $statement->bindValue(':descprod', $produto->getDescricao(), PDO::PARAM_STR);
                $statement->bindValue(':valor', $produto->getValor(), PDO::PARAM_INT);
                $statement->bindValue(':observ', $produto->getObservacoes(), PDO::PARAM_STR);
                $statement->bindValue(':id', $produto->getIdproduto(), PDO::PARAM_INT);
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

        public function desativarProduto (Produto $produto) {
            try {
                $connect = getConnection();
                $sql = "UPDATE produto set prodativo = 'INATIVO' WHERE id_produto = :id";
                $statement = $connect->prepare($sql);

                $statement->bindValue(':id', $produto->getIdproduto(), PDO::PARAM_INT);
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

        public function ativarProduto (Produto $produto) {
            try {
                $connect = getConnection();
                $sql = "UPDATE produto set prodativo = 'ATIVO' WHERE id_produto = :id";
                $statement = $connect->prepare($sql);

                $statement->bindValue(':id', $produto->getIdproduto(), PDO::PARAM_INT);
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
