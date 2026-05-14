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

---

### 🔑 Autenticação

---

#### `POST /auth/register.php`

Cadastra um novo usuário.

**Body (POST):**

| Campo | Tipo | Descrição |
|-------|------|-----------|
| `nome` | string | Nome completo |
| `email` | string | E-mail do usuário |
| `cpf` | string | CPF do usuário |
| `password` | string | Senha |
| `data_nascimento` | string | Data de nascimento |
| `phone` | string | Telefone |

---

#### `POST /auth/login.php`

Autentica o usuário e inicia a sessão.

**Body (POST):**

| Campo | Tipo | Descrição |
|-------|------|-----------|
| `email` | string | E-mail do usuário |
| `password` | string | Senha |

---

#### `/auth/me.php`

Retorna ou atualiza os dados do usuário autenticado, ou encerra a conta.

**Métodos aceitos:** `GET` · `POST` · `DELETE`

**Body (POST):**

| Campo | Tipo | Descrição |
|-------|------|-----------|
| `name` | string | Nome completo |
| `cpf` | string | CPF |
| `email` | string | E-mail |
| `password` | string | Nova senha |
| `dataNasc` | string | Data de nascimento |
| `phone` | string | Telefone |
| `group_code` | string | Código do grupo/role |

> `GET` não requer body. `DELETE` encerra a conta do usuário autenticado.

---

#### `POST /auth/logout.php`

Encerra a sessão do usuário.

**Body (POST):**

| Campo | Tipo | Descrição |
|-------|------|-----------|
| `logout` | string | passar 'true' para fazer o logout |

---

### 📍 `/adress.php`

Gerencia endereços do usuário autenticado.

**Métodos aceitos:** `POST` · `PUT` · `DELETE`

> O método é definido pelo parâmetro `action` enviado no formulário.

**Body (POST / PUT):**

| Campo | Tipo | Descrição |
|-------|------|-----------|
| `rua` | string | Nome da rua |
| `bairro` | string | Bairro |
| `numero` | string | Número |
| `complemento` | string | Complemento |
| `cidade` | string | Cidade |
| `uf` | string | Estado (UF) |
| `cep` | string | CEP |

**Body (DELETE):**

| Campo | Tipo | Descrição |
|-------|------|-----------|
| `id` | int | ID do endereço a ser removido |

---

### 👤 `/users.php`

Gerencia usuários do sistema (uso administrativo).

**Métodos aceitos:** `POST` · `PUT` · `DELETE`

> O método é definido pelo parâmetro `action` enviado no formulário.  
> Retorna um **JSON**.

**Body (POST / PUT):**

| Campo | Tipo | Descrição |
|-------|------|-----------|
| `nome` | string | Nome completo |
| `cpf` | string | CPF |
| `password` | string | Senha |
| `email` | string | E-mail |
| `datanasc` | string | Data de nascimento |
| `phone` | string | Telefone |
| `group_code` | string | Código do grupo/role |

**Body (DELETE):**

| Campo | Tipo | Descrição |
|-------|------|-----------|
| `id` | int | ID do usuário a ser removido |

---

### 📦 `/products.php`

Gerencia o catálogo de produtos (livros).

**Métodos aceitos:** `GET` · `POST` · `PUT` · `DELETE`

---

#### `POST` / `PUT`

Cria ou atualiza um produto.

| Campo | Tipo | Descrição |
|-------|------|-----------|
| `id` | int | ID do produto (obrigatório no PUT) |
| `name` | string | Nome do livro |
| `tipo` | string | Tipo (ex: físico, digital) |
| `valor` | float | Preço |
| `autor` | string | Autor |
| `descriçao` | string | Descrição |
| `paginas` | int | Número de páginas |
| `idioma` | string | Idioma |
| `editora` | string | Editora |
| `categoria` | string | Categoria |
| `img` | file | Imagem do produto |

---

#### `GET`

Busca produtos. Aceita as seguintes formas de consulta:

**Por ID:**

| Parâmetro | Tipo | Descrição |
|-----------|------|-----------|
| `id` | int | ID do produto |

**Por termo (busca textual):**

| Parâmetro | Tipo | Descrição |
|-----------|------|-----------|
| `termo` | string | Busca com LIKE no nome/descrição |

**Por filtros:**

| Parâmetro | Tipo | Descrição |
|-----------|------|-----------|
| `category` | string | Filtra por categoria |
| `min_price` | float | Preço mínimo |
| `max_price` | float | Preço máximo |
| `tipo` | string | Tipo do produto |

**caso nenhum parametro seja passado, retornara todos os produtos**
---

#### `DELETE`

Remove um produto.

| Campo | Tipo | Descrição |
|-------|------|-----------|
| `id` | int | ID do produto a ser removido |

---

## 📈 Evolução do Projeto

O projeto está em constante evolução, com foco em:

- melhoria da arquitetura  
- expansão das funcionalidades  
- aproximação com padrões reais de mercado  

---

## 📌 Observação

Apesar de utilizar PHP procedural, o projeto já aplica conceitos importantes de organização e segurança, servindo como base sólida para evolução futura.