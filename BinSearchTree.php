<?php
function pre($arr)
{
    $data = func_get_args();
    foreach($data as $key=>$val)
    {
        echo '<pre>';
        print_r($val);
        echo '</pre>';
    }
}

function prend()
{
    $data = func_get_args();
    foreach($data as $key=>$val)
    {
        echo '<pre>';
        print_r($val);
        echo '</pre>';
    }
    exit();
}
/**
 * 搜索二叉树插入和查找,删除
 * 
 * @author yumancang
 *
 */
class TreeNode 
{
    /**
     * 左节点
     * @var unknown
     */
    public $lNode;
    
    /**
     * 右节点
     * @var unknown
     */
    public $rNode;
    
    /**
     * 父节点
     * @var unknown
     */
    public $pNode;
    
    public $val;
    
    public $data;
    
    /**
     * 构造
     * 
     * @param int $val
     * @param TreeNode $lNode
     * @param TreeNode $rNode
     */
    public function __construct(int $val = null ,TreeNode $lNode = null ,TreeNode $rNode = null)
    {
        $this->val = $val;
        $this->lNode = $lNode;
        $this->rNode = $rNode;
    }
}

class BinSearchTree
{
    public $treeRootNode;
    
    public function __construct()
    {
        $this->treeRootNode = null;
    }

    /**
     * 前序输出树 5 2 1 3 9 8 10
     * 根左右
     * 
     * @param TreeNode $rootNode
     */
    public function prePrintTree(TreeNode $rootNode = null)
    {
        pre($rootNode->val);
        if ($rootNode->lNode) {
            $this->prePrintTree($rootNode->lNode);
        }
        if ($rootNode->rNode) {
            $this->prePrintTree($rootNode->rNode);
        }
        //pre($rootNode);
    }
    /**
     * 中序输出   1 2 3 5 8 9 10
     * 左根右
     * 
     * @param TreeNode $rootNode
     */
    public function middlePrintTree(TreeNode $rootNode = null)
    {
        
        if ($rootNode->lNode) {
            $this->middlePrintTree($rootNode->lNode);
        }
        pre($rootNode->val);
        if ($rootNode->rNode) {
            $this->middlePrintTree($rootNode->rNode);
        }
    }
    
    /**
     * 后序输出  1 3 2 8 10 9 5
     * 左右根
     * 
     * @param TreeNode $rootNode
     */
    public function afterPrintTree(TreeNode $rootNode = null) 
    {
        if ($rootNode->lNode) {
            $this->afterPrintTree($rootNode->lNode);
        }
        if ($rootNode->rNode) {
            $this->afterPrintTree($rootNode->rNode);
        }
        pre($rootNode->val);
    }
    
    /**
     * 
     * 搜索二叉树插入数据
     * 
     */
    public function insertTree($val, &$rootNode, $parentNode = null)
    {
        if ($this->treeRootNode == null) {
            
            $rootNode = new TreeNode();
            $rootNode->val = $val;
            $rootNode->lNode = null;
            $rootNode->rNode = null;
            $rootNode->pNode = null;
            return true;
        } else {
            if ($rootNode == null) {
                $rootNode = new TreeNode();
                $rootNode->val = $val;
                $rootNode->lNode = null;
                $rootNode->rNode = null;
                $rootNode->pNode = $parentNode;
                return true;
            }
        }
        //插入过程已存在就返回不处理
        if ($val == $rootNode->val) {
            return false;
        }
        if ($val < $rootNode->val) {
            return $this->insertTree($val, $rootNode->lNode, $rootNode);
        }
        if ($val > $rootNode->val) {
            return $this->insertTree($val, $rootNode->rNode, $rootNode);
        }
    }
    
    /**
     * 查询二叉树
     * 
     * @param int $val
     * @param TreeNode $rootNode
     */
    public function serarchTree(int $val, TreeNode &$rootNode = null)
    {
        if ($rootNode == null) {
            return false;
        }
        if ($val == $rootNode->val) {
            return $rootNode;
        }
        if ($val < $rootNode->val) {
            return $this->serarchTree($val, $rootNode->lNode);
        }
        if ($val > $rootNode->val) {
            return $this->serarchTree($val, $rootNode->rNode);
        }
    }
    
