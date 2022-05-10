<?php

namespace App\Traits;

use App\Models\Assignmentdetail;
use App\Models\Wfassignment;
use App\Models\Wfprocess;
use Illuminate\Validation\ValidationException;


trait WorkflowTraits
{
    public function init($assignmentcode,$assignmentid,$iddoctransaksi,$module,$codedoctransaksi,$link){

        //pengecekan apakah ada wf yang berjalan . jika ada maka akan di hapus dulu untuk kemudian di create ulang.
        $isExist = Wfassignment::where('ownertrxid',$iddoctransaksi)->where('assignstatus', 'ACTIVE')->first();
        if (!$isExist){
            // kalo get data nyaa found
            Wfassignment::where('ownertrxid',$iddoctransaksi)->where('assignstatus', 'ACTIVE')->delete();
        }

        //ambil sequence dan ambil data dari assignment detail paling rendah
        $assignmentdetailmin = Assignmentdetail::where('assignment_code',$assignmentcode)->min('sequence');
        $objectAssignmentDetailMin = Assignmentdetail::where('assignment_code',$assignmentcode)->where('sequence', $assignmentdetailmin)->orderBy("sequence")->first();



        //pengecekan DOA
        $wfassignment = '';
        if ($objectAssignmentDetailMin->delegateto == null || $objectAssignmentDetailMin->delegateto == ''){
            //create wfassignment
            //kalo doa kosong
            $wfassignment = $this->createWfAssignment(
                $assignmentcode,
                $objectAssignmentDetailMin->assignment_description,
                $objectAssignmentDetailMin->sequence,
                'ACTIVE',
                $module,
                $codedoctransaksi,
                $objectAssignmentDetailMin->assignmeto,
                $objectAssignmentDetailMin->assignmetoid,
                $objectAssignmentDetailMin->assignmeto,
                $objectAssignmentDetailMin->assignmetoid,
                $iddoctransaksi,
                $iddoctransaksi,
                $assignmentid,
                $link
            );
        } else {
            //create wfassignment
            //kalo ada DOA
            $wfassignment = $this->createWfAssignment(
                $assignmentcode,
                $objectAssignmentDetailMin->assignment_description,
                $objectAssignmentDetailMin->sequence,
                'ACTIVE',
                $module,
                $codedoctransaksi,
                $objectAssignmentDetailMin->assignmeto,
                $objectAssignmentDetailMin->assignmetoid,
                $objectAssignmentDetailMin->delegateto,
                $objectAssignmentDetailMin->delegatetoid,
                $iddoctransaksi,
                $iddoctransaksi,
                $assignmentid,
                $link
            );
        }

        return $objectAssignmentDetailMin;

    }

    public function approve($assignmentcode,$assignmentid,$statusdoc,$iddoctransaksi,$module,$codedoctransaksi,$link){
        // urutannya approve dulu -> change doc status ke status selanjutnya -> insert doc transaksi history.

        $assignmentdetail = Assignmentdetail::where('assignment_code',$assignmentcode)->where('status',$statusdoc)->first();

        //get max sequence
        $assignmentdetailmax = Assignmentdetail::where('assignment_code',$assignmentcode)->max('sequence');
        //$objectAssignmentDetailMax = Assignmentdetail::where('assignment_code',$assignmentcode)->where('sequence', $assignmentdetailmax)->get();

        //di cek jika sequence lebih rendah dari yang max sequence artinya dia belum di step approval terakhir
        if ($assignmentdetail->sequence == $assignmentdetailmax){
            //jika sequence ada di step terakhir.

            //non active kan approval
            Wfassignment::where('ownertrxid',$iddoctransaksi)
                ->where('sequence', $assignmentdetail->sequence)
                ->update(['assignstatus' => 'NONACTIVE']);
            $assignmentdetail->status = 'COMPLETE';
            return $assignmentdetail;

        } elseif ($assignmentdetail->sequence < $assignmentdetailmax) {
            //jika sequence lebih rendah atau bukan step approval terakhir

            //non active approval sekarang
            Wfassignment::where('ownertrxid',$iddoctransaksi)
                ->where('sequence', $assignmentdetail->sequence)
                ->update(['assignstatus' => 'NONACTIVE']);

            //create new approval for next approver
            $assignmentdetailnow = Assignmentdetail::where('assignment_code',$assignmentcode)->where('sequence',$assignmentdetail->sequence + 1)->first();

            //cek doa
            if($assignmentdetailnow->delegateto == null || $assignmentdetailnow->delegateto == ''){
                //create wfassignment
                //kalo doa kosong
                $wfassignment = $this->createWfAssignment(
                    $assignmentcode,
                    $assignmentdetailnow->assignment_description,
                    $assignmentdetailnow->sequence,
                    'ACTIVE',
                    $module,
                    $codedoctransaksi,
                    $assignmentdetailnow->assignmeto,
                    $assignmentdetailnow->assignmetoid,
                    $assignmentdetailnow->assignmeto,
                    $assignmentdetailnow->assignmetoid,
                    $iddoctransaksi,
                    $iddoctransaksi,
                    $assignmentid,
                    $link
                );
            } else {
                //create wfassignment
                //kalo ada DOA
                $wfassignment = $this->createWfAssignment(
                    $assignmentcode,
                    $assignmentdetailnow->assignment_description,
                    $assignmentdetailnow->sequence,
                    'ACTIVE',
                    $module,
                    $codedoctransaksi,
                    $assignmentdetailnow->assignmeto,
                    $assignmentdetailnow->assignmetoid,
                    $assignmentdetailnow->delegateto,
                    $assignmentdetailnow->delegatetoid,
                    $iddoctransaksi,
                    $iddoctransaksi,
                    $assignmentid,
                    $link,
                );
            }

            return $assignmentdetailnow;

        }

    }

