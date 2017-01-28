<?php
namespace App\Http\Controllers\api\v1;

use \App\Http\Controllers;
use App\Model\Api\ApiUsers;
use App\Model\Api\ApiUsersProfile;
use App\Services\ConstantApiMessageService;
use App\Services\ConstantStatusService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Dingo\Api\Exception\ValidationHttpException;
use Illuminate\Support\Facades\Mail;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use League\OAuth2\Server\AuthorizationServer;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response as Psr7Response;
use Validator;
use Config;
use Hash;
use Illuminate\Validation\Factory as ValidationFactory;

/**
 * @SWG\Swagger(
 *   basePath="/api/v1",
 *   schemes={"http"},
 *   host="localhost:3232",
 *   @SWG\Info(
 *     title="New EK CMS",
 *     version="v1"
 *   )
 * )
 */
class AuthController extends AccessTokenController
{
    protected $request;

    protected $server;
    protected $validationFactory;

    public function __construct(ServerRequestInterface $request, AuthorizationServer $server, ValidationFactory $validationFactory)
    {
        $this->serverRequest = $request;
        $this->apiUser = new ApiUsers();
        $this->server = $server;
        $this->apiUsersProfile = new ApiUsersProfile();
        $this->validationFactory = $validationFactory;
    }


    /**
     * @SWG\Post(
     *     path="/auth/register",
     *     tags={"Register"},
     *     operationId="register",
     *     summary="User Registration",
     *     description="",
     *     consumes={"application/json", "application/xml"},
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         name="body",
     *         in="body",
     *         description="User Registration",
     *         required=false,
     *         @SWG\Schema(ref="#/definitions/register"),
     *     ),
     *     @SWG\Response(
     *         response=422,
     *         description="Required json Parameter",
     *     )
     * )
     * @SWG\Definition(
     *     definition="register",
     *        required={"name","email","password"},
     *      @SWG\Property(
     *                 property="name",
     *                 type="string",
     *             ),
     *         @SWG\Property(
     *                 property="email",
     *                 type="string",
     *             ),
     *      @SWG\Property(
     *                 property="password",
     *                 type="string",
     *             ),
     * )
     */


    public function register(Request $request)
    {
        $userData = $request->json()->all();
        $validator = Validator::make($userData, Config::get('boilerplate.sign_up.validation_rules'));

        if ($validator->fails()) {
            $array = $validator->errors();
            throw new ValidationHttpException($array);
        }
        $userInput = $userData;
        $userInput['password'] = bcrypt($userData['password']);
        $userInput['status'] = 1;
        $userInput['type'] = 'manual';
        $userInput['token'] = bcrypt($userData['password']);
        $user = $this->apiUser->addUsers($userInput);
        $profile = new ApiUsersProfile();

        $profile->display_name = $userData['name'];
        $profile->email = $userData['email'];
        $profile->user_id = $user->id;
        $profile->save();
        $jsonResponse ['message'] = 'Registered successfully!';
        return response()->json($jsonResponse, ConstantStatusService::OKSTATUS);
    }

    /**
     * @SWG\Post(
     *     path="/auth/login",
     *     tags={"Login"},
     *     operationId="login",
     *     summary="User Login",
     *     description="",
     *     consumes={"application/json", "application/xml"},
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         name="body",
     *         in="body",
     *         description="User Login",
     *         required=false,
     *         @SWG\Schema(ref="#/definitions/login"),
     *     ),
     *     @SWG\Response(
     *         response=401,
     *         description="unsupported grant type",
     *     )
     * )
     * @SWG\Definition(
     *     definition="login",
     *        required={"grant_type","client_id","client_secret","username","password","scope"},
     *      @SWG\Property(
     *                 property="grant_type",
     *                 type="string",
     *             ),
     *         @SWG\Property(
     *                 property="client_id",
     *                 type="integer",
     *             ),
     *      @SWG\Property(
     *                 property="client_secret",
     *                 type="string",
     *             ),
     *     @SWG\Property(
     *                 property="username",
     *                 type="string",
     *             ),
     *     @SWG\Property(
     *                 property="password",
     *                 type="string",
     *             ),
     *      @SWG\Property(
     *                 property="scope",
     *                 type="string",
     *             ),
     * )
     */

    public function login(Request $request)
    {
        $userData = $request->json()->all();
        return $this->withErrorHandling(function () use ($userData) {
            return $this->server->respondToAccessTokenRequest($this->serverRequest->withParsedBody($userData), new Psr7Response);
        });
    }

    /**
     * @SWG\Post(
     *     path="/auth/forgotpassword",
     *     tags={"Forgot Password"},
     *     operationId="forgotpassword",
     *     summary="Forgot Password",
     *     description="",
     *     consumes={"application/json", "application/xml"},
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         name="body",
     *         in="body",
     *         description="Forgot Password",
     *         required=false,
     *         @SWG\Schema(ref="#/definitions/forgotpassword"),
     *     ),
     *     @SWG\Response(
     *         response=422,
     *         description="Required json Parameter",
     *     )
     * )
     * @SWG\Definition(
     *     definition="forgotpassword",
     *        required={"email"},
     *         @SWG\Property(
     *                 property="email",
     *                 type="string",
     *             )
     * )
     */

