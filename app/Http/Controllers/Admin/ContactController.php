<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        // Filter by Read / Unread
        if ($request->filled('read_status')) {
            if ($request->read_status === 'unread') {
                $query->whereNull('read_at');
            } elseif ($request->read_status === 'read') {
                $query->whereNotNull('read_at');
            }
        }

        // Filter by Connection Status
        if ($request->filled('status')) {
            if (in_array($request->status, ['connected', 'not_connected'])) {
                $query->where('status', $request->status);
            }
        }

        // Filter by Source (Quote vs Contact)
        if ($request->filled('source')) {
            if (in_array($request->source, ['quote', 'contact'])) {
                $query->where('source', $request->source);
            }
        }

        $contacts = $query->latest()->paginate(15)->withQueryString();

        // Summary Counts for filter badges & tabs
        $counts = [
            'all' => Contact::count(),
            'unread' => Contact::whereNull('read_at')->count(),
            'read' => Contact::whereNotNull('read_at')->count(),
            'connected' => Contact::where('status', 'connected')->count(),
            'not_connected' => Contact::where('status', 'not_connected')->count(),
            'quote' => Contact::where('source', 'quote')->count(),
            'contact' => Contact::where('source', 'contact')->count(),
        ];

        return view('admin.contacts.index', compact('contacts', 'counts'));
    }

    public function show(Contact $contact)
    {
        // Automatically mark as read/opened if currently unread
        if ($contact->isUnread()) {
            $contact->markAsRead();
        }

        return view('admin.contacts.show', compact('contact'));
    }

    public function updateStatus(Request $request, Contact $contact)
    {
        $validated = $request->validate([
            'status' => ['required', 'string', 'in:connected,not_connected'],
            'admin_notes' => ['nullable', 'string', 'max:2000'],
        ]);

        $contact->update($validated);

        return back()->with('success', 'Contact status updated successfully.');
    }

    public function toggleRead(Contact $contact)
    {
        if ($contact->isRead()) {
            $contact->update(['read_at' => null]);
            $msg = 'Message marked as unread.';
        } else {
            $contact->update(['read_at' => now()]);
            $msg = 'Message marked as read.';
        }

        return back()->with('success', $msg);
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('admin.contacts.index')->with('success', 'Contact message deleted successfully.');
    }
}
