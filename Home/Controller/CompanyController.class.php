<?php
namespace Home\Controller;
use Think\Controller;
class CompanyController extends BaseController {
    public function news()
    {

        $this->display('news');
    }

    public function join()
    {
        $this->display('join');
    }
    public function part()
    {
        $this->display('part');
    }
}