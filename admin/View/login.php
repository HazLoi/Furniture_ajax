<style>
    /* CSS cho màn hình nhỏ */
    @media (max-width: 576px) {
        .divImage {
            height: 50vh;
            background: #eaf0fa;
        }

        .divContent {
            height: 50vh;
        }
    }

    /* CSS cho màn hình trung bình */
    @media (min-width: 577px) and (max-width: 992px) {
        .divImage {
            height: 100vh;
            background: #eaf0fa;
        }

        .divContent {
            height: 100vh;
        }
    }

    /* CSS cho màn hình lớn */
    @media (min-width: 993px) {
        .divImage {
            height: 100vh;
            background: #eaf0fa;
        }
    }
</style>

<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12 divImage">
        <div class="d-flex justify-content-center align-items-center h-100">
            <img class="img-fluid" src="assets/img/banner-login.png" alt="">
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12 d-flex align-items-center divContent">
        <div class="w-100">
            <div class="">
                <div class="text-center">
                    <h1 class="h4 mb-4">Furnitica - Đăng nhập</h1>
                </div>
                <div class="text-center">
                    <h1 class="h6 mb-4">Xin chào, vui lòng nhập thông tin đăng nhập</h1>
                    <h1 class="h4 mb-4">Furnitica - Bán đồ nội thất | Tư vấn thiết kế nội thất | giá rẻ - furniture.vn</h1>
                </div>
                <form class="user" id="formLoginAdmin">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" name="email" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Tên đăng nhập" value="admin@gmail.com">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control form-control-user" name="password" placeholder="Mật khẩu" value="123456">
                    </div>
                    <button class="btn btn-primary btn-user btn-block">
                        Đăng nhập
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>