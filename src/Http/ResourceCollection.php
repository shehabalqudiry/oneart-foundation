<?php

namespace INTCore\OneARTFoundation\Http;

use Illuminate\Http\Resources\Json\ResourceCollection as Collection;


/**
 * Base controller.
 */
class ResourceCollection extends Collection
{
    public $dataHolder =  'data';

    public $isPaginated = false;

    public $dataSource ;

    public function __construct($resource)
    {
        $this->dataSource = $resource;
        if ($this->isPaginated)
            $resource = $resource->getCollection();
        parent::__construct($resource);
    }

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = [];
        $data[$this->dataHolder] = $this->collection;
        if ($this->isPaginated)
            $data['pagination'] = $this->pagination();
        
        return $data;
    }

    public function pagination()
    {
        return [
            'total' => $this->dataSource->total(),
            'count' => $this->dataSource->count(),
            'per_page' => $this->dataSource->perPage(),
            'current_page' => $this->dataSource->currentPage(),
            'total_pages' => $this->dataSource->lastPage()
        ];
    }
}
