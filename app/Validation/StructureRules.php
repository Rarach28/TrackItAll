<?php
namespace App\Validation;

use App\Models\AdminModels\TenantsModel;
use App\Models\AdminModels\ProjectsModel;
use App\Models\AdminModels\LocationsModel;
use App\Models\AdminModels\TagsModel;

class StructureRules
{
    public function is_unique_project(string $str, string $fields, array $data)
    {
        $model = new ProjectsModel();
        $project = $model->where('name', $data['name'])
                      ->where('tenant_id', $data['tenant_id'])
                      ->first();
        if (!$project) {
            return true;
        }else{
            return false;
        }

    }

    public function is_unique_location(string $str, string $fields, array $data)
    {
        $model = new LocationsModel();
        $location = $model->where('name', $data['name'])
                        ->where('project_id', $data['project_id'])
                        ->where('parent_id', $data['parent_id'])
                        ->first();
        if (!$location) {
            return true;
        }else{
            return false;
        }

    }

    public function is_unique_tag(string $str, string $fields, array $data)
    {
        $model = new TagsModel();
        $tag = $model->where('name', $data['name'])
                      ->where('tenant_id', $data['tenant_id'])
                      ->first();
        if (!$tag) {
            return true;
        }else{
            return false;
        }

    }
}