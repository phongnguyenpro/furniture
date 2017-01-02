<?php

class SSPTable {

    /**
     * Create the data output array for the DataTables rows
     *
     * @param  array $columns Column information array
     * @param  array $data Data from the SQL get
     * @return array          Formatted data in a row based format
     */
    public $stt = null;
    public $litmit = true;
    public $name = '';
    public function data_output($columns, $data) {
        $tinhtrang = get_invoice_state();
        $out = array();
        for ($i = 0, $ien = count($data); $i < $ien; $i++) {
            $row = array();
            for ($j = 0, $jen = count($columns); $j < $jen; $j++) {
                $column = $columns[$j];
                // Is there a formatter?
                if (isset($column['formatter'])) {
                    $row[$column['dt']] = $column['formatter']($data[$i][$column['db']], $data[$i]);
                } else {
                    switch ($this->name) {
                        case "khachhang":
                            switch ($columns[$j]['dt']) {
                                case 6:
                                    $loai = '';
                                    if ($data[$i][$columns[$j]['db']] == "dangchoduyet")
                                        $loai = '<label><i class="uk-icon uk-icon-check-circle" aria-hidden="true"></i></label>';
                                    if ($data[$i][$columns[$j]['db']] == "danghoatdong")
                                        $loai = '<label><i class="uk-icon uk-icon-check-circle green" aria-hidden="true"></i></label>';
                                    $row[$column['dt']] = $loai;
                                    break;
                                case 7:
                                    $loai = '';
                                    if ($data[$i][$columns[$j]['db']] == "khachhangthuong")
                                        $loai = '<i class="uk-icon uk-icon-heart-o" aria-hidden="true"></i>';
                                    if ($data[$i][$columns[$j]['db']] == "khachhangthanthiet")
                                        $loai = '<i class="uk-icon uk-icon-heart red" aria-hidden="true"></i>';
                                    $row[$column['dt']] = $loai;
                                    break;
                                case 8:

                                    $id_nhanvien = $data[$i][$columns[$j]['db']];
                                    $url = URL . "admin/khachhang/xemkhachhang/" . $id_nhanvien;
                                    $row[$column['dt']] = "<a class='md-btn md-btn-primary' href='$url'>Xem</a>";
                                    break;
                                default :
                                    $row[$column['dt']] = $data[$i][$columns[$j]['db']];
                                    break;
                            }
                            break;
                        case "quanly_khachhang":
                            switch ($columns[$j]['dt']) {
                                case 6:
                                    $loai = '';
                                    if ($data[$i][$columns[$j]['db']] == "dangchoduyet")
                                        $loai = '<label><i class="uk-icon uk-icon-check-circle" aria-hidden="true"></i></label>';
                                    if ($data[$i][$columns[$j]['db']] == "danghoatdong")
                                        $loai = '<label><i class="uk-icon uk-icon-check-circle green" aria-hidden="true"></i></label>';
                                    $row[$column['dt']] = $loai;
                                    break;
                                case 7:
                                    $loai = '';
                                    if ($data[$i][$columns[$j]['db']] == "khachhangthuong")
                                        $loai = '<i class="uk-icon uk-icon-heart-o" aria-hidden="true"></i>';
                                    if ($data[$i][$columns[$j]['db']] == "khachhangthanthiet")
                                        $loai = '<i class="uk-icon uk-icon-heart red" aria-hidden="true"></i>';
                                    $row[$column['dt']] = $loai;
                                    break;
                                case 8:

                                    $id_nhanvien = $data[$i][$columns[$j]['db']];
                                    $url = URL . "quanly/khachhang/xemkhachhang/" . $id_nhanvien;
                                    $row[$column['dt']] = "<a class='md-btn md-btn-primary' href='$url'>Xem</a>";
                                    break;
                                default :
                                    $row[$column['dt']] = $data[$i][$columns[$j]['db']];
                                    break;
                            }
                            break;
                        case "nhanvien_khachhang":
                            switch ($columns[$j]['dt']) {
                                case 6:
                                    $loai = '';
                                    if ($data[$i][$columns[$j]['db']] == "dangchoduyet")
                                        $loai = '<label><i class="uk-icon uk-icon-check-circle" aria-hidden="true"></i></label>';
                                    if ($data[$i][$columns[$j]['db']] == "danghoatdong")
                                        $loai = '<label><i class="uk-icon uk-icon-check-circle green" aria-hidden="true"></i></label>';
                                    $row[$column['dt']] = $loai;
                                    break;
                                case 7:
                                    $loai = '';
                                    if ($data[$i][$columns[$j]['db']] == "khachhangthuong")
                                        $loai = '<i class="uk-icon uk-icon-heart-o" aria-hidden="true"></i>';
                                    if ($data[$i][$columns[$j]['db']] == "khachhangthanthiet")
                                        $loai = '<i class="uk-icon uk-icon-heart red" aria-hidden="true"></i>';
                                    $row[$column['dt']] = $loai;
                                    break;
                                case 8:

                                    $id_nhanvien = $data[$i][$columns[$j]['db']];
                                    $url = URL . "nhanvien/khachhang/xemkhachhang/" . $id_nhanvien;
                                    $row[$column['dt']] = "<a class='md-btn md-btn-primary' href='$url'>Xem</a>";
                                    break;
                                default :
                                    $row[$column['dt']] = $data[$i][$columns[$j]['db']];
                                    break;
                            }
                            break;

                        case "quanly_hoadon":
                            $row[9] = '<a href=' . ADMIN_URL . 'invoice/view/' . $data[$i]['invoice_id'] . ' class="label label-info">Xem</a>';
// --------------------------- check quyền xóa hóa đơn tại đây --------------------------------------------
                            if (check_login_user(array(1)) && $data[$i][$columns[7]['db']] != 3) {
                                $row[9] .= ' <a  data-id=' . $data[$i]['invoice_id'] . ' class="label label-danger xoa">Xóa</a>';
                                1 == 1;
                            }
                            switch ($columns[$j]['dt']) {
                                case 7:
                                    switch ($data[$i][$columns[$j]['db']]) {
                                        case 1:
                                            $row[$column['dt']] = '<span class="label label-default">' . $tinhtrang[$data[$i][$columns[$j]['db']]] . '</span>';
                                            break;
                                        case 2:
                                            $row[$column['dt']] = '<span class="label label-info">' . $tinhtrang[$data[$i][$columns[$j]['db']]] . '</span>';
                                            break;
                                        case 3:
                                            $row[$column['dt']] = '<span class="label label-success">' . $tinhtrang[$data[$i][$columns[$j]['db']]] . '</span>';
                                            break;
                                    }
                                    break;
                                case 6:
                                    $row[$column['dt']] = "$" . tien($data[$i][$columns[$j]['db']]) . "VND";
                                    break;
                                case 8:
                                    switch ($data[$i][$columns[$j]['db']]) {
                                        case 1:
                                            $row[$column['dt']] = '<span class="label label-success">' . "Đã giao hàng" . '</span>';
                                            break;
                                        case 2:
                                            $row[$column['dt']] = '<span class="label label-default">' . "Chưa giao hàng" . '</span>';
                                            break;
                                    }
                                    break;
                                default :
                                    $row[$column['dt']] = $data[$i][$columns[$j]['db']];
                                    break;
                            }
                            break;

                        case "nhanvien_hoadon":
                            switch ($columns[$j]['db']) {
                                case "trangthai":
                                    $loai = '';
                                    if ($data[$i][$columns[$j]['db']] == "chuaduyet")
                                        $loai = '<label><i class="uk-icon uk-icon-check-circle" aria-hidden="true"></i></label>';
                                    if ($data[$i][$columns[$j]['db']] == "daduyet")
                                        $loai = '<label><i class="uk-icon uk-icon-check-circle green" aria-hidden="true"></i></label>';
                                    $row[$column['dt']] = $loai;
                                    break;

                                case "id_hoadon":

                                    $id_hoadon = $data[$i][$columns[$j]['db']];
                                    $url = URL . "nhanvien/hoadon/xemhoadon/" . $id_hoadon;
                                    $row[$column['dt']] = "<a class='md-btn md-btn-primary' href='$url'>Xem</a>";
                                    break;
                                default :
                                    $row[$column['dt']] = $data[$i][$columns[$j]['db']];
                                    break;
                            }
                            break;
                        case "khachhang_hoadon":
                            switch ($columns[$j]['db']) {
                                case "trangthai":
                                    $loai = '';
                                    if ($data[$i][$columns[$j]['db']] == "chuaduyet")
                                        $loai = '<label><i class="uk-icon uk-icon-check-circle" aria-hidden="true"></i></label>';
                                    if ($data[$i][$columns[$j]['db']] == "daduyet")
                                        $loai = '<label><i class="uk-icon uk-icon-check-circle green" aria-hidden="true"></i></label>';
                                    $row[$column['dt']] = $loai;
                                    break;

                                case "id_hoadon":

                                    $id_hoadon = $data[$i][$columns[$j]['db']];
                                    $url = URL . "nhanvien/hoadon/xemhoadon/" . $id_hoadon;
                                    $row[$column['dt']] = "<a class='md-btn md-btn-primary' href='$url'>Xem</a>";
                                    break;
                                default :
                                    $row[$column['dt']] = $data[$i][$columns[$j]['db']];
                                    break;
                            }
                            break;
//----------- Bai viet index -------------------------
                        case "quanly_baiviet":
                            $row[7] = '<a href=' . ADMIN_URL . 'articles/edit_articles/' . $data[$i]['articles_id'] . ' class="label label-warning">Sửa</a>';
                            $row[7] .= ' <a  data-id=' . $data[$i]['articles_id'] . ' class="label label-danger xoa">Xóa</a>';
                            switch ($columns[$j]['dt']) {
                                case 2:
                                    $row[$column['dt']] = "<img width='50' height='60' src='" . BASE_URL . "public/upload/images/thumb_articles/" . $data[$i][$columns[$j]['db']] . "' >";
                                    break;
                                case 5:
                                    $check = $data[$i][$columns[$j]['db']] == 1 ? "checked" : "";
                                    $row[$column['dt']] = '<input data-id=' . $data[$i]['articles_id'] . ' name="noibat" class="noibat" type="checkbox" data-switchery data-switchery-color="#d32f2f" ' . $check . ' id="switch_demo_danger" />';
                                    break;
                                case 6:
                                    $check = $data[$i][$columns[$j]['db']] == 1 ? "checked" : "";
                                    $row[$column['dt']] = '<input data-id=' . $data[$i]['articles_id'] . ' name="noibat" class="hienthi" type="checkbox"  data-switchery data-switchery-color="#1e88e5" ' . $check . ' id="switch_demo_danger" />';
                                    break;
                                default :
                                    $row[$column['dt']] = $data[$i][$columns[$j]['db']];
                                    break;
                            }
                            break;
                        case "luong":
                            switch ($columns[$j]['dt']) {

                                case 6:

                                    $url = URL . "administrator247/luong/luongchitiet/" . $data[$i]['id_taikhoan'] . "/" . $data[$i]['id_giaidoan'];

                                    $row[$column['dt']] = '<a target="_blank" href="' . $url . '">Chi tiết</a>';
                                    if ($data[$i]['ngaynhan'] == '' || $data[$i]['ngaynhan'] == null) {
                                        $row[$column['dt']] .= '<a class="danhanluong" data-id=' . $data[$i]['id_luong'] . ' title="Xác nhận đã nhận lương" target="_blank">   <label><i class="uk-icon uk-icon-check-circle" aria-hidden="true"></i></label></a>';
                                    } else {
                                        $row[$column['dt']] .= '<a title="Đã nhận lương" target="_blank"><label><i class="uk-icon uk-icon-check-circle green" aria-hidden="true"></i></label></a>';
                                    }
                                    break;

                                default :
                                    $row[$column['dt']] = $data[$i][$columns[$j]['db']];
                                    break;
                            }
                            break;
                        case "nhansu":
                            switch ($columns[$j]['dt']) {
                                case 5:
                                    if ($data[$i][$columns[$j]['db']] == "nhanvien")
                                        $row[$column['dt']] = "Nhân viên";
                                    else
                                        $row[$column['dt']] = "Quản lý";
                                    break;
                                case 6:
                                    $id_nhanvien = $data[$i][$columns[$j]['db']];
                                    $quyensd = $data[$i][5];
                                    if ($quyensd == "quanly") {
                                        $row[$column['dt']] = "<a class='md-btn md-btn-primary' href='" . URL . "admin/nhansu/chitietquanly/$id_nhanvien'>Xem</a>";
                                    } else {
                                        $row[$column['dt']] = "<a class='md-btn md-btn-primary' href='" . URL . "admin/nhanvien1/chitiet/$id_nhanvien'>Xem</a>";
                                    }
                                    break;
                                default :
                                    $row[$column['dt']] = $data[$i][$columns[$j]['db']];
                                    break;
                            }
                            break;
                        case "user":
                            switch ($columns[$j]['dt']) {
                              case 3:
                                  if($data[$i][$columns[$j]['db']] !="")
                                         $row[$column['dt']] = "<img width='50' height='60' src='" . BASE_URL . "public/upload/images/user_profile/" . $data[$i][$columns[$j]['db']] . "' >";
                                  else    $row[$column['dt']]="no image";
                                  break;
                                case 4:
                                    $row[$column['dt']]  = $data[$i][$columns[$j]['db']] == 1 ? "Hoạt động" : "Không hoạt động";
                                    break;
                                case 5:
                                    $user_id = $data[$i][$columns[$j]['db']];
                                    $row[$column['dt']] = "<a class='md-btn md-btn-primary btn-sm' href='" .ADMIN_URL. "user/update/$user_id'>Xem</a>";
                                    $row[$column['dt']] .= "<a data-id='".$user_id."' class='md-btn md-btn-danger btn-sm btn_deleteuser' href='#'>Xóa</a>";
                                    break;
                                default :
                                    $row[$column['dt']] = $data[$i][$columns[$j]['db']];
                                    break;
                            }
                            break;
                        default :
                            $row[$column['dt']] = $data[$i][$columns[$j]['db']];
                            break;
                    }
                }
            }
            $out[] = $row;
        }

        return $out;
    }

