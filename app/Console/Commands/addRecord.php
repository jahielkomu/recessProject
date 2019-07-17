<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Storage;
use App\district;
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
        
        $files = Storage::files('/district_files');
        foreach($files as $district){

        $content = Storage::get($district);

        $contents = explode("\n",$content);
            foreach($contents as $arrays){
                $name = explode(",",$arrays);
                if(!isset($name[1])){
                    continue;
                }
                if(!isset($name[3])){
                    DB::table('members')->updateOrInsert(
                        ['fname'=>$name[1],'gender'=>$name[2],'created_at'=>$name[3]]
                    );


                }else{
                    DB::table('members')->updateOrInsert(
                        ['fname'=>$name[1],'gender'=>$name[2],'recommender'=>$name[3],'created_at'=>$name[4]]
                    );
                }


            }

        }
        $distname=district::all();
        $membern=DB::select('select * from districts,members where memberDistrict=id');
     
        
           
           foreach($membern as $mem)
           { 
            $ini=substr($mem->name,0,4);
           $new= strtoupper($ini).$mem->member_Id;
        
           DB::statement("update members SET districtNO='$new' where member_Id='$mem->member_Id'");
           echo "successful";   
           }
        }
           
    
    
}
