<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $fillable = [
        'title',
        'date_key',
        'ussd_code',
        'adj_amt',
        'partner_name',
        'opening_balance',
        'used',
        'closing_balance',
        'expiry_date',
    ];

    // Extract and return 'DATE KEY' value from content
    public function getDateKeyAttribute()
    {
        return $this->extractValueFromContent('DATE KEY');
    }

    public function getUssdCodeAttribute()
    {
        return $this->extractValueFromContent('USSD_CODE');
    }

    public function getAdjAmtAttribute()
    {
        return $this->extractValueFromContent('ADJ AMT');
    }

    public function getPartnerNameAttribute()
    {
        return $this->extractValueFromContent('PARTNER NAME');
    }

    public function getOpeningBalanceAttribute()
    {
        return $this->extractValueFromContent('OPENING BALANCE');
    }

    public function getUsedAttribute()
    {
        return $this->extractValueFromContent('USED');
    }

    public function getClosingBalanceAttribute()
    {
        return $this->extractValueFromContent('CLOSING BALANCE');
    }

    public function getExpiryDateAttribute()
    {
        return $this->extractValueFromContent('EXPIRY DATE');
    }

    private function extractValueFromContent($key)
    {
        $lines = explode("\n", $this->content);
        foreach ($lines as $line) {
            if (strpos($line, $key) !== false) {
                return trim(str_replace($key, '', $line));
            }
        }
        return null;
    }
}
