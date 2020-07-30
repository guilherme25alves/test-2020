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
                        <table class="table">
                            <thead>
                                <th @click="sort('enrollment_id')" >#ID <i class="fas fa-sort"></i></th>
                                <th @click="sort('student_id')" >Aluno <i class="fas fa-sort"></i></th>
                                <th @click="sort('course_id')" >Curso <i class="fas fa-sort"></i></th>
                                <th @click="sort('enrollment_date')" >Data matrícula <i class="fas fa-sort"></i></th>
                                <th>Ações</th>
                            </thead>
                            <tbody>
                                <tr v-for="enrollment of sortedEnrollments()" :key="enrollment.enrollment_id" > 
                                    <td>{{ enrollment.enrollment_id }}</td>
                                    <td>{{ enrollment.student_id }}</td>
                                    <td>{{ enrollment.course_id }}</td>
                                    <td>{{ enrollment.enrollment_date }}</td>
                                    <td>
                                        <button v-on:click="toEdit(enrollment.enrollment_id)" class="btn-edit btn">Editar</button>
                                        <button v-on:click="deleteEnrollment(enrollment.enrollment_id)" class="btn-delete btn">Deletar</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <section>                            
                            <div class="columns">
                                <div class="column col-2">
                                    <router-link to="/enrollments/store" class="btn btn-edit align-btn">Nova Matrícula</router-link>
                                </div>
                                <div class="column col-8 col-mr-auto">
                                    <button class="btn-paginating btn-detail" @click="prevPage">
                                        <i class="fas fa-arrow-left"></i> Previous</button> 
                                    <button class="btn-paginating btn-detail" @click="nextPage">
                                        Next <i class="fas fa-arrow-right"></i></button>
                                </div>                                
                            </div>
                        </section>

                </div>                
            </div>            
            
        </div>
    </div>
</template>

<script>

import Enrollments from '../../services/enrollments'
import Courses from '../../services/courses'
import Students from '../../services/students'

export default {
    
    data(){
        return {
            enrollments: [],    
            students: [],
            courses: [],        
            title: "Matrículas",
            pageSize:5,
            currentPage:1,
            currentSort:'enrollment_id',
            currentSortDir:'asc'
        }
    },
    mounted(){
        this.getListCourses()
        this.getListStudents()
        this.list()                       
    },

    methods:{

        sort:function(s) {
            if(s === this.currentSort) {
            this.currentSortDir = this.currentSortDir==='asc'?'desc':'asc';
            }
            this.currentSort = s;
        },

        sortedEnrollments() {
            return this.enrollments
                .sort((a,b) => {
                    let modifier = 1;
                    if(this.currentSortDir === 'desc') modifier = -1;
                    if(a[this.currentSort] < b[this.currentSort]) return -1 * modifier;
                    if(a[this.currentSort] > b[this.currentSort]) return 1 * modifier;
                    return 0;
                })
                .filter((row, index) => {
                    let start = (this.currentPage-1)*this.pageSize;
                    let end = this.currentPage*this.pageSize;
                    if(index >= start && index < end) return true;
                });
        },

        nextPage:function() {
            if((this.currentPage*this.pageSize) < this.enrollments.length) this.currentPage++;
        },
        prevPage:function() {
            if(this.currentPage > 1) this.currentPage--;
        },

        list(){
            Enrollments.listEnrollments().then(response => {
                this.enrollments = response.data.data                
                
                this.enrollments.forEach(element => {
                    element.student_id = this.findObjectByKey(this.students , "student_id" , element.student_id).name
                    element.course_id = this.findObjectByKey(this.courses , "course_id" , element.course_id).title
                });
            })
        },

        toEdit(enrollment_id){
            this.$router.push('/enrollments/update/' + enrollment_id)
        },

        toDetails(enrollment_id){
            this.$router.push('/enrollments/details/' + enrollment_id)
        },

        deleteEnrollment(enrollment_id){
            this.$swal({
                title: "Remover Matrícula?",
                text: "Deletar implica em perder vínculo do aluno com o curso!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((confirmDelete) => {
                if (confirmDelete) {
                    Enrollments.remove(enrollment_id)
                        .then(() => {
                            this.$swal("Feito! Matrícula removida!", {
                                icon: "success",
                            });
                            this.list()                            
                        })
                        .catch(() => {
                            this.$swal("Erro ao remover Matrícula! Tente novamente por gentileza!", {
                                icon: "error",
                            });                            
                        })                    
                } else {
                    this.$swal("Ação de remover cancelada",{
                        icon: "info",
                    });
                }
            });
                        
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

<style>

    .btn{
        margin: 5px;
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
        max-width: 160px;
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

    .btn-paginating{
        padding: 7px;
        margin: 6px;
        width: 120px;
        text-align: center;
        background: #FFF;
        cursor: pointer;
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