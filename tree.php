<?php
include 'functions.php';
class BinaryTree
{
    public $root; // корень дерева

    public function __construct()
    {
        $this->root = null;
    }

    public function isEmpty()
    {
        return $this->root === null;
    }

    public function insert($item)
    {
        $node = new BinaryNode($item);
        if ($this->isEmpty()) {
            $this->root = $node;
        } else {
            $this->insertNode($node, $this->root);
        }
    }

    public function insertNode($node, &$subtree)
    {
        if ($subtree === null) {
            // правило 2
            $subtree = $node;
        } else {
            if ($node->value > $subtree->value) {
                // правило 2b
                $this->insertNode($node, $subtree->right);
            } else if ($node->value < $subtree->value) {
                // правило 2c
                $this->insertNode($node, $subtree->left);
            } else {
                // исключаем повторы, правило 2d
            }
        }
    }
}

class BinaryNode
{

    public $value;
    public $left;
    public $right;

    public function __construct($item)
    {
        $this->value = $item;
        // новые потомки - вершина
        $this->left = null;
        $this->right = null;
    }

}
/*
$tree = new BinaryTree();
for ($i = 0; $i < 100; $i++) {
    $value = mt_rand(0, 999);
    $tree->insert($value);
}
custom_print_r($tree);*/