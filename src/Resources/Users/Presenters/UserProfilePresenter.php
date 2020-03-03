<?php
namespace App\Http\Resources\Users\Presenters;

use Prettus\Repository\Presenter\FractalPresenter;

use League\Fractal\TransformerAbstract;
use App\Http\Resources\Users\Models\UserProfile;
use App;
use Hash;

class UserProfileTransformer extends TransformerAbstract
{
    public function transform(UserProfile $userProfile)
    {
        return [
            'user_id'    => $userProfile->user_id,
            'email'      => $userProfile->email,
            'nickName'   => $userProfile->nickName,
            'firstName' => $userProfile->firstName,
            'lastName'   => $userProfile->lastName,
            'birthDate' => $userProfile->birthDate,
            'country_id' => $userProfile->country_id,
            'phonePrefix' => $userProfile->phonePrefix,
            'phoneNumber' => $userProfile->phoneNumber,
            'image' => $userProfile->image
        ];
    }
}

class UserProfilePresenter extends FractalPresenter {

    /**
     * Prepare data to present
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer() {
        return new UserProfileTransformer();
    }
}
