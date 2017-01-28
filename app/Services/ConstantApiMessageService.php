<?php
namespace App\Services;
/**
 * Created by PhpStorm.
 * User: samina
 * Date: 12/14/16
 * Time: 5:18 PM
 */
class ConstantApiMessageService
{

    const NOUSERNAME = 'Username doesnot exist.';
    const JSONPARSEERROR = 'JSON parse error - Expecting property name at line 1 column 2 (char 1).';
    const MISSINGJSONDATA = 'Missing `data` Member at documents top level.' ;
    const VALIDJSONID = 'JSON API resource objects MUST have a valid id';
    const VALIDJSONTYPE = 'JSON API resource objects MUST have a valid type';
    const VALIDJSONATTRIBUTE = 'JSON API resource objects MUST have a valid attribute';
    const VALIDJSONLINK= 'JSON API resource objects MUST have a valid link';
    const NOTFOUNDPROFILEID = 'Profile id requested does not exist!';
    const INVALIDEMAILRESPONSE ='Email requested does not exist';
    const FORGGOTPASSWORDMESSAGE = 'Forgot Password';
    const FORGOTPASSWORDRESPONSE = 'Thank you!.We have sent an activation link to your email.Please click the activation link provided to your email.';
    const TOKENINVALIDRESPONSE = 'Invalid Token';
    const EXPIREDTOKEN = 'The token you requested has been expired.Please request another token.';
    const PASSWORDCHANGED = 'Your Password has been changed sucessfully';
    const VALIDTOKEN = 'Valid Token';
}