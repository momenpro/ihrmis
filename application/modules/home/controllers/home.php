<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Integrated Human Resource Management Information System
 *
 * An Open Source Application Software use by Government agencies for  
 * management of employees Attendance, Leave Administration, Payroll, 
 * Personnel Training, Service Records, Performance, Recruitment,
 * Personnel Schedule(Plantilla) and more...
 *
 * @package		iHRMIS
 * @author		Manny Isles
 * @copyright	Copyright (c) 2008 - 2013, Charliesoft
 * @license		http://charliesoft.net/ihrmis/license
 * @link		http://charliesoft.net
 * @github	    http://github.com/mannysoft/ihrmis
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * iHRMIS Conversion Table Class
 *
 * This class use for converting number of minutes late
 * to the corresponding equivalent to leave credits.
 *
 * @package		iHRMIS
 * @subpackage	Models
 * @category	Models
 * @author		Manny Isles
 * @link		http://charliesoft.net
 * @github	    http://github.com/mannysoft/ihrmis/hrmis/user_guide/models/conversion_table.html
 */
class Home extends MX_Controller  
{
	// --------------------------------------------------------------------
	
	function __construct()
    {
        parent::__construct();
		//$this->output->enable_profiler(TRUE);
				
		//$this->load->library('zkemkeeper');
		
		//$this->zkemkeeper->connect();
		
		
		//echo $this->session->sess_expiration;
		
		/*
		$date = new ExpressiveDate;
		
		$date->minusOneDay();

		echo $date->getRelativeDate(); // 1 day ago
		
		$date->addOneWeek();
		
		echo $date->getShortDate(); // Jan 31, 2012
		
		$a = new Illuminate\Container;
		*/
    }  
	
	// --------------------------------------------------------------------
	
	function home_page()
	{
		//var_dump(AppointmentIssued::create(array('id' => 25)));
		//return View::make('home.index', array('test' => '25654'));
		
		//https://gist.github.com/mannysoft/7594099
		
		// Prepare some test data for our views
		/*
		$array = explode('-', date('d-m-Y'));
		list($d, $m, $y) = $array;
 		
		return View::make('home.index', array('test' => '1213120'));
		
		return $this->load->blade('home.index', array('test' => '1213120'));
		
		// Basic view with no data
		return $this->load->blade('welcome_message', array('test' => '1213120'));
		 
		// Passing a single value
		echo $this->load->blade('home.index')->with('day', $d);
 
		// Multiple values with method chaining
		echo $this->load->blade('home.index')
			 ->with('day', $d)
			 ->with('month', $m)
			 ->with('year', $y);
 
		// Passing an array
		echo $this->load->blade('home.index', array(
			'day' => $d,
			'month' => $m,
			'year' => $y
		));
		*/
		//$v = new View();
		//echo $v->make('welcome_message');
		
		//echo Viewmake('welcome_message');
				
		/*
		return new Illuminate\Blade\View(
			new Environment(Loader::make(
				$this->config->item('views_path', 'blade'),
				$this->config->item('cache_path', 'blade')
			)),
			'home.index', array()
		);
		*/
		
		//
		//$a = new Input();
		//var_dump(Input::get('a'));
		//Input::all();
		//$input = Illuminate\Http\Request::createFromGlobals();
		
		///var_dump($input->get('group_id'));
		//MannysoftDate::yes();
		
		
		//$dtr->office_id = 19;
		//$dtr->validate();
		
		//$resolver = new Illuminate\Validation\Validator();
		
		//$dtr->save();
		
		//var_dump($dtr);
		//echo $dtr->id;
		
		//exit;
		
		//if($dtr->save())
		//{
			//echo 'yeah';
		//}
		//echo $config->dbprefix;
		
		//exit;
		//var_dump($config);
		/*
		$conn = Capsule\Database\Connection::make('default', array(
                'host'     	=> $config->hostname,
				'database' 	=> $config->database,
				'username' 	=> $config->username,
				'password' 	=> $config->password,
				'collation' => 'utf8_general_ci',
				'driver'   	=> 'mysql',
				'prefix'   	=> $config->dbprefix,
            ), true);
			
		*/	
		
		//$this->load->library('MPDF52/mpdf');
				
		//$this->mpdf->WriteHTML('<p>Hello There hahahaha</p>');
				
		//$this->mpdf->Output('mpdf.pdf','I'); 
		
		//print_r($dates);
		
		//echo Payroll::foo();
		
		//$this->load->model('eloquent/AdditionalCompensation');
		
		//echo AdditionalCompensation::all();
		
		$data = array();
		
		$data['msg'] = '';
		
		$data['page_name'] = 'Home';
		
		//Get the current ip of the machine
		$data['ip'] = $this->Stand_alone->current_ip();
		
		//set the delete logs from machine to no
		$this->Stand_alone->change_delete_status('no');
		
		//=========================================================================
		
		//Earn the leave credits if not yet earned
		$month = date('m');
		$year = date('Y');
		
		$isLastDayOfMonth   =  $this->Helps->is_last_day($month, $year, date('d'));
		
		$isLeaveMonthEarned = $this->Leave_earn_sched->is_leave_month_earned($month, $year);
		
		//Last day of the month
		$lastDayOfMonth 	= $this->Helps->get_last_day($month, $year);
		
		//Determine if the last day of the month is Saturday or sunday or Holiday
		$isSaturdaySunday 	= $this->Helps->is_sat_sun($month, $lastDayOfMonth, $year);
		
		//Determimine if last day of the month is holiday
		$isHoliday 		  	= $this->Holiday->is_holiday($year.'-'.$month.'-'.$lastDayOfMonth);
		
		//If the last day is Sat or sun or Holiday
		if ($isSaturdaySunday == 'Saturday' || $isSaturdaySunday == 'Sunday' || $isHoliday == TRUE)
		{
			$data['msg'] = 'The last day of the month is Saturday/Sunday/Holiday.<br>';
			$data['msg'] .='The earnings of leave credits is always scheduled every last day <br>';
			$data['msg'] .= 'of every month.<br>';
			$data['msg'] .= 'We are going to schedule the earning of leave credits on the last friday of this month.<br>';
		}
		
		
		//if click the Perform leave earnings Now!
		if (isset($_GET['perform_leave']) && $_GET['perform_leave'] == 1)
		{
			echo '<div id="mydiv"><img src="images/progress.gif"> Please wait... Leave earning on progress...</div>';
			$Leave->process_leave_earnings($_GET['month'], $_GET['year'], $_GET['leave_earn']);
			echo '<script>alert("Done leave earnings!")</script>';
			echo '<script>window.location = "index.php?q=8"</script>';
		}

				
		$data['main_content'] = 'home';
		
		$this->load->view('includes/template', $data);
		
		//return View::make('includes/template', $data);
	}
}

/* End of file home.php */
/* Location: ./system/application/modules/home/controllers/home.php */