@extends('layouts.main')

@section('content')
<div class="profile-page-wrapper" style="padding: 60px 20px; background-color: #f8fafc; min-height: 100vh; display: flex; flex-direction: column; align-items: center; box-sizing: border-box; font-family: system-ui, -apple-system, sans-serif;">
    
    <div class="profile-main-header" style="width: 100%; max-width: 760px; text-align: left; margin-bottom: 28px; padding-left: 4px;">
        <h1 style="color: #0f172a; font-size: 1.85rem; font-weight: 700; margin: 0 0 6px 0; letter-spacing: -0.025em;">My Profile</h1>
        <p style="color: #64748b; font-size: 0.9rem; margin: 0; font-weight: 400; letter-spacing: 0.01em;">Modify identity parameters, credentials, and verification keys for your active session.</p>
    </div>

    <div class="profile-standalone-card" style="background: #ffffff; border-radius: 16px; width: 100%; max-width: 760px; padding: 44px; box-sizing: border-box; box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.04), 0 2px 6px -1px rgba(15, 23, 42, 0.02); overflow: hidden;">
        
        <form method="POST" action="/user/profile-information" enctype="multipart/form-data" style="margin: 0;">
            @csrf
            @method('PUT')

           <div class="profile-pic-section" style="display: flex; flex-direction: row; align-items: center; gap: 28px; margin-bottom: 36px; padding-bottom: 32px; border-bottom: 1px solid #f1f5f9; width: 100%; box-sizing: border-box;">
    
    <div class="avatar-preview-circle" style="position: relative; width: 96px; height: 96px; border-radius: 50%; border: 1px dashed #cbd5e1; background-color: #f8fafc; display: flex; align-items: center; justify-content: center; flex-shrink: 0; overflow: hidden;">
        @if(Auth::user()->profile_photo_path)
            <img src="{{ asset(Auth::user()->profile_photo_path) }}" alt="Profile" style="width: 100%; height: 100%; object-fit: cover;">
        @else
            <svg width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                <circle cx="12" cy="7" r="4"></circle>
            </svg>
        @endif
    </div>

    <div style="display: flex; flex-direction: column; gap: 8px; min-width: 0; flex-grow: 1;">
        <label style="font-size: 1rem; font-weight: 600; color: #0f172a; margin: 0;">Profile Picture</label>
        <input type="file" name="profile_photo" id="profile_photo" class="custom-file-input-btn" style="font-size: 0.85rem; color: #64748b; cursor: pointer; max-width: 100%;">
    </div>
