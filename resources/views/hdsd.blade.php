@extends('admin.layouts')
@section('title')
    Hướng dẫn sử dụng trang web
@stop

@section('content')

    {!! Html::style('public/css/welcome_page.css') !!}

    <div class="row" style="{{ Auth::guest() ? 'margin-top: 60px' : ''}}">
        <div class="panel panel-default">
            <div class="panel-heading">Hướng dẫn sử dụng trang web quản lý tài liệu dùng chung UET DMS</div>
            <div class="panel-body" id="welcome-home">
                <div class="row" style="margin-top: 50px; font-size: 15px">
                    <div class="col-lg-10 col-lg-offset-1">

                        - Hệ thống quản lý tài liệu dùng chung trường đại học Công Nghệ (UET Document Management System) là hệ thống cho phép nhân viên các phòng ban thuộc trường ĐHCN có thể đăng tải, lưu trữ, chia sẻ tài liệu với người dùng cùng phòng (nội bộ) hoặc cùng trường (công khai).
                        <br>
                        - Hướng dẫn này được soạn bởi nhóm phát triển hệ thống.
                        <br><br>
                        1. Hướng dẫn chung:

                        <br><br>

                        - Hệ thống hỗ trợ người dùng đăng nhập bằng tài khoản ctmail trường đại học Công Nghệ - đại học quốc gia Hà Nội. <br>Ví dụ: duynm, ccne, vanntc,...

                        <br>

                        - Với lần đầu đăng nhập hệ thống, người dùng cần cung cấp các thông tin cá nhân cơ bản như Họ và tên, địa chỉ email, phòng làm việc...

                        <br>

                        - Ngoài ra hệ thống hỗ trợ quản trị viên tạo tài khoản người dùng mới, các tài khoản này có thể đăng nhập được bằng mật khẩu cấp sẵn và đổi mật khẩu nếu muốn.

                        <br>

                        - Ngoài ra hệ thống không có chức năng đăng ký.

                        <br>

                        - Để cập nhật thông tin cá nhân, người dùng nhấn biểu tượng người dùng ở góc phải của menu, và lựa chọn chức năng "Thông tin cá nhân". Ở đây người dùng có thể xem thông tin cá nhân của mình và cập nhật thông tin bằng cách chọn phím chức năng "Thay đổi thông tin cá nhân" hoặc "Thay đổi mật khẩu" (với người dùng hệ thống do admin tạo).

                        <br>

                        - Để xem danh sách tài liệu do mình đăng tải, người dùng có thể sử dụng chức năng "Tài liệu của tôi", ở đây người dùng ngoài việc tra cứu có thể sửa | xóa tài liệu.

                        <br>

                        - Tất cả danh sách hiển thị trong hệ thống đều hỗ trợ tìm kiếm, để tìm nội dung, người dùng nhập vào khung tìm kiếm hoặc chọn lựa các phòng ban | lĩnh vực khác nhau...

                        <br><br>

                        2. Đối với quản trị hệ thống:

                        <br><br>

                        - Trang chủ hiển thị thông tin về số lượng tài liệu của hệ thống và mỗi phòng.

                        <br>

                        - Menu "Tài liệu" cho phép admin tra cứu tài liệu và quản lý (thêm | sửa | xóa) chúng.

                        <br>

                        - Menu "Người dùng" cho phép admin xem vàquản lý danh sách người dùng theo đơn vị | phòng ban.

                        <br>

                        - Menu "Phòng ban" cho phép admin xem và quản lý danh sách phòng ban của trường.

                        <br>

                        - Menu "Thể loại tài liệu" cho phép admin xem vàquản lý danh sách thể loại tài liệu phù hợp với hệ thống.

                        <br>

                        - Menu "Lịch sử hệ thống" cho phép admin xem và quản lý lịch sử tương tác với hệ thống của tất cả người dùng.

                        <br>

                        - Một người dùng có thể được cấp quyền admin bởi admin khác.
                        
                        <br><br>

                        3. Đối với quản lý phòng:
                        <br><br>
                        - Quản lý phòng có thể thêm tài liệu thuộc phòng của mình.

                        <br>
                        
                        - Quản lý phòng có thể tra cứu, sửa, xóa đối với tất cả tài liệu thuộc phòng của mình

                        <br><br>

                        4. Đối với người dùng thường:
                        <br><br>

                        - Người dùng hệ thống có thể đăng tải tài liệu thuộc về phòng của mình và quản lý tài liệu do chính mình đăng tải.

                        <br><br>

                        5. Tài liệu:
                        <br><br>

                        - Một tài liệu đăng tải sẽ có các thông tin như Tiêu đề tài liệu, mô tả tài liệu, file đính kèm và trạng thái công khai tài liệu.

                        <br>

                        - Một tài liệu ở trạng thái công khai có thể được tra cứu bởi tất cả người dùng trong hệ thống.

                        <br>

                        - Một tài liệu ở trạng thái nội bộ chỉ được tra cứu bởi người dùng thuộc phòng đăng tải nó.

                        <br>

                        - Một tài liệu được sửa | xóa bởi người đăng, quản lý phòng hoặc quản trị hệ thống.
                        <br><br>

                        6. Lời kết:

                        <br>
                        <br>

                        Do UET DMS là hệ thống đang trong quá trình phát triển nên không thể tránh được lỗi và thiếu xót. Trong quá trình sử dụng, nếu người dùng có bất kì góp ý nào về hệ thống này, vui lòng gửi lời nhắn vào địa chỉ email của TTMT (
                        <a class="linkNormal" href="https://gmail.com" target="_blank">
                        ccne@vnu.edu.vn
                        </a>). Rất mong nhận được sự góp ý phản hồi của tất cả người dùng...
                        <br>
                        <br>

                        Cảm ơn vì đã sử dụng hệ thống của chúng tôi!
                        <br>
                        <br>
                        
                        CCNE

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
