<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Ferdous\OtpValidator\Object\OtpRequestObject;
use Ferdous\OtpValidator\Object\OtpValidateRequestObject;
use Ferdous\OtpValidator\OtpValidator;
use Illuminate\Http\Request;

class OtpController extends Controller
{
  public function requestForOtp(Request $request)
  {
    $lead_id = $request->lead_id;
    $type = "Form Open Account";
    $number = null;
    $email = $request->email;

    $otp_req = OtpValidator::requestOtp(
      new OtpRequestObject($lead_id, $type, $number, $email)
    );

    return response()->json($otp_req);
  }

  public function validateOtp(Request $request)
  {
    $otp_unique_id = $request->otp_unique_id;
    $otp_code = $request->otp_code;

    $otp_validator = OtpValidator::validateOtp(
      new OtpValidateRequestObject($otp_unique_id, $otp_code)
    );

    return response()->json($otp_validator);
  }

  public function resendOtp(Request $request)
  {
    $otp_unique_id = $request->otp_unique_id;

    $otp_resend = OtpValidator::resendOtp($otp_unique_id);

    return response()->json($otp_resend);
  }
}
