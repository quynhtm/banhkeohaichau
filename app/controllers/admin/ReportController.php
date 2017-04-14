<?php
/**
 * QuynhTM
 */

class ReportController extends BaseAdminController{

    private $arrTypeDate = array(1=>'Theo ngày',2=>'Theo tuần',3=>'Theo tháng',4=>'Theo năm');
    private $arrTypeSearchCategory = array(0=>'Theo ngày thanh toán',1=>'Theo ngày thanh toán và tạo ĐH');
    private $permission_view = 'Report_view';
    private $permission_full = 'Report_full';
    private $permission_delete = 'Report_delete';
    private $permission_create = 'Report_create';
    private $permission_edit = 'Report_edit';
    private $error = array();
    private $arrParentCategory = array();
    private $arrSale = array();

    public function __construct()
    {
        parent::__construct();
        //Include javascript.
        FunctionLib::link_js(array(
            'lib/ckeditor/ckeditor.js',
            'lib/ckeditor/config.js',
            'admin/js/admin.js',
            'admin/js/order.js',
            'lib/number/autoNumeric.js',

            'lib/highcharts/highcharts.js',
            'lib/highcharts/highcharts-3d.js',
            'lib/highcharts/exporting.js',
        ));
    }

    public function view() {
        //Check phan quyen.
        if(!$this->is_root && !in_array($this->permission_full,$this->permission)&& !in_array($this->permission_view,$this->permission)){
            return Redirect::route('admin.dashboard',array('error'=>1));
        }
        $data = array();

        $this->layout->content = View::make('admin.Report.view')
            ->with('data', $data)

            ->with('is_root', $this->is_root)//dùng common
            ->with('permission_full', in_array($this->permission_full, $this->permission) ? 1 : 0)//dùng common
            ->with('permission_delete', in_array($this->permission_delete, $this->permission) ? 1 : 0)//dùng common
            ->with('permission_create', in_array($this->permission_create, $this->permission) ? 1 : 0)//dùng common
            ->with('permission_edit', in_array($this->permission_edit, $this->permission) ? 1 : 0);//dùng common
    }

    //Top ban hang, doanh so, lợi nhuận theo ngành hàng
    public function topWithCategory(){
        CGlobal::$pageTitle = "TOP bán hàng - doanh số - lợi nhuận | Admin Plaza";
        if (!$this->is_root && !in_array($this->permission_view_report_full, $this->permission)) {
            return Redirect::route('admin.dashboard',array('error'=> 1));
        }
        //lay danh muc cha
        $this->getParentCategory();
        $dataSearch['category_id'] = Request::get('category_id','');
        $dataSearch['type'] = 1;
        $dataSearch['type_search'] = Request::get('type_search',0);

        $start_time = Request::get('start_time','');
        if($start_time != '') {
            $dataSearch['start_time'] = strtotime($start_time . ' 00:00:00');
        }
        $end_time = Request::get('end_time','');
        if($end_time != '') {
            $dataSearch['end_time'] = strtotime($end_time . ' 23:59:59');
        }

        if($start_time == '' || $end_time == ''){
            $this->error[] = 'Bạn chưa chọn đủ thời gian để thống kê';
        }

        $data_banhang = $dothi_banhang = array();
        $data_doanhso = $dothi_doanhso = array();
        $data_doanhthu = $dothi_doanhthu = array();
        if(empty($this->error) ){
            /*******************************************************************************************************************
             * top ban hàng
             ********************************************************************************************************************
             */
            $search_banhang = $dataSearch;
            $search_banhang['sort'] = 1;
            $getData = Report::searchDealByCategory($search_banhang);
            if(isset($getData['intIsOK']) && $getData['intIsOK'] == 1) {
                $data_banhang = $getData['data'];
                $total_banhang = 0;
                foreach ($data_banhang as $k1 => $val_1) {
                    $dothi_banhang[$k1]['product_id'] = $val_1['product_id'];
                    $dothi_banhang[$k1]['total_product'] = $val_1['total_product'];
                    $total_banhang = $total_banhang + $val_1['total_product'];
                }

                if (sizeof($dothi_banhang) > 0) {
                    $sum_percent_sale = 0;
                    foreach ($dothi_banhang as $k11 => &$val_11) {
                        if ($k11 == (count($dothi_banhang) - 1)) {
                            $dothi_banhang[$k11]['percent_sale'] = 100 - $sum_percent_sale;
                        } else {
                            $dothi_banhang[$k11]['percent_sale'] = round(abs((($val_11['total_product'] / $total_banhang) * 100)), 2);
                            $sum_percent_sale += $dothi_banhang[$k11]['percent_sale'];
                        }
                    }
                }
            }

             /*******************************************************************************************************************
             * top Doanh số
             ********************************************************************************************************************
             */
            $search_doanhso = $dataSearch;
            $search_doanhso['sort'] = 2;
            $getData2 = Report::searchDealByCategory($search_doanhso);
            if(isset($getData2['intIsOK']) && $getData2['intIsOK'] == 1){
                $data_doanhso = $getData2['data'];
                $total_doanhso = 0;
                foreach($data_doanhso as $k2 =>$val_2){
                    $dothi_doanhso[$k2]['product_id'] = $val_2['product_id'];
                    $dothi_doanhso[$k2]['total_price'] = $val_2['total_price'];
                    $total_doanhso = $total_doanhso + $val_2['total_price'];
                }

                if(sizeof($dothi_doanhso) > 0){
                    $sum_percent_price = 0;
                    foreach($dothi_doanhso as $k22 =>&$val_22){
                        if($k22 == (count($dothi_doanhso)-1)){
                            $dothi_doanhso[$k22]['percent_price'] = 100 - $sum_percent_price;
                        } else {
                            $dothi_doanhso[$k22]['percent_price'] = round(abs((($val_22['total_price'] / $total_doanhso) * 100)), 2);
                            $sum_percent_price += $dothi_doanhso[$k22]['percent_price'];
                        }
                    }
                }
            }

            /*******************************************************************************************************************
             * top Doanh thu
             ********************************************************************************************************************
             */
            $search_doanhthu = $dataSearch;
            $search_doanhthu['sort'] = 3;
            $getData3 = Report::searchDealByCategory($search_doanhthu);
            if(isset($getData3['intIsOK']) && $getData3['intIsOK'] == 1){
                $data_doanhthu = $getData3['data'];
                $total_doanhthu = 0;
                foreach($data_doanhthu as $k3 =>$val_3){
                    $dothi_doanhthu[$k3]['product_id'] = $val_3['product_id'];
                    $dothi_doanhthu[$k3]['total_profit'] = $val_3['total_profit'];
                    $total_doanhthu = $total_doanhthu + $val_3['total_profit'];
                }

                if(sizeof($dothi_doanhthu) > 0){
                    $sum_percent_profit = 0;
                    foreach($dothi_doanhthu as $k33 =>&$val_33){
                        if($k33 == (count($dothi_doanhthu)-1)){
                            $dothi_doanhthu[$k33]['percent_profit'] = 100 - $sum_percent_profit;
                        } else {
                            $dothi_doanhthu[$k33]['percent_profit'] = round(abs((($val_33['total_profit'] / $total_doanhthu) * 100)), 2);
                            $sum_percent_profit += $dothi_doanhthu[$k33]['percent_profit'];
                        }
                    }
                }
            }

        }

        $submit = Request::get('submit',1);
        if($submit == 2){
            $this->excelTopWithCategory($data_banhang,$data_doanhso,$data_doanhthu);
        }
        $optionTypeSearch = FunctionLib::getOption($this->arrTypeSearchCategory, $dataSearch['type_search']);
        $optionParentCategory = FunctionLib::getOption(array(''=>'--- Chọn ngành hàng ----')+$this->arrParentCategory, $dataSearch['category_id']);
        $name_category = ($dataSearch['category_id'] > 0)?$this->arrParentCategory[$dataSearch['category_id']]: 'Tất cả';
        $this->layout->content = View::make('admin.Report.TopWithCategory')
            ->with('is_root', $this->is_root)
            ->with('error', $this->error)
            ->with('permission_view_report_full',in_array($this->permission_view_report_full,$this->permission) ? 1 : 0)
            ->with('actionTag',$this->getControllerAction())
            ->with('optionParentCategory',$optionParentCategory)
            ->with('optionTypeSearch',$optionTypeSearch)
            ->with('dataSearch',$dataSearch)

            //Top ban hang
            ->with('data_banhang',$data_banhang)
            ->with('dothi_banhang',$dothi_banhang)

            //Top doanh so
            ->with('data_doanhso',$data_doanhso)
            ->with('dothi_doanhso',$dothi_doanhso)

            //Top doanh thu
            ->with('data_doanhthu',$data_doanhthu)
            ->with('dothi_doanhthu',$dothi_doanhthu)

            ->with('name_category', $name_category);
        parent::debug();
    }
    public function excelTopWithCategory($data_banhang=array(),$data_doanhso=array(),$data_doanhthu=array()){
        if(empty($data_banhang))
            return;
        //FunctionLib::debug($arrData);
        // xu ly export
        ini_set('max_execution_time', 3000);
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $sheet = $objPHPExcel->getActiveSheet();

        // Set Orientation, size and scaling
        $sheet->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
        $sheet->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
        $sheet->getPageSetup()->setFitToPage(true);
        $sheet->getPageSetup()->setFitToWidth(1);
        $sheet->getPageSetup()->setFitToHeight(0);

        if(sizeof($data_banhang) > 0) {
            // Set font
            $sheet->getDefaultStyle()->getFont()->setName('Arial')->setSize(10);
            $sheet->getStyle('A1')->getFont()->setSize(16)->getColor()->setRGB('000000');
            $sheet->mergeCells('A1:D1');
            $sheet->setCellValue("A1", "Top bán hàng");
            $sheet->getRowDimension("1")->setRowHeight(26);
            $sheet->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT)
                ->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

            //ngày thống kê
            $sheet->getStyle('A2')->getFont()->setSize(11)->getColor()->setRGB('000000');
            $sheet->mergeCells('A2:D2');
            $sheet->setCellValue("A2", "Ngày thống kê: " . date('d-m-Y H:i:s', time()));
            $sheet->getRowDimension("2")->setRowHeight(24);
            $sheet->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT)
                ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

            // setting header
            $position_hearder = 3;
            $sheet->getRowDimension($position_hearder)->setRowHeight(30);
            $val15 = 15;
            $val18 = 18;
            $ary_cell = array(
                'A' => array('w' => $val15, 'val' => 'Id deal onsite', 'align' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER),
                'B' => array('w' => $val18, 'val' => 'Số lượng bán', 'align' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER),
                'C' => array('w' => $val18, 'val' => 'Doanh số', 'align' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT),
                'D' => array('w' => $val18, 'val' => 'Lợi nhuận', 'align' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT),
            );

            //build header title
            foreach ($ary_cell as $col => $attr) {
                $sheet->getColumnDimension($col)->setWidth($attr['w']);
                $sheet->setCellValue("$col{$position_hearder}", $attr['val']);
                $sheet->getStyle($col)->getAlignment()->setWrapText(true);
                $sheet->getStyle($col . $position_hearder)->applyFromArray(
                    array(
                        'fill' => array(
                            'type' => PHPExcel_Style_Fill::FILL_SOLID,
                            'color' => array('rgb' => '05729C'),
                            'style' => array('font-weight' => 'bold')
                        ),
                        'font' => array(
                            'bold' => true,
                            'color' => array('rgb' => 'FFFFFF'),
                            'size' => 10,
                            'name' => 'Verdana'
                        ),
                        'borders' => array(
                            'allborders' => array(
                                'style' => PHPExcel_Style_Border::BORDER_THIN,
                                'color' => array('rgb' => '333333')
                            )
                        ),
                        'alignment' => array(
                            'horizontal' => $attr['align'],
                        )
                    )
                );
            }

            //hien thị dũ liệu
            $rowCount = $position_hearder + 1; // hang bat dau xuat du lieu
            foreach ($data_banhang as $ky => $data) {
                $sheet->getRowDimension($rowCount)->setRowHeight(30);//chiều cao của row
                $sheet->getStyle('A' . $rowCount)->getAlignment()->applyFromArray(
                    array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,));
                $sheet->SetCellValue('A' . $rowCount, $data['product_id']);

