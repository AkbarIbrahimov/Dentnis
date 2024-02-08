<?php

namespace App\Http\Controllers\Admin\Quotes;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogTranslation;
use App\Models\Language;
use App\Models\Quotes;
use App\Models\QuotesTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QuoteController extends Controller
{
    public function quotes()
    {
        $quotes = Quotes::with('translations', 'languages')->get();
        $languages = Language::query()->get();
        return view('Admin/pages/quotes/index',compact('quotes','languages'));
    }
    public function showQuoteCreate()
    {
        $quotes = Quotes::with('translations', 'languages')->get();
        return view('Admin/pages/quotes/create',compact('quotes'));
    }

    public function quoteCreate(Request $request)
    {
        $defaultLanguage = config('app.locale');

        $request->validate([
            "$defaultLanguage.title" => 'required|string|max:255',
            "$defaultLanguage.description" => 'required|string',
            'itemImg' => 'required|image',
            'status' => 'required|string',
        ]);

        $defaultTitle = $request->input("$defaultLanguage.title");
        $defaultDescription = $request->input("$defaultLanguage.description");

        $quote = new Quotes();
        if ($request->hasFile('itemImg')) {
            $imagePath = Storage::disk('public')->putFile("quotes", $request->file('itemImg'));
            $quote->image = $imagePath;
        }
        $quote->status = $request->input('status');
        $quote->save();

        $defaultLanguageModel = Language::where('lang', $defaultLanguage)->first();
        $defaultLangId = $defaultLanguageModel->id;
        QuotesTranslation::create([
            'quote_id' => $quote->id,
            'language_id' => $defaultLangId,
            'title' => $defaultTitle,
            'description' => $defaultDescription,
        ]);

        foreach (config('app.languages') as $lang) {
            if ($lang != $defaultLanguage) {
                $title = $request->input("$lang.title");
                $description = $request->input("$lang.description");

                if (!empty($title) || !empty($description)) {
                    $request->validate([
                        "$lang.title" => 'string|max:255',
                        "$lang.description" => 'string',
                    ]);

                    $languageModel = Language::where('lang', $lang)->first();
                    $langId = $languageModel->id;

                    QuotesTranslation::create([
                        'quote_id' => $quote->id,
                        'language_id' => $langId,
                        'title' => $title,
                        'description' => $description,
                    ]);
                }
            }
        }

        return redirect()->route('admin.quotes')->with('success', 'Quote created successfully');
    }

    public function quoteDelete($id)
    {
        $quoteTranslations = QuotesTranslation::where('quote_id', $id)->get();
        $quote = Quotes::find($id);

        if ($quote && $quoteTranslations) {
            Storage::delete($quote->image);
            foreach ($quoteTranslations as $translation) {
                $translation->delete();
            }
            $quote->delete();

            return redirect()->route('admin.quotes')->with('success', 'Quote successfully deleted.');
        } else {
            return redirect()->route('admin.quotes')->with('error', 'Quote not found.');
        }
    }

    public function quoteEditView($id)
    {
        $quotes=Quotes::findOrFail($id);
        return view('Admin/pages/quotes/edit',compact('quotes'));
    }

    public function quoteUpdate(Request $request,$id)
    {
        $defaultLanguage = config('app.locale');

        $request->validate([
            "$defaultLanguage.title" => 'required|string|max:255',
            "$defaultLanguage.description" => 'required|string',
            'itemImg' => 'nullable|image',
        ]);

        $quote = Quotes::findOrFail($id);
        if ($request->hasFile('itemImg')) {
            if ($quote->image) {
                Storage::delete($quote->image);
            }
            $imagePath = Storage::disk('public')->putFile("quotes", $request->file('itemImg'));
            $quote->image = $imagePath;
        }

        $quote->status = $request->input('status');
        $quote->save();

        $defaultLanguageModel = Language::where('lang', $defaultLanguage)->firstOrFail();
        $defaultLangId = $defaultLanguageModel->id;
        $title = $request->input("$defaultLanguage.title");
        $description = $request->input("$defaultLanguage.description");
        $quoteTranslation = QuotesTranslation::updateOrCreate(
            ['quote_id' => $quote->id, 'language_id' => $defaultLangId],
            ['title' => $title, 'description' => $description]
        );

        foreach (config('app.languages') as $lang) {
            if ($lang != $defaultLanguage) {
                $title = $request->input("$lang.title");
                $description = $request->input("$lang.description");

                if (!empty($title) || !empty($description)) {
                    $languageModel = Language::where('lang', $lang)->firstOrFail();
                    $langId = $languageModel->id;

                    QuotesTranslation::updateOrCreate(
                        ['quote_id' => $quote->id, 'language_id' => $langId],
                        ['title' => $title, 'description' => $description]
                    );
                } else {
                    $languageModel = Language::where('lang', $lang)->firstOrFail();

                    $langId = $languageModel->id;

                    QuotesTranslation::where('quote_id', $quote->id)
                        ->where('language_id', $langId)
                        ->delete();
                }
            }
        }

        return redirect()->route('admin.quotes')->with('success', 'Quotes updated successfully');

    }
}
