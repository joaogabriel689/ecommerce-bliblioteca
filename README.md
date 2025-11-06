# 🛒 E-commerce - Biblioteca Online

Um sistema de **e-commerce simples**, desenvolvido em **PHP**, com **sistema de login**, **painel administrativo** e **design responsivo**.  
Este projeto foi criado como parte de um aprendizado prático em **desenvolvimento web full stack**, utilizando tecnologias acessíveis e eficientes.

---

## 🚀 Tecnologias Utilizadas

- **HTML5** – Estrutura das páginas  
- **CSS3** – Estilização responsiva e moderna  
- **PHP (Procedural)** – Lógica de autenticação e controle de sessão  
- **MySQL** – Armazenamento de usuários e produtos  
- **Font Awesome** – Ícones estilizados  

---

## ⚙️ Funcionalidades

✅ Login e autenticação de usuários  
✅ Controle de sessão (usuário comum e administrador)  
✅ Redirecionamento automático por tipo de conta  
✅ Interface intuitiva para login  
✅ Estrutura pronta para integração com banco de dados  

---

## 📂 Estrutura do Projeto

📁 ecommerce-biblioteca/
├── index.php # Página inicial
├── login.html # Página de login
├── process-login.php # Script de validação de login
├── admin.php # Painel do administrador
├── connection.php # Conexão com o banco de dados (não incluído)
├── /style # Folhas de estilo (CSS)
├── /images # Ícones e imagens do projeto
└── README.md


---

## 🧠 Como Funciona o Login

O sistema utiliza **validação via PHP** e **sessions** para garantir segurança e controle de acesso.

1. O usuário preenche o formulário em `login.html`.  
2. Os dados são enviados via `POST` para `process-login.php`.  
3. O sistema verifica as credenciais no banco de dados.  
4. Dependendo do tipo de usuário, ele é redirecionado para:
   - `index.php` (usuário comum)
   - `admin.php` (administrador)

---

## 🖼️ Captura de Tela

![Login]()

---

## 🧩 Próximos Passos

- Adicionar área de cadastro de produtos  
- Implementar carrinho de compras  
- Criar painel de administração completo  
- Adicionar hashing de senha com `password_hash()`  
- Melhorar design com Bootstrap ou Tailwind CSS  

---

## 👨‍💻 Autor

**João Couto**  
📚 Estudante de Análise e Desenvolvimento de Sistemas  
💡 Apaixonado por tecnologia e desenvolvimento web  

---

## 🪪 Licença

Este projeto é de uso livre para fins **educacionais e de aprendizado**.  
Sinta-se à vontade para **clonar, modificar e contribuir!**

---

### ⭐ Dê um Star no repositório se gostou 
