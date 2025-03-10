# Prognóstico Climático

## Descrição

O Prognóstico Climático é uma aplicação prática e intuitiva que oferece acesso rápido e detalhado às condições meteorológicas de qualquer cidade do mundo. Com uma interface moderna e amigável, basta inserir o nome da cidade desejada para obter informações atualizadas instantaneamente, incluindo temperatura atual, velocidade do vento, umidade relativa do ar e o clima.

Desenvolvido com Laravel no backend, o projeto utiliza dados precisos e confiáveis da API OpenWeatherMap, garantindo uma experiência eficiente e confiável ao usuário. O design responsivo e atraente torna a navegação agradável em qualquer dispositivo, simplificando o acesso às informações climáticas essenciais com rapidez e facilidade.


## Como Instalar

### Pré-requisitos

- [Git](https://git-scm.com/)
- [PHP](https://www.php.net/) (versão compatível com o projeto)
- [Composer](https://getcomposer.org/)
- [Node.js e npm](https://nodejs.org/)

### Configuração e Execução

Siga os passos abaixo para rodar o projeto em outra máquina:

### 1. Clonar o Repositório

```bash
git clone https://github.com/VituGit/prognostico-climatico
```

### 2. Configurar o Backend (API)

Navegue até o diretório da API:

```bash
cd api
```

Instale as dependências do PHP via Composer:

```bash
composer install
```

Crie o arquivo de ambiente copiando o exemplo:

```powershell
Copy-Item .env.example .env
```

Atenção: Abra o arquivo `.env` e insira a seguinte linha para definir a chave da API do OpenWeatherMap:

```dotenv
OPENWEATHERMAP_API_KEY=fa1293d33e5c86af27859cdacfb3b306
```

Gere a chave da aplicação Laravel:

```bash
php artisan key:generate
```

Inicie o servidor de desenvolvimento do backend:

```bash
php artisan serve
```

### 3. Configurar o Frontend

Abra um novo terminal e navegue até o diretório do frontend:

```bash
cd frontend
```

Instale as dependências via npm:

```bash
npm install
```

Inicie o servidor de desenvolvimento do frontend:

```bash
npm run dev
```

## Observações

- Certifique-se de ter as versões corretas do PHP e Node.js instaladas.
- Atualize as variáveis de ambiente conforme necessário para o seu ambiente.
- Se houver necessidade de configurações adicionais (como portas ou endpoints), verifique os respectivos arquivos de configuração no projeto.
