<template>

<nav id="menu">    
    <div class="menu-display">
        <div class="box">
            <img alt="Prof. Beeliano logo" class="icons" src="prof_ico.ico">
            <span class="title">Prof.Beeliano</span>            
        </div>
        <div>
            <ul>
                <li><button 
                    id="showMenu" 
                    v-on:click="isActive = !isActive;" 
                    class="btn-menu-item show-xs show-sm hide-md hide-lg hide-xl"><i class="fas fa-list"></i> Menu</button></li>
                <li><router-link 
                    v-bind:class="isActive ? 'show-xs show-sm' : 'hide-xs hide-sm'"                 
                    class="menu-item" 
                    to="/"><i class="fas fa-home"></i> Home</router-link></li>
                <li><router-link                      
                    v-bind:class="isActive ? 'show-xs show-sm' : 'hide-xs hide-sm'"
                    class="menu-item" 
                    to="/students"><i class="fas fa-graduation-cap"></i> Alunos</router-link></li>
                <li><router-link  
                    v-bind:class="isActive ? 'show-xs show-sm' : 'hide-xs hide-sm'"
                    class="menu-item" 
                    to="/courses"><i class="fas fa-book"></i> Cursos</router-link></li>
                <li><router-link  
                    v-bind:class="isActive ? 'show-xs show-sm' : 'hide-xs hide-sm'"
                    class="menu-item" 
                    to="/enrollments"><i class="fas fa-file"></i> Matrículas</router-link></li>                                                        
            </ul>
        </div>
    </div>
</nav>

</template>

<script>
export default {
  name: 'App',
  data: function(){
      return {
          isActive: false
      }      
  } ,   
}
</script>

<style scoped>

     #menu ul, .box{
        padding:20px;
        margin: 0px;
        background-color: #FFF;
        list-style: none;
        box-shadow: 0 0.25rem 1rem rgba(48, 55, 66, 0.15);
    }

    #menu ul li {
        display: inline;
    }

    #menu ul li .menu-item{
        padding: 2px 25px;
        display: inline-block;
        background-color: #FFF;
        font-size: 1.2rem;
        font-family: fantasy;
        letter-spacing: 1.3px;
        color: #649cb1;
        text-decoration: none;
        border-bottom: 3px solid #FFF;
        cursor: pointer;
    }
    #menu ul li .menu-item:hover {
        background-color:#176780;
        color: #ffffff;        
    }

    .btn-menu-item {
        padding: 2px 25px;
        background-color: #FFF;
        font-size: 1.2rem;
        font-family: fantasy;
        letter-spacing: 1.3px;
        color: #649cb1;
        border: 2px solid #649cb1;
        cursor: pointer;
        margin: 0 auto;
    }

    .btn-menu-item:hover{
        background-color:#176780;
        color: #ffffff;
    }

    .icons{
        height: 60px;
        cursor:pointer;        
    }
    
    .icons, .title{
        margin: 0 auto;
    }

    .box span{
        padding: 2px 5px;
        display: grid;
        background-color: #FFF;
        font-size: 1.5rem;
        font-family: fantasy;
        letter-spacing: 1.3px;
        color: #41b883;
        text-decoration: none;
        border-bottom: 3px solid #FFF;        
    }

    .menu-display:after {
        display: inline-block;
    }
    

</style>
