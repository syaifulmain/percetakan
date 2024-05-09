<div class="container-fluid">
    <div class="m-auto align-content-center main-bg" style="height: 990px; width: 1440px">
        <div class="col-7 m-auto bg-white align-content-center shadow p-3 mb-5 bg-body-tertiary rounded-4"
             style="height: 750px">
            <div style="margin-left: 120px; margin-right: 120px">
                <h1 class="text-center fw-bolder text-success" style="margin-bottom: 60px">Login</h1>
                <form action="/login" method="post">
                    <div class="btn-group btn-group-lg d-grid d-md-flex" style="margin-bottom: 40px">
                        <input type="radio" class="btn-check" name="role" id="karyawan"
                               autocomplete="off" checked value="karyawan">
                        <label class="btn btn-outline-success fw-medium btn-lg" for="karyawan">Karyawan</label>
                        <input type="radio" class="btn-check" name="role" id="admin"
                               autocomplete="off" value="admin">
                        <label class="btn btn-outline-success fw-medium btn-lg" for="admin">Admin</label>
                    </div>
                    <div class="row gap-4 ">
                        <div class="input-group-lg">
                            <label for="username" class="form-label fw-medium fs-5 ">Username</label>
                            <input type="text" class="form-control bg-secondary-subtle" id="username" name="username"
                                   placeholder="Masukan Username" style="background-color: #eeebe3" value="<?= $_POST['username'] ?? '' ?>">
                        </div>
                        <div class="input-group-lg">
                            <label for="password" class="form-label fw-medium fs-5">Password</label>
                            <input type="password" class="form-control bg-secondary-subtle" id="password"
                                   name="password" placeholder="Masukan Password" style="background-color: #eeebe3">
                        </div>
                    </div>
                    <div class="d-grid" style="margin-top: 60px">
                        <button type="submit" class="btn btn-success fw-medium btn-lg fs-4">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>