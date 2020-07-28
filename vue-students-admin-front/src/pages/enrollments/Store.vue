<template>
    <div>
    
        <div class="container"> 
            <div class="hero-sm">
                <div class="hero-bod">
                    <h1 class="title-h">{{ title }}</h1>
                </div>
            </div>

            <div class="columns">
                <div class="column col-4 col-mx-auto col-xs-12 col-sm-12 col-md-12">
                        
                    <form class="form-horizontal" @submit="created">
                        
                        <div class="form-group" v-bind:class="getClass(errorStudent)">
                            <label class="form-label label-lg" for="student_id">Aluno</label>
                            <select class="form-select" v-model="enrollment.student_id">
                                <option 
                                    v-bind:value="student.student_id" 
                                    v-bind:key="student.student_id" 
                                    v-for="student in students"> {{ student.name }}</option>
                            </select>
                            <p v-if="errorStudent !== ''" class="form-input-hint">{{ errorStudent }}</p>                                                      
                        </div>

                        <div class="form-group" v-bind:class="getClass(errorCourse)">
                            <label class="form-label label-lg" for="course_id">Curso</label>
                          
                            <select class="form-select" v-model="enrollment.course_id">
                                <option 
                                    v-bind:value="course.course_id" 
                                    v-bind:key="course.course_id" 
                                    v-for="course in courses">{{ course.title }}</option>
                            </select>
                            <p v-if="errorCourse !== ''" class="form-input-hint">{{ errorCourse }}</p>                                                      
                        </div>
                                              
                        
                        <button type="submit" class="btn btn-edit">Cadastrar</button>
                        <button v-on:click="goListEnrollments" type="button" class="btn btn-detail">Voltar</button>
                    </form>                           
                </div>                
            </div>            
            
        </div>
    </div>
</template>

<script>

import Students from '../../services/students'
import Courses from '../../services/courses'
import Enrollments from '../../services/enrollments'

export default {
    
    data(){
        return {           
            enrollment: {
                student_id: '',
                course_id: '',
                enrollment_date: '',
            },
            title: "Nova Matrícula",
            errorStudent: '',
            errorCourse: '',
            students: [],
            courses: [],            
        }
    },

    mounted(){
        this.getListStudents()
        this.getListCourses()        
    },

    methods:{

        alert() {
            this.$swal("Cadastrado!", "Transação efetuada com sucesso!", "success")
        },

        goListEnrollments(){
            this.$router.push('/enrollments')                           
        },

        created(){  
            var dtNow = new Date();
            this.enrollment.enrollment_date  = 
                dtNow.getUTCFullYear() +"/"+  (dtNow.getUTCMonth()+1) +"/"+ dtNow.getUTCDate() +
                " " + (dtNow.getUTCHours() - 3) + ":" + dtNow.getUTCMinutes() + ":" + dtNow.getUTCSeconds();

            Enrollments.save(this.enrollment)
                .then(response => {
                    this.alert()                            
                    console.log(response);
                    this.enrollment = {}                                    
                    this.errorStudent = ''
                    this.errorCourse = ''
                    this.goListEnrollments()                  
                })  
                .catch((error) => {
                    var errors = error.response.data.errors                                    
                    this.errorStudent = ( "student_id" in errors) ? errors.student_id[0] : ''
                    this.errorCourse = ( "course_id" in errors) ? errors.course_id[0] : ''                                        
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

        getListStudents(){
            Students.listStudents().then(response => {
                this.students = response.data.data
            })
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

</style>