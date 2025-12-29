<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Services\AdmissionPdfService;
use Illuminate\Http\Request;

class AdmissionPdfController extends Controller
{
    public function generate(Student $student, AdmissionPdfService $service)
    {
        // generated file store
        $path = $service->generateAndStore($student);

        return response()->json([
            'ok' => true,
            'path' => $path,
            'url' => asset('storage/'.$path),
            'download' => route('students.admission.pdf.download', $student->id),
        ]);
    }

    public function download(Student $student, AdmissionPdfService $service)
    {
        return $service->downloadResponse($student);
    }
}
