<?php

namespace App\Services;

use App\Models\Student;
use App\Models\StudentAdmissionForm;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class AdmissionPdfService
{
    public function generateAndStore(Student $student): string
    {
        // ✅ Your Student model relations
        $student->load([
            'guardian',       // Step-2
            'categoryFlags',  // Step-3
            'educations',     // Step-4
            'declaration',    // Step-5
            'officeEntry',    // Step-7
            'documents',      // Step-8
            'admissionForm',  // Step-6 (paths)
        ]);

        $pdf = Pdf::loadView('pdf.admission-form', [
            'student' => $student,
        ])->setPaper('legal', 'portrait');

        $fileName = 'admission-form-' . $student->id . '.pdf';
        $path = "admission/{$student->id}/form/{$fileName}";

        Storage::disk('public')->put($path, $pdf->output());

        StudentAdmissionForm::updateOrCreate(
            ['student_id' => $student->id],
            ['generated_pdf_path' => $path]
        );

        return $path;
    }

    public function downloadResponse(Student $student)
    {
        $form = StudentAdmissionForm::where('student_id', $student->id)->first();

        if (! $form || ! $form->generated_pdf_path || ! Storage::disk('public')->exists($form->generated_pdf_path)) {
            abort(404, 'Generated PDF not found. Please generate first.');
        }

        return Storage::disk('public')->download(
            $form->generated_pdf_path,
            'Admission-Form-' . $student->id . '.pdf'
        );
    }
}
