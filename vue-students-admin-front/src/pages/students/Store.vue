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
                        <div class="form-group" v-bind:class="getClass(errorName)">
                            <label class="form-label label-lg" for="name">Nome</label>
                            <input v-model="student.name" class="form-input input-lg" type="text" id="name" required placeholder="...">  
                            <p v-if="errorName !== ''" class="form-input-hint">{{ errorName }}</p>                                                      
                        </div>

                        <div class="form-group" v-bind:class="getClass(errorEmail)">
                            <label class="form-label label-lg" for="email">E-mail</label>
                            <input v-model="student.email" class="form-input input-lg" type="email" id="email" required placeholder="...">  
                            <p v-if="errorEmail !== ''" class="form-input-hint">{{ errorEmail }}</p>                                                      
                        </div>

                        <div class="form-group" v-bind:class="getClass(errorBirthDate)">
                            <label class="form-label label-lg" for="birthdate">Data de Nascimento</label>
                            <input v-model="student.birthdate" class="form-input input-lg" type="date" id="birthdate">  
                            <p v-if="errorBirthDate !== ''" class="form-input-hint">{{ errorBirthDate }}</p>                                                      
                        </div>
                        
                        <button type="submit" class="btn btn-edit">Cadastrar</button>
                        <button v-on:click="goListStudents" type="button" class="btn btn-detail">Voltar</button>
                    </form>                 

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
            student: {
                name: '',
                email: '',
                birthdate: '',
            },
            title: "Novo aluno",
            errorName: '',
            errorEmail: '',
            errorBirthDate: ''
        }
    },

    methods:{

        alert() {
            this.$swal("Cadastrado!", "Transação efetuada com sucesso!", "success")
        },

        goListStudents(){
            this.$router.push('/students') 
        },

        created(){  
            Students.save(this.student)
                .then(response => {
                    this.alert()                            
                    console.log(response);
                    this.student = {}                                    
                    this.errorName = ''
                    this.errorEmail = ''
                    this.errorBirthDate = ''
                    this.goListStudents()                  
                })  
                .catch((error) => {
                    var errors = error.response.data.errors                                    
                    this.errorName = ( "name" in errors) ? errors.name[0] : ''
                    this.errorEmail = ( "email" in errors) ? errors.email[0] : ''
                    this.errorBirthDate = ( "birthdate" in errors) ? errors.birthdate[0] : ''                    
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