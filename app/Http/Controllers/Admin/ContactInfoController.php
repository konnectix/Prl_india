<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInfo;
use Illuminate\Http\Request;

class ContactInfoController extends Controller
{
    public function index()
    {
        $contactInfo = ContactInfo::ordered()->paginate(15);
        return view('admin.contact.info.index', compact('contactInfo'));
    }

    public function create()
    {
        $types = [
            'text' => 'Text',
            'email' => 'Email',
            'phone' => 'Phone',
            'address' => 'Address',
            'textarea' => 'Textarea',
            'url' => 'URL'
        ];

        $sections = [
            'general' => 'General',
            'header' => 'Header',
            'footer' => 'Footer',
            'contact' => 'Contact Page'
        ];

        return view('admin.contact.info.create', compact('types', 'sections'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'key' => 'required|string|max:255|unique:contact_info,key',
            'label' => 'required|string|max:255',
            'value' => 'required|string',
            'type' => 'required|in:text,email,phone,address,textarea,url',
            'icon' => 'nullable|string|max:255',
            'section' => 'required|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        ContactInfo::create($data);

        return redirect()->route('admin.contact.info.index')
            ->with('success', 'Contact information created successfully.');
    }

    public function show(ContactInfo $info)
    {
        // Get related contact info in the same section
        $relatedInfo = ContactInfo::where('section', $info->section)
            ->orderBy('sort_order')
            ->orderBy('label')
            ->get();

        return view('admin.contact.info.show', compact('info', 'relatedInfo'));
    }

    public function edit(ContactInfo $info)
    {
        $types = [
            'text' => 'Text',
            'email' => 'Email',
            'phone' => 'Phone',
            'address' => 'Address',
            'textarea' => 'Textarea',
            'url' => 'URL'
        ];

        $sections = [
            'general' => 'General',
            'header' => 'Header',
            'footer' => 'Footer',
            'contact' => 'Contact Page'
        ];

        return view('admin.contact.info.edit', compact('info', 'types', 'sections'));
    }

    public function update(Request $request, ContactInfo $info)
    {
        $request->validate([
            'key' => 'required|string|max:255|unique:contact_info,key,' . $info->id,
            'label' => 'required|string|max:255',
            'value' => 'required|string',
            'type' => 'required|in:text,email,phone,address,textarea,url',
            'icon' => 'nullable|string|max:255',
            'section' => 'required|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        $info->update($data);

        return redirect()->route('admin.contact.info.index')
            ->with('success', 'Contact information updated successfully.');
    }

    public function destroy(ContactInfo $info)
    {
        $info->delete();

        return redirect()->route('admin.contact.info.index')
            ->with('success', 'Contact information deleted successfully.');
    }

    public function toggleStatus(ContactInfo $info)
    {
        $info->update(['is_active' => !$info->is_active]);
        
        $status = $info->is_active ? 'activated' : 'deactivated';
        return redirect()->back()->with('success', "Contact information has been {$status} successfully.");
    }
}