    public function forgotPassword(Request $request)
    {
        $jsonData = $request->json()->all();
        $validator = Validator::make($jsonData, Config::get('boilerplate.forgot_password.validation_rules'));

        if ($validator->fails()) {
            throw new ValidationHttpException($validator->errors());
        }

        $userData = $this->apiUsersProfile->checkEmail($jsonData['email']);

        if (empty($userData)) {
            $jsonResponse['message'] = ConstantApiMessageService::INVALIDEMAILRESPONSE;
            $jsonResponse['status_code'] = ConstantStatusService::UNAUTHORIZEDSTATUS;
            return response()->json($jsonResponse, $jsonResponse['status_code']);
        }

        $updateData['token'] = str_random(60);
        $userData->user->token = $updateData['token'];
        $userData->user->update();
        $jsonResponse = $this->sendEmail($userData, $updateData);
        return $jsonResponse;
    }

    /**
     * @SWG\Post(
     *     path="/activate/token",
     *     tags={"Activate Token"},
     *     operationId="activate-token",
     *     summary="Activate Token",
     *     description="",
     *     consumes={"application/json", "application/xml"},
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         name="body",
     *         in="body",
     *         description="Json Body params",
     *         required=false,
     *         @SWG\Schema(ref="#/definitions/activateToken"),
     *     ),
     *     @SWG\Response(
     *         response=422,
     *         description="Required json Parameter",
     *     )
     * )
     * @SWG\Definition(
     *     definition="activateToken",
     *        required={"old-password","new-password","token"},
     *         @SWG\Property(
     *                 property="old-password",
     *                 type="string",
     *             ),
     *          @SWG\Property(
     *                 property="new-password",
     *                 type="string",
     *             ),
     *      @SWG\Property(
     *                 property="token",
     *                 type="string",
     *             )
     * )
     */

    public function activateToken(Request $request)
    {
        $jsonData = $request->json()->all();

        $validator = Validator::make($jsonData, Config::get('boilerplate.activate_token.validation_rules'));


        if ($validator->fails()) {
            throw new ValidationHttpException($validator->errors());
        }

        $user = $this->apiUser->getUserDataByToken($jsonData['token']);

        if (empty($user)) {
            $jsonResponse['message'] = ConstantApiMessageService::TOKENINVALIDRESPONSE;
            $jsonResponse['status_code'] = ConstantStatusService::UNAUTHORIZEDSTATUS;
            return response()->json($jsonResponse, $jsonResponse['status_code']);
        }

        $endDate = Carbon::now();
        $nowDate = new Carbon($user->updated_at);
        $diffInDays = $endDate->diffInDays($nowDate);
        $userData['old-password'] = $jsonData['old-password'];
        $validation = Validator::make($userData, [

            'old-password' => 'hash:' . $user->password,
        ]);

        if ($validation->fails() == true) {
            throw new ValidationHttpException($validation->errors());
        }

        if ($diffInDays > 0) {
            $updateData['token'] = str_random(60);
            $user->token = $updateData['token'];
            $user->updated_at = Carbon::now();
            $user->update();
            $jsonResponse = $this->sendEmail($user, $updateData);
            return $jsonResponse;
        } elseif ($diffInDays == 0) {

            if (Hash::check($jsonData['old-password'], $user->password) == true) {
                $password = bcrypt($jsonData['old-password']);
                $user->password = $password;
                $user->token = '';
                $user->update();
                $jsonResponse['message'] = ConstantApiMessageService::PASSWORDCHANGED;
                $jsonResponse['status_code'] = ConstantStatusService::CREATEDSTATUS;
                return response()->json($jsonResponse, $jsonResponse['status_code']);
            }

        }

    }

    /**
     * @SWG\Get(
     *   path="/activate/token/{tokenId}",
     *   summary="Check Activate token",
     *   operationId="check-activate-token",
     *  tags={"Check Activate Token"},
     * @SWG\Response(
     *     response=200,
     *     description="Valid Token"
     *   ),
     *  @SWG\Response(
     *     response="401",
     *     description="Invalid Token"
     *   )
     * )
     */

    public function checkActivateToken($token)
    {
        $jsonData['token'] = $token;
        $validator = Validator::make($jsonData, Config::get('boilerplate.check_activate_token.validation_rules'));

        if ($validator->fails()) {
            throw new ValidationHttpException($validator->errors());
        }

        $user = $this->apiUser->getUserDataByToken($jsonData['token']);

        if ($user) {
            $jsonResponse['message'] = ConstantApiMessageService::VALIDTOKEN;
            $jsonResponse['status_code'] = ConstantStatusService::OKSTATUS;
            return response()->json($jsonResponse, $jsonResponse['status_code']);
        } else {
            $jsonResponse['message'] = ConstantApiMessageService::TOKENINVALIDRESPONSE;
            $jsonResponse['status_code'] = ConstantStatusService::UNAUTHORIZEDSTATUS;
            return response()->json($jsonResponse, $jsonResponse['status_code']);
        }

    }

    public function sendEmail($userData, $updateData)
    {
        $emailData['subject'] = ConstantApiMessageService::FORGGOTPASSWORDMESSAGE;
        $emailData['email'] = $userData->email;
        $emailData['message'] = ConstantApiMessageService::FORGGOTPASSWORDMESSAGE;
        $emailData['username'] = $userData->display_name;
        $emailData['activateUrl'] = env('ABS_URL') . '/api/v1/activate/token/' . $updateData['token'];
        $emailData['baseUrl'] = env('ABS_URL');

        Mail::send('api.modules.email.sendEmail', $emailData, function ($message) use ($emailData) {
            $message->from(env('MAIL_USERNAME'));
            $message->to($emailData['email'])->subject($emailData['subject']);
        });


        $jsonResponse['message'] = ConstantApiMessageService::FORGOTPASSWORDRESPONSE;
        $jsonResponse['status_code'] = ConstantStatusService::OKSTATUS;
        return response()->json($jsonResponse, $jsonResponse['status_code']);
    }


}