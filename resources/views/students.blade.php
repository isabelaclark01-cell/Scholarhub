@extends('layouts.main')

@section('content')
<div class="app-root-container" style="padding: 40px 24px; background-color: #f8fafc; min-height: 100vh; width: 100%; box-sizing: border-box; font-family: system-ui, -apple-system, sans-serif;">
    
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 28px; gap: 16px; flex-wrap: wrap; width: 100%; box-sizing: border-box;">
        <div>
            <h1 style="color: #0f172a; font-size: 1.75rem; font-weight: 700; margin: 0 0 6px 0; letter-spacing: -0.02em;">Student Records</h1>
            <p style="color: #64748b; font-size: 0.9rem; margin: 0;">Review, modify, filter, or purge registered student files from ScholarHub.</p>
        </div>
        <button onclick="toggleModal('addStudentModal', true)" style="display: flex; align-items: center; gap: 8px; padding: 12px 20px; background-color: #4f46e5; border: none; border-radius: 8px; color: #ffffff; font-size: 0.9rem; font-weight: 600; cursor: pointer; box-shadow: 0 1px 3px 0 rgba(79, 70, 229, 0.2); transition: background-color 0.2s;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            Add New Student
        </button>
    </div>

    <div style="background: #ffffff; border-radius: 12px; padding: 16px; border: 1px solid #e2e8f0; margin-bottom: 24px; box-sizing: border-box;">
        <div style="position: relative; width: 100%; max-width: 360px;">
            <span style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #94a3b8; display: flex; align-items: center;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            </span>
            <input type="text" id="recordSearchBox" onkeyup="filterRecordSheets()" placeholder="Search names, courses, or IDs..." style="width: 100%; padding: 10px 16px 10px 42px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.9rem; color: #1e293b; outline: none; box-sizing: border-box;">
        </div>
    </div>

    <div class="table-view-card" style="background: #ffffff; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px 0 rgba(15, 23, 42, 0.02); width: 100%; overflow: hidden; box-sizing: border-box;">
        <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.9rem;">
            <thead>
                <tr style="background-color: #f8fafc; border-bottom: 1px solid #e2e8f0; color: #475569; font-weight: 600;">
                    <th style="padding: 16px 20px;">Student ID</th>
                    <th style="padding: 16px 20px;">Full Name</th>
                    <th style="padding: 16px 20px;">Course Pathway</th>
                    <th style="padding: 16px 20px;">Year Level</th>
                    <th style="padding: 16px 20px;">Activeness Status</th>
                    <th style="padding: 16px 20px; text-align: right;">Actions Menu</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $student)
                <tr class="student-row-item" style="border-bottom: 1px solid #f1f5f9; color: #334155;">
                    <td style="padding: 16px 20px; font-weight: 600; color: #0f172a;">{{ $student->student_id }}</td>
                    <td style="padding: 16px 20px; font-weight: 500;">{{ $student->name }}</td>
                    <td style="padding: 16px 20px;">{{ $student->course }}</td>
                    <td style="padding: 16px 20px;"><span style="background: #f1f5f9; padding: 4px 8px; border-radius: 6px; font-size: 0.82rem; font-weight: 500; color: #475569;">Year {{ $student->year }}</span></td>
                    <td style="padding: 16px 20px;">
                        <span style="display: inline-flex; align-items: center; gap: 6px; padding: 4px 10px; border-radius: 9999px; font-size: 0.78rem; font-weight: 600; {{ $student->status === 'Active' ? 'background-color: #d1fae5; color: #065f46;' : 'background-color: #fee2e2; color: #991b1b;' }}">
                            <span style="width: 6px; height: 6px; border-radius: 50%; {{ $student->status === 'Active' ? 'background-color: #10b981;' : 'background-color: #ef4444;' }}"></span> {{ $student->status }}
                        </span>
                    </td>
                    <td style="padding: 16px 20px; text-align: right;">
                        <div style="display: flex; gap: 8px; justify-content: flex-end; align-items: center;">
                            <button onclick="openEditModal({{ json_encode($student) }})" style="background: none; border: 1px solid #cbd5e1; padding: 6px 12px; font-size: 0.82rem; font-weight: 600; color: #475569; border-radius: 6px; cursor: pointer;">Edit</button>
                            <form action="/students/{{ $student->id }}" method="POST" onsubmit="return confirm('Erase student record?');" style="margin: 0;">
                                @csrf @method('DELETE')
                                <button type="submit" style="background: none; border: 1px solid #fee2e2; padding: 6px 12px; font-size: 0.82rem; font-weight: 600; color: #dc2626; border-radius: 6px; cursor: pointer;">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" style="padding: 40px; text-align: center; color: #94a3b8;">No student files discovered.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mobile-cards-view" style="display: none; flex-direction: column; gap: 16px; width: 100%; box-sizing: border-box;">
        @foreach($students as $student)
        <div class="mobile-record-card" data-search-string="{{ strtolower($student->name . ' ' . $student->student_id . ' ' . $student->course) }}" style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 20px; box-sizing: border-box;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                <div>
                    <span style="font-size: 0.75rem; color: #64748b; font-weight: 700; text-transform: uppercase;">{{ $student->student_id }}</span>
                    <h4 style="margin: 2px 0 0 0; color: #0f172a; font-size: 1.05rem; font-weight: 700;">{{ $student->name }}</h4>
                </div>
                <span style="padding: 4px 10px; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; {{ $student->status === 'Active' ? 'background-color: #d1fae5; color: #065f46;' : 'background-color: #fee2e2; color: #991b1b;' }}">{{ $student->status }}</span>
            </div>
            <div style="border-top: 1px solid #f1f5f9; border-bottom: 1px solid #f1f5f9; padding: 12px 0; margin-bottom: 16px; font-size: 0.88rem; color: #475569; display: flex; flex-direction: column; gap: 4px;">
                <div><strong>Course:</strong> {{ $student->course }}</div>
                <div><strong>Year Level:</strong> Year {{ $student->year }}</div>
            </div>
            <div style="display: flex; gap: 8px; justify-content: flex-end; width: 100%;">
                <button onclick="openEditModal({{ json_encode($student) }})" style="flex: 1; background: none; border: 1px solid #cbd5e1; padding: 10px; font-size: 0.85rem; font-weight: 600; color: #475569; border-radius: 8px; cursor: pointer;">Edit Data</button>
                <form action="/students/{{ $student->id }}" method="POST" onsubmit="return confirm('Erase student record?');" style="flex: 1; margin: 0;">
                    @csrf @method('DELETE')
                    <button type="submit" style="width: 100%; background: none; border: 1px solid #fee2e2; padding: 10px; font-size: 0.85rem; font-weight: 600; color: #dc2626; border-radius: 8px; cursor: pointer;">Delete</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>

