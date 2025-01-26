<?php

namespace App\Repositories;

use App\Models\Verification;
use App\Repositories\Contracts\VerificationRepositoryInterface;
use Illuminate\Http\Request;

class VerificationRepository extends BaseRepository implements VerificationRepositoryInterface
{
    /**
     * @return string
     */
    public function getModelName(): string
    {
        return Verification::class;
    }

    /**
     * @param int $otpLength
     * @return int
     */
    public function generateOtp(int $otpLength = 5): int
    {
        $min = pow(10, $otpLength-1);
        $max = $min * 10 - 1;
        return mt_rand($min, $max);
    }

    /**
     * @param int $otp
     * @param string $mobile
     * @return bool
     */
    public function otpExists(int $otp, string $mobile): bool
    {
        return $this->getModel()
            ->query()
            ->where('otp', $otp)
            ->where('mobile', $mobile)
            ->where('is_used', false)
            ->exists();
    }

    /**
     * @param int $otp
     * @param string $mobile
     * @return bool
     */
    public function otpValid(int $otp, string $mobile): bool
    {
        return $this->getModel()
            ->query()
            ->where('otp', $otp)
            ->where('mobile', $mobile)
            ->where('is_used', false)
            ->where('created_at', '>=', now()->subSeconds(180))
            ->exists();
    }

    /**
     * @param int $otp
     * @param string $mobile
     * @return mixed
     */
    public function MarkAsUsed(int $otp, string $mobile)
    {
        return $this->getModel()
            ->query()
            ->where('otp', $otp)
            ->where('mobile', $mobile)
            ->update(['is_used' => true]);
    }

    /**
     * @param string $otp
     * @param string $mobile
     * @return mixed
     */
    public function createCode(string $mobile)
    {
        $otp = $this->generateOtp(5);
        $verificationData = [
            'otp'  =>  $otp,
            'mobile' => $mobile,
            'is_used' => false,
        ];
        return $this->create($verificationData);
    }

    /**
     * @param string $mobile
     * @param int $waitingTime
     * @return bool
     */
    public function allowedToSentOtpAgain(string $mobile, int $waitingTime = 120): bool
    {
        return !$this->getModel()->query()->where('mobile', $mobile)->waiting($waitingTime)->exists();
    }
}
