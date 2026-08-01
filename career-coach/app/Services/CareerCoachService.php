<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

class CareerCoachService
{
    public function coach(string $documentType, string $targetRole, string $mode, string $inputText): string
    {
        $response = Http::timeout(60)
            ->withHeaders([
                'x-goog-api-key' => config('services.gemini.key'),
                'Content-Type' => 'application/json',
            ])
            ->post(config('services.gemini.url').'/models/'.config('services.gemini.model').':generateContent', [
                'systemInstruction' => [
                    'parts' => [['text' => $this->buildRole($mode)]],
                ],
                'contents' => [
                    ['parts' => [['text' => $this->buildPrompt($documentType, $targetRole, $mode, $inputText)]]],
                ],
                'generationConfig' => [
                    'temperature' => 0.6,
                    'maxOutputTokens' => 4096,
                ],
            ]);

        if (! $response->successful()) {
            Log::error('Gemini request failed', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            throw new RuntimeException($this->friendlyError($response->status()));
        }

        $text = $response['candidates'][0]['content']['parts'][0]['text'] ?? null;

        if (blank($text)) {
            Log::error('Gemini returned an empty response', ['body' => $response->body()]);

            throw new RuntimeException('The AI returned an empty response. Please try again.');
        }

        return trim($text);
    }

    private function buildRole(string $mode): string
    {
        return match ($mode) {
            'rewrite' => 'You are an experienced career coach and professional resume writer. You rewrite job application documents so they are specific, results-oriented, and free of filler, while keeping every claim truthful to what the candidate actually wrote. You never invent employers, dates, degrees, or metrics.',
            default => 'You are an experienced career coach who reviews job application documents. You are encouraging but direct, and your advice is concrete and actionable rather than generic. You never invent facts about the candidate.',
        };
    }

    private function buildPrompt(string $documentType, string $targetRole, string $mode, string $inputText): string
    {
        $label = $documentType === 'cover_letter' ? 'cover letter' : 'resume';

        $task = match ($mode) {
            'rewrite' => "Rewrite the {$label} below so it is stronger for a {$targetRole} role. Keep every fact truthful to the original: do not add employers, dates, degrees, certifications, or numbers that are not already there. If a bullet is vague and you cannot strengthen it without inventing detail, mark it with [ADD DETAIL] so the candidate knows to fill it in. Return the rewritten {$label} first, then a short section titled 'What I changed' with 3-5 bullets.",
            default => "Review the {$label} below for someone targeting a {$targetRole} role. Return your response in four sections with these exact headings: 'Strengths' (2-3 bullets), 'Biggest problems' (3-5 bullets, most important first), 'Line edits' (quote the original text, then show a stronger version), and 'Next step' (one specific thing to do first). Be concrete and reference the actual content rather than giving generic advice.",
        };

        return $task."\n\n---\n\n".$inputText;
    }

    private function friendlyError(int $status): string
    {
        return match ($status) {
            429 => 'The AI is rate limited right now. Wait a moment and try again.',
            401, 403 => 'The AI rejected the API key. Check your GEMINI_API_KEY in .env.',
            default => 'The AI request failed. Please try again.',
        };
    }
}
