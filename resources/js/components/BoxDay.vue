<template>
    <div v-if="daysBox.day_avaliable" v-on:click="SelectDay()" class="hvr-grow-shadow d-flex flex-column justify-content-center align-items-center" style="border:1px solid #000;min-height:120px;min-width:12%;font-size:10px;margin:5px;cursor:pointer;">
        <small>Fecha:</small>
        <div>{{daysBox.fecha}}</div>
        <small>Horas disponibles:</small>
        <div class="d-flex flex-column justify-content-center align-items-center" style="background:black;color:white;width:20px;height:20px;border-radius:10px;">{{daysBox.horas_disponibles}}</div>
    </div>

     <div v-else class="hvr-grow-shadow d-flex flex-column justify-content-center align-items-center" style="background:grey;border:1px solid #000;min-height:120px;min-width:12%;font-size:10px;margin:5px;cursor:pointer;">
        <small>Fecha:</small>
        <div>{{daysBox.fecha}}</div>
        <small>Horas disponibles:</small>
        <div class="d-flex flex-column justify-content-center align-items-center" style="background:black;color:white;width:20px;height:20px;border-radius:10px;">{{daysBox.horas_disponibles}}</div>
    </div>

</template>

<script>
    export default {
        props: ['daysBox'],
        mounted() {
            console.log('Component mounted.')
        },
        methods:{
            SelectDay(){
                const params = {
                    fecha: this.daysBox.fecha
                }
                axios.post('api/citas/hoursdate',params).then((response) => {
                    this.$emit('getHoursEvent',response.data);
                })
                
            }
        }
    }
</script>
