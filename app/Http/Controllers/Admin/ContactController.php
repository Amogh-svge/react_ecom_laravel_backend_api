<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use Illuminate\Http\JsonResponse;

class ContactController extends Controller
{
    public function create(ContactRequest $request): JsonResponse
    {
        $contact = [
            'contact_time' => date('h:i:sa'),
            'contact_date' => date('d-m-Y'),
        ];
        $data = $request->validated() + $contact;
        $created = Contact::create($data);

        return $created ?
            $this->successResponse(['data' => new ContactResource($created)], 'Successfully Created') :
            $this->errorResponse(['data' => []], 'Failed To Create');
    }
}
