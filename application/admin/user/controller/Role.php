<?php
/**
 * @author: Axios
 *
 * @email: axioscros@aliyun.com
 * @blog:  http://hanxv.cn
 * @datetime: 2017/5/19 17:07
 */

namespace tpr\admin\user\controller;

use tpr\admin\common\controller\AdminLogin;
use think\Db;

class Role extends AdminLogin
{
    public function index()
    {

        $count = Db::name('role')->count();

        $limit = 10;
        $this->assign('pages', ($count % $limit) ? 1 + $count / $limit : $count / $limit);

        return $this->fetch('index');
    }

    public function getRoles()
    {
        $roles = Db::name('role')->select();

        foreach ($roles as &$r) {
            $r['admin_number'] = Db::name('admin')->where('role_id', $r['id'])->count();
        }

        $this->response($roles);
    }
}