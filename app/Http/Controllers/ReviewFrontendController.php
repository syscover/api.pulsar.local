<?php namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Notification;
use Syscover\Market\Models\Product;
use Syscover\Review\Models\Poll;
use Syscover\Review\Models\Review;
use Syscover\Review\Notifications\Review as ReviewNotification;

/**
 * Class ReviewFrontendController
 * @package App\Http\Controllers
 */

class ReviewFrontendController extends Controller
{
    public function createReview(Request $request)
    {
        // get parameters from url route
        $parameters = $request->route()->parameters();

        $product = Product::builder()
            ->where('market_product_lang.lang_id', user_lang())
            ->where('market_product_lang.slug', $parameters['slug'])
            ->where('market_product.active', true)
            ->first();

        if(auth('crm')->check())
        {
            $pollId = 1;

            $poll       = Poll::find($pollId);
            $customer   = auth('crm')->user();
            $now        = new Carbon(config('app.timezone'));

            $review = Review::create([
                'date'              => $now->toDateTimeString(),
                'poll_id'           => $pollId,
                'object_id'         => $product->id,
                'object_type'       => Product::class,
                'object_name'       => $product->name,
                'customer_id'       => $customer->id,
                'customer_name'     => $customer->name,
                'customer_email'    => $customer->email,
                'customer_verified' => true,
                'email_subject'     => 'EMAL REVIEW',
                'mailing'           => $now->addDays($poll->mailing_days)->toDateTimeString(),
                'expiration'        => $now->addDays($poll->expiration_days)->toDateTimeString(),
            ]);

            Notification::route('mail', 'cpalacin@digitalh2.com')
                ->notify(new ReviewNotification($review));
        }
        else
        {
            dd('to try you must loged');
        }

        return redirect()->route('getProducts-' . user_lang());
    }

    public function showReview(Request $request)
    {
        // get parameters from url route
        $parameters = $request->route()->parameters();

        $response['review'] = Review::find(Crypt::decryptString($parameters['slug']));
        //$response['review'] = Review::where('id', Crypt::decryptString($parameters['slug']))->where('completed', false)->first();

        if(! $response['review']) abort(404);

        return view('web.content.review', $response);
    }
}