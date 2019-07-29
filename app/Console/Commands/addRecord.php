<?php

namespace App\Console\Commands;


use Illuminate\Console\Command;
use DB;
use Storage;
use App\district;
use App\member;
use App\agent;
use App\payment;
use App\treasury;
class addRecord extends Command

{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'addRecord';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'inserts data in the database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()

    {   

           function payment()
    
        { $date=date('m-y');
            global $amountagent; 
            global $totalamount;
            // calculating the amount of money recieved by agents ,admin agent headerspayment
            $amount=DB::select(DB::raw("SELECT amount from salaries"));
            // return $amount;
            $agents= DB::table('agents')->where('role','Agent')->count();
            $agenthead= DB::table('agents')->where('role','Agent head')->count();
            
            $district =DB::select(DB::raw('SELECT id, count(*) as total from districts,members where districts.id=members.memberDistrict  GROUP BY id ORDER BY 2 DESC'));
           
            // $head=DB::select(DB::raw('SELECT id,count(agentid) as agentid from districts,agents where districts.id=agents.district_Id and agents.role="Agent head" GROUP BY id'));
            // return $district;
     
               
            foreach($district as $dist)
              {  
                  
        
                // agents with district of the highest enrollment after getting the id 
               $noagentsinhigh=DB::table('agents')->where('district_Id',$dist->id)->where('role','Agent')->count();
              
                
     
                // agents within other country
               $remainingagent=$agents-$noagentsinhigh;
              
            //    return $noagentsinhigh;
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
        
                        //  return date('d',strtotime($dateofpayment));
                        if($timepayment==$lastpayment || $timepayment<$lastpayment){
                      }else{
         
                         foreach($gentlowenr as $lown){
                               // adding payment details for each agent and agent not in highest enrollment
                                DB::statement('INSERT INTO  payments set payment_Id=(SELECT agentid from agents where agentid='.$lown->agentid.'),paymentDate=CURRENT_TIMESTAMP,amountpaid= case when (select role from agents where agentid='.$lown->agentid.')="Agent" then '. $amountagent.' when (select role from agents WHERE agentid='.$lown->agentid.')="Agent head"  then '.($amountagent * (7/4)).' end');
                            
     
                                
                            }
                         
                         foreach($genthigenr as $higenr){
                             // agents belonging to districts with the highest enrollment  
                             DB::statement('INSERT INTO  payments set payment_Id=(SELECT agentid from agents where agentid='.$higenr->agentid.'),paymentDate=CURRENT_TIMESTAMP,amountpaid= case when (select role from agents where agentid='.$higenr->agentid.')="Agent" then '. ($amountagent * 2).' when (select role from agents WHERE agentid='.$higenr->agentid.')="Agent head"  then '.($amountagent *(7/4) *2).' end');
                             
                            $content="\t \t Administrator - ".number_format($amountagent/2,0)."
                              Agent head- ".number_format($amountagent*(7/4),0)."
                              Agent - ".number_format($amountagent,0)."
                              Agent with highest enrollment - ".number_format(2*$amountagent,0)."
                              Agent head with highest enrollment- " .number_format((7/2)*$amountagent,0)."
                              payment Date -".date('d-m-y');
                        //    one approach to write to file or i will consider the know php
                          Storage::put('payment_files/payment.txt', $content);
                        // $myfile=fopen("payment_files/payment.txt",'w+') or die("unble to open") ;
                        // fwrite($myfile,$content);
                        // fclose($myfile);
                        // return $content;
                            
                
                
                           
                        
                        }
                    
            }}
              else{
                  $amountagent=0;
                  Storage::put('payment_files/payment.txt', 'No payments were made this month,sorry check next month ');
              }
        }
        
     }

