<?php

namespace App\Console;

use App\Models\Assignmentdetail;
use App\Models\Doa;
use App\Models\Jatahcuti;
use App\Models\Role;
use App\Models\Wfassignment;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function(){
            $data = DB::table('doa')->where('is_active', 1)->where('end_date','>',Carbon::now())->get();
            if (sizeof($data) > 0){
                foreach($data as $value){
                    //update doa to not active
                    Doa::where('id', $value->id)->update([
                        'is_active' => false
                    ]);

                    //delete extended doa in role table
                    Role::where('doaid',$value->id)->delete();

                    //update wfassignment. jadi yang di update adalah wfassingment yang active dan assignpersonid
                    $wfassignment = Wfassignment::where('assignstatus', 'ACTIVE')->where('origpersonid',$value->alias_id)->where('assignpersonid',$value->alias_acting_id)->get();
                    foreach ($wfassignment as $valuewf){
                        $valuewf->assignperson = $valuewf->origperson;
                        $valuewf->assignpersonid = $valuewf->origpersonid;
                        $valuewf->save();
                    }

                    //update assignment
                    Assignmentdetail::where('assignmetoid',$value->alias_id)->update([
                        'delegateto' => '',
                        'delegatetoid' => ''
                    ]);
                }
            }
        })->twiceDaily(6,18);
        //cron nyaa akan jalan di setiap jam 6 pagi dan jam 6 sore

        $schedule->call(function(){
            $yearnow = Carbon::now()->format('Y');
            $yearyesterday = Carbon::yesterday()->format('Y');
            if ($yearnow != $yearyesterday){
                Jatahcuti::where('id','>',0)->update([
                   'cutitahunan' => 14,
                   'cutimelahirkan' => 30,
                ]);
            }
        });
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
