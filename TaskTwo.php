<?php
include_once "DB.php";
class TaskTwo {
    public $rootCategories = [];
    private $all_categories;
    public function __construct($categories)
    {
        $this->all_categories = $categories;
        foreach ($this->all_categories as $cat) {
            if(!$this->has_parent($cat["categoryId"])) {
                $cat["has_child"] = $this->has_child($cat["categoryId"]);
                $this->rootCategories[] = $cat;
            }
        }
    }
    public function tree() {
       return $this->formatTree($this->rootCategories);
    }
    private function formatTree(&$categories) {
        for ($i = 0; $i < count($categories); $i++) {
            $categories[$i]['has_child'] = $this->has_child($categories[$i]["categoryId"]) ? "yes" : "no";
            $categories[$i]['total_child'] = (new DB)->table('catetory_relations')->where('ParentcategoryId', '=', $categories[$i]["categoryId"])->count();
            $categories[$i]['children'] = $this->has_child($categories[$i]["categoryId"]) ? (new DB)->table('catetory_relations')->where('ParentcategoryId', '=', $categories[$i]["categoryId"])->join('category', 'category.Id', '=', 'catetory_relations.categoryId')->get(["category.name, catetory_relations.Id", "catetory_relations.categoryId", "catetory_relations.ParentcategoryId"]) : [];

            if(count($categories[$i]['children'])) {
                $this->formatTree($categories[$i]['children']);
            }
        }
        return $categories;
    }
    function has_child($category_id) {
       return (new DB)->table('catetory_relations')->where('ParentcategoryId', '=', $category_id)->count() ? true : false;
    }
    function has_parent($child_id) {
        return (new DB)->table('catetory_relations')->where('categoryId', '=', $child_id)->count() ? true : false;
    }
}

