<?php

namespace App\Http\Resources\ContactUs\Controllers\V1;

use App\Http\Resources\ContactUs\Notifications\ContactUsAdminNotification;
use App\Http\Resources\ContactUs\Notifications\ContactUsUserNotification;
use App\Http\Resources\ContactUs\Models\ContactUs;
use UncleProject\UncleLaravel\Controllers\ApiMultiResourceController;
use App\Http\Resources\ContactUs\Requests\ContactUsRequest;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\Request;
use Storage;

/**
 * @group ContactUs
 *
 * APIs for managing {}
 */

class ContactUsController extends ApiMultiResourceController {

    protected $resourceName = 'ContactUs';

    /**
     * Send Contact us Emails
     *
     */

    public function contact(ContactUsRequest $request) {

        /*Notification::route('mail', $request->get('from'))
            ->notify(new ContactUsUserNotification());*/

        Notification::route('mail', config('mail.from.address'))
            ->notify(new ContactUsAdminNotification($request->get('from'),$request->get('object'),$request->get('text')));

        return $this->validSuccessJsonResponse('Success', []);

    }
}
