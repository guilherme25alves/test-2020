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
                        <div class="form-group" v-bind:class="getClass(errorTitle)">
                            <label class="form-label label-lg" for="title">Título</label>
                            <input v-model="course.title" class="form-input input-lg" type="text" id="title" required placeholder="...">  
                            <p v-if="errorTitle !== ''" class="form-input-hint">{{ errorTitle }}</p>                                                      
                        </div>

                        <div class="form-group" v-bind:class="getClass(errorDescription)">
                            <label class="form-label label-lg" for="description">Descrição</label>
                            <input v-model="course.description" class="form-input input-lg" type="text" id="description" placeholder="...">  
                            <p v-if="errorDescription !== ''" class="form-input-hint">{{ errorDescription }}</p>                                                      
                        </div>
                        
                        <button type="submit" class="btn btn-edit">Cadastrar</button>
                        <button v-on:click="goListCourses" type="button" class="btn btn-detail">Voltar</button>
                    </form>                 

                </div>                
            </div>            
            
        </div>
    </div>
</template>

<script>

import Courses from '../../services/courses'

export default {
    
    data(){
        return {           
            course: {
                title: '',
                description: '',
                birthdate: '',
            },
            title: "Novo curso",
            errorTitle: '',
            errorDescription: '',
        }
    },

    methods:{

        alert() {
            this.$swal("Cadastrado!", "Transação efetuada com sucesso!", "success")
        },

        goListCourses(){
            this.$router.push('/courses') 
        },

        created(){  
            Courses.save(this.course)
                .then(response => {
                    this.alert()                            
                    console.log(response);
                    this.course = {}                                    
                    this.errorTitle = ''
                    this.errorDescription = ''
                    this.goListCourses()                  
                })  
                .catch((error) => {
                    var errors = error.response.data.errors                                    
                    this.errorTitle = ( "title" in errors) ? errors.title[0] : ''
                    this.errorDescription = ( "description" in errors) ? errors.description[0] : ''                                  
                })              
        },

        getClass(element){
            var className = (element !== '') ? 'has-error' : '';
            return className;
        },
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