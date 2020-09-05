<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // $this->call(Danhmuc::class);
        // $this->call(Loaidanhmuc::class);
        // $this->call(Thietbi::class);
        // $this->call(Theloai::class);
        // $this->call(Loai::class);
        // $this->call(users::class);
        // $this->call(Sanpham::class);
        $this->call(nhacungcap::class);
    }
}
class Danhmuc extends Seeder
{
    /**
     * summary
     */
    public function run()
    {
        DB::table('danhmuc')->insert([
        	['tendm'=>'Ubiquiti'],
        	['tendm'=>'Thiết bị mạng'],
        	['tendm'=>'Thiết bị mạng không dây'],
        	['tendm'=>'Thiết bị mạng bảo mật'],
        	['tendm'=>'Thiết bị mạng bằng tải'],
        	['tendm'=>'Tủ RACK, cáp mạng, Phụ kiện']
        ]);
    }
}
/**
 * summary
 */
class Loaidanhmuc extends Seeder
{
    /**
     * summary
     */
    public function run()
    {
        DB::table('loaidanhmuc')->insert([
        	['tenldm'=>'Unifi','iddm'=>1],
        	['tenldm'=>'EdgeMax','iddm'=>1],
        	['tenldm'=>'airMAX','iddm'=>1],
        	['tenldm'=>'AmpliFi','iddm'=>1],
        	['tenldm'=>'UFiber','iddm'=>1],
        	['tenldm'=>'Thiết bị mạng MikroTik','iddm'=>2],
        	['tenldm'=>'Thiết bị mạng Cisco','iddm'=>2],
        	['tenldm'=>'Thiết bị mạng HP','iddm'=>2],
        	['tenldm'=>'Thiết bị wifi Mikrotik','iddm'=>3],
        	['tenldm'=>'Thiết bị mạng Cisco','iddm'=>3],
        	['tenldm'=>'Cisco ASA 5500 Series','iddm'=>4],
        	['tenldm'=>'Meraki Cloud Managed Security','iddm'=>4],
        	['tenldm'=>'Thiết bị Fortigate','iddm'=>4],
        	['tenldm'=>'Cáp mạng AMP và phụ kiện','iddm'=>5],
        ]);
    }
}
/**
 * summary
 */
class Thietbi extends Seeder
{
    /**
     * summary
     */
    public function run()
    {
        DB::table('phanloai')->insert([
            ['tenpl'=>'WiFi','idl'=>'1'],
            ['tenpl'=>'Switch','idl'=>'1'],
            ['tenpl'=>'Gateway','idl'=>'1'],
            ['tenpl'=>'Video','idl'=>'1'],
            ['tenpl'=>'EdgeRouter','idl'=>'2'],
            ['tenpl'=>'EdgeSwitch','idl'=>'2']
        ]);
    }
}
/**
 * summary
 */
class Theloai extends Seeder
{
    /**
     * summary
     */
    public function run()
    {
        DB::table('theloai')->insert([
            ['tentl'=>'Dịch vụ'],
            ['tentl'=>'Giải pháp'],
            ['tentl'=>'Tin tức']
        ]);
    }
}
/**
 * summary
 */
class Loai extends Seeder
{
    /**
     * summary
     */
    public function run()
    {
        DB::table('loaitheloai')->insert([
            ['tenltl'=>'Dịch vụ Hỗ trợ nhân lực CNTT','idtl'=>'1'],
            ['tenltl'=>'Các dịch vụ online','idthn'=>'1'],
            ['tenltl'=>'Tư vấn giải pháp hệ thống','idtl'=>'1'],
            ['tenltl'=>'Giải pháp mạng LAN - WAN','idtl'=>'2'],
            ['tenltl'=>'Giải pháp lưu trữ','idtl'=>'2'],
            ['tenltl'=>'Giải pháp nguồn điện','idtl'=>'2'],
            ['tenltl'=>'Tin tức công nghệ','idtl'=>'3'],
            ['tenltl'=>'Chính sách bảo hành','idtl'=>'3'],
            ['tenltl'=>'Tuyển dụng','idtl'=>'3']
        ]);
    }
}
/**
 * summary
 */
