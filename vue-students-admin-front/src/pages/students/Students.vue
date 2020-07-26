<template>
    <div>
        
        <div class="container">            
            <div class="columns">
                <div class="column col-10 col-mx-auto col-xs-12 col-sm-12 col-md-12">
                    <table class="table">
                        <thead>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Data de nascimento</th>
                            <th>Ações</th>
                        </thead>
                        <tbody>
                            <tr v-for="student of students" :key="student.student_id" > 
                                <td>{{ student.student_id }}</td>
                                <td>{{ student.name }}</td>
                                <td>{{ student.email }}</td>
                                <td>{{ student.birthdate }}</td>
                                <td>
                                    <button class="btn-detail btn">Detalhes</button>
                                    <button class="btn-edit btn">Editar</button>
                                    <button class="btn-delete btn">Deletar</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import Students from '../../services/students'

export default {
    
    data(){
        return {
            students: []
        }
    },
    mounted(){
        Students.listStudents().then(response => {
            this.students = response.data.data
        })
    }

}
</script>

<style>

    .btn{
        margin: 5px;
    }
    .btn-detail {
        color: #649cb1 !important;
        border: .05rem solid #649cb1 !important;
        opacity: 0.7 !important;
    }
    .btn-detail:hover {
        color: #fff !important;
        background: #649cb1 !important;
        border: .05rem solid #fff !important;
        opacity: 1 !important;
    }
    .btn-edit {
        color: #41b883 !important;
        border: .05rem solid #41b883 !important;
        opacity: 0.7 !important;
    }
    .btn-edit:hover {
        color: #fff !important;
        background: #41b883 !important;
        border: .05rem solid #fff !important;
        opacity: 1 !important;
    }
    .btn-delete {
        color: #c62121 !important;
        border: .05rem solid #c62121 !important;
        opacity: 0.7 !important;
    }
    .btn-delete:hover {
        color: #fff !important;
        background: #c62121 !important;
        border: .05rem solid #fff !important;
        opacity: 1 !important;
    }

    table{
        font-family: 'Poppins';
        margin: 25px auto;
        border-collapse: collapse;
        border: 1px solid #eee;
        border-bottom: 2px solid #649cb1;
        box-shadow: 0px 0px 20px rgba(0,0,0,0.10),
            0px 10px 20px rgba(0,0,0,0.05),
            0px 20px 20px rgba(0,0,0,0.05),
            0px 30px 20px rgba(0,0,0,0.05);        
    }

    tr:hover {
        background: #f4f4f4;
    }

    td {
        color: #555;
        font-size: 13px;
    }

    th, td {
        color: #999;
        border: 1px solid #eee;
        padding: 8px 25px !important;
        border-collapse: collapse;
        text-align: center;
    }
    th {
        background: #649cb1;
        color: #fff;
        text-transform: uppercase;
        font-size: 15px;        
    }

    @media(max-width: 880px){
        .column{
            overflow-x: auto !important;
        }
        table{
            margin-bottom: 0px !important;
        }   
    }
</style>