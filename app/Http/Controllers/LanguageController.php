<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    private $validation = [
        'name' => 'required|string|max:255',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $languages = Language::paginate(10);
        return view('languages.index', ['languages' => $languages, 'headerText' => __('general.languages')]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('languages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate($this->validation);

        $language = new Language();
        $language->name = $request->input('name');
        $language->save();

        return redirect()->route('language.index')->with('success', __('languages.created-new-successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Language $language)
    {
        return view('languages.show', ['language' => $language]);
    }

    /**
     * Show the form for editing the user's language preference.
     */
    public function edit()
    {
        $languages = [
            'de' => 'Deutsch',
            'en' => 'English',
            'fr' => 'Français',
            'es' => 'Español',
        ];
        return view('settings.language', ['languages' => $languages]);
    }

    /**
     * Update the user's language preference.
     */
    public function update(Request $request)
    {
        $request->validate([
            'native_language' => 'required|string|in:de,en,fr,es',
        ]);

        $user = $request->user();
        $user->native_language = $request->input('native_language');
        $user->save();

        // Sprache in Session speichern
        $request->session()->put('locale', $request->input('native_language'));

        return redirect()->back()->with('success', __('settings.language-updated-successfully'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editLanguage(Language $language)
    {
        return view('languages.edit', compact('language'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateLanguage(Request $request, Language $language)
    {
        $request->validate($this->validation);

        $language->update([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('language.index')->with('success', __('languages.updated-successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Language $language)
    {
        $language->delete();
        return redirect()->route('language.index')->with('success', 'Language deleted successfully');
    }
}
