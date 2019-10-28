<template>

    <div v-on:click="OpenModal()" v-if="timeBox.avaliable" class="hvr-grow-shadow d-flex flex-column justify-content-center align-items-center" style="background:#caff77;border:1px solid #000;min-height:80px;min-width:20%;font-size:10px;margin:5px;cursor:pointer;">
        <small>{{timeBox.hora}}</small>
        <small style="font-weight: bold;">DIPONIBLE</small>
        
    </div>
    <div v-else class="hvr-grow-shadow d-flex flex-column justify-content-center align-items-center" style="background:#f61646;border:1px solid #000;min-height:80px;min-width:20%;font-size:10px;margin:5px;cursor:pointer;">
        <small>{{timeBox.hora}}</small>
         <small style="font-weight: bold;">RESERVADO</small>
    </div>

</template>

<script>
    export default {
        props: ['timeBox'],
        mounted() {
            console.log('Component mounted.')
        },
        methods:{
            OpenModal(){
                this.$emit('getHoursSelectedEvent');
                $('#myModal').modal('show');
            }
        }
    }
</script>
