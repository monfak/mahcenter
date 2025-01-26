<?php

namespace App\Repositories\Contracts;

interface VerificationRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param int $otpLength
     * @return int
     */
    public function generateOtp(int $otpLength = 5): int;

    /**
     * @param int $otp
     * @param string $mobile
     * @return bool
     */
    public function otpExists(int $otp, string $mobile): bool;

    /**
     * @param int $otp
     * @param string $mobile
     * @return bool
     */
    public function otpValid(int $otp, string $mobile): bool;

    /**
     * @param int $otp
     * @param string $mobile
     * @return mixed
     */
    public function MarkAsUsed(int $otp, string $mobile);

    /**
     * @param string $otp
     * @param string $mobile
     * @return mixed
     */
    public function createCode(string $mobile);

    /**
     * @param string $mobile
     * @param int $waitingTime
     * @return bool
     */
    public function allowedToSentOtpAgain(string $mobile, int $waitingTime = 120): bool;
}
