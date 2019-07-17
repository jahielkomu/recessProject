<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
<<<<<<< HEAD
        //         ->hourly();
        $schedule->command('command:addRecord')
        ->everyFiveMinutes();
=======
        //          ->hourly();
       
        // CHANGES APEAR HERE ONLY
        $schedule->call(      


            function (){
    
                $files = Storage::files('/DistrictFiles');
                foreach($files as $district){
        
                $content = Storage::get($district);
        
                $contents = explode("\n",$content);
                    foreach($contents as $arrays){
                        $name = explode(",",$arrays);
                        DB::table('members')->updateOrInsert(
                            ['name'=>$name[0],'gender'=>$name[1],'recommender'=>$name[2],'date'=>$name[3]]
                        );
        
                    }
        
                }
                return '<script>alert("Data inserted check records");</script>';
            }
        
        )->everyFiveMinutes();


        
        
>>>>>>> cf1609b75a235cb0a47f9097316c20a91991d7f8
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
