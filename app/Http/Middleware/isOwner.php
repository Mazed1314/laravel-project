<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Session;

use App\Http\Traits\ResponseTrait;
class isOwner
{
    use ResponseTrait;
    public function handle(Request $request, Closure $next)
    {
        if(!Session::has('userId')|| Session::has('userId')==null || !Session::has('roleIdentity')){
            return redirect()->route('logOut');
        }else{
            $user=User::findOrFail(currentUserId());
            app()->setLocale($user->language);
            if(!$user){
                return redirect()->route('logOut');
            }else if(currentUser() != 'owner'){
                return redirect()->back()->with($this->resMessageHtml(false,'error','Access denied'));
            }else{
                return $next($request);
            }
        }return redirect()->rout('logOut');
    }
}
