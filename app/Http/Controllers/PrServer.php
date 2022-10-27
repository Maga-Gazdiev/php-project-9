<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UrlController extends Controller
{
    public function index(): View
    {
        $urls = DB::table('urls')->orderBy('id')->paginate(10);

        $checksUrl = DB::table('url_checks')
            ->orderBy('url_id')
            ->latest()
            ->distinct('url_id')
            ->get()
            ->keyBy('url_id');

        return view('urls.index', compact('urls', 'checksUrl'));
    }


    public function store(Request $request): RedirectResponse
    {
        $validated = Validator::make($request->all(), [
            'url.name' => 'url|required|max:255',
        ]);
        if ($validated->fails()) {
            flash('Некорректный URL')->error();
            return redirect()->route('main')->withErrors($validated);
        }

        $nameUrl = $request['url.name'];
        $normalizedUrl = $this->normalizeUrl($nameUrl);

        $id = DB::table('urls')
            ->where('name', $normalizedUrl)
            ->value('id');

        if ($id) {
            flash('Страница уже существует')->success();
        } else {
            $id = DB::table('urls')->insertGetId([
                'name' => $normalizedUrl,
                'created_at' => Carbon::now(),
            ]);

            flash('Страница успешно добавлена')->success();
        }
        return redirect()->route('urls.show', $id);
    }

    private function normalizeUrl(string $nameUrl): string
    {
        $nameUrl = mb_strtolower($nameUrl);

        $scheme = parse_url($nameUrl, PHP_URL_SCHEME);
        $host = parse_url($nameUrl, PHP_URL_HOST);

        return "{$scheme}://{$host}";
    }

    public function show(int $id): View
    {
        $url = DB::table('urls')->find($id);
        abort_unless($url, 404);

        $checksUrl = DB::table('url_checks')
            ->where('url_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('urls.show', compact('url', 'checksUrl'));
    }
}