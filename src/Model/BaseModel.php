<?php
/**
 * Created by PhpStorm.
 * User: 17208
 * Date: 2021/1/4
 * Time: 14:47
 */
namespace FireScheme\BulletinBoard\Model;
use FireScheme\BulletinBoard\Config\Config;
use FireScheme\BulletinBoard\Tool\Fun;
use FireScheme\BulletinBoard\Tool\Medoo;

Class BaseModel
{
    protected $pdo;

    protected $table_name;
    protected $cn_name;
    protected $primary_key = 'id';

    protected $delete_at = 'delete_at';
    protected $create_at = 'create_at';
    protected $update_at = 'update_at';

    public function __construct()
    {
        $db_config = Config::getDbConfig();
        $this->pdo = Medoo::getInstance($db_config);
    }
    public function check($id){
        // 检验分类是否存在
        $model = $this->select_one(['id'=>$id]);
        if(!$model) throw new \Exception("{$this->cn_name}不存在！");
        return $model;
    }
    /**
     * 插入数据
     * @param $data
     * @return string|array
     */
    public function insert($data){
        // 添加初始化数据
        $data[$this->primary_key] = Fun::create_id();
        !isset($data[$this->create_at]) && $data[$this->create_at] = time();
        !isset($data[$this->update_at]) && $data[$this->update_at] = time();

        $this->pdo->insert($this->table_name,$data);
        return $data[$this->primary_key];
    }
    /**
     * 查询数据
     * @param $where
     * @param $keys
     * @return string|array
     */
    public function select($where,$keys="*"){
        // 过滤软删除
        $where["{$this->delete_at}"] = 0;
        !isset($where['ORDER']) && $where["ORDER"] = ["create_at"=>'DESC'];
        $res = $this->pdo->select($this->table_name,$keys,$where);
        return $res;
    }
    /**
     * 查询数据
     * @param $where
     * @param $keys
     * @return string|array
     */
    public function select_one($where,$keys="*"){
        // 过滤软删除
        $where["{$this->delete_at}"] = 0;
        $where['LIMIT'] = 1;
        !isset($where['ORDER']) && $where["ORDER"] = ["create_at"=>'DESC'];
        $res = $this->pdo->select($this->table_name,$keys,$where);
        return $res;
    }
    /**
     * 分页查询数据
     * @param $where
     * @param $page
     * @param $page_size
     * @return string|array
     */
    public function select_page($where,$page,$page_size,$keys="*"){
        // 过滤软删除
        $where["{$this->delete_at}"] = 0;
        $count = $this->pdo->count($this->table_name,$keys,$where);
        !isset($where['ORDER']) && $where["ORDER"] = ["create_at"=>'DESC'];
        $where['LIMIT'] = [($page-1) * $page_size  , $page * $page_size];
        $data = $this->pdo->select($this->table_name,$keys,$where);
        return [
            'data'=>$data,
            'count'=>$count
        ];
    }
    /**
     * 更新数据
     * @param $id
     * @param $data
     * @return string|array
     */
    public function update($id,$data){
        // 更新时间
        $data["{$this->update_at}"] = time();
        $this->pdo->update($this->table_name,$data,[$this->primary_key=>$id]);
        return true;
    }
    /**
     * 删除数据
     * @param $id
     * @return string|array
     */
    public function delete($id){
        // 软删除
        $data = [ $this->delete_at => time()];
        $this->pdo->update($this->table_name,$data,[$this->primary_key=>$id]);
        return true;
    }
}