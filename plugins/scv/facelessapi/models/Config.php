<?php namespace scv\FacelessApi\Models;

use Model;
use Lang;
use DateTime;
use DateTimeZone;
use Config as BackendConfig;

use scv\FacelessApi\Models\FacelessAPIModel;
use scv\FacelessApi\Models\Client;

/**
 * Model
 */
class Config extends FacelessAPIModel
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'scv_facelessapi_configs';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    /**
     * @var array List of belongs to relationships.
     */
    public $belongsTo = [
        'client' => ['scv\FacelessApi\Models\Client']
    ];

    // public function afterUpdate(){
    //     $client = Client::find($this->client_id);
    //     $client->key = post('Client[key]');
    //     $client->save();
    // }

    /**
     * Returns available options for the "locale" attribute.
     * @return array
     */
    public function getSiteLocaleOptions()
    {
        $localeOptions = [
            'ar'    => [Lang::get('system::lang.locale.ar'),    'flag-sa'],
            'be'    => [Lang::get('system::lang.locale.be'),    'flag-by'],
            'bg'    => [Lang::get('system::lang.locale.bg'),    'flag-bg'],
            'ca'    => [Lang::get('system::lang.locale.ca'),    'flag-es-ct'],
            'cs'    => [Lang::get('system::lang.locale.cs'),    'flag-cz'],
            'da'    => [Lang::get('system::lang.locale.da'),    'flag-dk'],
            'de'    => [Lang::get('system::lang.locale.de'),    'flag-de'],
            'el'    => [Lang::get('system::lang.locale.el'),    'flag-gr'],
            'en'    => [Lang::get('system::lang.locale.en'),    'flag-us'],
            'en-au' => [Lang::get('system::lang.locale.en-au'), 'flag-au'],
            'en-ca' => [Lang::get('system::lang.locale.en-ca'), 'flag-ca'],
            'en-gb' => [Lang::get('system::lang.locale.en-gb'), 'flag-gb'],
            'es'    => [Lang::get('system::lang.locale.es'),    'flag-es'],
            'es-ar' => [Lang::get('system::lang.locale.es-ar'), 'flag-ar'],
            'et'    => [Lang::get('system::lang.locale.et'),    'flag-ee'],
            'fa'    => [Lang::get('system::lang.locale.fa'),    'flag-ir'],
            'fi'    => [Lang::get('system::lang.locale.fi'),    'flag-fi'],
            'fr'    => [Lang::get('system::lang.locale.fr'),    'flag-fr'],
            'fr-ca' => [Lang::get('system::lang.locale.fr-ca'), 'flag-ca'],
            'hu'    => [Lang::get('system::lang.locale.hu'),    'flag-hu'],
            'id'    => [Lang::get('system::lang.locale.id'),    'flag-id'],
            'it'    => [Lang::get('system::lang.locale.it'),    'flag-it'],
            'ja'    => [Lang::get('system::lang.locale.ja'),    'flag-jp'],
            'kr'    => [Lang::get('system::lang.locale.kr'),    'flag-kr'],
            'lt'    => [Lang::get('system::lang.locale.lt'),    'flag-lt'],
            'lv'    => [Lang::get('system::lang.locale.lv'),    'flag-lv'],
            'nb-no' => [Lang::get('system::lang.locale.nb-no'), 'flag-no'],
            'nl'    => [Lang::get('system::lang.locale.nl'),    'flag-nl'],
            'pl'    => [Lang::get('system::lang.locale.pl'),    'flag-pl'],
            'pt-br' => [Lang::get('system::lang.locale.pt-br'), 'flag-br'],
            'pt-pt' => [Lang::get('system::lang.locale.pt-pt'), 'flag-pt'],
            'ro'    => [Lang::get('system::lang.locale.ro'),    'flag-ro'],
            'ru'    => [Lang::get('system::lang.locale.ru'),    'flag-ru'],
            'sk'    => [Lang::get('system::lang.locale.sk'),    'flag-sk'],
            'sv'    => [Lang::get('system::lang.locale.sv'),    'flag-se'],
            'tr'    => [Lang::get('system::lang.locale.tr'),    'flag-tr'],
            'uk'    => [Lang::get('system::lang.locale.uk'),    'flag-ua'],
            'vn'    => [Lang::get('system::lang.locale.vn'),    'flag-vn'],
            'zh-cn' => [Lang::get('system::lang.locale.zh-cn'), 'flag-cn'],
            'zh-tw' => [Lang::get('system::lang.locale.zh-tw'), 'flag-tw'],
        ];

        $locales = BackendConfig::get('app.localeOptions', $localeOptions);

        // Sort locales alphabetically
        asort($locales);

        return $locales;
    }

    /**
     * Returns all available timezone options.
     * @return array
     */
    public function getSiteTimezoneOptions()
    {
        $timezoneIdentifiers = DateTimeZone::listIdentifiers();
        $utcTime = new DateTime('now', new DateTimeZone('UTC'));

        $tempTimezones = [];
        foreach ($timezoneIdentifiers as $timezoneIdentifier) {
            $currentTimezone = new DateTimeZone($timezoneIdentifier);

            $tempTimezones[] = [
                'offset' => (int) $currentTimezone->getOffset($utcTime),
                'identifier' => $timezoneIdentifier
            ];
        }

        // Sort the array by offset, identifier ascending
        usort($tempTimezones, function ($a, $b) {
            return $a['offset'] === $b['offset']
                ? strcmp($a['identifier'], $b['identifier'])
                : $a['offset'] - $b['offset'];
        });

        $timezoneList = [];
        foreach ($tempTimezones as $tz) {
            $sign = $tz['offset'] > 0 ? '+' : '-';
            $offset = gmdate('H:i', abs($tz['offset']));
            $timezoneList[$tz['identifier']] = '(UTC ' . $sign . $offset . ') ' . $tz['identifier'];
        }

        return $timezoneList;
    }
}
