<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const APPROVAL_STATUS_SELECT = [
        'pending_approval' => 'Pending Approval',
        'approved'         => 'Approved',
    ];

    public $table = 'projects';

    protected $dates = [
        'start_date',
        'end_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'paas_code',
        'approval_status',
        'fund_id',
        'pag_value',
        'start_date',
        'end_date',
        'lead_organisation_unit_id',
        'total_expenditure',
        'total_contribution',
        'total_psc',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function fund()
    {
        return $this->belongsTo(Fund::class, 'fund_id');
    }

    public function getStartDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getEndDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function countries()
    {
        return $this->belongsToMany(Country::class);
    }

    public function lead_organisation_unit()
    {
        return $this->belongsTo(LeadOrganisation::class, 'lead_organisation_unit_id');
    }

    public function themes()
    {
        return $this->belongsToMany(Theme::class);
    }

    public function donors()
    {
        return $this->belongsToMany(Donor::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
