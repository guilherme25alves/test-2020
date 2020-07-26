<template>

    <div>
        <div class="top-padding">
        <h3 class="h-title">Olá, seja bem vindo!</h3>
        </div>

        <div class="container">
            <div class="columns">
                <div class="column col-4">
                    
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title h5">Alunos</div>
                            <div class="card-subtitle text-gray">Hardware and software</div>
                        </div>
                        <div class="card-image">
                            <img class="img-responsive" src="@/assets/logo.png" alt="OS X Yosemite">
                        </div>
                        <div class="card-body">
                            To make a contribution to the world by making tools for the mind that advance humankind.
                        </div>
                        <div class="card-footer">
                            <div class="btn-group btn-group-block">
                                <router-link to="/students" class="btn">Listar</router-link>
                                <router-link to="/students/store" class="btn">Cadastrar</router-link>
                            </div>
                        </div>
                    </div>

                </div>
                
                <div class="column col-4">

                    <div class="card">
                        <div class="card-header">
                            <div class="card-title h5">Cursos</div>
                            <div class="card-subtitle text-gray">Hardware and software</div>
                        </div>
                        <div class="card-image">
                            <img class="img-responsive" src="@/assets/logo.png" alt="OS X Yosemite">
                        </div>
                        <div class="card-body">
                            To make a contribution to the world by making tools for the mind that advance humankind.
                        </div>
                        <div class="card-footer">
                            <div class="btn-group btn-group-block">
                                <router-link to="/courses" class="btn">Listar</router-link>
                                <router-link to="/courses/store" class="btn">Cadastrar</router-link>
                            </div>
                        </div>
                    </div>


                </div>
                
                <div class="column col-4">

                    <div class="card">
                        <div class="card-header">
                            <div class="card-title h5">Matrículas</div>
                            <div class="card-subtitle text-gray">Hardware and software</div>
                        </div>
                        <div class="card-image">
                            <img class="img-responsive" src="@/assets/logo.png" alt="OS X Yosemite">
                        </div>
                        <div class="card-body">
                            To make a contribution to the world by making tools for the mind that advance humankind.
                        </div>
                        <div class="card-footer">
                            <div class="btn-group btn-group-block">
                                <router-link to="/enrollments" class="btn">Listar</router-link>
                                <router-link to="/enrollments/store" class="btn">Cadastrar</router-link>
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
    name:'App'
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

</style>