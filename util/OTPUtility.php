<?php


class OTPUtility
{
    public static function generate($mobileNumber)
    {
        $otp = self::generateAndSave($mobileNumber);
        return $otp;
    }

    private static function generateAndSave($mobileNumber)
    {
        $randomNumber = rand(100000, 999999); //Generating the random number (6 digits)

        $otp = new OneTimePassword($randomNumber, $mobileNumber);

        if ($otp->existsByMobileNumber($mobileNumber)) {//If there exists a number already
            $otp->dateCreated = new DateTime();
            $otp->update();
        } else {//Otherwise
            $otp->save();
        }

        return $otp;
    }

    public static function verify($mobileNumber, $value)
    {
        $otp = new OneTimePassword();
        $otp = $otp->findByMobileNumber($mobileNumber);

        if ($otp->value !== $value) {//If the submitted OTP is incorrect
            //TODO: Return Invalid OTP
        }

        $now = new DateTime();
        $otpExpiry = ($otp->dateCreated->getTimeStamp()) + OTP_CONFIG["ttl"];//Calculating the OTP expiry

        if ($otpExpiry < $now->getTimestamp()) {
            echo "Expired";
            //TODO: Handle the rest
        } else {
            echo "Valid";
            //TODO: Handle the rest
        }
    }
}