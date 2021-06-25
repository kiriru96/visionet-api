<?php
namespace App\Controller;
use System\Controller as Controller;
use App\Model\Asset as Asset;
use App\Model\Workorder as Workorder;
use App\Model\StockOpname as StockOpname;

class Report extends Controller {
    public function stockopnamesheet() {
        if($this->req?->getMethod() === 'GET') {
            $id = (int) $this->req?->Get('id');
            $date = $this->req?->Get('date');

            $title = 'Laporan Stock Opname '.$date;

            $this->loadModel('so', new StockOpname());

            $result = $this->so->reportTable($id);

            if($result['status']) {
                return $this->res?->rendertosheet('report/stockopname', array('table'=> $result['data'], 'title'=> $title), $date);
            }
        }
    }

    public function stockopname() {
        if($this->req?->getMethod() === 'GET') {
            $id = (int) $this->req?->Get('id');
            $date = $this->req?->Get('date');

            $title = 'Laporan Stock Opname '.$date;

            $this->loadModel('so', new StockOpname());

            $result = $this->so->reportTable($id);

            if($result['status']) {
                return $this->res?->render('report/stockopname', array('table'=> $result['data'], 'title'=> $title));
            }
        }
    }
    public function stockin() {
        if($this->req?->getMethod() === 'GET') {
            $startdate  = $this->req?->Get('startdate');
            $enddate    = $this->req?->Get('enddate');

            $this->loadModel('asset', new Asset());
            $title = 'Stock In From '.$startdate.' To '.$enddate;

            $result = $this->asset->report_stock_in($startdate, $enddate);

            if($result['status']) {
                return $this->res?->render('report/asset', array('table'=>$result['data'], 'title'=> $title));
            }
        }
    }

    public function stockout() {
        if($this->req?->getMethod() === 'GET') {
            $startdate  = $this->req?->Get('startdate');
            $enddate    = $this->req?->Get('enddate');

            $this->loadModel('asset', new Asset());
            $title = 'Stock In From '.$startdate.' To '.$enddate;
            
            $result = $this->asset->report_stock_out($startdate, $enddate);

            if($result['status']) {
                return $this->res?->render('report/asset', array('table'=>$result['data'], 'title'=> $title));
            }
        }
    }

    public function workorder() {
        if($this->req?->getMethod() === 'GET') {
            $startdate  = $this->req?->Get('startdate');
            $enddate    = $this->req?->Get('enddate');

            $this->loadModel('wo', new Workorder());

            $result = $this->wo->report($startdate, $enddate);

            return $this->res?->render('report/workorder', array('table'=> $result['data']));
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