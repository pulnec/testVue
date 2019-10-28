<template>
   <!-- The Modal -->
    <div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">Reservar hora de baile con <b>DEATH</b></h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          
                 <div>Fecha seleccionada: {{fechaSelect}}</div>
                 <div>Hora seleccionada: {{horaInfo.hora}}</div>
                 
                 <div>
                     <h3>Ingrese su correo para reservar</h3>
                     <input type="email" class="form-control" placeholder="ej. jorgelandrade55@gmail.com" v-model="correo">
                     <small>Reserva solo si estas seguro, A <b>Death</b> no le gusta que le falten.</small>
                 </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
            <button v-on:click="SaveReserva()"  type="button" class="btn btn-primary">Reservar</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        </div>

        </div>
    </div>
    </div>  
</template>

<script>
export default {
    props:['horaInfo','fechaSelect'],
     data(){
           return{
               correo:''
           }
    },
    mounted() {
       
    },
    methods:{
        SaveReserva(){

           if(this.correo != ''){

            const params = {
                correo:this.correo,
                hora:this.horaInfo.hora_back,
                fecha:this.fechaSelect
            }
            axios.post('api/citas/new',params).then((response) => {
                
                const params = {
                    fecha: this.fechaSelect
                }
                axios.post('api/citas/hoursdate',params).then((response) => {
                    this.$emit('refreshReserve',response.data);
                    this.correo = '';
                    $('#myModal').modal('hide');
                })
            })
          }
        }
    }
}
</script>