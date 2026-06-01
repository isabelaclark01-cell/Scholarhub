@extends('layouts.main')

@section('content')
<div class="user-management-container" style="width: 100%; font-family: inherit;">
    
    <div class="header-segment" style="margin-bottom: 32px;">
        <h1 style="color: #0f172a; font-size: 1.75rem; font-weight: 700; margin: 0 0 8px 0; letter-spacing: -0.02em;">User Management</h1>
        <p style="color: #64748b; font-size: 0.95rem; margin: 0; font-weight: 400;">Review, register, modify, or terminate authorized administrator accounts.</p>
    </div>

    <div class="action-bar" style="background-color: #ffffff; border-radius: 12px; padding: 16px; border: 1px solid #e2e8f0; margin-bottom: 24px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
        <div class="search-input-wrapper" style="position: relative; flex-grow: 1; max-width: 400px; width: 100%;">
            <input type="text" id="userSearchInput" onkeyup="filterUserCards()" placeholder="Search administrators by name or email identity..." style="width: 100%; padding: 12px 16px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 0.9rem; outline: none; box-sizing: border-box; font-family: inherit; color: #334155;">
        </div>
        <button onclick="toggleUserModal('createUserModal')" style="background-color: #4f46e5; color: #ffffff; border: none; padding: 12px 24px; border-radius: 8px; font-weight: 600; font-size: 0.9rem; cursor: pointer; display: flex; align-items: center; gap: 8px; font-family: inherit; transition: background 0.2s;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><line x1="19" y1="8" x2="19" y2="14"></line><line x1="22" y1="11" x2="16" y2="11"></line></svg>
            Add New Administrator
        </button>
    </div>

    <div class="user-cards-grid" id="userCardsGrid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 100%)); gap: 20px;">
        @foreach($users as $user)
            <div class="user-card-item" data-name="{{ strtolower($user->name) }}" data-email="{{ strtolower($user->email) }}" style="background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 24px; box-sizing: border-box; display: flex; flex-direction: column; justify-content: space-between; transition: box-shadow 0.2s ease;">
                
                <div class="card-top-info" style="display: flex; align-items: center; gap: 16px; margin-bottom: 20px;">
                    <div class="user-avatar-frame" style="width: 52px; height: 52px; border-radius: 50%; background-color: #f1f5f9; display: flex; align-items: center; justify-content: center; border: 1px solid #e2e8f0; flex-shrink: 0; overflow: hidden;">
                        @if(isset($user->profile_photo_path) && $user->profile_photo_path)
                            <img src="{{ asset($user->profile_photo_path) }}" alt="Profile" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        @endif
                    </div>
                    <div class="user-metadata" style="min-width: 0;">
                        <span class="user-card-name" style="color: #0f172a; font-weight: 600; font-size: 1.05rem; display: block; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $user->name }}</span>
                        <span class="user-card-email" style="color: #64748b; font-size: 0.85rem; display: block; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; margin-top: 2px;">{{ $user->email }}</span>
                    </div>
                </div>

                <div class="card-actions-row" style="display: flex; gap: 10px; border-top: 1px solid #f1f5f9; padding-top: 16px; margin-top: auto;">
                    <button onclick="openEditModal('{{ $user->id }}', '{{ $user->name }}', '{{ $user->email }}')" style="flex: 1; background-color: #f8fafc; border: 1px solid #cbd5e1; color: #334155; padding: 10px; border-radius: 8px; font-weight: 600; font-size: 0.85rem; cursor: pointer; text-align: center; font-family: inherit;">Edit Data</button>
                    
                    @if($user->id !== auth()->id())
                        <form action="/users/{{ $user->id }}" method="POST" style="flex: 1; margin: 0;" onsubmit="return confirm('Are you sure you want to completely remove this administrator account?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="width: 100%; background-color: #fff5f5; border: 1px solid #fee2e2; color: #e11d48; padding: 10px; border-radius: 8px; font-weight: 600; font-size: 0.85rem; cursor: pointer; text-align: center; font-family: inherit;">Delete</button>
                        </form>
                    @else
                        <button disabled style="flex: 1; background-color: #f1f5f9; border: 1px solid #e2e8f0; color: #94a3b8; padding: 10px; border-radius: 8px; font-weight: 600; font-size: 0.85rem; cursor: not-allowed; text-align: center; font-family: inherit;">Active</button>
                    @endif
                </div>

            </div>
        @endforeach
    </div>
</div>

