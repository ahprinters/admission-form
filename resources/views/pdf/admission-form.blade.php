<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admission Form</title>
    <style>
        @page { size: legal portrait; margin: 18px; }
        body { font-family: DejaVu Sans, sans-serif; font-size: 11px; color: #111; }
        .title { font-size: 16px; font-weight: 700; text-align:center; margin-bottom: 8px; }
        .sub { text-align:center; font-size: 11px; margin-bottom: 14px; }
        .box { border:1px solid #333; padding:8px; margin-bottom:10px; border-radius: 4px; }
        table { width:100%; border-collapse: collapse; }
        td, th { border:1px solid #333; padding:6px; vertical-align: top; }
        .no-border td, .no-border th { border:none; }
        .label { width: 28%; font-weight: 700; }
        .sig { height: 55px; border:1px dashed #555; }
        .muted { color:#444; font-size: 10px; }
    </style>
</head>
<body>

<div class="title">ভর্তি ফরম (Admission Form)</div>
<div class="sub muted">
    Student ID: {{ $student->id }} |
    Status: {{ $student->status ?? 'draft' }}
</div>

{{-- Step-1 Personal --}}
<div class="box">
    <div style="font-weight:700; margin-bottom:6px;">১) Personal Information</div>
    <table>
        <tr>
            <td class="label">Name (English)</td>
            <td>{{ $student->name_en }}</td>
            <td class="label">Name (Bangla)</td>
            <td>{{ $student->name_bn }}</td>
        </tr>
        <tr>
            <td class="label">Email</td>
            <td>{{ $student->email }}</td>
            <td class="label">Phone</td>
            <td>{{ $student->phone }}</td>
        </tr>
        <tr>
            <td class="label">Class</td>
            <td>{{ $student->class }}</td>
            <td class="label">Roll</td>
            <td>{{ $student->roll_number }}</td>
        </tr>
        <tr>
            <td class="label">Gender</td>
            <td>{{ $student->gender }}</td>
            <td class="label">DOB</td>
            <td>{{ $student->date_of_birth }}</td>
        </tr>
        <tr>
            <td class="label">Blood Group</td>
            <td>{{ $student->blood_group }}</td>
            <td class="label">Religion</td>
            <td>{{ $student->religion }}</td>
        </tr>
        <tr>
            <td class="label">Address</td>
            <td colspan="3">{{ $student->address }}</td>
        </tr>
    </table>
</div>

{{-- Step-2 Guardian --}}
<div class="box">
    <div style="font-weight:700; margin-bottom:6px;">২) Guardian Information</div>

    @php $g = $student->guardian; @endphp

    <table>
        <tr>
            <td class="label">Father (EN)</td>
            <td>{{ $g->father_name_en ?? '' }}</td>
            <td class="label">Father (BN)</td>
            <td>{{ $g->father_name_bn ?? '' }}</td>
        </tr>
        <tr>
            <td class="label">Father Mobile</td>
            <td>{{ $g->father_mobile ?? '' }}</td>
            <td class="label">Mother (EN)</td>
            <td>{{ $g->mother_name_en ?? '' }}</td>
        </tr>
        <tr>
            <td class="label">Mother (BN)</td>
            <td>{{ $g->mother_name_bn ?? '' }}</td>
            <td class="label">Mother Mobile</td>
            <td>{{ $g->mother_mobile ?? '' }}</td>
        </tr>
        <tr>
            <td class="label">Guardian Name</td>
            <td>{{ $g->guardian_name ?? '' }}</td>
            <td class="label">Relation</td>
            <td>{{ $g->guardian_relation ?? '' }}</td>
        </tr>
        <tr>
            <td class="label">Guardian Mobile</td>
            <td>{{ $g->guardian_mobile ?? '' }}</td>
            <td class="label">WhatsApp</td>
            <td>{{ $g->whatsapp ?? '' }}</td>
        </tr>
    </table>
</div>

{{-- Step-3 Categories --}}
<div class="box">
    <div style="font-weight:700; margin-bottom:6px;">৩) Category (Tick)</div>

    @php
        // যদি categories relation এ array থাকে: ['worker','landless',...]
        $cats = $student->categories ?? collect();
    @endphp

    <table class="no-border">
        <tr>
            <td class="no-border">
                ✓ কর্মজীবী: {{ $cats->contains('worker') ? 'হ্যাঁ' : 'না' }} |
                ✓ ভূমিহীন: {{ $cats->contains('landless') ? 'হ্যাঁ' : 'না' }} |
                ✓ পোষ্য: {{ $cats->contains('dependent') ? 'হ্যাঁ' : 'না' }} |
                ✓ মুক্তিযোদ্ধা পোষ্য: {{ $cats->contains('freedom_fighter_dependent') ? 'হ্যাঁ' : 'না' }} |
                ✓ প্রতিবন্ধী: {{ $cats->contains('disabled') ? 'হ্যাঁ' : 'না' }} |
                ✓ এতিম: {{ $cats->contains('orphan') ? 'হ্যাঁ' : 'না' }} |
                ✓ উপজাতি: {{ $cats->contains('tribal') ? 'হ্যাঁ' : 'না' }} |
                ✓ কোনটিই নয়: {{ $cats->contains('none') ? 'হ্যাঁ' : 'না' }}
            </td>
        </tr>
    </table>
</div>

{{-- Step-4 Previous Education --}}
<div class="box">
    <div style="font-weight:700; margin-bottom:6px;">৪) Previous Study</div>

    <table>
        <thead>
            <tr>
                <th>Institution</th>
                <th>Class</th>
                <th>Pass Year</th>
                <th>GPA</th>
                <th>TC No</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
        @forelse(($student->previousEducations ?? []) as $e)
            <tr>
                <td>{{ $e->institution_name ?? '' }}</td>
                <td>{{ $e->class ?? '' }}</td>
                <td>{{ $e->pass_year ?? '' }}</td>
                <td>{{ $e->gpa ?? '' }}</td>
                <td>{{ $e->tc_number ?? '' }}</td>
                <td>{{ $e->tc_date ?? '' }}</td>
            </tr>
        @empty
            <tr><td colspan="6">No previous record</td></tr>
        @endforelse
        </tbody>
    </table>
</div>

{{-- Step-5 Declaration + Signature --}}
<div class="box">
    <div style="font-weight:700; margin-bottom:6px;">৫) Commitment & Declaration</div>

    <table>
        <tr>
            <td class="label">Student Commitment</td>
            <td>{{ $student->declaration->student_commitment ?? '' }}</td>
        </tr>
        <tr>
            <td class="label">Guardian Declaration</td>
            <td>{{ $student->declaration->guardian_declaration ?? '' }}</td>
        </tr>
    </table>

    <table class="no-border" style="margin-top:10px;">
        <tr>
            <td class="no-border" style="width:33%;">
                <div class="muted">Student Signature</div>
                <div class="sig"></div>
            </td>
            <td class="no-border" style="width:33%;">
                <div class="muted">Guardian Signature</div>
                <div class="sig"></div>
            </td>
            <td class="no-border" style="width:34%;">
                <div class="muted">Office Signature</div>
                <div class="sig"></div>
            </td>
        </tr>
    </table>
