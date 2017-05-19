<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class SendMail {

    function html($data = '') {
        $logo = BASE_URL.LOGO;
        $ten = TENSHOP;
        $diachi = DIACHI;
        $sdt = SDT;
        $email = EMAIL;
        $html = <<<ABC
          <div>
         <div style='background-color: #f5f5f5;text-align: center;border-radius: 5px;padding: 15px;'>
         <img src="$logo">
         </div>  
              <div><h3 style='text-align: center;'>$ten</h3></div>
               <div style='background-color: #f5f5f5;border-radius: 5px;text-align: left;padding-bottom: 2px;'>
              <div style='    border-left: 5px solid #e3ae1e;padding: 5px;'>
              <p>Địa chỉ: $diachi</p>
              <p>SDT: $sdt</p>
              <p>Email: $email</p>
              </div>
              
              <div style='background-color: white;margin: 10px;box-shadow: 0px 0px 15px -5px #A98C66;line-height: 1.5;'>
               <p style='    padding: 10px;'>
              $data;
              </p>
               </div>
              </div>
         </div>
ABC;
        return $html;
    }
    function run($nguoinhan = Array(), $data) {
        $mail = new PHPMailer(true);
//Khai báo gửi mail bằng SMTP
        $mail->IsSMTP();
        $mail->Debugoutput = "html"; // Lỗi trả về hiển thị với cấu trúc HTML
        $mail->Host = "smtp.gmail.com"; //host smtp để gửi mail
        $mail->Port = 587; // cổng để gửi mail
        $mail->SMTPSecure = "tls"; //Phương thức mã hóa thư - ssl hoặc tls
        $mail->SMTPAuth = true; //Xác thực SMTP
        $mail->Username = TAIKHOANMAIL; // Tên đăng nhập tài khoản Gmail
        $mail->Password = MATKHAUMAIL; //Mật khẩu của gmail
        $mail->SetFrom(TAIKHOANMAIL, TENSHOP); // Thông tin người gửi
        $mail->AddReplyTo(TAIKHOANMAIL, TENSHOP); // Ấn định email sẽ nhận khi người dùng reply lại.
        foreach ($nguoinhan as $value) {
            $mail->AddAddress($value['diachi'], $value['ten']); //Email của người nhận  
        }
        $mail->Subject = $data['tieude']; //Tiêu đề của thư     
        $mail->MsgHTML($this->html($data['noidung'])); //Nội dung của bức thư.
        $mail->CharSet = 'UTF-8';
        if (!$mail->Send()) {
            return array('status' => 0);
        } else
            return array('status' => 1);
    }
}