</div>

<div id="addStudentModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(15, 23, 42, 0.4); backdrop-filter: blur(4px); z-index: 9999; justify-content: center; align-items: center; padding: 16px; box-sizing: border-box;">
    <div style="background-color: #ffffff; width: 100%; max-width: 480px; border-radius: 16px; overflow: hidden; box-sizing: border-box;">
        <div style="padding: 24px 24px 16px 24px; border-bottom: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center;">
            <h3 style="margin: 0; color: #0f172a; font-size: 1.15rem; font-weight: 700;">Add New Student File</h3>
            <button onclick="toggleModal('addStudentModal', false)" style="background: none; border: none; color: #94a3b8; font-size: 1.4rem; cursor: pointer;">&times;</button>
        </div>
        <form action="/students" method="POST" style="padding: 24px; display: flex; flex-direction: column; gap: 16px; margin: 0;">
            @csrf
            <div>
                <label style="display: block; font-size: 0.82rem; font-weight: 600; color: #475569; margin-bottom: 6px;">Full Student Name</label>
                <input type="text" name="name" required placeholder="Clark Isabela" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.9rem; box-sizing: border-box;">
            </div>
            <div>
                <label style="display: block; font-size: 0.82rem; font-weight: 600; color: #475569; margin-bottom: 6px;">Student ID Number</label>
                <input type="text" name="student_id" required placeholder="230100000" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.9rem; box-sizing: border-box;">
            </div>
            <div>
                <label style="display: block; font-size: 0.82rem; font-weight: 600; color: #475569; margin-bottom: 6px;">Program</label>
                <select name="course" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.9rem; background-color: #fff; box-sizing: border-box;">
                    <option value="" disabled selected hidden>Select Program Track</option>
                    <option value="BSIT">BSIT (Bachelor of Science in Information Technology)</option>
                    <option value="BSHM">BSHM (Bachelor of Science in Hospitality Management)</option>
                    <option value="BSE">BSE (Bachelor of Secondary Education)</option>
                    <option value="BSCS">BSCS (Bachelor of Science in Computer Science)</option>
                    <option value="BSBA">BSBA (Bachelor of Science in Business Administration)</option>
                    <option value="BSIndT">BSIndT (Bachelor of Science in Industrial Technology)</option>
                </select>
            </div>
            <div style="display: flex; gap: 16px; width: 100%;">
                <div style="flex: 1;">
                    <label style="display: block; font-size: 0.82rem; font-weight: 600; color: #475569; margin-bottom: 6px;">Year Standing</label>
                    <select name="year" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.9rem; background-color: #fff; box-sizing: border-box;">
                        <option value="1">1st Year</option><option value="2">2nd Year</option><option value="3">3rd Year</option><option value="4">4th Year</option>
                    </select>
                </div>
                <div style="flex: 1;">
                    <label style="display: block; font-size: 0.82rem; font-weight: 600; color: #475569; margin-bottom: 6px;">System Status</label>
                    <select name="status" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.9rem; background-color: #fff; box-sizing: border-box;">
                        <option value="Active">Active</option><option value="Inactive">Inactive</option>
                    </select>
                </div>
            </div>
            <div style="margin-top: 12px; display: flex; gap: 12px; justify-content: flex-end;">
                <button type="button" onclick="toggleModal('addStudentModal', false)" style="padding: 10px 16px; background: none; border: 1px solid #cbd5e1; border-radius: 6px; color: #475569; font-weight: 600; cursor: pointer;">Cancel</button>
                <button type="submit" style="padding: 10px 20px; background-color: #4f46e5; border: none; border-radius: 6px; color: #ffffff; font-weight: 600; cursor: pointer;">Save Record</button>
            </div>
        </form>
    </div>
