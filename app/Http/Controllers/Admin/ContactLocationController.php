<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ContactLocationController extends Controller
{
    public function index()
    {
        $locations = ContactLocation::ordered()->paginate(10);
        return view('admin.contact.locations.index', compact('locations'));
    }

    public function create()
    {
        return view('admin.contact.locations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'map_iframe_url' => 'nullable|url',
            'weekday_hours' => 'nullable|string|max:255',
            'weekend_hours' => 'nullable|string|max:255',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $data['is_active'] = $request->has('is_active');
        $data['is_default'] = $request->has('is_default');

        // Handle background image upload
        if ($request->hasFile('background_image')) {
            $imagePath = $request->file('background_image')->store('contact/backgrounds', 'public');
            $data['background_image'] = $imagePath;
        }

        // If this is set as default, unset other defaults
        if ($data['is_default']) {
            ContactLocation::where('is_default', true)->update(['is_default' => false]);
        }

        ContactLocation::create($data);

        return redirect()->route('admin.contact.locations.index')
            ->with('success', 'Contact location created successfully.');
    }

    public function show(ContactLocation $location)
    {
        return view('admin.contact.locations.show', compact('location'));
    }

    public function edit(ContactLocation $location)
    {
        return view('admin.contact.locations.edit', compact('location'));
    }

    public function update(Request $request, ContactLocation $location)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'map_iframe_url' => 'nullable|url',
            'weekday_hours' => 'nullable|string|max:255',
            'weekend_hours' => 'nullable|string|max:255',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $data['is_active'] = $request->has('is_active');
        $data['is_default'] = $request->has('is_default');

        // Handle background image upload
        if ($request->hasFile('background_image')) {
            // Delete old image
            if ($location->background_image) {
                Storage::disk('public')->delete($location->background_image);
            }
            $imagePath = $request->file('background_image')->store('contact/backgrounds', 'public');
            $data['background_image'] = $imagePath;
        }

        // If this is set as default, unset other defaults
        if ($data['is_default']) {
            ContactLocation::where('id', '!=', $location->id)
                ->where('is_default', true)
                ->update(['is_default' => false]);
        }

        $location->update($data);

        return redirect()->route('admin.contact.locations.index')
            ->with('success', 'Contact location updated successfully.');
    }

    public function destroy(ContactLocation $location)
    {
        // Delete background image
        if ($location->background_image) {
            Storage::disk('public')->delete($location->background_image);
        }

        $location->delete();

        return redirect()->route('admin.contact.locations.index')
            ->with('success', 'Contact location deleted successfully.');
    }

    public function toggleStatus(ContactLocation $location)
    {
        $location->update(['is_active' => !$location->is_active]);
        
        $status = $location->is_active ? 'activated' : 'deactivated';
        return redirect()->back()->with('success', "Location has been {$status} successfully.");
    }

    public function setDefault(ContactLocation $location)
    {
        // Unset all defaults
        ContactLocation::where('is_default', true)->update(['is_default' => false]);
        
        // Set this as default
        $location->update(['is_default' => true]);
        
        return redirect()->back()->with('success', "Location has been set as default successfully.");
    }
}
