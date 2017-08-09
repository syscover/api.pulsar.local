<?php namespace App\Http\Controllers;

use Carbon\Carbon;
use Syscover\Cms\Models\Article;

/**
 * Class BlogFrontendController
 * @package App\Http\Controllers
 */

class BlogFrontendController extends Controller
{
    public function getBlog()
    {
        $articles = Article::builder()
            ->where('publish', '<', date('Y-m-d H-i-s')) // filter only publish article
            ->where('lang_id', user_lang()) // filter only publish article
            ->get()
            ->load('attachments');

        // set language for Carbon
        Carbon::setLocale(user_lang());

        return view('web.content.blog', ['articles' => $articles]);
    }

    public function getArticle($slug)
    {
        $article = Article::builder()
            ->where('publish', '<', date('Y-m-d H-i-s')) // filter only publish article
            ->where('lang_id', user_lang()) // filter only publish article
            ->where('slug', $slug)
            ->first()
            ->load('attachments');

        // manage 404
        if($article === null) abort(404);

        // set language for Carbon
        Carbon::setLocale(user_lang());

        return view('web.content.article', ['article' => $article]);
    }
}