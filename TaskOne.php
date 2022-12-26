<?php
include_once "DB.php";
class TaskOne {
    private $categories_with_item_count = [];
    public function __construct()
    {
        $query = "
    SELECT
        category.Name,
        COUNT(*) as count
    FROM item_category_relations
    JOIN item ON item_category_relations.ItemNumber = item.Number
    JOIN category ON category.Id = item_category_relations.categoryId
    GROUP BY item_category_relations.categoryId
    ORDER BY count DESC
    ";

        $this->categories_with_item_count = (new DB)->query($query)->get();
    }

    public function getCategoriesWithItemCount()
    {
        return $this->categories_with_item_count;
    }
}