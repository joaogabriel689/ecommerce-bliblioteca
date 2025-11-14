# 📚 Biblioteca Online

Sistema web de gerenciamento de biblioteca online desenvolvido em PHP puro com MySQL, permitindo cadastro de usuários, catálogo de livros, carrinho de compras e painel administrativo completo.

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)

## 🎯 Sobre o Projeto

Sistema completo de biblioteca online que permite:
- 👤 Cadastro e autenticação de usuários
- 📖 Catálogo de livros com busca e filtros
- 🛒 Carrinho de compras
- ❤️ Sistema de favoritos
- 🔐 Área administrativa para gerenciamento
- 📦 Controle de estoque e pedidos

## 🚀 Funcionalidades

### Para Usuários
- ✅ Cadastro de conta com dados pessoais
- ✅ Login seguro com senha criptografada (bcrypt)
- ✅ Navegação pelo catálogo de livros
- ✅ Adicionar livros aos favoritos
- ✅ Carrinho de compras
- ✅ Painel de controle pessoal
- ✅ Gerenciamento de endereços
- ✅ Histórico de pedidos

### Para Administradores
- ✅ Painel administrativo completo
- ✅ Cadastro, edição e exclusão de livros
- ✅ Gerenciamento de usuários
- ✅ Upload de imagens de livros
- ✅ Controle de estoque
- ✅ Visualização de vendas
- ✅ Sistema de categorias

## 🛠️ Tecnologias Utilizadas

- **Backend**: PHP 8.2+
- **Banco de Dados**: MySQL/MariaDB
- **Frontend**: HTML5, CSS3, JavaScript
- **Arquitetura**: MVC (Model-View-Controller)
- **Segurança**: 
  - Prepared Statements (prevenção SQL Injection)
  - Password Hashing (bcrypt)
  - Controle de sessões
- **Ícones**: Font Awesome 7.0.1

## 📁 Estrutura do Projeto

```
biblioteca-online/
│
├── admin/                    # Área administrativa
│   ├── admin.php            # Dashboard admin
│   ├── books.php            # Gerenciar livros
│   ├── users.php            # Gerenciar usuários
│   ├── book-alter.php       # Editar livro
│   └── user-alter.php       # Editar usuário
│
├── public/                   # Área pública
│   ├── index.php            # Página inicial
│   ├── login.html           # Login
│   ├── register.html        # Cadastro
│   └── catalog-books.php    # Catálogo completo
│
├── user/                     # Área do usuário
│   └── painel_controle.php  # Painel do usuário
│
├── process/                  # Processamento de dados
│   ├── process-login.php
│   ├── process-register.php
│   ├── process-book-*.php
│   └── process-user-*.php
│
├── class/                    # Classes PHP (OOP)
│   ├── usersclass.php       # Classe User
│   ├── productclass.php     # Classe Product
│   └── connectionclass.php  # Conexão com BD
│
├── config/                   # Configurações
│   └── connection.php       # Instância de conexão
│
├── uploads/                  # Upload de imagens
│
├── style/                    # Arquivos CSS
│
├── images/                   # Imagens do sistema
│
└── exit.php                 # Logout
```

## 💾 Banco de Dados

### Tabela: `usuarios`
```sql
CREATE TABLE `usuarios` (
  `id_usuario` INT PRIMARY KEY AUTO_INCREMENT,
  `nome` VARCHAR(255),
  `email` VARCHAR(60) NOT NULL UNIQUE,
  `senha` VARCHAR(255) NOT NULL,
  `endereco` VARCHAR(255),
  `cidade` VARCHAR(255),
  `estado` CHAR(2),
  `telefone` INT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```


### Tabela: `produtos`
```sql
CREATE TABLE `produtos` (
  `id_produto` INT PRIMARY KEY AUTO_INCREMENT,
  `nome` VARCHAR(100),
  `qtd` INT,
  `descricao` TEXT,
  `valor` DECIMAL(10,2)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

## 🔧 Instalação

### Pré-requisitos
- PHP 8.0 ou superior
- MySQL 5.7+ ou MariaDB 10.3+
- Servidor Apache/Nginx


### Passo a Passo

1. **Clone o repositório**
```bash
git clone https://github.com/seu-usuario/biblioteca-online.git
cd biblioteca-online
```

2. **Configure o banco de dados**
```bash
# Crie o banco de dados
mysql -u root -p
CREATE DATABASE estacio2025;
USE estacio2025;

