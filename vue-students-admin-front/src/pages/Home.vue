<template>

    <div>
        <div class="top-padding">
        <h3 class="h-title">Olá, seja bem vindo!</h3>
        </div>

        <div class="container">
            <div class="columns">
                <div class="column col-xs-12 col-sm-12 col-4">
                    
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title h5">Alunos</div>                            
                        </div>
                        <div class="card-image">
                            <img class="img-responsive" src="@/assets/students.jpg" alt="Animate Student">
                        </div>
                        <div class="card-body">
                            Administre as informações de todos os seus alunos de forma prática e coesa
                        </div>
                        <div class="card-footer">
                            <div class="btn-group btn-group-block">
                                <router-link to="/students" class="btn btn-p-hover">Listar</router-link>
                                <router-link to="/students/store" class="btn btn-p-hover">Cadastrar</router-link>
                            </div>
                        </div>
                    </div>

                </div>
                
                <div class="column col-xs-12 col-sm-12 col-4">

                    <div class="card">
                        <div class="card-header">
                            <div class="card-title h5">Cursos</div>                            
                        </div>
                        <div class="card-image">
                            <img class="img-responsive" src="@/assets/courses.png" alt="Digital Course">
                        </div>
                        <div class="card-body">
                            Tenha um controle de todos os cursos disponíveis para seus alunos.
                        </div>
                        <div class="card-footer">
                            <div class="btn-group btn-group-block">
                                <router-link to="/courses" class="btn btn-p-hover">Listar</router-link>
                                <router-link to="/courses/store" class="btn btn-p-hover">Cadastrar</router-link>
                            </div>
                        </div>
                    </div>


                </div>
                
                <div class="column col-xs-12 col-sm-12 col-4">

                    <div class="card">
                        <div class="card-header">
                            <div class="card-title h5">Matrículas</div>                            
                        </div>
                        <div class="card-image">
                            <img class="img-responsive" src="@/assets/enrollments.jpg" alt="Enrollment Documents">
                        </div>
                        <div class="card-body">
                            Acompanhe as matrículas ativas e quais cursos estão tendo maiores engajamento dos alunos
                        </div>
                        <div class="card-footer">
                            <div class="btn-group btn-group-block">
                                <router-link to="/enrollments" class="btn btn-p-hover">Listar</router-link>
                                <router-link to="/enrollments/store" class="btn btn-p-hover">Cadastrar</router-link>
                            </div>
                        </div>
                    </div>

                </div>
            
            </div>   
        </div>
    </div>

</template>

<script>
export default {
    name:'App',
}

</script>

<style scoped>

    .h-title{
        padding: 2px 0px 50px 0px;
        font-family: 'Poppins';
        color: black;
        text-decoration: none;
        border-bottom: 3px solid #FFF; 
    }

    div .container {
        font-family: 'Poppins';
    }

    .img-responsive{
        width:100%;
        height: 320px;
    }

    .card{
        box-shadow: 0 0.25rem 1rem rgba(48, 55, 66, 0.15);
        border:0;
    }

    .btn-p-hover:hover{
        color: #FFF;
        background: #807fe2;        
    }

</style>