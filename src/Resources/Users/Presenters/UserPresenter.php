<?php
namespace App\Http\Resources\Users\Presenters;

use Prettus\Repository\Presenter\FractalPresenter;

use League\Fractal\TransformerAbstract;
use App\Http\Resources\Users\Models\User;
use App;
use Hash;

class UserTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {
        $utils = App::make('Utils');
        $profile = $user->profile();
        if ($profile) {
            $profile = $utils->transformItem($profile->first(), App::make('UsersResource')->getPresenterClassPath('UserProfile'));
        }
        return [
            'id'      => (int) $user->id,
            'email'   => $user->email,
            'profile' => $profile,
            'roles'   => $user->getRoleNames(),
            'hasEmptyPassword' => Hash::check('social', $user->password)
        ];
    }
}

class UserPresenter extends FractalPresenter {

    /**
     * Prepare data to present
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer() {
        return new UserTransformer();
    }
}
