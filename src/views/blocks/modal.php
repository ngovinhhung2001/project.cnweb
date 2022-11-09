<!-- Button trigger modal -->
<button id="btnModal" type="button" class="btn btn-primary d-none" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
      <form action="/close" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Thông báo</h5>
          <input type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Close" value=""></button>
        </div>
        <div class="modal-body">
          <p class="text-center"><?= $_SESSION['message'] ?></p>
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-outline-pink" data-bs-dismiss="modal" value="Đóng"></button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php
  $_SESSION['modalURI'] = $_SERVER['REQUEST_URI']
?>