                $sheet->getStyle('B' . $rowCount)->getAlignment()->applyFromArray(
                    array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,));
                $sheet->SetCellValue('B' . $rowCount, $data['total_product']);

                $sheet->getStyle('C' . $rowCount)->getAlignment()->applyFromArray(
                    array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,));
                $sheet->SetCellValue('C' . $rowCount, $data['total_price']);

                $sheet->getStyle('D' . $rowCount)->getAlignment()->applyFromArray(
                    array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,));
                $sheet->SetCellValue('D' . $rowCount, $data['total_profit']);
                $rowCount++;
            }

            $objPHPExcel->getActiveSheet()
                ->getStyle('A4:D' . ($rowCount))
                ->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

            $sheet->getStyle('C' . $rowCount)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,));
            $sheet->getStyle('C' . $rowCount)->getFont()->setBold(true);
            $sheet->SetCellValue('C' . $rowCount, '=SUM(C5:C' . ($rowCount - 1) . ')');

            $sheet->getStyle('D' . $rowCount)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,));
            $sheet->getStyle('D' . $rowCount)->getFont()->setBold(true);
            $sheet->SetCellValue('D' . $rowCount, '=SUM(D5:D' . ($rowCount - 1) . ')');

            $objPHPExcel->getActiveSheet()
                ->getStyle('C4:D' . $rowCount)
                ->getNumberFormat()
                ->setFormatCode('#,##0');
        }

        if(sizeof($data_doanhso) > 0) {

            $rowCount = $rowCount + 3;
            // Set font
            $sheet->getDefaultStyle()->getFont()->setName('Arial')->setSize(10);
            $sheet->getStyle('A'. $rowCount)->getFont()->setSize(16)->getColor()->setRGB('000000');
            $sheet->mergeCells('A'. $rowCount.':D'. $rowCount);
            $sheet->setCellValue("A". $rowCount, "Top doanh số");
            $sheet->getRowDimension( $rowCount)->setRowHeight(26);
            $sheet->getStyle('A'. $rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT)
                ->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

            // setting header
            $position_hearder = $rowCount+1;
            $sheet->getRowDimension($position_hearder)->setRowHeight(30);
            $val15 = 15;
            $val18 = 18;
            $ary_cell = array(
                'A' => array('w' => $val15, 'val' => 'Id deal onsite', 'align' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER),
                'B' => array('w' => $val18, 'val' => 'Số lượng bán', 'align' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER),
                'C' => array('w' => $val18, 'val' => 'Doanh số', 'align' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT),
                'D' => array('w' => $val18, 'val' => 'Lợi nhuận', 'align' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT),
            );

            //build header title
            foreach ($ary_cell as $col => $attr) {
                $sheet->getColumnDimension($col)->setWidth($attr['w']);
                $sheet->setCellValue("$col{$position_hearder}", $attr['val']);
                $sheet->getStyle($col)->getAlignment()->setWrapText(true);
                $sheet->getStyle($col . $position_hearder)->applyFromArray(
                    array(
                        'fill' => array(
                            'type' => PHPExcel_Style_Fill::FILL_SOLID,
                            'color' => array('rgb' => '05729C'),
                            'style' => array('font-weight' => 'bold')
                        ),
                        'font' => array(
                            'bold' => true,
                            'color' => array('rgb' => 'FFFFFF'),
                            'size' => 10,
                            'name' => 'Verdana'
                        ),
                        'borders' => array(
                            'allborders' => array(
                                'style' => PHPExcel_Style_Border::BORDER_THIN,
                                'color' => array('rgb' => '333333')
                            )
                        ),
                        'alignment' => array(
                            'horizontal' => $attr['align'],
                        )
                    )
                );
            }

            //hien thị dũ liệu
            $rowCount = $position_hearder + 1; // hang bat dau xuat du lieu
            foreach ($data_doanhso as $ky => $data) {
                $sheet->getRowDimension($rowCount)->setRowHeight(30);//chiều cao của row
                $sheet->getStyle('A' . $rowCount)->getAlignment()->applyFromArray(
                    array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,));
                $sheet->SetCellValue('A' . $rowCount, $data['product_id']);

                $sheet->getStyle('B' . $rowCount)->getAlignment()->applyFromArray(
                    array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,));
                $sheet->SetCellValue('B' . $rowCount, $data['total_product']);

                $sheet->getStyle('C' . $rowCount)->getAlignment()->applyFromArray(
                    array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,));
                $sheet->SetCellValue('C' . $rowCount, $data['total_price']);

                $sheet->getStyle('D' . $rowCount)->getAlignment()->applyFromArray(
                    array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,));
                $sheet->SetCellValue('D' . $rowCount, $data['total_profit']);
                $rowCount++;
            }

            $objPHPExcel->getActiveSheet()
                ->getStyle('A'.($position_hearder+1).':D' . ($rowCount))
                ->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

            $sheet->getStyle('C' . $rowCount)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,));
            $sheet->getStyle('C' . $rowCount)->getFont()->setBold(true);
            $sheet->SetCellValue('C' . $rowCount, '=SUM(C'.($position_hearder+2).':C' . ($rowCount - 1) . ')');

            $sheet->getStyle('D' . $rowCount)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,));
            $sheet->getStyle('D' . $rowCount)->getFont()->setBold(true);
            $sheet->SetCellValue('D' . $rowCount, '=SUM(D'.($position_hearder+2).':D' . ($rowCount - 1) . ')');

            $objPHPExcel->getActiveSheet()
                ->getStyle('C'.($position_hearder+1).':D' . $rowCount)
                ->getNumberFormat()
                ->setFormatCode('#,##0');
        }

        if(sizeof($data_doanhthu) > 0) {

            $rowCount = $rowCount + 3;
            // Set font
            $sheet->getDefaultStyle()->getFont()->setName('Arial')->setSize(10);
            $sheet->getStyle('A'. $rowCount)->getFont()->setSize(16)->getColor()->setRGB('000000');
            $sheet->mergeCells('A'. $rowCount.':D'. $rowCount);
            $sheet->setCellValue("A". $rowCount, "Top doanh thu");
            $sheet->getRowDimension( $rowCount)->setRowHeight(26);
            $sheet->getStyle('A'. $rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT)
                ->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

            // setting header
            $position_hearder = $rowCount+1;
            $sheet->getRowDimension($position_hearder)->setRowHeight(30);
            $val15 = 15;
            $val18 = 18;
            $ary_cell = array(
                'A' => array('w' => $val15, 'val' => 'Id deal onsite', 'align' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER),
                'B' => array('w' => $val18, 'val' => 'Số lượng bán', 'align' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER),
                'C' => array('w' => $val18, 'val' => 'Doanh số', 'align' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT),
                'D' => array('w' => $val18, 'val' => 'Lợi nhuận', 'align' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT),
            );

            //build header title
            foreach ($ary_cell as $col => $attr) {
                $sheet->getColumnDimension($col)->setWidth($attr['w']);
                $sheet->setCellValue("$col{$position_hearder}", $attr['val']);
                $sheet->getStyle($col)->getAlignment()->setWrapText(true);
                $sheet->getStyle($col . $position_hearder)->applyFromArray(
                    array(
                        'fill' => array(
                            'type' => PHPExcel_Style_Fill::FILL_SOLID,
                            'color' => array('rgb' => '05729C'),
                            'style' => array('font-weight' => 'bold')
                        ),
                        'font' => array(
                            'bold' => true,
                            'color' => array('rgb' => 'FFFFFF'),
                            'size' => 10,
                            'name' => 'Verdana'
                        ),
                        'borders' => array(
                            'allborders' => array(
                                'style' => PHPExcel_Style_Border::BORDER_THIN,
                                'color' => array('rgb' => '333333')
                            )
                        ),
                        'alignment' => array(
                            'horizontal' => $attr['align'],
                        )
                    )
                );
            }

            //hien thị dũ liệu
            $rowCount = $position_hearder + 1; // hang bat dau xuat du lieu
            foreach ($data_doanhthu as $ky => $data) {
                $sheet->getRowDimension($rowCount)->setRowHeight(30);//chiều cao của row
                $sheet->getStyle('A' . $rowCount)->getAlignment()->applyFromArray(
                    array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,));
                $sheet->SetCellValue('A' . $rowCount, $data['product_id']);

                $sheet->getStyle('B' . $rowCount)->getAlignment()->applyFromArray(
                    array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,));
                $sheet->SetCellValue('B' . $rowCount, $data['total_product']);

                $sheet->getStyle('C' . $rowCount)->getAlignment()->applyFromArray(
                    array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,));
                $sheet->SetCellValue('C' . $rowCount, $data['total_price']);

                $sheet->getStyle('D' . $rowCount)->getAlignment()->applyFromArray(
                    array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,));
                $sheet->SetCellValue('D' . $rowCount, $data['total_profit']);
                $rowCount++;
            }

            $objPHPExcel->getActiveSheet()
                ->getStyle('A'.($position_hearder+1).':D' . ($rowCount))
                ->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

            $sheet->getStyle('C' . $rowCount)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,));
            $sheet->getStyle('C' . $rowCount)->getFont()->setBold(true);
            $sheet->SetCellValue('C' . $rowCount, '=SUM(C'.($position_hearder+2).':C' . ($rowCount - 1) . ')');

            $sheet->getStyle('D' . $rowCount)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,));
            $sheet->getStyle('D' . $rowCount)->getFont()->setBold(true);
            $sheet->SetCellValue('D' . $rowCount, '=SUM(D'.($position_hearder+2).':D' . ($rowCount - 1) . ')');

            $objPHPExcel->getActiveSheet()
                ->getStyle('C'.($position_hearder+1).':D' . $rowCount)
                ->getNumberFormat()
                ->setFormatCode('#,##0');
        }
        // output file
        ob_clean();
        $filename = "Top_banhang_doanhso_loinhuan" . date("_d/m/Y_H_i").'.xls';
        @header("Cache-Control: ");
        @header("Pragma: ");
        @header("Content-type: application/octet-stream");
        @header("Content-Disposition: attachment; filename=\"{$filename}\"");

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save("php://output");
        exit();
    }

    public function getControllerAction(){
        $controller = Route::currentRouteAction();
        return $action = substr($controller, (strpos($controller, '@')+1));
    }
}