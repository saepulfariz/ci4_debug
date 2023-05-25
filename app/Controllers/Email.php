<?php

namespace App\Controllers;

use App\Models\ModelBot;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Email extends BaseController
{
    private $modelbot;
    public function __construct()
    {
        helper(['form']);
        $this->modelbot = new ModelBot();
    }

    public function index()
    {
        return view('tampilan_form_sendmail');
    }

    public function sendmail()
    {
        $to                 = $this->request->getPost('to');
        $subject            = $this->request->getPost('subject');
        $message            = $this->request->getPost('message');

        $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            // $mail->Host       = 'smtp.googlemail.com';
            // $mail->Host       = 'relay-exchange.pirelli.com';
            $mail->Host       = 'smtp-mail.outlook.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'viewda001@group.pirelli.com'; // ubah dengan alamat email Anda
            // $mail->Username   = 'dashboardsubang.view@pirelli.com'; // ubah dengan alamat email Anda
            $mail->Password   = 'Pirelli001'; // ubah dengan password email Anda


            // $mail->SMTPSecure = 'ssl';
            // $mail->Port       = 465;
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            $mail->setFrom('dashboardsubang.view@pirelli.com', 'Pirelli Test'); // ubah dengan alamat email Anda
            $mail->addAddress($to);
            $mail->addReplyTo('dashboardsubang.view@pirelli.com', 'Pirelli Test'); // ubah dengan alamat email Anda

            // Isi Email
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $message;

            $mail->send();

            // Pesan Berhasil Kirim Email/Pesan Error

            session()->setFlashdata('success', 'Selamat, email berhasil terkirim!');
            return redirect()->to('/email');
        } catch (Exception $e) {
            session()->setFlashdata('error', "Gagal mengirim email. Error: " . $mail->ErrorInfo);
            return redirect()->to('/email');
        }
    }


    public function sendWithImage()
    {

        // $to                 = "kpi.information@evoluzionetyres.com";
        // $subject            = "send email with image";
        // $message            = "Testing";
        $to                 = $this->request->getPost('to');
        $subject            = $this->request->getPost('subject');
        $message            = $this->request->getPost('message');

        $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            // $mail->Host       = 'smtp.googlemail.com';
            // $mail->Host       = 'relay-exchange.pirelli.com';
            $mail->Host       = 'smtp-mail.outlook.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'viewda001@group.pirelli.com'; // ubah dengan alamat email Anda
            // $mail->Username   = 'dashboardsubang.view@pirelli.com'; // ubah dengan alamat email Anda
            $mail->Password   = 'Pirelli001'; // ubah dengan password email Anda


            // $mail->SMTPSecure = 'ssl';
            // $mail->Port       = 465;
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            $mail->setFrom('dashboardsubang.view@pirelli.com', 'Pirelli Test'); // ubah dengan alamat email Anda
            // $mail->addAddress($to);
            $mail->addAddress('dashboardsubang.view@pirelli.com');
            $mail->addReplyTo('dashboardsubang.view@pirelli.com', 'Pirelli Test'); // ubah dengan alamat email Anda

            $id = "teguh.pujisasongko@evoluzionetyres.com
            kpi.information@evoluzionetyres.com";

            $new = explode("\n", $id);

            $mail->isHTML(true);
            $mail->Subject = "Email Notification Alert Warehouse";
            // $mail->Body    = $message;
            $mail->AddEmbeddedImage("assets/20220620111806.png", "my-attach", "assets/20220620111806.png");
            // $mail->Body = 'Embedded Image: <img alt="PHPMailer" src="cid:my-attach"> Here is an image!';

            $mail->Body = "<h1>Our Report current last Shift</h1>
    <p><img src=\"cid:my-attach\" /></p><br><br><br><p>This Email was Generated Automatically 
    <br> By <b>Alert</b> Management System Subang ID</p>";
            $mail->AltBody = "This is text only alternative body.";

            // foreach ($new as $addr) {
            //     $mail->clearAddresses();
            //     $mail->addAddress($addr);

            //     // Isi Email

            //     $mail->send();
            // }


            $mail->AddCC('teguh.pujisasongko@evoluzionetyres.com');
            $mail->AddCC('kpi.information@evoluzionetyres.com');
            $mail->AddCC('muhammad.fadellah@evoluzionetyres.com');
            $mail->AddCC('khairuman.irham@evoluzionetyres.com');
            $mail->AddCC('andri.febriyanto@evoluzionetyres.com');


            // $mail->AddBCC('kpi.information@evoluzionetyres.com');

            $mail->send();



            // Pesan Berhasil Kirim Email/Pesan Error

            session()->setFlashdata('success', 'Selamat, email berhasil terkirim!');
            return redirect()->to('/email');
        } catch (Exception $e) {
            session()->setFlashdata('error', "Gagal mengirim email. Error: " . $mail->ErrorInfo);
            return redirect()->to('/email');
        }
    }


    public function Approve()
    {
        $db = db_connect();
        $builder = $db->table('tb_approve');
        $list = $builder->get()->getResultArray();
        $data = [
            'list' => $list
        ];

        return view('approve/index', $data);
    }

    public function Apply_approve($kode, $number)
    {
        $data = [
            'kode' => $kode,
            'number' => $number,
        ];
        return view('approve/approve', $data);
    }

    public function Send_approve($kode = null, $number = null, $approve = null)
    {

        $mail = new PHPMailer(true);

        $kode_res = $this->request->getVar('kode');
        // $approve = $this->request->getVar('approve');
        $subject = $this->request->getVar('subject');
        $keterangan = $this->request->getVar('keterangan');

        $db = db_connect();
        $builder = $db->table('tb_approve');
        if ($kode == null) {

            $data = [
                'kode' => $kode_res,
                'subject' => $subject,
                'keterangan' => $keterangan,
            ];

            $builder->insert($data);
        } else {
            $builder->where('kode', $kode);
            $data = [
                'approve_' . $number => $approve
            ];
            $builder->update($data);

            $get_approve = $db->table('tb_approve')->where('kode', $kode)->get()->getRowArray();
            $kode_res = $get_approve['kode'];
            $subject = $get_approve['subject'];
            $keterangan = $get_approve['keterangan'];

            if ($approve == 1 && $number == 1) {
                $this->modelbot->sendApprove($kode_res, $subject, $keterangan, 2);
                return "Success Submit";
            } else {
                // return redirect()->to('email/approve');
                // return ""
                return "Success Submit";
            }
        }
        if ($kode_res != null) {
            $this->modelbot->sendApprove($kode_res, $subject, $keterangan);
            return redirect()->to('email/approve');
        }
    }
}
