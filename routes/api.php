<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Upcoming;
use App\Models\Today;
use App\Http\Resources\UpcomingResource;
use App\Http\Resources\TodayTaskResource;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
     return $request->user();
});

Route::get('/dailytask', function () {
$task = Today::all();
return TodayTaskResource::collection($task);
});


Route::get('/upcoming',function(){
    $upcoming = Upcoming::all();
    return UpcomingResource::collection($upcoming);
});

Route::post('/upcoming',function( Request $request){

    return Upcoming::create(
         [

            'title'=>$request->title,

            'waiting'=>$request->waiting,

            'taskId'=>$request->taskId,
        ]


         );
});

Route::delete('/upcoming/{taskId}',function($taskId){

    DB::table('upcomings')->where('taskId',$taskId)->delete();
    return 204;
});


Route::delete('/dailytask/{taskId}',function($taskId){

    DB::table('todays')->where('taskId',$taskId)->delete();
    return 204;
});
//dailttask

Route::post('/dailytask',function( Request $request){
  return Today::create(
         [

            'id'=>$request->id,

            'title'=>$request->title,

            'taskId'=>$request->taskId,
        ]


         );
});

Route::delete('/dailytask{taskId}',function($taskId){

    DB::table('todays')->where('taskId',$taskId)->delete();
    return 204;
});
