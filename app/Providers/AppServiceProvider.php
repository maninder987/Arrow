<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Post;
use App\Comments;
use Illuminate\Support\Facades\Auth;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      Schema::defaultStringLength(191);
      //$comments = Comments::where("approve","=","false")->get();
      //$comments = Comments::where('user_id','=',Auth::id())
                          //->where('approve','=','false','AND')->get();
                          
      $recentPosts = Post::orderBy('id', 'desc')->take(5)->get();
      view()->share('recentPosts',$recentPosts);
      // view()->share('commentsNotification',$comments);
      view()->composer('*', function($view)
      {
          if (Auth::check()) {
            $comments =Comments::where('user_id','=',Auth::user()->id)
                               ->where('approve','=','false')->get();
              $view->with('commentsNotification', $comments);
          }else {
              $view->with('commentsNotification', null);
          }
      });
       
    }
}
