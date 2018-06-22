<?php
/**
 * Created by PhpStorm.
 * User: sovkutsan
 * Date: 6/22/18
 * Time: 10:26 AM
 */

/**
 * Class ItemMapper
 * Primitive data mapper for test class Item
 */
class ItemMapper extends BaseMapper
{
    /**
     * @var string
     * table name for mapper. could be moved to base class
     */
    protected $tableName = 'items';

    /**
     * ItemMapper constructor.
     * We need use PDO here
     * @param PDO $pdo
     */
    public function __construct(\PDO $pdo)
    {
        parent::__construct($pdo);
    }

    /**
     * find single user object
     *
     * @param int $id
     * @return Item|null
     */
    public function findById($id = 0)
    {
        $sql = "SELECT * FROM {$this->tableName} WHERE id = :id LIMIT 1;";

        $statement = $this->pdo->prepare($sql);
        $statement->execute(['id' => $id]);

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if (empty($result)) {
            return null;
            //throw new Exception('Item not found');
        }

        $item = $this->mapItem($result);

        return $item;
    }

}