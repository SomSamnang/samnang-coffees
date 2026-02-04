<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class SettingsController extends Controller
{
    /**
     * Display the settings page.
     */
    public function index(): View
    {
        return view('settings.index');
    }

    /**
     * Update the application settings.
     */
    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'bank_qr_code' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        if ($request->hasFile('bank_qr_code')) {
            $request->file('bank_qr_code')->storeAs('settings', 'bank_qr.png', 'public');
        }

        return back()->with('success', 'Settings updated successfully!');
    }
}