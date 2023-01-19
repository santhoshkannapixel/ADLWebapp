<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Home Collection Enquiry</title>
    <link rel="stylesheet" href="{{ asset('/css/email.css') }}">
</head>

<body style="margin: 0;">
    <table width="100%" id="mainStructure" border="0" cellspacing="0" cellpadding="0"
        style="background-color: #e1e1e1;border-spacing: 0;">
        <!-- START TAB TOP -->
        <tbody>
            <tr>
                <td valign="top" style="border-collapse: collapse;">
                    <table width="100%" align="center" border="0" cellspacing="0" cellpadding="0"
                        style="border-spacing: 0;">
                        <tbody>
                            <tr>
                                <td valign="top" height="6" style="border-collapse: collapse;">
                                    <table width="800" align="center" border="0" cellspacing="0" cellpadding="0"
                                        class="full-width" style="border-spacing: 0;">
                                        <!-- start space height -->
                                        <tbody>
                                            <tr>
                                                <td height="5" valign="top" style="border-collapse: collapse;">
                                                </td>
                                            </tr>
                                            <!-- end space height -->
                                            <tr>
                                                <td height="5" class="remove" style="border-collapse: collapse;">
                                                </td>
                                            </tr>
                                            <!-- start space height -->
                                            <tr>
                                                <td height="5" valign="top" style="border-collapse: collapse;">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="5" class="remove" style="border-collapse: collapse;">
                                                </td>
                                            </tr>
                                            <!-- end space height -->
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <!-- END TAB TOP -->
            <!--START TOP NAVIGATION ?LAYOUT-->
            <tr>
                <td align="center" valign="top" class="fix-box" style="border-collapse: collapse;">
                    <table width="100%" align="center" border="0" cellspacing="0" cellpadding="0"
                        class="full-width" style="border-spacing: 0;">
                        <!-- START CONTAINER NAVIGATION -->
                        <tbody>
                            <tr>
                                <td valign="middle" style="border-collapse: collapse;">
                                    <!-- start top navigation container -->
                                    <table width="800" align="center" border="0" cellspacing="0" cellpadding="0"
                                        class="full-width" style="border-spacing: 0;">
                                        <tbody>
                                            <tr>
                                                <td valign="middle" bgcolor="00a0e0" style="border-collapse: collapse;">
                                                    <!-- start top navigation -->
                                                    <table width="800" align="center" border="0" cellspacing="0"
                                                        cellpadding="0" class="full-width" style="border-spacing: 0;">
                                                        <tbody>
                                                            <tr>
                                                                <td valign="middle" style="border-collapse: collapse;">
                                                                    <table border="0" align="left" cellpadding="0"
                                                                        cellspacing="0" class="container2"
                                                                        style="border-spacing: 0;">
                                                                        <tbody>
                                                                            <!--start event date -->
                                                                            <tr>
                                                                                <td valign="middle" align="center"
                                                                                    style="border-collapse: collapse;">
                                                                                    <table align="right" border="0"
                                                                                        cellpadding="0" cellspacing="0"
                                                                                        class="clear-align"
                                                                                        style="border-spacing: 0;">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td
                                                                                                    style="padding:15px;border-collapse:collapse; height: 70px; line-height: 70px">
                                                                                                    <a href="#"
                                                                                                        style="color: #fff; text-decoration: none !important;"
                                                                                                        target="_blank">
                                                                                                        <img title="Logo" src="<?php echo asset('/public'.$details['site_logo'])?>" ></a>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    <!--end content nav -->

                                                                    <!--start content nav -->
                                                                    <table border="0" align="right"
                                                                        cellpadding="0" cellspacing="0"
                                                                        class="container2" style="border-spacing: 0;">
                                                                        <tbody>
                                                                            <!--start event date -->
                                                                            <tr>
                                                                                <td valign="middle" align="center"
                                                                                    style="border-collapse: collapse;">
                                                                                    <table align="right"
                                                                                        border="0" cellpadding="0"
                                                                                        cellspacing="0"
                                                                                        class="clear-align"
                                                                                        style="border-spacing: 0;">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td
                                                                                                    style="font-size: 13px;line-height: 22px;color: #FFF;padding: 15px;font-weight: normal;text-align: center;font-family: Tahoma, Helvetica, Arial, sans-serif;border-collapse: collapse;">
                                                                                                    <span
                                                                                                        style="display: inline-block; height: 70px; line-height: 70px;">{!! $details['date_time'] !!}</span>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    <!--end content nav -->
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <!-- end top navigation -->
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!-- end top navigation container -->
                                </td>
                            </tr>
                            <!-- END CONTAINER NAVIGATION -->
                        </tbody>
                    </table>
                </td>
            </tr>
            <!--END TOP NAVIGATION LAYOUT-->
            <!-- START MAIN CONTENT-->
            <tr>
                <td align="center" valign="top" class="fix-box" style="border-collapse: collapse;">
                    <!-- start layout-7 container -->
                    <table width="100%" align="center" border="0" cellspacing="0" cellpadding="0"
                        class="full-width" style="border-spacing: 0;">
                        <tbody>
                            <tr>
                                <td valign="top" style="border-collapse: collapse;">
                                    <table width="800" align="center" border="0" cellspacing="0"
                                        cellpadding="0" class="container" bgcolor="#ffffff"
                                        style="background-color: #ffffff;border-spacing: 0;">
                                        <!--start space height -->
                                        <tbody>
                                            <tr>
                                                <td height="30" style="border-collapse: collapse;"></td>
                                            </tr>
                                            <!--end space height -->
                                            <tr>
                                                <td style="min-height: 400px; padding: 15px; font-size: 13px;">

                                                    <table width="100%">
                                                        <tbody>
                                                            <tr>
                                                                <td class="wrapper" width="700" align="center">
                                                                    <table class="section" cellpadding="0"
                                                                        cellspacing="0" width="700"
                                                                        bgcolor="#f8f8f8">
                                                                        <tr>
                                                                            <td class="column" align="left">
                                                                                <table>
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td><strong>Name</strong>:</td>
                                                                                            <td>{!! $details['name'] !!}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td><strong>Mobile</strong>:</td>
                                                                                            <td>{!! $details['name'] !!}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td><strong>Mobile</strong>:</td>
                                                                                            <td>{!! $details['mobile'] !!}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td><strong>Location</strong>:</td>
                                                                                            <td>{!! $details['location'] !!}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td><strong>Test Name</strong>:</td>
                                                                                            <td>{!! $details['test_name'] !!}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td><strong>Comments</strong>:</td>
                                                                                            <td>{!! $details['comments'] !!}</td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                           
                                                        </tbody>
                                                    </table>


                                                </td>
                                            </tr>
                                            <!--start space height -->
                                            <tr>
                                                <td height="28" style="border-collapse: collapse;"></td>
                                            </tr>
                                            <!--end space height -->
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- end layout-7 container -->
                </td>
            </tr>
            <!-- END MAIN CONTENT-->
            <!-- START FOOTER-BOX-->
            <tr>
                <td align="center" valign="top" class="fix-box" style="border-collapse: collapse;">
                    <!-- start layout-7 container -->
                    <table width="100%" align="center" border="0" cellspacing="0" cellpadding="0"
                        class="full-width" style="border-spacing: 0;">
                        <tbody>
                            <tr>
                                <td valign="top" style="border-collapse: collapse;">
                                    <table width="800" align="center" border="0" cellspacing="0"
                                        cellpadding="0" class="full-width" bgcolor="#3a3a3a"
                                        style="border-spacing: 0;">
                                        <!--start space height -->
                                        <tbody>
                                            <tr>
                                                <td height="20" style="border-collapse: collapse;"></td>
                                            </tr>
                                            <!--end space height -->
                                            <tr>
                                                <td valign="top" align="center" style="border-collapse: collapse;">
                                                    <!-- start logo footer and address -->
                                                    <table width="760" align="center" border="0"
                                                        cellspacing="0" cellpadding="0" class="container"
                                                        style="border-spacing: 0;">
                                                        <tbody>
                                                            <tr>
                                                                <td valign="top" style="border-collapse: collapse;">
                                                                    <!--start icon navigation -->
                                                                    <table width="100%" border="0"
                                                                        align="center" cellpadding="0"
                                                                        cellspacing="0" style="border-spacing: 0;">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td valign="top" align="center"
                                                                                    style="border-collapse: collapse;">
                                                                                    <table width="100%"
                                                                                        border="0" align="left"
                                                                                        cellpadding="0"
                                                                                        cellspacing="0"
                                                                                        class="full-width"
                                                                                        style="border-spacing: 0;">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td align="left"
                                                                                                    valign="middle"
                                                                                                    class="clear-padding"
                                                                                                    style="border-collapse: collapse;">
                                                                                                    <table
                                                                                                        width="760"
                                                                                                        border="0"
                                                                                                        align="left"
                                                                                                        cellpadding="0"
                                                                                                        cellspacing="0"
                                                                                                        class="col-2"
                                                                                                        style="border-spacing: 0;">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td height="10"
                                                                                                                    style="border-collapse: collapse;">
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <td
                                                                                                                    style="font-size: 13px;line-height: 15px; text-align: center; font-family: Arial,Tahoma, Helvetica, sans-serif;color: #a7a9ac;font-weight: normal;border-collapse: collapse;">
                                                                                                                    ©
                                                                                                                    Copyright
                                                                                                                    2023.
                                                                                                                    All
                                                                                                                    rights
                                                                                                                    reserved.
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                    <!-- end logo footer and address -->
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <!--start space height -->
                                                            <tr>
                                                                <td height="20" style="border-collapse: collapse;">
                                                                </td>
                                                            </tr>
                                                            <!--end space height -->
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <!-- start space height -->
                                            <tr>
                                                <td height="10" valign="top" style="border-collapse: collapse;">
                                                </td>
                                            </tr>
                                            <!-- end space height -->
                                        </tbody>
                                    </table>
                                    <!-- end layout-FOOTER-BOX container -->
                                </td>
                            </tr>
                            <!-- END FOOTER-BOX-->
                            <!-- START FOOTER COPY RIGHT  -->
                            <tr>
                                <td align="center" valign="top" class="fix-box"
                                    style="border-collapse: collapse;">
                                    <!-- start layout-7 container -->
                                    <table width="100%" align="center" border="0" cellspacing="0"
                                        cellpadding="0" class="full-width" style="border-spacing: 0;">
                                        <!-- start space height -->
                                        <tbody>
                                            <tr>
                                                <td height="5" valign="top" style="border-collapse: collapse;">
                                                </td>
                                            </tr>
                                            <!-- end space height -->
                                            <tr>
                                                <td align="center" valign="top" style="border-collapse: collapse;">
                                                    <table width="800" align="center" border="0"
                                                        cellspacing="0" cellpadding="0" class="container"
                                                        style="border-spacing: 0;">
                                                        <tbody>
                                                            <tr>
                                                                <td valign="top" align="center"
                                                                    style="border-collapse: collapse;">
                                                                    <table width="560" align="center"
                                                                        border="0" cellspacing="0"
                                                                        cellpadding="0" class="container"
                                                                        style="border-spacing: 0;">
                                                                        <tbody>
                                                                            <tr>
                                                                                <!-- start COPY RIGHT content -->
                                                                                <td valign="top" align="center"
                                                                                    style="font-size: 11px;line-height: 22px;font-family: Arial,Tahoma, Helvetica, sans-serif;color: #919191;font-weight: normal;border-collapse: collapse;">
                                                                                    Email is sent from
                                                                                    ADL.
                                                                                </td>
                                                                                <!-- end COPY RIGHT content -->
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <!--  END FOOTER COPY RIGHT -->
                                            <!-- start space height -->
                                            <tr>
                                                <td height="20" valign="top" style="border-collapse: collapse;">
                                                </td>
                                            </tr>
                                            <!-- end space height -->
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
