@extends('user/dataUser/base/base')

@section('content')
<style>
  /* #table_filter > label > input */
  #search{
  width: 300px;
  height: 50px;
  background: pink;
  font-size: 10pt;
  float: left;
  color: #63717f;
  padding-left: 45px;
  -webkit-border-radius: 5px;
  -moz-border-radius: 5px;
  border-radius: 5px;
  margin-bottom: 20px;
  margin-left: 10px;
  margin-top: 5px;
  }
  #table_length{
    display: none;
  }
  #table_filter > label > #text{
    display: none;
  }

  .dataTables_empty{
    display: none;
  } 
</style>
<section class="pt-32 md:pt-36 min-h-screen mb-12">
  <div class="container mx-auto">
    <div class="w-full px-7">
      <div class="max-w-xl mx-auto text-center">
        <h4 class="font-extrabold text-xl text-rose-500 mb-2">
          Data Tamu
        </h4>
        <h2 class="font-bold text-slate-900 text-3xl mb-8">
          Daftar Tamu Undangan Kamu
        </h2>
        <a href="{{ route('tambah_tamu', $datas->id) }}">
          <button type="button" class="text-white bg-rose-500 hover:bg-rose-800 focus:ring-4 focus:ring-rose-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-rose-500 dark:hover:bg-rose-300 focus:outline-none dark:focus:ring-rose-500">
              Tambah Data Tamu
          </button>
        </a>  
      </div>
    
      <div class="container mb-12 text-center">
        <div class="overflow-x-auto relative shadow-md sm:rounded-lg mt-2">
          @if(Session::get('tambah'))
            <script>
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Data Berhasil Di Tambahkan',
                    showConfirmButton: false,
                    timer: 1500
                })
            </script>
          @endif
          @if(Session::get('update'))
            <script>
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Data Berhasil Di Edit',
                    showConfirmButton: false,
                    timer: 1500
                })
            </script>
          @endif
          @if(Session::get('kirim'))
            <script>
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Email Terkirim',
                    showConfirmButton: false,
                    timer: 1500
                })
            </script>
          @endif
          @if(Session::get('presensi'))
            <script>
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Tamu Berhasil Melakukan Presensi',
                    showConfirmButton: false,
                    timer: 1500
                })
            </script>
          @endif
          <div class="w-full flex justify-start">
            <input type="text" class="mx-5 my-3 bg-rose-100 border border-rose-200 focus:ring-rose-600 focus:bg-rose-100 focus:ring-1 w-1/4 rounded-lg hover:border-rose-500" id="search" placeholder="Search">
          </div>
          <table id="table" class="w-full border mx-auto text-sm text-center text-rose-400 dark:text-rose-400">
            <!-- <input type="text" id="search" placeholder="search..."> -->
            
            <thead class="text-xs bg-rose-500 text-white uppercase dark:bg-rose-500 dark:text-white">
              <tr data-name="data">
                <th scope="col" class="py-3 px-6">
                  Nama
                </th>
                <th scope="col" class="py-3 px-6">
                  E-Mail
                </th>
                <th scope="col" class="py-3 px-6">
                  Acara
                </th>
                <th scope="col" class="py-3 px-6">
                  Status Undangan
                </th>
                <th scope="col" class="py-3 px-6">
                  Status Presensi
                </th>
                <th scope="col" class="py-3 px-6">
                  Kirim
                </th>
                <th scope="col" class="py-3 px-6">
                  Lihat Tamu
                </th>
                <th scope="col" class="py-3 px-6">
                  Presensi
                </th>
                <th scope="col" class="py-3 px-6">
                  Action
                </th>
              </tr>
            </thead>
            <tbody class="text-rose-700 bg-rose-500 dark:bg-rose-500">
              @forelse($data as $d)
                <tr data-name="data" class="bg-white border-b hover:bg-rose-100">
                  <td class="py-4 px-6">
                    {{ $d->nama }}
                  </td>
                  <td class="py-4 px-6">
                    {{ $d->email }}
                  </td>
                  <td class="py-4 px-6">
                    {{ $d->judul_acara }}
                  </td>
                  <td class="py-4 px-6" id="status_undangan">
                    {{ $d->status_undangan }}
                  </td>
                  <td class="py-4 px-6" id="status_presensi">
                    {{ $d->status_presensi }}
                  </td>
                  <?php  
                  if($d->status_undangan == 'terkirim'){
                  ?>
                  <td class="py-4 px-6">
                    <div class="font-medium text-rose-700 dark:text-rose-700">
                        <div class="text-rose-700 bg-white border border-rose-500 font-medium rounded-full text-sm px-4 py-2 dark:bg-white dark:text-rose-700">
                            Terkirim
                        </div>
                    </div>
                  </td>
                  <?php }else{ ?>
                  <td class="py-4 px-6">
                    <a class="font-medium text-rose-700 dark:text-rose-700" href="{{ route('kirim_tamu', ['id' => $datas->id, 'id_tamu' => $d->id ]) }}">
                        <button type="button" class="text-rose-700 bg-white border border-rose-500 focus:outline-none hover:bg-rose-500 focus:ring-4 hover:text-white focus:ring-rose-500 font-medium rounded-full text-sm px-4 py-2 dark:bg-white dark:text-rose-700 dark:border-rose-700 dark:hover:bg-rose-500 dark:hover:text-white dark:hover:border-rose-700 dark:focus:ring-rose-500">
                            Kirim
                        </button>
                    </a>
                  </td>
                  <?php } ?>
                  <td class="py-4 px-6">
                    <a class="font-medium text-rose-700 dark:text-rose-700" href="{{route('lihat_tamu', ['id' => $datas->id, 'id_tamu' => $d->id ] )}}">
                      <button type="button" class="text-rose-700 bg-white border border-rose-500 focus:outline-none hover:bg-rose-500 focus:ring-4 hover:text-white focus:ring-rose-500 font-medium rounded-full text-sm px-5 py-2 dark:bg-white dark:text-rose-700 dark:border-rose-700 dark:hover:bg-rose-500 dark:hover:text-white dark:hover:border-rose-700 dark:focus:ring-rose-500">
                        Lihat
                      </button>
                    </a>
                  </td>
                  <td class="py-4 px-6">
                    <a class="font-medium text-rose-700 dark:text-rose-700" href="{{route('presensi_tamu', ['id' => $datas->id, 'id_tamu' => $d->id ] )}}">
                      <button type="button" class="text-rose-700 bg-white border border-rose-500 focus:outline-none hover:bg-rose-500 focus:ring-4 hover:text-white focus:ring-rose-500 font-medium rounded-full text-sm px-5 py-2 dark:bg-white dark:text-rose-700 dark:border-rose-700 dark:hover:bg-rose-500 dark:hover:text-white dark:hover:border-rose-700 dark:focus:ring-rose-500">
                        Presensi
                      </button>
                    </a>
                  </td>
                  <td class="py-4 px-6">
                    <div class="grid grid-cols-none lg:grid-cols-1">
                        <div class="mb-2">
                            <a href="{{route('edit_tamu', ['id' => $datas->id, 'id_tamu' => $d->id ] )}}">
                                <button type="button" class="text-white bg-yellow-400 hover:bg-yellow-300 focus:ring-4 focus:ring-yellow-500 font-medium rounded-lg text-sm px-2 py-2 dark:bg-yellow-400 dark:hover:bg-yellow-300 focus:outline-none dark:focus:ring-yellow-500">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </button>        
                            </a>
                        </div>
                        <div>
                            <form action="{{ route('hapus_tamu', ['id' => $datas->id, 'id_tamu' => $d->id ]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                                <input type="hidden" name="_method" value="DELETE">
                                <button data-judul="{{ $d->nama }}" class="btndelete text-white bg-red-700 hover:bg-red-300 focus:ring-4 focus:ring-red-500 font-medium rounded-lg text-sm px-2 py-2 dark:bg-red-700 dark:hover:bg-red-300 focus:outline-none dark:focus:ring-red-500" type="submit">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                  </td>
                </tr>
              @empty
                <div class="p-4 mb-4 text-sm text-yellow-700 bg-yellow-100 rounded-lg" role="alert">
                  <span class="font-medium">Tidak Ada Data!</span>
                </div>
              @endforelse
            </tbody>
          </table>
          {{ $data->links() }}
        </div>
      </div>
      <div class="container text-center">
      <a href="/data_undangan">
        <button type="button" class="text-white bg-rose-500 hover:bg-rose-800 focus:ring-4 focus:ring-rose-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-rose-500 dark:hover:bg-rose-300 focus:outline-none dark:focus:ring-rose-500">
            Kembali
        </button>
      </a>   
    </div>
  </div>
