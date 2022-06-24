<?php

namespace App\Http\Controllers;

use App\Models\Url;
use App\Models\UrlChecks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $urls = Url::paginate(15);
        $checks = UrlChecks::get()->keyBy('url_id');

        return view('urls.index', compact('urls', 'checks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:urls'
        ], [
            'name.required' => 'Ссылка не указана',
            'name.unique' => 'Некорректный URL1',
            'name.max' => 'Некорректный URL'
        ]);

        $newUrl = new Url();
        
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);

        } elseif (filter_var($request->name, FILTER_VALIDATE_URL)) {
            $url = parse_url($request->name, PHP_URL_SCHEME) . '://' . parse_url($request->name, PHP_URL_HOST) . '/';
            $newUrl->name = $url;
            $newUrl->save();
            return redirect()->route('urls.show', $newUrl->id)->withErrors('Ссылка успешно добавлена');
        }
        return redirect()
            ->back()
            ->withErrors('Cсылка не корректна!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Url  $url
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $url = Url::findOrFail($id);
        $checks = UrlChecks::where('url_id', $id)->get();
        return view('urls.show', compact('url', 'checks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Url  $url
     * @return \Illuminate\Http\Response
     */
    public function edit(Url $url)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Url  $url
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Url $url)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Url  $url
     * @return \Illuminate\Http\Response
     */
    public function destroy(Url $url)
    {
        //
    }
}
