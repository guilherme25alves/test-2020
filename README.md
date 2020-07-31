### Backend + Frontend 
# Projeto Web  com Vue.js consumindo API Laravel


### TECNOLOGIAS UTILIZADAS:

- PHP 
- Laravel Framework
- Vue.js
- Spectre.css
- Axios
- SweetAlert
- Git
- Composer

## DESCRIÇÃO DOS PROJETOS

### API LARAVEL
API do laravel com intuíto de realizar operações CRUD para matrículas(Enrollments), alunos(Students) e cursos(Courses).

####Documentação da API

#####Localhost (Acessar após o projeto estiver sendo executado)

[Documentação API Laravel](http://localhost:8000/docs/#admin-students-api "Documentação API Laravel")

Biblioteca de auxílio na documentação

`composer require mpociot/laravel-apidoc-generator`

Comando para gerar documentação 

`php artisan apidoc:generate`

####Comandos para gerar estruturação do projeto
##### STUDENTS
- `php artisan make:migration create_students_table`

- `php artisan make:model Students`

- `php artisan make:seeder StudentsTableSeeder`

- `php artisan make:controller StudentsController`

- `php artisan make:resource StudentsResource`

##### COURSES
- `php artisan make:migration create_courses_table`

- `php artisan make:model Courses`

- `php artisan make:seeder CoursesTableSeeder`

- `php artisan make:controller CoursesController`

- `php artisan make:resource CoursesResource`

- `php artisan make:migration create_enrollments_table`

##### ENROLLMENTS
- `php artisan make:model Enrollments`

- `php artisan make:seeder EnrollmentsTableSeeder`

- `php artisan make:controller EnrollmentsController`

- `php artisan make:resource EnrollmentsResource `

#### MIGRATIONS PARA GERAR A ESTRUTURA DO BANCO DE DADOS
`php artisan migrate`
#### SEEDER FACTORIE PARA OS DADOS NO BANCO
`php artisan db:seed`


### VUE.JS FRONTEND

![Home Page](https://imgur.com/gallery/yxirTi3 "Home Page Vue.js")

Projeto para web em Vue.js para consumo da API Laravel, composto de página Home e páginas para exibição, edição, cadastro para Estudantes, Cursos e Matrículas, com a opção de buscar por nome e-mail para Estudantes, e por título para Cursos, no caso desses 2 com tela para visualizar detalhes.

Projeto construído com apoio do framework Spectre.css para ajustes de layout e dimensionamento, além de classes de estilo da biblioteca. Para interações com o usuário mais agradáveis foi utilizado o SweetAlerts para alertas mais amigáveis. O relacionamento entre projeto web e a API Laravel foi feito através do Axios, responsável pelo consumo e retorno da requisições feitas para API.

## EXECUTANDO O PROJETO
Após download ou clone do projeto,  haverá uma pasta para o projeto backend e outra pasta para o frontend:

- laravel-students-admin-api

- vue-students-admin-front

Acessando o terminal dentro de cada pasta executar os comandos

`php artisan serve` : executar projeto backend

`yarn serve` : executar projeto frontend


# TESTE

## Escopo
Deve-se criar uma aplicação em PHP para resolver o problema descrito abaixo, utilizando framework Laravel 7. Fique a vontade para explorar todo o seu conhecimento em automação de tarefas, CSS, Vue.JS e demais ferramentas.

### Qual é o teste ?
Prof. Beeliano está lançando uma nova plataforma de ensino online. Nesta plataforma, desejamos realizar a matrícula de alunos em cursos através de um painel administrativo. 

# Requisitos
- Um aluno pode ser matriculado em mais de um curso
- O administrador do sistema que realizará as matrículas. Não é necessário desenvolver tela para alunos.
- A consulta pelo nome e pelo e-mail é requisito funcional
- Não é necessário desenvover tela de login / autenticação. 

#### CRUD de Áreas de Cursos
Criar um gerenciamento aonde seja possível Criar, Listar, Editar e Visualizar uma área de curso (Biologia, Química, Física, por exemplo). 

##### Atributos de um Curso são:
- título (obrigatório)
- descrição 

#### CRUD de Alunos
Criar um gerenciamento aonde seja possível Criar, Listar, Editar e Visualizar um Aluno. 

##### Atributos de um Aluno são:
- nome (obrigatório)
- email (obrigatório)
- data de nascimento

#### CRUD de Matrículas
Criar um gerenciamento aonde seja possível Criar, Listar, Editar e Visualizar uma matrícula. 

# Plus ++ 
- Utlize Seeders e Factories para inserir dados fakers no banco de dados.
- Utilize as melhores práticas da Orientação a Objetos.
- As tabelas do banco de dados criadas através de migrations.
- Pretendemos conectar um aplicativo mobile nesta nova plataforma. 

### O que devo utilizar ?
- Laravel 7
- MySQL

### Links uteis
- [Laravel](https://laravel.com/docs/7.x)
