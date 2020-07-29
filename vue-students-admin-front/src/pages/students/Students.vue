<template>
    <div>
        
        <div class="container"> 
            <div class="hero-sm">
                <div class="hero-bod">
                    <h1 class="title-h">{{ title }}</h1>
                </div>
            </div>
            
            <div class="columns">
                <div class="column col-10 col-mx-auto col-xs-12 col-sm-12 col-md-12">                    
                    <div id="searchDiv" class="col-4 col-xs-12 col-sm-12 col-md-12">
                        <div class="input-group">
                            <form @submit="getStudentsByFilter(filterValue)">                                
                                <input 
                                    required
                                    id="searchValue" 
                                    v-model="filterValue"
                                    type="text" 
                                    class="form-input" 
                                    placeholder="Pesquise por nome ou e-mail...">                            
                                <button                                     
                                    id="searchBtn" type="submit" title="Pesquisar"
                                    class="btn btn-detail input-group-btn">
                                    <i v-bind:class="getClassLoading(isLoading, 'search')"></i>
                                </button>
                                <button 
                                    id="clearBtn" type="button" v-on:click="list"
                                    class="btn btn-edit input-group-btn" title="Limpar busca">
                                    <i v-bind:class="getClassLoading(isLoading, 'clear')"></i>
                                </button>
                            </form>
                        </div>
                    </div>

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
                                        <button v-on:click="toDetails(student.student_id)" class="btn-detail btn">Detalhes</button>
                                        <button v-on:click="toEdit(student.student_id)" class="btn-edit btn">Editar</button>
                                        <button v-on:click="deleteStudent(student.student_id)" class="btn-delete btn">Deletar</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <section>
                            <router-link to="/students/store" class="btn btn-edit align-btn">Novo Aluno</router-link>
                        </section>

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
            students: [],
            title: "Alunos",
            filterValue:"",
            isLoading:false,
        }
    },
    mounted(){
        this.list()        
    },

    methods:{
        
        list(){
            if(this.filterValue !== ''){
                this.filterValue =''
                this.isLoading = true
            }  
            Students.listStudents().then(response => {
                this.students = response.data.data
                this.isLoading = false                
            })                                              
        },

        toEdit(student_id){
            this.$router.push('/students/update/' + student_id)
        },

        toDetails(student_id){
            this.$router.push('/students/details/' + student_id)
        },

        getStudentsByFilter(text){
            this.isLoading = true
            Students.findByText(text)
            .then(response => {
                this.students = response.data.data
            })
            .catch(() =>{
                this.$swal("Valores não encontrados! Tente novamente!", {
                    icon: "error",
                });
                this.list()
            })
            this.isLoading = false
        },

        getClassLoading(loadingValue, typeIcon){
            if(typeIcon === 'search'){
                return (loadingValue) ? 'fa fa-spinner fa-pulse fa-fw' : 'fas fa-search'
            }else{
                return (loadingValue) ? 'fa fa-spinner fa-pulse fa-fw' : 'fas fa-times'
            }
            
        },

        deleteStudent(student_id){
            this.$swal({
                title: "Remover Estudante?",
                text: "Deletar estudante implica em perder seus dados e remover suas matrículas!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((confirmDelete) => {
                if (confirmDelete) {
                    Students.remove(student_id)
                        .then(() => {
                            this.$swal("Feito! Estudante removido!", {
                                icon: "success",
                            });
                            this.list()                            
                        })
                        .catch(() => {
                            this.$swal("Erro ao remover Estudante! Tente novamente por gentileza!", {
                                icon: "error",
                            });                            
                        })                    
                } else {
                    this.$swal("Ação de remover cancelada",{
                        icon: "info",
                    });
                }
            });
                        
        }
    }

}
</script>

<style>
    form{
        display:contents
    }
    #searchDiv{
        float:right; 
        padding-bottom:9px
    }
    #searchBtn, #clearBtn{
        margin: 0 !important;
    }
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
    .align-btn{
        width: 100%;
        max-width: 120px;
        float: left;
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
    .title-h {
        color: #41b883;
        font-family: fantasy;
    }

    @media(max-width: 880px){
        .column{
            overflow-x: auto !important;
        }
        table{
            margin-bottom: 0px !important;
        }
        .align-btn{
            margin: 20px auto !important;
            width: 250px;
            float: none;
        }   
    }
</style>