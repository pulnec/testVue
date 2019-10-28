<template>
    
            <div class="card" style="margin-bottom:10px">
                <div class="card-header">Publicado en {{pensamiento.created_at}}</div>

                <div class="card-body">
                    <input v-if="editNode" type="text" class="form-control" v-model="pensamiento.descripcion">
                    <p v-else>{{pensamiento.descripcion}}</p>
                </div>

                <div class="card-footer">
                       <button  v-if="editNode" class="btn btn-primary" v-on:click="onClickUpdate()">
                            Guardar cambios
                        </button>
                        <button  v-else class="btn btn-primary" v-on:click="onClickEdit()">
                            Editar
                        </button>
                        <button  class="btn btn-danger" v-on:click="onClickDelete()">
                            Eliminar
                        </button>
                </div>
            </div>
            
</template>

<script>
    export default {
        props: ['pensamiento'],
        data(){
            return{
                editNode:false
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods:{
            onClickDelete(){
                 axios.delete(`pensamientos/${this.pensamiento.id}`).then((response) => {
                    this.$emit('eliminar')
                 });  
            },
            onClickEdit(){
                this.editNode = true
                //this.$emit('editar')
            },
            onClickUpdate(){
                const params = {
                    descripcion:this.pensamiento.descripcion
                }
                axios.put(`pensamientos/${this.pensamiento.id}`,params).then((response) => {
                        this.editNode = false
                        const pensamiento = response.data;
                        this.$emit('actualizar',pensamiento)
                        
                })
                
            }
        }
    }
</script>