</section>
<script>
$('.btndelete').click(function(event) {
    var form = $(this).closest('form');
    var name = $(this).data('name');
    var judul = $(this).attr('data-judul');
    event.preventDefault();

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 focus:outline-none',
            cancelButton: 'focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2'
        },
        buttonsStyling: false
    })

    swalWithBootstrapButtons.fire({
        title: 'Apakah Anda Yakin Akan Menghapus Tamu Atas Nama ' + judul + '?',
        text: "Anda Tidak Akan Bisa Memulihkan Data Ini !",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit(),
            swalWithBootstrapButtons.fire(
            'Deleted!',
            'Data Anda Berhasil Terhapus.',
            'success'
            )
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
            'Cancelled',
            'Tamu atas nama '+ judul +' Aman :)',
            'error'
            )
        }
    })
});
</script>
  <script>
    $(document).ready(function($){

      $hadir = document.getElementById('search').value;
$('#table tr').each(function(){
    $(this).attr('searchData', $(this).text().toLowerCase());
});
$('#search').on('keyup', function(){
var dataList = $(this).val().toLowerCase();
    $('#table tr').each(function(){
        if ($(this).filter('[searchData *= ' + dataList + ']').length > 0 || dataList.length < 1) {
            $(this).show();
        }else {
            $(this).hide();
        }
    });
});
$('#search').on('keydown', function(){
var dataList = $(this).val().toLowerCase();
    $('#table tr').each(function(){
        if ($(this).val() == '') {
            $(this).show();
        }
    });
});
});
</script>
<script>
  $(function(){
  $('#table').createTablePagination({
    rowPerPage: 20,
  });
});
</script>
@endsection