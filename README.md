# **CSI606-2021-02 - Estrutura básica do repositório**

## Dados do Aluno

- Nome: Gustavo Estevam Sena   
- Matrícula: 19.2.8095
- Curso: Sistemas de Informação
- Semestre/Ano correntes: 2021/02.
- Link para o seu GitHub: (https://github.com/Gultes)

## [Projeto final:](./Projeto/README.md)

Simple Finance é um sistema web a ser utilizado para controle de finanças pessoais (Investimentos/Receita/Despesa) de maneira descomplicada, a aplicação irá exibir as despesas lançadas no mês, assim como as receitas, além de apresentar um total mensal representando o saldo da conta do usuario (Receita - Despesa), além disso, o sistema terá um resumo da carteira de investimentos do usuário.

Tecnologias utilizadas:

Back-End: NestJS, Prisma, NodeJS, BD: PostgreeSQL Autenticação: JWT Token

Front-End: React + Typescript + Material UI

### Funcionalidades implementadas

Criação e Login de usuário (usando e-mail e senha); 

Autenticação da senha do usuário no login, exibição da Foto ao Logar;

Lançamento de Itens por Tipo: Receita, Despesa, Investimento; 

Edição, Exclusão e Pesquisa de itens;

Exibição do Total (Receita - Despesa) na barra superior da tela, assim como o Total do Valor Investido, com atualização a cada lançamento;

Persistência das informações lançadas pelo usuário logado após logar uma segunda vez. (SESSION_TOKEN)
