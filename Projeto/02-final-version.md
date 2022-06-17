# **CSI606-2021-02 - Remoto - Trabalho Final - Resultados**

## *Aluna(o): Gustavo Estevam Sena*

### Resumo

  Simple Finance é um sistema web a ser utilizado para controle de finanças pessoais (Investimentos/Receita/Despesa) de maneira descomplicada, a aplicação irá exibir as despesas lançadas no mês , assim como as receitas, além de apresentar um total mensal representando o saldo da conta do usuario (Receita - Despesa), além disso, o sistema terá um resumo da carteira de investimentos do usuário.
  
  Tecnologias utilizadas:

  Back-End: NestJS, Prisma, NodeJS, 
  BD: PostgreeSQL
  Autenticação: JWT Token

  Front-End: React + Typescript + Material UI

### 1. Funcionalidades implementadas

Criação e Login de usuário (usando e-mail e senha);
Autenticação da senha do usuário no login;

Lançamento de Itens por Tipo: Receita, Despesa, Investimento;

Edição, Exclusão e Pesquisa de itens;

Exibição do Total (Receita - Despesa) na barra superior da tela, assim como o Total do Valor Investido, com atualização a cada lançamento;

Persistência das informações lançadas pelo usuário logado após logar uma segunda vez. (SESSION_TOKEN)
  
### 2. Funcionalidades previstas e não implementadas


### 3. Outras funcionalidades implementadas

Inclusão de exibição de foto do usuário durante o login.

### 4. Principais desafios e dificuldades

Houve dificuldade em trabalhar com manipulação de datas de lançamento no Front-end, por fim decidiu-se incluir apenas as datas dos lançamentos de itens como alternativa.

### 5. Instruções para instalação e execução

Back-end:

Criar um banco de dados (PostgreSQL, e executar o comando yarn)

Acessar a pasta Projeto/server-side e criar um arquivo .env, tal qual .env.example, com a sua string de conexão e informações necessárias para conectar ao banco de dados.

JWT_SECRET= examplexyxyxy DATABASE_URL= "example" PORT=3333

Executar os camandos:

npx prisma generate

npx prisma migrate deploy

yarn start:dev

Front-end:

Executar yarn

Executar  yarn start

A aplicação será executada localmente


### 6. Referências

https://www.mobills.com.br/
