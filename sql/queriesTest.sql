-- Traz os resultados que estão na esquerda do relacionamento
SELECT * FROM funcionario
LEFT JOIN tipo_funcionario on id_funcionario = id_tipofuncionario;

-- Insert de algumas informações e de múltiplas informações ao mesmo tempo
insert into tipo_funcionario values (null, 'Admin'), (null,'Gerente'), (null,'Vendedor'), (null, 'Entregador');
insert into funcionario values (null, 'André Batista', '00874958210', '22522824','045180','ATIVO',current_date(),null,'98127-7936','andre','andre',1);

-- Update na tabela do funcionário, de teste
update funcionario set nome = 'João Marcos', cpf = '3213123123', rg = '3123123', ctps = '32312313', 
nr_telefone = '31231231', login = 'joao', senha = 'joao', fk_tipo_funcionario = 3
where id_funcionario = 1;

-- stored procedures 
-- Essa procedure me permite salvar os dados do cliente e do endereço de uma vez só, uma vez que insert
-- não permite uso de joins
delimiter //
create procedure salvar_cliente (
	in ruacli varchar(100), in cepcli int, in numcli int, in baicli varchar(45), in compcli varchar(45),
	in nomecli varchar(100), in telcli int, in logcli varchar(45), in senhacli varchar(45), in statuscli varchar(10), in email varchar(100)
)
	begin
		declare fkend int unsigned default 0;
    
		insert into endereco values (null, ruacli, cepcli, numcli, baicli, compcli);
        set fkend = last_insert_id();
        insert into cliente values (null, nomecli, telcli, logcli, senhacli, statuscli, email, fkend);
	end//
    
delimiter ;

-- Chamei a call para salvar os registros do cliente e do endereço dele
call salvar_cliente('Rua Xablau', 69666666, 666, 'Puraquequara','Perto da Casa do Ca****', 'Ezequiel', 98745666, 'ezequiel','ezequiel','ATIVO','ezequiel@lucifer.gov.br');

-- Atualizei o cadastro do cliente, que tem um relacionamento com endereço, dessa forma: 
update cliente left join endereco on fk_endereco = id_endereco set nome = 'André Souza', rua = 'Rua Martins Ferreira Sá', cep = 69044512 where id_cliente = 1;

-- Esse delete vai dar ruim...
delete from cliente where id_cliente = 1;

-- Temos um problema. Se excluirmos o cliente, o endereço vai permanecer lá. Para saber disso, usei o right join
select * from cliente right join endereco on fk_endereco = id_endereco;

-- Para expurgar o endereço vinculado a um cliente, preciso fazer uma alteração na chave estrangeira da tabela funcionário:
ALTER TABLE `bd_doceria`.`cliente` DROP FOREIGN KEY `fk_cliente_endereco1`;

-- O "ON DELETE CASCADE" vai me permitir apagar o registro do endereço, vinculado ao cliente em questão
ALTER TABLE `bd_doceria`.`cliente` ADD CONSTRAINT `fk_cliente_endereco1` FOREIGN KEY (`fk_endereco`) REFERENCES `bd_doceria`.`endereco` (`id_endereco`) ON DELETE CASCADE;

-- Vamos testar agora o "DELETE CASCADE"
delete from cliente where id_cliente = 2;
select * from cliente right join endereco on fk_endereco = id_endereco;

-- Não funcionou. Vamos reverter o processo. O "ON DELETE RESTRICT" reverte para o padrão do MySQL, que é não permitir a exclusão de registros vinculados a uma chave estrangeira
ALTER TABLE `bd_doceria`.`cliente` DROP FOREIGN KEY `fk_cliente_endereco1`;
ALTER TABLE `bd_doceria`.`cliente` ADD CONSTRAINT `fk_cliente_endereco1` FOREIGN KEY (`fk_endereco`) REFERENCES `bd_doceria`.`endereco` (`id_endereco`) ON DELETE RESTRICT;

-- Percebi uma coisa: a chave do cliente e a do endereço vão ser sempre a mesma. Vamos apelar para a procedure!
delimiter //
create procedure deletar_cliente (in id int)
	begin
		delete from cliente where id_cliente = id;
        delete from endereco where id_endereco = id;
	end//
    
delimiter ;

-- Vamos testar agora a procedure que vai deletar o cliente junto com o endereço. Funcionou!!!
call deletar_cliente(4);

-- Lembrei! Cliente vai ter compras vinculadas a ele. Não vai poder ser deletado, mas sim, DESATIVADO... É melhor desativar ele, mas vamos deixar
-- a procedure aí... Vai que, né? Vamos só adicionar um campo pra ele, chamado "status";
ALTER TABLE cliente ADD COLUMN statuscli VARCHAR(10) NOT NULL AFTER senha_usuario;

-- É melhor que produto apenas seja desativado dentro da plataforma
ALTER TABLE produto ADD COLUMN prodativo varchar(10) not null after observacoes;

-- Pronto. Tudo ok, por ora. Amanhã tem mais ;)

-- Vamos tentar abrir uma venda aqui
INSERT INTO pedido VALUES (null, current_timestamp(), 0.0, null, 'Em andamento', 5, null);

-- Vamos ver como ficou. Pelo visto, a venda foi aberta!
select * from pedido;

-- Vamos adicionar itens na venda!
INSERT INTO itens_pedido VALUES (null, 2, 3, 2);

-- E atualizar algumas coisas...
UPDATE itens_pedido SET quantidade = 4 WHERE fk_pedido = 3;

-- Vamos ver como foi:
SELECT * FROM itens_pedido;

-- Vamos tentar remover algum item do pedido:
DELETE FROM itens_pedido WHERE iditens_pedido = 2;

-- Temos que listar a venda inteira. Vamos ver o que dá pra fazer :)
select * from pedido
join itens_pedido on fk_pedido = id_pedido
join produto on fk_produto = id_produto
where id_pedido = 3;

-- Agora, para finalizar a venda, precisamos atualizar o pedido e salvar na tabela do pagamento
