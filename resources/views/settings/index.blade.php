@extends('layouts.app')

@section('title', 'Settings - Samnang Coffee')

@section('styles')
<style>
    .page-header {
        background: linear-gradient(135deg, #6c757d 0%, #343a40 100%);
        color: white;
        padding: 2.5rem 2rem;
        border-radius: 12px;
        margin-bottom: 3rem;
    }
    .page-header h1 {
        margin: 0;
        font-size: 2.2rem;
        font-weight: 800;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="page-header">
        <h1><i class="bi bi-gear-fill"></i> Application Settings</h1>
    </div>

    <div class="card shadow-sm">
        <div class="card-header">
            <h5 class="mb-0">Payment Settings</h5>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="bank_qr_code" class="form-label fw-bold">Bank QR Code Image</label>

                    @if(\Illuminate\Support\Facades\Storage::disk('public')->exists('settings/bank_qr.png'))
                        <div class="my-2">
                            <p class="mb-1 small text-muted">Current QR Code:</p>
                            <img src="{{ asset('storage/settings/bank_qr.png') }}?v={{ time() }}" alt="Current Bank QR Code" class="img-thumbnail" style="max-width: 200px;">
                        </div>
                    @endif

                    <input class="form-control @error('bank_qr_code') is-invalid @enderror" type="file" id="bank_qr_code" name="bank_qr_code" accept="image/png, image/jpeg">
                    <div class="form-text">Upload a new QR code image (PNG, JPG, JPEG). Max 2MB.</div>
                    @error('bank_qr_code')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Save Settings</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection