<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function showUsers()
    {
        $users = DB::table('users')
            // ->where('age','>',21)
            // ->where('city','like',['%North%'])
            // ->where('name','like','%S%')
            // ->where('age','>','20')
            // ->where('city','=','North Ervin')
            // ->where([
                //     ['age', '>', 20],
                //     ['city', 'like', ['%North%']]
                // ])
                // ->where('city','=','North')
                // ->orWhere('age','>',18)
                // ->whereBetween('id',[3,6])
                // ->whereNotBetween('age',[18,25])
                // ->orWhereNotBetween('age',[18,25])
                // ->whereIn('id',[1,7,5])
                // ->whereNotIn('id',[1,7,5])
                // ->whereNull('email')
                // ->whereNotNull('email')
                // ->whereDate('created_at','2024-07-8')
                // ->whereMonth('created_at','5')
                // ->whereDay('created_at','9')
                // ->whereYear('created_at','2022')
                // ->whereTime('created_at','16:45:12')
                // ->orderBy('age','desc')
                // ->orderBy('name','desc')
                // ->first()
                // ->limit(3)
                // ->offset(6)
                // ->take(4)
                // ->skip(5)
            // ->avg('age');
            // ->sum('age');
            // ->min('age');
            // ->max('age');
            // ->get();
            // ->where('city','Lake Moiseshaven')
            // ->orderBy('name') 
            ->paginate(perPage:3,columns:['*'],pageName:'p');
            // ->cursorPaginate(5);
        return view('allusers', ['data' => $users]);
        // return $users;
    }

    public function singleUser(string $id)
    {
        $user = DB::table('users')->where('id', $id)->get();
        return view('user', ['data' => $user]);
    }

    function addUser(Request $request){
        $user = DB::table('users')->insert(
           
            [
                'name'=>$request->username,
                'email'=>$request->useremail,
                'age'=>$request->userage,
                'city'=>$request->usercity,
               
            ]
           
        );
      if($user){

          return redirect()->route('home');
      }else{
        echo "<h1>Data Not added</h1>";
      }
    }

   public function updateUser(Request $request, string $id)  {
      $user = DB::table('users')->where('id',$id)->update(
        [
            'name'=>$request->username,
            'email'=>$request->useremail,
            'age'=>$request->userage,
            'city'=>$request->usercity,
           
        ]
      );
      
     if($user){
        return redirect()->route('home');
        }else{
            echo 'Data not Updated';
        }
    }
   public function deleteUser(string $id)  {
      $user = DB::table('users')->where('id',$id)->delete();
      if($user){
        return redirect()->route('home');
      }
    
    }
   public function updateView(string $id)  {
      $user = DB::table('users')->where('id',$id)->first();
      if($user){
        return view('updateuser', compact('user'));
      }
    
    }
}
