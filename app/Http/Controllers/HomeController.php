<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\treasury;
use App\payment;
use App\agent;
use App\district;
use App\member;
use DB;
use Charts;
use App\myviews;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    public function index()
    {   //a helper function to count members from the database that have been enrolled 

        
        $results = DB::table('members')->count();

        // counts All agents available in the all country

        $agents= DB::table('agents')->count(); 

        //district with no agents .
        $district =DB::select(DB::raw('SELECT count(id) as nums from districts where id NOT IN (SELECT district_Id from agents)'));
         
        //members qualified to agents

        $member =DB::select(DB::raw('SELECT  DISTINCT recommender
        FROM members WHERE recommender IN
          (SELECT recommender FROM members GROUP BY recommender HAVING COUNT(*) >=40)'));
          $co=count($member);
          ;
        //send data to the views
        return view('welcome',['results'=>$results,'agents'=>$agents,'district'=>$district,'co'=>$co]);
    
        
    }
    // show the hierca'districts' display

    public function hierca()
    {
      /*$table='districts';
      $districts = district::all();
      foreach($districts as $district)
       $district->name{*/
        
      return view('high');
    }
  

    // show the payment details
    public function payment()
    
    { $date=date('m-y');
        global $amountagent;
<<<<<<< HEAD
=======
        
>>>>>>> e6ce9b70250731cbc8075946ec1b50afa42d4eee
        // calculating the amount of money recieved by agents ,admin agent headers
        $amount=DB::select(DB::raw("SELECT amount from treasuries "));
        // return $amount;
        $agents= DB::table('agents')->where('role','Agent')->count();
        $agenthead= DB::table('agents')->where('role','Agent head')->count();
        
        $district =DB::select(DB::raw('SELECT id, count(*) as total from districts,agents where districts.id=agents.district_Id  and agents.role="Agent" GROUP BY id ORDER BY 2 DESC'));
        // $head=DB::select(DB::raw('SELECT id,count(agentid) as agentid from districts,agents where districts.id=agents.district_Id and agents.role="Agent head" GROUP BY id'));
          foreach($district as $dist)
          {  
            // agents with district of the highest enrollment
           $noagentsinhigh=$dist->total;
          
           

            // agents within other country
           $remainingagent=$agents-$noagentsinhigh;
          
           
          foreach($amount as $cash)
          {  
            //total amount
            $totalamount;
           $totalamount=$cash->amount;
          } 
          
         // agent head with the other enrollment
          $remaininghead=$agenthead-1;
         
          
           if ($totalamount>2000000){
               
         // agent head with the other enrollment
         // agent head with the other enrollment
              $amountagent=($totalamount-2000000)/($remainingagent+0.5+(1.75*$remaininghead)+(2*$noagentsinhigh)+(7/2));
              
              
                     // getting all agents with normal enrollment 
                    $gentlowenr= DB::select(DB::raw('SELECT agentid ,role from agents where agentid  NOT in (select  agentid from agents where district_Id=(  SELECT district_Id from agents GROUP BY district_Id order by count(1) desc limit 1))'));
                     // agents with the highest enrollment
                     $genthigenr= DB::select(DB::raw('SELECT agentid ,role from agents where agentid   in (select  agentid from agents where district_Id=(  SELECT district_Id from agents GROUP BY district_Id order by count(1) desc limit 1))'));
                     $dateofpayment=payment::all()->pluck('paymentDate')->last();
                      $dateofreciv=treasury::all()->pluck('date')->last();
                      $timepayment=date('m-y',strtotime($dateofreciv));
                      $lastpayment=date('m-y',strtotime($dateofpayment));
    
                     // return $timepayment;
                    if($timepayment==$lastpayment || $timepayment<$lastpayment){
            
            
                     return view('payment',['amountagent'=>$amountagent,'remainingagent'=>$remainingagent,'noagentsinhigh'=>$noagentsinhigh,'remaininghead'=>$remaininghead]);
                     }else{
     
                     foreach($gentlowenr as $lown){
                           // adding payment details for each agent and agent not in highest enrollment
                            DB::statement('INSERT INTO  payments set payment_Id=(SELECT agentid from agents where agentid='.$lown->agentid.'),paymentDate=CURRENT_TIMESTAMP,amountpaid= case when (select role from agents where agentid='.$lown->agentid.')="Agent" then '. $amountagent.' when (select role from agents WHERE agentid='.$lown->agentid.')="Agent head"  then '.($amountagent * (7/4)).' end');
            
                        }
                     
                     foreach($genthigenr as $higenr){
                         // agents belonging to districts with the highest enrollment  
                         DB::statement('INSERT INTO  payments set payment_Id=(SELECT agentid from agents where agentid='.$higenr->agentid.'),paymentDate=CURRENT_TIMESTAMP,amountpaid= case when (select role from agents where agentid='.$higenr->agentid.')="Agent" then '. ($amountagent * 2).' when (select role from agents WHERE agentid='.$higenr->agentid.')="Agent head"  then '.($amountagent *(7/4) *2).' end');
            
                        
            
            
                       
                    
                    }
                
        }}
          else{
              $amountagent=0;
          }
       

        
//         }
//     
//     return view('payment',['amountagent'=>$amountagent,'remainingagent'=>$remainingagent,'noagentsinhigh'=>$noagentsinhigh]);
    
// }
    }
}

    
        // declare payment to the database 
        public function newpayment(Request $request){
            $this->validate($request,[
                'source'=>'required',
                'amount'=>'required',
                'date'=>'required'
                ]);
                $time=$request->all();
                $time['date']=date('y-m-d',strtotime($request->date));
                // return $time;
                if(treasury::create($request->all())){
                    return redirect()->back()->withSuccess('New payment declaration  has been added successfully');
                }
             
        }



      





    // show statistics
    public function stat()
        
    { 
    


           //member enrollment
        $data = myviews::select(
            \ DB::raw("DATE_FORMAT(created_at,'%M %Y') as months")
            // \DB::raw("COALESCE((LEAD(total) OVER (ORDER BY months DESC)-total)/total, 0) Percent_Change")
        )
        ->get();

    $chart = Charts::database($data, 'bar', 'highcharts')
        ->title("PERCENTAGE CHANGE IN ENROLLMENT FIGURES")
        ->elementLabel("percentage change")
        ->dimensions(100, 500)
        ->responsive(true)
        ->groupBy('months')
        ->values($data->pluck('Percent_Change'));
       



        $money = treasury::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))
    
        ->get();
 
        $chart2 = Charts::database($money, 'pie', 'highcharts')
        
        ->title("Monthly funds")
        
        ->elementLabel("Total wellwushe")
        
        ->dimensions(500, 260)
        
        ->responsive(true)
        
        ->groupByMonth(date('Y'), true);
        return view('stat',["chart"=>$chart,"chart2"=>$chart2]);    
    } 
    // show records
    public function records(){

        $membertable=DB::table('members')->orderBy('recommender')->get();
        $agentstable=DB::select('select * from districts,agents where id=district_Id and role="Agent"order by name asc');
        $headtable=DB::select('select * from districts,agents where id=district_Id  and role="Agent head" order by name asc');
        $districttable=DB::table('districts')->orderBy('name','desc')->get();
        
        return view('record',compact('membertable','agentstable','headtable','districttable'));
    }
    // show registration form
    public function upgrades(){
        

        $memberqualify=DB::select(DB::raw('SELECT * from members where status=0 AND fname IN (SELECT DISTINCT recommender
        FROM members WHERE recommender IN
          (SELECT recommender FROM members GROUP BY recommender HAVING COUNT(*) >=40))'));
          
          $districtAvailable=DB::select(DB::raw('SELECT * from districts where id NOT IN (SELECT district_Id from agents)
          OR id=( SELECT  district_Id  FROM agents GROUP by district_Id order by COUNT(1) ASC LIMIT 1) ORDER BY RAND() LIMIT 5'));
          return view('upgrade',compact('memberqualify','districtAvailable'));
    }


   // randomly distribute  members who qualify to be agents
   public function becomeAgent(){

       
    $memberqualified=DB::select(DB::raw('SELECT * from members where status=0 AND fname IN (SELECT DISTINCT recommender
    FROM members WHERE recommender IN
    (SELECT recommender FROM members GROUP BY recommender HAVING COUNT(*) >=40))'));
     $Agent;
        $Agent=new agent;
      foreach($memberqualified as $member){
       if($member->fname!==NULL){
      $Agent->firstName=$member->fname;
      $Agent->lastName=$member->fname;
      $Agent->userName=substr($member->fname,0,5);
      $Agent->signature=strtoupper(rand(65,90));
    DB::statement('UPDATE members Set status=1 where member_Id='.$member->member_Id);
      $district_id=DB::select('SELECT id from districts where id NOT IN (SELECT district_Id from agents)
      OR id=( SELECT  district_Id  FROM agents GROUP by district_Id order by COUNT(1) ASC LIMIT 1) ORDER BY RAND() LIMIT 5');
   
     foreach($district_id as $dist){
                 global $distt;
               $distt=$dist->id;
            
       }
        $Agent->district_Id=$distt ;
  
        $distNoAgenthead=DB::select(DB::raw('SELECT id as nums from districts where id NOT IN (SELECT district_Id from agents)'));
      
         foreach ($distNoAgenthead as $head){
                 global $headno;
                 $headno=$head->nums;
        }
     if($headno==$Agent->district_Id){
        $Agent->role="Agent head";
       }  $district_id=DB::select('SELECT id from districts where id NOT IN (SELECT district_Id from agents)
       OR id=( SELECT  district_Id  FROM agents GROUP by district_Id order by COUNT(1) ASC LIMIT 1) ORDER BY RAND() LIMIT 5');
      
      foreach($district_id as $dist){
                    global $distt;
                  $distt=$dist->id;
               
       }
       $Agent->district_Id=$distt ;
     
       $distNoAgenthead=DB::select(DB::raw('SELECT id as nums from districts where id NOT IN (SELECT district_Id from agents)'));
         
       foreach ($distNoAgenthead as $head){
                    global $headno;
                    $headno=$head->nums;
                    // return $headno;
       }
       if($headno==$Agent->district_Id && $headno!=NULL){
           $Agent->role="Agent head";
           $Agent->save();
           return redirect()->back()->withSuccess('New member has been upgraded  successfully');;
       }
       else {
           $Agent->role="Agent";
           $Agent->save();
           return redirect()->back()->withSuccess('New member has been upgraded  successfully');;
       }
       
    }

    
      
    }
    return redirect()->back()->withSuccess('No member has the required criteria');         
    }



    public function formdata(Request $request){
        // defininf the rules order_by('upload_time', 'desc')->first();that must be followed when submitting data 
        $this->validate($request,[
            'firstName'=>'required',
            'lastName'=>'required',
            // 'name'=>'required',
            'userName'=>'required',
        ]);
     

    
        $Agent=new agent;
        $Agent->firstName=$request->firstName;
        $Agent->lastName=$request->lastName;
        $Agent->userName=$request->userName;
        $Agent->signature=strtoupper(rand(65,90));
        // $district_id=DB::table('districts')->select('id')->where( 'name',$name)->first();

        // Select a random number from the database to return a value for the district
        $district_id=DB::select('SELECT id from districts where id NOT IN (SELECT district_Id from agents)
        OR id=( SELECT  district_Id  FROM agents GROUP by district_Id order by COUNT(1) ASC LIMIT 1) ORDER BY RAND() LIMIT 5');
       
       foreach($district_id as $dist){
                     global $distt;
                   $distt=$dist->id;
                
        }
        $Agent->district_Id=$distt ;
        $Agent;
        $distNoAgenthead=DB::select(DB::raw('SELECT id as nums from districts where id NOT IN (SELECT district_Id from agents)'));
          
        foreach ($distNoAgenthead as $head){
                     global $headno;
                     $headno=$head->nums;
        }
        if($headno==$Agent->district_Id){
            $Agent->role="Agent head";
        }
        else {
            $Agent->role="Agent";
        }
        $Agent->save();
        if($Agent->save()){
            
            return redirect()->back()->withSuccess('New member has been added successfully');
        }
              //   agent::create([$request->firstName,$request->lastName,$request->signature,$request->userName]);
        
    }
    public function formdata1(Request $request){
      
        $this->validate($request,[
            'name'=>'required',]);
       
        $name=$request->name;
        
       //checking if the record exits in the database
        $districtName=district::where('name','=',$name)->count();
      if($districtName>0){
               $errormessage="The district already exists!!";
            // return redirect('/newuser',compact('errormessage'));
            return redirect()->back()->withSuccess($errormessage);
        }
        else{
            $names=$request->all();
            $names['name']=$request->name;
            district::create($request->all());
            return redirect()->back()->withSuccess('New district has been added successfully');

        }


    }
    // view fo the index to make a contoller
    public function form(){

        return view('newuser');
    }

    public function districtinfo(){
        return view('newdist');
    }

// charts controller
    public function makecharts($type){

     

    return view('stat', compact('chart'));
    
    }
    //  change the id of the member to required id by the administrator
    public function changeid(){
        $distname=district::all();
        $membern=DB::select('select * from districts,members where memberDistrict=id');
     
        
           
           foreach($membern as $mem)
           { 
            $ini=substr($mem->name,0,4);
           $new= strtoupper($ini).$mem->member_Id;
        
           DB::statement("update members SET districtNO='$new' where member_Id='$mem->member_Id'");
           echo $new."<br>";   
           }

         
    }

        




}

?>