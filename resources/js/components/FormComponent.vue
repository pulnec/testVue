<template>
    
 <div class="card">
                <div class="card-header">En que estas pensando?</div>

                <div class="card-body">
                  

                    <form action="" v-on:submit.prevent="newPensamiento()">
                        <div class="form-group">
                            <label for="pensamiento">Ahora estoy pensando en:</label>
                            <input type="text" class="form-control" name="pensamiento" v-model="descripcion">
                        </div>
                        <button type="submit" class="btn btn-primary">
                            Enviar Pensamiento
                        </button>
                    </form>
                </div>
            </div>
</template>

<script>
    export default {
        data(){
           return{
               descripcion:''
           }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods:{
            newPensamiento(){
                 const params = {
                    descripcion:this.descripcion
                 };

                 axios.post('pensamientos', params).then((response) => {
                    
                    const pensamiento = response.data;
                    this.$emit('new',pensamiento);
                 
                });
                
           }
        }
    }
</script>
