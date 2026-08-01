<?php

namespace App\Models;

use Database\Factories\SubmissionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    /** @use HasFactory<SubmissionFactory> */
    use HasFactory;

    public const DOCUMENT_TYPES = [
        'resume' => 'Resume',
        'cover_letter' => 'Cover Letter',
    ];

    public const MODES = [
        'feedback' => 'Give me feedback',
        'rewrite' => 'Rewrite it for me',
    ];

    protected $fillable = [
        'document_type',
        'target_role',
        'mode',
        'input_text',
        'ai_output',
    ];

    public function documentTypeLabel(): string
    {
        return self::DOCUMENT_TYPES[$this->document_type] ?? $this->document_type;
    }

    public function modeLabel(): string
    {
        return self::MODES[$this->mode] ?? $this->mode;
    }

    public function excerpt(int $length = 120): string
    {
        return str($this->input_text)->squish()->limit($length)->value();
    }
}
