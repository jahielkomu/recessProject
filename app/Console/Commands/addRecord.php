<?php

namespace App\Console\Commands;


use Illuminate\Console\Command;
use DB;
use Storage;
use App\district;
use App\member;
use App\agent;
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
        function getdistrict($distname)
        {
            //caling the method from my controller 
            
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
               
              

                foreach($contents as $arrays)
                {   $counter=$counter+1;
                    // echo($counter);
                  if(!isset($arrays)){
                    
                      continue;
                  }
                    $name = explode(",",$arrays);
                    // if(!isset($name[1]))
                    // {
                    //     deleterecord($contents,$district);
                    //     // echo "deleted";
                    //     continue;
                    // }
                
                 if(!agentids(@$name[3],@$name[4])==null || !agentids(@$name[4],@$name[5])==null )
                  {
                      
                    if(!isset($name[6])){
                      
                    // if(count($name)>5){
                        
                        
                        DB::table('members')->updateOrInsert(
                            ['districtNO'=>getdistrict($name[0]),'fname'=>strtoupper($name[1]),'gender'=>strtoupper($name[2]),'memberDistrict'=>districtid($name[0]),'agentid'=>agentsid($name[3],$name[4])]
                         
                        );
                        
                    // }
                    }
                    else
                    {
                        // doesnt allow to enter incomplete details
                        // if(count($name)>6)
                        // {

                            if(getrecommendid($name[3]))
                            {  echo "hai";
                              DB::table('members')->updateOrInsert(
                              ['districtNO'=>getdistrict($name[0]),'memberDistrict'=>districtid($name[0]),'fname'=>strtoupper($name[1]),'gender'=>strtoupper($name[2]),'recommender'=>strtoupper($name[3]),'agentid'=>agentsid($name[4],$name[5])]
                               );

                        
                            }
                          else
                             {
                                Storage::append('error/'.$district,'wrong recommender id  '.$arrays.'');
                             }      
                        // }
                    }
                  }
                  else{
                    if(!isset($name[1])){
                        
                         
                        if($counter==count($contents)){
                            // print_r ("\n".count($contents)."\n");
                            //   $su=Storage::append('success/'.$district,' total records not inserted into the database '.$fail.'');
                              $su=Storage::prepend('success/'.$district,' total records not inserted into the database '.$fail.'');
                        }
                        deleterecord($contents,$district,$content);
                        
                        continue;
                    }
                    $fail=$fail+1;
                    Storage::append('error/'.$district,''.$arrays.' #invalid signature with the following details ');
                    
                    
                  }
                 
                }

                  
    
            }
    
        
    
    }
           
    
    
}
