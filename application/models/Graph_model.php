<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Graph_model extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('entry_model');
	}

	public function getDailyExpenses($account=NULL){
		$days=generate_days();
		$results=array();
		$categories=array();
		$series=array();
		//populate categories
		foreach($days as $day){
			$categories[]=$day->format('d');
		}
		$start=$days[0]->format('Y-m-d');
		$end=$day->format('Y-m-d').' 23:59:59';
		$descriptions = $this->entry_model->getSuggestDesc('2', $start, $end,$account);
		//var_dump($descriptions);die();
		foreach($descriptions as $description){
			$data=array();
			foreach($days as $day){
				$daily_results=$this->entry_model->getEntriesByDescription('2', $day->format('Y-m-d'), $day->format('Y-m-d').' 23:59:59',$account);
				$found=false;
				foreach ($daily_results as $daily_result) {
					if(strtolower($daily_result->description)==strtolower($description->description)){
						$data[]=(float)$daily_result->amount;
						$found=true;
						break;
					}
				}
				if(!$found){
					$data[]=null;
				}
			}
			$series[]=array('name'=>$description->description,'data'=>$data);	
		}

		$graph_data = array('categories'=>$categories, 'series'=>$series);
		
		return json_encode($graph_data);
	}
	public function getHourlyExpenses(){
		$results=array();
		//$date=date('Y-m-d',strtotime("-1 days"));
		$date=date('Y-m-d');
		$expenses = $this->entry_model->getHourlyExpenses($date);
		$times = generate_time();
		$hasMatch=false;
		$maxtime='0';
		$data=array();
		foreach($times as $time){

			foreach ($expenses as $expense) {
				$exdate = new DateTime($expense->date);

				if(strtotime($exdate->format('H:i'))>strtotime($maxtime)){
					$maxtime=strtotime($exdate->format('H:i'));
					//var_dump($maxtime);die();
				}

				if($time == $exdate->format('H:i')){
					//$results[]=(array)$expense;
					$results[]=array('date'=>$time,'amount'=>(float)$expense->amount,'rt'=>(float)$expense->rt);
					$data[]=array('name'=>$expense->description,'y'=>(float)$expense->amount);
					$hasMatch=true;
					break;
				}
			}
			if(strtotime($time)>$maxtime){
				break;
			}
		}

		$series = array(); 
		$series[] = array('name'=>'Total','data'=>$data);

		$graph_data = array('categories'=>results_toSingleArray($results,'date'), 'series'=>$series);
		return json_encode($graph_data);
	}
}