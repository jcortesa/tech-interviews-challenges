<?php

// # Code challenge
// Interview done on 2025-09-24
// 
// Given this tree:
//
//       A
//     /   \
//    B     C
//  / | \  / \
// D  E F G   H
// / \
// I  J
// 
// Get lowest common ancestor (LCA) of nodes J and E 

/**
 * provided class Node
 */
final class Node {
    public function __construct(public string $id, public ?Node $parent = null) {}
}

$A = new Node('A');
$B = new Node('B', $A);
$C = new Node('C', $A);
$D = new Node('D', $B);
$E = new Node('E', $B);
$F = new Node('F', $B);
$G = new Node('G', $C);
$H = new Node('H', $C);
$I = new Node('I', $D);
$J = new Node('J', $D);

// vvvv Write your solution here vvvv

/**
 * Find LCA using node's deepth.
 * This is an optimal solution, given that we know the parent of each node.
 * 
 * Time Complexity: O(h) where h is the height of the tree
 * Space Complexity: O(1)
 * 
 * Steps:
 *   - find deepth of nodes
 *   - equal deepth of nodes
 *   - then, traverse up in root direction. First equal pair of node parents will be the lowest common ancestor
 */

function findLowestCommonAncestor(Node $q, Node $p): Node {
    $lca = $q;

    $deepthQ = getNodeDeepth($q);
    $deepthP = getNodeDeepth($p);

    $cursorQ = $q;
    $cursorP = $p;

    while ($deepthQ !== $deepthP) {
        if ($deepthQ > $deepthP) {
            $cursorQ = $cursorQ->parent;
            $deepthQ--;
        }

        if ($deepthQ < $deepthP) {
            $cursorP = $cursorP->parent;
            $deepthP--;
        }
    }

    $lca = $cursorQ->parent;

    return $lca;
}

function getNodeDeepth(Node $node) {
    $deepth = 0;

    while (null !== $node->parent) {
        $deepth++;
        $node = $node->parent;
    }

    return $deepth;
}

$lca = findLowestCommonAncestor($J, $E);

assert($B === $lca, 'B should be lowest common ancestor of nodes J and E');
echo "Lowest common ancestor of nodes J and E is: {$lca->id}";


/**
 * Find LCA using using brute force.
 * This is an non optimal solution, as we need to store node parents in arrays
 * 
 * Time Complexity: O(h) where h is the height of the tree
 * Space Complexity: O(h)
 * 
 * Steps:
 *   - traverse node parents and store them in an array
 *   - loop over those parents array. The first equal node will be the lowest common ancestor
 */

function findLowestCommonAncestorByBruteForce(Node $q, Node $p): Node {
    $lca = $q;

    $parentsQ = [];
    $parentsP = [];

    while(null !== $q->parent) {
        $parentsQ[] = $q->parent;
        $q = $q->parent;
    }

    while(null !== $p->parent) {
        $parentsP[] = $p->parent;
        $p = $p->parent;
    }

    $lca = null;
    $parentsQ = array_reverse($parentsQ);
    $parentsP = array_reverse($parentsP);

    for ($i = 0; $i < count($parentsQ); $i++) {
        if (!array_key_exists($i, $parentsQ) || !array_key_exists($i, $parentsP)) {
            break;
        }

        $lca = $parentsQ[$i];
    }

    return $lca;
}


$lcaBruteForce = findLowestCommonAncestorByBruteForce($J, $E);

assert($B === $lcaBruteForce, 'B should be lowest common ancestor of nodes J and E');
echo "Lowest common ancestor of nodes J and E is: {$lcaBruteForce->id}";