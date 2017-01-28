<?php
/**
 * Created by PhpStorm.
 * User: samina
 * Date: 12/14/16
 * Time: 4:15 PM
 */

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\JsonValidationRequest;
use App\Http\Requests\UserAddRequest;
use App\JsonParser\JsonApiParser;
use App\Model\Api\ApiUsers;
use App\Model\Api\ApiUsersProfile;
use App\Services\ConstantApiMessageService;
use App\Services\ConstantCodeService;
use App\Services\ConstantStatusService;
use App\Transformers\ProfileTransformer;
use Illuminate\Http\Request;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use League\Fractal\Serializer\JsonApiSerializer;
use Dingo\Api\Exception\ValidationHttpException;
use validator;
use Config;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->manager = new Manager();
        $this->profileTransformer = new ProfileTransformer();
        $this->apiUsersProfile = new ApiUsersProfile();
        $this->jsonValidationRequest = new JsonValidationRequest();
        $this->jsonApiParser = new JsonApiParser();
        $this->apiUsers = new ApiUsers();
    }

    /**
     * @SWG\Get(
     *   path="/profiles",
     *   summary="Get Profile Detail",
     *   operationId="getProfiles",
     *  tags={"Profiles"},
     *  @SWG\Parameter(
     *          name="Authorization",
     *          description="Get user Profiles",
     *          required=true,
     *          type="integer",
     *          in="header"
     *      ),
     * @SWG\Response(
     *     response=200,
     *     description="Profile Detail"
     *   ),
     *  @SWG\Response(
     *     response="500",
     *     description="Unauthenticated"
     *   )
     * )
     */

    public function getProfileDetail(Request $request)
    {
        if ($request->get('username')) {
            $profile = $this->apiUsersProfile->getProfileByUserName($request->get('username'));

            if ($profile == null) {
                $key = 'username';
                $message = ConstantApiMessageService::NOUSERNAME;
                $status = ConstantStatusService::NOTFOUNDSTATUS;
                $jsonResponse = $this->jsonApierror($key, $message, $status);
                return response()->json($jsonResponse, $jsonResponse['status']);
            }

        } else {
            $profile = $request->user()->profile;
        }

        $baseUrl = env('ABS_URL');
        $this->manager->setSerializer(new JsonApiSerializer($baseUrl));
        $resource = new Item($profile, $this->profileTransformer, 'profile');
        return $this->manager->createData($resource)->toArray();
    }

    public function updateProfile(Request $request, $id)
    {
        $profile = $this->apiUsersProfile->getProfileById($id);

        if (empty($profile)) {
            $code = ConstantCodeService::NOTFOUNDPROFILEIDCODE;
            $key = 'id';
            $message = ConstantApiMessageService::NOTFOUNDPROFILEID;
            $status = ConstantStatusService::NOTFOUNDSTATUS;
            $error = $this->jsonValidationRequest->missingDataAttribute($status, $code, $key, $message);
            return response()->json($error, $status);
        }

        $profileData = $request->json()->all();
        $validation = $this->jsonValidationRequest->validateJsonSpec($profileData);

        if ($validation == false) {
            $updateProfile = $this->jsonApiParser->parseAttribute($profileData);
            $this->apiUsersProfile->updateProfile($updateProfile, $id);
            $profile = $this->apiUsersProfile->getProfileById($id);
            $baseUrl = env('ABS_URL');
            $this->manager->setSerializer(new JsonApiSerializer($baseUrl));
            $resource = new Item($profile, $this->profileTransformer, 'profile');
            return $this->manager->createData($resource)->toArray();
        } else {
            return $validation;
        }

    }

    /**
     * @SWG\Post(
     *     path="/change/password",
     *     tags={"Change Password"},
     *     operationId="changepassword",
     *     summary="Change Password",
     *     description="",
     *     consumes={"application/json", "application/xml"},
     *     produces={"application/xml", "application/json"},
     * @SWG\Parameter(
     *          name="Authorization",
     *          description="Authorization Bearer",
     *          required=true,
     *          type="integer",
     *          in="header"
     *      ),
     *     @SWG\Parameter(
     *         name="body",
     *         in="body",
     *         description="Json Body params",
     *         required=false,
     *         @SWG\Schema(ref="#/definitions/changepassword"),
     *     ),
     *     @SWG\Response(
     *         response=422,
     *         description="Required json Parameter",
     *     )
     * )
     * @SWG\Definition(
     *     definition="changepassword",
     *        required={"old-password","new-password","confirm-password"},
     *         @SWG\Property(
     *                 property="old-password",
     *                 type="string",
     *             ),
     *          @SWG\Property(
     *                 property="new-password",
     *                 type="string",
     *             ),
     *      @SWG\Property(
     *                 property="confirm-password",
     *                 type="string",
     *             )
     * )
     */

    public function changePassword(Request $request)
    {
        $jsonData = $request->json()->all();

        $validator = Validator::make($jsonData, Config::get('boilerplate.change_password.validation_rules'));


        if ($validator->fails()) {
            throw new ValidationHttpException($validator->errors());
        }

        $user = $request->user();

        $userData['old-password'] = $jsonData['old-password'];
        $validation = Validator::make($userData, [

            'old-password' => 'hash:' . $user->password,
        ]);

        if ($validation->fails() == true) {
            throw new ValidationHttpException($validation->errors());
        }

        $user->password = bcrypt($jsonData['new-password']);
        $user->update();
        $jsonResponse['message'] = ConstantApiMessageService::PASSWORDCHANGED;
        $jsonResponse['status_code'] = ConstantStatusService::CREATEDSTATUS;
        return response()->json($jsonResponse, $jsonResponse['status_code']);


    }

}