    /**
     * Database connection
     *
     * Obtain an PHP PDO connection from a connection details array
     *
     * @param  array $conn SQL connection details. The array should have
     *    the following properties
     *     * host - host name
     *     * db   - database name
     *     * user - user name
     *     * pass - user password
     * @return resource PDO connection
     */
    public function db($conn) {
        if (is_array($conn)) {
            return self::sql_connect($conn);
        }
        return $conn;
    }

    /**
     * Paging
     *
     * Construct the LIMIT clause for server-side processing SQL query
     *
     * @param  array $request Data sent to server by DataTables
     * @param  array $columns Column information array
     * @return string SQL limit clause
     */
    public function limit($request, $columns) {
        $limit = '';
        if (isset($request['start']) && $request['length'] != -1) {
            $limit = "LIMIT " . intval($request['start']) . ", " . intval($request['length']);
            $temp = $request['start'];
            for ($i = 0; $i < $request['length']; $i++) {
                $this->stt[$i] = $temp;
                $temp++;
            }
        } else
            $this->litmit = FALSE;
        return $limit;
    }

    /**
     * Ordering
     *
     * Construct the ORDER BY clause for server-side processing SQL query
     *
     * @param  array $request Data sent to server by DataTables
     * @param  array $columns Column information array
     * @return string SQL order by clause
     */
    public function order($request, $columns) {
        $order = '';
        if (isset($request['order']) && count($request['order'])) {
            $orderBy = array();
            $dtColumns = self::pluck($columns, 'dt');
            for ($i = 0, $ien = count($request['order']); $i < $ien; $i++) {
                // Convert the column index into the column data property
                $columnIdx = intval($request['order'][$i]['column']);
                $requestColumn = $request['columns'][$columnIdx];
                $columnIdx = array_search($requestColumn['data'], $dtColumns);
                $column = $columns[$columnIdx];
                if ($requestColumn['orderable'] == 'true') {
                    $dir = $request['order'][$i]['dir'] === 'asc' ?
                            'ASC' :
                            'DESC';
                    $orderBy[] = '`' . $column['db'] . '` ' . $dir;
                }
            }
            $order = 'ORDER BY ' . implode(', ', $orderBy);
        }
        return $order;
    }

