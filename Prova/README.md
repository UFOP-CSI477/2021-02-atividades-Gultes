## Dados do Aluno

- Nome: Gustavo Estevam Sena   
- Matrícula: 19.2.8095
- Curso: Sistemas de Informação
- Semestre/Ano correntes: 2021/02.
- Link para o seu GitHub: (https://github.com/Gultes)


### Tecnologias utilizadas:

Back-End: NestJS, Prisma, NodeJS

BD: PostgreeSQL

Teste do funcionamento das tabelas e CRUDS: Insomnia


### Instruções para execução:

Back-End:

Criar um banco de dados (PostgreSQL, e executar o comando yarn)

Acessar a pasta Prova/server-side-full-crud e criar um arquivo .env, tal qual .env.example, com a sua string de conexão e informações necessárias para conectar ao banco de dados.

JWT_SECRET= examplexyxyxy DATABASE_URL= "example" PORT=3333

Executar os camandos:

npx prisma generate

npx prisma migrate deploy

yarn start:dev

Obs: Foi implementado apenas o back end, porém é possível testar as cruds via insomnia.