<div id="createUserModal" style="display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background-color: rgba(0,0,0,0.4); z-index: 9999; align-items: center; justify-content: center; padding: 16px; box-sizing: border-box;">
    <div style="background-color: #ffffff; border-radius: 12px; width: 100%; max-width: 460px; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1); padding: 24px; box-sizing: border-box; position: relative;">
        <h3 style="margin: 0 0 20px 0; color: #0f172a; font-size: 1.25rem; font-weight: 700;">Add New Administrator</h3>
        <form action="/users" method="POST">
            @csrf
            <div style="margin-bottom: 16px;">
                <label style="display: block; font-size: 0.85rem; font-weight: 600; color: #475569; margin-bottom: 6px;">Full Name</label>
                <input type="text" name="name" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; box-sizing: border-box; font-family: inherit;">
            </div>
            <div style="margin-bottom: 16px;">
                <label style="display: block; font-size: 0.85rem; font-weight: 600; color: #475569; margin-bottom: 6px;">Email Address</label>
                <input type="email" name="email" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; box-sizing: border-box; font-family: inherit;">
            </div>
            <div style="margin-bottom: 24px;">
                <label style="display: block; font-size: 0.85rem; font-weight: 600; color: #475569; margin-bottom: 6px;">Password Identity</label>
                <input type="password" name="password" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; box-sizing: border-box; font-family: inherit;">
            </div>
            <div style="display: flex; gap: 12px; justify-content: flex-end;">
                <button type="button" onclick="toggleUserModal('createUserModal')" style="background-color: #f1f5f9; border: 1px solid #e2e8f0; padding: 10px 16px; border-radius: 6px; font-weight: 600; font-size: 0.85rem; cursor: pointer; font-family: inherit; color: #475569;">Cancel</button>
                <button type="submit" style="background-color: #4f46e5; border: none; padding: 10px 20px; border-radius: 6px; font-weight: 600; font-size: 0.85rem; cursor: pointer; font-family: inherit; color: white;">Save Account</button>
            </div>
        </form>
    </div>
</div>

<div id="editUserModal" style="display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background-color: rgba(0,0,0,0.4); z-index: 9999; align-items: center; justify-content: center; padding: 16px; box-sizing: border-box;">
    <div style="background-color: #ffffff; border-radius: 12px; width: 100%; max-width: 460px; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1); padding: 24px; box-sizing: border-box; position: relative;">
        <h3 style="margin: 0 0 20px 0; color: #0f172a; font-size: 1.25rem; font-weight: 700;">Edit Administrator Account</h3>
        <form id="editUserForm" method="POST">
            @csrf
            @method('PUT')
            <div style="margin-bottom: 16px;">
                <label style="display: block; font-size: 0.85rem; font-weight: 600; color: #475569; margin-bottom: 6px;">Full Name</label>
                <input type="text" id="editUserName" name="name" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; box-sizing: border-box; font-family: inherit;">
            </div>
            <div style="margin-bottom: 16px;">
                <label style="display: block; font-size: 0.85rem; font-weight: 600; color: #475569; margin-bottom: 6px;">Email Address</label>
                <input type="email" id="editUserEmail" name="email" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; box-sizing: border-box; font-family: inherit;">
            </div>
            <div style="margin-bottom: 24px;">
                <label style="display: block; font-size: 0.85rem; font-weight: 600; color: #475569; margin-bottom: 6px;">New Password (Leave blank to keep current)</label>
                <input type="password" name="password" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; box-sizing: border-box; font-family: inherit;" placeholder="••••••••">
            </div>
            <div style="display: flex; gap: 12px; justify-content: flex-end;">
                <button type="button" onclick="toggleUserModal('editUserModal')" style="background-color: #f1f5f9; border: 1px solid #e2e8f0; padding: 10px 16px; border-radius: 6px; font-weight: 600; font-size: 0.85rem; cursor: pointer; font-family: inherit; color: #475569;">Cancel</button>
                <button type="submit" style="background-color: #4f46e5; border: none; padding: 10px 20px; border-radius: 6px; font-weight: 600; font-size: 0.85rem; cursor: pointer; font-family: inherit; color: white;">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleUserModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal.style.display === 'none' || modal.style.display === '') {
            modal.style.display = 'flex';
        } else {
            modal.style.display = 'none';
        }
    }

    function openEditModal(id, name, email) {
        document.getElementById('editUserForm').action = '/users/' + id;
        document.getElementById('editUserName').value = name;
        document.getElementById('editUserEmail').value = email;
        toggleUserModal('editUserModal');
    }

    function filterUserCards() {
        const value = document.getElementById('userSearchInput').value.toLowerCase();
        const cards = document.getElementsByClassName('user-card-item');

        for (let i = 0; i < cards.length; i++) {
            const name = cards[i].getAttribute('data-name');
            const email = cards[i].getAttribute('data-email');
            
            if (name.includes(value) || email.includes(value)) {
                cards[i].style.display = 'flex';
            } else {
                cards[i].style.display = 'none';
            }
        }
    }
</script>

<style>
    @media (max-width: 640px) {
        .action-bar { flex-direction: column; align-items: stretch !important; }
        .search-input-wrapper { max-width: 100% !important; }
        .user-cards-grid { grid-template-columns: 1fr !important; }
    }
</style>
@endsection