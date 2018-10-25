
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home | Admin Interface</title>
	<script
			src="https://code.jquery.com/jquery-3.3.1.min.js"
			integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
			crossorigin="anonymous">

	</script>
	<script src="<?php echo URLROOT . 'admin/public/ckeditor/ckeditor.js'?>"></script >
    <link rel="stylesheet" type="text/css"
          href="//cdn.datatables.net/v/bs-3.3.6/jq-2.2.3/pdfmake-0.1.18/dt-1.10.12/af-2.1.2/b-1.2.2/b-colvis-1.2.2/b-html5-1.2.2/b-print-1.2.2/fh-3.1.2/kt-2.1.3/r-2.1.0/sc-1.4.2/se-1.2.0/datatables.min.css"/>
    <link rel="stylesheet" href=<?php echo URLROOT .'admin/public/semantic/dist/semantic.min.css'?>>
    <link rel="stylesheet" href=<?php echo URLROOT .'admin/public/css/style.css'?>>
    <link rel="stylesheet" href="https://use.fontawesome.com/9cff9134e9.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.5/sweetalert2.min.css">

    <script>
        function trans(id){
            $('.' + id)
                .transition('fade down')
            ;
            document.getElementById(id).style.display = "inline";

        }
        function transback(id){
            $('.' + id)
                .transition('fade up')
            ;
            document.getElementById(id).style.display = "none";
        }
    </script>
    
</head>
<body>