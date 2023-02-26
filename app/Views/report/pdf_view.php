<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://cdn.jsdelivr.net/npm/html5shiv@3.7.3/dist/html5shiv.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/respond.js@1.4.2/dest/respond.min.js"></script>
    <![endif]-->
    <style>
        html {
            font-family: sans-serif;
            line-height: 1.15;
            -webkit-text-size-adjust: 100%;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        }

        body {
            margin: 0;
            font-family: "Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: left;
            background-color: #fff;
        }

        p {
            margin: 0;
            font-family: "Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
            font-size: 12px;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: left;
            background-color: #fff;
        }

        .column {
            float: left;
            width: 50%;
        }

        .column-8 {
            float: left;
            width: 80%;
        }

        .column-4 {
            float: left;
            width: 50%;
        }

        .column-full {
            float: left;
            width: 100%;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        table {
            width: 100%;
        }

        td {
            border: 1px solid;
            height: 50px;
            text-align: center;
            padding-bottom: 70px;
            font-family: "Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
            font-size: 12px;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            background-color: #fff;

        }

        .grid-container {
            display: grid;
            grid-template-columns: auto auto auto auto;
            grid-gap: 10px;
            background-color: #2196F3;
            padding: 10px;
        }
    </style>
</head>

<body>
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <center>
                    <h1>SEKESUI</h1>
                    <h5>AUDIT RESULT</h5>
                </center>
                <p><b>Finding Reg No :</b></p>
                <hr style="border: 1px solid black; margin-bottom: 10px;">
                <div class="row">
                    <div class="column-8">
                        <p><b>Audit Date :</b> AAA</p>
                        <p><b>Process Owner :</b> AAA</p>
                        <p><b>Auditee :</b> AAA</p>
                        <p><b>Auditor :</b> AAA</p>
                    </div>
                    <div class="column-4">
                        <p><b>Coresponding</b></p>
                    </div>
                    <br>
                </div>
                <div class="row">
                    <div class="column-full" style="margin-top: 30px;">
                        <p><b>Finding Criteria</b></p>
                        <table>
                            <tr>
                                <td>
                                    <b>(Auditee Signature)</b>
                                </td>
                                <td>
                                    <b>(Auditor Signature)</b>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <br>
                <div class="column-full">
                    <p style="padding-bottom: 30px;"><b>Cause</b></p>
                    <p style="padding-bottom: 30px;"><b>Countermeasure and countermeasure impact</b></p>
                    <p style="padding-bottom: 30px;"><b>Corrective action and Corrective action impact</b></p>
                    <p style="padding-bottom: 30px;"><b>Related document that need to be revised</b></p>
                </div>
            </div>
        </section>
    </div>
</body>

</html>