    /**
     * Searching / Filtering
     *
     * Construct the WHERE clause for server-side processing SQL query.
     *
     * NOTE this does not match the built-in DataTables filtering which does it
     * word by word on any field. It's possible to do here performance on large
     * databases would be very poor
     *
     * @param  array $request Data sent to server by DataTables
     * @param  array $columns Column information array
     * @param  array $bindings Array of values for PDO bindings, used in the
     *    sql_exec() function
     * @return string SQL where clause
     */
    public function filter($request, $columns, &$bindings) {
        $globalSearch = array();
        $columnSearch = array();
        $dtColumns = self::pluck($columns, 'dt');
        if (isset($request['search']) && $request['search']['value'] != '') {
            $str = $request['search']['value'];
            for ($i = 0, $ien = count($request['columns']); $i < $ien; $i++) {
                $requestColumn = $request['columns'][$i];
                $columnIdx = array_search($requestColumn['data'], $dtColumns);
                $column = $columns[$columnIdx];
                if ($requestColumn['searchable'] == 'true') {
                    if ($this->name == "quanly_hoadon")
                        if ($i == 4 || $i == 5)
                            $str = loaibodau($str);
                    $binding = self::bind($bindings, '%' . $str . '%', PDO::PARAM_STR);
                    $globalSearch[] = "`" . $column['db'] . "` LIKE " . $binding;
                }
            }
        }
        // Individual column filtering
        if (isset($request['columns'])) {
            for ($i = 0, $ien = count($request['columns']); $i < $ien; $i++) {
                $requestColumn = $request['columns'][$i];
                $columnIdx = array_search($requestColumn['data'], $dtColumns);
                $column = $columns[$columnIdx];
                $str = $requestColumn['search']['value'];
                if ($requestColumn['searchable'] == 'true' &&
                        $str != ''
                ) {
                    $binding = self::bind($bindings, '%' . $str . '%', PDO::PARAM_STR);
                    $columnSearch[] = "`" . $column['db'] . "` LIKE " . $binding;
                }
            }
        }
        // Combine the filters into a single string
        $where = '';
        if (count($globalSearch)) {
            $where = '(' . implode(' OR ', $globalSearch) . ')';
        }
        if (count($columnSearch)) {
            $where = $where === '' ?
                    implode(' AND ', $columnSearch) :
                    $where . ' AND ' . implode(' AND ', $columnSearch);
        }
        if ($where !== '') {
            $where = 'WHERE ' . $where;
        }
        return $where;
    }

