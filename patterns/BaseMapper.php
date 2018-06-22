<?php
/**
 * Created by PhpStorm.
 * User: sovkutsan
 * Date: 6/22/18
 * Time: 10:26 AM
 */

/**
 * Class BaseMapper
 * Base mapper class
 */
class BaseMapper
{

    /**
     * @var \PDO
     */
    protected $pdo;

    /**
     * @var string
     * table name for mapper. could be moved to base class
     */
    protected $tableName = '';

    /**
     * ItemMapper constructor.
     * We need use PDO here
     * @param PDO $pdo
     */
    public function __construct(\PDO $pdo)
    {
        if (!$pdo || !$pdo instanceof \PDO) {
            throw new InvalidArgumentException('Invalid pdo object');
        }

        $this->pdo = $pdo;
    }

    /**
     * translate array from PDO to object
     *
     * @param array $itemArray
     * @return Item
     */
    protected function mapItem(array $itemArray)
    {
        $item = new Item();

        foreach ($itemArray as $k => $v) {
            $setter = $this->getSetter($k);
            $value = $this->prepareValue($k, $v);
            if (method_exists($item, $setter)) {
                $item->$setter($value);
            } else {
                $className = get_class($item);
                throw new BadMethodCallException("Method {$setter} does not exist in class {$className}");
            }
        }

        return $item;
    }

    /**
     * What if some value should be prepared? for example, mysql datetime to \DateTime
     *
     * @param $k
     * @param $v
     * @return DateTime
     */
    protected function prepareValue($k, $v)
    {
        if (strpos($k, 'date') !== false) { //date field. we need datetime object here
            return new \DateTime($v);
        } else {
            return $v;
        }
    }

    /**
     * Lets' get setter name for our object
     * 
     * @param $key
     * @return string
     */
    protected function getSetter($key)
    {
        if (strpos($key, '_') !== false) { // like date_creation
            $parts = explode('_', $key);
            $parts = array_map(function ($el) {
                return ucfirst($el);
            }, $parts);

            $setter = 'set' . implode('', $parts);
        } else {
            $setter = 'set' . ucfirst($key);
        }

        return $setter;
    }
}