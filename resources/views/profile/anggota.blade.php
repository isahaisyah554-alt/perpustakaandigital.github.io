<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Saya - Sistem Perpustakaan</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,400;0,500;0,600;0,700;1,500&display=swap" rel="stylesheet">
    <style>
        /* Base Reset */
        body {
            margin: 0;
            padding: 0;
            background: #F0F2F5;
            display: flex;
            justify-content: center;
        }

        /* --- Profile Container --- */
        .profile-container {
            position: relative;
            width: 1440px;
            height: 1024px;
            background: #F6F8FB;
            overflow: hidden;
        }

        /* --- Nav Atas --- */
        .nav-atas {
            box-sizing: border-box;
            position: absolute;
            width: 1440px;
            height: 87px;
            left: 0px;
            top: 0px;
            background: #F9FAFB;
            border: 1px solid #E5E7EB;
            z-index: 10;
        }

        .logo-lib {
            position: absolute;
            width: 106px;
            height: 106px;
            left: 14px;
            top: -7px;
            background: url('WhatsApp_Image_2026-02-15_at_12.47.32-removebg-preview.png');
            background-size: contain;
            background-repeat: no-repeat;
        }

        .nav-title {
            position: absolute;
            width: 349px;
            height: 39px;
            left: 136px;
            top: 22px;
            font-family: 'Inter';
            font-style: italic;
            font-weight: 500;
            font-size: 32px;
            line-height: 39px;
            text-align: center;
            color: #6B7280;
        }

        .icon-nav-1 {
            position: absolute;
            width: 30px;
            height: 30px;
            left: 1329px;
            top: 29px;
            background: url('image.png');
        }

        .icon-nav-2 {
            position: absolute;
            width: 30px;
            height: 30px;
            left: 1381px;
            top: 29px;
            background: url('image.png');
        }

        /* --- Main Content Scroll Area --- */
        .frame-119-scroll {
            position: absolute;
            width: 979px;
            height: 852px;
            left: 266px;
            top: 126px;
            overflow-y: scroll;
            border-radius: 20px;
        }

        /* --- Card Profile --- */
        .frame-115-card {
            box-sizing: border-box;
            position: relative;
            width: 979px;
            height: 1411px;
            background: #FFFFFF;
            border: 1px solid #E5E7EB;
            box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.1);
        }

        .title-profile {
            position: absolute;
            width: 550px;
            height: 36px;
            left: 223px;
            top: 25px;
            font-family: 'Inter';
            font-weight: 600;
            font-size: 30px;
            color: #6B7280;
            text-align: center;
        }

        .line-top {
            position: absolute;
            width: 900px;
            height: 0px;
            left: 41px;
            top: 113px;
            border: 1px solid #E5E7EB;
        }

        /* --- Header Profile (Photo & Badge) --- */
        .frame-116-header {
            position: absolute;
            width: 481px;
            height: 326px;
            left: 292px;
            top: 137px;
        }

        .img-profile-main {
            position: absolute;
            width: 156px;
            height: 156px;
            left: 144px;
            top: 17px;
            background: url('https://ui-avatars.com/api/?name=Isah+Aisyah&background=3B82F6&color=fff');
            background-size: cover;
            border-radius: 50%;
        }

        .name-main {
            position: absolute;
            width: 231px;
            left: 106px;
            top: 198px;
            font-family: 'Inter';
            font-weight: 600;
            font-size: 30px;
            color: #6B7280;
            text-align: center;
        }

        .badge-role {
            box-sizing: border-box;
            position: absolute;
            width: 328px;
            height: 65px;
            left: 77px;
            top: 244px;
            background: rgba(59, 130, 246, 0.5);
            border: 1px solid #0F4DB2;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .badge-text {
            font-family: 'Inter';
            font-weight: 600;
            font-size: 30px;
            color: #0F4DB2;
        }

        /* --- Detail List Info --- */
        .frame-118-details {
            position: absolute;
            width: 979px;
            height: 654px;
            left: 0px;
            top: 499px;
            background: #FFFFFF;
        }

        .detail-item {
            position: absolute;
            width: 900px;
            left: 41px;
            height: 80px;
            display: flex;
            align-items: center;
            border-bottom: 1px solid #E5E7EB;
        }

        .info-text {
            position: absolute;
            left: 162px;
            font-family: 'Inter';
            font-weight: 500;
            font-size: 24px; /* Disesuaikan agar tidak terlalu besar */
            color: #6B7280;
        }

        .icon-detail {
            position: absolute;
            width: 45px;
            height: 45px;
            left: 93px;
            background: #E5E7EB;
            border-radius: 8px;
        }

        /* --- Buttons --- */
        .btn-edit {
            box-sizing: border-box;
            display: flex;
            justify-content: center;
            align-items: center;
            position: absolute;
            width: 292px;
            height: 60px;
            left: 368px;
            top: 1203px;
            background: #3B82F6;
            border: 1px solid rgba(107, 114, 128, 0.5);
            border-radius: 5px;
            color: white;
            font-family: 'Inter';
            font-size: 18px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-keluar {
            box-sizing: border-box;
            display: flex;
            justify-content: center;
            align-items: center;
            position: absolute;
            width: 292px;
            height: 51px;
            left: 369px;
            top: 1299px;
            background: #E5E7EB;
            border: 1px solid rgba(107, 114, 128, 0.5);
            border-radius: 5px;
            color: #11142D;
            font-family: 'Inter';
            font-size: 18px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
        }

        /* Custom scrollbar */
        .frame-119-scroll::-webkit-scrollbar {
            width: 8px;
        }
        .frame-119-scroll::-webkit-scrollbar-thumb {
            background: #D1D5DB;
            border-radius: 10px;
        }
    </style>
</head>
<body>

    <div class="profile-container">
        <header class="nav-atas">
            <div class="logo-lib"></div>
            <div class="nav-title">Sistem Perpustakaan</div>
            <div class="icon-nav-1"></div>
            <div class="icon-nav-2"></div>
        </header>

        <div class="frame-119-scroll">
            <div class="frame-115-card">
                <h1 class="title-profile">Profile Saya</h1>
                <div class="line-top"></div>

                <div class="frame-116-header">
                    <div class="img-profile-main"></div>
                    <div class="name-main">Isah Aisyah</div>
                    <div class="badge-role">
                        <span class="badge-text">Anggota</span>
                    </div>
                </div>

                <div class="frame-118-details">
                    <div class="detail-item" style="top: 0px;">
                        <div class="icon-detail"></div>
                        <div class="info-text">ID Anggota : GT-100028</div>
                    </div>
                    <div class="detail-item" style="top: 80px;">
                        <div class="icon-detail"></div>
                        <div class="info-text">Nama : Aisyah</div>
                    </div>
                    <div class="detail-item" style="top: 163px;">
                        <div class="icon-detail"></div>
                        <div class="info-text">Alamat : Jtbrang Rt/28 Rw/08</div>
                    </div>
                    <div class="detail-item" style="top: 257px;">
                        <div class="icon-detail"></div>
                        <div class="info-text">No Telp : 00885523662</div>
                    </div>
                    <div class="detail-item" style="top: 352px;">
                        <div class="icon-detail"></div>
                        <div class="info-text">Email : isahaisyah88@gmail.com</div>
                    </div>
                    <div class="detail-item" style="top: 449px;">
                        <div class="icon-detail"></div>
                        <div class="info-text">Password : ********</div>
                    </div>
                </div>

                <a href="#" class="btn-edit">Edit Profile</a>
                <a href="#" class="btn-keluar">Keluar</a>
            </div>
        </div>
    </div>

</body>
</html>
