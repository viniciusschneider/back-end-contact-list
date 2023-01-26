<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactsCreateOrEditRequest;
use App\Http\Requests\ContactsListRequest;
use App\Models\Contact;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    public function list(ContactsListRequest $request) {
        $items = Contact::where('user_id', $this->getUserId());
        $total = Contact::where('user_id', $this->getUserId());

        if ($request->search) {
            $items->where('name', 'like', '%'.$request->search.'%');
            $total->where('name', 'like', '%'.$request->search.'%');
        }

        return response()->json([
            'items' => $items->orderBy('name')
                ->take($request->limit)
                ->skip($request->limit * ($request->page - 1))
                ->get(),
            'total' => $total->orderBy('name')->count()
        ]);
    }

    public function create(ContactsCreateOrEditRequest $request) {
        Contact::create([
            'user_id' => $this->getUserId(),
            'name' => $request->name,
            'email' => $request->email ?? null,
            'phone' => $request->phone ?? null,
            'whatsapp' => $request->whatsapp ?? null,
            'notes' => $request->notes ?? null,
        ]);

        return response()->json([
            'success' => true
        ]);
    }

    public function update(ContactsCreateOrEditRequest $request, $id) {
        $this->contactExists($id);

        Contact::where('user_id', $this->getUserId())
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'email' => $request->email ?? null,
                'phone' => $request->phone ?? null,
                'whatsapp' => $request->whatsapp ?? null,
                'notes' => $request->notes ?? null,
            ]);

        return response()->json([
            'success' => true
        ]);
    }

    public function delete(Request $request, $id) {
        $this->contactExists($id);

        Contact::where('user_id', $this->getUserId())
            ->where('id', $request->id)
            ->delete();

        return response()->json([
            'success' => true
        ]);
    }

    private function contactExists($id) {
        $contact = Contact::where('user_id', $this->getUserId())
            ->where('id', $id)
            ->first();

        if (!$contact) {
            throw new HttpResponseException(
                response()->json([
                    'message' => 'Contact not found',
                ], 404)
            );
        }
    }
}