        function getdistrict($distname)
        {
            
            $distname= str_replace(' ', '', $distname);
            $id=district::where('name',$distname)->first();
            $memid=member::all()->pluck('member_Id')->last();
            $memid=$memid+1;
            $ini=substr($id->name,0,4);
            $new= strtoupper($ini).$memid;
        
        return $new;

        } 
        function districtid($ids)
        {
            $distname= str_replace(' ', '', $ids);
            $did=district::where('name',$distname)->first();
            return $did->id;
        }
        function agentids($username,$sign){
            $agentsname= str_replace(' ', '',$username);
            $agentsign= str_replace(' ', '',$sign);
            $agent=agent::where(['userName'=>$agentsname,'signature'=>$agentsign])->first();
            // echo
            return  $agent;

        } 
        function agentsid($username,$sign){
            $agentsname= str_replace(' ', '',$username);
            $agentsign= str_replace(' ', '',$sign);
            $agent=agent::where(['userName'=>$agentsname,'signature'=>$agentsign])->first();
            // echo
            return  $agent->agentid;

        } 
       
        
        function deleterecord($arrays,$district)
        {
            foreach ($arrays as $url) 
            {
                $tempcontent ="  ";
                 $contents = $tempcontent;
                 Storage::put($district, $contents);
            }   
        }
        function getrecommendid($recom){
            $recommender= str_replace(' ', '',$recom);
            $recomid=member::where('recommender',$recommender)->first();
             if($recomid){
                 return 1;
             }
        }
          

        $files = Storage::files('/district_files');
       
        foreach($files as $district)
           {
               $content = Storage::get($district);

               $contents = explode("\n",$content);
               $fail=0;
               $counter=0;
               
            //    print_r($contents);

                foreach($contents as $arrays)
                {   $counter=$counter+1;
                    // echo($counter);
                  if(!isset($arrays)){
                    
                      continue;
                  }
                    $name = explode(" ",$arrays);
                    // if(!isset($name[1]))
                    // {
                    //     deleterecord($contents,$district);
                    //     // echo "deleted";
                    //     continue;
                    // }
                    
                    // print_r($names);
                    // exit();
                 if(!agentids(@$name[1],@$name[2])==null)
                  {
                    $names=$name[3];
                    $names=explode('_',$names);
                    
                      
                    if($name[6]=='self'){
                       
                        
                        DB::table('members')->updateOrInsert(
                            ['districtNO'=>getdistrict($name[0]),'fname'=>strtoupper($names[0]),'LName'=>strtoupper($names[1]),'gender'=>strtoupper($name[5]),'memberDistrict'=>districtid($name[0]),'agentid'=>agentsid($name[1],$name[2]),'recommender'=>'SELF']
                         
                        );
                    
                    }
                    else
                    {
                        // doesnt allow to enter incomplete details

                            // if(getrecommendid())
                            // { 
                                 
                              DB::table('members')->updateOrInsert(
                              ['districtNO'=>getdistrict($name[0]),'memberDistrict'=>districtid($name[0]),'fname'=>strtoupper($names[0]),'LName'=>strtoupper($names[1]),'gender'=>strtoupper($name[5]),'recommender'=>strtoupper($name[6]),'agentid'=>agentsid($name[1],$name[2])]
                               );

                        
                            // }
                        //   else
                        //      {   $dis =explode('/',$district);
                        //         $disnam= str_replace(".txt",'',$dis[1]);
                        //         $cont= str_replace(''.$disnam.',','',$arrays);
                        //         str_replace(','.$name[6].'','',$cont);
                        //         print_r($cont);
                        //         Storage::append('error/'.$dis[1],$cont);
                        //      }      
                        // }
                    }
                  }
                  else{
                    if($counter==count($contents)){
                        
                
                        deleterecord($contents,$district);
                       
                        
                        continue;
                    }
                    $dis =explode('/',$district);
                    $disnam= str_replace(".txt",'',$dis[1]);
                    $cont= str_replace(''.$disnam.'','',$arrays);
                    Storage::append('error/'.$dis[1],trim($cont));
                    
                    
                  }
                 
                }

                  
    
            }
    
        
            payment();
    }
           
    
    
}
