<?php
    
    $columns = 
    [
        'ITEM',
        'FABRIC',
        'DESCRIPTION',
        'BASE PRICE'
    ];
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Request For Quotation Report</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style type="text/css">

            table {
                border-collapse: collapse;
                text-align: center;
            }

            table th, thead{
                text-align: center;
                border-bottom: solid 1px black;
            }
            
            .page-break {
                page-break-after: always;
            }
        </style>
    </head>
    
    <body>
        
    <div> 
        <div>
            <center>
                <h1>
                    <div style="font-size:15px">Republic of the Philippines</div> 
                    <div style="font-size: 18px;">SOUTHERN LEYTE STATE UNIVERSITY</div>
                    <div style="font-size: 15px;">Sogod, Southern Leyte</div>
                    <div style="font-size: 15px;">Telefax No. (053) 382-2523 </div>
                    <div style="margin: 10px"></div>
                    <div style="font-size: 15px;">_____________________</div>
                    <div style="font-size: 15px;">Date</div>
                    <p style="font-size:-0.5px;"></p>
                </h1>
            </center>
        </div>
        <div>
            <table text-align="left" style=" width: 30%">
                    <thead>
                    </thead>
                    <tbody>  
                        <tr>
                            <td style="size:16px; text-align: left;">To:</td>
                            <td style="size:16px; text-align: left;">_____________________________</td>
                        </tr>
                        <tr>
                            <td style="size:16px; text-align: left;"></td>
                            <td style="size:16px; text-align: left;">_____________________________</td>
                        </tr>
                        <tr>
                            <td style="size:16px; text-align: left;"></td>
                            <td style="size:16px; text-align: left;">_____________________________</td>
                        </tr>                                                
                    </tbody>
            </table>
            <div>VAT/NON-VAT TIN:</div>  
            <table text-align="left" style=" width: 30%">
                    <thead>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="size:16px; text-align: left; opacity: 0">To:</td>
                            <td style="size:16px; text-align: left;">_____________________________</td>
                        </tr>                                                
                    </tbody>
            </table>
        </div>
            <center>
                <h1>
                    <div style="font-size:18px; text-decoration: underline; margin-bottom: 5px;">REQUEST FOR QUOTATION</div> 
                    <div style="font-size: 15px;">Please quote the prices for each of the following:</div>
                </h1>
            </center>
        <div >
            <table text-align="left" style=" width: 100%; ; border: thin solid black">
                    <thead>
                        <tr>
                            <th style="size:16px; text-align: center; border-right: thin solid black">QTY.</th>
                            <th style="size:16px; text-align: center; border-right: thin solid black">UNIT</th>
                            <th style="size:16px; text-align: center; border-right: thin solid black">REQUEST FOR QUOTATION</th>
                        </tr>
                    </thead>
                    <tbody>  
                        @foreach($items as $item)
                        <tr>
                            <th style="size:16px; text-align: left; font-weight: normal; border-right: thin solid black" >5</th>
                            <th style="size:16px; text-align: left; font-weight: normal; border-right: thin solid black" >Piece</th>
                            <th style="size:16px; text-align: left; font-weight: normal; border-right: thin solid black" >{{ $item->item_name }}</th>
                        </tr>
                        @endforeach
                    </tbody>
            </table>
        </div>
        <div style="min-height: 70px;">
            <div style="font-size:16px;">Place of Delivery:_____________________________ within ____ days</div> 
            <div style="font-size:16px;">_______________________________________________ from receipt of the delivery order.</div> 
        </div>
        <div style="margin: 20px"></div>
        <div>
            <div style="font-size:16px; width: 50%">I HEREBY CERTIFY that I am in a position to furnish the above articles at the prices shown and in quantities as called for the place of itinerary.</div> 
        </div>
        <div style="margin: 35px"></div>
        <div style="width: 100%;">
            <div style="width: 65%; display:inline-block;">
                <div style="width: 70%; font-size:16px; border-bottom: solid 1px black;"></div> 
                <div style="width: 70%; font-size:16px; font-style: italic; text-align: center;">Signature over Printed Name</div> 
            </div>
            <div style="width: 35%; display:inline-block;">
                <div style="font-size:16px; border-bottom: solid 1px black;"></div> 
                <div style="font-size:16px; font-style: italic; text-align: center;">Canvasser</div> 
            </div>
        </div>
    </div>
    </body>

</html>