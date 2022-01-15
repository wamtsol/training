<?php
if(!defined("APP_START")) die("No Direct Access");
if(isset($_GET["id"]) && !empty($_GET["id"])){
	$trainee=dofetch(doquery("select * from trainees where id='".slash($_GET["id"])."'", $dblink));
	?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Offer Letter </title>
<style>
        body{
            margin: 0px;
        }
        .clr{
            clear: both;
        }
        .container{
            width: 100%;
            max-width: 1024px;
            margin: 0 auto;
        }
        .header-bottom {
            border-bottom: solid 1px #000;
            padding-top: 10px;
            padding-bottom: 10px;
            margin-bottom: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo-text {
            text-align: center;
        }
        .logo-text h2 {
            margin: 0;
            font-size: 26px;
            font-weight: 300;
        }
        .logo-text h1 {
            margin: 0;
            font-size: 28px;
            text-transform: uppercase;
            font-weight: bold;
        }
        .logo-text h3 {
            margin: 0;
            font-size: 22px;
            text-transform: capitalize;
            line-height: 24px;
        }
        .content-top {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        .content-top h4 {
            margin: 0;
            font-size: 18px;
        }
        .content-head {
            display: flex;
        }
        .content-head h2 span{
            border-bottom: 1px solid #000;
            width: auto;
            display: inline-block;
        }
        .content-right {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
        }
        .cnic-code {
            border: solid 1px #000;
            width: 27px;
            height: 27px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .text-to h2 {
            margin: 0;
            font-size: 17px;
        }
        .content-head h2 {
            margin: 0;
            font-size: 17px;
        }
        .content-center {
            padding: 0px 44px;
        }
        .content-right h2 {
            margin: 0;
            font-size: 17px;
        }
        .center-text-inner {
            margin-left: 100px;
            margin-bottom: 6px;
        }
        .content-right span {
            font-size: 30px;
        }
        .subject {
            display: flex;
            margin-top: 20px;
            margin-bottom: 10px;
        }
        .subject h2 {
            margin: 0;
            font-size: 15px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .subject-text {}
        .subject-text p {
            margin: 0;
            font-size: 16px;
        }
        .subject-list {
            margin-left: 20px;
        }
        .subject-list p {
            margin: 0;
            font-size: 16px;
        }
        .subject-list span {
            font-weight: bold;
            font-size: 20px;
            margin-right: 20px;
        }
        .sign {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: solid 1px #000;
            margin-bottom: 10px;
            padding-bottom: 10px;
            margin-top: 40px;
        }
        .sign h2 {
            margin: 0;
            font-size: 17px;
            font-weight: bold;
        }
        .sign-left.dr {
            text-align: center;
        }
        .sign h1 {
            margin: 0;
            font-weight: bold;
            font-size: 22px;
        }
        .sign h3 {
            margin: 0;
            font-weight: 400;
            font-size: 14px;
        }
        .footer-inner {
            text-align: center;
        }
        .footer-inner h2 {
            margin: 0;
            font-size: 18px;
        }
        .list-1 {
            display: flex;
            justify-content: flex-start;
        }
    </style>
</head>
<body>
    <div id="wrapper">
        <div id="header">
            <div class="container">
                <div class="header-bottom">
                    <div class="logo">
                        <img src="images/main-logo.png" />
                    </div>
                    <div class="logo-text">
                        <h2>Project Management Unit</h2>
                        <h1>Benazir Bhutto Shaheed</h1>
                        <h3>Human Resource research & development board<br> livestock & fisheries department<br> government of sindh</h3>
                    </div>
                    <div class="logo">
                        <img src="images/second-logo.png" />
                    </div>
                </div>
            </div>
        </div>
        <div id="content">
            <div class="container">
                <div class="content-top">
                    <h4>No: PD/BBSHRRDB/PHXII/&nbsp;&nbsp;&nbsp;&nbsp;/Trgs/</h4>
                    <h4>Hyderabad, Dated: /&nbsp;&nbsp;&nbsp;&nbsp;/22</h4>
                </div>
                <div class="content-center">
                    <div class="text-to">
                        <h2>To</h2>
                    </div>
                    <div class="content-head center-text-inner">
                        <h2>Mr./Ms. <span style=""><?php echo unslash($trainee["name"]);?>&nbsp;</span> S/o, D/o. <span><?php echo unslash($trainee["father_name"]);?>&nbsp;</span></h2>
                    </div>
                    <div class="content-right center-text-inner">
                        <h2>CNIC #.&nbsp;&nbsp;</h2>
                        <div class="cnic-code"></div>
                        <div class="cnic-code"></div>
                        <div class="cnic-code"></div>
                        <div class="cnic-code"></div>
                        <div class="cnic-code"></div>
                        <div class="cnic-code"><span>-</span></div>
                        <div class="cnic-code"></div>
                        <div class="cnic-code"></div>
                        <div class="cnic-code"></div>
                        <div class="cnic-code"></div>
                        <div class="cnic-code"></div>
                        <div class="cnic-code"></div>
                        <div class="cnic-code"></div>
                        <div class="cnic-code"><span>-</span></div>
                        <div class="cnic-code"></div>
                    </div>
                    <div class="content-head center-text-inner">
                        <h2>Address: __________________________________________________</h2>
                    </div>
                    <div class="subject">
                        <h2>Subject:</h2>&nbsp;&nbsp;&nbsp;&nbsp;
                        <h2>OFFER LETTER FOR TRAINING UNDER BENAZIR BHUTTO SHAHEED HUMAN
                            RESOURCE RESEARCH DEVELOPMENT BOARD (——WING)</h2>
                    </div>
                    <div class="subject-text">
                        <p>With reference to your application ror lhc training under BBSHRRDB, you have been successfully selected as
                        trainee therefore you are offered training of__________________________________________________</p>
                        <p>as trainee position on following terms and conditions:</p>
                    </div>
                    <div class="subject-list">
                        <div class="list-1">
                            <span>1.</span><p>The Training period is for _______________ months(s) starting form _______________ to ______________________________.</p>
                        </div>
                        <div class="list-1">
                            <span>2.</span><p>You will be paid Rs. 5000/- (Rupees Five Thousand only) in a month.</p>
                        </div>
                        <div class="list-1">
                            <span>3.</span><p>Stipend will only be paid to those trainees who have 85% attendance during training.</p>
                        </div>
                        <div class="list-1">
                            <span>4.</span><p>The stipend will be paid to Trainee after assessment test to be conducted in the last week of month.</p>
                        </div>
                        <div class="list-1">
                            <span>5.</span><p>The dislocation allowance Of Rs. 3000/= & Rs. will be admissible for Karachi and all other districts respectively as per terms and conditions of the program. only for residential based training.</p>
                        </div>
                        <div class="list-1">
                            <span>6.</span><p>In case of any misconduct, in any form, with trainers, officers and staff, your training will be terminated.</p>
                        </div>
                        <div class="list-1">
                            <span>7.</span><p>During training you will required to attend various Lectures, Laboratory and practical work as per requirement ofthe training.</p>
                        </div>
                        <div class="list-1">
                            <span>8.</span><p>A certificate of training will be issued to you after successful completion of training.</p>
                        </div>
                        <div class="list-1">
                            <span>9.</span><p>This offer letter is valid till the commencement date of the particular trade at the prescribed center. Late comers will not be entertained.</p>
                        </div>
                        <div class="list-1">
                            <span>10.</span><p>This offer letter do not flowing any responsibility to provide appointment in program.</p>
                        </div>
                    </div>
                    <div class="subject-text">
                        <p>If you agree with the above terms & conditions, acceptance must be committed by the signing on this
                            offer letter. Moreover this offer letter may be return to this PMU, so that making you eligible to
                            participate in training commencing form_________________________,at____________________________</p>
                    </div>
                    <div class="sign">
                        <div class="sign-left">
                            <h2>Acceptance by Candidate:</h2>
                        </div>
                        <div class="sign-left dr">
                            <h1>(DR. MAJEED HAKEEM AMRAH)</h1>
                            <h2>Project Director BBS RRDB</h2>
                            <h3>Livestock & Fisheries Department Hyderabad</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="footer">
            <div class="container">
                <div class="footer-inner">
                    <h2>Fisheries Complex, Old Wahdat Colony, Qasimabad Hyderabad.</h2>
                    <h2>Tel: 022-9240209 - Fax 022-2671884</h2>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php
die;
}