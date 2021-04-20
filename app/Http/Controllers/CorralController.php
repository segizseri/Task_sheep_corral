<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Corral;
use App\Models\Sheep;
use App\Models\History;



class CorralController extends Controller
{

    public function index() 
    {

        if (History::first() == '')
        {
        $forReport = new History();
            $forReport->day = '0';
            $forReport->corral_num ='0';
            $forReport->sheeps = "0";
            $forReport->killed = "0";
        $forReport->save();
        }
        $allcorrals = Corral::get();
    	if ( Sheep::isCorralEmpty() ) 
    	{
		    for($cor=1; $cor<=4; $cor++ )
			 {	
			 	$corrals =new Corral();
		        $corrals->corrals = "Загон $cor";
				$corrals->save(); 

			 }

			 for($i=1; $i<=random_int(9, 13); $i++ )
			 {	
			 	$corrals = random_int(1, 4);
				 $sheeps = new Sheep();
				 $sheeps->corral_id = $corrals;
				 $sheeps->name = "Овечек $i";
				 $sheeps->save(); 
			 }
		}
	
$combined =Corral::with('sheep')->get(); 
$showon = History::orderby('id', 'desc')->first();
$showonpage = $showon->day;
    	return view('index', compact('combined', 'allcorrals', 'showonpage'));
    }

        public function myReports($id=null)
    {
        $reports = History::where('day', $id)->get();
        return view('myreport', compact('reports'));
    }

    public function addRandom(Request $dayitem)
    {

    $days = History::orderby('id', 'desc')->first()->day;
    $day = $days+1; 
    $lastid = Sheep::lastSheepId();
	$sheeps = new Sheep();
	$sheeps->corral_id = random_int(1, 4);
	$sheeps->name = "Овечек $lastid";
	$sheeps->save(); 

$sheepList = [];
	for ( $i = 1; $i <= 4; $i++ ) 
	{
		$sheepList[$i] = Sheep::where('corral_id', $i)->count();
	}
$sheepmax = array_search(max($sheepList), $sheepList);
$sheepmin = array_search(min($sheepList), $sheepList);
$result = min($sheepList);
	$duringcorrals = Sheep::where('corral_id', $sheepmax)->orderby('id', 'desc')->first();
	$sheep = $duringcorrals->name;
	Sheep::where('name', $sheep)->delete();
if ($result < 2)
{
	$sheeps = new Sheep();
	$sheeps->corral_id = $sheepmin;
	$sheeps->name = $sheep;
	$sheeps->save(); 
}

    	$forReport = new History();
            $forReport->day = $day;
            $forReport->corral_num =$sheepmin;
            $forReport->sheeps = Sheep::countSheep();
            $forReport->killed = "0";
        $forReport->save(); 

  		return redirect()->route('index');

    }

    public function kill()
    {
        $day = History::orderby('id', 'desc')->first()->day;
        $randomSheep =  random_int(1, Sheep::lastSheepId());
    	Sheep::where('id', $randomSheep)->delete();

    	$forReport = new History();
            $forReport->day = $day;
            $forReport->corral_num = $randomSheep;
            $forReport->sheeps = Sheep::countSheep();
            $forReport->killed = "1";
        $forReport->save(); 
   	return redirect()->route('index');
    }

    public function switchSheep(Request $req)
    {
        $from = $req->corral1;
        $to = $req->corral2;
        $sheep = Sheep::where('corral_id', $from)->latest()->first();
        $name = $sheep->name;
        Sheep::where('id', $sheep->id)->delete();
    $sheeps = new Sheep();
    $sheeps->corral_id = $req->corral2;
    $sheeps->name = $name;
    $sheeps->save();

    return redirect()->route('index'); 
    }


}
