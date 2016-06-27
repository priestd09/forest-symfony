<?php

namespace ForestAdmin\ForestBundle\Query;

use ForestAdmin\Liana\Api\DoctrineProxy;
use ForestAdmin\Liana\Api\RepositoryFactory;
use ForestAdmin\Liana\Model\Collection;

class QueryService
{
    /**
     * At this moment, only Doctrine service
     * @var 
     */
    protected $orm;
    
    /**
     * @var Collection[]
     */
    protected $collections;

    public function __construct($orm, $collections)
    {
        $this->setOrm($orm);
        $this->setCollections($collections);
    }

    /**
     * Find a resource by its name and identifier
     *
     * @param string $modelName
     * @param mixed $recordId
     * @return array
     */
    public function getResource($modelName, $recordId)
    {
        $entityName = $this->findEntityInCollections($modelName);
        if($entityName) {
            $proxy = new DoctrineProxy($orm->getRepository($entityName));
            /*
            $repository = RepositoryFactory::get($entityName);
            if($repository) {
                // ici, modelName est inutile
                $resource = $repository->getResource($recordId);
                return $this->formatJsonApi($modelName, $resource);
            }*/
        }
    }

    /**
     * Find all resources by its name and filter
     * @param string $modelName
     * @param ResourceFilter $filter
     * @return array
     */
    public function getResources($modelName, $filter)
    {

    }

    /**
     * @param string $modelName
     * @param mixed $recordId
     * @param string $associationName
     * @return array The hasMany resources with one relationships and a link to their many relationships
     */
    public function getResourceAndRelationships($modelName, $recordId, $associationName)
    {

    }

    /**
     * @param string $modelName
     * @param array $postData
     * @return array The created resource
     */
    public function createResource($modelName, $postData)
    {

    }

    /**
     * @param string $modelName
     * @param mixed $recordId
     * @param array $postData
     * @return array The updated resource
     */
    public function updateResource($modelName, $recordId, $postData)
    {

    }

    /**
     * @return Collection[]
     */
    public function getCollections()
    {
        return $this->collections;
    }

    /**
     * @param Collection[] $collections
     */
    public function setCollections($collections)
    {
        $this->collections = $collections;
    }

    /**
     * @param mixed $orm
     */
    public function setOrm($orm)
    {
        $this->orm = $orm;
    }

    /**
     * @return mixed
     */
    public function getOrm()
    {
        return $this->orm;
    }

    /**
     * @param $entityName
     * @return null|string
     */
    public function findEntityInCollections($entityName)
    {
        foreach($this->getCollections() as $collection) {
            if($collection->entityClassName == $entityName) {
                return $collection->name;
            }
        }

        return null;
    }

    protected function formatJsonApi($modelName, $resource)
    {
        return $resource;
    }
}