<style>
    /* This CSS code you should add to <head> of your page */
/* This code is for responsive design */
/* It didn't work in Gmail app on Android, but work fine on iOS */

@import url(https://fonts.googleapis.com/css?family=montserrat:400,700,400italic,700italic&subset=latin,cyrillic);

@media only screen and (min-width: 0) {
    .wrapper {
        text-rendering: optimizeLegibility;
    }
}
@media only screen and (max-width: 620px) {
    [class=wrapper] {
        min-width: 302px !important;
        width: 100% !important;
    }
    [class=wrapper] .block {
        display: block !important;
    }
    [class=wrapper] .hide {
        display: none !important;
    }

    [class=wrapper] .top-panel,
    [class=wrapper] .header,
    [class=wrapper] .main,
    [class=wrapper] .footer {
        width: 302px !important;
    }

    [class=wrapper] .title,
    [class=wrapper] .subject,
    [class=wrapper] .signature,
    [class=wrapper] .subscription {
        display: block;
        float: left;
        width: 300px !important;
        text-align: center !important;
    }
    [class=wrapper] .signature {
        padding-bottom: 0 !important;
    }
    [class=wrapper] .subscription {
        padding-top: 0 !important;
    }
}
    /* This styles you should add to your html as inline-styles */
    /* You can easily do it with http://inlinestyler.torchboxapps.com/ */
    /* Copy this html-window code converter and click convert button */
    /* After that you can remove this style from your code */  
      
    body {
        margin: 0;
        padding: 5%;
        mso-line-height-rule: exactly;
        min-width: auto;
        background-image: url('https://img.freepik.com/free-vector/abstract-blue-pink-gradient-banner-with-blur-effect_1017-44262.jpg');
        background-repeat: no-repeat; /* Corrected property value */
        background-size: cover; /* Adjust the size property as needed */
    }
    
    .wrapper {
        padding: 2%;
        display: table;
        margin: 0 auto; /* Add this line to center the wrapper horizontally */
        table-layout: fixed;
        width: auto;
        min-width: auto;
        -webkit-text-size-adjust: 100%;
        -ms-text-size-adjust: 100%;
    }
    
    body, .wrapper {
        background-color: #ffffff;
    }
    
    /* Basic */
    table {
        border-collapse: collapse;
        border-spacing: 0;
    }
    table.center {
        margin: 0 auto;
        width: 602px;
    }
    td {
        padding: 0;
        vertical-align: top;
    }
    
    .spacer,
    .border {
        font-size: 1px;
        line-height: 1px;
    }
    .spacer {
        width: 100%;
        line-height: 16px
    }
    .border {
        background-color: #e0e0e0;
        width: 1px;
    }
    
    .padded {
        padding: 0 24px;
    }
    img {
        border: 0;
        -ms-interpolation-mode: bicubic;
    }
    .image {
        font-size: 12px;
    }
    .image img {
        display: block;
    }
    strong, .strong {
        font-weight: 700;
    }
    h1,
    h2,
    h3,
    p,
    ol,
    ul,
    li {
        margin-top: 0;
    }
    ol,
    ul,
    li {
        padding-left: 0;
    }
    
    a {
        text-decoration: none;
        color: #616161;
    }
    .btn {
        background-color:#8a671c;
        border:1px solid #f3b121;
        border-radius:2px;
        color:#ffffff;
        display:inline-block;
        font-family:montserrat, Helvetica, sans-serif;
        font-size:14px;
        font-weight:400;
        line-height:36px;
        text-align:center;
        text-decoration:none;
        text-transform:uppercase;
        width:200px;
        height: 36px;
        padding: 0 8px;
        margin: 10;
        outline: 0;
        outline-offset: 0;
        -webkit-text-size-adjust:none;
        mso-hide:all;
    }
    
    /* Top panel */
    .title {
        text-align: left;
    }
    
    .subject {
        text-align: right;
    }
    
    .title, .subject {
        width: 300px;
        padding: 8px 0;
        color: #616161;
        font-family: montserrat, Helvetica, sans-serif;
        font-weight: 400;
        font-size: 12px;
        line-height: 14px;
    }
    
    /* Header */
    .logo {
        padding: 16px 0;
    }
    
    /* Logo */
    .logo-image {
    
    }
    
    /* Main */
    .main {
        -webkit-box-shadow: 0 1px 3px 0 rgba(122, 107, 39, 0.12), 0 1px 2px 0 rgba(0, 0, 0, 0.24);
        -moz-box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.12), 0 1px 2px 0 rgba(0, 0, 0, 0.24);
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.12), 0 1px 2px 0 rgba(0, 0, 0, 0.24);
    }
    
    /* Content */
    .columns {
        margin: 0 auto;
        width: 600px;
        background-color: #ffffff;
        font-size: 14px;
    }
    
    .column {
        text-align: left;
        background-color: #ffffff;
        font-size: 14px;
    }
    
    .column-top {
        font-size: 24px;
        line-height: 24px;
    }
    
    .content {
        width: 100%;
    }
    
    .column-bottom {
        font-size: 8px;
        line-height: 8px;
    }
    
    .content h1 {
        margin-top: 0;
        margin-bottom: 16px;
        color: #212121;
        font-family: montserrat, Helvetica, sans-serif;
        font-weight: 400;
        font-size: 20px;
        line-height: 28px;
    }
    
    .content p {
        margin-top: 0;
        margin-bottom: 16px;
        color: #212121;
        font-family: montserrat, Helvetica, sans-serif;
        font-weight: 400;
        font-size: 16px;
        line-height: 24px;
    }
    .content .caption {
        color: #616161;
        font-size: 12px;
        line-height: 20px;
    }
    
    /* Footer */
    .signature, .subscription {
        vertical-align: bottom;
        width: 300px;
        padding-top: 8px;
        margin-bottom: 16px;
    }
    
    .signature {
        text-align: left;
    }
    .subscription {
        text-align: right;
    }
    
    .signature p, .subscription p {
        margin-top: 0;
        margin-bottom: 8px;
        color: #756652;
        font-family: montserrat, Helvetica, sans-serif;
        font-weight: 400;
        font-size: 12px;
        line-height: 18px;
    }
    </style>
    
    <center class="wrapper">
        <table class="top-panel center" width="602" border="0" cellspacing="0" cellpadding="0">
            <tbody>
            <tr>
                <td class="title" width="300">Capex Finance Solution</td>
                <td class="subject" width="300"><a class="strong" href="#" target="_blank">https://capexlms.greenwebbtech.com</a></td>
            </tr>
            <tr>
                <td class="border" colspan="2">&nbsp;</td>
            </tr>
            </tbody>
        </table>
    
        <div class="spacer">&nbsp;</div>
    
        <table class="main center" width="602" border="0" cellspacing="0" cellpadding="0">
            <tbody>
            <tr>
                <td class="column">
                    <div class="column-top">&nbsp;</div>
                    <table class="content" border="0" cellspacing="0" cellpadding="0">
                        <tbody>
                        <tr>
                            <td class="padded">
                                <h1>Recommendation Forms</h1>
                                <p> <strong>Dear Sir/Madam</strong> </p>
                                <p>
                                    We trust this message finds you well. Your immediate attention is 
                                    crucial for the completion of the pre-approval process on behalf 
                                    of {{ $data['fname'].' '.$data['lname'] }} {{ $data['phone'] }}. They are seeking approval for a loan amount of 
                                    {{ $data['amount'] }} returnable in {{ $data['repayment_plan'] }}. Please find the attached pre-approval forms and 
                                    kindly sign them.
                                </p>
                                <p style="text-align:center;">
                                    Please use the following link for the submission:
                                    <a href="#" class="btn">Upload them back Here</a>
                                </p>
                                <p style="text-align:center;">
                                    <a href="https://capexlms.greenwebbtech.com" class="strong">Learn more</a>
                                </p>
                                <p class="caption">Capex Finance  - Loan Pre-approval Process.</p>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="column-bottom">&nbsp;</div>
                </td>
            </tr>
            </tbody>
        </table>
    
        <div class="spacer">&nbsp;</div>
    
        <table class="footer center" width="602" border="0" cellspacing="0" cellpadding="0">
            <tbody>
            <tr>
                <td class="border" colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td class="signature" width="300">
                    <p>
                        With best regards,<br>
                        Capex Finance<br>
                        Phone<br>
                        </p>
                    <p>
                        Support: <a class="strong" href="mailto:#" target="_blank">capex@greenwebbtech.com</a>
                    </p>
                </td>
                <td class="subscription" width="300">
                    <div class="logo-image">
                        <a href="https://capexlms.greenwebbtech.com" target="_blank"><img src="https://capexlms.greenwebbtech.com/public/assets/images/logo-light.png" alt="logo-alt" width="150"></a>
                    </div>
                    <p>
                        <a class="strong block" href="#">
                            Unsubscribe
                        </a>
                        <span class="hide">&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                        <a class="strong block" href="#">
                            Account Settings
                        </a>
                    </p>
                </td>
            </tr>
            </tbody>
        </table>
    </center>