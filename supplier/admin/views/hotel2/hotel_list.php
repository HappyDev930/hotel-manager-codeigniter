<?php $this->load->view('data_tables_css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<section id="content">
  <div class="page page-tables-datatables">
    <div class="row">
      <div class="col-md-12">
        <div class="pageheader">
          <h2>Hotel list</h2>
          <div class="page-bar br-5">
            <ul class="page-breadcrumb">
              <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
              <li><a class="active">Hotel List</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <section class="boxs">
          <div class="boxs-header dvd dvd-btm">
            <h1 class="custom-font"></h1>
            <ul class="controls">
              <li> <a role="button" tabindex="0" class="boxs-refresh"> <i class="fa fa-refresh"></i> </a> </li>
              <li> <a role="button" tabindex="0" class="boxs-toggle"> <span class="minimize"><i class="fa fa-angle-down"></i></span> <span class="expand"><i class="fa fa-angle-up"></i></span> </a> </li>
            </ul>
          </div>
          <div class="boxs-body">
            <?php 
            $sess_msg = $this->session->flashdata('message');
            if(!empty($sess_msg)){
              $message = $sess_msg;
              $class = 'success';
            } else {
              $message = $error;
              $class = 'danger';
            }
            ?>
            <?php if($message){ ?>
            <br>
            <div class="alert alert-<?php echo $class ?>">
              <button class="close" data-dismiss="alert" type="button">×</button>
              <strong><?php echo ucfirst($class) ?>....!</strong>
              <?php echo $message; ?>
            </div>
            <?php } ?>
            <div class="row">
              <div class="col-md-6">
                <div id="tableTools"></div>
              </div>
              <div class="col-md-6">
                <div id="colVis"></div>
              </div>
            </div>
            <table class="table table-custom" id="advanced-usage">
              <thead>
                <tr>
                  <th>SL. No.</th>
                  <th>Property Name</th>
                  <th>Property Id</th>
                  <th>Property Type</th>
                  <th>City</th>
                  <th>Pin Code</th>
                  <th>Status</th>
                  <th>Action</th>
                  <th>Edit</th>
                  <th>Preview</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($hotel)) { ?>
                <?php for ($i = 0; $i < count($hotel); $i++) { ?>
                <tr>
                  <td><?php echo $i+1; ?></td>
                  <td><?php echo $hotel[$i]->hotel_name ?></td>
                  <td><?php echo $hotel[$i]->hotel_code ?></td>
                  <td><?php echo $hotel[$i]->hotel_type ?></td>
                  <td><?php echo $hotel[$i]->hotel_city ?></td>
                  <td><?php echo $hotel[$i]->hotel_pin ?></td>
                  <td>
                    <?php if($hotel[$i]->status == 0) { ?>
                    <label class="label label-danger">Inactive</label>
                    <?php } else { ?>
                    <label class="label label-success">Active</label>
                    <?php } ?>
                  </td>
                  <td>
                    <?php if($hotel[$i]->status == 0) { ?>
                    <a class="btn btn-success btn-xs" href="<?php echo site_url(); ?>hotel/set_status/<?php echo $hotel[$i]->id;  ?>/1" onclick="return confirm('Do you really want to Active this Package. ?')"><i class="fa fa-check"></i> Active</a>
                    <?php } else { ?>
                    <a class="btn btn-danger btn-xs" href="<?php echo site_url(); ?>hotel/set_status/<?php echo $hotel[$i]->id;  ?>/0" onclick="return confirm('Do you really want to InActive this Package. ?')"><i class="fa fa-times"></i> Inactive</a>
                    <?php } ?>
                  </td>
                  <td><a class="btn btn-info btn-xs" href="<?php echo site_url(); ?>hotel/edit_hotel?id=<?php echo $hotel[$i]->id; ?>"><i class="fa fa-pencil"></i> Edit</a></td>
                  <td><a  target="_blank" class="btn btn-primary btn-xs" href="<?php echo str_replace('supplier/', '', site_url()) ?>hotel/hotel/<?php echo $hotel[$i]->id; ?>"><i class="fa fa-eye"></i> Preview</a></td>
                </tr>
                <?php } ?>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </section>
      </div>
    </div>
  </div>
</section>
<?php echo $this->load->view('data_tables_js'); ?>
<script src="<?php echo base_url(); ?>public/js/main.js"></script>
<script type="text/javascript">
  $(window).load(function(){

    //initialize responsive datatable
    // function stateChange(iColumn, bVisible) {
    //   console.log('The column', iColumn, ' has changed its status to', bVisible);
    // }

    var table4 = $('#advanced-usage').DataTable({
      "aoColumnDefs": [
        { 'bSortable': false, 'aTargets': [ "no-sort" ] }
      ]
    });

    var colvis = new $.fn.dataTable.ColVis(table4);

    $(colvis.button()).insertAfter('#colVis');
    $(colvis.button()).find('button').addClass('btn btn-default').removeClass('ColVis_Button');

    var tt = new $.fn.dataTable.TableTools(table4, {
      sRowSelect: 'single',
      "aButtons": [
        'copy',
        'print', {
          'sExtends': 'collection',
          'sButtonText': 'Save',
          'aButtons': ['csv', 'xls', 'pdf']
        }
      ],
      "sSwfPath": "<?php echo base_url(); ?>public/js/vendor/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
    });

    $(tt.fnContainer()).insertAfter('#tableTools');
    //*initialize responsive datatable

  });
</script> 