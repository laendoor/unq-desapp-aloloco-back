<?php
namespace App\Transformers;

use League\Fractal\Manager;
use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\ResourceAbstract;
use League\Fractal\Serializer\ArraySerializer;
use Doctrine\Common\Collections\Collection;

/**
 * Class Transformer
 * @package App\Transformers
 */
abstract class Transformer extends TransformerAbstract
{
    /**
     * @param $item
     * @param TransformerAbstract $transformer
     * @return array|null
     */
    public function serializeItem($item, TransformerAbstract $transformer)
    {
        if (!$item) return null;

        return $this->serialize($this->item($item, $transformer));
    }

    /**
     * @param Collection $collection
     * @param TransformerAbstract $transformer
     * @return array
     */
    public function serializeCollection(Collection $collection, TransformerAbstract $transformer)
    {
        if ($collection->isEmpty()) return [];

        return $this->serialize($this->collection($collection, $transformer))['data'];
    }

    /**
     * @param ResourceAbstract $data
     * @return array
     */
    protected function serialize(ResourceAbstract $data)
    {
        $manager = new Manager;

        $manager->setSerializer(new ArraySerializer);

        return $manager->createData($data)->toArray();
    }
}
