<?php

require_once('./class.phpmailer.php');
include_once("class.smtp.php"); //可选,否则会在class.phpmailer.php中包含

$mail = new PHPMailer(true); //实例化PHPMailer类,true表示出现错误时抛出异常

$mail->IsSMTP(); // 使用SMTP

try {
  $mail->CharSet ="UTF-8";//设定邮件编码
  $mail->Host       = "smtp.qq.com"; // SMTP server
  $mail->SMTPDebug  = 1;                     // 启用SMTP调试 1 = errors  2 =  messages
  $mail->SMTPAuth   = true;                  // 服务器需要验证
  $mail->Port       = 465;					//默认端口
  //$mail->Port       = 465;                    // ssl验证时默认端口
  $mail->SMTPSecure = "ssl";     
/*
$mail->SMTPSecure = "ssl";                 
$mail->Host       = "smtp.gmail.com";     
$mail->Port       = 465;                  
*/
  $mail->Username="468632883@qq.com";       //SMTP服务器的用户帐号
  $mail->Password="akxjpomhdqexbgdh";       //SMTP服务器的用户密码
  $mail->AddReplyTo('468632883@qq.com', '回复'); //收件人回复时回复到此邮箱,可以多次执行该方法
  $mail->AddAddress('468632883@qq.com', '李明'); //收件人如果多人发送循环执行AddAddress()方法即可 还有一个方法时清除收件人邮箱ClearAddresses()
  $mail->IsHTML(true);
  $mail->SetFrom('468632883@qq.com', '发件人');//发件人的邮箱
  // $mail->AddAttachment('./phpmainer/img/bloglogo.png');      // 添加附件,如果有多个附件则重复执行该方法
  // $mail->Subject = '这里是邮件的标题' . date('Y-m-d H:i:s');

  //以下是邮件内容
  // $contact=$_GET['contact'];
  // $name=$_GET['name'];
  // $mail->Body = "<h3>$textarea</h3><h2></h2>";
  $textarea=$_GET['text'];
  $contact=$_GET['contact'];
  $name=$_GET['name'];
  $body = file_get_contents('tpl.html'); //获取html网页内容
  $body2=str_replace('%textarea%',"$textarea",$body);
  $body3=str_replace('%name%',"$name",$body2);
  $body4=str_replace('%contact%',"$contact",$body3);
  $mail->MsgHTML(str_replace('\\','',$body4));
  // echo $body2;

  $mail->Send();
  echo '<script>window.location.href="success.html"</script>';
} catch (phpmailerException $e) {
  echo $e->errorMessage(); //从PHPMailer捕获异常
} catch (Exception $e) {
  echo $e->getMessage();
}
?>
