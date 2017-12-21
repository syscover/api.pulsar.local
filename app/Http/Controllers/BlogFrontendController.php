<?php namespace App\Http\Controllers;

use Carbon\Carbon;
use Syscover\Cms\Models\Article;
use Syscover\Cms\Models\Category;
use Syscover\Review\Models\Review;

/**
 * Class BlogFrontendController
 * @package App\Http\Controllers
 */

class BlogFrontendController extends Controller
{
    public function getBlog()
    {
        $articles = Article::builder()
            ->where('publish', '<', Carbon::now()->toDateTimeString()) // filter only publish article
            ->where('lang_id', user_lang())
            ->get()
            ->load('attachments');

        // set language for Carbon
        Carbon::setLocale(user_lang());

        return view('web.content.blog.blog', ['articles' => $articles]);
    }

    public function getPost($slug)
    {
        $article = Article::builder()
            ->where('publish', '<', Carbon::now()->toDateTimeString()) // filter only publish article
            ->where('lang_id', user_lang())
            ->where('slug', $slug)
            ->first();

        // manage 404
        if($article === null) abort(404);

        // set language for Carbon
        Carbon::setLocale(user_lang());

        return view('web.content.blog.post', ['article' => $article]);
    }
}