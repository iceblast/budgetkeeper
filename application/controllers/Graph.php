<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Graph extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('entry_model');
		$this->load->model('user_model');

		if(!$this->user_model->isLoggedIn())
		{
			redirect('/user/login', 'refresh');
		}
	}
	
	public function dailyExpenses(){
		$results=array();
		$date=date('Y-m-d',strtotime("-1 days"));
		$expenses = $this->entry_model->getExpensesByDate($date);
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
			// if($hasMatch!=true){
			// 	if(count($results)>0){
			// 		$results[]=array(
			// 					'date'	=>$time,
			// 					'amount'=>null,
			// 					'rt'	=>null
			// 					);
			// 		$data[]=null;
						
			// 	}
			// }
			// $hasMatch=false;	

		}

		$series = array(); 
		$series[] = array('name'=>'Total','data'=>$data);
		//$series[] = array('name'=>'amount','data'=>results_toSingleArray($results,'amount'));
		$graph_data = array('categories'=>results_toSingleArray($results,'date'), 'series'=>$series);
		echo json_encode($graph_data);
		//echo json_results($results,'rt');
	}
}