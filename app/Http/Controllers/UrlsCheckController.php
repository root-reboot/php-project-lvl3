<?php

namespace App\Http\Controllers;

use App\Models\UrlChecks;
use App\Models\Url;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
        
        $check = new UrlChecks();
        $check->url_id = $id;
        $check->created_at = Carbon::now();
        $check->save();
        return redirect()
            ->back()
            ->withErrors('Страница успешно проверена');
    }
}
