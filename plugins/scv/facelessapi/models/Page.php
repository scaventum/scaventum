<?php namespace scv\FacelessApi\Models;

use Illuminate\Support\Str;
use ValidationException;
use BackendAuth;

use scv\FacelessApi\Models\FacelessAPIModel;
use scv\FacelessApi\Models\Client;
use scv\FacelessApi\Models\Template;
use scv\FacelessApi\Models\Category;
use scv\FacelessApi\Models\PageCategory;

/**
 * Model
 */
class Page extends FacelessAPIModel
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\Nullable;

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
     * @var array List of has many relationships.
     */
    public $hasMany = [
        'children' => ['scv\FacelessApi\Models\Page']
    ];

    /**
     * @var array List of belongs to relationships.
     */
    public $belongsTo = [
        'client' => ['scv\FacelessApi\Models\Client'],
        'template' => ['scv\FacelessApi\Models\Template'],
        'parent' => ['scv\FacelessApi\Models\Page']
    ];

    public $belongsToMany = [
        'categories' => ['scv\FacelessApi\Models\Category','table' => 'scv_facelessapi_page_categories']
    ];

    /**
     * @var array Jsonable fields
     */
    public $jsonable = [
        'blocks'
    ];

    /**
     * @var array Nullable attributes.
     */
    protected $nullable = [
        'parent_id',
        'seo_keywords'
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

    public function afterSave(){
        
        $categories = [];
        PageCategory::where('page_id', $this->id)->delete();
        if(is_array('Page[_category_id]')){
            foreach(post('Page[_category_id]') as $category){
                $categories[] = ["page_id" => $this->id, "category_id" => intval($category)];
            }
            PageCategory::insert($categories);
        }

        //parent::beforeSave();
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
            if(!empty($this->template_id)){
                $template = Template::find($this->template_id);
    
                $blocks = [];
                foreach($template->blocks as $key=>$block){
                    $blocks[] = ["blocks" => $block, "_group" => $block["_group"]];
                }
                return json_encode($blocks);
            }
        }else{
            return $this->blocks;
        }
    }

    /**
     * @var array Links of the pages.
     */
    public function getLinkOptions(){
        return self::where('client_id',$this->client_id)->get()->pluck('page_selection','id');
    }

    /**
     * @var array Categories available.
     */
    public function getParentIdOptions(){
        return self::where('parent_id',NULL)->where('id','!=',$this->id)->where('client_id',$this->client_id)->pluck('title','id');
    } 

    /**
    * @var array Categories for the page.
    */
    public function getCategoryIdAttribute(){

        return PageCategory::where('page_id',$this->id)->pluck('category_id')->toArray();
    }

     /**
    * @var array Parent of the pages.
    */
    public function getCategoryIdOptions(){
        return Category::where('client_id',$this->client_id)->pluck('name','id');
    }

    /**
     * @var string Pages title and slug.
     */
    public function getPageSelectionAttribute()
    {
        return $this->title . ' [.../' . $this->slug."]";
    }

    /**
     * @var string Slug of the page.
     */
    public function getSlugAttribute(){
        $parent_slug = "";
        if($this->parent_id){
            $parent_slug = self::find($this->parent_id)->slug;
        }
        return $parent_slug."/".Str::slug($this->title,'-');
    }
}
