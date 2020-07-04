<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Repositories\UserRepositoryInterface;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{

    protected $user;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(UserRepositoryInterface $user)
    {
//        $this->middleware('jwt.auth', ['except' => ['login','signup']]);
        $this->user = $user;
        Auth::shouldUse('api');
    }

    /**
     * List all users.
     *
     * @return mixed
     */

    public function getUsers(){
        $data = $this->user->all();
        return UserResource::collection($data);
    }


    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);
        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken($token);
    }

    public function signup(Request $request) {
        User::create($request->all());
        return $this->login($request);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function me()
    {
        $user = \auth()->user();
//        return mainResponse(true, __('ok'), $user, [], 200);
        return new UserResource($user);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => \auth()->user()->name
        ]);
    }

    public function index() {
        return response()->json('Index User');
    }

    function mainResponse ($status, $msg, $items, $validator, $code = 200, $pages = null)
    {
        if (isset(json_decode(json_encode($items, true), true)['data'])) {
            $pagination = json_decode(json_encode($items, true), true);
            $items = $pagination['data'];
            $pages = [
                "current_page" => $pagination['current_page'],
                "first_page_url" => $pagination['first_page_url'],
                "from" => $pagination['from'],
                "last_page" => $pagination['last_page'],
                "last_page_url" => $pagination['last_page_url'],
                "next_page_url" => $pagination['next_page_url'],
                "path" => $pagination['path'],
                "per_page" => $pagination['per_page'],
                "prev_page_url" => $pagination['prev_page_url'],
                "to" => $pagination['to'],
                "total" => $pagination['total'],
            ];
        } else {
            $pages = [
                "current_page" => 0,
                "first_page_url" => '',
                "from" => 0,
                "last_page" => 0,
                "last_page_url" => '',
                "next_page_url" => null,
                "path" => '',
                "per_page" => 0,
                "prev_page_url" => null,
                "to" => 0,
                "total" => 0,
            ];
        }

        $aryErrors = [];
        foreach ($validator as $key => $value) {
            $aryErrors[] = ['field_name' => $key, 'messages' => $value];
        }
        /*    $aryErrors = array_map(function ($i) {
                return $i[0];
            }, $validator);*/

        $newData = ['status' => $status, 'message' => __($msg), 'items' => $items, 'pages' => $pages, 'errors' => $aryErrors];

        return response()->json($newData);
    }
}
