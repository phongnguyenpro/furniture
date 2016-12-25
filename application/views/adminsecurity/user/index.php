<script src="<?= load_admin_public("assets/js/common.min.js") ?>"></script>
<script src="<?= load_admin_public("assets/js/uikit_custom.min.js") ?>"></script>
<script src="<?= load_admin_public("assets/js/altair_admin_common.min.js") ?>"></script>
<script src="<?= load_admin_public("bower_components/ionrangeslider/js/ion.rangeSlider.min.js") ?>"></script>
<script src="<?= load_admin_public("assets/js/pages/forms_advanced.min.js") ?>"></script>

    <div id='xoa' class="uk-modal">
        <div class="uk-modal-dialog">


            <div class="uk-modal-header">Cảnh báo</div>

            <div class="uk-margin uk-modal-content"><span id="thongbaoxoa">Bạn có chắc muốn xóa hóa đơn này?</span>
            </div>
            <div class="uk-modal-footer uk-text-right">
                <button class="uk-modal-close md-btn md-btn-flat">Cancel</button>

                <form class="hidden" id="xoathuoctinh"
                      action="<?= BASE_URL ?>administrator247/editthuoctinhsanpham/deletethuoctinhchon">


                    <input name="idxoa" class="hidden" id="idxoa" type="text" placeholder="">

                </form>
                <button class="js-modal-confirm md-btn-danger md-btn btnxoa">Ok</button>


            </div>

        </div>
    </div>
    <div class="md-card">
        <div class="md-card-toolbar">
            <h3 class="md-card-toolbar-heading-text">
                Danh sách tài khoản  <a href="<?= ADMIN_URL."user/v_create"; ?>"><button class="btn btn-success"> Thêm mới</button></a>
            </h3>
        </div>

        <div class="md-card uk-margin-medium-bottom">
            <div class="md-card-content boxtable">
                <table id="dt_tableTools1" class="uk-table table-bordered " cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Quyền Sd</th>
                        <th>Avatar</th>
                        <th>Trạng thái</th>
                        <th>Công cụ</th>
                    </tr>
                    </thead>
                </table>

            </div>
        </div>

    </div>
</div>
</div>
<script src="<?= load_admin_public("bower_components/datatables/media/js/jquery.dataTables.min.js") ?>"></script>
<script src="<?= load_admin_public("bower_components/datatables-colvis/js/dataTables.colVis.js") ?>"></script>
<script src="<?= load_admin_public("bower_components/datatables-tabletools/js/dataTables.tableTools.js") ?>"></script>
<script src="<?= load_admin_public("assets/js/custom/datatables_uikit.min.js") ?>"></script>
<script src="<?= load_admin_public("assets/js/pages/plugins_datatables.min.js") ?>"></script>
<script src="<?= load_admin_view("user/js/index.js") ?>"></script>

