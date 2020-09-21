<?php

    include_once '../connector/db-connector.php';
    include_once '../mapping/pedido.class.php';
    include_once '../mapping/itensPedido.class.php';
    include_once '../mapping/pagamento.class.php';
    include_once '../mapping/produto.class.php';


    class vendaAccess {

        public function iniciarVenda(Pedido $pedido) {
            try {
                $connect = getConnection();
                $sql = "INSERT INTO pedido VALUES (null, current_timestamp(), 0.0, null, 'Em andamento', :fkcli, null);";
                $statement = $connect->prepare($sql);

                $statement->bindValue(':fkcli', $pedido->getFkcliente(), PDO::PARAM_INT);
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

        public function adicionarItensVenda (itensPedido $itensPedido) {
            try {
                $connect = getConnection();
                $sql = "INSERT INTO itens_pedido VALUES (null, :quant, :idpedido, :idcliente);";
                $statement = $connect->prepare($sql);

                $statement->bindValue(':quant', $itensPedido->getQuantidade(), PDO::PARAM_INT);
                $statement->bindValue(':idpedido', $itensPedido->getFkpedido(), PDO::PARAM_INT);
                $statement->bindValue(':idcliente', $itensPedido->getFkpedido(), PDO::PARAM_INT);
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

        public function removerItensVenda (itensPedido $itensPedido) {
            try {
                $connect = getConnection();
                $sql = "DELETE FROM itens_pedido WHERE iditens_pedido = :iditem;";
                $statement = $connect->prepare();

                $statement->bindValue(':iditem', $itensPedido->getIditenspedido(), PDO::PARAM_INT);
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

        public function atualizarQuantidadeVenda (itensPedido $itensPedido) {
            try {
                $connect = getConnection();
                $sql = "UPDATE itens_pedido SET quantidade = :quant WHERE fk_pedido = :idpedido;";
                $statement = $connect->prepare($sql);

                $statement->bindValue(':quant', $itensPedido->getQuantidade(), PDO::PARAM_INT);
                $statement->bindValue(':idpedido', $itensPedido->getFkpedido(), PDO::PARAM_INT);
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

        public function listarVenda (Pedido $pedido, itensPedido $itensPedido, Produto $produto) {
            try {
                $connect = getConnection();

                if($pedido->getIdpedido() == null) {
                    $statement = $connect->query("select * from pedido 
                    join itens_pedido on fk_pedido = id_pedido 
                    join produto on fk_produto = id_produto");

                    return $statement;
                } else {
                    $statement = $connect->query("select * from pedido
                    join itens_pedido on fk_pedido = id_pedido
                    join produto on fk_produto = id_produto where id_pedido = " . $pedido->getIdpedido());

                    $resultset = $statement->fetch(PDO::FETCH_ASSOC);

                    $pedido->setIdpedido($resultset['id_pedido']);
                    $pedido->setDatahora($resultset['n_datahora']);
                    $pedido->setValor($resultset['n_valor']);
                    $pedido->setNomepedido($resultset['nome_pedido']);
                    $pedido->setStatus($resultset['status']);
                    $pedido->setFkcliente($resultset['cliente']);
                    $pedido->setFkfuncionario($resultset['fk_funcionario']);
                    $itensPedido->setIditenspedido($resultset['iditens_pedido']);
                    $itensPedido->setQuantidade($resultset['quantidade']);
                    $itensPedido->setFkpedido($resultset['fk_pedido']);
                    $itensPedido->setFkproduto($resultset['fk_produto']);
                    $produto->setIdproduto($resultset['id_produto']);
                    $produto->setDescricao($resultset['descricao_produto']);
                    $produto->setValor($resultset['valor']);
                    $produto->setObservacoes($resultset['observacoes']);
                    $produto->setProdativo($resultset['prodativo']);
                }
                return null;
            } catch (PDOException $exception) {
                echo "<script>alert('O sistema gerou o seguinte erro: " . $exception->getMessage() . "');</script>";
            } finally {
                unset($connect);
            }
        }

    }
