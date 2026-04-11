# 📚 E-commerce Coutos Books

Um projeto de e-commerce para uma biblioteca online desenvolvido por  
@joaogabriel689 e @Luiz-Mtca-tech.

---

## 📌 Sobre o Projeto

Inicialmente, o projeto foi desenvolvido como um trabalho acadêmico, com diversas limitações — principalmente na modelagem do banco de dados exigida para facilitar a apresentação em sala de aula.

Essa modelagem não permitia funcionalidades básicas como:
- armazenamento de favoritos
- carrinho persistido no banco

Atualmente, o sistema está sendo evoluído para algo mais próximo de um sistema real de mercado.

---

## 🛠️ Tecnologias Utilizadas

- **Backend:** PHP (procedural)
- **Frontend:** HTML, CSS e JavaScript
- **Banco de Dados:** MySQL

---

## 🏗️ Arquitetura

Mesmo sendo um projeto em PHP procedural, o sistema segue uma organização em camadas:

### 📦 Repositórios
Responsáveis pelo acesso ao banco de dados e operações básicas de CRUD.

### 🎮 Controllers
Responsáveis pela validação dos dados e pela comunicação com os repositórios.

### 🌐 Rotas (arquivos `.php`)
Recebem e validam as requisições antes de chamar os controllers.

---

## 🔐 Segurança

O sistema implementa algumas práticas importantes de segurança:

- RBAC (Role-Based Access Control)
- Uso de query parameters para evitar SQL Injection
- Senhas armazenadas com PASSWORD_BCRYPT
- Sessões regenerativas e HttpOnly

---

## 👥 Roles do Sistema

- cliente  
- autorizado  
- administrador  

---

## 🚀 Principais Rotas

### 🔑 Autenticação

#### `/auth/register.php`

Recebe via POST:

- nome  
- email  
- cpf  
- password  
- data_nascimento  
- phone  

---

#### `/auth/login.php`

Recebe via POST:

- email  
- password  

---

#### `/auth/me.php`

Suporta:

- GET  
- POST  
- DELETE  

POST recebe:

- name  
- cpf  
- email  
- password  
- dataNasc  
- phone  
- group_code  

---

#### `/auth/logout.php`

Recebe via POST:

- logout  

---

## 📈 Evolução do Projeto

O projeto está em constante evolução, com foco em:

- melhoria da arquitetura  
- expansão das funcionalidades  
- aproximação com padrões reais de mercado  

---

## 📌 Observação

Apesar de utilizar PHP procedural, o projeto já aplica conceitos importantes de organização e segurança, servindo como base sólida para evolução futura.