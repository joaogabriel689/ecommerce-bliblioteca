# 📚 E-commerce de Biblioteca — Projeto Acadêmico

Sistema simples de e-commerce desenvolvido em **PHP**, **HTML**, **CSS** e **MySQL**, criado para a disciplina de Tecnologia em Análise e Desenvolvimento de Sistemas.  
Atende aos requisitos básicos: CRUD completo, sessão de favoritos/carrinho e área administrativa.

---

## 🚀 Funcionalidades

### 👤 Usuários
- Cadastro de usuários  
- Login e logout  
- Edição e remoção de usuários (CRUD completo)

### 📚 Produtos (Livros)
- Cadastro de livros  
- Edição de livros  
- Remoção de livros  
- Listagem geral para visitantes e usuários logados  

### ❤️ Favoritos
- Salvos **na sessão** (não no banco)  
- Funciona para qualquer usuário logado  

### 🛒 Carrinho
- Carrinho baseado em **sessão**  
- Adição, remoção  de itens  

### 🔐 Área do Administrador
- Acesso restrito ao e-mail: **admin@bliblioteca.com**  
- Senha: qualquer (validação simples, apenas por e-mail)  
- CRUD completo de usuários e produtos

---

## 🧱 Tecnologias Utilizadas

- **PHP (procedural + rotinas simples)**
- **HTML5**
- **CSS puro**
- **JavaScript (apenas interações básicas)**
- **MySQL**
- **PDO para acesso ao banco**

---

## 🗄️ Banco de Dados

- Nome do banco: **estacio2025**
- Arquivo `.sql` incluído no projeto  
- Estrutura simplificada devido aos requisitos da disciplina  
- Favoritos e carrinho **não fazem parte do banco**, por exigência do projeto

---

## 📁 Estrutura do Projeto

/admin       → telas e ações administrativas
/class       → classes e lógica de negócio
/config      → conexão com o banco
/process     → processamentos de formulários
/public      → interface do usuário (home, catálogo, etc.)


---



## 🧪 Como Executar

1. Importe o banco `estacio2025.sql` no MySQL.  
2. Ajuste `conexao.php` com seu host, usuário e senha.  
3. Coloque o projeto dentro do diretório do servidor local (XAMPP/MAMP/LAMP).  
4. Acesse:http://localhost/ecommerce-bliblioteca/public

---

## 🔑 Acesso Admin

- **E-mail:** admin@bliblioteca.com  
- **Senha:** qualquer  

*(O sistema identifica apenas o e-mail do admin.)*

---

## 📌 Objetivo Acadêmico

Este projeto foi desenvolvido apenas para apresentação acadêmica, com foco em:

- Compreender CRUDs completos  
- Utilizar sessões no PHP  
- Praticar integração com MySQL usando PDO  
- Estruturar um mini e-commerce funcional  

Não é recomendado para uso em produção.

---

## 📸 Prints do Sistema



---

## 📄 Licença

Projeto acadêmico — uso livre para estudos.




