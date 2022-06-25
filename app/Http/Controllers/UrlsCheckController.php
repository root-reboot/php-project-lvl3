<?php

namespace App\Http\Controllers;

use App\Models\UrlChecks;
use App\Models\Url;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use DiDom\Document;
use DiDom\Query;

class UrlsCheckController extends Controller
{
    public function check($id)
    {
        $url = Url::find($id);
        if(!$url) {
            return redirect()
                ->back()
                ->withErrors('Ошибка! Как вы сюда попали?');
        }

        try {
            $response = Http::get($url->name);
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors($e->getMessage());
        }

        $document = new Document($response->body());
        $title = $document->has('title') ? $document->first('title')->text() : null;
        $h1 = $document->has('h1') ? $document->first('h1')->text() : null;
        $description = $document->has('meta[name="description"]') 
        ? $document->first('meta[name="description"]')->getAttribute('content') : null;

        $check = new UrlChecks();
        $check->url_id = $id;
        $check->status_code = $response->status();
        $check->title = Str::limit($title, 30);
        $check->description = Str::limit($description, 30);
        $check->h1 = Str::limit($h1, 10);
        $check->created_at = Carbon::now();
        $check->save();
        return redirect()
            ->back()
            ->withErrors('Страница успешно проверена');
    }
}
