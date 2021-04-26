@extends('admin.layouts.wrapper')

@section('seoTag')
    <meta name="description" content="">
    <meta name="author" content="">
@endsection

@section('pluginLink')
    <!-- toast CSS -->
    <link href="{{ asset('admin-assets/plugins/bower_components/toast-master/css/jquery.toast.css') }}" rel="stylesheet">
    <!-- morris CSS -->
    <link href="{{ asset('admin-assets/plugins/bower_components/morrisjs/morris.css') }}" rel="stylesheet">
    <!-- chartist CSS -->
    <link href="{{ asset('admin-assets/plugins/bower_components/chartist-js/dist/chartist.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin-assets/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css') }}" rel="stylesheet">
    <!-- Calendar CSS -->
    <link href="{{ asset('admin-assets/plugins/bower_components/calendar/dist/fullcalendar.css') }}" rel="stylesheet" />
    <!-- animation CSS -->
    <link href="{{ asset('admin-assets/css/animate.css') }}" rel="stylesheet">
    
@endsection

@section('pageTitle', 'NEWS')

@section('actionBar')
@endSection

@section('pageContent')

<div class="col-sm-12">
    <div class="panel panel-info">
        <div class="panel-wrapper collapse in" aria-expanded="true">
            <div class="panel-body">
                <h3 class="box-title m-b-0 black">NEWS</h3>
                <hr>
                <div class="table-responsive">
                    <form class="col-md-12" method="get">
                      <div class="row">
                        <input type="text" name="search" id="txtSearch" class="form-control col-md-4" placeholder="Mencari judul disini!">
                        <br><br>
                        <button type="button" id="btnSearch" class="btn btn-primary">Cari</button>
                      </div>
                    </form>
                    <br><br><br>

                    <table id="myTable1" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Sumber</th>
                          <th>Judul</th>
                          <th>Link</th>
                          <th>Publish Date</th>
                        </tr>
                      </thead>
                      <tbody id="myTable">

                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('pluginScript')
    <!--Wave Effects -->
    <script src="{{ asset('admin-assets/js/waves.js') }}"></script>
    <!--Counter js -->
    <script src="{{ asset('admin-assets/plugins/bower_components/waypoints/lib/jquery.waypoints.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/bower_components/counterup/jquery.counterup.min.js') }}"></script>
    <!--Morris JavaScript -->
    <script src="{{ asset('admin-assets/plugins/bower_components/raphael/raphael-min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/bower_components/morrisjs/morris.js') }}"></script>
    <!-- chartist chart -->
    <script src="{{ asset('admin-assets/plugins/bower_components/chartist-js/dist/chartist.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js') }}"></script>
    <!-- Calendar JavaScript -->
    <script src="{{ asset('admin-assets/plugins/bower_components/moment/moment.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/bower_components/calendar/dist/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/bower_components/calendar/dist/cal-init.js') }}"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
@endsection

@section('customScript')
    <script type="text/javascript">
        (function() {
            [].slice.call(document.querySelectorAll('.sttabs')).forEach(function(el) {
                new CBPFWTabs(el);
            });
        })();
    </script>
 <script type="text/javascript">
    $( document ).ready(function() {
      getData('')
    });
    $('#btnSearch').on('click', () => {
      getData($('#txtSearch').val())
    })
    getData = (search) => {
      $("#myTable").html('')
      $.ajax({
        type: "GET",
        url: "{{ url('rssData') }}",
        data: {search: search},
        success: (data) => {
          if (data.news.length > 0) {
              for (var i = 0; i < data.news.length; i++) {
                  $("#myTable")
                    .append($('<tr>')
                    .append($('<td>').html(data.news[i].sumber))
                    .append($('<td>').html(data.news[i].title))
                    .append($('<td>').html(
                      '<a target="_blank" href="'+ data.news[i].link +'">'+ data.news[i].link +'</a>'
                    ))
                    .append($('<td>').html(data.news[i].published_date))
                )
              }
          } else {
              $("#myTable")
                .append($('<tr>')
                .append(
                  $('<td colspan="4">').html("Tidak ada data ditemukan dengan kata kunci " + search))
                )
          }
        },
        error: (error) => {
          alert('Maaf terjadi kesalahan nih di RSS yang bersangkutan, mohon untuk refresh ulang')
        }
      })
    }
  </script>
    
    
@endsection
