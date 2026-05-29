@extends('layouts.auth')

@section('content')
<div class="min-vh-100 d-flex align-items-center justify-content-center auth-wrapper" style="background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%); padding: 20px;">
    
    <div class="container d-flex justify-content-center align-items-center p-0">
        <div class="card shadow-lg border-0 auth-card" style="background: #ffffff; border-radius: 20px; width: 100%; max-width: 450px; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.08);">
            
            <div class="text-center branding-header">
                <div class="d-inline-flex align-items-center justify-content-center mb-2" style="background-color: #e0e7ff; width: 48px; height: 48px; border-radius: 12px;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#4f46e5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
                        <path d="M6 12v5c0 2 2 3 6 3s6-1 6-3v-5"></path>
                    </svg>
                </div>
                <h2 class="font-weight-bold mb-1 brand-title" style="color: #0f172a; font-size: 1.75rem; letter-spacing: -0.025em;">EduTrack Pro</h2>
                <p style="color: #64748b; font-size: 0.9rem;" class="brand-subtitle">Student Information & Records Portal</p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf 

                <div class="form-group" style="display: flex; flex-direction: column; margin-bottom: 20px;">
                    <label for="email" style="font-size: 0.8rem; font-weight: 600; color: #475569; margin-bottom: 6px; letter-spacing: 0.05em; text-transform: uppercase;">Email Address</label>
                    <input type="email" 
                           name="email" 
                           id="email"
                           value="{{ old('email') }}" 
                           class="form-control form-control-lg @error('email') is-invalid @enderror" 
                           style="padding: 12px 14px; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 0.95rem; transition: all 0.2s ease; color: #334155;"
                           placeholder="admin@gmail.com"
                           required 
                           autofocus>
                    @error('email')
                        <div style="color: #ef4444; font-size: 0.8rem; margin-top: 5px; font-weight: 500;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group" style="display: flex; flex-direction: column; margin-bottom: 24px;">
                    <label for="password" style="font-size: 0.8rem; font-weight: 600; color: #475569; margin-bottom: 6px; letter-spacing: 0.05em; text-transform: uppercase;">Password</label>
                    <input type="password" 
                           name="password" 
                           id="password"
                           class="form-control form-control-lg @error('password') is-invalid @enderror" 
                           style="padding: 12px 14px; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 0.95rem; transition: all 0.2s ease; color: #334155;"
                           placeholder="••••••••"
                           required>
                    @error('password')
                        <div style="color: #ef4444; font-size: 0.8rem; margin-top: 5px; font-weight: 500;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="form-check d-flex align-items-center" style="padding-left: 0;">
                        <input type="checkbox" name="remember" id="remember" style="width: 16px; height: 16px; cursor: pointer; margin: 0; accent-color: #4f46e5;">
                        <label class="small" for="remember" style="color: #64748b; font-weight: 500; margin-left: 8px; margin-bottom: 0; cursor: pointer; user-select: none;">Remember this device</label>
                    </div>
                </div>

                <button type="submit" style="background: linear-gradient(135deg, #4f46e5 0%, #4338ca 100%); color: white; border: none; padding: 14px; border-radius: 10px; font-weight: 600; cursor: pointer; width: 100%; font-size: 1rem; transition: all 0.2s ease; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.25);">
                    Sign In to Dashboard
                </button>

                <div class="text-center footer-navigation" style="text-align: center; margin-top: 24px;">
                    <span style="color: #64748b; font-size: 0.85rem; font-weight: 500;">Need an administration account? </span>
                    <a href="{{ route('register') }}" style="color: #4f46e5; font-size: 0.85rem; font-weight: 600; text-decoration: none; transition: color 0.2s ease;">Register here</a>
                </div>
            </form>

        </div>
    </div>

</div>

<style>
    /* Desktop default padding layout */
    .auth-card {
        padding: 48px !important;
    }
    .branding-header {
        margin-bottom: 32px !important;
    }

    /* Tablet and Smartphone Responsiveness modifications */
    @media (max-width: 576px) {
        .auth-wrapper {
            padding: 16px !important;
        }
        .auth-card {
            padding: 32px 24px !important;
            border-radius: 16px !important;
        }
        .branding-header {
            margin-bottom: 24px !important;
        }
        .brand-title {
            font-size: 1.5rem !important;
        }
    }
</style>
@endsection