    /**
     * 二叉树中删除节点
     * 
     * @param int $val
     * @param TreeNode $rootNode
     */
    public function deleteTree(int $val, TreeNode &$rootNode = null)
    {
        $node = $this->serarchTree($val,$rootNode);
        if (!$node) {
            return false;
        }
        //没有右子树
        if ($node->rNode == null) {
            $this->transplantNode($node,$node->lNode);
        } 
        //有右子树
        if ($node->rNode) {
            //右子节点下面没有左节点的话
            if ($node->rNode->lNode == null) {
                $this->transplantNode($node,$node->rNode);
            }
            //右子节点下面有左节点的话
            if ($node->rNode->lNode) {
                //找出下面最小的那个节点，就递归左边
                $minNode = $this->findNodeBelowMin($node->rNode->lNode);
                //移动节点
                $this->transplantNode($minNode,$minNode->rNode);
                $this->transplantSingleNode($node,$minNode);
            }
        }
    }
    /**
     * 移动节点不需要附带自己的左右
     * 
     * 
     * @param TreeNode $source
     * @param TreeNode $des
     * @return boolean
     */
    public function transplantSingleNode(TreeNode $source = null, TreeNode $des = null)
    {
        if ($source == null) {
            return false;
        }
        if ($source->pNode == null) {
            $this->treeRootNode = $des;
            return true;
        }
        //原节点是其父节点的左子树
        if ($source === $source->pNode->lNode) {
            $source->pNode->lNode = $des;
        }
        //原节点是其父节点的右子树
        if ($source === $source->pNode->rNode) {
            $source->pNode->rNode = $des;
        }
        if ($des != null) {
            $des->pNode = $source->pNode;
            $des->rNode = $source->rNode;
            $des->lNode = $source->lNode;
        }
        return true;
    }
    
    /**
     * 找出当前节点和它子树下面最小的节点
     * 
     * @param TreeNode $node
     * @return NULL|TreeNode
     */
    public function findNodeBelowMin(TreeNode $node = null)
    {
        if ($node == null) {
            return null;
        }
        while ($node->lNode != null) {
            $node = $node->lNode;
        }
        return $node;
    }
    
    /**
     * 找出当前节点和它子树下面最大的节点
     * 
     * @param TreeNode $node
     * @return NULL|TreeNode|unknown
     */
    public function findNodeBelowMax(TreeNode $node)
    {
        if ($node == null) {
            return null;
        }
        while ($node->rNode != null) {
            $node = $node->rNode;
        }
        return $node;
    }
    
    /**
     * 移动节点 需要附带自己的左右
     * 
     * @param TreeNode $source
     * @param TreeNode $des
     * @return boolean
     */
    public function transplantNode(TreeNode $source = null, TreeNode $des = null)
    {
        if ($source == null) {
            return false;
        }
        if ($source->pNode == null) {
            $this->treeRootNode = $des;
            return true;
        }
        //原节点是其父节点的左子树
        if ($source === $source->pNode->lNode) {
            $source->pNode->lNode = $des;
        }
        //原节点是其父节点的右子树
        if ($source === $source->pNode->rNode) {
            $source->pNode->rNode = $des;
        }
        $des != null && $des->pNode = $source->pNode;
        return true;
    }
    
    /**
     * 查找一个节点前继节点
     * 
     * @param int $val
     * @param TreeNode $rootNode
     */
    public function findPreNodeTree(int $val,TreeNode $rootNode = null)
    {

    }
    
    /**
     * 
     * 查找一个节点后继节点
     *
     * @param int $val
     * @param TreeNode $rootNode
     */
    public function findAfterNodeTree(int $val,TreeNode $rootNode = null)
    {

    }
}

$start = memory_get_usage();
$binTree = new BinSearchTree();
#插入树
$binTree->insertTree(5,$binTree->treeRootNode);
$binTree->insertTree(2,$binTree->treeRootNode);
$binTree->insertTree(9,$binTree->treeRootNode);
$binTree->insertTree(1,$binTree->treeRootNode);
$binTree->insertTree(3,$binTree->treeRootNode);
$binTree->insertTree(10,$binTree->treeRootNode);
$binTree->insertTree(8,$binTree->treeRootNode);
$binTree->insertTree(9.5,$binTree->treeRootNode);
$binTree->insertTree(11,$binTree->treeRootNode);
$binTree->insertTree(10.5,$binTree->treeRootNode);
$binTree->insertTree(10.6,$binTree->treeRootNode);

#打印树
pre("前序");
$binTree->prePrintTree($binTree->treeRootNode);
pre("中序");
$binTree->middlePrintTree($binTree->treeRootNode);
pre("后序");
$binTree->afterPrintTree($binTree->treeRootNode);
#搜索树
var_dump($binTree->serarchTree(6, $binTree->treeRootNode));
//prend($binTree->serarchTree(10, $binTree->treeRootNode)->pNode->pNode);
#删除树
//$binTree->deleteTree(10,$binTree->treeRootNode);
$binTree->deleteTree(10,$binTree->treeRootNode);
pre("中序");
$binTree->middlePrintTree($binTree->treeRootNode);
//pre($binTree->treeRootNode);
$end = memory_get_usage();
prend("占用内存:",($end-$start)/1024/1024);

?>