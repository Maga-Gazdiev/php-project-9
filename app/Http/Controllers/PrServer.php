<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use App\Models\Url;
use App\Models\UrlCheck;
use Illuminate\Support\Facades\Http;
use DiDom\Document;
use Carbon\Carbon;
use Exception;

class PrServer extends Controller
{
    use RefreshDatabase;

    public function home()
    {
        return view('home');
    }

    public function index()
    {
        $urls = new Url();
        return view('index', compact('urls'));
    }

    public function store(Request $request)
    {
        session_start();
        $this->validate($request, [
            'url.name' => 'required|max:255|min:4'
        ]);
        $name = $request->input('url.name');

        if (Url::where('name', $name)->exists()) {
            $_SESSION['flash'] = 'Страница уже существует';
            return redirect()->route('urls.show');
        } else {

            $url = new Url();
            $url->name = $name;
            $url->save();


	        $_SESSION['flash'] = 'Страница успешно добавлена';
            //header('Location: index.php');
            return redirect()->route('urls.show');
        }
    }

    public function show(string $id)
    {
        $url = Url::findOrFail($id);
        return view('show', compact('url'));
    }

    public function checks(Request $request, string $id)
    {
        $urls = Url::findOrFail($id);
        try {
            $response = Http::get($urls->name);
        } catch (\Exception $e) {
            flash($e->getMessage())->error();
            return redirect()->route('urls.show', ['id' => $id]);
        }
        $response_body = $response->body();
        $status = $response->status();
        $document = new Document($response_body);
        //optional - helper laravel, Если переданный объект имеет значение null, свойства и методы будут возвращать также null вместо вызова ошибки
        $h1 = optional($document->first('h1'))->text();
        $title = optional($document->first('title'))->text();
        $description = optional($document->first('meta[name=description]'))->attr('content');

        $url = new UrlCheck();

        $url->url_id = $id;
        $url->status_code = $status;
        $url->h1 = $h1;
        $url->title = $title;
        $url->description = $description;
        $url->save();

        $_SESSION['flash'] = 'Страница успешно проверена';
        return redirect()->route('urls.show', ['id' => $id]);
    }
}
