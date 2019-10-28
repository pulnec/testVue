<template>
    <div class="row">
        <div class="col-lg-8">
            <div class="d-flex flex-row justify-content-between">
                <h2>Mes {{Months[monthSelect-1]}} - Dias disponibles</h2>
                <select id="select_month" class="form-control" @change="onChange()" v-model="selectedValue" style="width:30%">
                    <option value="1">ENERO</option>
                    <option value="2">FEBRERO</option>
                    <option value="3">MARZO</option>
                    <option value="4">ABRIL</option>
                    <option value="5">MAYO</option>
                    <option value="6">JUNIO</option>
                    <option value="7">JULIO</option>
                    <option value="8">AGOSTO</option>
                    <option value="9">SEPTIEMBRE</option>
                    <option value="10">OCTUBRE</option>
                    <option value="11">NOVIEMBRE</option>
                    <option value="12">DICIEMBRE</option>    
                </select>
            </div>
            <div class="d-flex flex-row align-content-start flex-wrap">
            <box-day-component 
                v-for="(days, index) in calendar.total_days"
                :key="calendar.total_days" 
                :daysBox="calendar.total_days[index]"
                @getHoursEvent="getHours(1,...arguments)">

            </box-day-component>
            </div>
        </div>
        <div class="col-lg-4 ">
             <div v-if="dateSelected">
             <h3>Horas disponibles para la fecha {{hoursAvaliable.fecha}}</h3>
             <small>Death baila solo de {{hoursAvaliable.horas[0].hora}} a {{hoursAvaliable.horas[hoursAvaliable.horas.length-1].hora}}</small>
             </div>
             <div class="d-flex flex-row align-content-start flex-wrap">
             <box-hours-component
              v-if="dateSelected" v-for="(hours, index) in hoursAvaliable.horas"
              :key="hoursAvaliable.horas"
              :timeBox="hoursAvaliable.horas[index]"
              @getHoursSelectedEvent="getHoursInfo(index)"
              ></box-hours-component>

              <box-hours-component
              v-else ></box-hours-component>
              </div>
             
        </div>
         <modal-component
         :horaInfo="horaSelected"
         :fechaSelect="fechaSelected"
         @refreshReserve="getHours(2,...arguments)"
         >
         </modal-component>
    </div>
</template>



<script>
    export default {
        
        data(){
           return {
              calendar:'',
              hoursAvaliable:'',
              dateSelected:false,
              horaSelected:'',
              fechaSelected:'',
              selectedValue:1,
              monthSelect:0,
              Months:[
                  "ENERO",
                  "FEBRERO",
                  "MARZO",
                  "ABRIL",
                  "MAYO",
                  "JUNIO",
                  "JULIO",
                  "AGOSTO",
                  "SEPTIEMBRE",
                  "OCTUBRE",
                  "NOVIEMBRE",
                  "DICIEMBRE"
              ]
           }     
        },
        mounted() {
            var d = new Date();
            var n = d.getMonth();
            this.getDataInit(n+1);

            $("#select_month").prop('selectedIndex',monthSelect);
        },
        methods:{
            getHours(tipo,_avaliable){
                this.hoursAvaliable = _avaliable;
                this.dateSelected = true;
                if(tipo === 2){
                    this.getDataInit(this.monthSelect);
                }
            },
            getHoursInfo(index){
                this.horaSelected = this.hoursAvaliable.horas[index];
                this.fechaSelected = this.hoursAvaliable.fecha;
            },
            getDataInit(mes){

                 var params = {
                     mes:mes
                 }
                 axios.post('api/citas/month',params).then((response) => {
                  this.calendar = response.data;
                 })
                 this.monthSelect = mes;
            },
            onChange(){
                this.monthSelect = this.selectedValue;
                this.hoursAvaliable = '';
                this.dateSelected = false;
                this.getDataInit(this.selectedValue);
            }
        }
    }
</script>