</div>

{{-- Step-7 Office --}}
<div class="box">
    <div style="font-weight:700; margin-bottom:6px;">৭) Office Use</div>

    @php $o = $student->officeEntry; @endphp

    <table>
        <tr>
            <td class="label">Class Teacher</td>
            <td>{{ $o->class_teacher_name ?? '' }}</td>
            <td class="label">Accountant</td>
            <td>{{ $o->accountant_name ?? '' }}</td>
        </tr>
        <tr>
            <td class="label">Session Fee</td>
            <td>{{ $o->session_fee ?? '' }}</td>
            <td class="label">Admission Fee</td>
            <td>{{ $o->admission_fee ?? '' }}</td>
        </tr>
        <tr>
            <td class="label">Monthly Fee (Jan)</td>
            <td>{{ $o->monthly_fee_jan ?? '' }}</td>
            <td class="label">Misc</td>
            <td>{{ $o->misc_fee ?? '' }}</td>
        </tr>
        <tr>
            <td class="label">Principal Comment</td>
            <td colspan="3">{{ $o->principal_comment ?? '' }}</td>
        </tr>
    </table>

    <table class="no-border" style="margin-top:10px;">
        <tr>
            <td class="no-border" style="width:33%;">
                <div class="muted">Class Teacher Sign</div>
                <div class="sig"></div>
            </td>
            <td class="no-border" style="width:33%;">
                <div class="muted">Accountant Sign</div>
                <div class="sig"></div>
            </td>
            <td class="no-border" style="width:34%;">
                <div class="muted">Principal Sign</div>
                <div class="sig"></div>
            </td>
        </tr>
    </table>
</div>

<div class="muted" style="text-align:center;">
    Generated at: {{ now() }}
</div>

</body>
</html>