class users extends Seeder
{
    /**
     * summary
     */
    public function run()
    {
        DB::table('users')->insert([
            // ['name'=>'Nguyễn Thị Tuyền','email'=>'dacata98@gmail.com','password'=>bcrypt('12345'),'chucvu'=>'0','trangthai'=>'1','tentaikhoan'=>'admin','diachi'=>'Hưng Yên','hinhanh'=>'admin.jpg','ngaysinh'=>'1999-01-30','sdt'=>'0389139005'],
            // ['name'=>'Nguyễn Ngọc Lan Anh','email'=>'nnla24_01@gmail.com','password'=>bcrypt('12345'),'chucvu'=>'1','trangthai'=>'1','tentaikhoan'=>'user1','diachi'=>'Hưng Yên','hinhanh'=>'user1.jpg','ngaysinh'=>'2001-01-30','sdt'=>'0914557400'],
            // ['name'=>'Tạ Thị Tâm','email'=>'tathitam_2@gmail.com','password'=>bcrypt('12345'),'chucvu'=>'1','trangthai'=>'1','tentaikhoan'=>'user2','diachi'=>'Hưng Yên','hinhanh'=>'user2.jpg','ngaysinh'=>'2013-01-30','sdt'=>'0914557400'],
            // ['name'=>'Nguyễn Danh Nam','email'=>'nguyendanhnam_01@gmail.com','password'=>bcrypt('12345'),'chucvu'=>'1','trangthai'=>'1','tentaikhoan'=>'user3','diachi'=>'Hưng Yên','hinhanh'=>'user3.jpg','ngaysinh'=>'2001-01-30','sdt'=>'0914557400'],
            // ['name'=>'Nguyễn Danh Phong','email'=>'nguyendanhphong_01@gmail.com','password'=>bcrypt('12345'),'chucvu'=>'1','trangthai'=>'1','tentaikhoan'=>'user4','diachi'=>'Hưng Yên','hinhanh'=>'user4.jpg','ngaysinh'=>'2001-01-30','sdt'=>'0914557400'],
            // ['name'=>'Tạ Minh Huy','email'=>'taminhhuy_01@gmail.com','password'=>bcrypt('12345'),'chucvu'=>'1','trangthai'=>'1','tentaikhoan'=>'user5','diachi'=>'Hưng Yên','hinhanh'=>'user5.jpg','ngaysinh'=>'2001-01-30','sdt'=>'0914557400'],
            // ['name'=>'Tạ Minh Tiến','email'=>'taminhtien_01@gmail.com','password'=>bcrypt('12345'),'chucvu'=>'1','trangthai'=>'1','tentaikhoan'=>'user6','diachi'=>'Hưng Yên','hinhanh'=>'user6.jpg','ngaysinh'=>'2001-01-30','sdt'=>'0914557400'],
            // ['name'=>'Tạ Thu Hà','email'=>'tathuha_01@gmail.com','password'=>bcrypt('12345'),'chucvu'=>'1','trangthai'=>'1','tentaikhoan'=>'user7','diachi'=>'Hưng Yên','hinhanh'=>'user7.jpg','ngaysinh'=>'2001-01-30','sdt'=>'0914557400'],
            // ['name'=>'Nguyễn Danh Thắng','email'=>'nguyendanhthang_01@gmail.com','password'=>bcrypt('12345'),'chucvu'=>'1','trangthai'=>'1','tentaikhoan'=>'user8','diachi'=>'Hưng Yên','hinhanh'=>'user8.jpg','ngaysinh'=>'2001-01-30','sdt'=>'0914557400'],
            // ['name'=>'Đặng Hồng Hạnh','email'=>'danghonghanh_01@gmail.com','password'=>bcrypt('12345'),'chucvu'=>'1','trangthai'=>'1','tentaikhoan'=>'user9','diachi'=>'Hưng Yên','hinhanh'=>'user9.jpg','ngaysinh'=>'2001-01-30','sdt'=>'0914557400'],
            ['name'=>'Văn Dư','email'=>'luongvanham_01@gmail.com','password'=>bcrypt('12345'),'chucvu'=>'1','trangthai'=>'1','tentaikhoan'=>'user10','diachi'=>'Hưng Yên','hinhanh'=>'user10.jpg','ngaysinh'=>'2001-01-30','sdt'=>'0914557400'],

            ['name'=>'Lương Vận Hàm','email'=>'vandu_01@gmail.com','password'=>bcrypt('12345'),'chucvu'=>'1','trangthai'=>'1','tentaikhoan'=>'user11','diachi'=>'Hưng Yên','hinhanh'=>'user11.jpg','ngaysinh'=>'2001-01-30','sdt'=>'0914557400'],

            ['name'=>'Minh Dã','email'=>'mida_01@gmail.com','password'=>bcrypt('12345'),'chucvu'=>'1','trangthai'=>'1','tentaikhoan'=>'user12','diachi'=>'Hưng Yên','hinhanh'=>'user12.jpg','ngaysinh'=>'2001-01-30','sdt'=>'0914557400'],

            ['name'=>'Tả Khinh Hoan','email'=>'tanvanthu_01@gmail.com','password'=>bcrypt('12345'),'chucvu'=>'1','trangthai'=>'1','tentaikhoan'=>'user13','diachi'=>'Hưng Yên','hinhanh'=>'user13.jpg','ngaysinh'=>'2001-01-30','sdt'=>'0914557400'],

            ['name'=>'Tần Vãn Thư','email'=>'takhinhhoan_01@gmail.com','password'=>bcrypt('12345'),'chucvu'=>'1','trangthai'=>'1','tentaikhoan'=>'user14','diachi'=>'Hưng Yên','hinhanh'=>'user14.jpg','ngaysinh'=>'2001-01-30','sdt'=>'0914557400'],

            ['name'=>'Thư Triển Nhan','email'=>'thuonghoanhi_01@gmail.com','password'=>bcrypt('12345'),'chucvu'=>'1','trangthai'=>'1','tentaikhoan'=>'user15','diachi'=>'Hưng Yên','hinhanh'=>'user15.jpg','ngaysinh'=>'2001-01-30','sdt'=>'0914557400'],

            ['name'=>'Thường Hoan Hỉ','email'=>'thutriennhan_01@gmail.com','password'=>bcrypt('12345'),'chucvu'=>'1','trangthai'=>'1','tentaikhoan'=>'user16','diachi'=>'Hưng Yên','hinhanh'=>'user16.jpg','ngaysinh'=>'2001-01-30','sdt'=>'0914557400'],

            ['name'=>'Tả Tả Khán','email'=>'tatakhan_01@gmail.com','password'=>bcrypt('12345'),'chucvu'=>'1','trangthai'=>'1','tentaikhoan'=>'user17','diachi'=>'Hưng Yên','hinhanh'=>'user17.jpg','ngaysinh'=>'2001-01-30','sdt'=>'0914557400'],

            ['name'=>'Kiều Hiểu Kiều','email'=>'cannguca_01@gmail.com','password'=>bcrypt('12345'),'chucvu'=>'1','trangthai'=>'1','tentaikhoan'=>'user18','diachi'=>'Hưng Yên','hinhanh'=>'user18.jpg','ngaysinh'=>'2001-01-30','sdt'=>'0914557400'],

            ['name'=>'Cận Ngữ Ca','email'=>'kieuhieuhieu_01@gmail.com','password'=>bcrypt('12345'),'chucvu'=>'1','trangthai'=>'1','tentaikhoan'=>'user19','diachi'=>'Hưng Yên','hinhanh'=>'user19.jpg','ngaysinh'=>'2001-01-30','sdt'=>'0914557400'],

            ['name'=>'Cách Cách Lai Liễu','email'=>'mieutuly_01@gmail.com','password'=>bcrypt('12345'),'chucvu'=>'1','trangthai'=>'1','tentaikhoan'=>'user20','diachi'=>'Hưng Yên','hinhanh'=>'user20.jpg','ngaysinh'=>'2001-01-30','sdt'=>'0914557400'],

            ['name'=>'Miêu Tư Lý','email'=>'cocachcach_01@gmail.com','password'=>bcrypt('12345'),'chucvu'=>'1','trangthai'=>'1','tentaikhoan'=>'user21','diachi'=>'Hưng Yên','hinhanh'=>'user21.jpg','ngaysinh'=>'2001-01-30','sdt'=>'0914557400'],

            ['name'=>'Lạc Khuynh','email'=>'lackhuynh_01@gmail.com','password'=>bcrypt('12345'),'chucvu'=>'1','trangthai'=>'1','tentaikhoan'=>'user22','diachi'=>'Hưng Yên','hinhanh'=>'user22.jpg','ngaysinh'=>'2001-01-30','sdt'=>'0914557400'],

            ['name'=>'Cố Hi Chi','email'=>'khuchichi_01@gmail.com','password'=>bcrypt('12345'),'chucvu'=>'1','trangthai'=>'1','tentaikhoan'=>'user23','diachi'=>'Hưng Yên','hinhanh'=>'user23.jpg','ngaysinh'=>'2001-01-30','sdt'=>'0914557400'],

            ['name'=>'Khúc Hi Chi','email'=>'cochichi_01@gmail.com','password'=>bcrypt('12345'),'chucvu'=>'1','trangthai'=>'1','tentaikhoan'=>'user24','diachi'=>'Hưng Yên','hinhanh'=>'user24.jpg','ngaysinh'=>'2001-01-30','sdt'=>'0914557400'],

            ['name'=>'Tiểu Tam','email'=>'tieutam_01@gmail.com','password'=>bcrypt('12345'),'chucvu'=>'1','trangthai'=>'1','tentaikhoan'=>'user25','diachi'=>'Hưng Yên','hinhanh'=>'user25.jpg','ngaysinh'=>'2001-01-30','sdt'=>'0914557400'],
            ['name'=>'Trịnh Tú Nghiêm','email'=>'trinhtunghiem_01@gmail.com','password'=>bcrypt('12345'),'chucvu'=>'1','trangthai'=>'1','tentaikhoan'=>'user26','diachi'=>'Hưng Yên','hinhanh'=>'user26.jpg','ngaysinh'=>'2001-01-30','sdt'=>'0914557400'],
            ['name'=>'Lưu Diệp Phi','email'=>'luudiepphi_01@gmail.com','password'=>bcrypt('12345'),'chucvu'=>'1','trangthai'=>'1','tentaikhoan'=>'user27','diachi'=>'Hưng Yên','hinhanh'=>'user27.jpg','ngaysinh'=>'2001-01-30','sdt'=>'0914557400'],

        ]);
    }
}

