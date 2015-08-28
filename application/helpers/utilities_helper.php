<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('json_results')){
	function json_results($results,$field)
	{
		$json = array();
		if(!is_array($results)){
			foreach($results as $result){
				$json[] = $result->$field;
			}
		}
		else{
			foreach($results as $result){
				$json[] = $result[$field];
			}
		}
		

		return json_encode($json);
	}
}

if(!function_exists('results_toSingleArray')){
	function results_toSingleArray($results,$field)
	{
		$array = array();
		if(!is_array($results)){
			foreach($results as $result){
				$array[] = $result->$field;
			}
		}
		else{
			if(count($results)>0&&array_key_exists($field,$results[0])){
				foreach($results as $result){
					$array[] = $result[$field];
				}
			}
			
		}
		

		return $array;
	}
}

if(!function_exists('generate_months'))
{
	function generate_months($count=12,$starting_month = 0)
	{
		$months = array();
		if($starting_month==0){
			$currentMonth = (int)date('m');
		}
		else{
			$currentMonth = $starting_month;
		}
		
		for ($x = $currentMonth; $x < $currentMonth + $count; $x++) {
			$months[] = date('M', mktime(0, 0, 0, $x, 1));
		}

		return $months;
	}   
}

if(!function_exists('generate_time'))
{
	function generate_time($interval = 60,$start="00:00",$end = "23:59")
	{
		$time =array();

		$tStart = strtotime($start);
		$tEnd = strtotime($end);
		$tNow = $tStart;

		while($tNow <= $tEnd){
		  $time[] = date("H:i",$tNow);
		  $tNow = strtotime('+'.$interval.' minutes',$tNow);
		}

		return $time;
	}   
}
