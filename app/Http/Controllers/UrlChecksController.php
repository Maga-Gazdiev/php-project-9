<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use DiDom\Document;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class UrlChecksController extends Controller
{
    public function store(int $id): RedirectResponse
    {
        try {
            $url = $this->getUrlName($id);
            $response = Http::get($url);
            $document = new Document($response->body());

            $checkData = [
                'url_id' => $id,
                'status_code' => $response->status(),
                'h1' => optional($document->first('h1'))->text(),
                'title' => optional($document->first('title'))->text(),
                'description' => optional($document->first('meta[name=description]'))->getAttribute('content'),
                'created_at' => Carbon::now(),
            ];
            DB::table('url_checks')->insert($checkData);

            flash('Страница успешно проверена')->success();
        } catch (Exception $exception) {
            flash($exception->getMessage())->error();
        }
        return redirect()->route('urls.show', $id);
    }

    private function getUrlName(int $id): string
    {
        $url = DB::table('urls')->find($id);
        abort_unless($url, 404);

        return $url->name;
    }
}