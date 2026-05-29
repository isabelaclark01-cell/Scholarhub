@extends('layouts.main')

@section('content')
<div class="app-root-container" style="padding: 40px 24px; background-color: #f8fafc; min-height: 100vh; width: 100%; box-sizing: border-box; font-family: system-ui, -apple-system, sans-serif;">
    
    <div style="margin-bottom: 32px; text-align: left; width: 100%; box-sizing: border-box;">
        <h1 style="color: #0f172a; font-size: 1.75rem; font-weight: 700; margin: 0 0 6px 0; letter-spacing: -0.02em;">Welcome back, {{ Auth::user()->name }}</h1>
        <p style="color: #64748b; font-size: 0.9rem; margin: 0; font-weight: 400;">Here is your administrative system overview for ScholarHub today.</p>
    </div>

    <div class="responsive-metrics-grid" style="display: flex; flex-direction: row; gap: 20px; margin-bottom: 32px; width: 100%; box-sizing: border-box; flex-wrap: wrap;">
        
        <div class="ui-summary-card" style="flex: 1; min-width: 220px; background: #ffffff; padding: 24px; border-radius: 12px; box-shadow: 0 1px 3px 0 rgba(15, 23, 42, 0.03); border: 1px solid #e2e8f0; display: flex; align-items: center; gap: 16px; box-sizing: border-box;">
            <div style="background-color: #e0e7ff; width: 48px; height: 48px; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #4f46e5; flex-shrink: 0;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
            </div>
            <div style="min-width: 0; flex-grow: 1;">
                <span style="display: block; color: #64748b; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Total Students</span>
                <span style="color: #0f172a; font-size: 1.5rem; font-weight: 700; line-height: 1.2; display: block; margin-top: 2px;">{{ $totalStudents ?? '0' }}</span>
            </div>
        </div>

        <div class="ui-summary-card" style="flex: 1; min-width: 220px; background: #ffffff; padding: 24px; border-radius: 12px; box-shadow: 0 1px 3px 0 rgba(15, 23, 42, 0.03); border: 1px solid #e2e8f0; display: flex; align-items: center; gap: 16px; box-sizing: border-box;">
            <div style="background-color: #d1fae5; width: 48px; height: 48px; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #059669; flex-shrink: 0;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
            </div>
            <div style="min-width: 0; flex-grow: 1;">
                <span style="display: block; color: #64748b; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Active Students</span>
                <span style="color: #0f172a; font-size: 1.5rem; font-weight: 700; line-height: 1.2; display: block; margin-top: 2px;">{{ $activeCount ?? '0' }}</span>
            </div>
        </div>

        <div class="ui-summary-card" style="flex: 1; min-width: 220px; background: #ffffff; padding: 24px; border-radius: 12px; box-shadow: 0 1px 3px 0 rgba(15, 23, 42, 0.03); border: 1px solid #e2e8f0; display: flex; align-items: center; gap: 16px; box-sizing: border-box;">
            <div style="background-color: #fee2e2; width: 48px; height: 48px; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #dc2626; flex-shrink: 0;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line></svg>
            </div>
            <div style="min-width: 0; flex-grow: 1;">
                <span style="display: block; color: #64748b; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Inactive Students</span>
                <span style="color: #0f172a; font-size: 1.5rem; font-weight: 700; line-height: 1.2; display: block; margin-top: 2px;">{{ $inactiveCount ?? '0' }}</span>
            </div>
        </div>

    </div>

    <div class="split-workspace-layout" style="display: flex; flex-direction: row; gap: 24px; width: 100%; box-sizing: border-box;">
        
        <div class="panel-card" style="flex: 2; min-width: 0; background: #ffffff; border-radius: 16px; padding: 32px; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px 0 rgba(15, 23, 42, 0.02); box-sizing: border-box;">
            <h3 style="color: #0f172a; font-size: 1.1rem; font-weight: 700; margin: 0 0 4px 0; letter-spacing: -0.01em;">Students Activeness Analysis</h3>
            <p style="color: #64748b; font-size: 0.85rem; margin: 0 0 32px 0;">Visual distribution comparing active and inactive parameters across the system platform records.</p>
            
            <div style="display: flex; flex-direction: column; gap: 24px; width: 100%; box-sizing: border-box;">
                <div style="width: 100%; box-sizing: border-box;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 0.88rem; font-weight: 600;">
                        <span style="color: #334155; display: flex; align-items: center; gap: 8px;"><span style="width: 12px; height: 12px; background-color: #10b981; border-radius: 3px; display: inline-block;"></span>Active Record Sheets</span>
                        <span style="color: #0f172a;">{{ $activeCount ?? '0' }} Students</span>
                    </div>
                    <div style="width: 100%; height: 24px; background-color: #f1f5f9; border-radius: 6px; overflow: hidden;">
                        @php $activePercent = ($totalStudents > 0) ? (($activeCount / $totalStudents) * 100) : 0; @endphp
                        <div style="width: {{ $activePercent }}%; height: 100%; background-color: #10b981; border-radius: 6px; transition: width 0.6s ease;"></div>
                    </div>
                </div>

                <div style="width: 100%; box-sizing: border-box;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 0.88rem; font-weight: 600;">
                        <span style="color: #334155; display: flex; align-items: center; gap: 8px;"><span style="width: 12px; height: 12px; background-color: #ef4444; border-radius: 3px; display: inline-block;"></span>Inactive Record Sheets</span>
                        <span style="color: #0f172a;">{{ $inactiveCount ?? '0' }} Students</span>
                    </div>
                    <div style="width: 100%; height: 24px; background-color: #f1f5f9; border-radius: 6px; overflow: hidden;">
                        @php $inactivePercent = ($totalStudents > 0) ? (($inactiveCount / $totalStudents) * 100) : 0; @endphp
                        <div style="width: {{ $inactivePercent }}%; height: 100%; background-color: #ef4444; border-radius: 6px; transition: width 0.6s ease;"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel-card side-action-box" style="flex: 1; min-width: 0; background: #ffffff; border-radius: 16px; padding: 32px; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px 0 rgba(15, 23, 42, 0.02); box-sizing: border-box; display: flex; flex-direction: column; justify-content: space-between; gap: 24px;">
            <div>
                <h3 style="color: #0f172a; font-size: 1.1rem; font-weight: 700; margin: 0 0 4px 0; letter-spacing: -0.01em;">Quick Tasks</h3>
                <p style="color: #64748b; font-size: 0.85rem; margin: 0 0 20px 0;">Direct navigation access points to manage repository tables.</p>
                
                <div style="display: flex; flex-direction: column; gap: 12px; width: 100%;">
                    <a href="/students" style="display: flex; align-items: center; gap: 12px; padding: 14px 16px; background-color: #f8fafc; border: 1px solid #f1f5f9; border-radius: 8px; text-decoration: none; color: #1e293b; font-size: 0.9rem; font-weight: 600; box-sizing: border-box; transition: all 0.2s;" class="action-btn-hover">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#4f46e5" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        <span>Add New Student</span>
                    </a>

                    <a href="/profile" style="display: flex; align-items: center; gap: 12px; padding: 14px 16px; background-color: #f8fafc; border: 1px solid #f1f5f9; border-radius: 8px; text-decoration: none; color: #1e293b; font-size: 0.9rem; font-weight: 600; box-sizing: border-box; transition: all 0.2s;" class="action-btn-hover">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#475569" stroke-width="2.5"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        <span>Manage Profile</span>
                    </a>
                </div>
            </div>
            <div style="border-top: 1px solid #f1f5f9; padding-top: 16px; text-align: center;">
                <span style="font-size: 0.72rem; color: #94a3b8; font-weight: 500; letter-spacing: 0.02em;">ScholarHub Platform v1.0</span>
            </div>
        </div>

    </div>
</div>

<style>
    .action-btn-hover:hover { background-color: #f1f5f9 !important; border-color: #e2e8f0 !important; transform: translateY(-1px); }
    @media (max-width: 1024px) { .split-workspace-layout { flex-direction: column !important; gap: 20px !important; } }
    @media (max-width: 640px) {
        .app-root-container { padding: 24px 16px !important; }
        .responsive-metrics-grid { flex-direction: column !important; gap: 14px !important; }
        .ui-summary-card { width: 100% !important; }
        .panel-card { padding: 24px 20px !important; }
    }
</style>
@endsection