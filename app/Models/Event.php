<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'description', 'category_id', 'image_poster', 'date_post', 'registration_start_date',
        'registration_end_date', 'announcement_date', 'event_start_date', 'event_end_date',
        'event_latitude', 'event_longitude', 'document_payment', 'result','certificate_file', 'user_id', 'location_detail', 'contact', 'location_name', 'question'
    ];


    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function eventImage(): HasMany
    {
        return $this->hasMany(EventImage::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function team(): HasMany
    {
        return $this->hasMany(Team::class);
    }

    public function kanban(): HasOne
    {
        return $this->hasOne(Kanban::class);
    }

    public function userEventApprove(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_event_approve', 'event_id', 'user_id')->withPivot('status');
    }

    public function userTeam(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'Team_Event', 'event_id', 'user_id');
    }

    public function getApplicants(): Collection
    {
        return Question::getUsersByEvent($this);
    }

    public function questionName(): BelongsToMany
    {
        return  $this->belongsToMany(QuestionName::class, 'questions', 'event_id', 'question_name_id');
    }

    public function isThisUserAnswered(User $user): bool
    {
        foreach ($this->questionName as $questionName) {
            if ($questionName == null) return false;
            if ($questionName->questionAnswer->where('user_id', $user->id)->count() > 0) return true;
        }
        return false;
    }
}
