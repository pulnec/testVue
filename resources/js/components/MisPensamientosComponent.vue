<template>
     <div class="row justify-content-center">
        <div class="col-md-8">
            <form-component @new="addPensamiento"></form-component>
            <br>
            <pensamientos-component 
            v-for="(pensamiento, index) in pensamientos" 
            :key="pensamientos.id"
            :pensamiento="pensamiento"
            @actualizar="actualizarPensamiento(index , ...arguments)"
            @eliminar="deletePensamiento(index)"
            >
            </pensamientos-component>
            
        </div>
    </div>
</template>

<script>
    export default {

        data(){
            return{
                pensamientos:[]
            }
        },
        mounted() {
            axios.get('pensamientos').then((response) => {
                this.pensamientos = response.data;
            })
        },
        methods:{
            addPensamiento(pensamiento){
                this.pensamientos.push(pensamiento)
            },
            deletePensamiento(index){
                this.pensamientos.splice(index,1);
            },
            actualizarPensamiento(index,pensamiento){
                this.pensamientos[index] = pensamiento
            }
        }
    }
</script>
