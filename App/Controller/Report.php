<?php
namespace App\Controller;
use System\Controller as Controller;
use App\Model\Asset as Asset;

class Report extends Controller {
    public function assets($model) {
        if($this->req?->getMethod() === 'GET') {
            if($model === 'in') {

            } else if($model === 'out') {

            } else {
                
            }
            $this->loadModel('asset', new Asset());

            $date = $this->req?->Get('date');

            $table = $this->asset->reportTable();

            if($table['result']) {
                return $this->res?->render('report/asset', array('table'=> $table['table']));
            } else {
                return $this->res?->render('report/notfound', array('msg'=> $table['msg']));
            }
        }

        return $this->res?->render('report/notfound', array('msg'=> 'Can\'t response this request.'));
    }
}