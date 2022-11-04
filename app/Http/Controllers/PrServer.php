<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use DiDom\Document;
use Carbon\Carbon;
use Exception;


class PrServer extends Controller
{ 
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'url.name' => 'url|required|max:255',
        ]);

        $Url = $request->input('url.name');

        if ($validated->fails() && substr($Url, 0, 8) !== "https://" && !empty($Url) || $validated->fails() && substr($Url, 0, 7) !== "http://" && !empty($Url)) {
            return response()->view('errorWelcome', compact('Url'), 422)->header('X-Header-Two', 'Header Value');
        } if(empty($Url)){
            return response()->view('emptyInput', compact('Url'), 422)->header('X-Header-Two', 'Header Value');;
        } else {  
        $getNormalUrl = function($Url)
        {
          $nameUrl = mb_strtolower($Url);
          $scheme = parse_url($nameUrl, PHP_URL_SCHEME);
          $host = parse_url($nameUrl, PHP_URL_HOST);
          $name = "{$scheme}://{$host}";
          return $name;
        };
        
        $name = $getNormalUrl($Url);
      
        $id = DB::table('urls')->where('name', $name)->value('id');
          
        if ($id) {
            flash('Страница уже существует');
            return redirect()->route('urls.show', $id);
        } 
        DB::table('urls')->insert([
            'name' => $name,
            'created_at' => Carbon::now('MSK'),
        ]);
        flash('Страница успешно добавлена')->success();
        $id = DB::table('urls')->where('name', $name)->value('id');
        return redirect()->route('urls.show', $id);
        }
    }  

    public function checks(Request $request, int $id)
    {   
        $users = DB::table('urls')->find($id);
        
        try {
            $response = Http::get($users->name);
        } catch (\Exception $e) {
            flash('Произошла ошибка при проверке')->error();
            return redirect()->route('urls.show', ['id' => $id]);
        }
        
        $body = $response->body();
        $document = new Document($body);
        $h1 = optional($document->first('h1'))->text();
        $title = optional($document->first('title'))->text();
        $description = optional($document->first('meta[name=description]'))->attr('content');

        DB::table('url_checks')->insert([
        'url_id' => $id,
        'status_code' => $response->status(),
        'h1' => $h1,
        'title' => $title,
        'description' => $description,
        'created_at' => Carbon::now('MSK'),
        ]);

        flash('Страница успешно проверена')->success();
        return redirect()->route('urls.show', $id);
    }  

    public function index()
    {
       $users = DB::table('urls')->get();
       $all = DB::table('url_checks')->get()->keyBy('url_id');
       return view('index', compact('users', 'all'));
    }  

    public function show(int $id)
    {
        $users = DB::table('urls')->find($id);
        $all = DB::table('url_checks')->where('url_id', $id)->get();
        return view('show', compact('users', 'all'));
    }
}