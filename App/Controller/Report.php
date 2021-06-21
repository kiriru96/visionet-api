<?php
namespace App\Controller;
use System\Controller as Controller;
use App\Model\Asset as Asset;

class Report extends Controller {
    public function stockin() {
        if($this->req?->getMethod() === 'GET') {
            $startdate  = $this->req?->Get('startdate');
            $enddate     = $this->req?->Get('enddate');

            $this->loadModel('asset', new Asset());
            
            $result = $this->asset->report_stock_in($startdate, $enddate);

            return $this->res?->render('report/asset', array('table'=>$result['data']));
        }
    }

    public function stockout() {
        if($this->req?->getMethod() === 'GET') {
            $startdate  = $this->req?->Get('startdate');
            $enddate     = $this->req?->Get('enddate');

            $this->loadModel('asset', new Asset());
            
            $result = $this->asset->report_stock_out($startdate, $enddate);

            return $this->res?->render('report/asset', array('table'=>$result['data']));
        }
    }

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