    /**
     * Perform the SQL queries needed for an server-side processing requested,
     * utilising the helper functions of this class, limit(), order() and
     * filter() among others. The returned array is ready to be encoded as JSON
     * in response to an SSP request, or can be modified if needed before
     * sending back to the client.
     *
     * @param  array $request Data sent to server by DataTables
     * @param  array|PDO $conn PDO connection resource or connection parameters array
     * @param  string $table SQL table to query
     * @param  string $primaryKey Primary key of the table
     * @param  array $columns Column information array
     * @return array          Server-side processing response array
     */
    public function simple($request, $conn, $table, $tableJoin, $primaryKey, $columns, $sqlwhere, $name = '') {
        if (isset($request['articlescategory_id']))
            $id_danhmuc = $request['articlescategory_id'];
        else
            $id_danhmuc = -1;
        $this->name = $name;
        $bindings = array();
        $db = self::db($conn);
        // Build the SQL query string from the request
        $limit = self::limit($request, $columns);
        $order = self::order($request, $columns);
        $where = self::filter($request, $columns, $bindings);
        if ($id_danhmuc == -1) {
            $data = self::sql_exec($db, $bindings, "SELECT SQL_CALC_FOUND_ROWS `" . implode("`, `", self::pluck($columns, 'db')) . "`
			 FROM `$table`
			 $where 
			 $order
			 $limit"
            );
            // Data set length after filtering
            $resFilterLength = self::sql_exec($db, "SELECT FOUND_ROWS()"
            );
            $recordsFiltered = $resFilterLength[0][0];
            // Total data set length
//		$resTotalLength = self::sql_exec( $db,
//			"SELECT COUNT(`{$primaryKey}`)
//			 FROM   `$table`"
//		);

            $recordsTotal = 1;
        } else {
            if ($where == '')
                $where = " where ";
            else
                $where = $where . " and ";
            // Main query to actually get the data
            $data = self::sql_exec($db, $bindings, "SELECT SQL_CALC_FOUND_ROWS `$table`.`" . implode("`, `$table`.`", self::pluck($columns, 'db')) . "`
			 FROM `$table`, `$tableJoin`
			 $where `$table`.`$primaryKey`=`$tableJoin`.`$primaryKey` and $sqlwhere
			 $order
			 $limit"
            );
            // Data set length after filtering
            $resFilterLength = self::sql_exec($db, "SELECT FOUND_ROWS()"
            );
            $recordsFiltered = $resFilterLength[0][0];
            // Total data set length
//		$resTotalLength = self::sql_exec( $db,
//			"SELECT COUNT(`{$primaryKey}`)
//			 FROM   `$table`"
//		);

            $recordsTotal = 1;
        }
        /*
         * Output
         */
        return array(
            "draw" => isset($request['draw']) ?
                    intval($request['draw']) :
                    0,
            "recordsTotal" => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data" => self::data_output($columns, $data)
        );
    }