    public function reject($assignmentcode,$iddoctransaksi,$statusdoc){

        $assignmentdetail = Assignmentdetail::where('assignment_code',$assignmentcode)->where('status',$statusdoc)->first();

        //non active approval sekarang
        Wfassignment::where('ownertrxid',$iddoctransaksi)
            ->where('sequence', $assignmentdetail->sequence)
            ->update(['assignstatus' => 'NONACTIVE']);

        return $assignmentdetail;
    }

    public function stopWf(){

    }

    public function createWfprocess($sequencenow,$sequencenext,$status,$ownertrxid,$assignment_id,$assignment_code,$isprocessactive){

//        $wfprocess = Wfprocess::create([
//            'sequencenow' => $objectAssignmentDetailMin->sequence,
//            'sequencenext' => $sequenceNext,
//            'status' => $objectAssignmentDetailMin->status,
//            'ownertrxid' => $applicant->id,
//            'assignment_id' => $assignmentid ,
//            'assignment_code' => $assignmentcode,
//            'isprocessactive' => true,
//        ]);


        $wfprocess = Wfprocess::create([
            'sequencenow' => $sequencenow,
            'sequencenext' => $sequencenext,
            'status' => $status,
            'ownertrxid' => $ownertrxid,
            'assignment_id' => $assignment_id ,
            'assignment_code' => $assignment_code,
            'isprocessactive' => $isprocessactive,
        ]);

        return $wfprocess;
    }

    public function createWfAssignment($assignment_code,$description,$sequence,$assignstatus,$modulename,$codetransaction,$origperson,$origpersonid,$assignperson,$assignpersonid,$ownertrxid,$processid,$assignment_id,$link){
        //ini yang DOA kosong
//        Wfassignment::create([
//            'assignment_code' => $assignmentcode,
//            'description' => $objectAssignmentDetailMin->assignment_description,
//            'sequence' => $wfprocess->sequencenow,
//            'assignstatus' => 'ACTIVE',
//            'modulename' => 'APPLICANT',
//            'origperson' => $objectAssignmentDetailMin->assignmeto,
//            'origpersonid' => $objectAssignmentDetailMin->assignmetoid,
//            'assignperson' => $objectAssignmentDetailMin->assignmeto,
//            'assignpersonid' => $objectAssignmentDetailMin->assignmetoid,
//            'ownertrxid' => $wfprocess->ownertrxid,
//            'processid' => $wfprocess->id,
//        ]);

        //ini yang doa ada
//        Wfassignment::create([
//            'assignment_code' => $assignmentcode,
//            'description' => $objectAssignmentDetailMin->assignment_description,
//            'sequence' => $wfprocess->sequencenow,
//            'assignstatus' => 'ACTIVE',
//            'modulename' => 'APPLICANT',
//            'origperson' => $objectAssignmentDetailMin->assignmeto,
//            'origpersonid' => $objectAssignmentDetailMin->assignmetoid,
//            'assignperson' => $objectAssignmentDetailMin->delegateto,
//            'assignpersonid' => $objectAssignmentDetailMin->delegatetoid,
//            'ownertrxid' => $wfprocess->ownertrxid,
//            'processid' => $wfprocess->id,
//        ]);

        $wfassignment = Wfassignment::create([
            'assignment_code' => $assignment_code,
            'description' => $description,
            'sequence' => $sequence,
            'assignstatus' => $assignstatus,
            'modulename' => $modulename,
            'codetransaction' => $codetransaction,
            'origperson' => $origperson,
            'origpersonid' => $origpersonid,
            'assignperson' => $assignperson,
            'assignpersonid' => $assignpersonid,
            'ownertrxid' => $ownertrxid,
            'processid' => $processid,
            'assignment_id' => $assignment_id,
            'link' => $link,
        ]);

        return $wfassignment;
    }

}
