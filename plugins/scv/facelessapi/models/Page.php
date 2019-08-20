<?php namespace scv\FacelessApi\Models;

use ValidationException;
use BackendAuth;

use scv\FacelessApi\Models\FacelessAPIModel;
use scv\FacelessApi\Models\Client;
use scv\FacelessApi\Models\Template;
use scv\FacelessApi\Models\Page;

/**
 * Model
 */
class Page extends FacelessAPIModel
{
    use \October\Rain\Database\Traits\Validation;
    

    /**
     * @var string The database table used by the model.
     */
    public $table = 'scv_facelessapi_pages';
    
    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    /**
     * @var array Attach many fields
     */
    public $attachMany = [
        'preview_image' => 'System\Models\File'
    ];

    /**
     * @var array List of belongs to relationships.
     */
    public $belongsTo = [
        'client' => ['scv\FacelessApi\Models\Client'],
        'template' => ['scv\FacelessApi\Models\Template']
    ];

    /**
     * @var array Jsonable fields
     */
    public $jsonable = [
        'blocks'
    ];

    public function filterFields($fields, $context = null)
    {
        if(isset($fields->client_id)){
            if(count($this->getClientIdOptions()) <= 1){
                $fields->client_id->readOnly = true;
            }
            
            if ($context == 'update') {
                $fields->client_id->readOnly = true;
                $fields->template_id->readOnly = true;
            }
        }
    }

    /**
     * @var integer id of client if only has one user on create.
     */
    public function getClientIdAttribute($values){
        if($values==NULL){
            $client_id = Client::getClientIdAttribute($values);
    
            return  $client_id;
            
        }else{
            return $values;
        }
    }

    /**
     * @var array Clients related to login user.
     */
    public function getClientIdOptions(){
        $clients = Client::getClientIdOptions();
        return $clients;
    }

    /**
     * @var array Templates related to active client.
     */
    public function getTemplateIdOptions(){
        $templates = Template::where('client_id',$this->client_id)->pluck('name','id');
        return $templates;
    }

    /**
     * @var string Clients name.
     */
    public function getSeoAuthorAttribute(){
        if(!empty($this->seo_author)){
            return $this->seo_author;
        }else{
            return BackendAuth::getUser()->first_name." ".BackendAuth::getUser()->last_name;
        }
    }

    /**
     * @var array Blocks of the page.
     */
    public function getBlocksAttribute(){
        if(empty($this->blocks)){
            $template = Template::find($this->template_id);

            return json_encode($template->blocks);
        }else{
            return $this->blocks;
        }
    }

    /**
     * @var array Links of the pages.
     */
    public function getLinkOptions(){
        return Page::where('client_id',$this->client_id)->get()->pluck('page_selection','id');
    }

    /**
     * @var string Pages title and slug.
     */
    public function getPageSelectionAttribute()
    {
        return $this->title . ' [... /' . $this->slug."]";
    }
}
