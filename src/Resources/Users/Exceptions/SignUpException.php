<?php

namespace App\Http\Resources\Users\Exceptions;

use Exception;

class SignUpException extends Exception {
    
    public function report() {
        \Log::debug('User is already existent');
    }
}