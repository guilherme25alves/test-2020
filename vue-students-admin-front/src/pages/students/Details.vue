<template>
    <div>
        <div class="container"> 
            <div class="hero-sm">
                <div class="hero-bod">
                    <h1 class="title-h">{{ title }} {{ student.name }}</h1>
                </div>
            </div>

                <div class="column col-8 col-mx-auto">
                  <div class="filter-body columns">
                    <div class="column col-xs-12 col-sm-12 col-md-12 col-4 filter-item" data-tag="tag-2">
                      <div class="card">
                        <div class="card-header">
                          <div class="card-title text-bold">Nome</div>
                          <div class="card-subtitle text-gray">{{ student.name }}</div>
                        </div>
                      </div>
                    </div>
                    <div class="column col-xs-12 col-sm-12 col-md-12 col-4 filter-item" data-tag="tag-3">
                      <div class="card">
                        <div class="card-header">
                          <div class="card-title text-bold">Email</div>
                          <div class="card-subtitle text-gray">{{ student.email }}</div>
                        </div>
                      </div>
                    </div>
                    <div class="column col-xs-12 col-sm-12 col-md-12 col-4 filter-item" data-tag="tag-1">
                      <div class="card">
                        <div class="card-header">
                          <div class="card-title text-bold">Data de Nascimento</div>
                          <div class="card-subtitle text-gray">{{ student.birthdate }}</div>
                        </div>
                      </div>
                    </div>                    
                  </div>
                </div>

                <div class="columns">
                    <div class="column col-8 col-mx-auto col-xs-12 col-sm-12 col-md-12">
                            <table class="table">
                                <thead>
                                    <th>Matrícula ID</th>
                                    <th>Aluno</th>
                                    <th>Curso</th>
                                    <th>Data Matrícula</th>                                
                                </thead>
                                <tbody>
                                    <tr v-for="enrollment of enrollments" :key="enrollment.enrollment_id" > 
                                        <td>{{ enrollment.enrollment_id }}</td>
                                        <td>{{ enrollment.student_id }}</td>
                                        <td>{{ enrollment.course_id }}</td>
                                        <td>{{ enrollment.enrollment_date }}</td>                                    
                                    </tr>
                                </tbody>
                            </table>
                            <div v-if="isEmptyEnrollments">
                                <p>Este aluno não possui matrículas ativas!</p>
                            </div>

                    </div>                
                </div>

                <button v-on:click="goListStudents" type="button" class="btn btn-detail">Voltar</button>
        </div>
    </div>
</template>

<script>

import Courses from '../../services/courses'
import Students from '../../services/students'

export default {
    
    data(){
        return {           
            student: {
                student_id: '',
                name: '',
                email: '',
                birthdate: '',
            },            
            enrollments: [],
            courses: [],
            title: "Detalhes Aluno : ",
            isEmptyEnrollments: false            
        }
    },

    mounted(){
        var student_id = this.$route.params.student_id
        this.getByIdentifier(student_id)      
        this.getListCourses()  
        this.getEnrollments(student_id)        
    },

    methods:{

        alert() {
            this.$swal("Atualizado!", "Transação efetuada com sucesso!", "success")
        },

        goListStudents(){
            this.$router.push('/students') 
        },

        getByIdentifier(studentId){
            Students.getById(studentId)
                .then(response =>{
                    this.student.student_id = studentId
                    this.student.name = response.data.data.name
                    this.student.email = response.data.data.email
                    this.student.birthdate = response.data.data.birthdate                    
                })
        },

        getEnrollments(studentId){
            Students.enrollmentsByStudent(studentId)
                .then( response =>{
                    this.enrollments = response.data.data    
                    this.enrollments.forEach(element => {
                        element.student_id = this.student.name
                        console.log(element.course_id)
                        element.course_id = this.findObjectByKey(this.courses , "course_id" , element.course_id).title
                    });
                })
                .catch(() =>{
                    this.isEmptyEnrollments = true
                })
        },

        getClass(element){
            var className = (element !== '') ? 'has-error' : '';
            return className;
        },

        getListCourses(){
            Courses.listCourses().then(response => {
                this.courses = response.data.data
            })
        },

        findObjectByKey(array, key, value) {
            for (var i = 0; i < array.length; i++) {
                var field = (key === 'student_id') ? array[i].student_id : array[i].course_id
                if (field === value) {                   
                   return array[i];
                }
            }
            return null;
        }
    }

}
</script>

<style scoped>
    form, input, label {
        font-family: 'Poppins';
    }
    .btn{
        margin: 5px;
    }
    .btn-detail {
        color: #649cb1 !important;
        border: .05rem solid #649cb1 !important;
        opacity: 1 !important;
        width: 200px;
    }
    .btn-detail:hover {
        color: #fff !important;
        background: #649cb1 !important;
        border: .05rem solid #fff !important;
        opacity: 1 !important;
        width: 200px;
    }
    .btn-edit {
        color: #41b883 !important;
        border: .05rem solid #41b883 !important;
        opacity: 1 !important;
        width: 200px;
    }
    .btn-edit:hover {
        color: #fff !important;
        background: #41b883 !important;
        border: .05rem solid #fff !important;
        opacity: 1 !important;
        width: 200px;
    }

    .title-h {
        color: #41b883;
        font-family: fantasy;
    }

    .filter-body{
        padding: .4rem;
        color: #3b4351;        
    }
    .card{
        box-shadow: 0 0.25rem 1rem rgba(48, 55, 66, 0.15);
        border:0px;
    }
</style>