<?php

namespace App\Http\Controllers;

session_start();

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
    const FLASH = 'FLASH_MESSAGES';
    const FLASH_ERROR = 'error';
    const FLASH_INFO = 'info';

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
        $this->validate($request, [
            'url.name' => 'required|max:255|min:4'
        ]);
        $name = $request->input('url.name');

        if (Url::where('name', $name)->exists()) {
            $_SESSION['status'] = 'Страница уже существует';
            return redirect()->route('urls.show');
        } else {

            $url = new Url();
            $url->name = $name;
            $url->save();
            
            $_SESSION['status'] = 'Страница успешно добавлена';
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

        $_SESSION['status'] = 'Страница успешно проверена';
        return redirect()->route('urls.show', ['id' => $id]);
    }
}