# Importe o schema
SOURCE estacio2025.sql;
```

3. **Configure a conexão**

Edite o arquivo `config/connection.php`:
```php
$db_name = 'estacio2025';
$db_host = 'localhost';
$db_user = 'seu_usuario';
$db_pass = 'sua_senha';
```

4. **Configure permissões**
```bash
chmod 755 uploads/
chmod 644 config/connection.php
```

5. **Crie o usuário admin**
```sql
INSERT INTO usuarios (nome, email, senha, endereco, cidade, estado, telefone) 
VALUES (
  'Administrador', 
  'admin@bliblioteca.com', 
  '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', -- senha: password
  'Rua Admin, 123', 
  'Campo Grande', 
  'MS', 
  67999999999
);
```

6. **Acesse o sistema**
```
http://localhost/biblioteca-online/public/index.php
```

**Login Admin:**
- Email: `admin@bliblioteca.com`
- Senha: `password`

## 🎨 Screenshots

### Página Inicial
![Home](https://via.placeholder.com/800x400/4A90E2/FFFFFF?text=P%C3%A1gina+Inicial)

### Catálogo de Livros
![Catálogo](https://via.placeholder.com/800x400/50C878/FFFFFF?text=Cat%C3%A1logo+de+Livros)

### Painel Admin
![Admin](https://via.placeholder.com/800x400/E74C3C/FFFFFF?text=Painel+Administrativo)

## 🔐 Segurança

- ✅ Senhas criptografadas com `password_hash()` (bcrypt)
- ✅ Prepared Statements para prevenir SQL Injection
- ✅ Controle de sessão por tipo de usuário
- ✅ Validação de uploads de imagem
- ✅ Proteção de rotas administrativas

## 📝 Uso

### Cadastro de Novo Usuário
1. Acesse `/public/register.html`
2. Preencha os dados pessoais
3. Clique em "Cadastrar"
4. Faça login com suas credenciais

### Adicionar Livro (Admin)
1. Faça login como admin
2. Acesse "Catálogo de Livros"
3. Preencha o formulário de cadastro
4. Faça upload da imagem do livro
5. Clique em "Cadastrar"

### Comprar Livro (Usuário)
1. Navegue pelo catálogo
2. Clique em "Adicionar ao Carrinho"
3. Acesse o carrinho
4. Finalize a compra

## 🐛 Problemas Conhecidos

- [ ] Carrinho de compras em desenvolvimento
- [ ] Sistema de favoritos incompleto
- [ ] Sistema de pedidos em desenvolvimento



## 🤝 Contribuindo

Contribuições são sempre bem-vindas!

1. Fork o projeto
2. Crie uma branch para sua feature (`git checkout -b feature/MinhaFeature`)
3. Commit suas mudanças (`git commit -m 'Adiciona MinhaFeature'`)
4. Push para a branch (`git push origin feature/MinhaFeature`)
5. Abra um Pull Request

### Padrões de Código
- Use PSR-12 para código PHP
- Comente código complexo
- Escreva nomes descritivos para variáveis
- Mantenha funções pequenas e específicas

## 📄 Licença

Este projeto está sob a licença MIT. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.

## 👤 Autor

**João Gabriel Pereira Couto**

- GitHub: [@joaogabriel689](https://github.com/joaogabriel689)
- LinkedIn: [João Couto](https://www.linkedin.com/in/joao-couto-b55b04321/)
- Instagram: [@joao_pereira_couto](https://www.instagram.com/joao_pereira_couto/)

## 🙏 Agradecimentos

- Font Awesome pelos ícones
- Estácio pela oportunidade de desenvolver este projeto
- Comunidade PHP Brasil

---

⭐ Se este projeto te ajudou, considere dar uma estrela!

**Desenvolvido com ❤️ por João Gabriel**