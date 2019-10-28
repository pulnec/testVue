<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\CitasDeathModel;
use App\HorariosModels;

class ApiCitasController extends Controller
{
    public function DaysInMonthCurrent(Request $request) {

        $hourForDay = HorariosModels::select('*')->where('status',1)->get(); ;
        //Primer dia del mes actual

        //total dias mes
        $date = Carbon::create(Carbon::now()->year, $request->mes);

        $AllDayInMonth = $date->daysInMonth;
        
        $dateMonthCurrent = [];

        $month =  Carbon::now()->month;
        $year =  Carbon::now()->year;

        $now = Carbon::now()->format('Y-m-d');

        for($x=1;$x<=$AllDayInMonth;$x++){
            //$date = $num.'-'.$month.'-'.$year;
            $date = $year.'-'.$this->SetNumber($request->mes).'-'.$this->SetNumber($x);

    
            if($date < $now){
                $dayAvaliable = false;
            }else{
                $dayAvaliable = true;
            }
            $dateFormat = Carbon::CreateFromFormat('Y-m-d',$date)->format('d-m-Y');
            $date_hour_ocuped = $this->getHoursAvaliable($dateFormat);
            array_push($dateMonthCurrent,["fecha" => $dateFormat , "horas_disponibles" => $hourForDay->count()-$date_hour_ocuped,"day_avaliable" => $dayAvaliable]);
        }

        return json_encode([
            "total_days" => $dateMonthCurrent ],200);
         }

         public function getHoursAvaliable($_date){
            $myDate = Carbon::CreateFromFormat('d-m-Y',$_date)->format('Y-m-d'); 
            $Hour = CitasDeathModel::select('*')->where('fecha',$myDate)->get();
            return $Hour->count();
         }

         public function getHoursDate(Request $request){

            $fecha = Carbon::CreateFromFormat('d-m-Y',$request->fecha)->format('Y-m-d'); 
            $hours = HorariosModels::select('*')->where('status',1)->get();
            $Avaliables = [];
            foreach ($hours as $compare) {
         
                $avaliable_hours = CitasDeathModel::select('*')->where('fecha',$fecha)->where('hora',$compare['hora_back'])->first();
                
                if($avaliable_hours){
                    $newData = ["hora" => $compare['hora_usuario'],"hora_back" => $compare['hora_back'] , "avaliable" => false];
                }else{
                    $newData = ["hora" => $compare['hora_usuario'],"hora_back" => $compare['hora_back'] , "avaliable" => true];
                }
                array_push($Avaliables,$newData);
            }
            return json_encode(["fecha" => $request->fecha ,"horas" => $Avaliables]);
         }

         public function SetNumber($_number){
    
             if($_number <= 9){
                $_number = '0'.$_number;
             }else{
                $_number = $_number;
             }
             return $_number;
         }

         public function SetHoursCalendarDate($start = 0, $end = 86400, $step = 3600, $format = 'g:i a') 
         {
                $times = array();
                foreach (range( $start, $end, $step ) as $timestamp) {
                        $hour_mins = gmdate( 'H:i:s', $timestamp );
                        if (!empty( $format ))
                                array_push($times,["hora_usuario" =>gmdate( $format, $timestamp ), "hora_real" => $hour_mins]);
                                //$times[$hour_mins] = gmdate( $format, $timestamp );
                        else array_push($times,$hour_mins);
                }
                return $times;
         }

         public function saveNewReserva(Request $request){

              CitasDeathModel::create([
                "correo" => $request->correo,
                "fecha" => Carbon::CreateFromFormat('d-m-Y',$request->fecha)->format('Y-m-d'),
                "hora" => $request->hora
              ]);
            
              return json_encode('Hola!');
         }
}
