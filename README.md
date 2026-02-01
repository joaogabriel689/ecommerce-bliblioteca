# Branch: reorganizando-diretorios

Esta branch tem como objetivo **simplificar a estrutura do projeto**, facilitando a **manutenção**, o **entendimento do código** e a **evolução futura**.

---

## Estrutura anterior

Antes da reorganização, o projeto possuía apenas **3 classes principais**:

1. Conexão com o banco de dados  
2. Gerenciamento de usuários  
3. Gerenciamento de produtos  

Essa estrutura funcionava, mas dificultava a escalabilidade e a separação de responsabilidades.

---

## Nova estrutura do projeto

O projeto agora segue um padrão mais organizado e profissional:

### 1️⃣ Conexão com o banco
- Responsável apenas por criar e gerenciar a conexão com o banco de dados.

---

### 2️⃣ Repositórios
- Responsáveis **exclusivamente pela comunicação com o banco**.
- Contêm apenas **SQL e operações de persistência**.
- Existe **um repositório para cada tabela** do banco.

Exemplo:
- `UserRepository`
- `ProductRepository`
- `AddressRepository`
- `PedidoRepository`

---

### 3️⃣ Controllers
- Utilizam as classes de conexão e repositórios **por composição**.
- São responsáveis por:
  - Validação dos dados
  - Regras de negócio
  - Controle do fluxo da aplicação
- Não contêm SQL diretamente.

---

## Validações adicionadas

Foram implementadas validações para:
- ✅ CPF
- ✅ E-mail

Essas validações ocorrem antes do envio dos dados para os repositórios.

---

## Alterações na tabela de pedidos

Foram adicionadas novas colunas para melhorar o controle do carrinho/pedido:

- `valor_produto`
- `quantidade`
- `valor_total`

Esses campos permitem:
- Maior controle dos itens do pedido
- Facilidade no cálculo do total
- Histórico correto de preços

---

## Objetivo da reorganização

- Código mais limpo e legível
- Separação clara de responsabilidades
- Facilidade para manutenção e testes
- Base sólida para evolução do projeto

---
rotas:

auth
-/register
-/login
-/logout