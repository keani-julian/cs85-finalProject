<?php

namespace App\Http\Controllers;

use App\Http\Requests\CoachRequest;
use App\Models\Submission;
use App\Services\CareerCoachService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Throwable;

class CoachController extends Controller
{
    public function create(): View
    {
        return view('coach.create', [
            'documentTypes' => Submission::DOCUMENT_TYPES,
            'modes' => Submission::MODES,
        ]);
    }

    public function store(CoachRequest $request, CareerCoachService $coach): RedirectResponse
    {
        $validated = $request->validated();

        try {
            $output = $coach->coach(
                $validated['document_type'],
                $validated['target_role'],
                $validated['mode'],
                $validated['input_text'],
            );
        } catch (Throwable $e) {
            return back()
                ->withInput()
                ->withErrors(['ai' => $e->getMessage()]);
        }

        $submission = Submission::create([
            ...$validated,
            'ai_output' => $output,
        ]);

        return redirect()->route('coach.show', $submission);
    }

    public function show(Submission $submission): View
    {
        return view('coach.show', ['submission' => $submission]);
    }

    public function index(): View
    {
        return view('coach.index', [
            'submissions' => Submission::latest()->paginate(10),
        ]);
    }

    public function destroy(Submission $submission): RedirectResponse
    {
        $submission->delete();

        return redirect()
            ->route('coach.index')
            ->with('status', 'Submission deleted.');
    }
}
