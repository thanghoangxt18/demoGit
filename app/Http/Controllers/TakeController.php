<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Take;
use phpDocumentor\Reflection\Types\Collection;

class TakeController extends Controller
{
    function getTakeList(Request $request)
    {
        $organization = $request->get('organization');
        $pagingIndex = $request->get('index');
        $type = $request->get('type');
        $ts = 0;
        if ($type == 'lastDay') {
            $ts = strtotime("-1 day");
        } else if ($type == 'lastWeek') {
            $ts = strtotime("-1 week");
        } else if ($type == 'lastMonth') {
            $ts = strtotime("-1 month");
        }

        try {
            $takeList = Take::raw(function ($collection) use ($ts,$pagingIndex, $organization) {
                return $collection->aggregate(array(
                        array('$lookup' => array(
                            'from' => 'exam_round',
                            'localField' => 'exam_round_iid',
                            'foreignField' => 'iid',
                            'as' => '_exam_round'
                        )
                        ),
                        array(
                            '$unwind' => '$_exam_round'
                        ),
                        array('$lookup' => array(
                            'from' => 'contest',
                            'localField' => 'contest_iid',
                            'foreignField' => 'iid',
                            'as' => '_contest'
                        )
                        ),
                        array(
                            '$unwind' => '$_contest'
                        ),
                        array(
                            '$match' => array(
                                'ts' => array(
                                    '$gt' => 1585703857
                                )
//                        ,
//                            '_contest.organization'=>419516
                            )
                        ),
                        array(
                            '$skip' => 0  //($paging-1)*200
                        ),
                        array(
                            '$limit' => 200
                        )
                    )
                );
            }
            );
        } catch (\Exception $ex) {
            return array('Success' => 'false',
                'message' => "Error:" . $ex->getMessage());
        }

        return array('Success' => 'true',
            'message' => "Load data successfully",
            $takeList);
    }
}
