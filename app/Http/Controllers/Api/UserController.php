<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\Controller;
use App\User;
use App\TypeUser;
use App\Classes\Constants;
use Auth;

class UserController extends Controller
{
	 /**
     * User login.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $data = [
            "status" => 0,
        ];

        $validator = Validator::make($request->all(), [
            "email" => "required|string|email|max:255",
            "password" => "required|string|min:6"
        ]);

        if ($validator->fails()) {
            $data = [
                "status" => 0,
                "errors" => $validator->errors(),
            ];
        } else {
            /*
             * Auth::once method to log a user into the application for a single request.
             * No sessions or cookies will be utilized.
             */
            if (Auth::once(["email" => $request->input("email"), "password" => $request->input("password")])) {
                $data = [
                    "status" => 1,
                    "token" => Auth::user()->api_token,
                ];
            }
        }

        return response()->json($data);
    }

    /**
     * Register new user.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|string|max:255",
            "email" => "required|string|email|max:255|unique:users",
            "password" => "required|string|min:6|confirmed"
        ]);

        if ($validator->fails()) {
            $data = [
                "status" => 0,
                "errors" => $validator->errors(),
            ];
        } else {
            $api_token = str_random(60);

            User::create([
                'name' => $request->input("name"),
                'email' => $request->input("email"),
                'password' => bcrypt($request->input("password")),
                'api_token' => $api_token,
            ]);

            $data = [
                "status" => 1,
                "token" => $api_token,
            ];
        }

        return response()->json($data);
    }

    /**
     * Send email for reset password.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "email" => "required|email",
        ]);

        if ($validator->fails()) {
            $data = [
                "status" => 0,
                "errors" => $validator->errors(),
            ];
        } else {
            $response = $this->broker()->sendResetLink(
                $request->only('email')
            );

            if ($response[1] == Password::RESET_LINK_SENT) {
                $data = [
                    "status" => 1,
                    "data" => [
                        "message" => $response[0],
                    ],
                ];
            } else {
                $data = [
                    "status" => 0,
                    "errors" => [
                        "message" => $response,
                    ],
                ];
            }
        }

        return response()->json($data);
    }

    /**
     * Reset password.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resetEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:4',
        ]);

        if ($validator->fails()) {
            $data = [
                "status" => 0,
                "errors" => $validator->errors(),
            ];
        } else {
            $response = $this->broker()->reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function ($user, $password) {
                    $this->resetPassword($user, $password);
                }
            );

            if ($response == Password::PASSWORD_RESET) {
                $data = [
                    "status" => 1,
                    "data" => [
                        "message" => $response,
                    ],
                ];
            } else {
                $data = [
                    "status" => 0,
                    "errors" => [
                        "message" => $response,
                    ],
                ];
            }
        }

        return response()->json($data);
    }

      /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        return Password::broker();
    }

    /**
     * Reset the given user's password.
     *
     * @param \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @param $password
     */
    protected function resetPassword($user, $password)
    {
        $user->forceFill([
            'password' => bcrypt($password),
            'remember_token' => str_random(60),
        ])->save();
    }
   
	public function getUser(Request $request)
	{
		$validator = Validator::make($request->all(),[
			'user_id'=>'required|exists:users,id'
		]);

		if($validator->fails()){
			$data = [
				'status' => 0,
				'errors' => $validator->errors(),
			];
		} else {
			$id = $request->query('user_id');
			$user = User::find($id);
			$data = [
				'status' => 1,
				'user'   => $user,
			];
		}

		return response()->json($data);
	}

	public function getAllUsers()
	{
        $all_users = User::all();

		$data = [
		    "status" => 1,
            "data" => $all_users,
//            "data" => [
//                "all_users" => $all_users
//            ],
        ];

		return response()->json($data);
	}

	public function setUser(Request $request)
	{
		$validator = Validator::make($request->all(),[
			'name' => 'required|string|unique:users,name',
			'email' => 'required|string|email|unique:users,email',
			'password' => 'required|confirmed',
			'password_confirmation' => 'required',
//			'type_user_id' => 'required|integer|min:1',
		]);

		if($validator->fails()){
			$data = [
				'status' => 0,
				'errors' => $validator->errors(),
			];
		}else{
//			$exist_type = TypeUser::find($request->input('type_user_id'));
//			if(is_null($exist_type)){
//				$data = [
//					'status' => 0,
//					'errors' => 'Type not exist!',
//				];
//			} else {
				$user = new User();
				$user->name = $request->input('name');
				$user->email = $request->input('email');
				$user->password = bcrypt($request->input('password'));
				$user->api_token = str_random(60);
				$user->type_user_id = 1;
				$user->save();
				$data = [
					'status' => 1,
				];
//			}
		}
		
		return response()->json($data);

	}

	public function deleteUser(Request $request)
	{
		$validator = Validator::make($request->all(),[
			'user_id' => 'required|exists:users,id|integer|min:1',
		]);

		if($validator->fails()){

			$data = [
				'status' => 0,
				'errors' => $validator->errors(),
			];

		} else {
			
				User::destroy($request->input('user_id'));
				$data = [
					'status' => 1,
				];
			
		}

			return response()->json($data);		
	}

	public function putUser(Request $request)
	{
		$validator = Validator::make($request->all(),[
			'user_id' => 'required|exists:users,id|integer|min:1',
			'type_user_id' => 'exists:type_users,id',
		]);

		if($validator->fails()){
			$data = [
				'status' => 0,
				'errors' => $validator->errors(),
			];

		} else {

			$user = User::find($request->input('user_id'));

			$password = $request->input('password');
			$password_confirmation = $request->input('password_confirmation');

			if(!empty($request->input('type_user_id'))){
				$user->type_user_id = $type_user_id;
			} 

			if(!empty($request->input('name'))){
				$user->name = $request->input('name');
			}

			if(!empty($request->input('email'))){
				$validator = Validator::make([
					'email' => "unique:users",
				]);
				if($validator->fails()){
					$data = [
						'status' => 0,
						'errors' => $validator->errors(),
					];
					return response()->json($data);
				} else {
					$user->email = $rquest->input('email');
				}
			}

			if(!empty($password)&&!empty($password)){
				if($password == $password_confirmation){
					$user->password = bcrypt($request->input('password'));
				} else {
					$data = [
						'status' => 0,
						'errors' => 'Passwords don`t match!',
					];
				}				
			}
			
			$user->save();

			$data=[
				'status' => 1,
			];

		}

		return response()->json($data);
	}

	public function getUserCurrent(Request $request)
	{
		$data = [
			'status' => 1,
			'data'=> Auth::user(),
		];

		return response()->json($data);
	}
}