</div>

<div id="editStudentModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(15, 23, 42, 0.4); backdrop-filter: blur(4px); z-index: 9999; justify-content: center; align-items: center; padding: 16px; box-sizing: border-box;">
    <div style="background-color: #ffffff; width: 100%; max-width: 480px; border-radius: 16px; overflow: hidden; box-sizing: border-box;">
        <div style="padding: 24px 24px 16px 24px; border-bottom: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center;">
            <h3 style="margin: 0; color: #0f172a; font-size: 1.15rem; font-weight: 700;">Modify Student Profile</h3>
            <button onclick="toggleModal('editStudentModal', false)" style="background: none; border: none; color: #94a3b8; font-size: 1.4rem; cursor: pointer;">&times;</button>
        </div>
        <form id="editFormStructure" method="POST" style="padding: 24px; display: flex; flex-direction: column; gap: 16px; margin: 0;">
            @csrf @method('PUT')
            <div>
                <label style="display: block; font-size: 0.82rem; font-weight: 600; color: #475569; margin-bottom: 6px;">Full Student Name</label>
                <input type="text" id="edit_name" name="name" required placeholder="Clark Isabela" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.9rem; box-sizing: border-box;">
            </div>
            <div>
                <label style="display: block; font-size: 0.82rem; font-weight: 600; color: #475569; margin-bottom: 6px;">Student ID Number</label>
                <input type="text" id="edit_student_id" name="student_id" required placeholder="230100000" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.9rem; box-sizing: border-box;">
            </div>
            <div>
                <label style="display: block; font-size: 0.82rem; font-weight: 600; color: #475569; margin-bottom: 6px;">Program</label>
                <select id="edit_course" name="course" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.9rem; background-color: #fff; box-sizing: border-box;">
                    <option value="" disabled selected hidden>Select Program Track</option>
                    <option value="BSIT">BSIT (Bachelor of Science in Information Technology)</option>
                    <option value="BSHM">BSHM (Bachelor of Science in Hospitality Management)</option>
                    <option value="BSE">BSE (Bachelor of Secondary Education)</option>
                    <option value="BSCS">BSCS (Bachelor of Science in Computer Science)</option>
                    <option value="BSBA">BSBA (Bachelor of Science in Business Administration)</option>
                    <option value="BSIndT">BSIndT (Bachelor of Science in Industrial Technology)</option>
                </select>
            </div>
            <div style="display: flex; gap: 16px; width: 100%;">
                <div style="flex: 1;">
                    <label style="display: block; font-size: 0.82rem; font-weight: 600; color: #475569; margin-bottom: 6px;">Year Standing</label>
                    <select id="edit_year" name="year" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.9rem; background-color: #fff; box-sizing: border-box;">
                        <option value="" disabled selected hidden>Select Year</option>
                        <option value="1">1st Year</option>
                        <option value="2">2nd Year</option>
                        <option value="3">3rd Year</option>
                        <option value="4">4th Year</option>
                    </select>
                </div>
                <div style="flex: 1;">
                    <label style="display: block; font-size: 0.82rem; font-weight: 600; color: #475569; margin-bottom: 6px;">System Status</label>
                    <select id="edit_status" name="status" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.9rem; background-color: #fff; box-sizing: border-box;">
                        <option value="" disabled selected hidden>Select Status</option>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                </div>
            </div>
            <div style="margin-top: 12px; display: flex; gap: 12px; justify-content: flex-end;">
                <button type="button" onclick="toggleModal('editStudentModal', false)" style="padding: 10px 16px; background: none; border: 1px solid #cbd5e1; border-radius: 6px; color: #475569; font-weight: 600; cursor: pointer;">Cancel</button>
                <button type="submit" style="padding: 10px 20px; background-color: #4f46e5; border: none; border-radius: 6px; color: #ffffff; font-weight: 600; cursor: pointer;">Update Changes</button>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleModal(modalId, flag) {
        const el = document.getElementById(modalId);
        if (el) el.style.display = flag ? 'flex' : 'none';
    }
    function openEditModal(obj) {
        document.getElementById('editFormStructure').action = '/students/' + obj.id;
        document.getElementById('edit_name').value = obj.name;
        document.getElementById('edit_student_id').value = obj.student_id;
        document.getElementById('edit_course').value = obj.course;
        document.getElementById('edit_year').value = obj.year;
        document.getElementById('edit_status').value = obj.status;
        toggleModal('editStudentModal', true);
    }
    function filterRecordSheets() {
        const val = document.getElementById('recordSearchBox').value.toLowerCase();
        document.querySelectorAll('.student-row-item').forEach(row => {
            row.style.display = row.textContent.toLowerCase().includes(val) ? '' : 'none';
        });
        document.querySelectorAll('.mobile-record-card').forEach(card => {
            card.style.display = card.getAttribute('data-search-string').includes(val) ? 'flex' : 'none';
        });
    }
</script>
@endsection