</div>
            <div class="fields-form-grid" style="display: flex; flex-direction: column; gap: 24px; margin-bottom: 40px;">
                
                <div class="form-grid-row" style="display: flex; flex-direction: row; gap: 24px; width: 100%; box-sizing: border-box;">
                    <div class="form-group grid-field-cell" style="flex: 1; display: flex; flex-direction: column;">
                        <label for="name" style="font-size: 0.72rem; font-weight: 700; color: #64748b; margin-bottom: 8px; letter-spacing: 0.04em; text-transform: uppercase;">Full Registered Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', Auth::user()->name) }}" style="background-color: #f8fafc; border: 1px solid #f1f5f9; border-radius: 8px; padding: 13px 16px; font-size: 0.95rem; color: #0f172a; font-weight: 500; width: 100%; box-sizing: border-box; transition: all 0.2s ease;" required>
                    </div>
                    <div class="form-group grid-field-cell" style="flex: 1; display: flex; flex-direction: column;">
                        <label for="email" style="font-size: 0.72rem; font-weight: 700; color: #64748b; margin-bottom: 8px; letter-spacing: 0.04em; text-transform: uppercase;">Official Email Identity</label>
                        <input type="email" name="email" id="email" value="{{ old('email', Auth::user()->email) }}" style="background-color: #f8fafc; border: 1px solid #f1f5f9; border-radius: 8px; padding: 13px 16px; font-size: 0.95rem; color: #0f172a; font-weight: 500; width: 100%; box-sizing: border-box; transition: all 0.2s ease;" required>
                    </div>
                </div>

                <div class="form-grid-row" style="display: flex; flex-direction: row; gap: 24px; width: 100%; box-sizing: border-box;">
                    <div class="form-group grid-field-cell" style="flex: 1; display: flex; flex-direction: column;">
                        <label for="current_password" style="font-size: 0.72rem; font-weight: 700; color: #64748b; margin-bottom: 8px; letter-spacing: 0.04em; text-transform: uppercase;">Current Password</label>
                        <input type="password" name="current_password" id="current_password" placeholder="••••••••" style="background-color: #f8fafc; border: 1px solid #f1f5f9; border-radius: 8px; padding: 13px 16px; font-size: 0.95rem; color: #0f172a; width: 100%; box-sizing: border-box;" required>
                    </div>
                    <div style="flex: 1;" class="responsive-spacer-collapsible"></div>
                </div>

                <div class="form-grid-row" style="display: flex; flex-direction: row; gap: 24px; width: 100%; box-sizing: border-box;">
                    <div class="form-group grid-field-cell" style="flex: 1; display: flex; flex-direction: column;">
                        <label for="password" style="font-size: 0.72rem; font-weight: 700; color: #64748b; margin-bottom: 8px; letter-spacing: 0.04em; text-transform: uppercase;">New Passwords (Optional)</label>
                        <input type="password" name="password" id="password" placeholder="••••••••" style="background-color: #f8fafc; border: 1px solid #f1f5f9; border-radius: 8px; padding: 13px 16px; font-size: 0.95rem; color: #0f172a; width: 100%; box-sizing: border-box;">
                    </div>
                    <div class="form-group grid-field-cell" style="flex: 1; display: flex; flex-direction: column;">
                        <label for="password_confirmation" style="font-size: 0.72rem; font-weight: 700; color: #64748b; margin-bottom: 8px; letter-spacing: 0.04em; text-transform: uppercase;">Confirm New Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••" style="background-color: #f8fafc; border: 1px solid #f1f5f9; border-radius: 8px; padding: 13px 16px; font-size: 0.95rem; color: #0f172a; width: 100%; box-sizing: border-box;">
                    </div>
                </div>

            </div>

            <div style="display: flex; justify-content: flex-end; width: 100%; box-sizing: border-box;" class="action-btn-wrapper">
                <button type="submit" class="profile-action-navy-btn" style="background-color: #0b2545; color: #ffffff; border: none; padding: 14px 32px; border-radius: 8px; font-size: 0.9rem; font-weight: 600; cursor: pointer; transition: background-color 0.2s ease; box-shadow: 0 4px 12px rgba(11, 37, 69, 0.15);">
                    Update Profile
                </button>
            </div>

        </form>

    </div>
</div>

<style>
    /* Interaction Form Focus States */
    .fields-form-grid input:focus {
        outline: none !important;
        background-color: #ffffff !important;
        border-color: #cbd5e1 !important;
        box-shadow: 0 0 0 1px #cbd5e1 !important;
    }
    
    .profile-action-navy-btn:hover {
        background-color: #133a68 !important;
    }

    /* Target mobile viewports under 640px wide */
    @media (max-width: 640px) {
        .profile-page-wrapper {
            padding: 32px 12px !important;
        }
        .profile-standalone-card {
            padding: 28px 20px !important;
            border-radius: 12px !important;
        }
        /* Turn horizontal item sets into vertical grids */
        .profile-pic-section {
            flex-direction: column !important;
            align-items: flex-start !important;
            gap: 20px !important;
            margin-bottom: 28px !important;
        }
        .form-grid-row {
            flex-direction: column !important;
            gap: 24px !important;
        }
        /* Collapse blank alignment spacer blocks entirely */
        .responsive-spacer-collapsible {
            display: none !important;
        }
        /* Stretches the update trigger button to be fluid across full mobile width */
        .profile-action-navy-btn {
            width: 100% !important;
            text-align: center !important;
        }
    }
</style>
@endsection