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
       
        
        function deleterecord($arrays,$district,$content)
        {
            foreach ($arrays as $url) 
            {
                $tempcontent =" ";
                 $contents = $tempcontent;
                 Storage::put($district, $contents);
            }   
        }
        function getrecommendid($recom){
            $recomid=member::where('member_Id',$recom)->first();
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
               

                foreach($contents as $arrays)
                {   
                  
                  if(!isset($arrays)){
                      continue;
                  }
                    $name = explode(",",$arrays);
                
                 if(!agentids('kkom','d')==null)
                  {
                      
                    if(!isset($name[1])){
                        deleterecord($contents,$district,$content);
                        continue;
                    }
                    if(!isset($name[4])){
                      
                    if(count($name)>3){
                        
                        
                        DB::table('members')->updateOrInsert(
                            ['districtNO'=>getdistrict($name[0]),'fname'=>$name[1],'gender'=>$name[2],'memberDistrict'=>districtid($name[0]),'agentid'=>agentsid('kkom','d')]
                         
                        );
                        
                    }
                    }
                    else
                    {
                        // doesnt allow to enter incomplete details
                        if(count($name)>4)
                        {

                            if(getrecommendid('11')){
                        DB::table('members')->updateOrInsert(
                            ['districtNO'=>getdistrict($name[0]),'memberDistrict'=>districtid($name[0]),'fname'=>$name[1],'gender'=>$name[2],'recommender'=>$name[3],'agentid'=>agentsid('kkom','d')]
                        );
                        
                    }else{

                    }      Storage::append('error/'.$district,'wrong recommender id  '.$arrays.'');
                        }
                    }
                  }
                  else{
                    if(!isset($name[1]) and $arrays==end($contents)){
                        // deleterecord($contents,$district,$content);
                       
                        
                                Storage::put('success/'.$district,' total records not inserted into the database '.$fail.'');

                        
                        
                        continue;
                    }
                    Storage::put('error/'.$district,'invalid signature with the following details '.$arrays.'');
                    $fail=$fail+1;
                    
                  }
                 
                }

                  
    
            }
    
        
    
    }
           
    
    
}
