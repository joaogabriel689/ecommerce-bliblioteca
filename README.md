# 📚 Biblioteca Online — E-commerce de Livros (PHP + MySQL)

Sistema desenvolvido como projeto acadêmico para a disciplina de TADS.  
O objetivo é implementar um e-commerce simples de livros, com controle de usuários, administração e funcionalidades essenciais de um catálogo digital.

---

## 🚀 Funcionalidades Principais

- Catálogo de livros com listagem e detalhes
- Sistema de usuários (cadastro, login e atualização)
- Área administrativa protegida
  - CRUD completo de livros
  - CRUD completo de usuários
- Carrinho de compras (salvo em sessão)
- Lista de favoritos (salva em sessão)
- Validação básica de formulários
- Organização em pastas seguindo um MVC simplificado

---

## 🗂️ Tecnologias Utilizadas

- **PHP puro (procedural + classes simples)**
- **MySQL** (schema incluso no projeto — banco: `estacio2025`)
- **HTML5 + CSS3**
- **JavaScript básico**
- Servidor local: Apache (XAMPP/LAMP/WAMP)

---

## 🛠️ Instalação e Execução

1. Clone o repositório:
   ```bash
   git clone https://github.com/joaogabriel689/ecommerce-bliblioteca
2.Importe o banco de dados:

  Acesse o phpMyAdmin
  
  Crie o banco:
  
  CREATE DATABASE estacio2025;
  
  
  Importe o arquivo SQL localizado em:
  
  /database/estacio2025.sql
  
  
3.Configure a conexão:
  
  Arquivo:
  
  /config/connection.php
  
  
  Ajuste usuário e senha do MySQL conforme o seu ambiente.
  
4.Aponte o servidor para a pasta:
  
  /public
  
  
5.Acesse no navegador:
  
  http://localhost

🔐 Acesso Administrativo

A área administrativa só pode ser acessada por um e-mail específico:

E-mail: admin@bliblioteca.com

Senha: definida por você diretamente no banco ao cadastrar o usuário admin.

Sem esse e-mail, o sistema bloqueia o acesso ao painel de administração.

📦 Estrutura do Projeto
/admin       → telas e ações administrativas
/class       → classes e lógica de negócio
/config      → conexão com o banco
/process     → processamentos de formulários
/public      → parte visível ao usuário (home, catálogo, etc.)
📌 Observações Importantes

Carrinho e favoritos são armazenados em sessões, conforme restrições do projeto.

O sistema possui responsividade parcial; o requisito de responsividade em JavaScript não foi totalmente implementado.

Todas as operações de banco utilizam PDO com prepared statements.

📸 Capturas de Tela (adicione aqui)

Exemplo:

Home

Catálogo

Área Admin

CRUD de Livro

CRUD de Usuário

📄 Licença

Projeto acadêmico — livre para uso educacional.

---