/**
 * summary
 */
/**
 * summary
 */
class Sanpham extends Seeder
{
    /**
     * summary
     */
    public function run()
    {
        DB::table('sanpham')->insert([
            ['tensp'=>'Ubiquiti UniFi XG (UAP-XG)','hinhanh'=>'uap-xg.jpg','soluong'=>20,'gia'=>250000,'tomtat'=>'Chúng tôi sẽ cập nhật sớm nhất có thể','chitiet'=>'Chúng tôi sẽ cập nhật sớm nhất có thể','idl'=>1,'idpl'=>1]
        ]);
    }
}
/**
 * summary
 */
class nhacungcap extends Seeder
{
    /**
     * summary
     */
    public function run()
    {
        DB::table('nhacungcap')->insert([
            ['tenncc'=>'Uy tín sỉ lẻ 0','diachi'=>'Nhà 30 - Đường Thanh Niên - P. Hồng Hà - TP. Yên Bái','sodienthoai'=>'0914557400','email'=>'ncc_01s@gmail.com'],
            ['tenncc'=>'Uy tín sỉ lẻ 1','diachi'=>'Nhà 29 - Đường Thanh Niên - P. Hồng Hà - TP. Yên Bái','sodienthoai'=>'0914557401','email'=>'ncc_02s@gmail.com'],
            ['tenncc'=>'Uy tín sỉ lẻ 2','diachi'=>'Nhà 28 - Đường Thanh Niên - P. Hồng Hà - TP. Yên Bái','sodienthoai'=>'0914557402','email'=>'ncc_03s@gmail.com'],
            ['tenncc'=>'Uy tín sỉ lẻ 3','diachi'=>'Nhà 27 - Đường Thanh Niên - P. Hồng Hà - TP. Yên Bái','sodienthoai'=>'0914557403','email'=>'ncc_04s@gmail.com'],
            ['tenncc'=>'Uy tín sỉ lẻ 4','diachi'=>'Nhà 26 - Đường Thanh Niên - P. Hồng Hà - TP. Yên Bái','sodienthoai'=>'0914557404','email'=>'ncc_05s@gmail.com'],
            ['tenncc'=>'Uy tín sỉ lẻ 5','diachi'=>'Nhà 25 - Đường Thanh Niên - P. Hồng Hà - TP. Yên Bái','sodienthoai'=>'0914557405','email'=>'ncc_06s@gmail.com'],
            ['tenncc'=>'Uy tín sỉ lẻ 6','diachi'=>'Nhà 24 - Đường Thanh Niên - P. Hồng Hà - TP. Yên Bái','sodienthoai'=>'0914557406','email'=>'ncc_07s@gmail.com'],
            ['tenncc'=>'Uy tín sỉ lẻ 7','diachi'=>'Nhà 23 - Đường Thanh Niên - P. Hồng Hà - TP. Yên Bái','sodienthoai'=>'0914557407','email'=>'ncc_08s@gmail.com'],
            ['tenncc'=>'Uy tín sỉ lẻ 8','diachi'=>'Nhà 22 - Đường Thanh Niên - P. Hồng Hà - TP. Yên Bái','sodienthoai'=>'0914557408','email'=>'ncc_09s@gmail.com'],
            ['tenncc'=>'Uy tín sỉ lẻ 9','diachi'=>'Nhà 21 - Đường Thanh Niên - P. Hồng Hà - TP. Yên Bái','sodienthoai'=>'0914557409','email'=>'ncc_10s@gmail.com'],
            ['tenncc'=>'Uy tín sỉ lẻ 10','diachi'=>'Nhà 20 - Đường Thanh Niên - P. Hồng Hà - TP. Yên Bái','sodienthoai'=>'0914557410','email'=>'ncc_11s@gmail.com'],
            ['tenncc'=>'Uy tín sỉ lẻ 11','diachi'=>'Nhà 19 - Đường Thanh Niên - P. Hồng Hà - TP. Yên Bái','sodienthoai'=>'0914557411','email'=>'ncc_12s@gmail.com'],
            ['tenncc'=>'Uy tín sỉ lẻ 12','diachi'=>'Nhà 18 - Đường Thanh Niên - P. Hồng Hà - TP. Yên Bái','sodienthoai'=>'0914557412','email'=>'ncc_13s@gmail.com']
        ]);
    }
}
