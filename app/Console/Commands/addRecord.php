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
    protected $signature = 'command:addRecord';

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
            echo $agent->agentid;

        } 
       
         agentids('kkom','d');
        function deleterecord($arrays,$district,$content)
        {
            foreach ($arrays as $url) 
            {
                $tempcontent =" ";
                 $contents = $tempcontent;
                 Storage::put($district, $contents);
            }   
        }
          

        $files = Storage::files('/district_files');
        foreach($files as $district)
           {
               $content = Storage::get($district);
               $contents = explode("\n",$content);
            
                foreach($contents as $arrays)
                {
                    $name = explode(",",$arrays);
                
                    if(!isset($name[1])){
                        deleterecord($contents,$district,$content);
                        continue;
                    }
                    if(!isset($name[4])){
                      
                    if(count($name)>3){
                        
                    
                        DB::table('members')->updateOrInsert(
                            ['districtNO'=>getdistrict($name[0]),'fname'=>$name[1],'gender'=>$name[2],'memberDistrict'->districtid($name[0])]
                        
                        );
                    }
                    }
                    else
                    {
                        // doesnt allow to enter incomplete details
                        if(count($name)>4)
                        {

                        
                        DB::table('members')->updateOrInsert(
                            ['districtNO'=>getdistrict($name[0]),'memberDistrict'=>districtid($name[0]),'fname'=>$name[1],'gender'=>$name[2],'recommender'=>$name[3]]
                        );
                        
                        }
                    }
    
                }
    
            }
    
        
    
    }
           
    
    
}
