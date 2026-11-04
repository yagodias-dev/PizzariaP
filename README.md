# 🍕 Pizzaria Primícia — Delivery

![PHP](https://img.shields.io/badge/PHP-1a0b2e?style=flat-square&logo=php&logoColor=E040FB)
![MySQL](https://img.shields.io/badge/MySQL-1a0b2e?style=flat-square&logo=mysql&logoColor=E040FB)
![JavaScript](https://img.shields.io/badge/JavaScript-1a0b2e?style=flat-square&logo=javascript&logoColor=E040FB)
![XAMPP](https://img.shields.io/badge/XAMPP-1a0b2e?style=flat-square&logo=xampp&logoColor=E040FB)

🇧🇷 Site de delivery de uma pizzaria fictícia, com cardápio, carrinho, finalização de pedido e um painel para a pizzaria acompanhar e atualizar o status dos pedidos.

🇺🇸 *Delivery website for a fictional pizzeria, with menu, cart, checkout and an admin panel to track and update order status.*

## O que é

**Para o cliente**
- Cardápio com as pizzas e botão de adicionar ao carrinho
- Carrinho salvo no navegador (`localStorage`)
- Finalização do pedido com dados de contato, endereço de entrega, forma de pagamento e observações
- Página com os detalhes do pedido feito

**Para a pizzaria** (`admin_pedidos.php`)
- Lista de todos os pedidos com cliente, itens e total
- Alteração de status: **Pendente → Preparando → Em Entrega → Finalizado** (ou Cancelado)

**No back-end**
- PHP com **PDO** e *prepared statements* em todas as consultas
- Pedido gravado em três tabelas: `clientes`, `pedidos` e `itens_pedido`
- Se o telefone já existe, o cliente é reaproveitado em vez de duplicado

## Tecnologias

- PHP com PDO
- MySQL / MariaDB
- HTML5, CSS3 e JavaScript (`fetch` para enviar o pedido)
- XAMPP para rodar localmente

## Como rodar

1. Instale o [XAMPP](https://www.apachefriends.org/) e inicie o **Apache** e o **MySQL**.
2. Clone o projeto dentro da pasta `htdocs`:

   ```bash
   cd C:\xampp\htdocs
   git clone https://github.com/yagodias-dev/PizzariaP.git
   ```

3. Abra o **phpMyAdmin** (`http://localhost/phpmyadmin`) e crie o banco. O script abaixo é um **exemplo** montado a partir das consultas do código; ajuste tipos e tamanhos se precisar:

   ```sql
   -- EXEMPLO de estrutura do banco
   CREATE DATABASE pizzaria_primicia CHARACTER SET utf8mb4;
   USE pizzaria_primicia;

   CREATE TABLE clientes (
     id INT AUTO_INCREMENT PRIMARY KEY,
     nome_completo VARCHAR(150) NOT NULL,
     telefone VARCHAR(20) NOT NULL,
     email VARCHAR(150)
   );

   CREATE TABLE pedidos (
     id INT AUTO_INCREMENT PRIMARY KEY,
     cliente_id INT NOT NULL,
     endereco_entrega VARCHAR(255) NOT NULL,
     forma_pagamento VARCHAR(30) NOT NULL,
     observacoes TEXT,
     total DECIMAL(10,2) NOT NULL,
     status VARCHAR(20) NOT NULL DEFAULT 'Pendente',
     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
     FOREIGN KEY (cliente_id) REFERENCES clientes(id)
   );

   CREATE TABLE itens_pedido (
     id INT AUTO_INCREMENT PRIMARY KEY,
     pedido_id INT NOT NULL,
     nome_pizza VARCHAR(100) NOT NULL,
     preco DECIMAL(10,2) NOT NULL,
     quantidade INT NOT NULL,
     subtotal DECIMAL(10,2) NOT NULL,
     FOREIGN KEY (pedido_id) REFERENCES pedidos(id)
   );
   ```

4. Se o seu MySQL tiver senha, ajuste o `config.php`.
5. Acesse `http://localhost/PizzariaP`. O painel da pizzaria fica em `http://localhost/PizzariaP/admin_pedidos.php`.

## Próximos passos

- Adicionar login no painel da pizzaria (hoje ele é aberto, porque o projeto foi feito para rodar localmente)
- Ler as credenciais do banco de variáveis de ambiente em vez do `config.php`

> Projeto de estudo. Pizzaria e dados fictícios; imagens do Pexels.