    /**
     * The difference between this method and the `simple` one, is that you can
     * apply additional `where` conditions to the SQL queries. These can be in
     * one of two forms:
     *
     * * 'Result condition' - This is applied to the result set, but not the
     *   overall paging information query - i.e. it will not effect the number
     *   of records that a user sees they can have access to. This should be
     *   used when you want apply a filtering condition that the user has sent.
     * * 'All condition' - This is applied to all queries that are made and
     *   reduces the number of records that the user can access. This should be
     *   used in conditions where you don't want the user to ever have access to
     *   particular records (for example, restricting by a login id).
     *
     * @param  array $request Data sent to server by DataTables
     * @param  array|PDO $conn PDO connection resource or connection parameters array
     * @param  string $table SQL table to query
     * @param  string $primaryKey Primary key of the table
     * @param  array $columns Column information array
     * @param  string $whereResult WHERE condition to apply to the result set
     * @param  string $whereAll WHERE condition to apply to all queries
     * @return array          Server-side processing response array
     */
    public function complex($request, $conn, $table, $primaryKey, $columns, $whereResult = null, $whereAll = null) {
        $bindings = array();
        $db = self::db($conn);
        $localWhereResult = array();
        $localWhereAll = array();
        $whereAllSql = '';
        // Build the SQL query string from the request
        $limit = self::limit($request, $columns);
        $order = self::order($request, $columns);
        $where = self::filter($request, $columns, $bindings);
        $whereResult = self::_flatten($whereResult);
        $whereAll = self::_flatten($whereAll);
        if ($whereResult) {
            $where = $where ?
                    $where . ' AND ' . $whereResult :
                    'WHERE ' . $whereResult;
        }
        if ($whereAll) {
            $where = $where ?
                    $where . ' AND ' . $whereAll :
                    'WHERE ' . $whereAll;
            $whereAllSql = 'WHERE ' . $whereAll;
        }
        // Main query to actually get the data
        $data = self::sql_exec($db, $bindings, "SELECT SQL_CALC_FOUND_ROWS @row := @row + 1 AS row `" . implode("`, `", self::pluck($columns, 'db')) . "`
			 FROM `$table`
			 $where
			 $order
			 $limit"
        );
        // Data set length after filtering
        $resFilterLength = self::sql_exec($db, "SELECT FOUND_ROWS()"
        );
        $recordsFiltered = $resFilterLength[0][0];
        // Total data set length
        $resTotalLength = self::sql_exec($db, $bindings, "SELECT COUNT(`{$primaryKey}`)
			 FROM   `$table` " .
                        $whereAllSql
        );
        $recordsTotal = $resTotalLength[0][0];
        /*
         * Output
         */
        return array(
            "draw" => isset($request['draw']) ?
                    intval($request['draw']) :
                    0,
            "recordsTotal" => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data" => self::data_output($columns, $data)
        );
    }

