<?php

namespace App\Traits;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;

trait ElasticsearchIndex
{

    /**
     * @var string
     */
    protected static string $documentId = "";

    /**
     * @var string
     */
    protected static string $indexType = "_doc";

    protected static Client $client;

    /**
     * @var array|void
     */
    protected static array $params = [];


    public function getClient()
    {
        return static::$client = ClientBuilder::create()->build();
    }

    public function getDocumentsAttribute(string $documentId = "", string $index = "", string $type = "_doc")
    {
        static::getClient();
        static::getParams($documentId, $index, $type);
        static::getDocument();
    }

    public function setDocumentsAttribute(array $data = [])
    {
        static::getClient();
        static::getParams();
        static::mergeParams($data);
        static::setDocument();
    }

    public static function mergeParams($data)
    {
        static::$params['body'] = $data;
    }

    /**
     * @param string $documentId
     * @param string $index
     * @param string $type
     */
    public static function getParams(string $documentId = "", string $index = "", string $type = "")
    {
        static::$index = $index ?: self::$index;
        static::$documentId = $documentId ?: self::$documentId;
        static::$indexType = $type ?: self::$indexType;
        static::$params = ['id' => self::$documentId, 'index' => self::$index, 'type' => static::$indexType];
    }

    /**
     * @return array|callable
     */
    protected static function getDocument()
    {
        return static::$client->get(static::$params);
    }


    protected static function setDocument()
    {
        static::$client->index(static::$params);
    }

}
