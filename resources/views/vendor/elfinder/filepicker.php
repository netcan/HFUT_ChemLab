<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>elFinder 2.0</title>

    <!-- jQuery and jQuery UI (REQUIRED) -->
    <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <link href="http://cdn.bootcss.com/jqueryui/1.12.0/jquery-ui.min.css" rel="stylesheet">
    <script src="http://cdn.bootcss.com/jqueryui/1.12.0/jquery-ui.min.js"></script>

    <!-- elFinder CSS (REQUIRED) -->
    <link rel="stylesheet" type="text/css" href="<?= asset($dir . '/css/elfinder.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= asset($dir . '/css/theme.css') ?>">

    <!-- elFinder JS (REQUIRED) -->
    <script src="<?= asset($dir . '/js/elfinder.min.js') ?>"></script>

    <?php if ($locale) { ?>
        <!-- elFinder translation (OPTIONAL) -->
        <script src="<?= asset($dir . "/js/i18n/elfinder.$locale.js") ?>"></script>
    <?php } ?>
    <!-- Include jQuery, jQuery UI, elFinder (REQUIRED) -->

    <?php
    $mimeTypes = implode(',',array_map(function($t){return "'".$t."'";}, explode(',',$type)));
    ?>

    <script type="text/javascript">
        $().ready(function () {
            var elf = $('#elfinder').elfinder({
                // set your elFinder options here
                <?php if($locale){ ?>
                    lang: '<?= $locale ?>', // locale
                <?php } ?>
                customData: {
                    _token: '<?= csrf_token() ?>'
                },
                url: '<?= route("elfinder.connector") ?>',  // connector URL
                resizable: false,
                ui: ['toolbar', 'path','stat'],
                onlyMimes: [<?= $mimeTypes ?>],
                rememberLastDir : false,
                height: 300,
                defaultView: 'list',
                getFileCallback: function (file) {
                    window.parent.processSelectedFile(file, '<?= $input_id?>');
                    console.log(file);
                },

                uiOptions : {
                    // toolbar configuration
                    toolbar : [
                        ['home', 'up'],
                        ['upload'],

                        ['quicklook'],

                    ],
                    // directories tree options
                    tree : {
                        // expand current root on init
                        openRootOnLoad : true,
                        // auto load current dir parents
                        syncTree : true
                    },
                    // navbar options
                    navbar : {
                        minWidth : 150,
                        maxWidth : 500
                    },

                    // current working directory options
                    cwd : {
                        // display parent directory in listing as ".."
                        oldSchool : false
                    }
                }
            }).elfinder('instance');
        });
    </script>


</head>
<body style="margin: 0;">
<!-- Element where elFinder will be created (REQUIRED) -->
<div id="elfinder"></div>

</body>
</html>
