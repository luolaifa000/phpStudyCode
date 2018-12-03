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
 * 树节点
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
    /**
     * 值
     * @var unknown
     */
    public $val;
    
    public $data;
    
    /**
     * 树高度
     * @var unknown
     */
    public $height;
    
    /**
     * 构造
     * 
     * @param int $val
     * @param TreeNode $lNode
     * @param TreeNode $rNode
     */
    public function __construct(int $val = null ,TreeNode $lNode = null ,TreeNode $rNode = null, 
        TreeNode $pNode = null, int $height = 1)
    {
        $this->val = $val;
        $this->lNode = $lNode;
        $this->rNode = $rNode;
        $this->pNode = $pNode;
        $this->height = 1;
    }
}
/**
 * 平衡二叉树
 * 两边子树之前高度差不能大于1，否则需要旋转来达到树平衡
 * @author yumancang
 *
 */
class BlanceTree
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
     * 平衡二叉树插入数据
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
            $rootNode->height = 1;
            return true;
        } else {
            if ($rootNode == null) {
                $rootNode = new TreeNode();
                $rootNode->val = $val;
                $rootNode->lNode = null;
                $rootNode->rNode = null;
                $rootNode->pNode = $parentNode;
                $rootNode->height = 1;
                return true;
            }
        }
        //插入过程已存在就返回不处理
        if ($val == $rootNode->val) {
            return false;
        }
        if ($val < $rootNode->val) {
            $this->insertTree($val, $rootNode->lNode, $rootNode);
        }
        if ($val > $rootNode->val) {
            $this->insertTree($val, $rootNode->rNode, $rootNode);
        }
        $lNodeHeight = $rootNode->lNode ? $rootNode->lNode->height : 1;
        $rNodeHeight = $rootNode->rNode ? $rootNode->rNode->height : 1;
        //求节点的高度
        $rootNode->height = max($lNodeHeight,$rNodeHeight) + 1;
        //节点的平衡因子是否大于1
        #左左情况，右旋
        if (($lNodeHeight - $rNodeHeight) > 1) {
            if ($rootNode->lNode->lNode->height > $rootNode->lNode->rNode->height) {
                $this->rightRotate($rootNode->lNode, $rootNode);
            } else {
                
                $this->leftAndRightRotate($rootNode);
            }
            
        }
        
        #右右情况，左旋
        if (($lNodeHeight - $rNodeHeight) < -1) {
            
            if ($rootNode->rNode->lNode->height > $rootNode->rNode->rNode->height) {
                
                $this->rightAndLeftRotate($rootNode);
            } else {
                $this->leftRotate($rootNode->rNode, $rootNode);
            }
            
        }
        
    }
    
    /**
     * 右左情况，右旋在左旋
     * @param TreeNode $newNode
     * @param TreeNode $oldNode
     */
    public function rightAndLeftRotate(TreeNode $rootNode = null)
    {
        
        //先右旋
        $newNode = $rootNode->rNode->lNode;
        $oldNode = $rootNode->rNode;
        
        $oldNode->lNode = $newNode->rNode;
        $newNode->rNode->pNode = $oldNode;
        
        $newNode->pNode = $oldNode->pNode;
        $oldNode->pNode->rNode = $newNode;
        
        $newNode->rNode = $oldNode;
        $oldNode->pNode = $newNode;

        $newNode->height++;
        $oldNode->height--;
        //在左旋
        $this->leftRotate($rootNode->rNode,$rootNode);
        $this->treeRootNode->pNode = null;
        //prend($this->treeRootNode);
    }
    
    /**
     * 左右情况，左旋在右旋
     * @param TreeNode $newNode
     * @param TreeNode $oldNode
     */
    public function leftAndRightRotate(TreeNode $rootNode = null)
    {
        //先左旋
        $newNode = $rootNode->lNode->rNode;
        $oldNode = $rootNode->lNode;
        
        $oldNode->rNode = $newNode->lNode;
        $newNode->lNode->pNode = $oldNode;
        
        $newNode->pNode = $oldNode->pNode;
        $oldNode->pNode->lNode = $newNode;
        
        $newNode->lNode = $oldNode;
        $oldNode->pNode = $newNode;
        
        $newNode->height++;
        $oldNode->height--;
        
        //在右旋
        $this->rightRotate($rootNode->lNode,$rootNode);
        $this->treeRootNode->pNode = null;
    }
    
    /**
     * 右右情况，左旋
     * @param TreeNode $newNode
     * @param TreeNode $oldNode
     */
    public function leftRotate(TreeNode $newNode = null, TreeNode $oldNode = null)
    {
        $oldNode->rNode = $newNode->lNode;
        if ($newNode->lNode) {
            $newNode->lNode->pNode = $oldNode;
        }
        $newNode->lNode = $oldNode;
        $oldNode->pNode = $newNode;
        
        
        if ($oldNode == $this->treeRootNode)
            $this->treeRootNode = $newNode;
        
        $this->treeRootNode->pNode = null;
            
        $oldNode->height--;
        $oldNode->height--;
        
        //prend($this->treeRootNode);
    }
    
    /**
     * 左左情况，右旋
     * @param TreeNode $newNode
     * @param TreeNode $oldNode
     */
    public function rightRotate(TreeNode $newNode = null, TreeNode $oldNode = null)
    {
        
        $oldNode->lNode = $newNode->rNode;
        if ($newNode->rNode) {
            $newNode->rNode->pNode = $oldNode;
        }
        $newNode->rNode = $oldNode;
        $oldNode->pNode = $newNode;
        
        if ($oldNode == $this->treeRootNode)
            $this->treeRootNode = $newNode;
        $this->treeRootNode->pNode = null;
        $oldNode->height--;
        $oldNode->height--;

        //prend($this->treeRootNode);
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
     * 平衡二叉树中删除节点
     * 跟搜索二叉树删除节点还是不一样的
     * 平衡二叉树原本就维持左右子树高度差不大于1，所有删除过程中
     * 不会出现后继节点出现在子树的子树下面
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

        //原节点是其父节点的左子树
        if ($source === $source->pNode->lNode) {
            $source->pNode->lNode = $des;
            if (!$source->pNode->rNode) {
                $source->pNode->height--;
            } else {
                
            }
            
        }
        //原节点是其父节点的右子树
        if ($source === $source->pNode->rNode) {
            $source->pNode->rNode = $des;
            if (!$source->pNode->rNode) {
                $source->pNode->height--;
            }
        }
        $des != null && $des->pNode = $source->pNode;
        return true;
    }
    
    /**
     * 移动节点 需要附带自己的左右
     *
     * @param TreeNode $source
     * @param TreeNode $des
     * @return boolean
     */
    public function transplantNodeTwo(TreeNode $source = null, TreeNode $des = null)
    {
        if ($source == null) {
            return false;
        }
        
        //原节点是其父节点的左子树
        if ($source === $source->pNode->lNode) {
            $source->pNode->lNode = $des;
            $des != null && $des->rNode = $source->rNode;
            $source->rNode->pNode = $des;
            $source->pNode->height--;
        }
        //原节点是其父节点的右子树
        if ($source === $source->pNode->rNode) {
            $source->pNode->rNode = $des;
            $des != null && $des->rNode = $source->rNode;
            $source->rNode->pNode = $des;
            $source->pNode->height--;
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
$binTree = new BlanceTree();
#插入树
//插入7，左左情况，右旋
/* $binTree->insertTree(10,$binTree->treeRootNode);
$binTree->insertTree(9,$binTree->treeRootNode);
$binTree->insertTree(11,$binTree->treeRootNode);
$binTree->insertTree(8,$binTree->treeRootNode);
$binTree->insertTree(9.1,$binTree->treeRootNode);
$binTree->insertTree(7,$binTree->treeRootNode); */
//插入13，右右情况，左旋
/* $binTree->insertTree(10,$binTree->treeRootNode);
$binTree->insertTree(9,$binTree->treeRootNode);
$binTree->insertTree(11,$binTree->treeRootNode);
$binTree->insertTree(10.1,$binTree->treeRootNode);
$binTree->insertTree(12,$binTree->treeRootNode);
$binTree->insertTree(13,$binTree->treeRootNode); */

//插入9.1，左右情况，先按9左旋，再按9.2右旋
/* $binTree->insertTree(10,$binTree->treeRootNode);
$binTree->insertTree(9,$binTree->treeRootNode);
$binTree->insertTree(11,$binTree->treeRootNode);
$binTree->insertTree(8,$binTree->treeRootNode);
$binTree->insertTree(9.2,$binTree->treeRootNode);
$binTree->insertTree(9.1,$binTree->treeRootNode); */

//插入10.2，右左情况，先按11右旋，再按10.1左旋
/* $binTree->insertTree(10,$binTree->treeRootNode);
$binTree->insertTree(9,$binTree->treeRootNode);
$binTree->insertTree(11,$binTree->treeRootNode);
$binTree->insertTree(10.1,$binTree->treeRootNode);
$binTree->insertTree(12,$binTree->treeRootNode);
$binTree->insertTree(10.2,$binTree->treeRootNode); */

#删除树
//删除根节点，左子树高度大于右边
/* $binTree->insertTree(10,$binTree->treeRootNode);
$binTree->insertTree(9,$binTree->treeRootNode);
$binTree->insertTree(11,$binTree->treeRootNode);
$binTree->insertTree(8,$binTree->treeRootNode);
$binTree->deleteTree(10,$binTree->treeRootNode); */
//删除根节点，左子树高度小于右边
/* $binTree->insertTree(10,$binTree->treeRootNode);
$binTree->insertTree(9,$binTree->treeRootNode);
$binTree->insertTree(11,$binTree->treeRootNode);
$binTree->insertTree(12,$binTree->treeRootNode);
$binTree->deleteTree(10,$binTree->treeRootNode); */
//删除根节点，左子树高度等于右边
/* $binTree->insertTree(10,$binTree->treeRootNode);
$binTree->insertTree(9,$binTree->treeRootNode);
$binTree->insertTree(8,$binTree->treeRootNode);
$binTree->insertTree(11,$binTree->treeRootNode);
$binTree->insertTree(12,$binTree->treeRootNode);
$binTree->deleteTree(10,$binTree->treeRootNode); */
//删除非根节点，左子树高度大于右边
$binTree->insertTree(10,$binTree->treeRootNode);
$binTree->insertTree(9,$binTree->treeRootNode);
$binTree->insertTree(11,$binTree->treeRootNode);
$binTree->insertTree(8,$binTree->treeRootNode);
$binTree->deleteTree(9,$binTree->treeRootNode);
prend($binTree->treeRootNode);
#打印树
pre("中序");
$binTree->middlePrintTree($binTree->treeRootNode);
pre($binTree->treeRootNode);
$end = memory_get_usage();
prend("占用内存:",($end-$start)/1024/1024);

?>