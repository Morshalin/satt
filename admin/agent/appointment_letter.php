<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Confirmation  Letter</title>
        <!--     css    -->
        <!--font-fontawesome-->
        <style>
        .page {
        width: 28.7cm;
        min-height: 29cm;
        padding-left: 2cm;
        padding-top: 0cm;
        padding-right: 2cm;
        font-size: 25px;
        }
        @page {
        /*size: A4 portrait;*/
        /*margin: 0cm;*/
        /*margin-top: 2cm;
        margin-right: 2cm;
        /* margin-bottom: 2cm;
        }
        /*  .backgroundimage {
        position: relative;
        top: 250px;
        } */
        /* .para1 {
        position: relative;
        top: 210px;
        padding-left: 75px !important;
        margin-top: -170px
        }
        .para {
        position: relative;
        top: 200px;
        margin-top: -230px;
        padding-left: 60px !important;
        }*/
        </style>
    </head>
    <body style="background-image: url({{ asset('media/photos/Letterhead-90.png') }}); background-size: cover; background-repeat: no-repeat; background-position: top; ">
        <div>
            <table width="100%"  style="margin-top: 150px; margin-left: 45px; margin-right: 15px;">
                <tr>
                    <td style="font-size: 17px; font-weight: bold;" colspan="2">{{ \Carbon\Carbon::now()->format('F d, Y') }}</td>
                </tr>
                <tr>
                    <td style="font-size: 20px;font-family: verdana;text-transform: uppercase;" colspan="2">
                        <h4>
                        {{ $agent->name }}
                        </h4>
                        <P>
                            @if(!$agent->same_as)
                            {{ $agent->present_house ? $agent->present_house. ', ': '' }}{{ $agent->present_road ? $agent->present_road. ', ': '' }} {{ $agent->present_village ? $agent->present_village. ', ': '' }}, <br>
                            {{ $agent->present_up? $agent->present_up. ', ': '' }}, {{ $agent->present_dist ? $agent->present_dist. '-,- ': '' }} {{ $agent->present_post_code ? $agent->present_post_code: '' }}
                            @else
                            {{ $agent->permanent_house ? $agent->permanent_house. ', ': '' }}{{ $agent->permanent_road ? $agent->permanent_road. ', ': '' }} {{ $agent->permanent_village ? $agent->permanent_village. ', ': '' }} <br>
                            {{ $agent->permanent_up? $agent->permanent_up. ', ': '' }} {{ $agent->permanent_dist ? $agent->permanent_dist. '- ': '' }} {{ $agent->permanent_post_code ? $agent->permanent_post_code: '' }}
                            @endif
                        </P>
                    </td>
                </tr>
                <tr>
                    <td style="font-weight:bold; font-size:22px;" colspan="2">
                        Sub: Letter of Agent Confrimation.
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <br>
                        Dear Sir,
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: justify;">
                        We have received your application and would like to confirm that, you have been selected as the agent of our IT company. Now your agent position is in the basic label. We are offering you for selling our software and services. As we promised, you will get the commission and other facilities as per sell.
                        <br>
                        <br>
                        The appointment is with effect from {{ \Carbon\Carbon::now()->format('F d, Y') }} to December 31, 2019. After that, shall assist the performance and increase the time period further. The next confirmation latter shall be renewed by the company. Please be prepared to take your responsibility and work on it.
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: justify;">
                        <br>
                        <br>
                        Your Sincerely, <br>
                        <img src="{{ public_path('media/photos/vai-sign.png')}}" width="110" alt="" style="margin-top: 5px;">
                    </td>
                </tr>
                <tr>
                    <td style="text-align: justify;">
                        <span style="font-weight: bold; font-size:25px;">MD ABDUS SAMAD</span> <br>
                        <span style="font-size: 23px;font-family: verdana;">Chairman <br>
                            <span style="font-weight:bold; "> SATT IT</span> </span>
                        </td>
                        <td>
                            <img src="{{ public_path('media/photos/Sill.png') }}" width="150" style="margin-top: -10px"
                            alt="">
                        </td>
                    </tr>
                </table>
            </div>
            
            </body>
        </html>