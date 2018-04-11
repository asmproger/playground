<?php
include 'functions.php';

class LinkedList
{
    protected $_count;
    protected $_head;
    protected $_tail;

    public function __construct()
    {
        $this->_head = null;
        $this->_tail = null;
    }

    public function remove($item)
    {
        $previous = null;
        $current = $this->_head;
        while (!is_null($current)) {
            if ($current->_value == $item->_value) {
                if (is_null($previous)) {
                    $previous->setNext($current->getNext());

                    if ($current->getNext() == null) {
                        $this->_tail = $previous;
                    }

                } else {
                    $this->_head = $this->_head->getNext();
                    if (is_null($this->_head)) {
                        $this->_tail = null;
                    }
                }
                $this->_count--;
                break;
            }
            $previous = $current;
            $current = $current->getNext();
        }
    }

    public function add($item)
    {

        if (is_null($this->_head)) {
            $this->_head = $item;
            $this->_tail = $item;
        } else {
            $this->_tail->setNext($item);
            $this->_tail = $item;
        }

        $this->_count++;
    }

    public function count()
    {
        return $this->_count;
    }
}

class LinkedListNode
{
    protected $_next;
    public $_value;

    public function __construct($value)
    {
        $this->_value = $value;
    }

    public function setNext($item)
    {
        $this->_next = $item;
    }

    public function getNext()
    {
        return $this->_next;
    }

}

$list = new LinkedList();

for ($i = 0; $i < 5; $i++) {
    $item = new LinkedListNode($i);
    $list->add($item);
}

custom_print_r($list);

$wtf = new LinkedListNode(3);
$list->remove($wtf);
custom_print_r($list);