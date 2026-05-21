# 📒 Contacts API

> API REST para gerenciamento de agenda de contatos — construída com Laravel 13 e MySQL.

## 📋 Sobre o projeto

O **Contacts API** é uma API de gerenciamento de agenda de contatos com suporte a busca por nome. O projeto foi desenvolvido como portfólio para demonstrar conhecimentos em arquitetura de APIs REST, validação de dados e boas práticas de desenvolvimento back-end com Laravel.

## ✨ Funcionalidades

| Ação | Descrição |
|---|---|
| **Listar contatos** | Retorna todos os contatos cadastrados |
| **Buscar por nome** | Filtra contatos pelo nome usando busca parcial |
| **Criar contato** | Cadastra um novo contato com validação |
| **Editar contato** | Atualiza parcialmente os dados de um contato |
| **Apagar contato** | Remove um contato da agenda |

## 🛠️ Tecnologias utilizadas

- **PHP 8.5** + **Laravel 13**
- **MySQL** — banco de dados relacional
- **Eloquent ORM** — mapeamento objeto-relacional
- **Form Request** — validação de dados separada por operação
- **Database Seeder** — contatos iniciais pré-cadastrados
- **Postman** — testes de endpoints durante desenvolvimento

## 🏗️ Arquitetura

```
app/
├── Http/
│   ├── Controllers/
│   │   └── ContactController.php        # Gerencia todas as ações de contatos
│   └── Requests/
│       ├── StoreContactRequest.php      # Validação na criação
│       └── UpdateContactRequest.php     # Validação na edição
└── Models/
    └── Contact.php                      # Model com campos permitidos

database/
├── migrations/
│   └── create_contacts_table.php        # Estrutura da tabela
└── seeders/
    └── ContactSeeder.php                # Contatos iniciais pré-cadastrados
```

**Fluxo de uma requisição:**

```
Requisição → Validação (Form Request) → Controller → Eloquent → Banco → Resposta JSON
```

## 🧠 Decisões técnicas

### Por que dois Form Requests separados?
As regras de validação são diferentes para criar e editar. Na criação, `name` e `phone` são obrigatórios. Na edição, todos os campos são opcionais — o usuário pode querer atualizar só o email. Separar em `StoreContactRequest` e `UpdateContactRequest` deixa cada classe com uma responsabilidade clara.

### Por que `sometimes` no UpdateContactRequest?
O `sometimes` diz ao Laravel: "só valide esse campo se ele foi enviado na requisição". Isso permite edições parciais — o usuário não precisa reenviar todos os campos para atualizar apenas um.

### Por que Route Model Binding?
Em vez de buscar manualmente `Contact::find($id)` em cada método, o Laravel injeta automaticamente o contato certo pelo ID da URL. Se não existir, retorna 404 sozinho. Menos código, mais segurança.

## 🚀 Como rodar localmente

### Pré-requisitos

- PHP 8.2+
- Composer
- MySQL

### Instalação

```bash
# 1. Clone o repositório
git clone https://github.com/felipekauan1/contacts-api.git
cd contacts-api

# 2. Instale as dependências
composer install

# 3. Configure o ambiente
cp .env.example .env
php artisan key:generate

# 4. Configure o banco de dados no .env
DB_DATABASE=contacts_api
DB_USERNAME=root
DB_PASSWORD=sua_senha

# 5. Crie o banco e rode as migrations
php artisan migrate

# 6. Popule o banco com os contatos iniciais
php artisan db:seed --class=ContactSeeder
```

### Rodando o projeto

```bash
php artisan serve
```

## 📡 Endpoints da API

### Listar todos os contatos
```
GET /api/contacts
```

**Resposta (200):**
```json
{
    "contacts": [
        {
            "id": 1,
            "name": "Neymar",
            "phone": "+55 (11) 15745-4522",
            "email": "neymarjr@contato.com",
            "category": "Soccer Player",
            "created_at": "2026-05-21T...",
            "updated_at": "2026-05-21T..."
        }
    ]
}
```

### Buscar contato por nome
```
GET /api/contacts?search=Neymar
```

Retorna todos os contatos cujo nome contenha o termo buscado.

### Criar contato
```
POST /api/contacts
Content-Type: application/json

{
    "name": "Messi",
    "phone": "+55 (11) 17536-3781",
    "email": "messi@contato.com",
    "category": "Soccer Player"
}
```

**Resposta (201):**
```json
{
    "message": "Contato criado com sucesso!",
    "contact": {
        "id": 3,
        "name": "Messi",
        "phone": "+55 (11) 17536-3781",
        "email": "messi@contato.com",
        "category": "Soccer Player"
    }
}
```

### Editar contato
```
PUT /api/contacts/{id}
Content-Type: application/json

{
    "email": "novo@email.com"
}
```

Todos os campos são opcionais — envie apenas o que deseja atualizar.

### Apagar contato
```
DELETE /api/contacts/{id}
```

**Resposta (200):**
```json
{
    "message": "Contato apagado com sucesso!"
}
```

## 📌 Possíveis melhorias futuras

- Busca por categoria além do nome
- Paginação na listagem de contatos
- Testes automatizados com PHPUnit

## 👨‍💻 Autor

Desenvolvido por **[@felipekauan1](https://github.com/felipekauan1)**

## 📄 Licença

Este projeto está sob a licença MIT.