    /**
     * Connect to the database
     *
     * @param  array $sql_details SQL server connection details array, with the
     *   properties:
     *     * host - host name
     *     * db   - database name
     *     * user - user name
     *     * pass - user password
     * @return resource Database connection handle
     */
    public function sql_connect($sql_details) {
        try {
            $db = @new PDO(
                    "mysql:host={$sql_details['host']};dbname={$sql_details['db']}", $sql_details['user'], $sql_details['pass'], array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'', PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
            );
        } catch (PDOException $e) {
            self::fatal(
                    "An error occurred while connecting to the database. " .
                    "The error reported by the server was: " . $e->getMessage()
            );
        }
        return $db;
    }

    /**
     * Execute an SQL query on the database
     *
     * @param  resource $db Database handler
     * @param  array $bindings Array of PDO binding values from bind() to be
     *   used for safely escaping strings. Note that this can be given as the
     *   SQL query string if no bindings are required.
     * @param  string $sql SQL query to execute.
     * @return array         Result from the query (all rows)
     */
    public function sql_exec($db, $bindings, $sql = null) {

        // Argument shifting
        if ($sql === null) {
            $sql = $bindings;
        }
        $stmt = $db->prepare($sql);
        //echo $sql;
        // Bind parameters
        if (is_array($bindings)) {
            for ($i = 0, $ien = count($bindings); $i < $ien; $i++) {
                $binding = $bindings[$i];
                $stmt->bindValue($binding['key'], $binding['val'], $binding['type']);
            }
        }
        // Execute
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            self::fatal("An SQL error occurred: " . $e->getMessage());
        }
        // Return all
        return $stmt->fetchAll();
    }

    /*     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * Internal methods
     */

    /**
     * Throw a fatal error.
     *
     * This writes out an error message in a JSON string which DataTables will
     * see and show to the user in the browser.
     *
     * @param  string $msg Message to send to the client
     */
    public function fatal($msg) {
        echo json_encode(array(
            "error" => $msg
        ));
        exit(0);
    }

    /**
     * Create a PDO binding key which can be used for escaping variables safely
     * when executing a query with sql_exec()
     *
     * @param  array &$a Array of bindings
     * @param  *      $val  Value to bind
     * @param  int $type PDO field type
     * @return string       Bound key to be used in the SQL where this parameter
     *   would be used.
     */
    public function bind(&$a, $val, $type) {
        $key = ':binding_' . count($a);
        $a[] = array(
            'key' => $key,
            'val' => $val,
            'type' => $type
        );
        return $key;
    }

    /**
     * Pull a particular property from each assoc. array in a numeric array,
     * returning and array of the property values from each item.
     *
     * @param  array $a Array to get data from
     * @param  string $prop Property to read
     * @return array        Array of property values
     */
    public function pluck($a, $prop) {
        $out = array();
        for ($i = 0, $len = count($a); $i < $len; $i++) {
            $out[] = $a[$i][$prop];
        }
        return $out;
    }

    /**
     * Return a string from an array or a string
     *
     * @param  array|string $a Array to join
     * @param  string $join Glue for the concatenation
     * @return string Joined string
     */
    public function _flatten($a, $join = ' AND ') {
        if (!$a) {
            return '';
        } else if ($a && is_array($a)) {
            return implode($join, $a);
        }
        return $a;
    }

}
