README FILE

PDFaid API, Version 1.0 for PHP

[Author: Prasad GURLA]
[Release Date: 01/09/2013]
[Website: http://pdfaid.com]

CONTENTS

I.	 Description of the API
II.	 Instructions to use the API
III. Sample Code
IV.  MINIMUM SYSTEM REQUIREMENTS
V.	 TECHNICAL SUPPORT


I. Description of the API

1. The api was built in order to facilitate the usage of the various applications at pdfaid in your own applications or websites.
2. The instructions to use the API are given below.

II.Instructions to use the API

The api currently supports calls using PHP. To call the various functionalities at PDFaid, please follow the instructions below.

1. Obtain a apikey from our website (http://pdfaid.com/api-registration.aspx). 
please note that the API key is mandatory without which you cannot use the API.

2. Download the pdfaid services library (http://pdfaid.com/pdfservices-php.zip). If you are reading this file you probably already have this file.

3. Copy the php file PdfaidServices.php on your server (website folder; usually "www" or "httpdocs").

4. Include the reference to the file in your custom php file using the "Include" keyword.

5. Initiate an instance of the pdfaid services class and call the method that you desire. 

III. Sample Code

For a full description and list of all sample codes, please visit the link; http://pdfaid.com/pdfaid-api-applications.aspx
As an example find below the sample code and explaination for the compress pdf application.

<?php
//assumes the current file and the pdfaidservices php file are in the same folder
include 'PdfaidServices.php';

$compressPdf = new PdfCompresser(); //Initiate an instance of the PdfCompresser class
$compressPdf->apiKey = "pessitestkey"; //Set the apikey; this step is mandatory
$compressPdf->inputPdfLocation = "compress.pdf"; //Set the location of input pdf file that needs compression
$compressPdf->outputPdfLocation = "UploadedPdf/compresspdf.pdf"; //Set output File. Please make sure that the dir is writable chmod 777
$compressPdf->compressImages = TRUE; //indicates if the images in the pdf should be compressed
$compressPdf->colorImageQuality = 50; //specify image quality. value from 0 to 100; 
//call the method to compress pdf 
$result = $compressPdf->CompressPdf(); //$result will be OK or APINOK or Error Message
var_dump($result);
 
IV.  MINIMUM SYSTEM REQUIREMENTS

There are no specific requirements that we are aware of.  
It is recommended to use Php 5.0 and up.

V.	 TECHNICAL SUPPORT

If you need technical assistance, you may contact our technical support department in the following ways:

1. Visit http://pdfaid.com/contact.aspx  (Email tech support is available 24/7)
2. Post a message on our facebook page http://facebook.com/pdfaid
3. Follow our youtube channel at http://youtube.com/pdfaid
4. Catch us on google plus https://plus.google.com/105273671224273086459

Copyright Prasad GURLA © [2006] PDFaid.com,
Belgium.
