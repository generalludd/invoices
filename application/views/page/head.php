<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

// head.php Chris Dart Mar 6, 2015 12:32:16 PM chrisdart@cerebratorium.com

?>
<meta http-equiv="refresh" content="86400; url=<?php echo site_url("auth/logout");?>">
<link rel="icon" type="image/png" href="/favicon.ico" />
<link rel="stylesheet" media="all" href="<?php echo base_url("/css/normalize.css");?>">

<!-- Latest compiled and minified CSS -->
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" media="screen">-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<!-- Bootstrap theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css" media="screen">
<!-- FontAwesome -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" media="screen" />

<!-- Application CSS -->
<link rel="stylesheet" media="all" href="<?php echo base_url("/css/main.css");?>">
<?php if($this->input->get("print") == 1):?>
<link rel="stylesheet" media="all" href="<?php echo base_url("/css/print.css");?>">
<?php endif; ?>
<!-- Latest compiled and minified JavaScript -->
<!--<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script type="text/javascript">
var base_url =  "<?php echo base_url();?>"</script>
<script src="<?php echo base_url("js/general.js");?>"></script>
</head>
