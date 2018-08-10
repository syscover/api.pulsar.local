<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

// CRM
use Syscover\Admin\Models\Country;
use Syscover\Crm\Models\CustomerGroup;
use Syscover\Crm\Services\AddressService;
use Syscover\Crm\Services\CustomerService;


/**
 * Class CustomerFrontendController
 * @package App\Http\Controllers
 */

class CustomerFrontendController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = 'web.account-';

    /**
     * Route to get login form
     *
     * @var string
     */
    protected $loginPath = 'web.get_login-';

    /**
     * Redirect route after logout
     *
     * @var string
     */
    protected $logoutPath = 'web.home-';

    /**
     * Here you can customize your guard, this guard has to set in auth.php config
     *
     * @var string
     */
    protected $guard;

    /**
     * Show login view
     */
    public function getLogin()
    {
        $response = [];
        return view('web.content.customer.login', $response);
    }

    /**
     * Show sing in view
     */
    public function getSingIn()
    {
        // get customer groups
        $response['groups'] = CustomerGroup::builder()->get();

        return view('web.content.customer.sing_in', $response);
    }

    /**
     * Show reset password form
     */
    public function resetPassword(Request $request)
    {
        return view('web.content.customer.passwords.email');
    }

    /**
     * Show account view
     */
    public function account(Request $request)
    {
            $response['countries']  = Country::builder()->where('lang_id', user_lang())->get();
        $response['groups']     = CustomerGroup::builder()->get();
        $response['customer']   = auth('crm')->user();

        return view('web.content.customer.account', $response);
    }




    /**
     * Create customer in CRM module and login customer created
     */
    public function createCustomer(Request $request)
    {
        // validation
        $validator = Validator::make($request->all(), [
            'name'      => 'required|max:255',
            'surname'   => 'required|max:255',
            'email'     => 'required|max:255|email|unique:crm_customer,email',
            'password'  => 'required|between:4,15|same:re_password',
        ]);

        // manage fails
        if ($validator->fails())
        {
            if($request->input('responseType') == 'json')
            {
                return response()->json([
                    'status'    => 'error',
                    'errors'    => $validator->messages()
                ], 422);
            }
            else
            {
                return redirect()
                    ->route('web.get_sing_in-' . user_lang())
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        // create new customer
        $customer = CustomerService::create($request->all());

        // auth the customer created
        Auth::guard('crm')->login($customer);

        if($request->input('responseType') == 'json')
        {
            return response()->json([
                'status'    => 'success',
                'customer'  => auth('crm')->user()
            ], 200);
        }
        else
        {
            // show message
            $request->session()->flash('successMessage', [
                'value'     => true,
                'message'   => '<strong>New customer</strong> has been saved.'
            ]);

            return redirect()->route('web.account-' . user_lang());
        }
    }

    /**
     * Update customer in CRM module and login customer updated
     */
    public function updateCustomer()
    {
        $rules   = [
            'name'      => 'required|max:255',
            'surname'   => 'required|max:255',
            'email'     => 'required|max:255|email|unique:customer,email',
            'password'  => 'required|between:4,15|same:repassword',
        ];

        if(request('email') === auth('crm')->user()->email)
            $rules['email'] = 'required|max:255|email';

        if(! request('password'))
            $rules['password'] = '';

        // manual validate
        $validator = Validator::make(request()->all(), $rules);

        // manage fails
        if ($validator->fails())
        {
            if(request('responseType') == 'json')
            {
                return response()->json([
                    'status'    => 'error',
                    'errors'    => $validator->messages()
                ], 422);
            }
            else
            {
                return redirect()
                    ->route('web.account-' . user_lang())
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        // update customer
        $customer = CustomerService::update(request()->all(), request('id'));

        // update password
        if(request('password'))
            CustomerService::updatePassword(request()->all());

        // auth the customer created
        Auth::guard('crm')->login($customer);

        if(request('responseType') == 'json')
        {
            return response()->json([
                'status'    => 'success',
                'customer'  => auth('crm')->user()
            ]);
        }
        else
        {
            // show message
            session()->flash('successMessage', [
                'value'     => true,
                'message'   => '<strong>Customer</strong> has been updated.'
            ]);

            return redirect()->route('web.account-' . user_lang());
        }
    }

    /**
     * Create customer address
     */
    public function postAddress()
    {
        AddressService::create(request()->all());
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'user'      => 'required',
            'password'  => 'required',
        ]);

        // set $credentials
        $credentials = [
            'user' => $request->input('user'),
            'password' => $request->input('password')
        ];

        if (auth('crm')->attempt($credentials, $request->has('remember'))) {

            // check if customer is active
            if (! auth('crm')->user()->active)
            {
                auth('crm')->logout();

                // error user inactive
                if ($request->input('responseType') == 'json')
                {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'User inactive'
                    ], 401);
                }
                else
                {
                    return redirect()
                        ->route($this->loginPath . user_lang())
                        ->withErrors([
                            'message' => 'User inactive'
                        ])
                        ->withInput();
                }
            }

            // authentication successful!
            if ($request->input('responseType') == 'json')
            {
                return response()->json([
                    'status'    => 'success',
                    'customer'  => auth('crm')->user()
                ], 200);
            }
            else
            {
                return redirect()
                    ->intended(route($this->redirectTo . user_lang()));
            }
        }

        // error authentication!
        if($request->input('responseType') == 'json')
        {
            return response()->json([
                'status'    => 'error',
                'message'   => 'User or password incorrect'
            ], 401);
        }
        else
        {
            return redirect()
                ->route($this->loginPath . user_lang())
                ->withErrors([
                    'message' => 'User or password incorrect'
                ])
                ->withInput();
        }
    }

    /**
     * Logout user and load default tax rules.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        auth('crm')->logout();

        return redirect()
            ->route($this->logoutPath . user_lang());
    }




}