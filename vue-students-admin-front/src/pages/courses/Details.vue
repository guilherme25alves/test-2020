<template>
    <div>
        <div class="container"> 
            <div class="hero-sm">
                <div class="hero-bod">
                    <h1 class="title-h">{{ title }} {{ course.title }}</h1>
                </div>
            </div>

                <div class="column col-8 col-mx-auto">
                  <div class="filter-body columns">
                    <div class="column col-xs-12 col-sm-12 col-md-12 col-6 filter-item" data-tag="tag-2">
                      <div class="card">
                        <div class="card-header">
                          <div class="card-title text-bold">Título</div>
                          <div class="card-subtitle text-gray">{{ course.title }}</div>
                        </div>
                      </div>
                    </div>
                    <div class="column col-xs-12 col-sm-12 col-md-12 col-6 filter-item" data-tag="tag-3">
                      <div class="card">
                        <div class="card-header">
                          <div class="card-title text-bold">Descrição</div>
                          <div class="card-subtitle text-gray">{{ course.description }}</div>
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
                                <p>Este curso não possui matrículas ativas!</p>
                            </div>

                    </div>                
                </div>

                <button v-on:click="goListCourses" type="button" class="btn btn-detail">Voltar</button>
        </div>
    </div>
</template>

<script>

import Courses from '../../services/courses'
import Students from '../../services/students'

export default {
    
    data(){
        return {           
            course: {
                course_id: '',
                title: '',
                description: '',
            },            
            enrollments: [],
            students: [],
            title: "Detalhes Curso : ",
            isEmptyEnrollments: false            
        }
    },

    mounted(){
        var course_id = this.$route.params.course_id
        this.getByIdentifier(course_id)  
        this.getListStudents()        
        this.getEnrollments(course_id)        
    },

    methods:{

        alert() {
            this.$swal("Atualizado!", "Transação efetuada com sucesso!", "success")
        },

        goListCourses(){
            this.$router.push('/courses') 
        },

        getByIdentifier(courseId){
            Courses.getById(courseId)
                .then(response =>{
                    this.course.course_id = courseId
                    this.course.title = response.data.data.title
                    this.course.description = response.data.data.description                                  
                })
        },

        getEnrollments(courseId){
            Courses.enrollmentsByCourse(courseId)
                .then( response =>{
                    console.log(response.data)
                    this.enrollments = response.data.data   
                    this.enrollments.forEach(element => {
                        //console.log(element.course_id)
                        element.student_id = this.findObjectByKey(this.students , "student_id" , element.student_id).name
                        element.course_id = this.course.title
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

        getListStudents(){
            Students.listStudents().then(response => {
                this.students = response.data.data
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