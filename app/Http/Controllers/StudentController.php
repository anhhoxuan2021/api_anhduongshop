<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;


use App\Models\Student;

class StudentController extends Controller
{
    public function getStudents(){

        //$stuent = Student::where('JSON_EXTRACT(subject_mark, "$.sub_id")' > 400)->get();
        $val = 1;
        $wh =' JSON_EXTRACT(subject_mark, "$[0].sub_id")>'.$val;
        $stuent = DB::table('students')
          //  ->whereRaw('JSON_EXTRACT(subject_mark, "$.sub_id")' > 400)->toSql();

        ->whereRaw($wh)//->toSql();
            ->get();
//        $products =  DB::table('students')
//            ->whereJsonContains('subject_mark', [['sub_id' => 5]])
//            ->get();

        //        $products =  DB::table('students')
//            ->whereRaw('subject_mark' @? '$.sub_id ? (@ > 5)')
//            ->get();

        $rsl = [];
        $rsl['data']=$stuent;
        return response()->json($rsl);
    }
}
